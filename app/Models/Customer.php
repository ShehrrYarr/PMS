<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use BelongsToShop, HasFactory;

    protected $fillable = [
        'shop_id',
        'name',
        'phone',
        'address',
        'opening_balance',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'opening_balance' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return HasMany<CustomerLedger, $this>
     */
    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(CustomerLedger::class);
    }

    public function currentBalance(): string
    {
        return $this->ledgerEntries()->latest('id')->value('running_balance') ?? '0.00';
    }
}
