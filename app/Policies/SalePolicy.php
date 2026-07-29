<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Sale;
use App\Models\User;

/**
 * A posted sale is never edited (see rules.md §2 — corrections happen via a
 * sales return, not a raw edit), so there is no update ability.
 */
class SalePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('sales.view');
    }

    public function view(User $user, Sale $sale): bool
    {
        return $user->can('sales.view');
    }

    public function create(User $user): bool
    {
        return $user->can('sales.manage');
    }
}
