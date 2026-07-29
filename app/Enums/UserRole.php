<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'Admin';
    case InventoryManager = 'Inventory Manager';
    case Accountant = 'Accountant';
    case Salesman = 'Salesman';
}
