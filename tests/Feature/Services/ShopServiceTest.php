<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\UserRole;
use App\Models\ReceiptSetting;
use App\Models\ThemeSetting;
use App\Models\User;
use App\Services\ShopService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ShopServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_shop_creates_a_shop_with_settings_and_a_working_admin_login(): void
    {
        $result = app(ShopService::class)->createShop(
            name: 'New Shop',
            adminName: 'New Admin',
            adminEmail: 'newadmin@example.com',
        );

        $shop = $result['shop'];
        $admin = $result['admin'];
        $temporaryPassword = $result['temporaryPassword'];

        $this->assertSame('New Shop', $shop->name);
        $this->assertTrue($shop->is_active);

        $this->assertSame($shop->id, $admin->shop_id);
        $this->assertSame('newadmin@example.com', $admin->email);
        $this->assertTrue($admin->hasRole(UserRole::Admin->value));
        $this->assertTrue($admin->hasVerifiedEmail());

        $this->assertNotEmpty($temporaryPassword);

        $theme = ThemeSetting::query()->where('shop_id', $shop->id)->first();
        $receipt = ReceiptSetting::query()->where('shop_id', $shop->id)->first();
        $this->assertNotNull($theme);
        $this->assertNotNull($receipt);

        $this->assertTrue(Auth::attempt(['email' => 'newadmin@example.com', 'password' => $temporaryPassword]));
        $this->assertAuthenticatedAs($admin);

        // A shop created with no mailer configured must not be blocked on
        // verifying an email nothing was ever sent to.
        $this->actingAs($admin)->get($this->shopPath($admin, 'dashboard'))->assertOk();
    }

    public function test_admin_email_must_be_globally_unique(): void
    {
        User::factory()->create(['email' => 'taken@example.com']);

        $this->expectException(\Illuminate\Database\QueryException::class);

        app(ShopService::class)->createShop(
            name: 'Another Shop',
            adminName: 'Another Admin',
            adminEmail: 'taken@example.com',
        );
    }
}
