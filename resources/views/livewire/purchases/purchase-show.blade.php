<div>
    <x-page-header>
        <div>
            <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ $purchase->invoice_number }}</h2>
            <p class="text-base font-semibold text-[var(--text-secondary)]">
                {{ $purchase->vendor->name }} — {{ $purchase->created_at->format('Y-m-d H:i') }}
            </p>
        </div>
    </x-page-header>

    <div class="space-y-6">
        <div class="glass-panel p-4 sm:p-6">
            <h3 class="mb-4 text-lg font-bold text-[var(--text-primary)]">{{ __('purchases.line_items') }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] text-start">
                    <thead>
                        <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                            <th class="px-3 py-2 text-start">{{ __('purchases.product') }}</th>
                            <th class="px-3 py-2 text-start">{{ __('batches.barcode') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('purchases.quantity') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('purchases.returned') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('purchases.cost_price') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('purchases.line_total') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('purchases.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase->items as $item)
                            <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                                <td class="px-3 py-3">{{ $item->product->name }}</td>
                                <td class="px-3 py-3 font-mono text-sm text-[var(--text-secondary)]">{{ $item->batch->barcode ?? '—' }}</td>
                                <td class="px-3 py-3 text-end">{{ number_format((float) $item->quantity, 0) }}</td>
                                <td class="px-3 py-3 text-end text-[var(--text-secondary)]">{{ number_format((float) $item->quantity_returned, 0) }}</td>
                                <td class="px-3 py-3 text-end">{{ money($item->cost_price) }}</td>
                                <td class="px-3 py-3 text-end font-bold">{{ money($item->line_total) }}</td>
                                <td class="px-3 py-3 text-end">
                                    @can('purchase-returns.manage')
                                        @if (bccomp($item->returnableQuantity(), '0', 2) > 0)
                                            <button type="button" wire:click="openReturnForm({{ $item->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                                                {{ __('purchases.return') }}
                                            </button>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="px-3 py-3 text-end text-base font-bold text-[var(--text-primary)]">{{ __('purchases.total') }}</td>
                            <td class="px-3 py-3 text-end text-base font-bold text-[var(--text-primary)]">{{ money($purchase->total_amount) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if ($purchase->returns->isNotEmpty())
            <div class="glass-panel p-4 sm:p-6">
                <h3 class="mb-4 text-lg font-bold text-[var(--text-primary)]">{{ __('purchases.returns_history') }}</h3>
                <div class="space-y-2">
                    @foreach ($purchase->returns as $return)
                        <div class="rounded-xl border border-black/10 bg-white/50 p-3">
                            <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ $return->created_at->format('Y-m-d H:i') }} — {{ $return->reason }}</p>
                            <p class="text-base font-bold text-[var(--color-danger)]">{{ money(-1 * (float) $return->total_amount) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <x-glass-modal show="showReturnModal">
        <form wire:submit="submitReturn" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">{{ __('purchases.return') }}</h3>

            <div>
                <x-input-label for="returnQuantity" :value="__('purchases.quantity')" />
                <x-text-input id="returnQuantity" type="number" step="1" min="1" class="mt-1" wire:model="returnQuantity" />
                <x-input-error :messages="$errors->get('returnQuantity')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="returnReason" :value="__('purchases.reason')" />
                <x-text-input id="returnReason" type="text" class="mt-1" wire:model="returnReason" />
                <x-input-error :messages="$errors->get('returnReason')" class="mt-1" />
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showReturnModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('vendors.cancel') }}
                </button>
                <x-primary-button>{{ __('vendors.save') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
