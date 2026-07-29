<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * What a payments row settles. sale/purchase back a transaction line item
 * (see architecture.md §3.17); vendor/customer back a standalone ledger
 * settlement recorded outside of any sale/purchase (see phases.md Phase 2).
 */
enum PayableType: string
{
    case Sale = 'sale';
    case Purchase = 'purchase';
    case Vendor = 'vendor';
    case Customer = 'customer';
}
