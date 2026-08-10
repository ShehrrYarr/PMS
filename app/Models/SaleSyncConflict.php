<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * An offline sale that, on sync, sold more of a batch than the server still
 * had. The sale is always created anyway — see the migration's note — so this
 * row exists purely to make the resulting stock discrepancy visible to an
 * admin rather than silent.
 */
class SaleSyncConflict extends Model
{
    use BelongsToShop;

    protected $fillable = [
        'shop_id',
        'sale_id',
        'batch_id',
        'requested_quantity',
        'available_quantity',
        'shortfall',
        'resolved_at',
        'resolved_by',
    ];

    protected function casts(): array
    {
        return [
            'requested_quantity' => 'decimal:2',
            'available_quantity' => 'decimal:2',
            'shortfall' => 'decimal:2',
            'resolved_at' => 'datetime',
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

    /**
     * @return BelongsTo<User, $this>
     */
    public function resolver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    /**
     * @param  Builder<SaleSyncConflict>  $query
     */
    public function scopeUnresolved(Builder $query): void
    {
        $query->whereNull('resolved_at');
    }
}
