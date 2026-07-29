<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(VendorLedger::class);
    }

    public function currentBalance(): string
    {
        return $this->ledgerEntries()->latest('id')->value('running_balance') ?? '0.00';
    }
}
