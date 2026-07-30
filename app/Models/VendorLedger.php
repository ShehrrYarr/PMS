<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LogicException;

/**
 * Insert-only financial ledger row. Never update or delete an existing row —
 * post a reversing entry instead (see rules.md §2 rule 1).
 */
class VendorLedger extends Model
{
    use BelongsToShop;

    public const UPDATED_AT = null;

    protected $fillable = [
        'shop_id',
        'vendor_id',
        'debit',
        'credit',
        'running_balance',
        'reference_type',
        'reference_id',
        'description',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'debit' => 'decimal:2',
            'credit' => 'decimal:2',
            'running_balance' => 'decimal:2',
        ];
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(array $attributes = [], array $options = []): bool
    {
        throw new LogicException('Ledger entries are immutable; post a reversing entry instead.');
    }

    public function delete(): ?bool
    {
        throw new LogicException('Ledger entries are immutable; they can never be deleted.');
    }
}
