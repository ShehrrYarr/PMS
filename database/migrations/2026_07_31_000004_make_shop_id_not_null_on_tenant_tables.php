<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Same table list as the two previous migrations — every row now has a
     * shop_id (backfilled into Shop #1), so the column can be locked down.
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
        foreach (self::TENANT_TABLES as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->unsignedBigInteger('shop_id')->nullable(false)->change();
            });
        }

        // theme_settings / receipt_settings are one-row-per-shop — enforce
        // that invariant at the DB level now that every row has a shop_id.
        Schema::table('theme_settings', function (Blueprint $blueprint) {
            $blueprint->unique('shop_id');
        });

        Schema::table('receipt_settings', function (Blueprint $blueprint) {
            $blueprint->unique('shop_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('theme_settings', function (Blueprint $blueprint) {
            $blueprint->dropUnique(['shop_id']);
        });

        Schema::table('receipt_settings', function (Blueprint $blueprint) {
            $blueprint->dropUnique(['shop_id']);
        });

        foreach (self::TENANT_TABLES as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->unsignedBigInteger('shop_id')->nullable()->change();
            });
        }
    }
};
