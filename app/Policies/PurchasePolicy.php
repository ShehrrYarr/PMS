<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Purchase;
use App\Models\User;

/**
 * A posted purchase is never edited (see rules.md §2 — corrections happen
 * via a purchase return, not a raw edit), so there is no update ability.
 */
class PurchasePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('purchases.view');
    }

    public function view(User $user, Purchase $purchase): bool
    {
        return $user->can('purchases.view');
    }

    public function create(User $user): bool
    {
        return $user->can('purchases.manage');
    }
}
