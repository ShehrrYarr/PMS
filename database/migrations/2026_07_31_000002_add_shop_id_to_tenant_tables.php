<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Every table that belongs to exactly one shop. Nullable for now — a
     * later migration backfills existing rows into Shop #1, then a final
     * migration makes the column NOT NULL once every row has a value.
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
                $blueprint->foreignId('shop_id')->nullable()->after('id')->constrained()->restrictOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (self::TENANT_TABLES as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->dropConstrainedForeignId('shop_id');
            });
        }
    }
};
