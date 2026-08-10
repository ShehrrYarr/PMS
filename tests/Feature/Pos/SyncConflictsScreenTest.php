<?php

declare(strict_types=1);

namespace Tests\Feature\Pos;

use App\Enums\UserRole;
use App\Livewire\Pos\SyncConflicts;
use App\Models\Batch;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleSyncConflict;
use App\Models\User;
use App\Services\BarcodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SyncConflictsScreenTest extends TestCase
{
    use RefreshDatabase;

    private function userWithRole(UserRole $role): User
    {
        $user = User::factory()->create();
        $user->assignRole($role->value);

        return $user;
    }

    private function makeConflict(User $user): SaleSyncConflict
    {
        $product = Product::factory()->create(['shop_id' => $user->shop_id]);
        $batch = app(BarcodeService::class)->createBatchWithBarcode([
            'shop_id' => $user->shop_id,
            'product_id' => $product->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '60.00',
            'quantity_received' => '10',
            'quantity_remaining' => '-2',
        ]);

        $sale = Sale::query()->create([
            'shop_id' => $user->shop_id,
            'invoice_number' => 'SL-OFF1-0001',
            'client_uuid' => (string) \Illuminate\Support\Str::uuid(),
            'user_id' => $user->id,
            'total_amount' => '4000.00',
            'status' => 'completed',
        ]);

        return SaleSyncConflict::query()->create([
            'shop_id' => $user->shop_id,
            'sale_id' => $sale->id,
            'batch_id' => $batch->id,
            'requested_quantity' => '5.00',
            'available_quantity' => '3.00',
            'shortfall' => '2.00',
        ]);
    }

    public function test_an_admin_can_see_and_resolve_a_conflict(): void
    {
        $admin = $this->userWithRole(UserRole::Admin);
        $conflict = $this->makeConflict($admin);

        Livewire::actingAs($admin)
            ->test(SyncConflicts::class)
            ->assertSee('SL-OFF1-0001')
            ->call('resolve', $conflict->id);

        $conflict->refresh();
        $this->assertNotNull($conflict->resolved_at);
        $this->assertSame($admin->id, $conflict->resolved_by);
    }

    public function test_resolved_conflicts_are_hidden_until_asked_for(): void
    {
        $admin = $this->userWithRole(UserRole::Admin);
        $conflict = $this->makeConflict($admin);

        $component = Livewire::actingAs($admin)->test(SyncConflicts::class);

        $component->call('resolve', $conflict->id);
        $this->assertSame(0, $component->viewData('conflicts')->total());

        $component->set('showResolved', true);
        $this->assertSame(1, $component->viewData('conflicts')->total());
    }

    public function test_resolving_twice_does_not_reassign_the_reviewer(): void
    {
        $admin = $this->userWithRole(UserRole::Admin);
        $other = $this->userWithRole(UserRole::Admin);
        $conflict = $this->makeConflict($admin);

        Livewire::actingAs($admin)->test(SyncConflicts::class)->call('resolve', $conflict->id);
        $firstResolver = $conflict->fresh()->resolved_by;

        Livewire::actingAs($other)->test(SyncConflicts::class)->call('resolve', $conflict->id);

        $this->assertSame($firstResolver, $conflict->fresh()->resolved_by);
    }

    public function test_non_admin_roles_cannot_reach_the_conflicts_screen(): void
    {
        foreach ([UserRole::Salesman, UserRole::Accountant, UserRole::InventoryManager] as $role) {
            $user = $this->userWithRole($role);

            $this->actingAs($user)
                ->get($this->shopPath($user, 'sync-conflicts'))
                ->assertForbidden();
        }
    }

    public function test_an_admin_can_reach_the_conflicts_screen(): void
    {
        $admin = $this->userWithRole(UserRole::Admin);

        $this->actingAs($admin)
            ->get($this->shopPath($admin, 'sync-conflicts'))
            ->assertOk();
    }
}
