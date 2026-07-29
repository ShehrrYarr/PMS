<div>
    <x-page-header>
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('expenses.title') }}</h2>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('expense-categories.index') }}" wire:navigate class="inline-flex min-h-[44px] items-center rounded-xl px-4 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('expenses.manage_categories') }}
                </a>
                <button type="button" wire:click="create" class="inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                    {{ __('expenses.add') }}
                </button>
            </div>
        </div>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <div class="mb-4 flex flex-wrap items-end gap-3">
            <div>
                <x-input-label for="filterFrom" :value="__('expenses.from')" />
                <input id="filterFrom" type="date" wire:model.live="filterFrom" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
            </div>
            <div>
                <x-input-label for="filterTo" :value="__('expenses.to')" />
                <input id="filterTo" type="date" wire:model.live="filterTo" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('expenses.date') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('expenses.category') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('expenses.description') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('expenses.paid_via') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('expenses.vendor') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('expenses.amount') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('expenses.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenses as $expense)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3 whitespace-nowrap">{{ $expense->date->format('d M Y') }}</td>
                            <td class="px-3 py-3">{{ $expense->category->name }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $expense->description ?? '—' }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">
                                {{ $expense->payment_method === 'bank' ? __('ledger.bank').' — '.($expense->bank->name ?? '—') : __('ledger.cash') }}
                            </td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $expense->vendor->name ?? '—' }}</td>
                            <td class="px-3 py-3 text-end font-bold">{{ number_format((float) $expense->amount, 2) }}</td>
                            <td class="px-3 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    @if ($expense->receipt_photo_path)
                                        <a href="{{ Illuminate\Support\Facades\Storage::disk('public')->url($expense->receipt_photo_path) }}" target="_blank" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">
                                            {{ __('expenses.receipt') }}
                                        </a>
                                    @endif
                                    <button type="button" wire:click="edit({{ $expense->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold hover:bg-black/5">
                                        {{ __('expenses.edit') }}
                                    </button>
                                    <button type="button" wire:click="delete({{ $expense->id }})" onclick="return confirm('{{ __('expenses.confirm_delete') }}')" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                                        {{ __('expenses.delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('expenses.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $expenses->links() }}
        </div>
    </div>

    <x-glass-modal show="showModal" maxWidth="max-w-xl">
        <form wire:submit="save" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">
                {{ $form->expense ? __('expenses.edit') : __('expenses.add') }}
            </h3>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <x-input-label for="date" :value="__('expenses.date')" />
                    <input id="date" type="date" wire:model="form.date" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-base font-medium text-[var(--text-primary)]">
                    <x-input-error :messages="$errors->get('form.date')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="amount" :value="__('expenses.amount')" />
                    <x-text-input id="amount" type="number" step="0.01" min="0.01" class="mt-1" wire:model="form.amount" />
                    <x-input-error :messages="$errors->get('form.amount')" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="expense_category_id" :value="__('expenses.category')" />
                <select id="expense_category_id" wire:model="form.expense_category_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-base font-medium text-[var(--text-primary)]">
                    <option value="">{{ __('expenses.select_category') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.expense_category_id')" class="mt-1" />
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <x-input-label for="payment_method" :value="__('expenses.payment_method')" />
                    <select id="payment_method" wire:model.live="form.payment_method" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-base font-medium text-[var(--text-primary)]">
                        <option value="cash">{{ __('ledger.cash') }}</option>
                        <option value="bank">{{ __('ledger.bank') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('form.payment_method')" class="mt-1" />
                </div>

                @if ($form->payment_method === 'bank')
                    <div>
                        <x-input-label for="bank_id" :value="__('ledger.bank_account')" />
                        <select id="bank_id" wire:model="form.bank_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-base font-medium text-[var(--text-primary)]">
                            <option value="">{{ __('ledger.select_bank') }}</option>
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('form.bank_id')" class="mt-1" />
                    </div>
                @endif
            </div>

            <div>
                <x-input-label for="vendor_id" :value="__('expenses.vendor_optional')" />
                <select id="vendor_id" wire:model="form.vendor_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-base font-medium text-[var(--text-primary)]">
                    <option value="">{{ __('expenses.no_vendor') }}</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.vendor_id')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="description" :value="__('expenses.description')" />
                <textarea id="description" wire:model="form.description" rows="2" class="mt-1 w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"></textarea>
                <x-input-error :messages="$errors->get('form.description')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="receiptPhoto" :value="__('expenses.receipt_photo')" />
                <input id="receiptPhoto" type="file" accept="image/*" wire:model="form.receiptPhoto" class="mt-1 block w-full text-sm text-[var(--text-primary)] file:mr-3 file:min-h-[44px] file:rounded-xl file:border-0 file:bg-[var(--navbar-primary-color)] file:px-4 file:py-2 file:text-sm file:font-bold file:text-white">
                <div wire:loading wire:target="form.receiptPhoto" class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('expenses.uploading') }}</div>
                @if ($form->expense?->receipt_photo_path && ! $form->receiptPhoto)
                    <p class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('expenses.receipt_on_file') }}</p>
                @endif
                <x-input-error :messages="$errors->get('form.receiptPhoto')" class="mt-1" />
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('expenses.cancel') }}
                </button>
                <x-primary-button>{{ __('expenses.save') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
