<?php

declare(strict_types=1);

namespace App\Livewire\Expenses;

use App\Models\ExpenseCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ExpenseCategoryManager extends Component
{
    public ?int $editingCategoryId = null;

    public string $name = '';

    public bool $showModal = false;

    public function mount(): void
    {
        $this->authorize('expenses.manage');
    }

    public function create(): void
    {
        $this->authorize('expenses.manage');

        $this->reset(['editingCategoryId', 'name']);
        $this->showModal = true;
    }

    public function edit(int $categoryId): void
    {
        $this->authorize('expenses.manage');

        $category = ExpenseCategory::query()->findOrFail($categoryId);
        $this->editingCategoryId = $category->id;
        $this->name = $category->name;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->authorize('expenses.manage');

        $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('expense_categories', 'name')->where('shop_id', Auth::user()->shop_id)->ignore($this->editingCategoryId),
            ],
        ]);

        if ($this->editingCategoryId === null) {
            ExpenseCategory::query()->create(['name' => $this->name]);
        } else {
            ExpenseCategory::query()->whereKey($this->editingCategoryId)->update(['name' => $this->name]);
        }

        $this->showModal = false;
        $this->reset(['editingCategoryId', 'name']);
    }

    public function toggleActive(int $categoryId): void
    {
        $this->authorize('expenses.manage');

        $category = ExpenseCategory::query()->findOrFail($categoryId);
        $category->update(['is_active' => ! $category->is_active]);
    }

    public function render(): View
    {
        return view('livewire.expenses.expense-category-manager', [
            'categories' => ExpenseCategory::query()->withCount('expenses')->orderBy('name')->get(),
        ]);
    }
}
