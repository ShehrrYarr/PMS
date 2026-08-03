<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidSaleItemException extends Exception
{
    public static function forNonPositiveQuantity(string $barcode, string $quantity): self
    {
        return new self("Cannot sell a non-positive quantity ({$quantity}) of batch {$barcode}.");
    }

    public static function forNegativeUnitPrice(string $barcode, string $unitPrice): self
    {
        return new self("Cannot sell batch {$barcode} at a negative unit price ({$unitPrice}).");
    }
}
