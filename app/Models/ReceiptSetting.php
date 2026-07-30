<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Model;

class ReceiptSetting extends Model
{
    use BelongsToShop;

    protected $fillable = [
        'shop_id',
        'header_text',
        'footer_text',
        'show_logo',
        'paper_width',
    ];

    protected function casts(): array
    {
        return [
            'show_logo' => 'boolean',
        ];
    }

    /**
     * receipt_settings is a single-row table (id = 1); this returns that row.
     */
    public static function current(): self
    {
        return static::query()->firstOrFail();
    }
}
