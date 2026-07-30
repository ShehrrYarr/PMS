<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Batch extends Model
{
    use BelongsToShop, HasFactory;

    protected $fillable = [
        'shop_id',
        'product_id',
        'barcode',
        'manufacturing_date',
        'expiry_date',
        'cost_price',
        'quantity_received',
        'quantity_remaining',
        'purchase_item_id',
    ];

    protected function casts(): array
    {
        return [
            'manufacturing_date' => 'date',
            'expiry_date' => 'date',
            'cost_price' => 'decimal:2',
            'quantity_received' => 'decimal:2',
            'quantity_remaining' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo<PurchaseItem, $this>
     */
    public function purchaseItem(): BelongsTo
    {
        return $this->belongsTo(PurchaseItem::class);
    }

    public function daysUntilExpiry(): int
    {
        return (int) now()->startOfDay()->diffInDays($this->expiry_date, false);
    }

    public function isExpired(): bool
    {
        return $this->daysUntilExpiry() < 0;
    }

    public function isExpiringSoon(int $withinDays = 30): bool
    {
        return $this->daysUntilExpiry() <= $withinDays;
    }
}
