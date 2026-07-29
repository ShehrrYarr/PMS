<div class="space-y-6">
    <div class="glass-panel p-4 sm:p-5">
        <h4 class="text-base font-bold text-[var(--text-primary)]">{{ __('settings.banner_upload') }}</h4>
        <p class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('settings.banner_dimensions_hint') }}</p>

        <form wire:submit="addBanner" class="mt-3 max-w-md space-y-3">
            <input type="file" wire:model="banner" accept="image/*" class="block w-full text-sm text-[var(--text-primary)] file:mr-3 file:min-h-[44px] file:rounded-xl file:border-0 file:bg-[var(--navbar-primary-color)] file:px-4 file:py-2 file:text-sm file:font-bold file:text-white">
            <div wire:loading wire:target="banner" class="text-xs text-[var(--text-secondary)]">{{ __('settings.uploading') }}</div>
            @if ($banner)
                <img src="{{ $banner->temporaryUrl() }}" alt="" class="h-20 w-full rounded-xl border border-black/10 object-cover">
            @endif
            <x-input-error :messages="$errors->get('banner')" class="mt-1" />

            <div class="flex justify-end">
                <x-primary-button>{{ __('settings.banner_add') }}</x-primary-button>
            </div>
        </form>
    </div>

    <div class="glass-panel p-4 sm:p-5">
        <h4 class="mb-3 text-base font-bold text-[var(--text-primary)]">{{ __('settings.banner_current') }}</h4>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($banners as $item)
                <div class="relative overflow-hidden rounded-xl border border-black/10">
                    <img src="{{ Illuminate\Support\Facades\Storage::disk('public')->url($item->image_path) }}" alt="" class="h-28 w-full object-cover">
                    <button
                        type="button"
                        wire:click="delete({{ $item->id }})"
                        onclick="return confirm('{{ __('settings.banner_delete_confirm') }}')"
                        class="absolute end-2 top-2 min-h-[36px] min-w-[36px] rounded-full bg-black/60 px-3 py-1 text-sm font-bold text-white hover:bg-black/80"
                    >
                        &times;
                    </button>
                </div>
            @empty
                <p class="text-sm text-[var(--text-secondary)] sm:col-span-2 lg:col-span-3">{{ __('settings.banner_none') }}</p>
            @endforelse
        </div>
    </div>

    <div class="glass-panel p-4 sm:p-5">
        <h4 class="mb-3 text-base font-bold text-[var(--text-primary)]">{{ __('settings.banner_interval') }}</h4>
        <form wire:submit="saveInterval" class="flex max-w-xs items-end gap-3">
            <div class="flex-1">
                <x-input-label for="intervalSeconds" :value="__('settings.banner_interval_seconds')" />
                <x-text-input id="intervalSeconds" type="number" min="2" max="60" class="mt-1" wire:model="intervalSeconds" />
                <x-input-error :messages="$errors->get('intervalSeconds')" class="mt-1" />
            </div>
            <x-primary-button>{{ __('settings.save') }}</x-primary-button>
        </form>
    </div>
</div>
