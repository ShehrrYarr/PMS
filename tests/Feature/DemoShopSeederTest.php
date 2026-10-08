<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Bank;
use App\Models\Banner;
use App\Models\Batch;
use App\Models\Category;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerLedger;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\ThemeSetting;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Database\Seeders\DemoShopSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DemoShopSeederTest extends TestCase
{
    use RefreshDatabase;

    private Shop $demo;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        // The seeded "Demo Shop" (with its Admin) is the demo for these tests.
        $this->demo = Shop::query()->oldest('id')->firstOrFail();
        $this->demo->update(['is_demo' => true]);
    }

    private function seedDemo(int $days = 6): array
    {
        $seeder = app(DemoShopSeeder::class);
        $seeder->days = $days;

        return $seeder->seed($this->demo);
    }

    public function test_it_seeds_a_complete_demo_shop_with_images_and_branding(): void
    {
        $this->seedDemo();
        $shopId = $this->demo->id;

        $this->assertSame(40, Product::query()->where('shop_id', $shopId)->count());
        $this->assertSame(6, Category::query()->where('shop_id', $shopId)->count());
        $this->assertSame(8, Company::query()->where('shop_id', $shopId)->count());
        $this->assertSame(6, Vendor::query()->where('shop_id', $shopId)->count());
        $this->assertSame(25, Customer::query()->where('shop_id', $shopId)->count());
        $this->assertSame(3, Bank::query()->where('shop_id', $shopId)->count());
        $this->assertGreaterThan(0, Purchase::query()->where('shop_id', $shopId)->count());
        $this->assertGreaterThan(10, Sale::query()->where('shop_id', $shopId)->count());

        foreach (Product::query()->where('shop_id', $shopId)->pluck('image_path') as $path) {
            Storage::disk('public')->assertExists($path);
        }

        $theme = ThemeSetting::query()->where('shop_id', $shopId)->firstOrFail();
        $this->assertSame('Kissan Agro Traders', $theme->shop_name);
        Storage::disk('public')->assertExists($theme->logo_path);

        $banners = Banner::query()->where('shop_id', $shopId)->pluck('image_path');
        $this->assertCount(3, $banners);
        foreach ($banners as $path) {
            Storage::disk('public')->assertExists($path);
        }

        $staff = User::query()->where('shop_id', $shopId)->where('email', 'like', '%@kissan-demo.test')->get();
        $this->assertCount(4, $staff);
        $this->assertTrue($staff->firstWhere('name', 'Ali Raza')->hasRole('Salesman'));
    }

    /** Everything went through the real services, so the books must balance. */
    public function test_the_seeded_books_reconcile(): void
    {
        $this->seedDemo();
        $shopId = $this->demo->id;

        $this->assertSame(0, Batch::query()->where('shop_id', $shopId)->where('quantity_remaining', '<', 0)->count());

        foreach (Customer::query()->where('shop_id', $shopId)->get() as $customer) {
            $entries = CustomerLedger::query()->where('customer_id', $customer->id);
            $expected = bcsub((string) (clone $entries)->sum('debit'), (string) (clone $entries)->sum('credit'), 2);
            $this->assertSame($expected, bcadd($customer->currentBalance(), '0', 2), "Ledger of {$customer->name}");
        }

        foreach (Vendor::query()->where('shop_id', $shopId)->get() as $vendor) {
            $entries = VendorLedger::query()->where('vendor_id', $vendor->id);
            $expected = bcsub((string) (clone $entries)->sum('credit'), (string) (clone $entries)->sum('debit'), 2);
            $this->assertSame($expected, bcadd($vendor->currentBalance(), '0', 2), "Ledger of {$vendor->name}");
        }

        foreach (Sale::query()->where('shop_id', $shopId)->get() as $sale) {
            $paid = (string) Payment::query()->where('payable_type', 'sale')->where('payable_id', $sale->id)->sum('amount');
            $this->assertSame(0, bccomp($paid, (string) $sale->total_amount, 2), "Payments of {$sale->invoice_number}");
        }

        // Back-dated across the window, never into the future.
        $this->assertLessThanOrEqual(Carbon::now(), Sale::query()->where('shop_id', $shopId)->max('created_at'));
        $this->assertGreaterThanOrEqual(Carbon::now()->subDays(7)->startOfDay(), Sale::query()->where('shop_id', $shopId)->min('created_at'));
    }

    public function test_reseeding_replaces_the_data_instead_of_duplicating_it(): void
    {
        $this->seedDemo(3);

        // Something a visitor left behind, with an uploaded photo.
        $leftover = Product::query()->create([
            'shop_id' => $this->demo->id, 'name' => 'Visitor Product', 'sku' => 'VISIT-9', 'unit' => 'Bottle',
            'default_sale_price' => '100', 'is_active' => true, 'image_path' => "products/{$this->demo->id}/visitor.webp",
        ]);
        Storage::disk('public')->put($leftover->image_path, 'x');

        $this->seedDemo(3);

        $this->assertSame(40, Product::query()->where('shop_id', $this->demo->id)->count());
        $this->assertFalse(Product::query()->whereKey($leftover->id)->exists());
        Storage::disk('public')->assertMissing("products/{$this->demo->id}/visitor.webp");
        $this->assertSame(4, User::query()->where('email', 'like', '%@kissan-demo.test')->count());
    }

    public function test_other_shops_are_never_touched(): void
    {
        $other = Shop::factory()->create();
        $theirs = Product::query()->create([
            'shop_id' => $other->id, 'name' => 'Not Demo', 'sku' => 'OTHER-77', 'unit' => 'Bag',
            'default_sale_price' => '100', 'is_active' => true,
        ]);

        $this->seedDemo(3);

        $this->assertTrue(Product::query()->whereKey($theirs->id)->exists());
    }

    public function test_the_command_seeds_the_demo_shop(): void
    {
        $this->artisan('app:seed-demo-shop', ['--days' => 2, '--force' => true])->assertSuccessful();

        $this->assertSame(40, Product::query()->where('shop_id', $this->demo->id)->count());
    }

    public function test_the_command_asks_first_and_cancelling_changes_nothing(): void
    {
        $this->artisan('app:seed-demo-shop', ['--days' => 2])
            ->expectsConfirmation("This deletes ALL business data in \"{$this->demo->name}\" and loads the demo dataset. Continue?", 'no')
            ->assertSuccessful();

        $this->assertSame(0, Product::query()->where('shop_id', $this->demo->id)->count());
    }

    public function test_the_command_fails_without_a_demo_shop(): void
    {
        $this->demo->update(['is_demo' => false]);

        $this->artisan('app:seed-demo-shop', ['--force' => true])->assertFailed();
    }

    /** The demo now keeps its data: nothing may wipe it on a timer. */
    public function test_nothing_resets_the_demo_shop_on_a_schedule(): void
    {
        // The expiry check proves the schedule really loaded, so the
        // absence of any demo-shop job isn't just an empty list.
        $this->artisan('schedule:list')
            ->expectsOutputToContain('app:check-expiring-batches')
            ->doesntExpectOutputToContain('demo-shop')
            ->assertSuccessful();
    }
}
