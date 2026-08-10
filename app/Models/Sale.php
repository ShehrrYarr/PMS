<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use BelongsToShop;

    protected $fillable = [
        'shop_id',
        'invoice_number',
        'client_uuid',
        'customer_id',
        'user_id',
        'total_amount',
        'status',
        'photo_path',
        'synced_at',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'synced_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<SaleSyncConflict, $this>
     */
    public function syncConflicts(): HasMany
    {
        return $this->hasMany(SaleSyncConflict::class);
    }

    /**
     * True for a sale that was rung up while the till was offline and
     * replayed later — those keep the SL-OFF… number printed on the
     * customer's receipt rather than being renumbered into the online
     * sequence.
     */
    public function wasMadeOffline(): bool
    {
        return $this->client_uuid !== null;
    }

    /**
     * @return BelongsTo<Customer, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<SaleItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * @return HasMany<SaleReturn, $this>
     */
    public function returns(): HasMany
    {
        return $this->hasMany(SaleReturn::class);
    }

    /**
     * Total cost basis of this sale's items, from each item's cost_price
     * snapshot (captured at sale time — see rules.md's "create-then-update"
     * pattern discussion and SaleService::create()). Assumes items is
     * already eager-loaded to avoid N+1 queries.
     */
    public function costTotal(): string
    {
        return $this->items->reduce(
            fn (string $carry, SaleItem $item) => bcadd($carry, bcmul((string) $item->quantity, (string) ($item->cost_price ?? '0'), 2), 2),
            '0.00'
        );
    }

    public function profit(): string
    {
        return bcsub((string) $this->total_amount, $this->costTotal(), 2);
    }

    public function profitMarginPercent(): string
    {
        if (bccomp((string) $this->total_amount, '0.00', 2) <= 0) {
            return '0.00';
        }

        return bcmul(bcdiv($this->profit(), (string) $this->total_amount, 4), '100', 2);
    }
}
