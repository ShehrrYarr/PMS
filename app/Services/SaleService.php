<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\LedgerEntryType;
use App\Enums\PayableType;
use App\Enums\PaymentMethod;
use App\Enums\TransactionReferenceType;
use App\Exceptions\InsufficientStockException;
use App\Exceptions\InvalidSaleItemException;
use App\Exceptions\InvalidSalePaymentException;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Implements the POS checkout data flow from architecture.md §1.2: validates
 * stock, decrements each sold batch, records the sale, splits payment across
 * cash/bank/ledger, and posts a customer-ledger entry for any on-account
 * portion — all inside one transaction (see rules.md §2).
 */
class SaleService
{
    public function __construct(
        private readonly PaymentSplitService $paymentSplitService,
        private readonly LedgerService $ledgerService,
    ) {}

    /**
     * @param  list<array{batch_id: int, quantity: string, unit_price: string}>  $items
     * @param  list<array{method: string, amount: string, bank_id: ?int}>  $paymentLines
     * @param  ?string  $clientUuid Idempotency key for a sale replayed from an offline queue.
     * @param  ?string  $invoiceNumber Pre-assigned number (offline sales keep the SL-OFF… number
     *                                 already printed on the customer's receipt); null derives the
     *                                 usual SL-###### from the new row's id.
     * @param  ?CarbonInterface  $occurredAt When the sale actually happened at the till. Offline
     *                                       sales pass this so they aren't all dated to sync time.
     * @param  bool  $allowOverdraw Skip the stock-availability check only. Passed true solely by
     *                              OfflineSyncService — see the guard comment below.
     */
    public function create(
        ?Customer $customer,
        array $items,
        array $paymentLines,
        User $user,
        ?UploadedFile $photo = null,
        ?string $clientUuid = null,
        ?string $invoiceNumber = null,
        ?CarbonInterface $occurredAt = null,
        bool $allowOverdraw = false,
    ): Sale {
        $totalAmount = array_reduce(
            $items,
            fn (string $carry, array $item) => bcadd($carry, bcmul($item['unit_price'], $item['quantity'], 2), 2),
            '0.00',
        );

        $this->paymentSplitService->assertBalanced($paymentLines, $totalAmount);

        if ($customer === null) {
            foreach ($paymentLines as $line) {
                if ($line['method'] === PaymentMethod::Ledger->value) {
                    throw InvalidSalePaymentException::ledgerPaymentRequiresCustomer();
                }
            }
        }

        return DB::transaction(function () use ($customer, $items, $paymentLines, $totalAmount, $user, $photo, $clientUuid, $invoiceNumber, $occurredAt, $allowOverdraw) {
            $sale = Sale::query()->create([
                'shop_id' => $user->shop_id,
                'invoice_number' => (string) Str::uuid(),
                'client_uuid' => $clientUuid,
                'customer_id' => $customer?->id,
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 'completed',
            ]);

            $sale->update([
                // An offline sale keeps the number already printed on the
                // customer's receipt; an online one derives the usual
                // sequential number from the id the insert just assigned.
                'invoice_number' => $invoiceNumber ?? 'SL-'.str_pad((string) $sale->id, 6, '0', STR_PAD_LEFT),
                'photo_path' => $photo?->storeAs('sale-photos', "{$sale->id}.jpg", 'public'),
                'synced_at' => $occurredAt !== null ? now() : null,
            ]);

            // Back-date to when the sale was actually rung up. Without this
            // every sale from a multi-day offline stretch would carry the
            // sync timestamp, breaking day-close reconciliation and every
            // date-filtered sales report.
            if ($occurredAt !== null) {
                $sale->forceFill(['created_at' => $occurredAt, 'updated_at' => $occurredAt])->save();
            }

            foreach ($items as $item) {
                $batch = Batch::query()->lockForUpdate()->findOrFail($item['batch_id']);

                if (bccomp($item['quantity'], '0.01', 2) < 0) {
                    throw InvalidSaleItemException::forNonPositiveQuantity($batch->barcode, $item['quantity']);
                }

                if (bccomp($item['unit_price'], '0', 2) < 0) {
                    throw InvalidSaleItemException::forNegativeUnitPrice($batch->barcode, $item['unit_price']);
                }

                // NOTE the tight scope of this condition: it guards the stock
                // check and nothing else. The two guards above it stay
                // unconditional — an offline replay must still be rejected for
                // a non-positive quantity or a negative price. Widening this
                // `if` to cover them would let a tampered offline queue write
                // the exact corruption those guards exist to stop.
                if (! $allowOverdraw && bccomp($item['quantity'], (string) $batch->quantity_remaining, 2) > 0) {
                    throw InsufficientStockException::forBatch($batch->barcode, $item['quantity'], (string) $batch->quantity_remaining);
                }

                $lineTotal = bcmul($item['unit_price'], $item['quantity'], 2);

                $saleItem = SaleItem::query()->create([
                    'shop_id' => $user->shop_id,
                    'sale_id' => $sale->id,
                    'batch_id' => $batch->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'cost_price' => $batch->cost_price,
                    'line_total' => $lineTotal,
                ]);

                if ($occurredAt !== null) {
                    $saleItem->forceFill(['created_at' => $occurredAt, 'updated_at' => $occurredAt])->save();
                }

                $batch->update([
                    'quantity_remaining' => bcsub((string) $batch->quantity_remaining, $item['quantity'], 2),
                ]);
            }

            $ledgerAmount = '0.00';

            foreach ($paymentLines as $line) {
                $payment = Payment::query()->create([
                    'shop_id' => $user->shop_id,
                    'payable_type' => PayableType::Sale->value,
                    'payable_id' => $sale->id,
                    'method' => $line['method'],
                    'bank_id' => $line['method'] === PaymentMethod::Bank->value ? $line['bank_id'] : null,
                    'amount' => $line['amount'],
                    'user_id' => $user->id,
                ]);

                // Dashboard cash/bank figures are filtered on the payment's
                // own created_at, so an offline payment left at sync time
                // would land on the wrong day and contradict the sales trend
                // sitting right beside it.
                if ($occurredAt !== null) {
                    $payment->forceFill(['created_at' => $occurredAt, 'updated_at' => $occurredAt])->save();
                }

                if ($line['method'] === PaymentMethod::Ledger->value) {
                    $ledgerAmount = bcadd($ledgerAmount, $line['amount'], 2);
                }
            }

            if (bccomp($ledgerAmount, '0.00', 2) !== 0) {
                $this->ledgerService->postCustomerEntry(
                    customer: $customer,
                    type: LedgerEntryType::Debit,
                    amount: $ledgerAmount,
                    referenceType: TransactionReferenceType::Sale,
                    referenceId: $sale->id,
                    description: "Sale {$sale->invoice_number}",
                    user: $user,
                    occurredAt: $occurredAt,
                );
            }

            return $sale;
        });
    }
}
