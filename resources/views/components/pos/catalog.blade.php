@props(['adapter'])

{{--
    The POS product grid + batch pop-up, shared by the live POS
    (livewire/pos/pos.blade.php) and the offline till (pos/offline.blade.php).
    All behaviour lives in resources/js/pos/catalog.js; `adapter` is a JS
    object literal supplying load/add/scan/cartLines for the screen it sits on.

    Holds no per-request data of its own (only translations), so it is safe
    inside the offline till's cached shell.
--}}
@php
    $catalogTranslations = [
        'in_stock' => __('pos.in_stock_count'),
        'out_of_stock' => __('pos.out_of_stock_label'),
        'expired' => __('pos.expired'),
        'expires_today' => __('pos.expires_today'),
        'expires_in_day' => __('pos.expires_in_day'),
        'expires_in_days' => __('pos.expires_in_days'),
        'invalid_quantity' => __('pos.invalid_quantity'),
        'added_to_cart' => __('pos.added_to_cart'),
        'scanned' => __('pos.scanned'),
        'action_failed' => __('pos.action_failed'),
    ];
@endphp

<div
    x-data="posCatalog(Object.assign({{ $adapter }}, {
        translations: @js($catalogTranslations),
        locale: @js(app()->getLocale()),
    }))"
    {{ $attributes->merge(['class' => 'flex min-h-0 flex-1 flex-col gap-3']) }}
>
    {{-- Search / scan + company filter --}}
    <div class="glass-panel-strong flex flex-col gap-2 p-3 xl:flex-row xl:items-center xl:gap-3">
        <div class="relative min-w-0 flex-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute inset-y-0 start-3.5 my-auto h-5 w-5 text-[var(--navbar-primary-color)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6v12M8 6v12M11 6v12M15 6v12M18 6v12M21 6v12" />
            </svg>
            <input
                x-ref="search"
                x-model="query"
                @keydown.enter.prevent="submitSearch()"
                @keydown.escape="clearSearch()"
                type="text"
                autocomplete="off"
                aria-label="{{ __('pos.search_products') }}"
                placeholder="{{ __('pos.search_products') }}"
                class="min-h-[48px] w-full rounded-xl border-2 border-[var(--navbar-primary-color)]/25 bg-white ps-11 pe-11 text-base font-semibold text-[var(--text-primary)] placeholder:font-medium placeholder:text-[var(--text-secondary)]/70 focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"
            >
            <button
                type="button"
                x-show="query !== ''"
                x-cloak
                @click="clearSearch()"
                class="absolute inset-y-0 end-1.5 my-auto flex h-9 w-9 items-center justify-center rounded-lg text-[var(--text-secondary)] hover:bg-black/5"
                aria-label="{{ __('pos.clear_search') }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <select
            x-show="companies.length > 0"
            x-cloak
            x-model="companyId"
            aria-label="{{ __('products.company') }}"
            class="min-h-[48px] rounded-xl border border-black/10 bg-white px-4 text-sm font-semibold text-[var(--text-primary)] focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)] xl:w-52"
        >
            <option value="">{{ __('products.search_company') }}</option>
            <template x-for="company in companies" :key="company.id">
                <option :value="company.id" x-text="company.name"></option>
            </template>
        </select>
    </div>

    {{-- Scan / add feedback --}}
    <div
        x-show="message !== ''"
        x-cloak
        x-transition.opacity
        role="status"
        class="flex items-start justify-between gap-3 rounded-xl border px-4 py-2.5 text-sm font-semibold"
        :class="{
            'border-[var(--color-danger)]/30 bg-[var(--color-danger)]/10 text-[var(--color-danger)]': messageTone === 'error',
            'border-[var(--color-warning)]/40 bg-[var(--color-warning)]/10 text-[var(--color-warning)]': messageTone === 'warning',
            'border-[var(--color-success)]/30 bg-[var(--color-success)]/10 text-[var(--color-success)]': messageTone === 'success',
        }"
    >
        <span x-text="message"></span>
        <button type="button" @click="message = ''" class="-me-1 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded text-base leading-none hover:bg-black/5" aria-label="{{ __('pos.close') }}">&times;</button>
    </div>

    {{-- Category tabs --}}
    <div x-show="categories.length > 0" x-cloak class="scrollbar-none -mx-1 flex gap-2 overflow-x-auto px-1 pb-1" role="tablist" aria-label="{{ __('products.category') }}">
        <button
            type="button"
            role="tab"
            @click="categoryId = 'all'"
            :aria-selected="(categoryId === 'all').toString()"
            :class="categoryId === 'all' ? 'bg-[var(--navbar-primary-color)] text-white shadow-sm' : 'bg-white/70 text-[var(--text-secondary)] hover:bg-white'"
            class="inline-flex min-h-[40px] flex-shrink-0 items-center gap-2 rounded-full px-4 text-sm font-bold transition"
        >
            {{ __('pos.all_categories') }}
            <span class="rounded-full bg-black/10 px-2 text-xs" x-text="categoryCount('all')"></span>
        </button>
        <template x-for="category in categories" :key="category.id">
            <button
                type="button"
                role="tab"
                @click="categoryId = category.id"
                :aria-selected="(categoryId === category.id).toString()"
                :class="categoryId === category.id ? 'bg-[var(--navbar-primary-color)] text-white shadow-sm' : 'bg-white/70 text-[var(--text-secondary)] hover:bg-white'"
                class="inline-flex min-h-[40px] flex-shrink-0 items-center gap-2 rounded-full px-4 text-sm font-bold transition"
            >
                <span x-text="category.name"></span>
                <span class="rounded-full bg-black/10 px-2 text-xs" x-text="categoryCount(category.id)"></span>
            </button>
        </template>
        <button
            type="button"
            role="tab"
            x-show="hasUncategorized"
            @click="categoryId = 'none'"
            :aria-selected="(categoryId === 'none').toString()"
            :class="categoryId === 'none' ? 'bg-[var(--navbar-primary-color)] text-white shadow-sm' : 'bg-white/70 text-[var(--text-secondary)] hover:bg-white'"
            class="inline-flex min-h-[40px] flex-shrink-0 items-center gap-2 rounded-full px-4 text-sm font-bold transition"
        >
            {{ __('pos.uncategorized') }}
            <span class="rounded-full bg-black/10 px-2 text-xs" x-text="categoryCount('none')"></span>
        </button>
    </div>

    {{-- Product grid --}}
    <div class="min-h-0 flex-1 lg:-me-2 lg:overflow-y-auto lg:pe-2">
        {{-- Loading skeleton --}}
        <div x-show="! loaded" class="grid grid-cols-[repeat(auto-fill,minmax(8.5rem,1fr))] gap-3 sm:grid-cols-[repeat(auto-fill,minmax(9.5rem,1fr))]">
            @for ($i = 0; $i < 8; $i++)
                <div class="overflow-hidden rounded-2xl border border-white/80 bg-white/60">
                    <div class="aspect-square animate-pulse bg-black/5"></div>
                    <div class="space-y-2 p-3">
                        <div class="h-3 w-3/4 animate-pulse rounded bg-black/10"></div>
                        <div class="h-3 w-1/3 animate-pulse rounded bg-black/10"></div>
                    </div>
                </div>
            @endfor
        </div>

        <div x-show="loaded && loadFailed" x-cloak class="glass-panel flex flex-col items-center gap-3 px-6 py-12 text-center">
            <p class="text-base font-bold text-[var(--text-primary)]">{{ __('pos.catalog_load_failed') }}</p>
            <button type="button" @click="reload()" class="min-h-[44px] rounded-xl bg-[var(--navbar-primary-color)] px-5 text-sm font-bold text-white hover:opacity-90">{{ __('pos.try_again') }}</button>
        </div>

        <div x-show="loaded && ! loadFailed && filtered.length === 0" x-cloak class="glass-panel flex flex-col items-center gap-2 px-6 py-14 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[var(--text-secondary)]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </svg>
            <p class="text-base font-bold text-[var(--text-primary)]" x-text="products.length === 0 ? @js(__('pos.no_products_yet')) : @js(__('pos.no_products_match'))"></p>
        </div>

        <div x-show="loaded && ! loadFailed && filtered.length > 0" x-cloak class="grid grid-cols-[repeat(auto-fill,minmax(8.5rem,1fr))] gap-3 pb-2 sm:grid-cols-[repeat(auto-fill,minmax(9.5rem,1fr))]">
            <template x-for="product in visible" :key="product.id">
                <button
                    type="button"
                    @click="openProduct(product)"
                    :disabled="product.batches.length === 0"
                    :aria-label="product.name + ', ' + formatMoney(product.unit_price) + ', ' + stockLabel(product)"
                    class="group relative flex flex-col overflow-hidden rounded-2xl border border-white/80 bg-white/75 text-start shadow-sm transition duration-150 hover:-translate-y-0.5 hover:border-[var(--navbar-primary-color)]/40 hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--navbar-primary-color)] disabled:translate-y-0 disabled:cursor-not-allowed disabled:opacity-55 disabled:shadow-none disabled:grayscale"
                >
                    <div class="relative aspect-square w-full overflow-hidden bg-white">
                        <template x-if="product.image_url">
                            <img :src="product.image_url" alt="" loading="lazy" decoding="async" class="h-full w-full object-contain p-2 transition duration-200 group-hover:scale-[1.03]">
                        </template>
                        <template x-if="! product.image_url">
                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[var(--navbar-accent-color)] to-white">
                                <span class="text-4xl font-bold text-[var(--navbar-primary-color)]/70" x-text="initial(product.name)"></span>
                            </div>
                        </template>

                        <span
                            x-show="product.hasExpired"
                            class="absolute start-2 top-2 rounded-full bg-[var(--color-danger)] px-2 py-0.5 text-[11px] font-bold text-white shadow-sm"
                        >{{ __('pos.has_expired_stock') }}</span>
                        <span
                            x-show="! product.hasExpired && product.hasExpiringSoon"
                            class="absolute start-2 top-2 rounded-full bg-[var(--color-warning)] px-2 py-0.5 text-[11px] font-bold text-white shadow-sm"
                        >{{ __('pos.expiring_soon') }}</span>

                        <span
                            class="absolute bottom-2 end-2 rounded-full px-2 py-0.5 text-[11px] font-bold shadow-sm"
                            :class="product.stock > 0 ? 'bg-white/95 text-[var(--text-primary)]' : 'bg-[var(--text-secondary)] text-white'"
                            x-text="stockLabel(product)"
                        ></span>
                    </div>

                    <div class="flex flex-1 flex-col gap-0.5 border-t border-black/5 p-3">
                        <p class="line-clamp-2 text-sm font-bold leading-snug text-[var(--text-primary)]" x-text="product.name"></p>
                        <p class="truncate text-xs font-medium text-[var(--text-secondary)]" x-text="product.unit"></p>
                        <p class="mt-auto pt-1 text-base font-bold text-[var(--navbar-primary-color)]" x-text="formatMoney(product.unit_price)"></p>
                    </div>
                </button>
            </template>
        </div>

        <div x-show="hasMore" x-cloak class="flex justify-center py-3">
            <button type="button" @click="showMore()" class="min-h-[44px] rounded-xl bg-white/70 px-6 text-sm font-bold text-[var(--text-primary)] shadow-sm hover:bg-white">
                {{ __('pos.show_more') }}
            </button>
        </div>
    </div>

    {{-- Batch pop-up --}}
    <div
        x-show="dialogOpen"
        x-cloak
        @keydown.escape.window="dialogOpen && closeDialog()"
        class="fixed inset-0 z-[60] flex items-end justify-center sm:items-center sm:p-4"
    >
        <div class="absolute inset-0 bg-black/50" @click="closeDialog()" x-show="dialogOpen" x-transition.opacity></div>

        <div
            x-show="dialogOpen"
            x-transition:enter="transition duration-150 ease-out"
            x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
            role="dialog"
            aria-modal="true"
            aria-labelledby="pos-batch-dialog-title"
            @keydown.arrow-down.prevent="moveSelection(1)"
            @keydown.arrow-up.prevent="moveSelection(-1)"
            @keydown.enter.prevent="confirm()"
            class="relative flex max-h-[92vh] w-full flex-col overflow-hidden rounded-t-3xl bg-white shadow-2xl sm:max-w-2xl sm:rounded-3xl"
        >
            <template x-if="activeProduct">
                <div class="flex min-h-0 flex-1 flex-col">
                    {{-- Header --}}
                    <div class="flex items-start gap-4 border-b border-black/5 p-4 sm:p-5">
                        <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-black/5 bg-[var(--navbar-accent-color)] sm:h-20 sm:w-20">
                            <template x-if="activeProduct.image_url">
                                <img :src="activeProduct.image_url" alt="" class="h-full w-full bg-white object-contain p-1">
                            </template>
                            <template x-if="! activeProduct.image_url">
                                <span class="text-2xl font-bold text-[var(--navbar-primary-color)]" x-text="initial(activeProduct.name)"></span>
                            </template>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 id="pos-batch-dialog-title" class="text-lg font-bold leading-snug text-[var(--text-primary)]" x-text="activeProduct.name"></h3>
                            <p class="mt-0.5 text-sm font-medium text-[var(--text-secondary)]">
                                <span x-text="formatMoney(activeProduct.unit_price)" class="font-bold text-[var(--navbar-primary-color)]"></span>
                                <span x-show="activeProduct.unit" x-text="' / ' + activeProduct.unit"></span>
                                <span x-show="activeProduct.sku" x-text="' · ' + activeProduct.sku"></span>
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[var(--text-primary)]">{{ __('pos.choose_batch') }}</p>
                        </div>
                        <button type="button" @click="closeDialog()" class="-me-1 -mt-1 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl text-[var(--text-secondary)] hover:bg-black/5" aria-label="{{ __('pos.close') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Batches, earliest expiry first --}}
                    <div class="min-h-0 flex-1 space-y-2 overflow-y-auto bg-black/[0.02] p-3 sm:p-4" role="radiogroup" aria-labelledby="pos-batch-dialog-title">
                        <template x-for="(batch, index) in activeProduct.batches" :key="batch.id">
                            <button
                                type="button"
                                role="radio"
                                :aria-checked="(index === selectedIndex).toString()"
                                @click="selectBatch(index)"
                                @dblclick="selectBatch(index); confirm()"
                                :class="index === selectedIndex
                                    ? 'border-[var(--navbar-primary-color)] bg-[var(--navbar-accent-color)] shadow-sm'
                                    : 'border-black/5 bg-white hover:border-black/15'"
                                class="flex w-full items-center gap-3 rounded-2xl border-2 px-3 py-3 text-start transition sm:px-4"
                            >
                                <span
                                    class="flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full border-2"
                                    :class="index === selectedIndex ? 'border-[var(--navbar-primary-color)]' : 'border-black/20'"
                                    aria-hidden="true"
                                >
                                    <span x-show="index === selectedIndex" class="h-2.5 w-2.5 rounded-full bg-[var(--navbar-primary-color)]"></span>
                                </span>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="font-mono text-sm font-bold text-[var(--text-primary)]" x-text="batch.barcode"></span>
                                        <span
                                            x-show="expiryStatus(batch) !== 'ok'"
                                            class="rounded-full px-2 py-0.5 text-[11px] font-bold text-white"
                                            :class="expiryStatus(batch) === 'expired' ? 'bg-[var(--color-danger)]' : 'bg-[var(--color-warning)]'"
                                            x-text="expiryLabel(batch)"
                                        ></span>
                                    </div>
                                    <p class="mt-1 text-xs font-medium text-[var(--text-secondary)]">
                                        {{ __('pos.mfg') }} <span x-text="formatDate(batch.manufacturing_date ?? batch.expiry_date)" x-show="batch.manufacturing_date"></span><span x-show="! batch.manufacturing_date">—</span>
                                        <span class="mx-1">·</span>
                                        {{ __('pos.exp') }}
                                        <span
                                            x-text="formatDate(batch.expiry_date)"
                                            :class="expiryStatus(batch) === 'expired' ? 'font-bold text-[var(--color-danger)]' : (expiryStatus(batch) === 'soon' ? 'font-bold text-[var(--color-warning)]' : 'font-semibold text-[var(--text-primary)]')"
                                        ></span>
                                    </p>
                                </div>

                                <div class="flex-shrink-0 text-end">
                                    <p class="text-sm font-bold text-[var(--text-primary)]" x-text="@js(__('pos.left_count')).replace(':count', formatQuantity(batch.quantity_remaining))"></p>
                                    <p x-show="inCart(batch.id) > 0" class="text-[11px] font-semibold text-[var(--color-info)]" x-text="@js(__('pos.in_cart_count')).replace(':count', inCart(batch.id))"></p>
                                    <p x-show="canSeeCost && batch.cost_price !== undefined" class="text-[11px] font-medium text-[var(--text-secondary)]" x-text="@js(__('pos.cost')) + ' ' + formatMoney(batch.cost_price ?? '0')"></p>
                                </div>
                            </button>
                        </template>
                    </div>

                    {{-- Quantity + add --}}
                    <div class="space-y-3 border-t border-black/5 p-4 sm:p-5">
                        <p
                            x-show="selectedBatch && expiryStatus(selectedBatch) === 'expired'"
                            class="flex items-start gap-2 rounded-xl border border-[var(--color-danger)]/30 bg-[var(--color-danger)]/10 px-3 py-2 text-sm font-semibold text-[var(--color-danger)]"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                            <span x-text="selectedBatch ? @js(__('pos.expired_batch_selected')).replace(':date', formatDate(selectedBatch.expiry_date)) : ''"></span>
                        </p>

                        <div class="flex flex-wrap items-end gap-3">
                            <div>
                                <label for="pos-batch-quantity" class="block text-xs font-bold uppercase tracking-wide text-[var(--text-secondary)]">{{ __('pos.qty') }}</label>
                                <div class="mt-1 flex items-center overflow-hidden rounded-xl border-2 border-black/10 bg-white focus-within:border-[var(--navbar-primary-color)]">
                                    <button type="button" @click="stepQuantity(-1)" class="flex h-12 w-12 items-center justify-center text-xl font-bold text-[var(--text-secondary)] hover:bg-black/5" aria-label="{{ __('pos.qty') }} −">&minus;</button>
                                    <input
                                        id="pos-batch-quantity"
                                        x-ref="quantity"
                                        x-model="quantity"
                                        @input="dialogError = ''"
                                        type="text"
                                        inputmode="numeric"
                                        pattern="[0-9]*"
                                        autocomplete="off"
                                        class="h-12 w-16 border-0 bg-transparent text-center text-lg font-bold text-[var(--text-primary)] focus:ring-0"
                                    >
                                    <button type="button" @click="stepQuantity(1)" class="flex h-12 w-12 items-center justify-center text-xl font-bold text-[var(--text-secondary)] hover:bg-black/5" aria-label="{{ __('pos.qty') }} +">+</button>
                                </div>
                            </div>

                            <div class="min-w-0 flex-1 pb-1 text-sm font-semibold text-[var(--text-secondary)]">
                                <span x-show="selectedBatch" x-text="selectedBatch ? @js(__('pos.can_add_count')).replace(':count', maxAddable(selectedBatch)) : ''"></span>
                            </div>

                            <button
                                type="button"
                                @click="confirm()"
                                :disabled="adding || ! selectedBatch"
                                class="inline-flex min-h-[48px] w-full items-center justify-center gap-2 rounded-xl bg-[var(--navbar-primary-color)] px-6 text-base font-bold text-white shadow-sm transition hover:opacity-90 disabled:opacity-60 sm:w-auto"
                            >
                                <svg x-show="adding" class="h-5 w-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                                {{ __('pos.add_to_cart') }}
                                <kbd class="hidden rounded-md bg-white/20 px-1.5 py-0.5 text-xs font-semibold sm:inline">Enter</kbd>
                            </button>
                        </div>

                        <p x-show="dialogError" x-text="dialogError" role="alert" class="text-sm font-semibold text-[var(--color-danger)]"></p>
                        <p class="hidden text-xs font-medium text-[var(--text-secondary)] sm:block">{{ __('pos.dialog_keyboard_hint') }}</p>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
