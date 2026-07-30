<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ThemeSetting;
use Illuminate\Database\Seeder;

class ThemeSettingSeeder extends Seeder
{
    /**
     * Seed one shop's theme_settings row with the default palette from design.md §2.1.
     */
    public function run(int $shopId): void
    {
        ThemeSetting::query()->firstOrCreate(['shop_id' => $shopId], [
            'logo_path' => null,
            'shop_name' => null,
            'navbar_primary_color' => '#2f6f4f',
            'navbar_accent_color' => '#e8f5ee',
            'sidebar_primary_color' => '#1f4d38',
            'sidebar_accent_color' => '#eaf6f0',
            'sidebar_gradient_from' => '#1f4d38',
            'sidebar_gradient_to' => '#1f4d38',
            'default_locale' => 'en',
        ]);
    }
}
