<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * The same table list as the previous migration, minus 'users' — handled
     * separately below since every other table just needs a blanket update,
     * while 'users' logically belongs to Shop #1 for the same reason.
     *
     * @var list<string>
     */
    private const TENANT_TABLES = [
        'users',
        'banks',
        'banners',
        'batches',
        'categories',
        'companies',
        'customers',
        'customer_ledgers',
        'expenses',
        'expense_categories',
        'payments',
        'products',
        'purchases',
        'purchase_items',
        'purchase_returns',
        'purchase_return_items',
        'receipt_settings',
        'sales',
        'sale_items',
        'sale_returns',
        'sale_return_items',
        'theme_settings',
        'vendors',
        'vendor_ledgers',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // A fresh install (fresh test DB, new dev clone) has no pre-existing
        // rows to migrate — skip entirely so it doesn't leave behind an
        // orphan shop that DatabaseSeeder's own Shop never attaches data to.
        if (DB::table('users')->doesntExist()) {
            return;
        }

        $existingShopName = DB::table('theme_settings')->value('shop_name');

        $shopId = DB::table('shops')->insertGetId([
            'name' => $existingShopName !== null && $existingShopName !== '' ? $existingShopName : 'Default Shop',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach (self::TENANT_TABLES as $table) {
            DB::table($table)->whereNull('shop_id')->update(['shop_id' => $shopId]);
        }
    }

    /**
     * Reverse the migrations. Data-only migration — nothing to structurally
     * undo (the shop_id values are simply left in place; dropping the shops
     * row itself would violate the restrictOnDelete FK while any of these
     * tables still reference it).
     */
    public function down(): void
    {
        //
    }
};
