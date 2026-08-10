<div>
    <x-page-header>
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('products.title') }}</h2>
            @can('products.manage')
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('categories.index') }}" wire:navigate class="inline-flex min-h-[44px] items-center rounded-xl px-4 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                        {{ __('categories.manage') }}
                    </a>
                    <a href="{{ route('companies.index') }}" wire:navigate class="inline-flex min-h-[44px] items-center rounded-xl px-4 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                        {{ __('companies.manage') }}
                    </a>
                    <button type="button" wire:click="create" class="inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                        {{ __('products.add') }}
                    </button>
                </div>
            @endcan
        </div>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <div class="mb-4 flex flex-wrap items-end gap-3">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="{{ __('products.search') }}"
                class="min-h-[44px] w-full max-w-sm rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] shadow-sm focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"
            >
            <select wire:model.live="companyId" class="min-h-[44px] rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] shadow-sm focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]">
                <option value="">{{ __('products.search_company') }}</option>
                @foreach ($companies as $companyOption)
                    <option value="{{ $companyOption->id }}">{{ $companyOption->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('products.name') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('products.sku') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('products.category') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('products.company') }}</th>
                        <th class="px-3 py-2 text-start">{{ __('products.unit') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('products.price') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('products.stock') }}</th>
                        <th class="px-3 py-2 text-center">{{ __('products.status') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('products.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3">{{ $product->name }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $product->sku }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $product->category?->name ?? '—' }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $product->company?->name ?? '—' }}</td>
                            <td class="px-3 py-3 text-[var(--text-secondary)]">{{ $product->unit }}</td>
                            <td class="px-3 py-3 text-end">{{ money($product->default_sale_price) }}</td>
                            <td class="px-3 py-3 text-end font-bold">{{ number_format((float) $product->totalRemainingQuantity(), 0) }}</td>
                            <td class="px-3 py-3 text-center">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $product->is_active ? 'bg-[var(--color-success)]/10 text-[var(--color-success)]' : 'bg-[var(--color-danger)]/10 text-[var(--color-danger)]' }}">
                                    {{ $product->is_active ? __('products.active') : __('products.inactive') }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('batches.index', ['product' => $product->id]) }}" wire:navigate class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-info)] hover:bg-black/5">
                                        {{ __('products.batches') }}
                                    </a>
                                    @can('products.manage')
                                        <button type="button" wire:click="edit({{ $product->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold hover:bg-black/5">
                                            {{ __('products.edit') }}
                                        </button>
                                        <button type="button" wire:click="toggleActive({{ $product->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                                            {{ $product->is_active ? __('products.deactivate') : __('products.activate') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('products.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

    <x-glass-modal show="showModal">
        <form wire:submit="save" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">
                {{ $form->product ? __('products.edit') : __('products.add') }}
            </h3>

            <div>
                <x-input-label for="name" :value="__('products.name')" />
                <x-text-input id="name" type="text" class="mt-1" wire:model="form.name" required />
                <x-input-error :messages="$errors->get('form.name')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="sku" :value="__('products.sku')" />
                <x-text-input id="sku" type="text" class="mt-1" wire:model="form.sku" required />
                <x-input-error :messages="$errors->get('form.sku')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="category_id" :value="__('products.category')" />
                <select id="category_id" wire:model="form.category_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                    <option value="">{{ __('products.no_category') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.category_id')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="company_id" :value="__('products.company')" />
                <select id="company_id" wire:model="form.company_id" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                    <option value="">{{ __('products.no_company') }}</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.company_id')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="unit" :value="__('products.unit')" />
                <x-text-input id="unit" type="text" class="mt-1" wire:model="form.unit" placeholder="{{ __('products.unit_placeholder') }}" required />
                <x-input-error :messages="$errors->get('form.unit')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="default_sale_price" :value="__('products.price')" />
                <x-text-input id="default_sale_price" type="number" step="0.01" min="0" class="mt-1" wire:model="form.default_sale_price" />
                <x-input-error :messages="$errors->get('form.default_sale_price')" class="mt-1" />
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('products.cancel') }}
                </button>
                <x-primary-button>{{ __('products.save') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
