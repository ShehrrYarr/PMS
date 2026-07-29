<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ReceiptSetting;
use Illuminate\Database\Seeder;

class ReceiptSettingSeeder extends Seeder
{
    /**
     * Seed the single receipt_settings row with sensible defaults.
     */
    public function run(): void
    {
        ReceiptSetting::query()->firstOrCreate(['id' => 1], [
            'header_text' => null,
            'footer_text' => 'Thank you for your business!',
            'show_logo' => true,
            'paper_width' => '80mm',
        ]);
    }
}
