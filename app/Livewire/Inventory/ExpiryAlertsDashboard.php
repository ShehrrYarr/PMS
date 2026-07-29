<?php

declare(strict_types=1);

namespace App\Livewire\Inventory;

use App\Services\ExpiryAlertService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ExpiryAlertsDashboard extends Component
{
    public function mount(): void
    {
        $this->authorize('expiry-alerts.view');
    }

    public function render(ExpiryAlertService $expiryAlertService): View
    {
        return view('livewire.inventory.expiry-alerts-dashboard', [
            'batches' => $expiryAlertService->expiringWithin(30),
        ]);
    }
}
