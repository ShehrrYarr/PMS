<div>
    <x-page-header>
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('reports.sales_title') }}</h2>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <div class="mb-4 flex flex-wrap gap-2">
            <button type="button" wire:click="applyPreset('today')" class="min-h-[40px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                {{ __('reports.today') }}
            </button>
            <button type="button" wire:click="applyPreset('yesterday')" class="min-h-[40px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                {{ __('reports.yesterday') }}
            </button>
            <button type="button" wire:click="applyPreset('last_week')" class="min-h-[40px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                {{ __('reports.last_week') }}
            </button>
            <button type="button" wire:click="applyPreset('last_month')" class="min-h-[40px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                {{ __('reports.last_month') }}
            </button>
            <button type="button" wire:click="applyPreset('last_year')" class="min-h-[40px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                {{ __('reports.last_year') }}
            </button>
            <button type="button" wire:click="applyPreset('all_time')" class="min-h-[40px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-secondary)] hover:bg-black/10">
                {{ __('reports.all_time') }}
            </button>
        </div>

        <div class="mb-4 flex flex-wrap items-end gap-3">
            <div>
                <x-input-label for="dateFrom" :value="__('reports.from')" />
                <input id="dateFrom" type="date" wire:model.live="dateFrom" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
            </div>
            <div>
                <x-input-label for="dateTo" :value="__('reports.to')" />
                <input id="dateTo" type="date" wire:model.live="dateTo" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
            </div>
            <div>
                <x-input-label for="customerId" :value="__('reports.customer')" />
                <select id="customerId" wire:model.live="customerId" class="mt-1 min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                    <option value="">{{ __('reports.all_customers') }}</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full max-w-xs sm:w-56">
                <x-input-label for="productId" :value="__('reports.product')" />
                <div class="mt-1">
                    <x-searchable-select wire:model.live="productId" :options="$products" :placeholder="__('reports.all_products')" />
                </div>
            </div>
        </div>

        <div class="mb-4 grid grid-cols-2 gap-3 sm:grid-cols-4 {{ $productId !== null ? 'lg:grid-cols-5' : '' }}">
            <div class="rounded-xl bg-black/5 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.sale_total') }}</p>
                <p class="mt-1 text-lg font-bold text-[var(--text-primary)]">{{ money($summary['sales_total']) }}</p>
            </div>
            <div class="rounded-xl bg-black/5 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.cost') }}</p>
                <p class="mt-1 text-lg font-bold text-[var(--text-primary)]">{{ money($summary['cost_total']) }}</p>
            </div>
            <div class="rounded-xl bg-black/5 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.profit') }}</p>
                <p class="mt-1 text-lg font-bold text-[var(--color-success)]">{{ money($summary['profit_total']) }}</p>
            </div>
            <div class="rounded-xl bg-black/5 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.margin') }}</p>
                <p class="mt-1 text-lg font-bold text-[var(--text-primary)]">{{ number_format((float) $summary['margin_percent'], 2) }}%</p>
            </div>
            @if ($productId !== null)
                <div class="rounded-xl bg-black/5 px-4 py-3">
                    <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.quantity_sold') }}</p>
                    <p class="mt-1 text-lg font-bold text-[var(--text-primary)]">{{ number_format((float) $summary['quantity_sold'], 2) }}</p>
                </div>
            @endif
        </div>

        @if ($productId === null)
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] text-start">
                    <thead>
                        <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                            <th class="px-3 py-2 text-start">{{ __('reports.date') }}</th>
                            <th class="px-3 py-2 text-start">{{ __('reports.invoice') }}</th>
                            <th class="px-3 py-2 text-start">{{ __('reports.customer') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.sale_total') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.cost') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.profit') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.margin') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $sale)
                            <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                                <td class="px-3 py-3 whitespace-nowrap text-[var(--text-secondary)]">{{ $sale->created_at->format('d M Y') }}</td>
                                <td class="px-3 py-3">
                                    <a href="{{ route('sales.show', $sale) }}" wire:navigate class="font-semibold text-[var(--color-info)] hover:underline">
                                        {{ $sale->invoice_number }}
                                    </a>
                                </td>
                                <td class="px-3 py-3">{{ $sale->customer->name ?? __('reports.walk_in') }}</td>
                                <td class="px-3 py-3 text-end font-bold">{{ money($sale->total_amount) }}</td>
                                <td class="px-3 py-3 text-end text-[var(--text-secondary)]">{{ money($sale->costTotal()) }}</td>
                                <td class="px-3 py-3 text-end text-[var(--color-success)]">{{ money($sale->profit()) }}</td>
                                <td class="px-3 py-3 text-end">{{ number_format((float) $sale->profitMarginPercent(), 2) }}%</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('reports.none') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $sales->links() }}
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[820px] text-start">
                    <thead>
                        <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                            <th class="px-3 py-2 text-start">{{ __('reports.date') }}</th>
                            <th class="px-3 py-2 text-start">{{ __('reports.invoice') }}</th>
                            <th class="px-3 py-2 text-start">{{ __('reports.customer') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.quantity') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.unit_price') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.sale_total') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.cost') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.profit') }}</th>
                            <th class="px-3 py-2 text-end">{{ __('reports.margin') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($saleItems as $item)
                            <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                                <td class="px-3 py-3 whitespace-nowrap text-[var(--text-secondary)]">{{ $item->sale->created_at->format('d M Y') }}</td>
                                <td class="px-3 py-3">
                                    <a href="{{ route('sales.show', $item->sale) }}" wire:navigate class="font-semibold text-[var(--color-info)] hover:underline">
                                        {{ $item->sale->invoice_number }}
                                    </a>
                                </td>
                                <td class="px-3 py-3">{{ $item->sale->customer->name ?? __('reports.walk_in') }}</td>
                                <td class="px-3 py-3 text-end">{{ number_format((float) $item->quantity, 2) }}</td>
                                <td class="px-3 py-3 text-end">{{ money($item->unit_price) }}</td>
                                <td class="px-3 py-3 text-end font-bold">{{ money($item->line_total) }}</td>
                                <td class="px-3 py-3 text-end text-[var(--text-secondary)]">{{ money($item->costTotal()) }}</td>
                                <td class="px-3 py-3 text-end text-[var(--color-success)]">{{ money($item->profit()) }}</td>
                                <td class="px-3 py-3 text-end">{{ number_format((float) $item->profitMarginPercent(), 2) }}%</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('reports.none') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $saleItems->links() }}
            </div>
        @endif
    </div>
</div>
