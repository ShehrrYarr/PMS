<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Livewire\Admin\BankAccountManager;
use App\Livewire\Admin\DeveloperTools;
use App\Livewire\Vendors\VendorList;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Route-level enforcement of the permission matrix from prd.md §3 — see
 * rules.md §4.3 (UI hiding is a courtesy, not a security boundary; these
 * tests hit routes directly, bypassing the UI entirely).
 */
class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    private function userWithRole(UserRole $role): User
    {
        $user = User::factory()->create();
        $user->assignRole($role->value);

        return $user;
    }

    public function test_salesman_is_forbidden_from_vendors(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);

        $this->actingAs($salesman)->get('/vendors')->assertForbidden();
    }

    public function test_salesman_is_forbidden_from_purchases(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);

        $this->actingAs($salesman)->get('/purchases')->assertForbidden();
        $this->actingAs($salesman)->get('/purchases/create')->assertForbidden();
    }

    public function test_salesman_is_forbidden_from_settings(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);

        $this->actingAs($salesman)->get('/settings')->assertForbidden();
    }

    public function test_only_admin_and_accountant_can_reach_expenses(): void
    {
        $accountant = $this->userWithRole(UserRole::Accountant);
        $this->actingAs($accountant)->get('/expenses')->assertOk();
        $this->actingAs($accountant)->get('/expense-categories')->assertOk();

        foreach ([UserRole::InventoryManager, UserRole::Salesman] as $role) {
            $user = $this->userWithRole($role);

            $this->actingAs($user)->get('/expenses')->assertForbidden();
            $this->actingAs($user)->get('/expense-categories')->assertForbidden();
        }

        $admin = $this->userWithRole(UserRole::Admin);
        $this->actingAs($admin)->get('/expenses')->assertOk();
        $this->actingAs($admin)->get('/expense-categories')->assertOk();
    }

    public function test_salesman_is_forbidden_from_the_sales_report(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);

        $this->actingAs($salesman)->get('/reports/sales')->assertForbidden();
    }

    public function test_admin_inventory_manager_and_accountant_can_reach_the_sales_report(): void
    {
        foreach ([UserRole::Admin, UserRole::InventoryManager, UserRole::Accountant] as $role) {
            $user = $this->userWithRole($role);

            $this->actingAs($user)->get('/reports/sales')->assertOk();
        }
    }

    public function test_salesman_is_forbidden_from_the_purchase_report(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);

        $this->actingAs($salesman)->get('/reports/purchases')->assertForbidden();
    }

    public function test_admin_inventory_manager_and_accountant_can_reach_the_purchase_report(): void
    {
        foreach ([UserRole::Admin, UserRole::InventoryManager, UserRole::Accountant] as $role) {
            $user = $this->userWithRole($role);

            $this->actingAs($user)->get('/reports/purchases')->assertOk();
        }
    }

    public function test_salesman_can_reach_pos_and_sales(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);

        $this->actingAs($salesman)->get('/pos')->assertOk();
        $this->actingAs($salesman)->get('/sales')->assertOk();
    }

    public function test_accountant_can_view_purchases_but_not_create_them(): void
    {
        $accountant = $this->userWithRole(UserRole::Accountant);

        $this->actingAs($accountant)->get('/purchases')->assertOk();
        $this->actingAs($accountant)->get('/purchases/create')->assertForbidden();
    }

    public function test_accountant_is_forbidden_from_pos(): void
    {
        $accountant = $this->userWithRole(UserRole::Accountant);

        $this->actingAs($accountant)->get('/pos')->assertForbidden();
    }

    public function test_inventory_manager_can_manage_vendors_but_is_forbidden_from_settings(): void
    {
        $inventoryManager = $this->userWithRole(UserRole::InventoryManager);

        $this->actingAs($inventoryManager)->get('/vendors')->assertOk();

        // Settings (which now houses Bank Accounts as a tab) is Admin-only —
        // bank-accounts.view/.manage were removed from every non-Admin role
        // when Bank Accounts moved under Settings.
        $this->actingAs($inventoryManager)->get('/settings')->assertForbidden();
    }

    public function test_accountant_is_forbidden_from_settings(): void
    {
        $accountant = $this->userWithRole(UserRole::Accountant);

        $this->actingAs($accountant)->get('/settings')->assertForbidden();
    }

    public function test_admin_can_reach_everything(): void
    {
        $admin = $this->userWithRole(UserRole::Admin);

        $this->actingAs($admin)->get('/vendors')->assertOk();
        $this->actingAs($admin)->get('/purchases')->assertOk();
        $this->actingAs($admin)->get('/settings')->assertOk();
        $this->actingAs($admin)->get('/pos')->assertOk();

        Livewire::actingAs($admin)
            ->test(BankAccountManager::class)
            ->call('create')
            ->assertOk();
    }

    /**
     * Developer Tools (migrate/optimize/config:cache/git pull) is the most
     * sensitive surface in the app — every non-Admin role must be unable to
     * even mount the component, not just hit the /settings route.
     */
    public function test_only_admin_can_reach_developer_tools(): void
    {
        foreach ([UserRole::InventoryManager, UserRole::Accountant, UserRole::Salesman] as $role) {
            $user = $this->userWithRole($role);

            Livewire::actingAs($user)
                ->test(DeveloperTools::class)
                ->assertForbidden();
        }

        $admin = $this->userWithRole(UserRole::Admin);

        Livewire::actingAs($admin)
            ->test(DeveloperTools::class)
            ->assertOk();
    }

    public function test_a_direct_livewire_action_call_is_blocked_the_same_as_the_route(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);

        Livewire::actingAs($salesman)
            ->test(VendorList::class)
            ->call('create')
            ->assertForbidden();
    }

    public function test_a_vendor_cannot_be_created_via_direct_component_call_without_permission(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);
        $countBefore = Vendor::query()->count();

        try {
            Livewire::actingAs($salesman)
                ->test(VendorList::class)
                ->set('form.name', 'Sneaky Vendor')
                ->call('save');
        } catch (\Throwable) {
            // authorization exception expected
        }

        $this->assertSame($countBefore, Vendor::query()->count());
    }
}
