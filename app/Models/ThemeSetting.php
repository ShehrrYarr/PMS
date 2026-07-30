<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    use BelongsToShop;

    protected $fillable = [
        'shop_id',
        'logo_path',
        'shop_name',
        'navbar_primary_color',
        'navbar_accent_color',
        'sidebar_primary_color',
        'sidebar_accent_color',
        'sidebar_gradient_from',
        'sidebar_gradient_to',
        'default_locale',
        'banner_interval_seconds',
        'font_size_percent',
    ];

    protected function casts(): array
    {
        return [
            'banner_interval_seconds' => 'integer',
            'font_size_percent' => 'integer',
        ];
    }

    /**
     * theme_settings is a single-row table (id = 1); this returns that row.
     */
    public static function current(): self
    {
        return static::query()->firstOrFail();
    }

    /**
     * The name shown in the navbar, sidebar, browser tab, and receipts —
     * falls back to the app's own name until an admin sets a shop name.
     */
    public function displayName(): string
    {
        return $this->shop_name !== null && $this->shop_name !== '' ? $this->shop_name : __('nav.app_name');
    }
}
