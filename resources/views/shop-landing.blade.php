<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pesticides Management System — Run your shop, simplified</title>
        <meta name="description" content="Point of sale, inventory & expiry tracking, vendor/customer ledgers, purchases, and reports for pesticide and agro-input retailers — in English or Urdu.">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css'])
    </head>
    <body class="relative min-h-screen overflow-x-hidden font-sans antialiased">
        {{-- Decorative glow blobs — purely visual, matches the app's glass aesthetic --}}
        <div class="pointer-events-none fixed -top-32 -start-32 h-96 w-96 rounded-full bg-[var(--sidebar-primary-color)]/20 blur-3xl"></div>
        <div class="pointer-events-none fixed top-1/3 -end-40 h-[28rem] w-[28rem] rounded-full bg-[var(--color-info)]/10 blur-3xl"></div>

        <div class="relative">
            <header class="mx-auto flex max-w-6xl items-center justify-between px-6 py-6">
                <div class="flex items-center gap-2 text-lg font-bold text-[var(--text-primary)]">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[var(--sidebar-primary-color)] text-[var(--text-on-dark)]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 12v3M5.6 5.6l2.1 2.1m8.6 8.6 2.1 2.1M3 12h3m12 0h3M5.6 18.4l2.1-2.1m8.6-8.6 2.1-2.1"/><circle cx="12" cy="12" r="3.25"/></svg>
                    </span>
                    Pesticides Management System
                </div>
                <a href="{{ route('demo.login') }}" class="rounded-xl bg-[var(--sidebar-primary-color)] px-4 py-2 text-sm font-bold text-[var(--text-on-dark)] shadow-sm transition hover:opacity-90">
                    See Demo
                </a>
            </header>

            <main class="mx-auto max-w-6xl px-6 pb-24 pt-10 sm:pt-16">
                {{-- Hero --}}
                <section class="text-center">
                    <span class="glass-panel inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-bold uppercase tracking-wide text-[var(--sidebar-primary-color)]">
                        Built for pesticide &amp; agro-input retailers
                    </span>

                    <h1 class="mx-auto mt-6 max-w-3xl text-4xl font-extrabold leading-tight text-[var(--text-primary)] sm:text-5xl">
                        Run your shop like clockwork —
                        <span class="text-[var(--sidebar-primary-color)]">from the till to the ledger.</span>
                    </h1>

                    <p class="mx-auto mt-5 max-w-2xl text-lg text-[var(--text-secondary)]">
                        Point of sale, batch &amp; expiry tracking, vendor and customer ledgers, purchases, and reports — all in one place, in English or Urdu.
                    </p>

                    <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                        <a href="{{ route('demo.login') }}" class="w-full rounded-xl bg-[var(--sidebar-primary-color)] px-7 py-3.5 text-base font-bold text-[var(--text-on-dark)] shadow-lg shadow-[var(--sidebar-primary-color)]/20 transition hover:opacity-90 sm:w-auto">
                            See Demo — Instant Access
                        </a>
                        <a href="#features" class="w-full rounded-xl px-7 py-3.5 text-base font-bold text-[var(--text-primary)] transition hover:bg-black/5 sm:w-auto">
                            Explore Features ↓
                        </a>
                    </div>
                    <p class="mt-3 text-sm text-[var(--text-secondary)]">No signup. No credit card. Explore the full app as an admin.</p>
                </section>

                {{-- Features --}}
                <section id="features" class="mt-24 scroll-mt-8">
                    <h2 class="text-center text-2xl font-bold text-[var(--text-primary)] sm:text-3xl">Everything your shop needs, built in</h2>
                    <p class="mx-auto mt-2 max-w-xl text-center text-[var(--text-secondary)]">One system for the counter, the warehouse, and the books.</p>

                    <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @php
                            $features = [
                                ['icon' => 'cart', 'title' => 'Point of Sale', 'body' => 'Fast, barcode-ready checkout with instant thermal receipts and downloadable PDF invoices.'],
                                ['icon' => 'boxes', 'title' => 'Inventory & Batches', 'body' => 'Track stock down to the batch, with automatic alerts before anything expires.'],
                                ['icon' => 'book', 'title' => 'Vendor & Customer Ledgers', 'body' => 'Running balances, on-account sales, and full statement history — always up to date.'],
                                ['icon' => 'truck', 'title' => 'Purchases & Payments', 'body' => 'Record purchases with split cash/bank/on-account payments in one balanced entry.'],
                                ['icon' => 'chart', 'title' => 'Reports & Analytics', 'body' => 'Profit margins, sales trends, and cash-vs-bank breakdowns on a live dashboard.'],
                                ['icon' => 'store', 'title' => 'Multi-Shop Ready', 'body' => 'Every shop gets its own secure, branded workspace and its own web address.'],
                            ];
                        @endphp

                        @foreach ($features as $feature)
                            <div class="glass-panel p-6 text-start transition hover:-translate-y-0.5">
                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--sidebar-primary-color)]/10 text-[var(--sidebar-primary-color)]">
                                    @switch($feature['icon'])
                                        @case('cart')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.907-4.723 2.325-7.227a1.125 1.125 0 0 0-1.11-1.313H5.106M7.5 14.25 5.106 5.272M6 18.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                                        @break
                                        @case('boxes')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5 12 3 3 7.5m18 0-9 4.5m9-4.5v9L12 21m0-9L3 7.5m9 4.5v9m-9-9v9l9 4.5"/></svg>
                                        @break
                                        @case('book')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                                        @break
                                        @case('truck')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25h5.056a2.25 2.25 0 0 1 1.847.977l1.294 1.883a1.125 1.125 0 0 1-.928 1.765H14.25M2.25 14.25h9.75V6.108a2.25 2.25 0 0 0-1.784-2.201l-5.25-1.125a2.25 2.25 0 0 0-2.716 2.201v9.267"/></svg>
                                        @break
                                        @case('chart')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5 9 7.5l4 4 8-8M3 21h18M3 21V17m4.5 4v-6m4-2v8m4-11v11m4-6v6"/></svg>
                                        @break
                                        @case('store')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75 4.5 3h15L21 9.75M3 9.75v9.75A1.5 1.5 0 0 0 4.5 21h15a1.5 1.5 0 0 0 1.5-1.5V9.75M3 9.75h18M9 21v-5.25a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5V21"/></svg>
                                        @break
                                    @endswitch
                                </div>
                                <h3 class="mt-4 text-base font-bold text-[var(--text-primary)]">{{ $feature['title'] }}</h3>
                                <p class="mt-1.5 text-sm leading-relaxed text-[var(--text-secondary)]">{{ $feature['body'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- Demo CTA band --}}
                <section class="glass-panel-strong mt-24 flex flex-col items-center gap-5 px-8 py-12 text-center sm:flex-row sm:justify-between sm:text-start">
                    <div>
                        <h2 class="text-xl font-bold text-[var(--text-primary)] sm:text-2xl">See it in action, right now</h2>
                        <p class="mt-1.5 text-[var(--text-secondary)]">One click into a fully working shop, logged in as an admin. No forms to fill out.</p>
                    </div>
                    <a href="{{ route('demo.login') }}" class="shrink-0 rounded-xl bg-[var(--sidebar-primary-color)] px-7 py-3.5 text-base font-bold text-[var(--text-on-dark)] shadow-lg shadow-[var(--sidebar-primary-color)]/20 transition hover:opacity-90">
                        See Demo
                    </a>
                </section>

                {{-- Existing customer sign-in --}}
                <p class="mt-10 text-center text-sm text-[var(--text-secondary)]">
                    Already have a shop on this platform? Sign in at your shop's own link, e.g. <code class="rounded bg-black/5 px-1.5 py-0.5">/your-shop-name</code>.
                </p>
            </main>

            <footer class="border-t border-black/5 py-8 text-center text-sm text-[var(--text-secondary)]">
                &copy; {{ date('Y') }} Pesticides Management System
            </footer>
        </div>
    </body>
</html>
