<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\PayableType;
use App\Enums\PaymentMethod;
use App\Models\Batch;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ReceiptSetting;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Shop;
use App\Models\ThemeSetting;
use App\Models\Vendor;
use App\Services\DemoShopResetService;
use App\Services\ShopService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemoShopResetServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TestCase::$seed already produced a "Demo Shop" flagged is_demo — clear
     * that so each test's own shop is unambiguously the only demo shop.
     */
    private function clearSeededDemoFlag(): void
    {
        Shop::query()->where('is_demo', true)->update(['is_demo' => false]);
    }

    public function test_reset_wipes_business_data_but_preserves_the_shop_users_and_settings(): void
    {
        $this->clearSeededDemoFlag();

        $result = app(ShopService::class)->createShop('Public Demo', 'Demo Admin', 'demo-admin@example.com');
        $shop = $result['shop'];
        $shop->update(['is_demo' => true]);

        $customer = Customer::factory()->create(['shop_id' => $shop->id]);
        $vendor = Vendor::factory()->create(['shop_id' => $shop->id]);
        $product = Product::factory()->create(['shop_id' => $shop->id]);

        $batch = Batch::query()->create([
            'shop_id' => $shop->id,
            'product_id' => $product->id,
            'barcode' => 'BC-DEMO-RESET-1',
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '60.00',
            'quantity_received' => '100',
            'quantity_remaining' => '90',
        ]);

        $sale = Sale::query()->create([
            'shop_id' => $shop->id,
            'invoice_number' => 'SL-DEMO-RESET-1',
            'customer_id' => $customer->id,
            'user_id' => $result['admin']->id,
            'total_amount' => '1000.00',
            'status' => 'completed',
        ]);

        SaleItem::query()->create([
            'shop_id' => $shop->id,
            'sale_id' => $sale->id,
            'batch_id' => $batch->id,
            'quantity' => '10',
            'unit_price' => '100.00',
            'cost_price' => '60.00',
            'line_total' => '1000.00',
        ]);

        Payment::query()->create([
            'shop_id' => $shop->id,
            'payable_type' => PayableType::Sale->value,
            'payable_id' => $sale->id,
            'method' => PaymentMethod::Cash->value,
            'amount' => '1000.00',
            'user_id' => $result['admin']->id,
        ]);

        app(DemoShopResetService::class)->reset();

        $this->assertSame(0, Sale::where('shop_id', $shop->id)->count());
        $this->assertSame(0, SaleItem::where('shop_id', $shop->id)->count());
        $this->assertSame(0, Payment::where('shop_id', $shop->id)->count());
        $this->assertSame(0, Batch::where('shop_id', $shop->id)->count());
        $this->assertSame(0, Product::where('shop_id', $shop->id)->count());
        $this->assertSame(0, Customer::where('shop_id', $shop->id)->count());
        $this->assertSame(0, Vendor::where('shop_id', $shop->id)->count());

        $this->assertTrue($shop->fresh()->exists());
        $this->assertNotNull($result['admin']->fresh());
        $this->assertNotNull(ThemeSetting::withoutGlobalScope('shop')->where('shop_id', $shop->id)->first());
        $this->assertNotNull(ReceiptSetting::withoutGlobalScope('shop')->where('shop_id', $shop->id)->first());

        $this->assertEqualsCanonicalizing(
            ['Insecticide', 'Herbicide', 'Fungicide', 'Rodenticide'],
            Category::where('shop_id', $shop->id)->pluck('name')->all(),
        );
    }

    public function test_reset_is_a_no_op_when_no_shop_is_flagged_as_the_demo(): void
    {
        $this->clearSeededDemoFlag();

        $result = app(ShopService::class)->createShop('Regular Shop', 'Admin', 'regular-admin@example.com');
        Customer::factory()->create(['shop_id' => $result['shop']->id]);

        app(DemoShopResetService::class)->reset();

        $this->assertSame(1, Customer::where('shop_id', $result['shop']->id)->count());
    }
}
