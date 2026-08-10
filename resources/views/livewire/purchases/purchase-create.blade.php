<div>
    <x-page-header>
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('purchases.new') }}</h2>
    </x-page-header>

    <form wire:submit="save" class="space-y-6">
        <div class="glass-panel p-4 sm:p-6">
            <x-input-label for="vendor_id" :value="__('purchases.vendor')" />
            <div class="mt-1 max-w-md">
                <x-searchable-select wire:model="vendor_id" :options="$vendors" :placeholder="__('purchases.select_vendor')" />
            </div>
            <x-input-error :messages="$errors->get('vendor_id')" class="mt-1" />
        </div>

        <div class="glass-panel p-4 sm:p-6">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-[var(--text-primary)]">{{ __('purchases.line_items') }}</h3>
                <button type="button" wire:click="addItem" class="min-h-[44px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                    + {{ __('purchases.add_item') }}
                </button>
            </div>

            <x-input-error :messages="$errors->get('items')" class="mb-3" />

            <div class="space-y-4">
                @foreach ($items as $index => $item)
                    <div wire:key="purchase-item-{{ $index }}" class="grid grid-cols-1 gap-3 rounded-xl border border-black/10 bg-white/50 p-4 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <x-input-label :value="__('purchases.product')" />
                            <div class="mt-1">
                                <x-searchable-select wire:model="items.{{ $index }}.product_id" :options="$products" :placeholder="__('purchases.select_product')" />
                            </div>
                            <x-input-error :messages="$errors->get('items.'.$index.'.product_id')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label :value="__('batches.manufacturing_date')" />
                            <input type="date" wire:model="items.{{ $index }}.manufacturing_date" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                            <x-input-error :messages="$errors->get('items.'.$index.'.manufacturing_date')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label :value="__('batches.expiry_date')" />
                            <input type="date" wire:model="items.{{ $index }}.expiry_date" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                            <x-input-error :messages="$errors->get('items.'.$index.'.expiry_date')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label :value="__('purchases.cost_price')" />
                            <input type="number" step="0.01" min="0.01" wire:model="items.{{ $index }}.cost_price" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                            <x-input-error :messages="$errors->get('items.'.$index.'.cost_price')" class="mt-1" />
                        </div>
                        <div class="flex items-end gap-2">
                            <div class="flex-1">
                                <x-input-label :value="__('purchases.quantity')" />
                                <input type="number" step="0.01" min="0.01" wire:model="items.{{ $index }}.quantity" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                                <x-input-error :messages="$errors->get('items.'.$index.'.quantity')" class="mt-1" />
                            </div>
                            @if (count($items) > 1)
                                <button type="button" wire:click="removeItem({{ $index }})" class="min-h-[44px] min-w-[44px] rounded-xl text-lg font-bold text-[var(--color-danger)] hover:bg-black/5">
                                    &times;
                                </button>
                            @endif
                        </div>
                        <div class="sm:col-span-6">
                            <x-input-label :value="__('purchases.barcode')" />
                            <x-text-input type="text" wire:model="items.{{ $index }}.barcode" placeholder="{{ __('purchases.barcode_placeholder') }}" class="mt-1 font-mono text-sm" />
                            <x-input-error :messages="$errors->get('items.'.$index.'.barcode')" class="mt-1" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="glass-panel p-4 sm:p-6">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                <h3 class="text-lg font-bold text-[var(--text-primary)]">{{ __('purchases.payment_split') }}</h3>
                <p class="text-base font-bold text-[var(--text-primary)]">{{ __('purchases.total') }}: {{ money($this->total) }}</p>
            </div>

            <div class="space-y-3">
                @foreach ($paymentLines as $index => $line)
                    <div wire:key="purchase-payment-line-{{ $index }}" class="grid grid-cols-1 gap-3 rounded-xl border border-black/10 bg-white/50 p-4 sm:grid-cols-4">
                        <div>
                            <x-input-label :value="__('ledger.method')" />
                            <select wire:model.live="paymentLines.{{ $index }}.method" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                                <option value="cash">{{ __('ledger.cash') }}</option>
                                <option value="bank">{{ __('ledger.bank') }}</option>
                                <option value="ledger">{{ __('purchases.on_account') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('paymentLines.'.$index.'.method')" class="mt-1" />
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
                                <x-input-error :messages="$errors->get('paymentLines.'.$index.'.bank_id')" class="mt-1" />
                            </div>
                        @endif
                        <div>
                            <x-input-label :value="__('ledger.amount')" />
                            <input type="number" step="0.01" min="0.01" wire:model="paymentLines.{{ $index }}.amount" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-3 py-2 text-sm font-medium text-[var(--text-primary)]">
                            <x-input-error :messages="$errors->get('paymentLines.'.$index.'.amount')" class="mt-1" />
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

            <button type="button" wire:click="addPaymentLine" class="mt-4 min-h-[44px] rounded-xl bg-black/5 px-4 py-2 text-sm font-bold text-[var(--text-primary)] hover:bg-black/10">
                + {{ __('purchases.add_payment_line') }}
            </button>

            <x-input-error :messages="$errors->get('paymentLines')" class="mt-3" />
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('purchases.index') }}" wire:navigate class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                {{ __('vendors.cancel') }}
            </a>
            <x-primary-button>{{ __('purchases.submit') }}</x-primary-button>
        </div>
    </form>
</div>
