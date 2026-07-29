<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\LedgerEntryType;
use App\Enums\PayableType;
use App\Enums\PaymentMethod;
use App\Enums\TransactionReferenceType;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Implements the purchase → purchase_items → batches → payments → vendor
 * ledger data flow from architecture.md §1.1. Every write happens inside one
 * transaction; a split payment must sum exactly to the purchase total before
 * anything is written (see rules.md §2 rules 2-3).
 */
class PurchaseService
{
    public function __construct(
        private readonly BarcodeService $barcodeService,
        private readonly PaymentSplitService $paymentSplitService,
        private readonly LedgerService $ledgerService,
    ) {}

    /**
     * @param  list<array{product_id: int, manufacturing_date: string, expiry_date: string, cost_price: string, quantity: string}>  $items
     * @param  list<array{method: string, amount: string, bank_id: ?int}>  $paymentLines
     */
    public function create(Vendor $vendor, array $items, array $paymentLines, User $user): Purchase
    {
        $totalAmount = array_reduce(
            $items,
            fn (string $carry, array $item) => bcadd($carry, bcmul($item['cost_price'], $item['quantity'], 2), 2),
            '0.00',
        );

        $this->paymentSplitService->assertBalanced($paymentLines, $totalAmount);

        return DB::transaction(function () use ($vendor, $items, $paymentLines, $totalAmount, $user) {
            $purchase = Purchase::query()->create([
                'invoice_number' => (string) Str::uuid(),
                'vendor_id' => $vendor->id,
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 'completed',
            ]);

            $purchase->update([
                'invoice_number' => 'PU-'.str_pad((string) $purchase->id, 6, '0', STR_PAD_LEFT),
            ]);

            foreach ($items as $item) {
                $lineTotal = bcmul($item['cost_price'], $item['quantity'], 2);

                $purchaseItem = PurchaseItem::query()->create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'cost_price' => $item['cost_price'],
                    'line_total' => $lineTotal,
                ]);

                $this->barcodeService->createBatchWithBarcode([
                    'product_id' => $item['product_id'],
                    'manufacturing_date' => $item['manufacturing_date'],
                    'expiry_date' => $item['expiry_date'],
                    'cost_price' => $item['cost_price'],
                    'quantity_received' => $item['quantity'],
                    'quantity_remaining' => $item['quantity'],
                    'purchase_item_id' => $purchaseItem->id,
                ]);
            }

            $ledgerAmount = '0.00';

            foreach ($paymentLines as $line) {
                Payment::query()->create([
                    'payable_type' => PayableType::Purchase->value,
                    'payable_id' => $purchase->id,
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
                $this->ledgerService->postVendorEntry(
                    vendor: $vendor,
                    type: LedgerEntryType::Credit,
                    amount: $ledgerAmount,
                    referenceType: TransactionReferenceType::Purchase,
                    referenceId: $purchase->id,
                    description: "Purchase {$purchase->invoice_number}",
                    user: $user,
                );
            }

            return $purchase;
        });
    }
}
