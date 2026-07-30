<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\LedgerEntryType;
use App\Enums\TransactionReferenceType;
use App\Exceptions\InvalidReturnQuantityException;
use App\Models\Batch;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleReturn;
use App\Models\SaleReturnItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Reverses a sale, in whole or in part: restores batch stock and posts a
 * reversing customer-ledger entry — never mutates the original sale or its
 * ledger entry (see rules.md §2 rules 1 and 6). Mirrors PurchaseReturnService.
 */
class SaleReturnService
{
    public function __construct(private readonly LedgerService $ledgerService) {}

    /**
     * @param  list<array{sale_item_id: int, quantity: string}>  $lines
     */
    public function create(Sale $sale, array $lines, string $reason, User $user): SaleReturn
    {
        return DB::transaction(function () use ($sale, $lines, $reason, $user) {
            $totalAmount = '0.00';
            $itemsData = [];

            foreach ($lines as $line) {
                $saleItem = SaleItem::query()->lockForUpdate()->findOrFail($line['sale_item_id']);
                $returnable = $saleItem->returnableQuantity();

                if (bccomp($line['quantity'], $returnable, 2) > 0) {
                    throw InvalidReturnQuantityException::exceedsReturnable($line['quantity'], $returnable);
                }

                $batch = Batch::query()->lockForUpdate()->findOrFail($saleItem->batch_id);

                $lineTotal = bcmul((string) $saleItem->unit_price, $line['quantity'], 2);
                $totalAmount = bcadd($totalAmount, $lineTotal, 2);

                $itemsData[] = [
                    'sale_item_id' => $saleItem->id,
                    'batch_id' => $batch->id,
                    'quantity' => $line['quantity'],
                    'line_total' => $lineTotal,
                ];

                $saleItem->update([
                    'quantity_returned' => bcadd((string) $saleItem->quantity_returned, $line['quantity'], 2),
                ]);

                $batch->update([
                    'quantity_remaining' => bcadd((string) $batch->quantity_remaining, $line['quantity'], 2),
                ]);
            }

            $saleReturn = SaleReturn::query()->create([
                'shop_id' => $user->shop_id,
                'sale_id' => $sale->id,
                'customer_id' => $sale->customer_id,
                'reason' => $reason,
                'total_amount' => $totalAmount,
                'user_id' => $user->id,
            ]);

            foreach ($itemsData as $data) {
                SaleReturnItem::query()->create([...$data, 'shop_id' => $user->shop_id, 'sale_return_id' => $saleReturn->id]);
            }

            if ($sale->customer_id !== null) {
                $this->ledgerService->postCustomerEntry(
                    customer: $sale->customer,
                    type: LedgerEntryType::Credit,
                    amount: $totalAmount,
                    referenceType: TransactionReferenceType::SaleReturn,
                    referenceId: $saleReturn->id,
                    description: "Return against {$sale->invoice_number}",
                    user: $user,
                );
            }

            $sale->load('items');
            $fullyReturned = $sale->items->every(
                fn (SaleItem $item) => bccomp((string) $item->quantity_returned, (string) $item->quantity, 2) === 0,
            );
            $sale->update(['status' => $fullyReturned ? 'returned' : 'partially_returned']);

            return $saleReturn;
        });
    }
}
