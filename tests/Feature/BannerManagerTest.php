<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Livewire\Admin\BannerManager;
use App\Models\Banner;
use App\Models\ThemeSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class BannerManagerTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        return $admin;
    }

    public function test_uploading_a_banner_stores_the_file_and_creates_a_row(): void
    {
        Storage::fake('public');

        Livewire::actingAs($this->admin())
            ->test(BannerManager::class)
            ->set('banner', UploadedFile::fake()->image('banner.png'))
            ->call('addBanner')
            ->assertHasNoErrors();

        $this->assertSame(1, Banner::query()->count());
        Storage::disk('public')->assertExists(Banner::query()->first()->image_path);
    }

    public function test_deleting_a_banner_removes_the_file_and_the_row(): void
    {
        Storage::fake('public');

        $component = Livewire::actingAs($this->admin())
            ->test(BannerManager::class)
            ->set('banner', UploadedFile::fake()->image('banner.png'))
            ->call('addBanner');

        $banner = Banner::query()->first();

        $component->call('delete', $banner->id);

        $this->assertSame(0, Banner::query()->count());
        Storage::disk('public')->assertMissing($banner->image_path);
    }

    public function test_saving_the_interval_updates_theme_settings(): void
    {
        Livewire::actingAs($this->admin())
            ->test(BannerManager::class)
            ->set('intervalSeconds', 12)
            ->call('saveInterval')
            ->assertHasNoErrors();

        $this->assertSame(12, ThemeSetting::current()->banner_interval_seconds);
    }

    public function test_interval_must_be_within_range(): void
    {
        Livewire::actingAs($this->admin())
            ->test(BannerManager::class)
            ->set('intervalSeconds', 1)
            ->call('saveInterval')
            ->assertHasErrors(['intervalSeconds']);
    }

    public function test_non_admin_cannot_reach_the_banner_manager(): void
    {
        $salesman = User::factory()->create();
        $salesman->assignRole(UserRole::Salesman->value);

        Livewire::actingAs($salesman)
            ->test(BannerManager::class)
            ->assertForbidden();
    }
}
