<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UnbalancedPaymentSplitException;

/**
 * Decimal-safe sum-to-total validator, shared by every flow that accepts a
 * split payment (purchases now, sales/POS in Phase 5) — see rules.md §2
 * rule 3. Never compares floats; every amount is handled as a bcmath string.
 */
class PaymentSplitService
{
    /**
     * @param  list<array{amount: string}>  $paymentLines
     *
     * @throws UnbalancedPaymentSplitException
     */
    public function assertBalanced(array $paymentLines, string $expectedTotal): void
    {
        $sum = array_reduce(
            $paymentLines,
            fn (string $carry, array $line) => bcadd($carry, $line['amount'], 2),
            '0.00',
        );

        if (bccomp($sum, $expectedTotal, 2) !== 0) {
            throw UnbalancedPaymentSplitException::forMismatch($expectedTotal, $sum);
        }
    }
}
