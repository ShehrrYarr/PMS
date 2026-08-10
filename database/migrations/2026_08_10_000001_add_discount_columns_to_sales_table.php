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
            $table->enum('discount_type', ['flat', 'percentage'])->nullable()->after('total_amount');
            // The raw value the cashier typed for the whole-sale discount —
            // a PKR amount for 'flat', or a percentage number for 'percentage'.
            $table->decimal('discount_value', 12, 2)->nullable()->after('discount_type');
            // The computed PKR amount actually subtracted from the sum of
            // (already item-discounted) line totals to reach total_amount.
            $table->decimal('discount_amount', 12, 2)->default('0.00')->after('discount_value');
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn(['discount_type', 'discount_value', 'discount_amount']);
        });
    }
};
