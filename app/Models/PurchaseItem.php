<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseItem extends Model
{
    use BelongsToShop;

    protected $fillable = [
        'shop_id',
        'purchase_id',
        'product_id',
        'quantity',
        'cost_price',
        'line_total',
        'quantity_returned',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'cost_price' => 'decimal:2',
            'line_total' => 'decimal:2',
            'quantity_returned' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsTo<Purchase, $this>
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return HasOne<Batch, $this>
     */
    public function batch(): HasOne
    {
        return $this->hasOne(Batch::class);
    }

    public function returnableQuantity(): string
    {
        return bcsub((string) $this->quantity, (string) $this->quantity_returned, 2);
    }
}
