<?php

declare(strict_types=1);

if (! function_exists('money')) {
    /**
     * Formats a monetary amount for display as whole-number PKR (e.g. "PKR 1,500").
     *
     * Storage and calculations stay bcmath/decimal:2-precise everywhere else
     * (see rules.md §2) — this only rounds what's shown to the user, since
     * PKR amounts are conventionally displayed without paisa.
     */
    function money(string|int|float $amount): string
    {
        return 'PKR '.number_format((float) $amount, 0);
    }
}
