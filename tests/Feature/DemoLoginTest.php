<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Shop;
use App\Services\ShopService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DemoLoginTest extends TestCase
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

    public function test_a_guest_can_instantly_log_into_the_demo_shop_as_admin(): void
    {
        $this->clearSeededDemoFlag();

        $result = app(ShopService::class)->createShop('Public Demo', 'Demo Admin', 'demo-admin@example.com');
        $result['shop']->update(['is_demo' => true]);

        $response = $this->get(route('demo.login'));

        $response->assertRedirect(route('dashboard', ['shop' => $result['shop']->slug]));
        $this->assertTrue(Auth::guard('web')->check());
        $this->assertSame($result['admin']->id, Auth::guard('web')->id());
    }

    public function test_demo_login_404s_when_no_shop_is_flagged_as_the_demo(): void
    {
        $this->clearSeededDemoFlag();
        Shop::factory()->create(['is_demo' => false]);

        $this->get(route('demo.login'))->assertNotFound();
    }

    public function test_demo_login_ignores_a_suspended_shop(): void
    {
        $this->clearSeededDemoFlag();

        $result = app(ShopService::class)->createShop('Suspended Demo', 'Demo Admin', 'suspended-demo-admin@example.com');
        $result['shop']->update(['is_demo' => true, 'is_active' => false]);

        $this->get(route('demo.login'))->assertNotFound();
    }
}
