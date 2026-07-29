<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InsufficientStockException extends Exception
{
    public static function forBatch(string $barcode, string $requested, string $available): self
    {
        return new self("Cannot sell {$requested} from batch {$barcode} — only {$available} remains.");
    }
}
