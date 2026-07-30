<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Models\Batch;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use App\Services\SalesReportService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class SalesReportServiceTest extends TestCase
{
    use RefreshDatabase;

    private function backdate(Sale $sale, Carbon $date): void
    {
        $sale->forceFill(['created_at' => $date, 'updated_at' => $date])->save();
    }

    public function test_summary_computes_profit_and_margin_across_filtered_sales(): void
    {
        $user = User::factory()->create();
        $customerA = Customer::factory()->create();
        $customerB = Customer::factory()->create();
        $product = Product::factory()->create();

        $batch = Batch::query()->create(['product_id' => $product->id, 'barcode' => 'BC-1', 'manufacturing_date' => '2026-01-01', 'expiry_date' => '2027-01-01', 'cost_price' => '60.00', 'quantity_received' => '100', 'quantity_remaining' => '80']);

        $saleA = Sale::query()->create(['invoice_number' => 'SL-1', 'customer_id' => $customerA->id, 'user_id' => $user->id, 'total_amount' => '1000.00', 'status' => 'completed']);
        SaleItem::query()->create(['sale_id' => $saleA->id, 'batch_id' => $batch->id, 'quantity' => '10', 'unit_price' => '100.00', 'cost_price' => '60.00', 'line_total' => '1000.00']);

        $saleB = Sale::query()->create(['invoice_number' => 'SL-2', 'customer_id' => $customerB->id, 'user_id' => $user->id, 'total_amount' => '500.00', 'status' => 'completed']);
        SaleItem::query()->create(['sale_id' => $saleB->id, 'batch_id' => $batch->id, 'quantity' => '5', 'unit_price' => '100.00', 'cost_price' => '60.00', 'line_total' => '500.00']);

        $saleOld = Sale::query()->create(['invoice_number' => 'SL-3', 'customer_id' => $customerA->id, 'user_id' => $user->id, 'total_amount' => '9999.00', 'status' => 'completed']);
        $this->backdate($saleOld, Carbon::today()->subDays(10));
        SaleItem::query()->create(['sale_id' => $saleOld->id, 'batch_id' => $batch->id, 'quantity' => '1', 'unit_price' => '9999.00', 'cost_price' => '60.00', 'line_total' => '9999.00']);

        $unfiltered = app(SalesReportService::class)->summary(null, null, null);
        $this->assertSame('11499.00', $unfiltered['sales_total']);

        $filteredByDate = app(SalesReportService::class)->summary(Carbon::today()->format('Y-m-d'), null, null);
        $this->assertSame('1500.00', $filteredByDate['sales_total']);
        $this->assertSame('900.00', $filteredByDate['cost_total']);
        $this->assertSame('600.00', $filteredByDate['profit_total']);
        $this->assertSame('40.00', $filteredByDate['margin_percent']);

        $filteredByCustomer = app(SalesReportService::class)->summary(Carbon::today()->format('Y-m-d'), null, $customerA->id);
        $this->assertSame('1000.00', $filteredByCustomer['sales_total']);
    }

    public function test_summary_is_all_zero_with_no_sales(): void
    {
        $summary = app(SalesReportService::class)->summary(null, null, null);

        $this->assertSame('0.00', $summary['sales_total']);
        $this->assertSame('0.00', $summary['cost_total']);
        $this->assertSame('0.00', $summary['profit_total']);
        $this->assertSame('0.00', $summary['margin_percent']);
    }

    public function test_product_scoped_summary_only_counts_that_products_line_items(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $productA = Product::factory()->create();
        $productB = Product::factory()->create();

        $batchA = Batch::query()->create(['product_id' => $productA->id, 'barcode' => 'BC-A', 'manufacturing_date' => '2026-01-01', 'expiry_date' => '2027-01-01', 'cost_price' => '60.00', 'quantity_received' => '100', 'quantity_remaining' => '80']);
        $batchB = Batch::query()->create(['product_id' => $productB->id, 'barcode' => 'BC-B', 'manufacturing_date' => '2026-01-01', 'expiry_date' => '2027-01-01', 'cost_price' => '20.00', 'quantity_received' => '100', 'quantity_remaining' => '90']);

        $sale = Sale::query()->create(['invoice_number' => 'SL-1', 'customer_id' => $customer->id, 'user_id' => $user->id, 'total_amount' => '1500.00', 'status' => 'completed']);
        SaleItem::query()->create(['sale_id' => $sale->id, 'batch_id' => $batchA->id, 'quantity' => '10', 'unit_price' => '100.00', 'cost_price' => '60.00', 'line_total' => '1000.00']);
        SaleItem::query()->create(['sale_id' => $sale->id, 'batch_id' => $batchB->id, 'quantity' => '25', 'unit_price' => '20.00', 'cost_price' => '20.00', 'line_total' => '500.00']);

        $summary = app(SalesReportService::class)->summary(null, null, null, $productA->id);

        $this->assertSame('1000.00', $summary['sales_total']);
        $this->assertSame('600.00', $summary['cost_total']);
        $this->assertSame('400.00', $summary['profit_total']);
        $this->assertSame('40.00', $summary['margin_percent']);
        $this->assertSame('10.00', $summary['quantity_sold']);
    }

    public function test_product_scoped_summary_respects_date_and_customer_filters(): void
    {
        $user = User::factory()->create();
        $customerA = Customer::factory()->create();
        $customerB = Customer::factory()->create();
        $product = Product::factory()->create();
        $batch = Batch::query()->create(['product_id' => $product->id, 'barcode' => 'BC-P', 'manufacturing_date' => '2026-01-01', 'expiry_date' => '2027-01-01', 'cost_price' => '60.00', 'quantity_received' => '100', 'quantity_remaining' => '80']);

        $saleToday = Sale::query()->create(['invoice_number' => 'SL-1', 'customer_id' => $customerA->id, 'user_id' => $user->id, 'total_amount' => '1000.00', 'status' => 'completed']);
        SaleItem::query()->create(['sale_id' => $saleToday->id, 'batch_id' => $batch->id, 'quantity' => '10', 'unit_price' => '100.00', 'cost_price' => '60.00', 'line_total' => '1000.00']);

        $saleOtherCustomer = Sale::query()->create(['invoice_number' => 'SL-2', 'customer_id' => $customerB->id, 'user_id' => $user->id, 'total_amount' => '500.00', 'status' => 'completed']);
        SaleItem::query()->create(['sale_id' => $saleOtherCustomer->id, 'batch_id' => $batch->id, 'quantity' => '5', 'unit_price' => '100.00', 'cost_price' => '60.00', 'line_total' => '500.00']);

        $saleOld = Sale::query()->create(['invoice_number' => 'SL-3', 'customer_id' => $customerA->id, 'user_id' => $user->id, 'total_amount' => '9999.00', 'status' => 'completed']);
        $this->backdate($saleOld, Carbon::today()->subDays(10));
        SaleItem::query()->create(['sale_id' => $saleOld->id, 'batch_id' => $batch->id, 'quantity' => '1', 'unit_price' => '9999.00', 'cost_price' => '60.00', 'line_total' => '9999.00']);

        $byDate = app(SalesReportService::class)->summary(Carbon::today()->format('Y-m-d'), null, null, $product->id);
        $this->assertSame('1500.00', $byDate['sales_total']);

        $byCustomer = app(SalesReportService::class)->summary(Carbon::today()->format('Y-m-d'), null, $customerA->id, $product->id);
        $this->assertSame('1000.00', $byCustomer['sales_total']);
        $this->assertSame('10.00', $byCustomer['quantity_sold']);
    }
}
