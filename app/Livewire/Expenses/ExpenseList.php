<?php

declare(strict_types=1);

namespace App\Livewire\Expenses;

use App\Livewire\Forms\ExpenseForm;
use App\Models\Bank;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ExpenseList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public ExpenseForm $form;

    public bool $showModal = false;

    public string $filterFrom = '';

    public string $filterTo = '';

    public function mount(): void
    {
        $this->authorize('expenses.manage');
    }

    public function updatingFilterFrom(): void
    {
        $this->resetPage();
    }

    public function updatingFilterTo(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->authorize('expenses.manage');

        $this->form->resetForm();
        $this->showModal = true;
    }

    public function edit(int $expenseId): void
    {
        $this->authorize('expenses.manage');

        $expense = Expense::query()->findOrFail($expenseId);
        $this->form->setExpense($expense);
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->authorize('expenses.manage');

        $this->form->validate();

        DB::transaction(function () {
            $isNew = $this->form->expense === null;

            $expense = $isNew
                ? Expense::query()->create($this->form->attributesForSave() + ['user_id' => auth()->id()])
                : tap($this->form->expense)->update($this->form->attributesForSave());

            $this->form->storePhotoFor($expense);
        });

        $this->showModal = false;
        $this->form->resetForm();
    }

    public function delete(int $expenseId): void
    {
        $this->authorize('expenses.manage');

        $expense = Expense::query()->findOrFail($expenseId);

        if ($expense->receipt_photo_path !== null) {
            Storage::disk('public')->delete($expense->receipt_photo_path);
        }

        $expense->delete();
    }

    public function render(): View
    {
        $expenses = Expense::query()
            ->with(['category', 'bank', 'vendor'])
            ->when($this->filterFrom !== '', fn ($query) => $query->whereDate('date', '>=', $this->filterFrom))
            ->when($this->filterTo !== '', fn ($query) => $query->whereDate('date', '<=', $this->filterTo))
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate(15);

        return view('livewire.expenses.expense-list', [
            'expenses' => $expenses,
            'categories' => ExpenseCategory::query()->where('is_active', true)->orderBy('name')->get(),
            'banks' => Bank::query()->where('is_active', true)->orderBy('name')->get(),
            'vendors' => Vendor::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
