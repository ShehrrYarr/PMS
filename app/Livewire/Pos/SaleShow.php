<?php

declare(strict_types=1);

namespace App\Livewire\Pos;

use App\Exceptions\InvalidReturnQuantityException;
use App\Models\Sale;
use App\Services\SaleReturnService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class SaleShow extends Component
{
    public Sale $sale;

    public bool $showReturnModal = false;

    public ?int $returningItemId = null;

    public string $returnQuantity = '';

    public string $returnReason = '';

    public function mount(Sale $sale): void
    {
        $this->authorize('view', $sale);

        $this->sale = $sale->load(['items.batch.product', 'customer', 'returns.items']);
    }

    public function openReturnForm(int $saleItemId): void
    {
        $this->authorize('sale-returns.manage');

        $this->returningItemId = $saleItemId;
        $this->returnQuantity = '';
        $this->returnReason = '';
        $this->showReturnModal = true;
    }

    public function submitReturn(SaleReturnService $saleReturnService): void
    {
        $this->authorize('sale-returns.manage');

        $this->validate([
            'returnQuantity' => 'required|integer|min:1',
            'returnReason' => 'required|string|max:255',
        ]);

        try {
            $saleReturnService->create(
                sale: $this->sale,
                lines: [['sale_item_id' => $this->returningItemId, 'quantity' => $this->returnQuantity]],
                reason: $this->returnReason,
                user: auth()->user(),
            );
        } catch (InvalidReturnQuantityException $e) {
            $this->addError('returnQuantity', $e->getMessage());

            return;
        }

        $this->showReturnModal = false;
        $this->sale->refresh()->load(['items.batch.product', 'customer', 'returns.items']);
        session()->flash('success', __('purchases.return_recorded'));
    }

    public function render(): View
    {
        return view('livewire.pos.sale-show');
    }
}
