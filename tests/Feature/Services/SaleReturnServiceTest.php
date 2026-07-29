<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Exceptions\InvalidReturnQuantityException;
use App\Models\Customer;
use App\Models\CustomerLedger;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\SaleReturn;
use App\Models\User;
use App\Services\BarcodeService;
use App\Services\SaleReturnService;
use App\Services\SaleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleReturnServiceTest extends TestCase
{
    use RefreshDatabase;

    private function makeSale(?Customer $customer, User $user, string $quantity = '10'): SaleItem
    {
        $product = Product::factory()->create(['default_sale_price' => '800.00']);
        $batch = app(BarcodeService::class)->createBatchWithBarcode([
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '400.00',
            'quantity_received' => '50',
            'quantity_remaining' => '50',
        ]);

        $paymentLines = $customer !== null
            ? [['method' => 'ledger', 'amount' => bcmul('800.00', $quantity, 2), 'bank_id' => null]]
            : [['method' => 'cash', 'amount' => bcmul('800.00', $quantity, 2), 'bank_id' => null]];

        $sale = app(SaleService::class)->create(
            customer: $customer,
            items: [['batch_id' => $batch->id, 'quantity' => $quantity, 'unit_price' => '800.00']],
            paymentLines: $paymentLines,
            user: $user,
        );

        return $sale->items()->first();
    }

    public function test_a_valid_return_restores_stock_and_posts_a_reversing_ledger_credit(): void
    {
        $customer = Customer::factory()->create();
        $user = User::factory()->create();
        $saleItem = $this->makeSale($customer, $user, '10');
        $sale = $saleItem->sale;
        $batch = $saleItem->batch;

        $balanceAfterSale = $customer->currentBalance();
        $this->assertSame('8000.00', $balanceAfterSale);

        app(SaleReturnService::class)->create(
            sale: $sale,
            lines: [['sale_item_id' => $saleItem->id, 'quantity' => '2']],
            reason: 'Wrong item',
            user: $user,
        );

        $this->assertSame('42.00', $batch->fresh()->quantity_remaining);
        $this->assertSame('2.00', $saleItem->fresh()->quantity_returned);
        // 8000 - (2 * 800) = 6400
        $this->assertSame('6400.00', $customer->currentBalance());
        $this->assertSame('partially_returned', $sale->fresh()->status);
    }

    public function test_a_walk_in_sale_return_restores_stock_without_touching_any_ledger(): void
    {
        $user = User::factory()->create();
        $saleItem = $this->makeSale(null, $user, '10');
        $sale = $saleItem->sale;
        $batch = $saleItem->batch;

        app(SaleReturnService::class)->create(
            sale: $sale,
            lines: [['sale_item_id' => $saleItem->id, 'quantity' => '4']],
            reason: 'Customer changed mind',
            user: $user,
        );

        $this->assertSame('44.00', $batch->fresh()->quantity_remaining);
        $this->assertSame(0, CustomerLedger::query()->count());
    }

    public function test_returning_more_than_was_sold_writes_nothing(): void
    {
        $user = User::factory()->create();
        $saleItem = $this->makeSale(null, $user, '10');
        $sale = $saleItem->sale;

        try {
            app(SaleReturnService::class)->create(
                sale: $sale,
                lines: [['sale_item_id' => $saleItem->id, 'quantity' => '999']],
                reason: 'Too many',
                user: $user,
            );

            $this->fail('Expected InvalidReturnQuantityException was not thrown.');
        } catch (InvalidReturnQuantityException) {
            // expected
        }

        $this->assertSame(0, SaleReturn::query()->count());
        $this->assertSame('0.00', $saleItem->fresh()->quantity_returned);
        $this->assertSame('completed', $sale->fresh()->status);
    }
}
