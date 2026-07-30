<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Shop;
use App\Models\ThemeSetting;
use App\Models\User;
use App\Services\ShopService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Every shop gets its own URL (/{shop-slug}/...) — see
 * App\Http\Middleware\ResolveShopFromSlug and routes/web.php's {shop} group.
 */
class PerShopUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_shops_slug_is_auto_generated_from_its_name(): void
    {
        $result = app(ShopService::class)->createShop('Acme Pesticides', 'Admin One', 'admin1@example.com');

        $this->assertSame('acme-pesticides', $result['shop']->slug);
    }

    public function test_a_colliding_shop_name_gets_a_unique_suffixed_slug(): void
    {
        app(ShopService::class)->createShop('Acme Pesticides', 'Admin One', 'admin1@example.com');
        $second = app(ShopService::class)->createShop('Acme Pesticides', 'Admin Two', 'admin2@example.com');

        $this->assertSame('acme-pesticides-2', $second['shop']->slug);
    }

    public function test_visiting_another_shops_url_while_logged_in_is_forbidden(): void
    {
        $shopA = Shop::factory()->create();
        $shopB = Shop::factory()->create();
        $userA = User::factory()->create(['shop_id' => $shopA->id]);

        $this->actingAs($userA)->get('/'.$shopB->slug.'/dashboard')->assertForbidden();
    }

    public function test_visiting_your_own_shops_url_works_normally(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get($this->shopPath($user, 'dashboard'))->assertOk();
    }

    public function test_the_bare_shop_url_redirects_a_guest_to_that_shops_login(): void
    {
        $shop = Shop::factory()->create();

        $this->get('/'.$shop->slug)->assertRedirect('/'.$shop->slug.'/login');
    }

    public function test_the_bare_shop_url_redirects_an_authenticated_user_to_their_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get($this->shopPath($user))
            ->assertRedirect($this->shopPath($user, 'dashboard'));
    }

    public function test_a_shops_own_login_page_shows_that_shops_branding(): void
    {
        // Shop::factory() alone doesn't create theme_settings/receipt_settings
        // rows (only ShopService::createShop() does, matching how a real shop
        // is actually provisioned) — needed here since the login page renders
        // the full layout, which requires ThemeSetting::current() to resolve.
        $shopA = app(ShopService::class)->createShop('Shop A', 'Admin A', 'admina@example.com')['shop'];
        $shopB = app(ShopService::class)->createShop('Shop B', 'Admin B', 'adminb@example.com')['shop'];

        ThemeSetting::query()->where('shop_id', $shopA->id)->update(['shop_name' => 'Shop A Storefront']);
        ThemeSetting::query()->where('shop_id', $shopB->id)->update(['shop_name' => 'Shop B Storefront']);

        $this->get('/'.$shopA->slug.'/login')->assertSee('Shop A Storefront');
        $this->get('/'.$shopB->slug.'/login')->assertSee('Shop B Storefront');
    }

    public function test_an_unknown_shop_slug_returns_404(): void
    {
        $this->get('/this-shop-does-not-exist/login')->assertNotFound();
    }
}
