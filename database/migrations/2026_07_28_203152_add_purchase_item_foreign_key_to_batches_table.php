<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * batches.purchase_item_id was created nullable/unconstrained in Phase 3
     * since purchase_items didn't exist yet (see architecture.md §3.7 and
     * memory.md's decision log). Now that it does, attach the real FK.
     */
    public function up(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->foreign('purchase_item_id')->references('id')->on('purchase_items')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->dropForeign(['purchase_item_id']);
        });
    }
};
