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

    /**
     * $context is a batch barcode for a per-item discount, or the literal
     * string "sale" for the whole-cart discount.
     */
    public static function forNegativeDiscountValue(string $context, string $value): self
    {
        return new self("Discount on {$context} cannot be negative ({$value}).");
    }

    public static function forInvalidDiscountPercentage(string $context, string $value): self
    {
        return new self("Percentage discount on {$context} must be between 0 and 100 ({$value}).");
    }

    public static function forDiscountExceedsSubtotal(string $context, string $discountAmount, string $subtotal): self
    {
        return new self("Discount on {$context} ({$discountAmount}) cannot exceed its subtotal ({$subtotal}).");
    }
}
