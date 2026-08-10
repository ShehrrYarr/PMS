<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * A parked cart, held so the cashier can serve someone else and come
     * back to it. Held orders live here when online and in browser storage
     * when offline; the two are merged on sync by client_uuid, which is why
     * that column is unique rather than the row just being auto-increment.
     */
    public function up(): void
    {
        Schema::create('held_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->uuid('client_uuid')->unique();
            $table->string('label')->nullable();

            // The cart itself: line items plus the selected customer. Stored
            // as JSON rather than normalised because a held order is a
            // scratch pad, never a financial record — nothing reports on it
            // and it's deleted the moment it's resumed or discarded.
            $table->json('payload');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('held_orders');
    }
};
