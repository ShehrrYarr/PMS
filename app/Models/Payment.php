<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PayableType;
use App\Enums\PaymentMethod;
use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use BelongsToShop;

    protected $fillable = [
        'shop_id',
        'payable_type',
        'payable_id',
        'method',
        'bank_id',
        'amount',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'payable_type' => PayableType::class,
            'method' => PaymentMethod::class,
            'amount' => 'decimal:2',
        ];
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
