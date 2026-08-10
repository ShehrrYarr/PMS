<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\DiscountType;

/**
 * Turns a discount type + the value a cashier typed into the actual PKR
 * amount to subtract, at bcmath scale 2.
 *
 * The percentage formula mirrors the existing bcmul(bcdiv($profit, $total, 4),
 * '100', 2) idiom already used by Sale::profitMarginPercent() — multiply at
 * scale 4 first (exact, since both operands are already ≤2dp so the product
 * has ≤4dp and nothing is lost), then divide by 100 truncating to scale 2,
 * which is where real truncation happens. resources/js/offline/money.js's
 * percentOf() must produce byte-identical results to this method — a
 * mismatch here is the exact bug class that once made money.js reject a
 * paid-for offline sale as "unbalanced" after the fact.
 */
final class DiscountCalculator
{
    public function amount(string $subtotal, ?string $type, ?string $value): string
    {
        if ($type === null || $value === null) {
            return '0.00';
        }

        return match ($type) {
            DiscountType::Flat->value => bcadd($value, '0', 2),
            DiscountType::Percentage->value => bcdiv(bcmul($subtotal, $value, 4), '100', 2),
            default => '0.00',
        };
    }
}
