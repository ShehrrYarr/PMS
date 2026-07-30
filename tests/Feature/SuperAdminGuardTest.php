<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Shop;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

/**
 * The 'web' and 'super_admin' guards are completely separate (see
 * config/auth.php) — this verifies neither identity can reach the other's
 * routes or log in through the other's form.
 */
class SuperAdminGuardTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_shop_user_cannot_reach_the_control_panel(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')->get('/control-panel');

        $response->assertRedirect(route('control-panel.login'));
    }

    public function test_a_super_admin_cannot_reach_shop_routes(): void
    {
        $shop = Shop::factory()->create();
        $superAdmin = SuperAdmin::factory()->create();

        $response = $this->actingAs($superAdmin, 'super_admin')->get('/'.$shop->slug.'/dashboard');

        $response->assertRedirect('/'.$shop->slug.'/login');
    }

    public function test_control_panel_login_rejects_shop_user_credentials(): void
    {
        $user = User::factory()->create();

        $component = Volt::test('pages.auth.super-admin-login')
            ->set('form.email', $user->email)
            ->set('form.password', 'password');

        $component->call('login');

        $component->assertHasErrors();
        $this->assertGuest('super_admin');
    }

    public function test_regular_login_rejects_super_admin_credentials(): void
    {
        $superAdmin = SuperAdmin::factory()->create();

        $component = Volt::test('pages.auth.login')
            ->set('form.email', $superAdmin->email)
            ->set('form.password', 'password');

        $component->call('login');

        $component->assertHasErrors();
        $this->assertGuest('web');
    }

    public function test_a_super_admin_can_log_in_through_the_control_panel(): void
    {
        $superAdmin = SuperAdmin::factory()->create();

        $component = Volt::test('pages.auth.super-admin-login')
            ->set('form.email', $superAdmin->email)
            ->set('form.password', 'password');

        $component->call('login');

        $component->assertHasNoErrors();
        $this->assertAuthenticatedAs($superAdmin, 'super_admin');
    }
}
