<?php

declare(strict_types=1);

namespace App\Livewire\Purchases;

use App\Models\Purchase;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class PurchaseList extends Component
{
    use WithPagination;

    public function mount(): void
    {
        $this->authorize('viewAny', Purchase::class);
    }

    public function render(): View
    {
        $purchases = Purchase::query()
            ->with('vendor')
            ->latest('id')
            ->paginate(15);

        return view('livewire.purchases.purchase-list', [
            'purchases' => $purchases,
        ]);
    }
}
