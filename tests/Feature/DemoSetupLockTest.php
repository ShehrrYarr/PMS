<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Livewire\Admin\BankAccountManager;
use App\Livewire\Admin\BannerManager;
use App\Livewire\Admin\SettingsPage;
use App\Livewire\Inventory\ProductList;
use App\Models\Bank;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ThemeSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Livewire\Volt\Volt;
use Tests\TestCase;

/**
 * The public demo shop is never reset and every visitor is its Admin, so
 * shop setup is read-only there (LocksDemoShopSetup) — while every other
 * shop, and every other demo feature, behaves normally.
 */
class DemoSetupLockTest extends TestCase
{
    use RefreshDatabase;

    private function admin(bool $demo): User
    {
        $shop = Shop::query()->oldest('id')->firstOrFail();
        $shop->update(['is_demo' => $demo]);

        $admin = User::factory()->create(['shop_id' => $shop->id]);
        $admin->assignRole(UserRole::Admin->value);

        return $admin;
    }

    public function test_demo_visitors_cannot_change_the_shop_name(): void
    {
        $admin = $this->admin(demo: true);
        $before = ThemeSetting::current()->shop_name;

        Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->set('shopName', 'Defaced!')
            ->call('saveGeneral')
            ->assertHasErrors(['demo']);

        $this->assertSame($before, ThemeSetting::current()->fresh()->shop_name);
    }

    public function test_demo_visitors_cannot_change_the_logo_or_theme(): void
    {
        Storage::fake('public');
        $admin = $this->admin(demo: true);
        $theme = ThemeSetting::current();

        Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->set('logo', UploadedFile::fake()->image('logo.png'))
            ->call('saveLogo')
            ->assertHasErrors(['demo'])
            ->call('increaseFontSize')
            ->call('applyPreset', 1);

        $fresh = $theme->fresh();
        $this->assertSame($theme->logo_path, $fresh->logo_path);
        $this->assertSame($theme->font_size_percent, $fresh->font_size_percent);
        $this->assertSame($theme->navbar_primary_color, $fresh->navbar_primary_color);
    }

    public function test_demo_visitors_cannot_add_or_disable_bank_accounts(): void
    {
        $admin = $this->admin(demo: true);
        $bank = Bank::query()->create(['shop_id' => $admin->shop_id, 'name' => 'Existing Bank', 'is_active' => true]);

        Livewire::actingAs($admin)
            ->test(BankAccountManager::class)
            ->set('name', 'Visitor Bank')
            ->call('save')
            ->assertHasErrors(['demo'])
            ->call('toggleActive', $bank->id);

        $this->assertFalse(Bank::query()->where('name', 'Visitor Bank')->exists());
        $this->assertTrue($bank->fresh()->is_active);
    }

    public function test_demo_visitors_cannot_add_or_delete_banners(): void
    {
        Storage::fake('public');
        $admin = $this->admin(demo: true);
        $banner = Banner::query()->create(['shop_id' => $admin->shop_id, 'image_path' => 'banners/existing.webp']);

        Livewire::actingAs($admin)
            ->test(BannerManager::class)
            ->set('banner', UploadedFile::fake()->image('banner.png'))
            ->call('addBanner')
            ->assertHasErrors(['demo'])
            ->call('delete', $banner->id);

        $this->assertSame(1, Banner::query()->where('shop_id', $admin->shop_id)->count());
    }

    /** Deleting the demo Admin would break "See Demo" for every visitor after. */
    public function test_demo_visitors_cannot_delete_or_edit_the_demo_account(): void
    {
        $admin = $this->admin(demo: true);

        Volt::actingAs($admin)
            ->test('profile.delete-user-form')
            ->set('password', 'password')
            ->call('deleteUser')
            ->assertHasErrors(['demo']);

        Volt::actingAs($admin)
            ->test('profile.update-profile-information-form')
            ->set('name', 'Hacked')
            ->set('email', 'hacked@example.com')
            ->call('updateProfileInformation')
            ->assertHasErrors(['demo']);

        Volt::actingAs($admin)
            ->test('profile.update-password-form')
            ->set('current_password', 'password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('updatePassword')
            ->assertHasErrors(['demo']);

        $fresh = $admin->fresh();
        $this->assertNotNull($fresh);
        $this->assertNotSame('Hacked', $fresh->name);
        $this->assertNotSame('hacked@example.com', $fresh->email);
    }

    public function test_the_settings_and_profile_pages_explain_the_lock_in_the_demo(): void
    {
        $admin = $this->admin(demo: true);

        $this->actingAs($admin)->get($this->shopPath($admin, 'settings'))
            ->assertOk()
            ->assertSee(__('demo.setup_locked_title'))
            ->assertSee('<fieldset disabled', false);

        $this->actingAs($admin)->get($this->shopPath($admin, 'profile'))
            ->assertOk()
            ->assertSee(__('demo.setup_locked_title'));
    }

    public function test_everything_else_stays_usable_in_the_demo(): void
    {
        $admin = $this->admin(demo: true);

        Livewire::actingAs($admin)
            ->test(ProductList::class)
            ->call('create')
            ->set('form.name', 'Visitor Product')
            ->set('form.sku', 'VISIT-1')
            ->set('form.unit', 'Bottle')
            ->set('form.default_sale_price', '500')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertTrue(Product::query()->where('sku', 'VISIT-1')->exists());
    }

    public function test_an_ordinary_shop_is_not_locked(): void
    {
        $admin = $this->admin(demo: false);

        Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->set('shopName', 'My Real Shop')
            ->call('saveGeneral')
            ->assertHasNoErrors();

        $this->assertSame('My Real Shop', ThemeSetting::current()->fresh()->shop_name);

        $this->actingAs($admin)->get($this->shopPath($admin, 'settings'))
            ->assertOk()
            ->assertDontSee(__('demo.setup_locked_title'))
            ->assertDontSee('<fieldset disabled', false);
    }
}
