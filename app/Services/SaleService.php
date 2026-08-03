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
     */
    public function create(?Customer $customer, array $items, array $paymentLines, User $user, ?UploadedFile $photo = null): Sale
    {
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

        return DB::transaction(function () use ($customer, $items, $paymentLines, $totalAmount, $user, $photo) {
            $sale = Sale::query()->create([
                'shop_id' => $user->shop_id,
                'invoice_number' => (string) Str::uuid(),
                'customer_id' => $customer?->id,
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 'completed',
            ]);

            $sale->update([
                'invoice_number' => 'SL-'.str_pad((string) $sale->id, 6, '0', STR_PAD_LEFT),
                'photo_path' => $photo?->storeAs('sale-photos', "{$sale->id}.jpg", 'public'),
            ]);

            foreach ($items as $item) {
                $batch = Batch::query()->lockForUpdate()->findOrFail($item['batch_id']);

                if (bccomp($item['quantity'], '0.01', 2) < 0) {
                    throw InvalidSaleItemException::forNonPositiveQuantity($batch->barcode, $item['quantity']);
                }

                if (bccomp($item['unit_price'], '0', 2) < 0) {
                    throw InvalidSaleItemException::forNegativeUnitPrice($batch->barcode, $item['unit_price']);
                }

                if (bccomp($item['quantity'], (string) $batch->quantity_remaining, 2) > 0) {
                    throw InsufficientStockException::forBatch($batch->barcode, $item['quantity'], (string) $batch->quantity_remaining);
                }

                $lineTotal = bcmul($item['unit_price'], $item['quantity'], 2);

                SaleItem::query()->create([
                    'shop_id' => $user->shop_id,
                    'sale_id' => $sale->id,
                    'batch_id' => $batch->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'cost_price' => $batch->cost_price,
                    'line_total' => $lineTotal,
                ]);

                $batch->update([
                    'quantity_remaining' => bcsub((string) $batch->quantity_remaining, $item['quantity'], 2),
                ]);
            }

            $ledgerAmount = '0.00';

            foreach ($paymentLines as $line) {
                Payment::query()->create([
                    'shop_id' => $user->shop_id,
                    'payable_type' => PayableType::Sale->value,
                    'payable_id' => $sale->id,
                    'method' => $line['method'],
                    'bank_id' => $line['method'] === PaymentMethod::Bank->value ? $line['bank_id'] : null,
                    'amount' => $line['amount'],
                    'user_id' => $user->id,
                ]);

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
                );
            }

            return $sale;
        });
    }
}
