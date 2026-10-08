<?php

declare(strict_types=1);

namespace Tests\Feature\Pos;

use App\Enums\UserRole;
use App\Livewire\Pos\Pos;
use App\Models\Batch;
use App\Models\Category;
use App\Models\PosDevice;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\User;
use App\Services\BarcodeService;
use App\Services\OfflineDataService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * The product-grid POS: the catalogue the grid is built from, and the
 * batch pop-up's addBatch() / the search box's scanBarcode() entry points.
 */
class PosGridTest extends TestCase
{
    use RefreshDatabase;

    private function userWithRole(UserRole $role, ?Shop $shop = null): User
    {
        $user = User::factory()->create($shop !== null ? ['shop_id' => $shop->id] : []);
        $user->assignRole($role->value);

        return $user;
    }

    private function makeBatch(Product $product, string $quantity, string $expiry, string $cost = '400.00'): Batch
    {
        return app(BarcodeService::class)->createBatchWithBarcode([
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => $expiry,
            'cost_price' => $cost,
            'quantity_received' => $quantity,
            'quantity_remaining' => $quantity,
        ]);
    }

    /**
     * Calls catalog() the way the browser does — through a Livewire request —
     * and hands back what it returned.
     *
     * @return array<string, mixed>
     */
    private function catalogFor(User $user): array
    {
        $catalog = null;

        Livewire::actingAs($user)
            ->test(Pos::class)
            ->call('catalog')
            ->assertReturned(function ($data) use (&$catalog) {
                $catalog = $data;

                return is_array($data);
            });

        return $catalog;
    }

    // ---- catalog() ---------------------------------------------------------

    public function test_the_catalog_lists_active_products_and_only_sellable_batches_earliest_expiry_first(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);
        $category = Category::factory()->create(['name' => 'Insecticide Test']);
        $product = Product::factory()->create(['name' => 'Karate', 'category_id' => $category->id]);
        $later = $this->makeBatch($product, '5', '2028-06-01');
        $sooner = $this->makeBatch($product, '3', '2027-01-01');
        $soldOut = $this->makeBatch($product, '0', '2026-12-01');
        $outOfStockProduct = Product::factory()->create(['name' => 'Empty Shelf']);
        Product::factory()->create(['name' => 'Retired', 'is_active' => false]);

        $catalog = $this->catalogFor($salesman);

        $productNames = array_column($catalog['products'], 'name');
        $this->assertContains('Karate', $productNames);
        // Out-of-stock products stay in the grid (shown greyed out)...
        $this->assertContains('Empty Shelf', $productNames);
        // ...but inactive ones don't appear at all.
        $this->assertNotContains('Retired', $productNames);

        $karateBatchIds = array_column(
            array_values(array_filter($catalog['batches'], fn (array $batch) => $batch['product_id'] === $product->id)),
            'id',
        );
        $this->assertSame([$sooner->id, $later->id], $karateBatchIds);
        $this->assertNotContains($soldOut->id, array_column($catalog['batches'], 'id'));

        $karate = collect($catalog['products'])->firstWhere('id', $product->id);
        $this->assertSame($category->id, $karate['category_id']);
        $this->assertNull($karate['image_url']);
        $this->assertContains($category->id, array_column($catalog['categories'], 'id'));
        $this->assertNotNull(collect($catalog['products'])->firstWhere('id', $outOfStockProduct->id));
    }

    public function test_cost_price_is_only_sent_to_users_allowed_to_see_it(): void
    {
        $product = Product::factory()->create();
        $this->makeBatch($product, '5', '2028-01-01', '412.50');

        $salesmanCatalog = $this->catalogFor($this->userWithRole(UserRole::Salesman));

        $this->assertArrayNotHasKey('cost_price', $salesmanCatalog['batches'][0]);

        $adminCatalog = $this->catalogFor($this->userWithRole(UserRole::Admin));

        $this->assertSame('412.50', $adminCatalog['batches'][0]['cost_price']);
    }

    public function test_the_catalog_never_includes_another_shops_products(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);
        $otherShop = Shop::factory()->create();
        $foreign = Product::query()->create([
            'shop_id' => $otherShop->id,
            'name' => 'Other Shop Product',
            'sku' => 'OTHER-1',
            'unit' => 'Bottle',
            'default_sale_price' => '100',
            'is_active' => true,
        ]);
        $this->makeBatch($foreign, '5', '2028-01-01');

        $catalog = $this->catalogFor($salesman);

        $this->assertNotContains($foreign->id, array_column($catalog['products'], 'id'));
        $this->assertNotContains($foreign->id, array_column($catalog['batches'], 'product_id'));
    }

    public function test_the_offline_snapshot_carries_the_same_catalog_without_cost_for_a_salesman(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);
        $product = Product::factory()->create(['name' => 'Snapshot Product']);
        $this->makeBatch($product, '5', '2028-01-01');
        $this->actingAs($salesman);

        $device = PosDevice::query()->create(['shop_id' => $salesman->shop_id, 'user_id' => $salesman->id]);
        $snapshot = app(OfflineDataService::class)->snapshotFor($salesman, $device);

        $this->assertContains('Snapshot Product', array_column($snapshot['products'], 'name'));
        $this->assertArrayHasKey('categories', $snapshot);
        $this->assertArrayHasKey('companies', $snapshot);
        $this->assertSame($product->id, $snapshot['batches'][0]['product_id']);
        $this->assertArrayHasKey('manufacturing_date', $snapshot['batches'][0]);
        $this->assertArrayNotHasKey('cost_price', $snapshot['batches'][0]);
    }

    // ---- addBatch() (the batch pop-up) ---------------------------------------

    public function test_add_batch_puts_the_chosen_quantity_in_the_cart(): void
    {
        $product = Product::factory()->create(['name' => 'Confidor', 'default_sale_price' => '650.00']);
        $batch = $this->makeBatch($product, '10', '2028-01-01');

        $component = Livewire::actingAs($this->userWithRole(UserRole::Salesman))
            ->test(Pos::class)
            ->call('addBatch', $batch->id, '3')
            ->assertReturned(fn (array $result) => $result['ok'] === true);

        $line = $component->get('cart')[0];
        $this->assertSame($batch->id, $line['batch_id']);
        $this->assertSame('3', $line['quantity']);
        $this->assertSame('650.00', $line['unit_price']);
        $this->assertSame('Confidor', $line['product_name']);
        $this->assertSame('2028-01-01', $line['expiry_date']);
    }

    public function test_adding_the_same_batch_again_merges_into_one_line(): void
    {
        $batch = $this->makeBatch(Product::factory()->create(), '10', '2028-01-01');

        $component = Livewire::actingAs($this->userWithRole(UserRole::Salesman))
            ->test(Pos::class)
            ->call('addBatch', $batch->id, '3')
            ->call('addBatch', $batch->id, '2');

        $this->assertCount(1, $component->get('cart'));
        $this->assertSame('5', $component->get('cart')[0]['quantity']);
    }

    public function test_add_batch_refuses_more_than_the_batch_has_left(): void
    {
        $batch = $this->makeBatch(Product::factory()->create(), '4', '2028-01-01');

        $component = Livewire::actingAs($this->userWithRole(UserRole::Salesman))
            ->test(Pos::class)
            ->call('addBatch', $batch->id, '5')
            ->assertReturned(fn (array $result) => $result['ok'] === false && str_contains($result['message'], '4'));

        $this->assertSame([], $component->get('cart'));

        // Counts what's already in the cart, too.
        $component
            ->call('addBatch', $batch->id, '3')
            ->call('addBatch', $batch->id, '2')
            ->assertReturned(fn (array $result) => $result['ok'] === false);

        $this->assertSame('3', $component->get('cart')[0]['quantity']);
    }

    public function test_add_batch_rejects_a_quantity_that_is_not_a_positive_whole_number(): void
    {
        $batch = $this->makeBatch(Product::factory()->create(), '10', '2028-01-01');
        $component = Livewire::actingAs($this->userWithRole(UserRole::Salesman))->test(Pos::class);

        foreach (['0', '-2', '1.5', 'abc', ''] as $quantity) {
            $component
                ->call('addBatch', $batch->id, $quantity)
                ->assertReturned(fn (array $result) => $result['ok'] === false && $result['message'] === __('pos.invalid_quantity'));
        }

        $this->assertSame([], $component->get('cart'));
    }

    public function test_add_batch_cannot_reach_another_shops_batch(): void
    {
        $otherShop = Shop::factory()->create();
        $foreign = Product::query()->create([
            'shop_id' => $otherShop->id,
            'name' => 'Foreign',
            'sku' => 'FOREIGN-1',
            'unit' => 'Bottle',
            'default_sale_price' => '100',
            'is_active' => true,
        ]);
        $foreignBatch = $this->makeBatch($foreign, '10', '2028-01-01');

        $component = Livewire::actingAs($this->userWithRole(UserRole::Salesman))
            ->test(Pos::class)
            ->call('addBatch', $foreignBatch->id, '1')
            ->assertReturned(fn (array $result) => $result['ok'] === false && $result['message'] === __('pos.batch_unavailable'));

        $this->assertSame([], $component->get('cart'));
    }

    public function test_an_expired_batch_can_still_be_added_from_the_pop_up(): void
    {
        $batch = $this->makeBatch(Product::factory()->create(), '10', now()->subDays(3)->toDateString());

        $component = Livewire::actingAs($this->userWithRole(UserRole::Salesman))
            ->test(Pos::class)
            ->call('addBatch', $batch->id, '1')
            ->assertReturned(fn (array $result) => $result['ok'] === true);

        $this->assertCount(1, $component->get('cart'));
    }

    // ---- scanBarcode() (the search box) --------------------------------------

    public function test_scanning_an_expired_batch_adds_it_with_a_warning(): void
    {
        $batch = $this->makeBatch(Product::factory()->create(), '10', now()->subDays(3)->toDateString());

        $component = Livewire::actingAs($this->userWithRole(UserRole::Salesman))
            ->test(Pos::class)
            ->call('scanBarcode', $batch->barcode)
            ->assertReturned(fn (array $result) => $result['ok'] === true && $result['warning'] !== null);

        $this->assertNotNull($component->get('scanWarning'));
        $this->assertCount(1, $component->get('cart'));
    }

    public function test_scanning_an_unknown_barcode_reports_it(): void
    {
        Livewire::actingAs($this->userWithRole(UserRole::Salesman))
            ->test(Pos::class)
            ->call('scanBarcode', 'NOPE-123')
            ->assertReturned(fn (array $result) => $result['ok'] === false && str_contains($result['message'], 'NOPE-123'))
            ->assertSet('cart', []);
    }

    /**
     * Regression: quantities used to be stored as '2.00' after a repeat scan
     * or a "+" press, and checkout's integer rule then rejected the sale.
     */
    public function test_a_repeat_scan_and_increment_still_check_out(): void
    {
        $batch = $this->makeBatch(Product::factory()->create(['default_sale_price' => '100.00']), '10', '2028-01-01');

        $component = Livewire::actingAs($this->userWithRole(UserRole::Salesman))
            ->test(Pos::class)
            ->call('scanBarcode', $batch->barcode)
            ->call('scanBarcode', $batch->barcode)
            ->call('incrementQuantity', 0);

        $this->assertSame('3', $component->get('cart')[0]['quantity']);

        $component
            ->set('paymentLines', [['method' => 'cash', 'amount' => '300.00', 'bank_id' => null]])
            ->call('checkout')
            ->assertHasNoErrors();

        $this->assertSame(1, Sale::query()->count());
        $this->assertSame('7.00', $batch->fresh()->quantity_remaining);
    }

    public function test_the_property_bound_scan_path_still_works(): void
    {
        $batch = $this->makeBatch(Product::factory()->create(), '10', '2028-01-01');

        Livewire::actingAs($this->userWithRole(UserRole::Salesman))
            ->test(Pos::class)
            ->set('barcodeInput', $batch->barcode)
            ->call('scanBarcode')
            ->assertSet('barcodeInput', '')
            ->assertCount('cart', 1);
    }

    public function test_the_admin_role_is_granted_cost_prices_view(): void
    {
        $this->assertTrue($this->userWithRole(UserRole::Admin)->can('cost-prices.view'));
        $this->assertFalse($this->userWithRole(UserRole::Salesman)->can('cost-prices.view'));
        $this->assertFalse($this->userWithRole(UserRole::Accountant)->can('cost-prices.view'));
    }
}
