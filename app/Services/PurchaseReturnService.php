<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\LedgerEntryType;
use App\Enums\TransactionReferenceType;
use App\Exceptions\InvalidReturnQuantityException;
use App\Models\Batch;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Reverses a purchase, in whole or in part: restores/removes batch stock and
 * posts a reversing vendor-ledger entry — never mutates the original
 * purchase or its ledger entry (see rules.md §2 rules 1 and 6).
 */
class PurchaseReturnService
{
    public function __construct(private readonly LedgerService $ledgerService) {}

    /**
     * @param  list<array{purchase_item_id: int, quantity: string}>  $lines
     */
    public function create(Purchase $purchase, array $lines, string $reason, User $user): PurchaseReturn
    {
        return DB::transaction(function () use ($purchase, $lines, $reason, $user) {
            $totalAmount = '0.00';
            $itemsData = [];

            foreach ($lines as $line) {
                $purchaseItem = PurchaseItem::query()->lockForUpdate()->findOrFail($line['purchase_item_id']);
                $batch = Batch::query()->lockForUpdate()->findOrFail($purchaseItem->batch->id);

                $returnable = min(
                    (float) $purchaseItem->returnableQuantity(),
                    (float) $batch->quantity_remaining,
                );

                if (bccomp($line['quantity'], (string) $returnable, 2) > 0) {
                    throw InvalidReturnQuantityException::exceedsReturnable($line['quantity'], (string) $returnable);
                }

                $lineTotal = bcmul((string) $purchaseItem->cost_price, $line['quantity'], 2);
                $totalAmount = bcadd($totalAmount, $lineTotal, 2);

                $itemsData[] = [
                    'purchase_item_id' => $purchaseItem->id,
                    'batch_id' => $batch->id,
                    'quantity' => $line['quantity'],
                    'line_total' => $lineTotal,
                ];

                $purchaseItem->update([
                    'quantity_returned' => bcadd((string) $purchaseItem->quantity_returned, $line['quantity'], 2),
                ]);

                $batch->update([
                    'quantity_remaining' => bcsub((string) $batch->quantity_remaining, $line['quantity'], 2),
                ]);
            }

            $purchaseReturn = PurchaseReturn::query()->create([
                'purchase_id' => $purchase->id,
                'vendor_id' => $purchase->vendor_id,
                'reason' => $reason,
                'total_amount' => $totalAmount,
                'user_id' => $user->id,
            ]);

            foreach ($itemsData as $data) {
                PurchaseReturnItem::query()->create([...$data, 'purchase_return_id' => $purchaseReturn->id]);
            }

            $this->ledgerService->postVendorEntry(
                vendor: $purchase->vendor,
                type: LedgerEntryType::Debit,
                amount: $totalAmount,
                referenceType: TransactionReferenceType::PurchaseReturn,
                referenceId: $purchaseReturn->id,
                description: "Return against {$purchase->invoice_number}",
                user: $user,
            );

            $purchase->load('items');
            $fullyReturned = $purchase->items->every(
                fn (PurchaseItem $item) => bccomp((string) $item->quantity_returned, (string) $item->quantity, 2) === 0,
            );
            $purchase->update(['status' => $fullyReturned ? 'returned' : 'partially_returned']);

            return $purchaseReturn;
        });
    }
}
