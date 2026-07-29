<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Exceptions\InvalidReturnQuantityException;
use App\Models\Batch;
use App\Models\Product;
use App\Models\PurchaseItem;
use App\Models\PurchaseReturn;
use App\Models\User;
use App\Models\Vendor;
use App\Services\PurchaseReturnService;
use App\Services\PurchaseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseReturnServiceTest extends TestCase
{
    use RefreshDatabase;

    private function makePurchase(Vendor $vendor, User $user, string $quantity = '10'): PurchaseItem
    {
        $product = Product::factory()->create();

        $purchase = app(PurchaseService::class)->create(
            vendor: $vendor,
            items: [[
                'product_id' => $product->id,
                'manufacturing_date' => '2026-01-01',
                'expiry_date' => '2027-01-01',
                'cost_price' => '400.00',
                'quantity' => $quantity,
            ]],
            paymentLines: [['method' => 'ledger', 'amount' => bcmul('400.00', $quantity, 2), 'bank_id' => null]],
            user: $user,
        );

        return $purchase->items()->first();
    }

    public function test_a_valid_return_restores_batch_stock_and_posts_a_reversing_ledger_entry(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $purchaseItem = $this->makePurchase($vendor, $user, '10');
        $purchase = $purchaseItem->purchase;
        $batch = $purchaseItem->batch;

        app(PurchaseReturnService::class)->create(
            purchase: $purchase,
            lines: [['purchase_item_id' => $purchaseItem->id, 'quantity' => '3']],
            reason: 'Damaged',
            user: $user,
        );

        $this->assertSame('7.00', $batch->fresh()->quantity_remaining);
        $this->assertSame('3.00', $purchaseItem->fresh()->quantity_returned);
        // Purchase was 10 * 400 = 4000 credit; return of 3 * 400 = 1200 debit.
        $this->assertSame('2800.00', $vendor->currentBalance());
        $this->assertSame('partially_returned', $purchase->fresh()->status);
    }

    public function test_returning_more_than_was_purchased_writes_nothing(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $purchaseItem = $this->makePurchase($vendor, $user, '10');
        $purchase = $purchaseItem->purchase;

        try {
            app(PurchaseReturnService::class)->create(
                purchase: $purchase,
                lines: [['purchase_item_id' => $purchaseItem->id, 'quantity' => '999']],
                reason: 'Too many',
                user: $user,
            );

            $this->fail('Expected InvalidReturnQuantityException was not thrown.');
        } catch (InvalidReturnQuantityException) {
            // expected
        }

        $this->assertSame(0, PurchaseReturn::query()->count());
        $this->assertSame('0.00', $purchaseItem->fresh()->quantity_returned);
        $this->assertSame('10.00', Batch::query()->first()->quantity_remaining);
        $this->assertSame('completed', $purchase->fresh()->status);
    }

    public function test_a_second_return_cannot_exceed_what_remains_after_the_first(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $purchaseItem = $this->makePurchase($vendor, $user, '10');
        $purchase = $purchaseItem->purchase;

        app(PurchaseReturnService::class)->create(
            purchase: $purchase,
            lines: [['purchase_item_id' => $purchaseItem->id, 'quantity' => '6']],
            reason: 'First return',
            user: $user,
        );

        $this->expectException(InvalidReturnQuantityException::class);

        app(PurchaseReturnService::class)->create(
            purchase: $purchase,
            lines: [['purchase_item_id' => $purchaseItem->id, 'quantity' => '5']],
            reason: 'Second return exceeds remaining 4',
            user: $user,
        );
    }
}
