<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            // Idempotency key for replaying a sale queued offline. Unique, so
            // a retried sync can never create the same sale twice — the sync
            // service looks the uuid up first and returns the existing row.
            // Null for every sale made online.
            $table->uuid('client_uuid')->nullable()->unique()->after('invoice_number');

            // When the offline queue pushed this sale, as distinct from
            // created_at, which the sync service back-dates to when the sale
            // actually happened at the till.
            $table->timestamp('synced_at')->nullable()->after('photo_path');
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropUnique(['client_uuid']);
            $table->dropColumn(['client_uuid', 'synced_at']);
        });
    }
};
