<div>
    <x-page-header>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('pos.sales_history') }}</h2>
            @can('create', App\Models\Sale::class)
                <a href="{{ route('pos.index') }}" wire:navigate class="inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                    {{ __('pos.title') }}
                </a>
            @endcan
        </div>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('purchases.invoice') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('pos.customer') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('purchases.date') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('purchases.total') }}</th>
                        <th class="px-3 py-2 text-center">{{ __('purchases.status') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('purchases.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3 font-mono text-sm">{{ $sale->invoice_number }}</td>
                            <td class="px-3 py-3">{{ $sale->customer->name ?? __('pos.walk_in') }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-3 py-3 text-end font-bold">{{ money($sale->total_amount) }}</td>
                            <td class="px-3 py-3 text-center">
                                <span class="rounded-full bg-black/5 px-3 py-1 text-xs font-bold text-[var(--text-secondary)]">
                                    {{ __('purchases.status_'.$sale->status) }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-end">
                                <a href="{{ route('sales.show', $sale) }}" wire:navigate class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">
                                    {{ __('purchases.view') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('pos.no_sales') }}</td>
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
