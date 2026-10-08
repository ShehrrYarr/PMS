{{--
    The offline till.

    Deliberately holds NO per-request data — no CSRF token, no user name, no
    shop data. The service worker caches one copy of this page and it must stay
    valid indefinitely; everything shop-specific is read from IndexedDB at
    runtime. The shop slug and user id below come from the URL and the session
    at first load, and are the only dynamic values, both of which are safe to
    cache because the cache itself is keyed per shop and user.

    Same layout as the live POS (livewire/pos/pos.blade.php) and the very same
    product grid component — only the cart here is driven by Alpine instead of
    Livewire.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ur' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('offline.title') }}</title>

        {{-- Cached by the service worker along with the page, so the shop's
             typeface (including Noto Nastaliq Urdu) survives going offline.
             Per-shop colours can't be baked in here — the cached copy would
             freeze one shop's theme — so those are applied at runtime from
             the snapshot instead. --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&family=Noto+Nastaliq+Urdu:wght@500;700&family=Noto+Sans+Arabic:wght@500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/offline-pos.js'])
    </head>
    <body class="min-h-screen font-sans antialiased {{ app()->getLocale() === 'ur' ? 'font-urdu' : '' }}">
        @php
            $translations = [
                'barcode_not_found' => __('pos.barcode_not_found'),
                'out_of_stock' => __('pos.out_of_stock'),
                'add_invalid_quantity' => __('pos.invalid_quantity'),
                'quantity_exceeds_stock' => __('pos.quantity_exceeds_stock'),
                'quantity_exceeds_stock_in_cart' => __('pos.quantity_exceeds_stock_in_cart'),
                'batch_unavailable' => __('pos.batch_unavailable'),
                'batch_expired_warning' => __('pos.batch_expired_warning'),
                'cart_empty' => __('pos.cart_empty'),
                'data_age' => __('offline.data_age'),
                'sync_result' => __('offline.sync_result'),
                'sync_failed' => __('offline.sync_failed'),
                'sign_in_to_sync' => __('offline.sign_in_to_sync'),
                'unbalanced_payment' => __('offline.unbalanced_payment'),
                'invalid_quantity' => __('offline.invalid_quantity'),
                'invalid_price' => __('offline.invalid_price'),
                'insufficient_stock' => __('offline.insufficient_stock'),
                'invalid_discount' => __('offline.invalid_discount'),
                'invalid_sale_discount' => __('offline.invalid_sale_discount'),
                'payment_required' => __('offline.payment_required'),
                'bank_required' => __('ledger.bank_required'),
                'customer_required_for_ledger' => __('pos.customer_required_for_ledger'),
                'cart_not_empty_to_resume' => __('pos.cart_not_empty_to_resume'),
                'discard_order_confirm' => __('pos.discard_order_confirm'),
                'hold_failed' => __('offline.hold_failed'),
                'sale_save_failed' => __('offline.sale_save_failed'),
                'receipt_blocked' => __('offline.receipt_blocked'),
                'till_unavailable' => __('offline.till_unavailable'),
                'sync_sales_count' => __('offline.sync_sales_count'),
                'sync_sales' => __('offline.sync_sales'),
                // Receipts are rendered entirely in JS offline, so the printed
                // wording has to travel with the page or an Urdu shop's
                // receipts come out in English.
                'receipt' => [
                    'dir' => app()->getLocale() === 'ur' ? 'rtl' : 'ltr',
                    'lang' => app()->getLocale(),
                    'title' => __('receipt.title'),
                    'invoice' => __('receipt.invoice'),
                    'date' => __('receipt.date'),
                    'cashier' => __('receipt.cashier'),
                    'customer' => __('receipt.customer'),
                    'item' => __('receipt.item'),
                    'qty' => __('receipt.qty'),
                    'amount' => __('receipt.amount'),
                    'subtotal' => __('receipt.subtotal'),
                    'discount' => __('receipt.discount'),
                    'total' => __('receipt.total'),
                    'payment' => __('receipt.payment'),
                    'walk_in' => __('pos.walk_in'),
                    'print' => __('batches.print'),
                    'pending_sync' => __('offline.queued_note'),
                    'methods' => [
                        'cash' => __('ledger.cash'),
                        'bank' => __('ledger.bank'),
                        'ledger' => __('ledger.ledger'),
                    ],
                ],
            ];
        @endphp

        <div
            x-data="offlinePos({
                shopSlug: @js(request()->route('shop')),
                userId: @js(auth()->id()),
                translations: @js($translations),
            })"
            class="flex min-h-screen flex-col lg:h-screen"
        >
            {{-- Status bar --}}
            <div class="px-4 pt-4">
                <div class="glass-panel flex flex-wrap items-center justify-between gap-2 px-4 py-2.5">
                    <div class="flex items-center gap-3">
                        <h1 class="text-xl font-bold text-[var(--text-primary)]">{{ __('offline.title') }}</h1>
                        <span
                            class="rounded-full px-3 py-1 text-xs font-bold text-white"
                            :class="needsLogin ? 'bg-[var(--color-warning)]' : (online ? 'bg-[var(--color-success)]' : 'bg-[var(--color-danger)]')"
                            x-text="needsLogin ? @js(__('offline.needs_login')) : (online ? @js(__('offline.online')) : @js(__('offline.offline')))"
                        ></span>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm font-semibold text-[var(--text-secondary)]">
                            {{ __('offline.pending_sales') }}: <span x-text="pending"></span>
                        </span>
                        <button
                            type="button"
                            x-show="stage === 'ready'"
                            @click="syncNow()"
                            :disabled="busy"
                            class="min-h-[40px] rounded-xl px-3 text-sm font-bold text-white disabled:opacity-50"
                            :class="needsLogin ? 'bg-[var(--color-warning)]' : (online ? 'bg-[var(--color-success)]' : 'bg-[var(--color-danger)]')"
                            x-text="syncLabel"
                        ></button>
                        {{-- Blocked while the server is genuinely unreachable.
                             Following it would fail the navigation and the service
                             worker would bounce us straight back here, so the
                             cashier watches the page reload and land exactly where
                             they started. Refusing up front and saying why is the
                             honest version of that.

                             needsLogin is deliberately NOT blocked: there the
                             server IS reachable and only the session has expired,
                             so following the link reaches the login page, which is
                             exactly what the cashier needs. --}}
                        <a
                            href="/{{ request()->route('shop') }}/pos"
                            @click="if (! online && ! needsLogin) { $event.preventDefault(); notice = @js(__('offline.online_pos_needs_connection')); }"
                            :aria-disabled="(! online && ! needsLogin) ? 'true' : null"
                            :class="(! online && ! needsLogin)
                                ? 'cursor-not-allowed text-[var(--text-secondary)] opacity-50'
                                : 'text-[var(--text-secondary)] hover:bg-black/5'"
                            class="inline-flex min-h-[40px] items-center rounded-xl px-3 text-sm font-semibold"
                        >
                            {{ __('offline.back_to_online_pos') }}
                        </a>
                    </div>
                </div>

                <div>
                    <p x-show="syncMessage" x-cloak x-text="syncMessage" role="status" class="glass-panel mt-3 px-4 py-2.5 text-sm font-semibold text-[var(--text-primary)]"></p>

                    {{-- Anything that isn't a sync result: a blocked receipt window, a
                         failed hold, a resume refused because the cart isn't empty.
                         These used to be written into `problems`, which only renders
                         inside the checkout modal — so they were invisible. --}}
                    <div x-show="notice" x-cloak role="alert" class="mt-3 flex items-start justify-between gap-3 rounded-xl border border-[var(--color-warning)]/40 bg-[var(--color-warning)]/10 px-4 py-2.5">
                        <p x-text="notice" class="text-sm font-semibold text-[var(--color-warning)]"></p>
                        <button type="button" @click="notice = ''" class="min-h-[24px] min-w-[24px] text-lg font-bold leading-none text-[var(--color-warning)]" aria-label="{{ __('vendors.cancel') }}">&times;</button>
                    </div>

                    <div x-show="stage === 'ready' && isStale" x-cloak class="mt-3 rounded-xl border border-[var(--color-warning)]/40 bg-[var(--color-warning)]/10 px-4 py-2.5 text-sm font-semibold text-[var(--color-warning)]">
                        {{ __('offline.stale_warning') }} <span x-text="staleLabel"></span>
                    </div>

                    <div x-show="lastSale" x-cloak class="glass-panel mt-3 flex flex-wrap items-center justify-between gap-3 px-4 py-2.5">
                        <div>
                            <p class="text-sm font-bold text-[var(--text-primary)]" x-text="lastSale?.invoice_number"></p>
                            <p class="text-xs text-[var(--text-secondary)]">{{ __('offline.queued_note') }}</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" @click="printReceiptAgain()" class="min-h-[40px] rounded-lg bg-black/5 px-3 text-sm font-semibold hover:bg-black/10">{{ __('offline.print_receipt') }}</button>
                            <button type="button" @click="downloadLastInvoice()" class="min-h-[40px] rounded-lg bg-black/5 px-3 text-sm font-semibold hover:bg-black/10">{{ __('offline.download_invoice') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Not prepared --}}
            <div x-show="stage === 'unprepared'" x-cloak class="p-4">
                <div class="glass-panel-strong p-8 text-center">
                    <h2 class="text-lg font-bold text-[var(--text-primary)]">{{ __('offline.not_prepared_title') }}</h2>
                    <p class="mx-auto mt-2 max-w-md text-sm text-[var(--text-secondary)]">{{ __('offline.not_prepared_hint') }}</p>
                </div>
            </div>

            {{-- Till --}}
            <div
                x-show="stage === 'ready'"
                x-cloak
                class="grid grid-cols-1 gap-4 p-4 pb-24 lg:min-h-0 lg:flex-1 lg:grid-cols-[minmax(0,1fr)_340px] lg:pb-4 xl:grid-cols-[minmax(0,1fr)_380px] 2xl:grid-cols-[minmax(0,1fr)_420px]"
            >
                <section class="flex min-h-0 flex-col">
                    <x-pos.catalog adapter="{
                        load: () => catalogSource(),
                        add: (batch, quantity) => addFromCatalog(batch, quantity),
                        scan: (code) => scanCode(code),
                        cartLines: () => cart.lines,
                    }" />
                </section>

                {{-- Cart: a slide-up drawer below lg --}}
                <div x-show="cartOpen" x-cloak x-transition.opacity @click="cartOpen = false" class="fixed inset-0 z-40 bg-black/40 lg:hidden"></div>

                <aside
                    class="glass-panel-strong fixed inset-x-0 bottom-0 z-50 flex max-h-[88vh] flex-col overflow-hidden transition-transform duration-200 max-lg:translate-y-full max-lg:!rounded-b-none max-lg:!rounded-t-3xl lg:static lg:z-auto lg:max-h-none lg:min-h-0"
                    :class="cartOpen && 'max-lg:!translate-y-0'"
                    aria-label="{{ __('pos.cart') }}"
                >
                    <div x-data="{ heldOpen: false }" class="flex items-center justify-between gap-2 border-b border-black/10 px-4 py-3">
                        <h3 class="flex items-center gap-2 text-lg font-bold text-[var(--text-primary)]">
                            {{ __('pos.cart') }}
                            <span class="rounded-full bg-[var(--navbar-primary-color)]/10 px-2.5 py-0.5 text-sm font-bold text-[var(--navbar-primary-color)]" x-text="itemCount"></span>
                        </h3>

                        <div class="flex items-center gap-1">
                            <div class="relative" x-show="held.length > 0" x-cloak>
                                <button type="button" @click="heldOpen = ! heldOpen" class="inline-flex min-h-[36px] items-center gap-1.5 rounded-lg px-2.5 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5" :aria-expanded="heldOpen.toString()">
                                    {{ __('pos.held_orders') }}
                                    <span class="rounded-full bg-[var(--color-info)]/10 px-2 text-xs font-bold" x-text="held.length"></span>
                                </button>
                                <div x-show="heldOpen" x-cloak x-transition @click.outside="heldOpen = false" class="absolute end-0 z-30 mt-1 w-72 overflow-hidden rounded-2xl border border-black/10 bg-white shadow-xl">
                                    <div class="max-h-72 divide-y divide-black/5 overflow-y-auto">
                                        <template x-for="order in held" :key="order.client_uuid">
                                            <div class="flex items-center gap-2 px-3 py-2.5">
                                                <p class="min-w-0 flex-1 truncate text-sm font-bold text-[var(--text-primary)]" x-text="order.label || @js(__('pos.walk_in'))"></p>
                                                <button type="button" @click="resumeHeldOrder(order.client_uuid); heldOpen = false" class="min-h-[36px] rounded-lg bg-[var(--navbar-primary-color)] px-3 text-xs font-bold text-white hover:opacity-90">{{ __('pos.resume_order') }}</button>
                                                <button type="button" @click="discardHeldOrder(order.client_uuid)" class="flex h-9 w-9 items-center justify-center rounded-lg text-[var(--color-danger)] hover:bg-black/5" aria-label="{{ __('pos.discard_order') }}">&times;</button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <template x-if="cart.lines.length > 0">
                                <div class="flex items-center gap-1">
                                    <button type="button" @click="holdOrder()" class="min-h-[36px] rounded-lg px-2.5 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">{{ __('pos.hold_order') }}</button>
                                    <button type="button" @click="window.confirm(@js(__('pos.clear_cart_confirm'))) && clearCart()" class="min-h-[36px] rounded-lg px-2.5 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">{{ __('pos.clear_cart') }}</button>
                                </div>
                            </template>

                            <button type="button" @click="cartOpen = false" class="flex h-9 w-9 items-center justify-center rounded-lg text-[var(--text-secondary)] hover:bg-black/5 lg:hidden" aria-label="{{ __('pos.close') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Customer --}}
                    <div class="relative border-b border-black/10 px-4 py-3">
                        <label for="offline-customer" class="block text-xs font-semibold text-[var(--text-primary)]">{{ __('pos.customer') }}</label>
                        <input
                            id="offline-customer"
                            type="text"
                            x-model="customerQuery"
                            @focus="customerListOpen = true"
                            @keydown.escape="customerListOpen = false"
                            placeholder="{{ __('pos.walk_in') }}"
                            autocomplete="off"
                            role="combobox"
                            aria-expanded="false"
                            :aria-expanded="customerListOpen.toString()"
                            aria-controls="offline-customer-list"
                            class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base"
                        >
                        {{-- Closes on select, so the list doesn't sit open
                             permanently matching the name just chosen. --}}
                        <div id="offline-customer-list" x-show="customerListOpen" x-cloak @click.outside="customerListOpen = false" class="absolute inset-x-4 z-20 mt-1 max-h-56 overflow-y-auto rounded-xl border border-black/10 bg-white shadow-lg" role="listbox">
                            <template x-for="customer in customerOptions" :key="customer.id">
                                <button type="button" role="option" @click="selectCustomer(customer)" class="block min-h-[44px] w-full px-3 py-2 text-start text-sm hover:bg-black/5">
                                    <span class="font-semibold" x-text="customer.name"></span>
                                    {{-- Stamped "as of download": these balances are a
                                         snapshot and go stale while offline. --}}
                                    <span class="block text-xs text-[var(--text-secondary)]" x-text="@js(__('offline.balance_as_of')).replace(':balance', formatMoney(customer.balance))"></span>
                                </button>
                            </template>
                        </div>
                        <button type="button" x-show="cart.customerId" x-cloak @click="clearCustomer()" class="mt-1 min-h-[32px] text-xs font-semibold text-[var(--color-danger)]">{{ __('pos.clear_customer') }}</button>
                    </div>

                    {{-- Lines --}}
                    <div class="min-h-[120px] flex-1 overflow-y-auto">
                        <div x-show="cart.lines.length === 0" class="flex flex-col items-center justify-center gap-2 px-6 py-12 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[var(--text-secondary)]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.881-4.751 2.234-7.298a1.75 1.75 0 00-1.734-2.02H5.106M7.5 14.25L5.106 5.417M7.5 14.25L5.106 5.417" />
                            </svg>
                            <p class="text-base font-bold text-[var(--text-primary)]">{{ __('pos.cart_empty') }}</p>
                            <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ __('pos.cart_empty_hint') }}</p>
                        </div>

                        <ul class="divide-y divide-black/5">
                            <template x-for="(line, index) in cart.lines" :key="line.batch_id">
                                <li x-data="{ showDiscount: !! line.discount_type }" class="px-4 py-3">
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center overflow-hidden rounded-xl border border-black/5 bg-[var(--navbar-accent-color)]">
                                            <template x-if="line.image_url">
                                                <img :src="line.image_url" alt="" class="h-full w-full bg-white object-contain p-0.5">
                                            </template>
                                            <template x-if="! line.image_url">
                                                <span class="text-base font-bold text-[var(--navbar-primary-color)]" x-text="(line.product_name ?? '?').trim().charAt(0).toUpperCase()"></span>
                                            </template>
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <p class="truncate text-sm font-bold text-[var(--text-primary)]" x-text="line.product_name"></p>
                                            <p class="flex flex-wrap items-center gap-x-1.5 gap-y-1 text-xs text-[var(--text-secondary)]">
                                                <span class="font-mono" x-text="line.barcode"></span>
                                                <template x-if="line.expiry_date">
                                                    <span x-text="'· ' + @js(__('pos.exp')) + ' ' + lineExpiryDate(line)"></span>
                                                </template>
                                                <span x-show="lineExpiry(line) === 'expired'" class="rounded-full bg-[var(--color-danger)] px-1.5 py-px text-[10px] font-bold text-white">{{ __('pos.expired') }}</span>
                                                <span x-show="lineExpiry(line) === 'soon'" class="rounded-full bg-[var(--color-warning)] px-1.5 py-px text-[10px] font-bold text-white">{{ __('pos.expiring_soon') }}</span>
                                            </p>
                                        </div>

                                        <button type="button" @click="removeLine(index)" class="-me-1 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg text-[var(--color-danger)] hover:bg-black/5" aria-label="{{ __('offline.remove_item') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="mt-2 flex items-center gap-2 ps-[3.75rem]">
                                        <div class="flex items-center overflow-hidden rounded-lg border border-black/10 bg-white">
                                            <button type="button" @click="decrementLine(index)" class="flex h-9 w-8 items-center justify-center text-base font-bold text-[var(--text-secondary)] hover:bg-black/5" aria-label="{{ __('pos.qty') }} −">&minus;</button>
                                            <input :id="'qty-' + line.batch_id" type="number" step="1" min="1" :max="line.available" :value="formatQuantity(line.quantity)" @change="line.quantity = $event.target.value" aria-label="{{ __('pos.qty') }}" class="h-9 w-12 border-0 bg-transparent p-0 text-center text-sm font-bold text-[var(--text-primary)] focus:ring-0">
                                            <button type="button" @click="incrementLine(index)" class="flex h-9 w-8 items-center justify-center text-base font-bold text-[var(--text-secondary)] hover:bg-black/5" aria-label="{{ __('pos.qty') }} +">+</button>
                                        </div>

                                        <span class="text-xs font-semibold text-[var(--text-secondary)]">&times;</span>

                                        <input :id="'price-' + line.batch_id" type="number" step="0.01" min="0" x-model="line.unit_price" aria-label="{{ __('pos.price') }}" class="h-9 w-24 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">

                                        <p class="ms-auto whitespace-nowrap text-end text-sm font-bold text-[var(--text-primary)]" x-text="lineTotalLabel(line)"></p>
                                    </div>

                                    <div class="mt-1.5 ps-[3.75rem]">
                                        <button type="button" x-show="! showDiscount" @click="showDiscount = true" class="text-xs font-semibold text-[var(--color-info)] hover:underline">
                                            + {{ __('pos.add_item_discount') }}
                                        </button>
                                        <div x-show="showDiscount" x-cloak class="flex items-center gap-2">
                                            <select :id="'discount-type-' + line.batch_id" x-model="line.discount_type" aria-label="{{ __('pos.discount') }}" class="h-9 min-w-0 flex-1 rounded-lg border border-black/10 bg-white px-2 py-0 text-xs font-semibold text-[var(--text-primary)]">
                                                <option value="">{{ __('pos.no_discount') }}</option>
                                                <option value="flat">{{ __('pos.discount_type_flat') }}</option>
                                                <option value="percentage">{{ __('pos.discount_type_percentage') }}</option>
                                            </select>
                                            <input x-show="line.discount_type === 'flat'" type="number" step="1" min="0" x-model="line.discount_value" aria-label="{{ __('pos.discount') }}" class="h-9 w-20 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">
                                            <input x-show="line.discount_type === 'percentage'" type="number" step="0.01" min="0" max="100" x-model="line.discount_value" aria-label="{{ __('pos.discount') }}" class="h-9 w-20 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">
                                            <span x-show="line.discount_type" class="whitespace-nowrap text-xs font-bold text-[var(--color-danger)]" x-text="'-' + lineDiscountLabel(line)"></span>
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>

                    {{-- Totals --}}
                    <div class="border-t border-black/10 bg-white/50 px-4 py-3">
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-sm font-semibold text-[var(--text-secondary)]">
                                <span>{{ __('pos.subtotal') }}</span>
                                <span x-text="subtotalLabel"></span>
                            </div>
                            <div x-show="hasDiscount" x-cloak class="flex items-center justify-between text-sm font-semibold text-[var(--color-danger)]">
                                <span>{{ __('pos.discount') }}</span>
                                <span x-text="'-' + discountLabel"></span>
                            </div>
                        </div>

                        <div x-data="{ open: false }" class="mt-2">
                            <button type="button" x-show="! open && ! cart.discountType" @click="open = true" class="text-xs font-semibold text-[var(--color-info)] hover:underline">
                                + {{ __('pos.add_sale_discount') }}
                            </button>
                            <div x-show="open || cart.discountType" x-cloak class="flex items-center gap-2">
                                <select id="offline-discount-type" x-model="cart.discountType" aria-label="{{ __('pos.sale_discount') }}" class="h-9 min-w-0 flex-1 rounded-lg border border-black/10 bg-white px-2 py-0 text-xs font-semibold text-[var(--text-primary)]">
                                    <option value="">{{ __('pos.no_discount') }}</option>
                                    <option value="flat">{{ __('pos.discount_type_flat') }}</option>
                                    <option value="percentage">{{ __('pos.discount_type_percentage') }}</option>
                                </select>
                                <input x-show="cart.discountType === 'flat'" type="number" step="1" min="0" x-model="cart.discountValue" aria-label="{{ __('pos.sale_discount') }}" class="h-9 w-24 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">
                                <input x-show="cart.discountType === 'percentage'" type="number" step="0.01" min="0" max="100" x-model="cart.discountValue" aria-label="{{ __('pos.sale_discount') }}" class="h-9 w-24 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">
                            </div>
                        </div>

                        <div class="mt-3 flex items-end justify-between">
                            <span class="text-base font-bold text-[var(--text-primary)]">{{ __('pos.total') }}</span>
                            <span class="text-3xl font-bold tracking-tight text-[var(--text-primary)]" x-text="totalLabel"></span>
                        </div>
                        <button type="button" @click="openCheckout()" :disabled="cart.lines.length === 0" class="mt-3 flex min-h-[54px] w-full items-center justify-center rounded-xl bg-[var(--navbar-primary-color)] px-5 text-lg font-bold text-white shadow-sm transition hover:opacity-90 disabled:opacity-40">
                            {{ __('pos.checkout') }}
                        </button>
                    </div>
                </aside>
            </div>

            {{-- Mobile: docked bar that opens the cart drawer --}}
            <div x-show="stage === 'ready'" x-cloak class="glass-panel-strong fixed inset-x-0 bottom-0 z-30 flex items-center gap-3 !rounded-none p-3 lg:hidden">
                <button type="button" @click="cartOpen = true" class="flex min-h-[52px] min-w-0 flex-1 items-center justify-between gap-2 rounded-xl bg-white/80 px-3 text-start shadow-sm">
                    <span class="whitespace-nowrap text-sm font-bold text-[var(--text-primary)]">{{ __('pos.view_cart') }} (<span x-text="itemCount"></span>)</span>
                    <span class="truncate whitespace-nowrap text-base font-bold text-[var(--text-primary)] sm:text-lg" x-text="totalLabel"></span>
                </button>
                <button type="button" @click="openCheckout()" :disabled="cart.lines.length === 0" class="min-h-[52px] rounded-xl bg-[var(--navbar-primary-color)] px-5 text-base font-bold text-white shadow-sm disabled:opacity-40">
                    {{ __('pos.checkout') }}
                </button>
            </div>

            {{-- Checkout modal --}}
            <div
                x-show="showCheckout"
                x-cloak
                @keydown.escape.window="showCheckout = false"
                role="dialog"
                aria-modal="true"
                aria-labelledby="offline-checkout-title"
                class="fixed inset-0 z-[60] flex items-center justify-center px-4"
            >
                <div class="fixed inset-0 bg-black/40" @click="showCheckout = false"></div>
                <div class="glass-panel-strong relative max-h-[90vh] w-full max-w-xl overflow-y-auto p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 id="offline-checkout-title" class="text-xl font-bold text-[var(--text-primary)]">{{ __('pos.checkout') }}</h3>
                            <p class="text-sm font-semibold text-[var(--text-secondary)]" x-text="selectedCustomer?.name ?? @js(__('pos.walk_in'))"></p>
                        </div>
                        <p class="text-3xl font-bold tracking-tight text-[var(--text-primary)]" x-text="totalLabel"></p>
                    </div>

                    <div class="mt-4 space-y-3">
                        <template x-for="(line, index) in paymentLines" :key="index">
                            <div class="grid grid-cols-1 gap-3 rounded-xl border border-black/10 bg-white/60 p-4 sm:grid-cols-[1fr_1fr_auto]">
                                <div>
                                    <label class="block text-sm font-semibold" :for="'pay-method-' + index">{{ __('ledger.method') }}</label>
                                    <select :id="'pay-method-' + index" x-model="line.method" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white px-3 py-2 text-sm">
                                        <option value="cash">{{ __('ledger.cash') }}</option>
                                        <option value="bank">{{ __('ledger.bank') }}</option>
                                        <option value="ledger">{{ __('purchases.on_account') }}</option>
                                    </select>
                                </div>
                                <div x-show="line.method === 'bank'">
                                    <label class="block text-sm font-semibold" :for="'pay-bank-' + index">{{ __('ledger.bank_account') }}</label>
                                    <select :id="'pay-bank-' + index" x-model="line.bank_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white px-3 py-2 text-sm">
                                        <option value="">{{ __('ledger.select_bank') }}</option>
                                        <template x-for="bank in snapshot.banks" :key="bank.id">
                                            <option :value="bank.id" x-text="bank.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold" :for="'pay-amount-' + index">{{ __('ledger.amount') }}</label>
                                    <input :id="'pay-amount-' + index" type="number" step="0.01" min="0.01" x-model="line.amount" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white px-3 py-2 text-sm">
                                </div>
                                {{-- Without this, a payment line added by mistake could only be
                                     escaped by cancelling the whole checkout. --}}
                                <div class="flex items-end" x-show="paymentLines.length > 1">
                                    <button
                                        type="button"
                                        @click="removePaymentLine(index)"
                                        class="min-h-[44px] min-w-[44px] rounded-xl text-lg font-bold text-[var(--color-danger)] hover:bg-black/5"
                                        aria-label="{{ __('offline.remove_payment_line') }}"
                                    >&times;</button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <button type="button" @click="addPaymentLine()" class="mt-3 min-h-[44px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold hover:bg-black/10">+ {{ __('purchases.add_payment_line') }}</button>

                    {{-- Running balance, matching the online POS: otherwise the
                         cashier only discovers an unbalanced split after
                         pressing Complete Sale. --}}
                    <div
                        class="mt-4 flex items-center justify-between rounded-xl border px-4 py-3"
                        :class="isFullyPaid ? 'border-[var(--color-success)]/30 bg-[var(--color-success)]/10' : 'border-[var(--color-warning)]/30 bg-[var(--color-warning)]/10'"
                    >
                        <span class="text-sm font-bold" :class="isFullyPaid ? 'text-[var(--color-success)]' : 'text-[var(--color-warning)]'"
                            x-text="isFullyPaid ? @js(__('pos.fully_paid')) : @js(__('offline.remaining'))"></span>
                        <span x-show="!isFullyPaid" class="text-sm font-bold text-[var(--color-warning)]" x-text="remainingToPay"></span>
                    </div>

                    <div x-show="needsPhoto" x-cloak class="mt-4 rounded-xl border border-black/10 bg-white/60 p-4">
                        <label for="offline-photo" class="mb-2 block text-sm font-bold">{{ __('pos.customer_photo') }}</label>
                        <input id="offline-photo" type="file" accept="image/*" capture="environment" @change="capturePhoto($event)" class="text-sm">
                        <img x-show="photoDataUrl" x-cloak :src="photoDataUrl" class="mt-2 h-16 w-16 rounded-lg border border-black/10 object-cover">
                    </div>

                    <ul x-show="problems.length > 0" x-cloak class="mt-4 space-y-1 text-sm font-semibold text-[var(--color-danger)]">
                        <template x-for="problem in problems" :key="problem">
                            <li x-text="problem"></li>
                        </template>
                    </ul>

                    <div class="mt-5 flex justify-end gap-3">
                        <button type="button" @click="showCheckout = false" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)]">{{ __('vendors.cancel') }}</button>
                        <button type="button" @click="completeSale()" :disabled="busy" class="min-h-[44px] rounded-xl bg-[var(--navbar-primary-color)] px-6 py-2 text-base font-bold text-white disabled:opacity-50">
                            {{ __('pos.complete_sale') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
