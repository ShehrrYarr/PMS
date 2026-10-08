<?php

declare(strict_types=1);

use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * RoleAndPermissionSeeder is the source of truth for the permission matrix,
 * but it only runs on a fresh install — an already-deployed database would
 * never get the new 'cost-prices.view' permission (shown in the POS batch
 * pop-up) without this. Safe to run on a fresh install too: if the Admin role
 * doesn't exist yet, the seeder creates and grants it later.
 */
return new class extends Migration
{
    public function up(): void
    {
        Cache::forget(config('permission.cache.key'));

        $permission = Permission::firstOrCreate(['name' => 'cost-prices.view', 'guard_name' => 'web']);

        Role::query()
            ->where('name', UserRole::Admin->value)
            ->where('guard_name', 'web')
            ->first()
            ?->givePermissionTo($permission);
    }

    public function down(): void
    {
        Cache::forget(config('permission.cache.key'));

        Permission::query()->where('name', 'cost-prices.view')->where('guard_name', 'web')->delete();
    }
};
