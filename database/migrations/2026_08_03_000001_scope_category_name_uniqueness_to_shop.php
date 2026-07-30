<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * categories.name and expense_categories.name were made globally unique
 * before the multi-tenant conversion (shop_id didn't exist yet) and were
 * never revisited — as written, two different shops can never both have a
 * category named e.g. "Insecticide", which every shop's default category
 * seeding tries to create. Scope both to (shop_id, name) instead.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique('categories_name_unique');
            $table->unique(['shop_id', 'name']);
        });

        Schema::table('expense_categories', function (Blueprint $table) {
            $table->dropUnique('expense_categories_name_unique');
            $table->unique(['shop_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['shop_id', 'name']);
            $table->unique('name');
        });

        Schema::table('expense_categories', function (Blueprint $table) {
            $table->dropUnique(['shop_id', 'name']);
            $table->unique('name');
        });
    }
};
