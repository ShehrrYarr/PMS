<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidReturnQuantityException extends Exception
{
    public static function exceedsReturnable(string $requested, string $returnable): self
    {
        return new self("Cannot return {$requested} — only {$returnable} remains returnable on this line.");
    }
}
