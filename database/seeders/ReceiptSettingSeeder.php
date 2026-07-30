<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ReceiptSetting;
use Illuminate\Database\Seeder;

class ReceiptSettingSeeder extends Seeder
{
    /**
     * Seed one shop's receipt_settings row with sensible defaults.
     */
    public function run(int $shopId): void
    {
        ReceiptSetting::query()->firstOrCreate(['shop_id' => $shopId], [
            'header_text' => null,
            'footer_text' => 'Thank you for your business!',
            'show_logo' => true,
            'paper_width' => '80mm',
        ]);
    }
}
