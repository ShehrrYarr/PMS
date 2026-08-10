<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Exceptions\InsufficientStockException;
use App\Exceptions\InvalidSaleItemException;
use App\Exceptions\InvalidSalePaymentException;
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

    public function test_a_negative_quantity_line_item_is_rejected_and_writes_nothing(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        try {
            app(SaleService::class)->create(
                customer: null,
                items: [
                    ['batch_id' => $batch->id, 'quantity' => '10', 'unit_price' => '800.00'],
                    ['batch_id' => $batch->id, 'quantity' => '-9', 'unit_price' => '800.00'],
                ],
                paymentLines: [['method' => 'cash', 'amount' => '800.00', 'bank_id' => null]],
                user: $user,
            );

            $this->fail('Expected InvalidSaleItemException was not thrown.');
        } catch (InvalidSaleItemException) {
            // expected
        }

        $this->assertSame(0, Sale::query()->count());
        $this->assertSame(0, SaleItem::query()->count());
        $this->assertSame('20.00', $batch->fresh()->quantity_remaining);
    }

    public function test_a_zero_quantity_line_item_is_rejected(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        try {
            app(SaleService::class)->create(
                customer: null,
                items: [['batch_id' => $batch->id, 'quantity' => '0', 'unit_price' => '800.00']],
                paymentLines: [['method' => 'cash', 'amount' => '0.00', 'bank_id' => null]],
                user: $user,
            );

            $this->fail('Expected InvalidSaleItemException was not thrown.');
        } catch (InvalidSaleItemException) {
            // expected
        }

        $this->assertSame(0, Sale::query()->count());
        $this->assertSame('20.00', $batch->fresh()->quantity_remaining);
    }

    public function test_a_negative_unit_price_is_rejected_and_writes_nothing(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        try {
            app(SaleService::class)->create(
                customer: null,
                items: [['batch_id' => $batch->id, 'quantity' => '5', 'unit_price' => '-800.00']],
                paymentLines: [['method' => 'cash', 'amount' => '-4000.00', 'bank_id' => null]],
                user: $user,
            );

            $this->fail('Expected InvalidSaleItemException was not thrown.');
        } catch (InvalidSaleItemException) {
            // expected
        }

        $this->assertSame(0, Sale::query()->count());
        $this->assertSame('20.00', $batch->fresh()->quantity_remaining);
    }

    public function test_a_walk_in_ledger_payment_is_rejected_with_a_clean_exception(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        try {
            app(SaleService::class)->create(
                customer: null,
                items: [['batch_id' => $batch->id, 'quantity' => '5', 'unit_price' => '800.00']],
                paymentLines: [['method' => 'ledger', 'amount' => '4000.00', 'bank_id' => null]],
                user: $user,
            );

            $this->fail('Expected InvalidSalePaymentException was not thrown.');
        } catch (InvalidSalePaymentException) {
            // expected
        }

        $this->assertSame(0, Sale::query()->count());
        $this->assertSame('20.00', $batch->fresh()->quantity_remaining);
    }

    public function test_a_flat_per_item_discount_reduces_the_line_and_sale_total(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        $sale = app(SaleService::class)->create(
            customer: null,
            items: [[
                'batch_id' => $batch->id,
                'quantity' => '5',
                'unit_price' => '800.00',
                'discount_type' => 'flat',
                'discount_value' => '500.00',
            ]],
            paymentLines: [['method' => 'cash', 'amount' => '3500.00', 'bank_id' => null]],
            user: $user,
        );

        $this->assertSame('3500.00', $sale->total_amount);
        $saleItem = SaleItem::query()->where('sale_id', $sale->id)->firstOrFail();
        $this->assertSame('500.00', $saleItem->discount_amount);
        $this->assertSame('3500.00', $saleItem->line_total);
    }

    public function test_a_percentage_per_item_discount_truncates_and_reduces_the_sale_total(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        $sale = app(SaleService::class)->create(
            customer: null,
            items: [[
                'batch_id' => $batch->id,
                'quantity' => '5',
                'unit_price' => '800.00',
                'discount_type' => 'percentage',
                'discount_value' => '10',
            ]],
            paymentLines: [['method' => 'cash', 'amount' => '3600.00', 'bank_id' => null]],
            user: $user,
        );

        $this->assertSame('3600.00', $sale->total_amount);
        $this->assertSame('400.00', SaleItem::query()->where('sale_id', $sale->id)->firstOrFail()->discount_amount);
    }

    public function test_a_sale_level_discount_stacks_on_top_of_a_per_item_discount(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        // Line: 5 x 800.00 = 4000.00, minus a flat 500.00 item discount = 3500.00.
        // Sale-level 10% then takes 350.00 off that, leaving 3150.00.
        $sale = app(SaleService::class)->create(
            customer: null,
            items: [[
                'batch_id' => $batch->id,
                'quantity' => '5',
                'unit_price' => '800.00',
                'discount_type' => 'flat',
                'discount_value' => '500.00',
            ]],
            paymentLines: [['method' => 'cash', 'amount' => '3150.00', 'bank_id' => null]],
            user: $user,
            discountType: 'percentage',
            discountValue: '10',
        );

        $this->assertSame('3150.00', $sale->total_amount);
        $this->assertSame('350.00', $sale->discount_amount);
    }

    public function test_a_discount_exceeding_the_subtotal_is_rejected_and_writes_nothing(): void
    {
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        try {
            app(SaleService::class)->create(
                customer: null,
                items: [[
                    'batch_id' => $batch->id,
                    'quantity' => '1',
                    'unit_price' => '100.00',
                    'discount_type' => 'flat',
                    'discount_value' => '150.00',
                ]],
                paymentLines: [['method' => 'cash', 'amount' => '0.00', 'bank_id' => null]],
                user: $user,
            );

            $this->fail('Expected InvalidSaleItemException was not thrown.');
        } catch (InvalidSaleItemException) {
            // expected
        }

        $this->assertSame(0, Sale::query()->count());
        $this->assertSame('20.00', $batch->fresh()->quantity_remaining);
    }

    public function test_an_on_account_sale_with_a_discount_posts_the_discounted_total_to_the_ledger(): void
    {
        $customer = Customer::factory()->create();
        $user = User::factory()->create();
        $batch = $this->makeBatch('20');

        // 5 x 800.00 = 4000.00, minus a flat 400.00 sale discount = 3600.00 —
        // the customer's ledger must reflect this discounted total, not 4000.00.
        $sale = app(SaleService::class)->create(
            customer: $customer,
            items: [['batch_id' => $batch->id, 'quantity' => '5', 'unit_price' => '800.00']],
            paymentLines: [['method' => 'ledger', 'amount' => '3600.00', 'bank_id' => null]],
            user: $user,
            discountType: 'flat',
            discountValue: '400.00',
        );

        $this->assertSame('3600.00', $sale->total_amount);
        $this->assertSame('3600.00', $customer->currentBalance());
    }
}
