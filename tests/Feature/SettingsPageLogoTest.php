<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Livewire\Admin\SettingsPage;
use App\Models\ThemeSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class SettingsPageLogoTest extends TestCase
{
    use RefreshDatabase;

    public function test_uploading_a_logo_stores_it_and_updates_theme_settings(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->set('logo', UploadedFile::fake()->image('logo.png'))
            ->call('saveLogo')
            ->assertHasNoErrors();

        $path = ThemeSetting::current()->logo_path;

        $this->assertNotNull($path);
        Storage::disk('public')->assertExists($path);
    }

    public function test_an_svg_logo_upload_is_rejected(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        $svg = UploadedFile::fake()->createWithContent(
            'logo.svg',
            '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(document.domain)</script></svg>',
        );

        Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->set('logo', $svg)
            ->call('saveLogo')
            ->assertHasErrors(['logo']);

        $this->assertNull(ThemeSetting::current()->logo_path);
    }

    public function test_the_stored_logo_extension_is_derived_from_the_real_mime_type_not_the_filename(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->set('logo', UploadedFile::fake()->image('anything.png'))
            ->call('saveLogo')
            ->assertHasNoErrors();

        $path = ThemeSetting::current()->logo_path;

        $this->assertStringEndsWith('.png', $path);
    }

    public function test_removing_a_logo_deletes_the_file_and_clears_the_path(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        $component = Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->set('logo', UploadedFile::fake()->image('logo.png'))
            ->call('saveLogo');

        $path = ThemeSetting::current()->logo_path;

        $component->call('removeLogo');

        $this->assertNull(ThemeSetting::current()->logo_path);
        Storage::disk('public')->assertMissing($path);
    }
}
