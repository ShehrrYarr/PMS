<?php

declare(strict_types=1);

namespace App\Livewire\Pos;

use App\Models\SaleSyncConflict;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Admin review of offline sales that oversold their batch on sync.
 *
 * These are never errors to be dismissed blindly: each one means the shop
 * physically handed over stock it didn't have on record, so the batch is now
 * negative until a purchase or a stock correction squares it up.
 */
#[Layout('layouts.app')]
class SyncConflicts extends Component
{
    use WithPagination;

    public bool $showResolved = false;

    public function mount(): void
    {
        $this->authorize('sync-conflicts.manage');
    }

    public function updatingShowResolved(): void
    {
        $this->resetPage();
    }

    public function resolve(int $conflictId): void
    {
        $this->authorize('sync-conflicts.manage');

        $conflict = SaleSyncConflict::query()->find($conflictId);

        if ($conflict === null || $conflict->resolved_at !== null) {
            return;
        }

        $conflict->update([
            'resolved_at' => now(),
            'resolved_by' => auth()->id(),
        ]);

        session()->flash('success', __('sync.conflict_resolved'));
    }

    public function render(): View
    {
        return view('livewire.pos.sync-conflicts', [
            'conflicts' => $this->conflictsQuery(),
            'unresolvedCount' => SaleSyncConflict::query()->unresolved()->count(),
        ]);
    }

    /**
     * @return LengthAwarePaginator<int, SaleSyncConflict>
     */
    private function conflictsQuery(): LengthAwarePaginator
    {
        return SaleSyncConflict::query()
            ->with(['sale', 'batch.product', 'resolver'])
            ->when(! $this->showResolved, fn ($query) => $query->unresolved())
            ->latest('id')
            ->paginate(15);
    }
}
