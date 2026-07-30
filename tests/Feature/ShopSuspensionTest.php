<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

/**
 * A suspended shop (Shop::is_active = false) must block new logins and kick
 * an already-authenticated session on its very next request — see
 * app/Livewire/Forms/LoginForm.php and app/Http/Middleware/EnsureShopIsActive.php.
 */
class ShopSuspensionTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_is_blocked_for_a_suspended_shops_user(): void
    {
        $user = User::factory()->create();
        $user->shop->update(['is_active' => false]);

        $component = Volt::test('pages.auth.login')
            ->set('form.email', $user->email)
            ->set('form.password', 'password');

        $component->call('login');

        $component->assertHasErrors('form.email');
        $this->assertGuest();
    }

    public function test_an_active_session_is_kicked_the_moment_its_shop_is_suspended(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get($this->shopPath($user, 'dashboard'))->assertOk();

        $user->shop->update(['is_active' => false]);

        $response = $this->get($this->shopPath($user, 'dashboard'));

        $response->assertRedirect($this->shopPath($user, 'login'));
        $this->assertGuest();
    }

    public function test_an_active_shops_user_is_unaffected(): void
    {
        $user = User::factory()->create();

        $component = Volt::test('pages.auth.login')
            ->set('form.email', $user->email)
            ->set('form.password', 'password');

        $component->call('login');

        $component->assertHasNoErrors();
        $this->assertAuthenticatedAs($user);
    }
}
