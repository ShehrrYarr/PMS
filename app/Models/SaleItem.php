<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id',
        'batch_id',
        'quantity',
        'unit_price',
        'cost_price',
        'line_total',
        'quantity_returned',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'unit_price' => 'decimal:2',
            'cost_price' => 'decimal:2',
            'line_total' => 'decimal:2',
            'quantity_returned' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsTo<Sale, $this>
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * @return BelongsTo<Batch, $this>
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function returnableQuantity(): string
    {
        return bcsub((string) $this->quantity, (string) $this->quantity_returned, 2);
    }

    /**
     * Cost basis of this line, from the cost_price snapshot captured at sale
     * time (see SaleService::create()).
     */
    public function costTotal(): string
    {
        return bcmul((string) $this->quantity, (string) ($this->cost_price ?? '0'), 2);
    }

    public function profit(): string
    {
        return bcsub((string) $this->line_total, $this->costTotal(), 2);
    }

    public function profitMarginPercent(): string
    {
        if (bccomp((string) $this->line_total, '0.00', 2) <= 0) {
            return '0.00';
        }

        return bcmul(bcdiv($this->profit(), (string) $this->line_total, 4), '100', 2);
    }
}
