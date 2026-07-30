<?php

declare(strict_types=1);

namespace Tests\Feature\SuperAdmin;

use App\Livewire\SuperAdmin\DeveloperTools;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Server maintenance actions moved from a per-shop permission to a
 * platform-level, Super-Admin-only tool — see app/Livewire/SuperAdmin/DeveloperTools.php.
 * Its only authorization boundary is the auth:super_admin route middleware.
 */
class DeveloperToolsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_shop_user_cannot_reach_developer_tools(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')->get('/control-panel/developer-tools');

        $response->assertRedirect(route('control-panel.login'));
    }

    public function test_a_guest_cannot_reach_developer_tools(): void
    {
        $response = $this->get('/control-panel/developer-tools');

        $response->assertRedirect(route('control-panel.login'));
    }

    public function test_a_super_admin_can_reach_developer_tools(): void
    {
        $superAdmin = SuperAdmin::factory()->create();

        Livewire::actingAs($superAdmin, 'super_admin')
            ->test(DeveloperTools::class)
            ->assertOk();
    }
}
