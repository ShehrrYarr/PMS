<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A parked cart. Not a financial record — nothing reports on it and it's
 * deleted the moment it's resumed or discarded, which is why the cart lives
 * in a JSON payload rather than normalised line-item tables.
 */
class HeldOrder extends Model
{
    use BelongsToShop;

    protected $fillable = [
        'shop_id',
        'user_id',
        'client_uuid',
        'label',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Number of cart lines, for the "3 items" hint on the held-orders list —
     * guarded because the payload is client-supplied JSON.
     */
    public function itemCount(): int
    {
        $items = $this->payload['cart'] ?? [];

        return is_array($items) ? count($items) : 0;
    }
}
