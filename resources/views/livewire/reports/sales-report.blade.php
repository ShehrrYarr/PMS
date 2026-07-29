<div>
    <x-page-header>
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('reports.sales_title') }}</h2>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
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
        </div>

        <div class="mb-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
            <div class="rounded-xl bg-black/5 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.sale_total') }}</p>
                <p class="mt-1 text-lg font-bold text-[var(--text-primary)]">{{ number_format((float) $summary['sales_total'], 2) }}</p>
            </div>
            <div class="rounded-xl bg-black/5 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.cost') }}</p>
                <p class="mt-1 text-lg font-bold text-[var(--text-primary)]">{{ number_format((float) $summary['cost_total'], 2) }}</p>
            </div>
            <div class="rounded-xl bg-black/5 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.profit') }}</p>
                <p class="mt-1 text-lg font-bold text-[var(--color-success)]">{{ number_format((float) $summary['profit_total'], 2) }}</p>
            </div>
            <div class="rounded-xl bg-black/5 px-4 py-3">
                <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('reports.margin') }}</p>
                <p class="mt-1 text-lg font-bold text-[var(--text-primary)]">{{ number_format((float) $summary['margin_percent'], 2) }}%</p>
            </div>
        </div>

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
                            <td class="px-3 py-3 text-end font-bold">{{ number_format((float) $sale->total_amount, 2) }}</td>
                            <td class="px-3 py-3 text-end text-[var(--text-secondary)]">{{ number_format((float) $sale->costTotal(), 2) }}</td>
                            <td class="px-3 py-3 text-end text-[var(--color-success)]">{{ number_format((float) $sale->profit(), 2) }}</td>
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
    </div>
</div>
