<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Exceptions\InsufficientStockException;
use App\Exceptions\UnbalancedPaymentSplitException;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\CustomerLedger;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use App\Services\BarcodeService;
use App\Services\SaleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleServiceTest extends TestCase
{
    use RefreshDatabase;

    private function makeBatch(string $quantity = '20'): Batch
    {
        $product = Product::factory()->create(['default_sale_price' => '800.00']);

        return app(BarcodeService::class)->createBatchWithBarcode([
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '400.00',
            'quantity_received' => $quantity,
            'quantity_remaining' => $quantity,
        ]);
    }

    public function test_create_decrements_stock_and_posts_only_the_on_account_portion_to_the_ledger(): void
    {
        $customer = Customer::factory()->create();
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        $sale = app(SaleService::class)->create(
            customer: $customer,
            items: [['batch_id' => $batch->id, 'quantity' => '5', 'unit_price' => '800.00']],
            paymentLines: [
                ['method' => 'cash', 'amount' => '2000.00', 'bank_id' => null],
                ['method' => 'ledger', 'amount' => '2000.00', 'bank_id' => null],
            ],
            user: $user,
        );

        $this->assertSame('4000.00', $sale->total_amount);
        $this->assertSame('15.00', $batch->fresh()->quantity_remaining);
        $this->assertSame(1, SaleItem::query()->count());
        $this->assertSame(2, Payment::query()->where('payable_id', $sale->id)->count());
        $this->assertSame('2000.00', $customer->currentBalance());
        $this->assertSame('400.00', SaleItem::query()->where('sale_id', $sale->id)->first()->cost_price);
    }

    public function test_walk_in_sale_posts_no_ledger_entry(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        $sale = app(SaleService::class)->create(
            customer: null,
            items: [['batch_id' => $batch->id, 'quantity' => '2', 'unit_price' => '800.00']],
            paymentLines: [['method' => 'cash', 'amount' => '1600.00', 'bank_id' => null]],
            user: $user,
        );

        $this->assertNull($sale->customer_id);
        $this->assertSame(0, CustomerLedger::query()->count());
    }

    public function test_overselling_a_batch_writes_nothing_and_leaves_stock_untouched(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('5');

        try {
            app(SaleService::class)->create(
                customer: null,
                items: [['batch_id' => $batch->id, 'quantity' => '999', 'unit_price' => '800.00']],
                paymentLines: [['method' => 'cash', 'amount' => bcmul('800.00', '999', 2), 'bank_id' => null]],
                user: $user,
            );

            $this->fail('Expected InsufficientStockException was not thrown.');
        } catch (InsufficientStockException) {
            // expected
        }

        $this->assertSame(0, Sale::query()->count());
        $this->assertSame(0, SaleItem::query()->count());
        $this->assertSame('5.00', $batch->fresh()->quantity_remaining);
    }

    public function test_an_unbalanced_split_writes_nothing(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        try {
            app(SaleService::class)->create(
                customer: null,
                items: [['batch_id' => $batch->id, 'quantity' => '5', 'unit_price' => '800.00']],
                paymentLines: [['method' => 'cash', 'amount' => '1000.00', 'bank_id' => null]],
                user: $user,
            );

            $this->fail('Expected UnbalancedPaymentSplitException was not thrown.');
        } catch (UnbalancedPaymentSplitException) {
            // expected
        }

        $this->assertSame(0, Sale::query()->count());
        $this->assertSame('20.00', $batch->fresh()->quantity_remaining);
    }
}
