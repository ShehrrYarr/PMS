<div>
    <x-page-header>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('categories.title') }}</h2>
            <button type="button" wire:click="create" class="inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-5 py-2 text-base font-bold text-white shadow-sm hover:opacity-90">
                {{ __('categories.add') }}
            </button>
        </div>
    </x-page-header>

    <div class="glass-panel p-4 sm:p-6">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[480px] text-start">
                <thead>
                    <tr class="border-b border-black/10 text-sm font-semibold text-[var(--text-secondary)]">
                        <th class="px-3 py-2 text-start">{{ __('categories.name') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('categories.product_count') }}</th>
                        <th class="px-3 py-2 text-center">{{ __('categories.status') }}</th>
                        <th class="px-3 py-2 text-end">{{ __('categories.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-b border-black/5 text-base font-medium text-[var(--text-primary)]">
                            <td class="px-3 py-3">{{ $category->name }}</td>
                            <td class="px-3 py-3 text-end">{{ $category->products_count }}</td>
                            <td class="px-3 py-3 text-center">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $category->is_active ? 'bg-[var(--color-success)]/10 text-[var(--color-success)]' : 'bg-[var(--color-danger)]/10 text-[var(--color-danger)]' }}">
                                    {{ $category->is_active ? __('categories.active') : __('categories.inactive') }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <button type="button" wire:click="edit({{ $category->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold hover:bg-black/5">
                                        {{ __('categories.edit') }}
                                    </button>
                                    <button type="button" wire:click="toggleActive({{ $category->id }})" class="min-h-[44px] rounded-lg px-3 py-2 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                                        {{ $category->is_active ? __('categories.deactivate') : __('categories.activate') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-6 text-center text-[var(--text-secondary)]">{{ __('categories.none') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-glass-modal show="showModal">
        <form wire:submit="save" class="space-y-4">
            <h3 class="text-xl font-bold text-[var(--text-primary)]">
                {{ $editingCategoryId ? __('categories.edit') : __('categories.add') }}
            </h3>

            <div>
                <x-input-label for="name" :value="__('categories.name')" />
                <x-text-input id="name" type="text" class="mt-1" wire:model="name" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" wire:click="$set('showModal', false)" class="min-h-[44px] rounded-xl px-5 py-2 text-base font-semibold text-[var(--text-secondary)] hover:bg-black/5">
                    {{ __('categories.cancel') }}
                </button>
                <x-primary-button>{{ __('categories.save') }}</x-primary-button>
            </div>
        </form>
    </x-glass-modal>
</div>
