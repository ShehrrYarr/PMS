<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Services\ShopService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        // Shop::factory() alone has no theme_settings row (only
        // ShopService::createShop() sets one up, matching how a real shop is
        // actually provisioned) — needed since the login page renders the
        // full layout, which requires ThemeSetting::current() to resolve.
        $shop = app(ShopService::class)->createShop('A Shop', 'An Admin', 'anadmin@example.com')['shop'];

        $response = $this->get('/'.$shop->slug.'/login');

        $response
            ->assertOk()
            ->assertSeeVolt('pages.auth.login');
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $component = Volt::test('pages.auth.login')
            ->set('form.email', $user->email)
            ->set('form.password', 'password');

        $component->call('login');

        $component
            ->assertHasNoErrors()
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $component = Volt::test('pages.auth.login')
            ->set('form.email', $user->email)
            ->set('form.password', 'wrong-password');

        $component->call('login');

        $component
            ->assertHasErrors()
            ->assertNoRedirect();

        $this->assertGuest();
    }

    public function test_navigation_menu_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get($this->shopPath($user, 'dashboard'));

        $response
            ->assertOk()
            ->assertSee(__('nav.app_name'));
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post($this->shopPath($user, 'logout'));

        $response->assertRedirect($this->shopPath($user, 'login'));

        $this->assertGuest();
    }
}
