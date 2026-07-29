<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Vendor;

/**
 * Vendors are never hard-deleted (see rules.md — financial records never
 * disappear); deactivating is just an update, so there is no delete ability.
 */
class VendorPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('vendors.view');
    }

    public function view(User $user, Vendor $vendor): bool
    {
        return $user->can('vendors.view');
    }

    public function create(User $user): bool
    {
        return $user->can('vendors.manage');
    }

    public function update(User $user, Vendor $vendor): bool
    {
        return $user->can('vendors.manage');
    }
}
