<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\PayableType;
use App\Models\Bank;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleReturn;
use App\Models\User;
use App\Models\Vendor;
use App\Services\DashboardReportService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class DashboardReportServiceTest extends TestCase
{
    use RefreshDatabase;

    private function backdate(\Illuminate\Database\Eloquent\Model $model, Carbon $date): void
    {
        $model->forceFill(['created_at' => $date, 'updated_at' => $date])->save();
    }

    public function test_todays_summary_sums_only_todays_records_and_excludes_vendor_payments(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $vendor = Vendor::factory()->create();
        $bank = Bank::query()->create(['shop_id' => $user->shop_id, 'name' => 'HBL', 'account_number' => '123', 'is_active' => true]);
        $category = ExpenseCategory::query()->create(['shop_id' => $user->shop_id, 'name' => 'Rent']);
        $yesterday = Carbon::yesterday();

        $saleToday = Sale::query()->create(['shop_id' => $user->shop_id, 'invoice_number' => 'SL-1', 'user_id' => $user->id, 'total_amount' => '1000.00', 'status' => 'completed']);
        $saleYesterday = Sale::query()->create(['shop_id' => $user->shop_id, 'invoice_number' => 'SL-2', 'user_id' => $user->id, 'total_amount' => '500.00', 'status' => 'completed']);
        $this->backdate($saleYesterday, $yesterday);

        SaleReturn::query()->create(['shop_id' => $user->shop_id, 'sale_id' => $saleToday->id, 'customer_id' => null, 'reason' => 'damaged', 'total_amount' => '200.00', 'user_id' => $user->id]);

        Payment::query()->create(['shop_id' => $user->shop_id, 'payable_type' => PayableType::Sale->value, 'payable_id' => $saleToday->id, 'method' => 'cash', 'bank_id' => null, 'amount' => '600.00', 'user_id' => $user->id]);
        Payment::query()->create(['shop_id' => $user->shop_id, 'payable_type' => PayableType::Sale->value, 'payable_id' => $saleToday->id, 'method' => 'bank', 'bank_id' => $bank->id, 'amount' => '400.00', 'user_id' => $user->id]);

        Payment::query()->create(['shop_id' => $user->shop_id, 'payable_type' => PayableType::Customer->value, 'payable_id' => $customer->id, 'method' => 'cash', 'bank_id' => null, 'amount' => '300.00', 'user_id' => $user->id]);
        Payment::query()->create(['shop_id' => $user->shop_id, 'payable_type' => PayableType::Vendor->value, 'payable_id' => $vendor->id, 'method' => 'cash', 'bank_id' => null, 'amount' => '999.00', 'user_id' => $user->id]);

        $oldCustomerPayment = Payment::query()->create(['shop_id' => $user->shop_id, 'payable_type' => PayableType::Customer->value, 'payable_id' => $customer->id, 'method' => 'cash', 'bank_id' => null, 'amount' => '50.00', 'user_id' => $user->id]);
        $this->backdate($oldCustomerPayment, $yesterday);

        Expense::query()->create(['shop_id' => $user->shop_id, 'date' => today(), 'amount' => '150.00', 'expense_category_id' => $category->id, 'payment_method' => 'cash', 'user_id' => $user->id]);
        Expense::query()->create(['shop_id' => $user->shop_id, 'date' => $yesterday, 'amount' => '75.00', 'expense_category_id' => $category->id, 'payment_method' => 'cash', 'user_id' => $user->id]);

        $summary = app(DashboardReportService::class)->todaysSummary();

        $this->assertSame('1000.00', $summary['sales_total']);
        $this->assertSame('200.00', $summary['returns_total']);
        $this->assertSame('300.00', $summary['payment_ins_total']);
        $this->assertSame('150.00', $summary['expenses_total']);
        $this->assertSame('600.00', $summary['cash_total']);
        $this->assertSame('400.00', $summary['bank_total']);
        $this->assertCount(1, $summary['bank_breakdown']);
        $this->assertSame('HBL', $summary['bank_breakdown'][0]['name']);
        $this->assertSame('400.00', $summary['bank_breakdown'][0]['amount']);
    }

    public function test_todays_summary_is_all_zero_with_no_activity(): void
    {
        $summary = app(DashboardReportService::class)->todaysSummary();

        $this->assertSame('0.00', $summary['sales_total']);
        $this->assertSame('0.00', $summary['returns_total']);
        $this->assertSame('0.00', $summary['payment_ins_total']);
        $this->assertSame('0.00', $summary['expenses_total']);
        $this->assertSame('0.00', $summary['cash_total']);
        $this->assertSame('0.00', $summary['bank_total']);
        $this->assertSame([], $summary['bank_breakdown']);
    }

    public function test_sales_trend_zero_fills_days_with_no_sales_and_excludes_older_days(): void
    {
        $user = User::factory()->create();

        $saleToday = Sale::query()->create(['shop_id' => $user->shop_id, 'invoice_number' => 'SL-1', 'user_id' => $user->id, 'total_amount' => '300.00', 'status' => 'completed']);
        $saleTwoDaysAgo = Sale::query()->create(['shop_id' => $user->shop_id, 'invoice_number' => 'SL-2', 'user_id' => $user->id, 'total_amount' => '100.00', 'status' => 'completed']);
        $this->backdate($saleTwoDaysAgo, Carbon::today()->subDays(2));

        $saleOutsideWindow = Sale::query()->create(['shop_id' => $user->shop_id, 'invoice_number' => 'SL-3', 'user_id' => $user->id, 'total_amount' => '9999.00', 'status' => 'completed']);
        $this->backdate($saleOutsideWindow, Carbon::today()->subDays(10));

        $trend = app(DashboardReportService::class)->salesTrend(5);

        $this->assertCount(5, $trend);
        $this->assertSame('0.00', $trend[0]['total']);
        $this->assertSame('100.00', $trend[2]['total']);
        $this->assertSame('0.00', $trend[3]['total']);
        $this->assertSame('300.00', $trend[4]['total']);
    }

    public function test_cash_vs_bank_breakdown_aggregates_across_the_window(): void
    {
        $user = User::factory()->create();
        $bankA = Bank::query()->create(['shop_id' => $user->shop_id, 'name' => 'HBL', 'account_number' => '1', 'is_active' => true]);
        $bankB = Bank::query()->create(['shop_id' => $user->shop_id, 'name' => 'UBL', 'account_number' => '2', 'is_active' => true]);

        $saleToday = Sale::query()->create(['shop_id' => $user->shop_id, 'invoice_number' => 'SL-1', 'user_id' => $user->id, 'total_amount' => '500.00', 'status' => 'completed']);
        $saleYesterday = Sale::query()->create(['shop_id' => $user->shop_id, 'invoice_number' => 'SL-2', 'user_id' => $user->id, 'total_amount' => '200.00', 'status' => 'completed']);
        $this->backdate($saleYesterday, Carbon::yesterday());

        Payment::query()->create(['shop_id' => $user->shop_id, 'payable_type' => PayableType::Sale->value, 'payable_id' => $saleToday->id, 'method' => 'cash', 'bank_id' => null, 'amount' => '100.00', 'user_id' => $user->id]);
        Payment::query()->create(['shop_id' => $user->shop_id, 'payable_type' => PayableType::Sale->value, 'payable_id' => $saleToday->id, 'method' => 'bank', 'bank_id' => $bankA->id, 'amount' => '400.00', 'user_id' => $user->id]);

        $yesterdayCash = Payment::query()->create(['shop_id' => $user->shop_id, 'payable_type' => PayableType::Sale->value, 'payable_id' => $saleYesterday->id, 'method' => 'cash', 'bank_id' => null, 'amount' => '50.00', 'user_id' => $user->id]);
        $this->backdate($yesterdayCash, Carbon::yesterday());
        $yesterdayBank = Payment::query()->create(['shop_id' => $user->shop_id, 'payable_type' => PayableType::Sale->value, 'payable_id' => $saleYesterday->id, 'method' => 'bank', 'bank_id' => $bankB->id, 'amount' => '150.00', 'user_id' => $user->id]);
        $this->backdate($yesterdayBank, Carbon::yesterday());

        $breakdown = app(DashboardReportService::class)->cashVsBankBreakdown(30);

        $this->assertSame('150.00', $breakdown['cash']);
        $this->assertCount(2, $breakdown['banks']);

        $byName = collect($breakdown['banks'])->keyBy('name');
        $this->assertSame('400.00', $byName['HBL']['amount']);
        $this->assertSame('150.00', $byName['UBL']['amount']);
    }

    public function test_top_selling_products_ranks_by_quantity_sold_in_the_window(): void
    {
        $user = User::factory()->create();
        $productA = Product::factory()->create(['name' => 'Weedkiller']);
        $productB = Product::factory()->create(['name' => 'Insect Spray']);

        $batchA = Batch::query()->create(['shop_id' => $user->shop_id, 'product_id' => $productA->id, 'barcode' => 'BC-A', 'manufacturing_date' => '2026-01-01', 'expiry_date' => '2027-01-01', 'cost_price' => '10.00', 'quantity_received' => '100', 'quantity_remaining' => '80']);
        $batchB = Batch::query()->create(['shop_id' => $user->shop_id, 'product_id' => $productB->id, 'barcode' => 'BC-B', 'manufacturing_date' => '2026-01-01', 'expiry_date' => '2027-01-01', 'cost_price' => '10.00', 'quantity_received' => '100', 'quantity_remaining' => '95']);

        $saleToday = Sale::query()->create(['shop_id' => $user->shop_id, 'invoice_number' => 'SL-1', 'user_id' => $user->id, 'total_amount' => '0.00', 'status' => 'completed']);
        SaleItem::query()->create(['shop_id' => $user->shop_id, 'sale_id' => $saleToday->id, 'batch_id' => $batchA->id, 'quantity' => '20', 'unit_price' => '10.00', 'line_total' => '200.00']);
        SaleItem::query()->create(['shop_id' => $user->shop_id, 'sale_id' => $saleToday->id, 'batch_id' => $batchB->id, 'quantity' => '5', 'unit_price' => '10.00', 'line_total' => '50.00']);

        $saleOld = Sale::query()->create(['shop_id' => $user->shop_id, 'invoice_number' => 'SL-2', 'user_id' => $user->id, 'total_amount' => '0.00', 'status' => 'completed']);
        $this->backdate($saleOld, Carbon::today()->subDays(40));
        SaleItem::query()->create(['shop_id' => $user->shop_id, 'sale_id' => $saleOld->id, 'batch_id' => $batchB->id, 'quantity' => '999', 'unit_price' => '10.00', 'line_total' => '9990.00']);

        $top = app(DashboardReportService::class)->topSellingProducts(30, 8);

        $this->assertSame([
            ['name' => 'Weedkiller', 'quantity' => '20.00'],
            ['name' => 'Insect Spray', 'quantity' => '5.00'],
        ], $top);
    }
}
