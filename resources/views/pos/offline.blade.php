{{--
    The offline till.

    Deliberately holds NO per-request data — no CSRF token, no user name, no
    shop data. The service worker caches one copy of this page and it must stay
    valid indefinitely; everything shop-specific is read from IndexedDB at
    runtime. The shop slug and user id below come from the URL and the session
    at first load, and are the only dynamic values, both of which are safe to
    cache because the cache itself is keyed per shop and user.
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
                'cart_empty' => __('pos.cart_empty'),
                'data_age' => __('offline.data_age'),
                'sync_result' => __('offline.sync_result'),
                'sync_failed' => __('offline.sync_failed'),
                'sign_in_to_sync' => __('offline.sign_in_to_sync'),
                'unbalanced_payment' => __('offline.unbalanced_payment'),
                'invalid_quantity' => __('offline.invalid_quantity'),
                'invalid_price' => __('offline.invalid_price'),
                'insufficient_stock' => __('offline.insufficient_stock'),
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
            class="mx-auto max-w-6xl px-4 py-6"
        >
            {{-- Status bar --}}
            <div class="glass-panel mb-4 flex flex-wrap items-center justify-between gap-3 px-5 py-4">
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
                        class="min-h-[44px] rounded-xl px-4 py-2 text-sm font-bold text-white disabled:opacity-50"
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
                        class="min-h-[40px] rounded-xl px-4 py-2 text-sm font-semibold"
                    >
                        {{ __('offline.back_to_online_pos') }}
                    </a>
                </div>
            </div>

            <p x-show="syncMessage" x-cloak x-text="syncMessage" role="status" class="glass-panel mb-4 px-5 py-3 text-sm font-semibold text-[var(--text-primary)]"></p>

            {{-- Anything that isn't a sync result: a blocked receipt window, a
                 failed hold, a resume refused because the cart isn't empty.
                 These used to be written into `problems`, which only renders
                 inside the checkout modal — so they were invisible. --}}
            <div x-show="notice" x-cloak role="alert" class="mb-4 flex items-start justify-between gap-3 rounded-xl border border-[var(--color-warning)]/40 bg-[var(--color-warning)]/10 px-5 py-3">
                <p x-text="notice" class="text-sm font-semibold text-[var(--color-warning)]"></p>
                <button type="button" @click="notice = ''" class="min-h-[24px] min-w-[24px] text-lg font-bold leading-none text-[var(--color-warning)]" aria-label="{{ __('vendors.cancel') }}">&times;</button>
            </div>

            {{-- Not prepared --}}
            <div x-show="stage === 'unprepared'" x-cloak class="glass-panel-strong p-8 text-center">
                <h2 class="text-lg font-bold text-[var(--text-primary)]">{{ __('offline.not_prepared_title') }}</h2>
                <p class="mx-auto mt-2 max-w-md text-sm text-[var(--text-secondary)]">{{ __('offline.not_prepared_hint') }}</p>
            </div>

            {{-- Till --}}
            <div x-show="stage === 'ready'" x-cloak class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_340px] lg:items-start">
                <div class="space-y-4">
                    <div x-show="isStale" x-cloak class="rounded-xl border border-[var(--color-warning)]/40 bg-[var(--color-warning)]/10 px-4 py-3 text-sm font-semibold text-[var(--color-warning)]">
                        {{ __('offline.stale_warning') }} <span x-text="staleLabel"></span>
                    </div>

                    <div class="glass-panel-strong p-4">
                        <label class="block text-base font-semibold text-[var(--text-primary)]" for="offline-barcode">{{ __('pos.scan_or_enter_barcode') }}</label>
                        <input
                            id="offline-barcode"
                            type="text"
                            x-model="barcodeInput"
                            @keydown.enter.prevent="scan()"
                            autocomplete="off"
                            placeholder="{{ __('pos.scan_placeholder') }}"
                            class="mt-1 min-h-[52px] w-full rounded-xl border-2 border-[var(--navbar-primary-color)]/30 bg-white px-4 py-3 text-lg font-bold"
                        >
                        <p x-show="scanError" x-cloak x-text="scanError" class="mt-2 text-sm font-semibold text-[var(--color-danger)]"></p>
                    </div>

                    <div class="glass-panel overflow-hidden">
                        <div class="flex items-center justify-between border-b border-black/10 px-4 py-3">
                            <h3 class="text-lg font-bold text-[var(--text-primary)]">{{ __('pos.cart') }}</h3>
                            <div class="flex gap-1" x-show="cart.lines.length > 0">
                                <button type="button" @click="holdOrder()" class="min-h-[44px] rounded-lg px-3 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">{{ __('pos.hold_order') }}</button>
                                <button type="button" @click="clearCart()" class="min-h-[44px] rounded-lg px-3 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">{{ __('pos.clear_cart') }}</button>
                            </div>
                        </div>

                        <template x-if="cart.lines.length === 0">
                            <p class="px-4 py-12 text-center text-sm font-semibold text-[var(--text-secondary)]">{{ __('pos.cart_empty') }}</p>
                        </template>

                        <div class="divide-y divide-black/5">
                            <template x-for="(line, index) in cart.lines" :key="line.batch_id">
                                <div class="flex flex-wrap items-center gap-3 px-4 py-3">
                                    <div class="min-w-[140px] flex-1">
                                        <p class="text-base font-bold text-[var(--text-primary)]" x-text="line.product_name"></p>
                                        <p class="font-mono text-xs text-[var(--text-secondary)]" x-text="line.barcode"></p>
                                    </div>
                                    <div class="w-20">
                                        <label class="block text-xs font-semibold" :for="'qty-' + line.batch_id">{{ __('pos.qty') }}</label>
                                        <input :id="'qty-' + line.batch_id" type="number" step="0.01" min="0.01" :max="line.available" x-model="line.quantity" class="mt-1 min-h-[44px] w-full rounded-lg border border-black/10 px-2 py-1 text-sm font-bold">
                                    </div>
                                    <div class="w-24">
                                        <label class="block text-xs font-semibold" :for="'price-' + line.batch_id">{{ __('pos.price') }}</label>
                                        <input :id="'price-' + line.batch_id" type="number" step="0.01" min="0" x-model="line.unit_price" class="mt-1 min-h-[44px] w-full rounded-lg border border-black/10 px-2 py-1 text-sm font-semibold">
                                    </div>
                                    <div class="w-24 text-end">
                                        <span class="block text-xs font-semibold">{{ __('pos.line_total') }}</span>
                                        <p class="mt-2 text-base font-bold" x-text="lineTotalLabel(line)"></p>
                                    </div>
                                    <button type="button" @click="removeLine(index)" class="min-h-[44px] min-w-[44px] rounded-lg text-[var(--color-danger)] hover:bg-black/5" aria-label="{{ __('offline.remove_item') }}">&times;</button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div x-show="held.length > 0" x-cloak class="glass-panel overflow-hidden">
                        <div class="border-b border-black/10 px-4 py-3">
                            <h3 class="text-lg font-bold text-[var(--text-primary)]">{{ __('pos.held_orders') }} <span x-text="'(' + held.length + ')'"></span></h3>
                        </div>
                        <div class="divide-y divide-black/5">
                            <template x-for="order in held" :key="order.client_uuid">
                                <div class="flex flex-wrap items-center gap-3 px-4 py-3">
                                    <p class="min-w-[140px] flex-1 text-base font-bold text-[var(--text-primary)]" x-text="order.label || @js(__('pos.walk_in'))"></p>
                                    <button type="button" @click="resumeHeldOrder(order.client_uuid)" class="min-h-[40px] rounded-lg bg-[var(--navbar-primary-color)] px-4 py-2 text-sm font-bold text-white">{{ __('pos.resume_order') }}</button>
                                    <button type="button" @click="discardHeldOrder(order.client_uuid)" class="min-h-[40px] rounded-lg px-3 text-sm font-semibold text-[var(--color-danger)]">{{ __('pos.discard_order') }}</button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="space-y-4">
                    <div class="glass-panel p-4">
                        <label for="offline-customer" class="block text-base font-semibold text-[var(--text-primary)]">{{ __('pos.customer') }}</label>
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
                        <div id="offline-customer-list" x-show="customerListOpen" x-cloak @click.outside="customerListOpen = false" class="mt-2 max-h-40 overflow-y-auto" role="listbox">
                            <template x-for="customer in customerOptions" :key="customer.id">
                                <button type="button" role="option" @click="selectCustomer(customer)" class="block min-h-[44px] w-full rounded-lg px-3 py-2 text-start text-sm hover:bg-black/5">
                                    <span class="font-semibold" x-text="customer.name"></span>
                                    {{-- Stamped "as of download": these balances are a
                                         snapshot and go stale while offline. --}}
                                    <span class="block text-xs text-[var(--text-secondary)]" x-text="@js(__('offline.balance_as_of')).replace(':balance', formatMoney(customer.balance))"></span>
                                </button>
                            </template>
                        </div>
                        <button type="button" x-show="cart.customerId" x-cloak @click="clearCustomer()" class="mt-2 min-h-[44px] text-xs font-semibold text-[var(--color-danger)]">{{ __('pos.clear_customer') }}</button>
                    </div>

                    <div class="glass-panel-strong p-5">
                        <div class="flex items-center justify-between pt-2">
                            <span class="text-lg font-bold text-[var(--text-primary)]">{{ __('pos.total') }}</span>
                            <span class="text-3xl font-bold text-[var(--text-primary)]" x-text="totalLabel"></span>
                        </div>
                        <button type="button" @click="openCheckout()" :disabled="cart.lines.length === 0" class="mt-4 min-h-[52px] w-full rounded-xl bg-[var(--navbar-primary-color)] px-5 py-3 text-lg font-bold text-white disabled:opacity-40">
                            {{ __('pos.checkout') }}
                        </button>
                    </div>

                    <div x-show="lastSale" x-cloak class="glass-panel p-4">
                        <p class="text-sm font-semibold text-[var(--text-primary)]" x-text="lastSale?.invoice_number"></p>
                        <p class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('offline.queued_note') }}</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <button type="button" @click="printReceiptAgain()" class="min-h-[40px] rounded-lg bg-black/5 px-3 py-2 text-sm font-semibold">{{ __('offline.print_receipt') }}</button>
                            <button type="button" @click="downloadLastInvoice()" class="min-h-[40px] rounded-lg bg-black/5 px-3 py-2 text-sm font-semibold">{{ __('offline.download_invoice') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Checkout modal --}}
            <div
                x-show="showCheckout"
                x-cloak
                @keydown.escape.window="showCheckout = false"
                role="dialog"
                aria-modal="true"
                aria-labelledby="offline-checkout-title"
                class="fixed inset-0 z-50 flex items-center justify-center px-4"
            >
                <div class="fixed inset-0 bg-black/40" @click="showCheckout = false"></div>
                <div class="glass-panel-strong relative max-h-[90vh] w-full max-w-xl overflow-y-auto p-6">
                    <div class="flex items-center justify-between">
                        <h3 id="offline-checkout-title" class="text-xl font-bold text-[var(--text-primary)]">{{ __('pos.checkout') }}</h3>
                        <p class="text-xl font-bold text-[var(--text-primary)]" x-text="totalLabel"></p>
                    </div>

                    <div class="mt-4 space-y-3">
                        <template x-for="(line, index) in paymentLines" :key="index">
                            <div class="grid grid-cols-1 gap-3 rounded-xl border border-black/10 bg-white/50 p-4 sm:grid-cols-[1fr_1fr_auto]">
                                <div>
                                    <label class="block text-sm font-semibold" :for="'pay-method-' + index">{{ __('ledger.method') }}</label>
                                    <select :id="'pay-method-' + index" x-model="line.method" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 px-3 py-2 text-sm">
                                        <option value="cash">{{ __('ledger.cash') }}</option>
                                        <option value="bank">{{ __('ledger.bank') }}</option>
                                        <option value="ledger">{{ __('purchases.on_account') }}</option>
                                    </select>
                                </div>
                                <div x-show="line.method === 'bank'">
                                    <label class="block text-sm font-semibold" :for="'pay-bank-' + index">{{ __('ledger.bank_account') }}</label>
                                    <select :id="'pay-bank-' + index" x-model="line.bank_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 px-3 py-2 text-sm">
                                        <option value="">{{ __('ledger.select_bank') }}</option>
                                        <template x-for="bank in snapshot.banks" :key="bank.id">
                                            <option :value="bank.id" x-text="bank.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold" :for="'pay-amount-' + index">{{ __('ledger.amount') }}</label>
                                    <input :id="'pay-amount-' + index" type="number" step="0.01" min="0.01" x-model="line.amount" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 px-3 py-2 text-sm">
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

                    <button type="button" @click="addPaymentLine()" class="mt-3 min-h-[44px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold">+ {{ __('purchases.add_payment_line') }}</button>

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

                    <div x-show="needsPhoto" x-cloak class="mt-4 rounded-xl border border-black/10 bg-white/50 p-4">
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
