<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Creates one demo user per role for local development/testing — all use
     * the password "password" (dev-only seed data, never used in production
     * since users are Admin-created only, per prd.md §3.1).
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            ThemeSettingSeeder::class,
            ReceiptSettingSeeder::class,
            CategorySeeder::class,
        ]);

        $usersByRole = [
            ['role' => UserRole::Admin, 'name' => 'Admin User', 'email' => 'admin@example.com'],
            ['role' => UserRole::InventoryManager, 'name' => 'Inventory Manager', 'email' => 'inventory@example.com'],
            ['role' => UserRole::Accountant, 'name' => 'Accountant User', 'email' => 'accountant@example.com'],
            ['role' => UserRole::Salesman, 'name' => 'Salesman User', 'email' => 'salesman@example.com'],
        ];

        foreach ($usersByRole as $attributes) {
            $user = User::factory()->create([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
            ]);

            $user->assignRole($attributes['role']->value);
        }
    }
}
