<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Creates one demo shop with one demo user per role for local
     * development/testing — all use the password "password" (dev-only seed
     * data, never used in production since users are Admin-created only,
     * per prd.md §3.1).
     */
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(SuperAdminSeeder::class);

        $shop = Shop::factory()->create(['name' => 'Demo Shop']);

        $this->callWith(ThemeSettingSeeder::class, ['shopId' => $shop->id]);
        $this->callWith(ReceiptSettingSeeder::class, ['shopId' => $shop->id]);
        $this->callWith(CategorySeeder::class, ['shopId' => $shop->id]);

        $usersByRole = [
            ['role' => UserRole::Admin, 'name' => 'Admin User', 'email' => 'admin@example.com'],
            ['role' => UserRole::InventoryManager, 'name' => 'Inventory Manager', 'email' => 'inventory@example.com'],
            ['role' => UserRole::Accountant, 'name' => 'Accountant User', 'email' => 'accountant@example.com'],
            ['role' => UserRole::Salesman, 'name' => 'Salesman User', 'email' => 'salesman@example.com'],
        ];

        foreach ($usersByRole as $attributes) {
            $user = User::factory()->create([
                'shop_id' => $shop->id,
                'name' => $attributes['name'],
                'email' => $attributes['email'],
            ]);

            $user->assignRole($attributes['role']->value);
        }
    }
}
