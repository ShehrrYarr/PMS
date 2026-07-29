<?php

declare(strict_types=1);

namespace App\Livewire\Pos;

use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class SaleList extends Component
{
    use WithPagination;

    public function mount(): void
    {
        $this->authorize('viewAny', Sale::class);
    }

    public function render(): View
    {
        $sales = Sale::query()
            ->with('customer')
            ->latest('id')
            ->paginate(15);

        return view('livewire.pos.sale-list', [
            'sales' => $sales,
        ]);
    }
}
