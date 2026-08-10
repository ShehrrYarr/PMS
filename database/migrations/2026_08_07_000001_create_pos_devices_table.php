<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * One row per browser that has ever been put into offline mode.
     *
     * The primary key doubles as the device number printed inside offline
     * invoice numbers (SL-OFF{id}-{seq}). Because it's a global
     * auto-increment, those numbers can never collide across shops — which
     * matters because sales.invoice_number is unique on the column alone,
     * not per shop.
     */
    public function up(): void
    {
        Schema::create('pos_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('label')->nullable();

            // Authoritative offline invoice counter. Kept server-side on
            // purpose: if it lived only in browser storage, clearing that
            // storage would restart the sequence at 1 and collide with
            // invoices already synced from this device.
            $table->unsignedBigInteger('last_invoice_seq')->default(0);

            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pos_devices');
    }
};
