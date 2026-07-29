<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->string('barcode')->unique();
            $table->date('manufacturing_date');
            $table->date('expiry_date');
            $table->decimal('cost_price', 12, 2);
            $table->decimal('quantity_received', 12, 2);
            $table->decimal('quantity_remaining', 12, 2);
            // purchase_item_id will get its FK constraint once the purchase_items
            // table exists (Phase 4/5) — nullable for opening-stock batches created
            // directly here in Phase 3, ahead of the full purchase flow.
            $table->unsignedBigInteger('purchase_item_id')->nullable();
            $table->timestamps();

            $table->index('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
