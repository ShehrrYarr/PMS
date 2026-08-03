<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidSalePaymentException extends Exception
{
    public static function ledgerPaymentRequiresCustomer(): self
    {
        return new self('An on-account (ledger) payment requires a customer — walk-in sales cannot be placed on account.');
    }
}
