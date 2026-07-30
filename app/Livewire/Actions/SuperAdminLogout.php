<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SuperAdminLogout
{
    /**
     * Log the current super admin out of the control panel.
     */
    public function __invoke(): void
    {
        Auth::guard('super_admin')->logout();

        Session::invalidate();
        Session::regenerateToken();
    }
}
