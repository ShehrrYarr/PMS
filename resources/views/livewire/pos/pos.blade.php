@php
    $itemCount = count($cart);
    $totalDiscount = bcadd($this->cartItemDiscountTotal, $this->saleDiscountAmount, 2);
@endphp

<div
    x-data="{ cartOpen: false, heldOpen: false }"
    x-on:sale-completed.window="window.open($event.detail.receiptUrl, '_blank'); cartOpen = false"
    class="pb-24 lg:flex lg:h-[calc(100vh-7rem)] lg:min-h-[620px] lg:flex-col lg:pb-0"
>
    <div class="grid grid-cols-1 gap-4 lg:min-h-0 lg:flex-1 lg:grid-cols-[minmax(0,1fr)_340px] xl:grid-cols-[minmax(0,1fr)_380px] 2xl:grid-cols-[minmax(0,1fr)_420px]">
        {{-- ============ Left: toolbar + product grid ============ --}}
        <section class="flex min-h-0 flex-col gap-3">
            {{-- Alpine-only, so Livewire never re-morphs it: a re-render
                 during a Livewire update request would otherwise rewrite
                 this x-data, and the slug is read from the user's shop for
                 the same reason — request()->route('shop') is null on
                 /livewire/update, which used to spin up a second copy of
                 these controls pinging /null/pos/ping. --}}
            <div wire:ignore class="glass-panel flex flex-wrap items-center justify-between gap-2 px-4 py-2.5">
                <h2 class="text-xl font-bold text-[var(--text-primary)] lg:max-xl:hidden">{{ __('pos.title') }}</h2>

                <div
                    class="flex flex-wrap items-center gap-2"
                    x-data="posOfflineControls({
                        shopSlug: @js(auth()->user()->shop->slug),
                        userId: @js(auth()->id()),
                        translations: @js([
                            'sync_sales' => __('offline.sync_sales'),
                            'sync_sales_count' => __('offline.sync_sales_count'),
                            'sync_result' => __('offline.sync_result'),
                            'sync_failed' => __('offline.sync_failed'),
                            'sign_in_to_sync' => __('offline.sign_in_to_sync'),
                            'offline_ready' => __('offline.offline_ready'),
                            'offline_ready_not_persisted' => __('offline.offline_ready_not_persisted'),
                            'offline_prepare_failed' => __('offline.offline_prepare_failed'),
                        ]),
                    })"
                >
                    <p x-show="error" x-cloak x-text="error" role="alert" class="text-sm font-semibold text-[var(--color-danger)]"></p>
                    <p x-show="notice && ! error" x-cloak x-text="notice" role="status" class="text-sm font-semibold text-[var(--text-secondary)]"></p>

                    <button
                        type="button"
                        @click="prepared ? openOfflineTill() : goOffline()"
                        :disabled="busy"
                        class="inline-flex min-h-[40px] items-center rounded-xl bg-black/5 px-3 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10 disabled:opacity-60"
                        x-text="prepared ? @js(__('offline.open_offline_till')) : @js(__('offline.go_offline'))"
                    ></button>

                    {{-- Red with no usable connection, green when the server is
                         genuinely reachable. --}}
                    <button
                        type="button"
                        @click="syncNow()"
                        :disabled="busy"
                        :class="syncButtonClass"
                        class="inline-flex min-h-[40px] items-center rounded-xl px-3 text-sm font-bold disabled:opacity-60"
                        x-text="syncLabel"
                    ></button>

                    <a href="{{ route('sales.index') }}" wire:navigate class="inline-flex min-h-[40px] items-center rounded-xl px-3 text-sm font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                        {{ __('pos.sales_history') }}
                    </a>
                </div>
            </div>

            @if ($notice)
                <div
                    wire:key="pos-notice-{{ md5($notice) }}"
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 6000)"
                    x-show="show"
                    x-transition.opacity
                    role="status"
                    class="flex items-start justify-between gap-3 rounded-xl border border-[var(--color-success)]/30 bg-[var(--color-success)]/10 px-4 py-2.5 text-sm font-semibold text-[var(--color-success)]"
                >
                    <span>{{ $notice }}</span>
                    <button type="button" wire:click="dismissNotice" class="-me-1 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded text-base leading-none hover:bg-black/5" aria-label="{{ __('pos.close') }}">&times;</button>
                </div>
            @endif

            {{-- Client-side grid: Livewire must never morph it, or every cart
                 re-render would wipe the search box and close the pop-up. --}}
            <div wire:ignore class="flex min-h-0 flex-1 flex-col">
                <x-pos.catalog adapter="{
                    load: () => $wire.catalog(),
                    add: (batch, quantity) => $wire.addBatch(batch.id, quantity),
                    scan: (code) => $wire.scanBarcode(code),
                    cartLines: () => $wire.cart,
                }" />
            </div>
        </section>

        {{-- ============ Right: cart (a slide-up drawer below lg) ============ --}}
        <div x-show="cartOpen" x-cloak x-transition.opacity @click="cartOpen = false" class="fixed inset-0 z-40 bg-black/40 lg:hidden"></div>

        <aside
            class="glass-panel-strong fixed inset-x-0 bottom-0 z-50 flex max-h-[88vh] flex-col overflow-hidden transition-transform duration-200 max-lg:translate-y-full max-lg:!rounded-b-none max-lg:!rounded-t-3xl lg:static lg:z-auto lg:max-h-none lg:min-h-0"
            :class="cartOpen && 'max-lg:!translate-y-0'"
            aria-label="{{ __('pos.cart') }}"
        >
            {{-- Header --}}
            <div class="flex items-center justify-between gap-2 border-b border-black/10 px-4 py-3">
                <h3 class="flex items-center gap-2 text-lg font-bold text-[var(--text-primary)]">
                    {{ __('pos.cart') }}
                    <span class="rounded-full bg-[var(--navbar-primary-color)]/10 px-2.5 py-0.5 text-sm font-bold text-[var(--navbar-primary-color)]">{{ $itemCount }}</span>
                </h3>

                <div class="flex items-center gap-1">
                    @if ($heldOrders->isNotEmpty())
                        <div class="relative">
                            <button type="button" @click="heldOpen = ! heldOpen" class="inline-flex min-h-[36px] items-center gap-1.5 rounded-lg px-2.5 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5" :aria-expanded="heldOpen.toString()">
                                {{ __('pos.held_orders') }}
                                <span class="rounded-full bg-[var(--color-info)]/10 px-2 text-xs font-bold">{{ $heldOrders->count() }}</span>
                            </button>

                            <div x-show="heldOpen" x-cloak x-transition @click.outside="heldOpen = false" class="absolute end-0 z-30 mt-1 w-72 overflow-hidden rounded-2xl border border-black/10 bg-white shadow-xl">
                                <div class="max-h-72 divide-y divide-black/5 overflow-y-auto">
                                    @foreach ($heldOrders as $heldOrder)
                                        <div wire:key="held-{{ $heldOrder->id }}" class="flex items-center gap-2 px-3 py-2.5">
                                            <div class="min-w-0 flex-1">
                                                <p class="truncate text-sm font-bold text-[var(--text-primary)]">{{ $heldOrder->label ?? __('pos.walk_in') }}</p>
                                                <p class="text-xs text-[var(--text-secondary)]">
                                                    {{ trans_choice('pos.held_items_count', $heldOrder->itemCount(), ['count' => $heldOrder->itemCount()]) }}
                                                    &middot; {{ $heldOrder->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                            <button type="button" wire:click="resumeHeldOrder({{ $heldOrder->id }})" @click="heldOpen = false" class="min-h-[36px] rounded-lg bg-[var(--navbar-primary-color)] px-3 text-xs font-bold text-white hover:opacity-90">
                                                {{ __('pos.resume_order') }}
                                            </button>
                                            <button
                                                type="button"
                                                wire:click="discardHeldOrder({{ $heldOrder->id }})"
                                                wire:confirm="{{ __('pos.discard_order_confirm') }}"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg text-[var(--color-danger)] hover:bg-black/5"
                                                aria-label="{{ __('pos.discard_order') }}"
                                            >&times;</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($itemCount > 0)
                        <button type="button" wire:click="holdOrder" class="min-h-[36px] rounded-lg px-2.5 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">
                            {{ __('pos.hold_order') }}
                        </button>
                        <button type="button" wire:click="clearCart" wire:confirm="{{ __('pos.clear_cart_confirm') }}" class="min-h-[36px] rounded-lg px-2.5 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                            {{ __('pos.clear_cart') }}
                        </button>
                    @endif

                    <button type="button" @click="cartOpen = false" class="flex h-9 w-9 items-center justify-center rounded-lg text-[var(--text-secondary)] hover:bg-black/5 lg:hidden" aria-label="{{ __('pos.close') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Customer --}}
            <div class="border-b border-black/10 px-4 py-3">
                <x-input-label for="customer_id" :value="__('pos.customer')" class="text-xs" />
                <div class="mt-1">
                    <x-searchable-select wire:model="customer_id" :options="$customers" :placeholder="__('pos.walk_in')" />
                </div>
            </div>

            <x-input-error :messages="$errors->get('cart')" class="px-4 pt-3" />

            {{-- Lines --}}
            <div class="min-h-[120px] flex-1 overflow-y-auto">
                @if ($itemCount === 0)
                    <div class="flex flex-col items-center justify-center gap-2 px-6 py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[var(--text-secondary)]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.881-4.751 2.234-7.298a1.75 1.75 0 00-1.734-2.02H5.106M7.5 14.25L5.106 5.417M7.5 14.25L5.106 5.417" />
                        </svg>
                        <p class="text-base font-bold text-[var(--text-primary)]">{{ __('pos.cart_empty') }}</p>
                        <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ __('pos.cart_empty_hint') }}</p>
                    </div>
                @else
                    <ul class="divide-y divide-black/5">
                        @foreach ($cart as $index => $line)
                            @php
                                $expiry = isset($line['expiry_date']) ? \Illuminate\Support\Carbon::parse($line['expiry_date']) : null;
                                $daysLeft = $expiry ? (int) now()->startOfDay()->diffInDays($expiry, false) : null;
                                $hasLineDiscount = ($line['discount_type'] ?? null) !== null;
                            @endphp
                            <li wire:key="cart-line-{{ $line['batch_id'] }}" x-data="{ showDiscount: @js($hasLineDiscount) }" class="px-4 py-3">
                                <div class="flex items-start gap-3">
                                    <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center overflow-hidden rounded-xl border border-black/5 bg-[var(--navbar-accent-color)]">
                                        @if (! empty($line['image_url']))
                                            <img src="{{ $line['image_url'] }}" alt="" class="h-full w-full bg-white object-contain p-0.5">
                                        @else
                                            <span class="text-base font-bold text-[var(--navbar-primary-color)]">{{ mb_strtoupper(mb_substr($line['product_name'], 0, 1)) }}</span>
                                        @endif
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-bold text-[var(--text-primary)]">{{ $line['product_name'] }}</p>
                                        <p class="flex flex-wrap items-center gap-x-1.5 gap-y-1 text-xs text-[var(--text-secondary)]">
                                            <span class="font-mono">{{ $line['barcode'] }}</span>
                                            @if ($expiry)
                                                <span>&middot; {{ __('pos.exp') }} {{ $expiry->translatedFormat('j M Y') }}</span>
                                                @if ($daysLeft < 0)
                                                    <span class="rounded-full bg-[var(--color-danger)] px-1.5 py-px text-[10px] font-bold text-white">{{ __('pos.expired') }}</span>
                                                @elseif ($daysLeft <= 30)
                                                    <span class="rounded-full bg-[var(--color-warning)] px-1.5 py-px text-[10px] font-bold text-white">{{ __('pos.expiring_soon') }}</span>
                                                @endif
                                            @endif
                                        </p>
                                    </div>

                                    <button type="button" wire:click="removeCartItem({{ $index }})" class="-me-1 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg text-[var(--color-danger)] hover:bg-black/5" aria-label="{{ __('pos.remove_item') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="mt-2 flex items-center gap-2 ps-[3.75rem]">
                                    <div class="flex items-center overflow-hidden rounded-lg border border-black/10 bg-white">
                                        <button type="button" wire:click="decrementQuantity({{ $index }})" class="flex h-9 w-8 items-center justify-center text-base font-bold text-[var(--text-secondary)] hover:bg-black/5" aria-label="{{ __('pos.qty') }} −">&minus;</button>
                                        <input type="number" step="1" min="1" max="{{ $line['available'] }}" wire:model.live.debounce.400ms="cart.{{ $index }}.quantity" aria-label="{{ __('pos.qty') }}" class="h-9 w-12 border-0 bg-transparent p-0 text-center text-sm font-bold text-[var(--text-primary)] focus:ring-0">
                                        <button type="button" wire:click="incrementQuantity({{ $index }})" class="flex h-9 w-8 items-center justify-center text-base font-bold text-[var(--text-secondary)] hover:bg-black/5" aria-label="{{ __('pos.qty') }} +">+</button>
                                    </div>

                                    <span class="text-xs font-semibold text-[var(--text-secondary)]">&times;</span>

                                    <input type="number" step="0.01" min="0" wire:model.live.debounce.400ms="cart.{{ $index }}.unit_price" aria-label="{{ __('pos.price') }}" class="h-9 w-24 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">

                                    <p class="ms-auto whitespace-nowrap text-end text-sm font-bold text-[var(--text-primary)]">{{ money($this->lineTotal($line)) }}</p>
                                </div>
                                <x-input-error :messages="array_merge($errors->get('cart.'.$index.'.quantity'), $errors->get('cart.'.$index.'.unit_price'))" class="mt-1 ps-[3.75rem]" />

                                <div class="mt-1.5 ps-[3.75rem]">
                                    <button type="button" x-show="! showDiscount" @click="showDiscount = true" class="text-xs font-semibold text-[var(--color-info)] hover:underline">
                                        + {{ __('pos.add_item_discount') }}
                                    </button>
                                    <div x-show="showDiscount" x-cloak class="flex items-center gap-2">
                                        <select wire:model.live="cart.{{ $index }}.discount_type" aria-label="{{ __('pos.discount') }}" class="h-9 min-w-0 flex-1 rounded-lg border border-black/10 bg-white px-2 py-0 text-xs font-semibold text-[var(--text-primary)]">
                                            <option value="">{{ __('pos.no_discount') }}</option>
                                            <option value="flat">{{ __('pos.discount_type_flat') }}</option>
                                            <option value="percentage">{{ __('pos.discount_type_percentage') }}</option>
                                        </select>
                                        @if (($line['discount_type'] ?? null) === 'flat')
                                            <input type="number" step="1" min="0" wire:model.live.debounce.400ms="cart.{{ $index }}.discount_value" aria-label="{{ __('pos.discount') }}" class="h-9 w-20 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">
                                        @elseif (($line['discount_type'] ?? null) === 'percentage')
                                            <input type="number" step="0.01" min="0" max="100" wire:model.live.debounce.400ms="cart.{{ $index }}.discount_value" aria-label="{{ __('pos.discount') }}" class="h-9 w-20 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">
                                        @endif
                                        @if (bccomp($this->lineDiscountAmount($line), '0', 2) > 0)
                                            <span class="whitespace-nowrap text-xs font-bold text-[var(--color-danger)]">-{{ money($this->lineDiscountAmount($line)) }}</span>
                                        @endif
                                    </div>
                                    <x-input-error :messages="$errors->get('cart.'.$index.'.discount_value')" class="mt-1" />
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Totals --}}
            <div class="border-t border-black/10 bg-white/50 px-4 py-3">
                <div class="space-y-1">
                    <div class="flex items-center justify-between text-sm font-semibold text-[var(--text-secondary)]">
                        <span>{{ __('pos.subtotal') }}</span>
                        <span>{{ money($this->cartSubtotal) }}</span>
                    </div>
                    @if (bccomp($totalDiscount, '0', 2) > 0)
                        <div class="flex items-center justify-between text-sm font-semibold text-[var(--color-danger)]">
                            <span>{{ __('pos.discount') }}</span>
                            <span>-{{ money($totalDiscount) }}</span>
                        </div>
                    @endif
                </div>

                <div x-data="{ open: @js($discountType !== null) }" class="mt-2">
                    <button type="button" x-show="! open" @click="open = true" class="text-xs font-semibold text-[var(--color-info)] hover:underline">
                        + {{ __('pos.add_sale_discount') }}
                    </button>
                    <div x-show="open" x-cloak class="flex items-center gap-2">
                        <select wire:model.live="discountType" aria-label="{{ __('pos.sale_discount') }}" class="h-9 min-w-0 flex-1 rounded-lg border border-black/10 bg-white px-2 py-0 text-xs font-semibold text-[var(--text-primary)]">
                            <option value="">{{ __('pos.no_discount') }}</option>
                            <option value="flat">{{ __('pos.discount_type_flat') }}</option>
                            <option value="percentage">{{ __('pos.discount_type_percentage') }}</option>
                        </select>
                        @if ($discountType === 'flat')
                            <input type="number" step="1" min="0" wire:model.live.debounce.400ms="discountValue" aria-label="{{ __('pos.sale_discount') }}" class="h-9 w-24 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">
                        @elseif ($discountType === 'percentage')
                            <input type="number" step="0.01" min="0" max="100" wire:model.live.debounce.400ms="discountValue" aria-label="{{ __('pos.sale_discount') }}" class="h-9 w-24 rounded-lg border border-black/10 bg-white px-2 text-sm font-semibold text-[var(--text-primary)]">
                        @endif
                    </div>
                    <x-input-error :messages="$errors->get('discountValue')" class="mt-1" />
                </div>

                <div class="mt-3 flex items-end justify-between">
                    <span class="text-base font-bold text-[var(--text-primary)]">{{ __('pos.total') }}</span>
                    <span class="text-3xl font-bold tracking-tight text-[var(--text-primary)]">{{ money($this->cartTotal) }}</span>
                </div>

                <button
                    type="button"
                    wire:click="openCheckout"
                    @if ($itemCount === 0) disabled @endif
                    class="mt-3 flex min-h-[54px] w-full items-center justify-center gap-2 rounded-xl bg-[var(--navbar-primary-color)] px-5 text-lg font-bold text-white shadow-sm transition hover:opacity-90 disabled:opacity-40"
                >
                    {{ __('pos.checkout') }}
                </button>
            </div>
        </aside>
    </div>

    {{-- Mobile: docked bar that opens the cart drawer. The start padding
         leaves room for the sidebar's floating menu button (bottom-4
         start-4 in components/sidebar.blade.php), which would otherwise sit
         on top of the Cart button. --}}
    <div class="glass-panel-strong fixed inset-x-0 bottom-0 z-30 flex items-center gap-3 !rounded-none p-3 ps-[4.5rem] lg:hidden">
        <button type="button" @click="cartOpen = true" class="flex min-h-[52px] min-w-0 flex-1 items-center justify-between gap-2 rounded-xl bg-white/80 px-3 text-start shadow-sm">
            <span class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="hidden h-6 w-6 text-[var(--navbar-primary-color)] sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.881-4.751 2.234-7.298a1.75 1.75 0 00-1.734-2.02H5.106M7.5 14.25L5.106 5.417M7.5 14.25L5.106 5.417" />
                </svg>
                <span class="whitespace-nowrap text-sm font-bold text-[var(--text-primary)]">{{ __('pos.view_cart') }} ({{ $itemCount }})</span>
            </span>
            <span class="truncate whitespace-nowrap text-base font-bold text-[var(--text-primary)] sm:text-lg">{{ money($this->cartTotal) }}</span>
        </button>
        <button
            type="button"
            wire:click="openCheckout"
            @if ($itemCount === 0) disabled @endif
            class="min-h-[52px] rounded-xl bg-[var(--navbar-primary-color)] px-5 text-base font-bold text-white shadow-sm disabled:opacity-40"
        >
            {{ __('pos.checkout') }}
        </button>
    </div>

    {{-- Checkout --}}
    <x-glass-modal show="showCheckoutModal" maxWidth="max-w-xl">
        <form wire:submit="checkout" class="space-y-4">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold text-[var(--text-primary)]">{{ __('pos.checkout') }}</h3>
                    <p class="text-sm font-semibold text-[var(--text-secondary)]">
                        {{ trans_choice('pos.held_items_count', $itemCount, ['count' => $itemCount]) }}
                        &middot; {{ $customer_id ? ($customers->firstWhere('id', $customer_id)?->name ?? __('pos.walk_in')) : __('pos.walk_in') }}
                    </p>
                </div>
                <p class="text-3xl font-bold tracking-tight text-[var(--text-primary)]">{{ money($this->cartTotal) }}</p>
            </div>

            @php
                // Blank On Account lines filled with the rest, as checkout will post them.
                $resolvedLines = $this->resolvedPaymentLines();
            @endphp
            <div class="space-y-3">
                @foreach ($paymentLines as $index => $line)
                    <div wire:key="payment-line-{{ $index }}" class="grid grid-cols-1 gap-3 rounded-xl border border-black/10 bg-white/60 p-4 sm:grid-cols-[1fr_1fr_1fr_auto]">
                        <div>
                            <x-input-label :value="__('ledger.method')" />
                            <select wire:model.live="paymentLines.{{ $index }}.method" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                                <option value="cash">{{ __('ledger.cash') }}</option>
                                <option value="bank">{{ __('ledger.bank') }}</option>
                                <option value="ledger" @if (! $customer_id) disabled @endif>{{ __('purchases.on_account') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('paymentLines.'.$index.'.method')" class="mt-1" />
                        </div>
                        <div>
                            @if ($line['method'] === 'bank')
                                <x-input-label :value="__('ledger.bank_account')" />
                                <select wire:model="paymentLines.{{ $index }}.bank_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                                    <option value="">{{ __('ledger.select_bank') }}</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('paymentLines.'.$index.'.bank_id')" class="mt-1" />
                            @endif
                        </div>
                        @php
                            $restOnAccount = $line['method'] === 'ledger' && blank($line['amount']) && ! blank($resolvedLines[$index]['amount'] ?? null)
                                ? $resolvedLines[$index]['amount']
                                : null;
                        @endphp
                        <div>
                            <x-input-label :value="__('ledger.amount')" />
                            <input type="number" step="0.01" min="0.01" wire:model.live="paymentLines.{{ $index }}.amount" @if ($restOnAccount !== null) placeholder="{{ $restOnAccount }}" @endif class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                            <x-input-error :messages="$errors->get('paymentLines.'.$index.'.amount')" class="mt-1" />
                        </div>
                        <div class="flex items-end">
                            @if (count($paymentLines) > 1)
                                <button type="button" wire:click="removePaymentLine({{ $index }})" class="min-h-[44px] min-w-[44px] rounded-xl text-lg font-bold text-[var(--color-danger)] hover:bg-black/5" aria-label="{{ __('offline.remove_payment_line') }}">
                                    &times;
                                </button>
                            @endif
                        </div>
                        @if ($restOnAccount !== null)
                            <p class="text-xs font-semibold text-[var(--text-secondary)] sm:col-span-4">{{ __('pos.rest_on_account', ['amount' => money($restOnAccount)]) }}</p>
                        @endif
                    </div>
                @endforeach
            </div>

            <button type="button" wire:click="addPaymentLine" class="min-h-[44px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                + {{ __('purchases.add_payment_line') }}
            </button>

            @php
                $paidSoFar = collect($resolvedLines)->sum(fn ($line) => (float) ($line['amount'] ?: 0));
                $remaining = round((float) $this->cartTotal - $paidSoFar, 2);
            @endphp
            <div class="flex items-center justify-between rounded-xl border px-4 py-3 {{ $remaining === 0.0 ? 'border-[var(--color-success)]/30 bg-[var(--color-success)]/10' : 'border-[var(--color-warning)]/30 bg-[var(--color-warning)]/10' }}">
                <span class="text-sm font-bold {{ $remaining === 0.0 ? 'text-[var(--color-success)]' : 'text-[var(--color-warning)]' }}">
                    {{ $remaining === 0.0 ? __('pos.fully_paid') : __('pos.remaining_to_pay') }}
                </span>
                @if ($remaining !== 0.0)
                    <span class="text-sm font-bold text-[var(--color-warning)]">{{ money($remaining) }}</span>
                @endif
            </div>

            @php
                $hasLedgerLine = collect($paymentLines)->contains(fn ($line) => $line['method'] === 'ledger');
            @endphp
            @if ($hasLedgerLine)
                <div
                    x-data="cameraCapture()"
                    data-unsupported-message="{{ __('pos.camera_unsupported') }}"
                    data-denied-message="{{ __('pos.camera_denied') }}"
                    class="rounded-xl border border-black/10 bg-white/60 p-4"
                >
                    <p class="mb-2 text-sm font-bold text-[var(--text-primary)]">{{ __('pos.customer_photo') }}</p>

                    <template x-if="!photoDataUrl">
                        <button type="button" @click="openCamera()" class="inline-flex min-h-[44px] items-center gap-2 rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                            {{ __('pos.capture_customer_photo') }}
                        </button>
                    </template>

                    <template x-if="photoDataUrl">
                        <div class="flex items-center gap-3">
                            <img :src="photoDataUrl" class="h-16 w-16 rounded-lg border border-black/10 object-cover">
                            <button type="button" @click="retake()" class="min-h-[44px] rounded-lg px-3 text-sm font-semibold hover:bg-black/5">
                                {{ __('pos.retake_photo') }}
                            </button>
                            <button type="button" @click="removePhoto()" class="min-h-[44px] rounded-lg px-3 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                                {{ __('pos.remove_photo') }}
                            </button>
                        </div>
                    </template>

                    <p x-show="error" x-cloak x-text="error" class="mt-2 text-sm font-semibold text-[var(--color-danger)]"></p>

                    <div x-show="cameraOpen" x-cloak class="fixed inset-0 z-[70] flex items-center justify-center bg-black/70 p-4">
                        <div class="glass-panel-strong w-full max-w-md p-4">
                            <video x-ref="video" autoplay playsinline muted class="w-full rounded-xl bg-black"></video>
                            <canvas x-ref="canvas" class="hidden"></canvas>
                            <div class="mt-4 flex justify-end gap-3">
                                <button type="button" @click="closeCamera()" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-white hover:bg-white/10">
                                    {{ __('pos.camera_cancel') }}
                                </button>
                                <button type="button" @click="takeSnapshot()" class="min-h-[44px] rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                                    {{ __('pos.camera_capture_button') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <x-input-error :messages="$errors->get('paymentLines')" class="mt-1" />
            <x-input-error :messages="$errors->get('capturedPhoto')" class="mt-1" />
            {{-- Cart and discount errors render in the cart, which this pop-up covers. --}}
            @if ($errors->hasAny(['cart', 'cart.*', 'discountType', 'discountValue']))
                <x-input-error :messages="[__('pos.fix_cart_first')]" class="mt-1" />
            @endif

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showCheckoutModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('vendors.cancel') }}
                </button>
                <x-primary-button>{{ __('pos.complete_sale') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
