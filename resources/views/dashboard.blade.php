<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">
            {{ __('nav.dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        @php
            $banners = \App\Models\Banner::query()->orderBy('id')->get();
            $bannerIntervalSeconds = \App\Models\ThemeSetting::current()->banner_interval_seconds;
        @endphp
        @if ($banners->isNotEmpty())
            <div
                x-data="{
                    banners: @js($banners->map(fn ($b) => Illuminate\Support\Facades\Storage::disk('public')->url($b->image_path))->all()),
                    index: 0,
                    timer: null,
                }"
                x-init="timer = setInterval(() => { index = (index + 1) % banners.length }, {{ max(2, $bannerIntervalSeconds) }} * 1000)"
                x-on:livewire:navigate.window="clearInterval(timer)"
                class="glass-panel relative h-32 overflow-hidden p-0 sm:h-48 lg:h-56"
            >
                <template x-for="(src, i) in banners" :key="i">
                    <img
                        :src="src"
                        x-show="index === i"
                        x-transition:enter="transition ease-in-out duration-700"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in-out duration-700"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 h-full w-full object-cover"
                        alt=""
                    >
                </template>
            </div>
        @endif

        <div class="glass-panel px-6 py-8">
            <p class="text-lg font-semibold text-[var(--text-primary)]">
                {{ __('nav.welcome', ['name' => auth()->user()->name]) }}
            </p>
            <p class="mt-2 text-base text-[var(--text-secondary)]">
                {{ __('nav.signed_in_as') }}
                <span class="font-bold text-[var(--text-primary)]">{{ auth()->user()->getRoleNames()->first() }}</span>
            </p>
        </div>

        @can('reports.view')
            @php $todaysReport = app(\App\Services\DashboardReportService::class)->todaysSummary(); @endphp
            <div>
                <h3 class="mb-3 text-lg font-bold text-[var(--text-primary)]">{{ __('dashboard.todays_report') }}</h3>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                    <div class="glass-panel px-4 py-4">
                        <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('dashboard.sales') }}</p>
                        <p class="mt-1 text-xl font-bold text-[var(--text-primary)]">{{ money($todaysReport['sales_total']) }}</p>
                    </div>
                    <div class="glass-panel px-4 py-4">
                        <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('dashboard.returns') }}</p>
                        <p class="mt-1 text-xl font-bold text-[var(--color-danger)]">{{ money($todaysReport['returns_total']) }}</p>
                    </div>
                    <div class="glass-panel px-4 py-4">
                        <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('dashboard.payment_ins') }}</p>
                        <p class="mt-1 text-xl font-bold text-[var(--color-success)]">{{ money($todaysReport['payment_ins_total']) }}</p>
                    </div>
                    <div class="glass-panel px-4 py-4">
                        <p class="text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('dashboard.expenses') }}</p>
                        <p class="mt-1 text-xl font-bold text-[var(--color-danger)]">{{ money($todaysReport['expenses_total']) }}</p>
                    </div>
                </div>

                <div class="mt-3 glass-panel p-4 sm:p-5">
                    <p class="mb-3 text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('dashboard.sales') }} — {{ __('dashboard.cash') }} / {{ __('dashboard.bank') }}</p>
                    <div class="flex flex-wrap gap-3">
                        <div class="rounded-xl bg-black/5 px-4 py-3">
                            <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ __('dashboard.cash') }}</p>
                            <p class="text-lg font-bold text-[var(--text-primary)]">{{ money($todaysReport['cash_total']) }}</p>
                        </div>
                        @forelse ($todaysReport['bank_breakdown'] as $bank)
                            <div class="rounded-xl bg-black/5 px-4 py-3">
                                <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ __('dashboard.bank') }} — {{ $bank['name'] }}</p>
                                <p class="text-lg font-bold text-[var(--text-primary)]">{{ money($bank['amount']) }}</p>
                            </div>
                        @empty
                            <div class="rounded-xl bg-black/5 px-4 py-3">
                                <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ __('dashboard.bank') }}</p>
                                <p class="text-lg font-bold text-[var(--text-primary)]">{{ money(0) }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            @php
                $salesTrend = app(\App\Services\DashboardReportService::class)->salesTrend(30);
                $cashVsBank = app(\App\Services\DashboardReportService::class)->cashVsBankBreakdown(30);
                $topProducts = app(\App\Services\DashboardReportService::class)->topSellingProducts(30, 8);
            @endphp
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="glass-panel p-4 sm:p-5 lg:col-span-2">
                    <p class="mb-3 text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('dashboard.sales_trend_30') }}</p>
                    <div class="h-64">
                        <canvas
                            id="chart-sales-trend"
                            data-chart="line"
                            data-labels="{{ json_encode(array_column($salesTrend, 'date')) }}"
                            data-values="{{ json_encode(array_column($salesTrend, 'total')) }}"
                        ></canvas>
                    </div>
                </div>

                <div class="glass-panel p-4 sm:p-5">
                    <p class="mb-3 text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('dashboard.cash_vs_bank_30') }}</p>
                    <div class="h-64">
                        <canvas
                            id="chart-cash-bank"
                            data-chart="doughnut"
                            data-labels="{{ json_encode(array_merge([__('dashboard.cash')], array_column($cashVsBank['banks'], 'name'))) }}"
                            data-values="{{ json_encode(array_merge([$cashVsBank['cash']], array_column($cashVsBank['banks'], 'amount'))) }}"
                        ></canvas>
                    </div>
                </div>

                <div class="glass-panel p-4 sm:p-5 lg:col-span-3">
                    <p class="mb-3 text-xs font-semibold uppercase text-[var(--text-secondary)]">{{ __('dashboard.top_products_30') }}</p>
                    <div class="h-64">
                        <canvas
                            id="chart-top-products"
                            data-chart="bar"
                            data-labels="{{ json_encode(array_column($topProducts, 'name')) }}"
                            data-values="{{ json_encode(array_column($topProducts, 'quantity')) }}"
                        ></canvas>
                    </div>
                </div>
            </div>

            <script>
                (function () {
                    const instances = {};

                    function themeColor(name, fallback) {
                        const value = getComputedStyle(document.documentElement).getPropertyValue(name).trim();

                        return value || fallback;
                    }

                    function destroyAll() {
                        Object.values(instances).forEach((chart) => chart.destroy());
                    }

                    function moneyFormat(value) {
                        return 'PKR ' + Math.round(value).toLocaleString();
                    }

                    function renderChart(id, type, extra, isMoney) {
                        const canvas = document.getElementById(id);

                        if (! canvas || ! window.Chart) {
                            return;
                        }

                        const labels = JSON.parse(canvas.dataset.labels || '[]');
                        const values = JSON.parse(canvas.dataset.values || '[]').map(Number);

                        instances[id] = new window.Chart(canvas, {
                            type,
                            data: {
                                labels,
                                datasets: [Object.assign({ data: values }, extra)],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: type !== 'line' },
                                    tooltip: isMoney ? {
                                        callbacks: {
                                            label: (ctx) => moneyFormat(ctx.parsed.y ?? ctx.parsed),
                                        },
                                    } : undefined,
                                },
                                scales: isMoney && type !== 'doughnut' ? {
                                    y: { ticks: { callback: (v) => moneyFormat(v) } },
                                } : undefined,
                            },
                        });
                    }

                    function initCharts() {
                        if (! document.getElementById('chart-sales-trend')) {
                            return;
                        }

                        destroyAll();

                        const primary = themeColor('--navbar-primary-color', '#2f6f4f');
                        const accent = themeColor('--navbar-accent-color', '#e8f5ee');
                        const palette = [primary, '#c1552c', '#1e5f8c', '#5b3a8e', '#c19a2c', '#2c8c7a', '#8c2c5b', '#5b8c2c'];

                        renderChart('chart-sales-trend', 'line', {
                            label: '{{ __('dashboard.sales') }}',
                            borderColor: primary,
                            backgroundColor: accent,
                            fill: true,
                            tension: 0.3,
                            pointRadius: 0,
                        }, true);

                        renderChart('chart-cash-bank', 'doughnut', {
                            backgroundColor: palette,
                        }, true);

                        renderChart('chart-top-products', 'bar', {
                            label: '{{ __('dashboard.quantity_sold') }}',
                            backgroundColor: primary,
                            borderRadius: 6,
                        });
                    }

                    document.addEventListener('livewire:navigated', initCharts);
                })();
            </script>
        @endcan

        @can('expiry-alerts.view')
            @php $expiringCount = app(\App\Services\ExpiryAlertService::class)->expiringWithin(30)->count(); @endphp
            @if ($expiringCount > 0)
                <a href="{{ route('expiry-alerts.index') }}" wire:navigate class="glass-panel block px-6 py-4 transition hover:opacity-90">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base font-bold text-[var(--color-danger)]">{{ __('alerts.title') }}</p>
                            <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ __('alerts.dashboard_summary', ['count' => $expiringCount]) }}</p>
                        </div>
                        <span class="rounded-full bg-[var(--color-danger)]/10 px-4 py-2 text-2xl font-bold text-[var(--color-danger)]">{{ $expiringCount }}</span>
                    </div>
                </a>
            @endif
        @endcan
    </div>
</x-app-layout>
