@php
    $navItems = collect([
        ['label' => __('nav.dashboard'), 'route' => 'dashboard', 'permission' => null, 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['label' => __('pos.title'), 'route' => 'pos.index', 'permission' => 'sales.manage', 'icon' => 'M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.881-4.751 2.234-7.298a1.75 1.75 0 00-1.734-2.02H5.106M7.5 14.25L5.106 5.417M7.5 14.25L5.106 5.417M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z'],
        ['label' => __('pos.sales_history'), 'route' => 'sales.index', 'permission' => 'sales.view', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ['label' => __('products.title'), 'route' => 'products.index', 'permission' => 'products.view', 'icon' => 'M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9'],
        ['label' => __('categories.title'), 'route' => 'categories.index', 'permission' => 'products.manage', 'icon' => 'M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.83.699 2.528 0l4.318-4.318a1.79 1.79 0 000-2.528l-9.581-9.581A2.25 2.25 0 009.568 3zM6.375 7.5a.75.75 0 100-1.5.75.75 0 000 1.5z'],
        ['label' => __('batches.title'), 'route' => 'batches.index', 'permission' => 'batches.view', 'icon' => 'M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375C2.754 3.75 2.25 4.254 2.25 4.875v1.5c0 .621.504 1.125 1.125 1.125z'],
        ['label' => __('alerts.title'), 'route' => 'expiry-alerts.index', 'permission' => 'expiry-alerts.view', 'icon' => 'M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z'],
        ['label' => __('purchases.title'), 'route' => 'purchases.index', 'permission' => 'purchases.view', 'icon' => 'M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z'],
        ['label' => __('vendors.title'), 'route' => 'vendors.index', 'permission' => 'vendors.view', 'icon' => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21'],
        ['label' => __('customers.title'), 'route' => 'customers.index', 'permission' => 'customers.view', 'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
        ['label' => __('expenses.title'), 'route' => 'expenses.index', 'permission' => 'expenses.manage', 'icon' => 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0018.75 4.5H5.25A2.25 2.25 0 003 6.75v10.5A2.25 2.25 0 005.25 19.5z'],
        ['label' => __('reports.sales_title'), 'route' => 'reports.sales', 'permission' => 'reports.view', 'icon' => 'M3 13.125L7.5 8.625l3.75 3.75 6.75-6.75M18 5.625h3v3M4.5 19.5h15a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5h-15A1.5 1.5 0 003 6v12a1.5 1.5 0 001.5 1.5z'],
        ['label' => __('reports.purchases_title'), 'route' => 'reports.purchases', 'permission' => 'reports.view', 'icon' => 'M3.75 21V9.75m6.75 11.25V4.5m6.75 16.5V13.5'],
        ['label' => __('settings.title'), 'route' => 'settings.index', 'permission' => 'branding.manage', 'icon' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.245a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.245a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.28z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
    ])->filter(fn ($item) => $item['permission'] === null || auth()->user()?->can($item['permission']));

    $theme = \App\Models\ThemeSetting::current();
@endphp

<div
    x-data="{
        open: false,
        collapsed: localStorage.getItem('sidebar-collapsed') === 'true',
        toggleCollapsed() { this.collapsed = !this.collapsed; localStorage.setItem('sidebar-collapsed', this.collapsed); },
    }"
>
    {{-- Mobile toggle --}}
    <button
        type="button"
        @click="open = true"
        class="fixed bottom-4 start-4 z-40 flex min-h-[44px] min-w-[44px] items-center justify-center rounded-full glass-panel-strong p-3 shadow-lg lg:hidden"
        aria-label="{{ __('nav.dashboard') }}"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--text-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    {{-- Mobile off-canvas overlay --}}
    <div
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-black/30 lg:hidden"
        @click="open = false"
        style="display: none;"
    ></div>

    <aside
        :class="[
            open ? 'translate-x-0' : '-translate-x-full rtl:translate-x-full',
            collapsed ? 'lg:w-20' : 'lg:w-64',
        ]"
        class="glass-sidebar fixed inset-y-0 start-0 z-50 w-72 transform overflow-x-hidden overflow-y-auto p-4 transition-all duration-200 lg:sticky lg:top-0 lg:z-auto lg:h-screen lg:translate-x-0 lg:rtl:translate-x-0 lg:flex-shrink-0 lg:p-4"
    >
        <div class="mb-8 flex items-center justify-between">
            <span x-show="!collapsed" x-transition.opacity.duration-100ms class="truncate text-lg font-bold text-[var(--text-on-dark)]">{{ $theme->displayName() }}</span>
            <button type="button" class="min-h-[44px] min-w-[44px] text-2xl text-[var(--text-on-dark)] lg:hidden" @click="open = false" aria-label="Close">
                &times;
            </button>
            <button
                type="button"
                @click="toggleCollapsed()"
                class="hidden min-h-[36px] min-w-[36px] items-center justify-center rounded-lg text-[var(--text-on-dark)] hover:bg-white/10 lg:flex"
                :aria-label="collapsed ? '{{ __('nav.expand_sidebar') }}' : '{{ __('nav.collapse_sidebar') }}'"
                :title="collapsed ? '{{ __('nav.expand_sidebar') }}' : '{{ __('nav.collapse_sidebar') }}'"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform rtl:rotate-180" :class="collapsed ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </button>
        </div>

        <ul class="space-y-2">
            @foreach ($navItems as $item)
                <li>
                    @php $isActive = request()->routeIs($item['route']) || request()->routeIs(str($item['route'])->before('.').'.*'); @endphp
                    <a
                        href="{{ route($item['route']) }}"
                        wire:navigate
                        title="{{ $item['label'] }}"
                        class="flex min-h-[44px] items-center gap-3 rounded-xl px-3.5 py-2 text-base font-semibold transition {{ $isActive ? 'bg-[var(--sidebar-accent-color)] text-[var(--sidebar-primary-color)]' : 'text-[var(--text-on-dark)] hover:bg-white/10' }}"
                        :class="collapsed ? 'lg:justify-center lg:px-0' : ''"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                        </svg>
                        <span :class="collapsed ? 'lg:hidden' : ''" class="truncate">{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>
</div>
