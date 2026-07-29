<div>
    <x-page-header>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ $sale->invoice_number }}</h2>
                <p class="text-base font-semibold text-[var(--text-secondary)]">
                    {{ $sale->customer->name ?? __('pos.walk_in') }} — {{ $sale->created_at->format('Y-m-d H:i') }}
                </p>
            </div>
            <a href="{{ route('sales.receipt', $sale) }}" target="_blank" class="inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                {{ __('batches.print') }} {{ __('receipt.title') }}
            </a>
        </div>
    </x-page-header>

    <div class="space-y-6">
        @if ($sale->photo_path)
            <div class="glass-panel p-4 sm:p-6">
                <h3 class="mb-4 text-lg font-bold text-[var(--text-primary)]">{{ __('pos.customer_photo') }}</h3>
                <a href="{{ Illuminate\Support\Facades\Storage::disk('public')->url($sale->photo_path) }}" target="_blank">
                    <img
                        src="{{ Illuminate\Support\Facades\Storage::disk('public')->url($sale->photo_path) }}"
                        alt="{{ __('pos.customer_photo') }}"
                        class="h-32 w-32 rounded-xl border border-black/10 object-cover shadow-sm hover:opacity-90"
                    >
                </a>
            </div>
        @endif

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
                            <th class="px-3 py-2 text-end">{{ __('pos.price') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('purchases.line_total') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('purchases.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale->items as $item)
                            <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                                <td class="px-3 py-3">{{ $item->batch->product->name }}</td>
                                <td class="px-3 py-3 font-mono text-sm text-[var(--text-secondary)]">{{ $item->batch->barcode }}</td>
                                <td class="px-3 py-3 text-end">{{ number_format((float) $item->quantity, 2) }}</td>
                                <td class="px-3 py-3 text-end text-[var(--text-secondary)]">{{ number_format((float) $item->quantity_returned, 2) }}</td>
                                <td class="px-3 py-3 text-end">{{ number_format((float) $item->unit_price, 2) }}</td>
                                <td class="px-3 py-3 text-end font-bold">{{ number_format((float) $item->line_total, 2) }}</td>
                                <td class="px-3 py-3 text-end">
                                    @can('sale-returns.manage')
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
                            <td class="px-3 py-3 text-end text-base font-bold text-[var(--text-primary)]">{{ number_format((float) $sale->total_amount, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if ($sale->returns->isNotEmpty())
            <div class="glass-panel p-4 sm:p-6">
                <h3 class="mb-4 text-lg font-bold text-[var(--text-primary)]">{{ __('purchases.returns_history') }}</h3>
                <div class="space-y-2">
                    @foreach ($sale->returns as $return)
                        <div class="rounded-xl border border-black/10 bg-white/50 p-3">
                            <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ $return->created_at->format('Y-m-d H:i') }} — {{ $return->reason }}</p>
                            <p class="text-base font-bold text-[var(--color-danger)]">-{{ number_format((float) $return->total_amount, 2) }}</p>
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
                <x-text-input id="returnQuantity" type="number" step="0.01" min="0.01" class="mt-1" wire:model="returnQuantity" />
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
