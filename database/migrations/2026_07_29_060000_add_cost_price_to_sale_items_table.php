<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sale_items', function (Blueprint $table) {
            $table->decimal('cost_price', 12, 2)->nullable()->after('unit_price');
        });

        // Backfill existing rows from the batch's current cost_price. This is
        // a best-effort approximation for historical sales — going forward,
        // SaleService::create() snapshots the batch's cost_price at sale time
        // so margins stay accurate even if a batch's cost is edited later.
        DB::statement(
            'UPDATE sale_items si JOIN batches b ON b.id = si.batch_id SET si.cost_price = b.cost_price WHERE si.cost_price IS NULL'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_items', function (Blueprint $table) {
            $table->dropColumn('cost_price');
        });
    }
};
