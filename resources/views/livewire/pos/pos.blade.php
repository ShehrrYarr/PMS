<div x-data x-on:sale-completed.window="window.open($event.detail.receiptUrl, '_blank')">
    <x-page-header>
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('pos.title') }}</h2>
                <p class="text-sm font-semibold text-[var(--text-secondary)]">
                    {{ __('pos.items') }}: {{ count($cart) }}
                </p>
            </div>
            <a href="{{ route('sales.index') }}" wire:navigate class="inline-flex min-h-[44px] items-center rounded-xl px-4 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                {{ __('pos.sales_history') }}
            </a>
        </div>
    </x-page-header>

    <div class="grid grid-cols-1 gap-6 pb-32 lg:grid-cols-[1fr_360px] lg:items-start lg:pb-6">
        <div class="space-y-4">
            {{-- Barcode scan bar --}}
            <div class="glass-panel-strong p-4 sm:p-5">
                <x-input-label for="barcodeInput" :value="__('pos.scan_or_enter_barcode')" />
                <div class="relative mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute inset-y-0 start-4 my-auto h-6 w-6 text-[var(--navbar-primary-color)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6v12M8 6v12M11 6v12M15 6v12M18 6v12M21 6v12M4 6H2v12h2" />
                    </svg>
                    <input
                        id="barcodeInput"
                        type="text"
                        wire:model="barcodeInput"
                        wire:keydown.enter="scanBarcode"
                        autofocus
                        autocomplete="off"
                        placeholder="{{ __('pos.scan_placeholder') }}"
                        class="min-h-[56px] w-full rounded-xl border-2 border-[var(--navbar-primary-color)]/30 bg-white ps-12 pe-4 py-3 text-lg font-bold text-[var(--text-primary)] focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"
                    >
                </div>
                @if ($scanError)
                    <p class="mt-2 flex items-center gap-1.5 text-sm font-semibold text-[var(--color-danger)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        {{ $scanError }}
                    </p>
                @endif
            </div>

            {{-- Cart --}}
            <div class="glass-panel overflow-hidden">
                <div class="flex items-center justify-between border-b border-black/10 px-4 py-3 sm:px-6">
                    <h3 class="flex items-center gap-2 text-lg font-bold text-[var(--text-primary)]">
                        {{ __('pos.cart') }}
                        @if (! empty($cart))
                            <span class="rounded-full bg-[var(--navbar-primary-color)]/10 px-2.5 py-0.5 text-sm font-bold text-[var(--navbar-primary-color)]">{{ count($cart) }}</span>
                        @endif
                    </h3>
                    @if (! empty($cart))
                        <button type="button" wire:click="clearCart" class="min-h-[36px] rounded-lg px-3 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                            {{ __('pos.clear_cart') }}
                        </button>
                    @endif
                </div>

                @if (empty($cart))
                    <div class="flex flex-col items-center justify-center gap-2 px-4 py-16 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[var(--text-secondary)]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.881-4.751 2.234-7.298a1.75 1.75 0 00-1.734-2.02H5.106M7.5 14.25L5.106 5.417M7.5 14.25L5.106 5.417" />
                        </svg>
                        <p class="text-base font-bold text-[var(--text-primary)]">{{ __('pos.cart_empty') }}</p>
                        <p class="text-sm font-semibold text-[var(--text-secondary)]">{{ __('pos.cart_empty_hint') }}</p>
                    </div>
                @else
                    <div class="divide-y divide-black/5">
                        @foreach ($cart as $index => $line)
                            <div class="flex flex-wrap items-center gap-3 px-4 py-3 sm:gap-4 sm:px-6">
                                <div class="min-w-[140px] flex-1">
                                    <p class="text-base font-bold text-[var(--text-primary)]">{{ $line['product_name'] }}</p>
                                    <p class="font-mono text-xs text-[var(--text-secondary)]">{{ $line['barcode'] }}</p>
                                </div>

                                <div>
                                    <x-input-label :value="__('pos.qty')" class="text-xs" />
                                    <div class="mt-1 flex items-center rounded-lg border border-black/10 bg-white">
                                        <button type="button" wire:click="decrementQuantity({{ $index }})" class="flex min-h-[40px] min-w-[36px] items-center justify-center text-lg font-bold text-[var(--text-secondary)] hover:bg-black/5" aria-label="{{ __('pos.qty') }} -">
                                            &minus;
                                        </button>
                                        <input type="number" step="0.01" min="0.01" max="{{ $line['available'] }}" wire:model.live="cart.{{ $index }}.quantity" class="min-h-[40px] w-14 border-0 bg-transparent text-center text-sm font-bold text-[var(--text-primary)] focus:ring-0">
                                        <button type="button" wire:click="incrementQuantity({{ $index }})" class="flex min-h-[40px] min-w-[36px] items-center justify-center text-lg font-bold text-[var(--text-secondary)] hover:bg-black/5" aria-label="{{ __('pos.qty') }} +">
                                            +
                                        </button>
                                    </div>
                                </div>

                                <div class="w-24">
                                    <x-input-label :value="__('pos.price')" class="text-xs" />
                                    <input type="number" step="0.01" min="0" wire:model.live="cart.{{ $index }}.unit_price" class="mt-1 min-h-[40px] w-full rounded-lg border border-black/10 bg-white px-2 py-1 text-sm font-semibold text-[var(--text-primary)]">
                                </div>

                                <div class="w-24 text-end">
                                    <x-input-label :value="__('pos.line_total')" class="text-xs" />
                                    <p class="mt-2 text-base font-bold text-[var(--text-primary)]">{{ number_format((float) $line['unit_price'] * (float) $line['quantity'], 2) }}</p>
                                </div>

                                <button type="button" wire:click="removeCartItem({{ $index }})" class="flex min-h-[40px] min-w-[40px] items-center justify-center rounded-lg text-[var(--color-danger)] hover:bg-black/5" aria-label="{{ __('products.actions') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Order summary sidebar --}}
        <div class="hidden space-y-4 lg:sticky lg:top-6 lg:block lg:self-start">
            <div class="glass-panel p-4 sm:p-6">
                <x-input-label for="customer_id" :value="__('pos.customer')" />
                <select id="customer_id" wire:model="customer_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                    <option value="">{{ __('pos.walk_in') }}</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="glass-panel-strong p-5 sm:p-6">
                <div class="space-y-2 border-b border-black/10 pb-4">
                    <div class="flex items-center justify-between text-sm font-semibold text-[var(--text-secondary)]">
                        <span>{{ __('pos.items') }}</span>
                        <span>{{ count($cart) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm font-semibold text-[var(--text-secondary)]">
                        <span>{{ __('pos.subtotal') }}</span>
                        <span>{{ number_format((float) $this->cartTotal, 2) }}</span>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <span class="text-lg font-bold text-[var(--text-primary)]">{{ __('pos.total') }}</span>
                    <span class="text-3xl font-bold text-[var(--text-primary)]">{{ number_format((float) $this->cartTotal, 2) }}</span>
                </div>
                <button
                    type="button"
                    wire:click="openCheckout"
                    @if (empty($cart)) disabled @endif
                    class="mt-5 min-h-[52px] w-full rounded-xl bg-[var(--navbar-primary-color)] px-5 py-3 text-lg font-bold text-white shadow-sm hover:opacity-90 disabled:opacity-40"
                >
                    {{ __('pos.checkout') }}
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile docked total bar --}}
    <div class="glass-panel-strong fixed inset-x-0 bottom-0 z-30 flex items-center justify-between gap-4 p-4 lg:hidden">
        <div>
            <p class="text-xs font-semibold text-[var(--text-secondary)]">{{ __('pos.total') }} ({{ count($cart) }})</p>
            <p class="text-xl font-bold text-[var(--text-primary)]">{{ number_format((float) $this->cartTotal, 2) }}</p>
        </div>
        <button
            type="button"
            wire:click="openCheckout"
            @if (empty($cart)) disabled @endif
            class="min-h-[52px] flex-1 rounded-xl bg-[var(--navbar-primary-color)] px-5 py-3 text-lg font-bold text-white shadow-sm disabled:opacity-40"
        >
            {{ __('pos.checkout') }}
        </button>
    </div>

    {{-- Mobile customer picker (desktop version lives in the sticky sidebar above) --}}
    <div class="glass-panel mb-4 p-4 lg:hidden">
        <x-input-label for="customer_id_mobile" :value="__('pos.customer')" />
        <select id="customer_id_mobile" wire:model="customer_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
            <option value="">{{ __('pos.walk_in') }}</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>

    <x-glass-modal show="showCheckoutModal" maxWidth="max-w-xl">
        <form wire:submit="checkout" class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-[var(--text-primary)]">{{ __('pos.checkout') }}</h3>
                <p class="text-xl font-bold text-[var(--text-primary)]">{{ number_format((float) $this->cartTotal, 2) }}</p>
            </div>

            <div class="space-y-3">
                @foreach ($paymentLines as $index => $line)
                    <div class="grid grid-cols-1 gap-3 rounded-xl border border-black/10 bg-white/50 p-4 sm:grid-cols-4">
                        <div>
                            <x-input-label :value="__('ledger.method')" />
                            <select wire:model.live="paymentLines.{{ $index }}.method" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                                <option value="cash">{{ __('ledger.cash') }}</option>
                                <option value="bank">{{ __('ledger.bank') }}</option>
                                <option value="ledger" @if (! $customer_id) disabled @endif>{{ __('purchases.on_account') }}</option>
                            </select>
                        </div>
                        @if ($line['method'] === 'bank')
                            <div>
                                <x-input-label :value="__('ledger.bank_account')" />
                                <select wire:model="paymentLines.{{ $index }}.bank_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                                    <option value="">{{ __('ledger.select_bank') }}</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div>
                            <x-input-label :value="__('ledger.amount')" />
                            <input type="number" step="0.01" min="0.01" wire:model.live="paymentLines.{{ $index }}.amount" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                        </div>
                        <div class="flex items-end">
                            @if (count($paymentLines) > 1)
                                <button type="button" wire:click="removePaymentLine({{ $index }})" class="min-h-[44px] min-w-[44px] rounded-xl text-lg font-bold text-[var(--color-danger)] hover:bg-black/5">
                                    &times;
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" wire:click="addPaymentLine" class="min-h-[44px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                + {{ __('purchases.add_payment_line') }}
            </button>

            @php
                $paidSoFar = collect($paymentLines)->sum(fn ($line) => (float) ($line['amount'] ?: 0));
                $remaining = round((float) $this->cartTotal - $paidSoFar, 2);
            @endphp
            <div class="flex items-center justify-between rounded-xl border px-4 py-3 {{ $remaining === 0.0 ? 'border-[var(--color-success)]/30 bg-[var(--color-success)]/10' : 'border-[var(--color-warning)]/30 bg-[var(--color-warning)]/10' }}">
                <span class="text-sm font-bold {{ $remaining === 0.0 ? 'text-[var(--color-success)]' : 'text-[var(--color-warning)]' }}">
                    {{ $remaining === 0.0 ? __('pos.fully_paid') : __('pos.remaining_to_pay') }}
                </span>
                @if ($remaining !== 0.0)
                    <span class="text-sm font-bold text-[var(--color-warning)]">{{ number_format($remaining, 2) }}</span>
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
                    class="rounded-xl border border-black/10 bg-white/50 p-4"
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

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showCheckoutModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('vendors.cancel') }}
                </button>
                <x-primary-button>{{ __('pos.complete_sale') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
