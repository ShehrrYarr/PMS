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
        Schema::table('theme_settings', function (Blueprint $table) {
            $table->string('shop_name')->nullable()->after('logo_path');
            $table->string('sidebar_gradient_from', 7)->nullable()->after('sidebar_primary_color');
            $table->string('sidebar_gradient_to', 7)->nullable()->after('sidebar_gradient_from');
        });

        // Backfill the new gradient columns from the existing solid sidebar
        // color so current installs keep their exact look until an admin
        // picks a real two-tone gradient via the new settings page. Left
        // nullable (no doctrine/dbal installed to alter it to NOT NULL) —
        // the settings form always submits both, so this is academic.
        DB::table('theme_settings')->update([
            'sidebar_gradient_from' => DB::raw('sidebar_primary_color'),
            'sidebar_gradient_to' => DB::raw('sidebar_primary_color'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            $table->dropColumn(['shop_name', 'sidebar_gradient_from', 'sidebar_gradient_to']);
        });
    }
};
