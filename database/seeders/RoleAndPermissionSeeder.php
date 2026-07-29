<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Permission matrix per prd.md §3. This is the single source of truth for
     * role capabilities — Policies (added in later phases) check these
     * permissions rather than duplicating role conditionals (see rules.md §4.3).
     *
     * @var array<string, list<string>>
     */
    private const PERMISSIONS_BY_ROLE = [
        UserRole::Admin->value => [
            'branding.manage',
            'receipt-settings.manage',
            'developer-tools.manage',
            'bank-accounts.manage',
            'bank-accounts.view',
            'users.manage',
            'vendors.manage',
            'vendors.view',
            'customers.manage',
            'customers.view',
            'vendor-ledger.manage',
            'vendor-ledger.view',
            'customer-ledger.manage',
            'customer-ledger.view',
            'products.manage',
            'products.view',
            'batches.manage',
            'batches.view',
            'expiry-alerts.view',
            'purchases.manage',
            'purchases.view',
            'purchase-returns.manage',
            'sales.manage',
            'sales.view',
            'sale-returns.manage',
            'payments.manage',
            'reports.view',
        ],
        UserRole::InventoryManager->value => [
            'vendors.manage',
            'vendors.view',
            'customers.view',
            'vendor-ledger.view',
            'products.manage',
            'products.view',
            'batches.manage',
            'batches.view',
            'expiry-alerts.view',
            'purchases.manage',
            'purchases.view',
            'purchase-returns.manage',
            'reports.view',
        ],
        UserRole::Accountant->value => [
            'vendors.view',
            'customers.view',
            'vendor-ledger.manage',
            'vendor-ledger.view',
            'customer-ledger.manage',
            'customer-ledger.view',
            'payments.manage',
            'products.view',
            'batches.view',
            'purchases.view',
            'sales.view',
            'reports.view',
        ],
        UserRole::Salesman->value => [
            'customers.view',
            'products.view',
            'batches.view',
            'sales.manage',
            'sales.view',
            'sale-returns.manage',
        ],
    ];

    /**
     * Seed the roles and permissions defined in self::PERMISSIONS_BY_ROLE.
     */
    public function run(): void
    {
        Cache::forget(config('permission.cache.key'));

        $allPermissions = collect(self::PERMISSIONS_BY_ROLE)
            ->flatten()
            ->unique()
            ->values();

        $allPermissions->each(
            fn (string $permission) => Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web'])
        );

        foreach (self::PERMISSIONS_BY_ROLE as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($permissions);
        }
    }
}
