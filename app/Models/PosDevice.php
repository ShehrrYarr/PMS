<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A browser that has been put into offline POS mode. Its id doubles as the
 * device number inside offline invoice numbers — see nextInvoiceNumber().
 */
class PosDevice extends Model
{
    use BelongsToShop;

    protected $fillable = [
        'shop_id',
        'user_id',
        'label',
        'last_invoice_seq',
        'last_synced_at',
    ];

    protected function casts(): array
    {
        return [
            'last_invoice_seq' => 'integer',
            'last_synced_at' => 'datetime',
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
     * Formats an offline invoice number for this device, e.g. SL-OFF3-0007.
     *
     * The device id is a global auto-increment, so these can never collide
     * across shops — which matters because sales.invoice_number is unique on
     * the column alone. The sequence is deliberately NOT zero-padded beyond
     * four digits: a till that somehow rings up more than 9999 sales in one
     * offline stretch keeps working, it just prints a longer number.
     */
    public function formatInvoiceNumber(int $sequence): string
    {
        return sprintf('SL-OFF%d-%04d', $this->id, $sequence);
    }
}
