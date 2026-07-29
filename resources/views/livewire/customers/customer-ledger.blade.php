<div>
    <x-page-header>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ $customer->name }}</h2>
                <p class="text-base font-semibold text-[var(--text-secondary)]">
                    {{ __('ledger.balance') }}:
                    <span class="font-bold text-[var(--text-primary)]">{{ number_format((float) $currentBalance, 2) }}</span>
                </p>
            </div>
            @can('payments.manage')
                <button type="button" wire:click="openPaymentForm" class="inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                    {{ __('ledger.record_payment') }}
                </button>
            @endcan
        </div>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <div class="mb-4 flex flex-wrap gap-3">
            <div>
                <x-input-label for="dateFrom" :value="__('ledger.from')" />
                <input id="dateFrom" type="date" wire:model.live="dateFrom" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
            </div>
            <div>
                <x-input-label for="dateTo" :value="__('ledger.to')" />
                <input id="dateTo" type="date" wire:model.live="dateTo" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('ledger.date') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('ledger.description') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('ledger.debit') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('ledger.credit') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('ledger.running_balance') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entries as $entry)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $entry->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-3 py-3">
                                @php
                                    $saleId = match ($entry->reference_type) {
                                        'sale' => $entry->reference_id,
                                        'sale_return' => $saleIdsByReturnId[$entry->reference_id] ?? null,
                                        default => null,
                                    };
                                @endphp
                                @if ($saleId && auth()->user()->can('sales.view'))
                                    <a href="{{ route('sales.show', $saleId) }}" wire:navigate class="font-semibold text-[var(--color-info)] hover:underline">
                                        {{ $entry->description ?? ucfirst(str_replace('_', ' ', $entry->reference_type)) }}
                                    </a>
                                @else
                                    {{ $entry->description ?? ucfirst(str_replace('_', ' ', $entry->reference_type)) }}
                                @endif
                            </td>
                            <td class="px-3 py-3 text-end">{{ (float) $entry->debit > 0 ? number_format((float) $entry->debit, 2) : '—' }}</td>
                            <td class="px-3 py-3 text-end">{{ (float) $entry->credit > 0 ? number_format((float) $entry->credit, 2) : '—' }}</td>
                            <td class="px-3 py-3 text-end font-bold">{{ number_format((float) $entry->running_balance, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('ledger.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $entries->links() }}
        </div>
    </div>

    <x-glass-modal show="showPaymentModal">
        <form wire:submit="recordPayment" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">{{ __('ledger.record_payment') }}</h3>

            <div>
                <x-input-label for="paymentAmount" :value="__('ledger.amount')" />
                <x-text-input id="paymentAmount" type="number" step="0.01" min="0.01" class="mt-1" wire:model="paymentAmount" required />
                <x-input-error :messages="$errors->get('paymentAmount')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="paymentMethod" :value="__('ledger.method')" />
                <select id="paymentMethod" wire:model.live="paymentMethod" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                    <option value="cash">{{ __('ledger.cash') }}</option>
                    <option value="bank">{{ __('ledger.bank') }}</option>
                </select>
                <x-input-error :messages="$errors->get('paymentMethod')" class="mt-1" />
            </div>

            @if ($paymentMethod === 'bank')
                <div>
                    <x-input-label for="bankId" :value="__('ledger.bank_account')" />
                    <select id="bankId" wire:model="bankId" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                        <option value="">{{ __('ledger.select_bank') }}</option>
                        @foreach ($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('bankId')" class="mt-1" />
                </div>
            @endif

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showPaymentModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('customers.cancel') }}
                </button>
                <x-primary-button>{{ __('customers.save') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
