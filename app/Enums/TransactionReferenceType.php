<?php

declare(strict_types=1);

namespace App\Enums;

enum TransactionReferenceType: string
{
    case Sale = 'sale';
    case Purchase = 'purchase';
    case SaleReturn = 'sale_return';
    case PurchaseReturn = 'purchase_return';
    case Payment = 'payment';
}
