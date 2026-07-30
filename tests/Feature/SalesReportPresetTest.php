<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Livewire\Reports\SalesReport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Pins "today" to a fixed Wednesday so week/month/year boundaries are
 * deterministic regardless of when the suite actually runs.
 */
class SalesReportPresetTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::parse('2026-07-29'));
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    private function admin(): User
    {
        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        return $admin;
    }

    public function test_today_preset_sets_from_and_to_to_today(): void
    {
        Livewire::actingAs($this->admin())
            ->test(SalesReport::class)
            ->call('applyPreset', 'today')
            ->assertSet('dateFrom', '2026-07-29')
            ->assertSet('dateTo', '2026-07-29');
    }

    public function test_yesterday_preset_sets_from_and_to_to_yesterday(): void
    {
        Livewire::actingAs($this->admin())
            ->test(SalesReport::class)
            ->call('applyPreset', 'yesterday')
            ->assertSet('dateFrom', '2026-07-28')
            ->assertSet('dateTo', '2026-07-28');
    }

    public function test_last_week_preset_covers_the_previous_monday_to_sunday(): void
    {
        // 2026-07-29 is a Wednesday; the previous Mon-Sun is 2026-07-20..2026-07-26.
        Livewire::actingAs($this->admin())
            ->test(SalesReport::class)
            ->call('applyPreset', 'last_week')
            ->assertSet('dateFrom', '2026-07-20')
            ->assertSet('dateTo', '2026-07-26');
    }

    public function test_last_month_preset_covers_the_full_previous_calendar_month(): void
    {
        Livewire::actingAs($this->admin())
            ->test(SalesReport::class)
            ->call('applyPreset', 'last_month')
            ->assertSet('dateFrom', '2026-06-01')
            ->assertSet('dateTo', '2026-06-30');
    }

    public function test_last_year_preset_covers_the_full_previous_calendar_year(): void
    {
        Livewire::actingAs($this->admin())
            ->test(SalesReport::class)
            ->call('applyPreset', 'last_year')
            ->assertSet('dateFrom', '2025-01-01')
            ->assertSet('dateTo', '2025-12-31');
    }

    public function test_all_time_preset_clears_the_date_filter(): void
    {
        Livewire::actingAs($this->admin())
            ->test(SalesReport::class)
            ->call('applyPreset', 'today')
            ->call('applyPreset', 'all_time')
            ->assertSet('dateFrom', '')
            ->assertSet('dateTo', '');
    }
}
