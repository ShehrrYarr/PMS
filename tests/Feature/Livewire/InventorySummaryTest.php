<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Enums\UserRole;
use App\Livewire\Inventory\InventorySummary;
use App\Models\Product;
use App\Models\User;
use App\Services\BarcodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class InventorySummaryTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->assignRole(UserRole::Admin->value);

        return $user;
    }

    private function addBatch(Product $product, string $received): void
    {
        app(BarcodeService::class)->createBatchWithBarcode([
            'shop_id' => $product->shop_id,
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '100.00',
            'quantity_received' => $received,
            'quantity_remaining' => $received,
        ]);
    }

    public function test_it_aggregates_batch_count_and_quantities_per_product(): void
    {
        $user = $this->admin();
        $product = Product::factory()->create(['shop_id' => $user->shop_id, 'name' => 'Aggregated Product']);
        $this->addBatch($product, '20');
        $this->addBatch($product, '30');

        $component = Livewire::actingAs($user)->test(InventorySummary::class);

        $row = $component->viewData('products')->firstWhere('id', $product->id);

        $this->assertSame(2, $row->batches_count);
        $this->assertSame('50.00', $row->batches_sum_quantity_remaining);
        $this->assertSame('50.00', $row->batches_sum_quantity_received);
    }

    public function test_it_reflects_a_partial_sale_in_the_remaining_total_but_not_received(): void
    {
        $user = $this->admin();
        $product = Product::factory()->create(['shop_id' => $user->shop_id]);
        $this->addBatch($product, '20');

        $batch = $product->batches()->first();
        $batch->update(['quantity_remaining' => '12']);

        $component = Livewire::actingAs($user)->test(InventorySummary::class);
        $row = $component->viewData('products')->firstWhere('id', $product->id);

        $this->assertSame('12.00', $row->batches_sum_quantity_remaining);
        $this->assertSame('20.00', $row->batches_sum_quantity_received);
    }

    public function test_search_filters_by_name(): void
    {
        $user = $this->admin();
        Product::factory()->create(['shop_id' => $user->shop_id, 'name' => 'Findable Pesticide']);
        Product::factory()->create(['shop_id' => $user->shop_id, 'name' => 'Other Product']);

        Livewire::actingAs($user)
            ->test(InventorySummary::class)
            ->set('search', 'Findable')
            ->assertSee('Findable Pesticide')
            ->assertDontSee('Other Product');
    }

    public function test_a_user_without_batches_view_is_forbidden(): void
    {
        // No role assigned at all, so no permissions — the route's own
        // 'can:batches.view' middleware is the actual authorization
        // boundary here (the component has no mount()-level check), so
        // this must go through the real route rather than Livewire::test().
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')->get(route('inventory.index', ['shop' => $user->shop->slug]));

        $response->assertForbidden();
    }

    public function test_a_salesman_can_reach_it(): void
    {
        $user = User::factory()->create();
        $user->assignRole(UserRole::Salesman->value);

        $response = $this->actingAs($user, 'web')->get(route('inventory.index', ['shop' => $user->shop->slug]));

        $response->assertOk();
    }
}
