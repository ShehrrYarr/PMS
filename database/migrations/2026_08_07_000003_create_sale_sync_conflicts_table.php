<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Records an offline sale that, on sync, sold more of a batch than the
     * server still had — because someone else sold the same stock while this
     * device was offline.
     *
     * The sale is still created (the customer already paid and left with the
     * goods, so losing the money record is far worse than a temporarily
     * negative stock count) and the batch is allowed to go negative, which
     * self-corrects when the next purchase of that batch lands. This table is
     * what makes the discrepancy visible to an admin instead of silent.
     */
    public function up(): void
    {
        Schema::create('sale_sync_conflicts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained()->restrictOnDelete();
            $table->decimal('requested_quantity', 12, 2);
            $table->decimal('available_quantity', 12, 2);
            $table->decimal('shortfall', 12, 2);
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['shop_id', 'resolved_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_sync_conflicts');
    }
};
