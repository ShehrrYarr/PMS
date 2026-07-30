<?php

declare(strict_types=1);

namespace Tests\Feature\SuperAdmin;

use App\Livewire\SuperAdmin\ShopManager;
use App\Models\Shop;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class ShopManagerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A browser can carry both an active 'web' session and an active
     * 'super_admin' session at once (same cookie, different guard keys) —
     * the panel's per-shop user counts must not be narrowed by whichever
     * shop that 'web' session happens to belong to. See the fix in
     * ShopManager::render() (withoutGlobalScope('shop')).
     */
    public function test_user_counts_are_correct_even_with_a_concurrent_web_session(): void
    {
        $shopA = Shop::factory()->create();
        $shopB = Shop::factory()->create();
        User::factory()->count(3)->create(['shop_id' => $shopA->id]);
        User::factory()->count(1)->create(['shop_id' => $shopB->id]);

        $superAdmin = SuperAdmin::factory()->create();
        $webUser = User::factory()->create(['shop_id' => $shopB->id]);

        // Simulate a browser where the 'web' guard is also logged in
        // (e.g. the operator testing both roles in the same browser).
        Auth::guard('web')->login($webUser);

        $component = Livewire::actingAs($superAdmin, 'super_admin')->test(ShopManager::class);

        $component->assertSee($shopA->name)->assertSee($shopB->name);

        $shops = $component->viewData('shops')->keyBy('id');

        $this->assertSame(3, $shops[$shopA->id]->users_count);
        $this->assertSame(2, $shops[$shopB->id]->users_count);
    }

    public function test_super_admin_can_edit_a_shops_name_and_slug(): void
    {
        $shop = Shop::factory()->create(['name' => 'Old Name', 'slug' => 'old-slug']);
        $superAdmin = SuperAdmin::factory()->create();

        Livewire::actingAs($superAdmin, 'super_admin')
            ->test(ShopManager::class)
            ->call('edit', $shop->id)
            ->set('editName', 'New Name')
            ->set('editSlug', 'new-slug')
            ->call('saveEdit')
            ->assertHasNoErrors();

        $shop->refresh();

        $this->assertSame('New Name', $shop->name);
        $this->assertSame('new-slug', $shop->slug);
    }

    public function test_editing_a_shop_rejects_a_slug_already_used_by_another_shop(): void
    {
        Shop::factory()->create(['slug' => 'taken-slug']);
        $shop = Shop::factory()->create(['slug' => 'my-slug']);
        $superAdmin = SuperAdmin::factory()->create();

        Livewire::actingAs($superAdmin, 'super_admin')
            ->test(ShopManager::class)
            ->call('edit', $shop->id)
            ->set('editName', $shop->name)
            ->set('editSlug', 'taken-slug')
            ->call('saveEdit')
            ->assertHasErrors(['editSlug']);

        $this->assertSame('my-slug', $shop->fresh()->slug);
    }

    public function test_editing_a_shop_allows_keeping_its_own_slug_unchanged(): void
    {
        $shop = Shop::factory()->create(['name' => 'Same Shop', 'slug' => 'same-slug']);
        $superAdmin = SuperAdmin::factory()->create();

        Livewire::actingAs($superAdmin, 'super_admin')
            ->test(ShopManager::class)
            ->call('edit', $shop->id)
            ->set('editName', 'Same Shop Renamed')
            ->set('editSlug', 'same-slug')
            ->call('saveEdit')
            ->assertHasNoErrors();

        $this->assertSame('same-slug', $shop->fresh()->slug);
    }

    /**
     * "See a shop's password" isn't implementable (passwords are one-way
     * hashed) — the secure equivalent is issuing a fresh one, shown once,
     * which immediately replaces the old one.
     */
    public function test_super_admin_can_reset_a_shops_admin_password(): void
    {
        $shop = Shop::factory()->create();
        $admin = User::factory()->create(['shop_id' => $shop->id]);
        $admin->assignRole(\App\Enums\UserRole::Admin->value);
        $superAdmin = SuperAdmin::factory()->create();

        $component = Livewire::actingAs($superAdmin, 'super_admin')
            ->test(ShopManager::class)
            ->call('resetAdminPassword', $shop->id);

        $newPassword = $component->get('justCreatedTemporaryPassword');

        $this->assertNotEmpty($newPassword);
        $this->assertSame($admin->email, $component->get('justCreatedAdminEmail'));

        // Auth::attempt() (no explicit guard) would check the *default*
        // guard — Livewire::actingAs($superAdmin, 'super_admin') shifts that
        // default to 'super_admin' for the rest of this test, so the check
        // must target the 'web' guard explicitly.
        $this->assertTrue(Auth::guard('web')->attempt(['email' => $admin->email, 'password' => $newPassword]));
        $this->assertFalse(Auth::guard('web')->attempt(['email' => $admin->email, 'password' => 'password']));
    }
}
