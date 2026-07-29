<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UnbalancedPaymentSplitException extends Exception
{
    public static function forMismatch(string $expectedTotal, string $actualTotal): self
    {
        return new self("Payment split totals {$actualTotal} but the transaction total is {$expectedTotal}.");
    }
}
