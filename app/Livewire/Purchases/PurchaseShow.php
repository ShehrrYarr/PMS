<?php

declare(strict_types=1);

namespace App\Livewire\Purchases;

use App\Exceptions\InvalidReturnQuantityException;
use App\Models\Purchase;
use App\Services\PurchaseReturnService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PurchaseShow extends Component
{
    public Purchase $purchase;

    public bool $showReturnModal = false;

    public ?int $returningItemId = null;

    public string $returnQuantity = '';

    public string $returnReason = '';

    public function mount(Purchase $purchase): void
    {
        $this->authorize('view', $purchase);

        $this->purchase = $purchase->load(['items.product', 'items.batch', 'returns.items']);
    }

    public function openReturnForm(int $purchaseItemId): void
    {
        $this->authorize('purchase-returns.manage');

        $this->returningItemId = $purchaseItemId;
        $this->returnQuantity = '';
        $this->returnReason = '';
        $this->showReturnModal = true;
    }

    public function submitReturn(PurchaseReturnService $purchaseReturnService): void
    {
        $this->authorize('purchase-returns.manage');

        $this->validate([
            'returnQuantity' => 'required|numeric|min:0.01',
            'returnReason' => 'required|string|max:255',
        ]);

        try {
            $purchaseReturnService->create(
                purchase: $this->purchase,
                lines: [['purchase_item_id' => $this->returningItemId, 'quantity' => $this->returnQuantity]],
                reason: $this->returnReason,
                user: auth()->user(),
            );
        } catch (InvalidReturnQuantityException $e) {
            $this->addError('returnQuantity', $e->getMessage());

            return;
        }

        $this->showReturnModal = false;
        $this->purchase->refresh()->load(['items.product', 'items.batch', 'returns.items']);
        session()->flash('success', __('purchases.return_recorded'));
    }

    public function render(): View
    {
        return view('livewire.purchases.purchase-show');
    }
}
