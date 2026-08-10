<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sale_items', function (Blueprint $table) {
            $table->enum('discount_type', ['flat', 'percentage'])->nullable()->after('unit_price');
            // The raw value the cashier typed — a PKR amount for 'flat', or a
            // percentage number (e.g. 15.50) for 'percentage'.
            $table->decimal('discount_value', 12, 2)->nullable()->after('discount_type');
            // The computed PKR amount actually subtracted, locked in at sale
            // time so a percentage discount's meaning never drifts if this
            // line is revisited later (e.g. by a report).
            $table->decimal('discount_amount', 12, 2)->default('0.00')->after('discount_value');
        });
    }

    public function down(): void
    {
        Schema::table('sale_items', function (Blueprint $table) {
            $table->dropColumn(['discount_type', 'discount_value', 'discount_amount']);
        });
    }
};
