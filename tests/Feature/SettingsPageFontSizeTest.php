<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Livewire\Admin\SettingsPage;
use App\Models\ThemeSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SettingsPageFontSizeTest extends TestCase
{
    use RefreshDatabase;

    public function test_font_size_defaults_to_100_percent(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->assertSet('fontSizePercent', 100);
    }

    public function test_admin_can_increase_and_decrease_font_size_in_steps_of_10(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->call('increaseFontSize')
            ->assertSet('fontSizePercent', 110)
            ->call('increaseFontSize')
            ->assertSet('fontSizePercent', 120)
            ->call('decreaseFontSize')
            ->assertSet('fontSizePercent', 110);
    }

    public function test_font_size_is_clamped_between_80_and_150_percent(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        $component = Livewire::actingAs($admin)->test(SettingsPage::class);

        foreach (range(1, 10) as $_) {
            $component->call('decreaseFontSize');
        }
        $component->assertSet('fontSizePercent', 80);

        foreach (range(1, 10) as $_) {
            $component->call('increaseFontSize');
        }
        $component->assertSet('fontSizePercent', 150);
    }

    public function test_saving_theme_persists_the_font_size(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        Livewire::actingAs($admin)
            ->test(SettingsPage::class)
            ->call('increaseFontSize')
            ->call('increaseFontSize')
            ->call('saveTheme')
            ->assertHasNoErrors();

        $this->assertSame(120, ThemeSetting::current()->font_size_percent);
    }
}
