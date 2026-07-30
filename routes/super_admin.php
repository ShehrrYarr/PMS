<?php

declare(strict_types=1);

use App\Livewire\Actions\SuperAdminLogout;
use App\Livewire\SuperAdmin\DeveloperTools;
use App\Livewire\SuperAdmin\ShopManager;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/**
 * The Super Admin control panel — a completely separate login/guard from the
 * shop-facing app (see config/auth.php's 'super_admin' guard, and the
 * guest/auth redirect wiring in bootstrap/app.php that keeps the two
 * unauthenticated-redirect targets from crossing into each other).
 */
Route::prefix('control-panel')->name('control-panel.')->group(function () {
    Route::middleware('guest:super_admin')->group(function () {
        Volt::route('login', 'pages.auth.super-admin-login')->name('login');
    });

    Route::middleware('auth:super_admin')->group(function () {
        Route::get('/', ShopManager::class)->name('index');
        Route::get('developer-tools', DeveloperTools::class)->name('developer-tools');

        Route::post('logout', function (SuperAdminLogout $logout) {
            $logout();

            return redirect()->route('control-panel.login');
        })->name('logout');
    });
});
