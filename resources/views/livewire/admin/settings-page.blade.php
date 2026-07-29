<div x-data="{ tab: 'general' }" x-on:branding-updated.window="window.location.reload()">
    <x-page-header>
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('settings.title') }}</h2>
    </x-page-header>

    <div class="glass-panel p-2 sm:p-2">
        <div class="flex flex-wrap gap-1">
            <button type="button" @click="tab = 'general'" :class="tab === 'general' ? 'bg-[var(--navbar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-black/5'" class="min-h-[44px] rounded-xl px-4 py-2 text-sm font-bold transition">
                {{ __('settings.tab_general') }}
            </button>
            <button type="button" @click="tab = 'receipt'" :class="tab === 'receipt' ? 'bg-[var(--navbar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-black/5'" class="min-h-[44px] rounded-xl px-4 py-2 text-sm font-bold transition">
                {{ __('settings.tab_receipt') }}
            </button>
            <button type="button" @click="tab = 'theme'" :class="tab === 'theme' ? 'bg-[var(--navbar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-black/5'" class="min-h-[44px] rounded-xl px-4 py-2 text-sm font-bold transition">
                {{ __('settings.tab_theme') }}
            </button>
            <button type="button" @click="tab = 'banks'" :class="tab === 'banks' ? 'bg-[var(--navbar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-black/5'" class="min-h-[44px] rounded-xl px-4 py-2 text-sm font-bold transition">
                {{ __('settings.tab_banks') }}
            </button>
            <button type="button" @click="tab = 'banners'" :class="tab === 'banners' ? 'bg-[var(--navbar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-black/5'" class="min-h-[44px] rounded-xl px-4 py-2 text-sm font-bold transition">
                {{ __('settings.tab_banners') }}
            </button>
            @can('developer-tools.manage')
                <button type="button" @click="tab = 'developer'" :class="tab === 'developer' ? 'bg-[var(--navbar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-black/5'" class="min-h-[44px] rounded-xl px-4 py-2 text-sm font-bold transition">
                    {{ __('settings.tab_developer') }}
                </button>
            @endcan
        </div>
    </div>

    <div class="mt-4">
        {{-- General --}}
        <div x-show="tab === 'general'" x-cloak class="glass-panel p-4 sm:p-6">
            <form wire:submit="saveGeneral" class="max-w-lg space-y-4">
                <div>
                    <x-input-label for="shopName" :value="__('settings.shop_name')" />
                    <x-text-input id="shopName" type="text" class="mt-1" wire:model="shopName" />
                    <p class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('settings.shop_name_hint') }}</p>
                    <x-input-error :messages="$errors->get('shopName')" class="mt-1" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button>{{ __('settings.save') }}</x-primary-button>
                </div>
            </form>

            <hr class="my-6 border-black/10">

            <form wire:submit="saveLogo" class="max-w-lg space-y-4">
                <div>
                    <x-input-label :value="__('settings.shop_logo')" />
                    <p class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('settings.shop_logo_hint') }}</p>

                    @if ($logoPath)
                        <div class="mt-3 flex items-center gap-3">
                            <img src="{{ Illuminate\Support\Facades\Storage::disk('public')->url($logoPath) }}" alt="" class="h-16 w-16 rounded-xl border border-black/10 bg-white/70 object-contain p-1">
                            <button type="button" wire:click="removeLogo" onclick="return confirm('{{ __('settings.remove_logo_confirm') }}')" class="min-h-[44px] rounded-xl px-4 py-2 text-sm font-semibold text-[var(--color-danger)] hover:bg-black/5">
                                {{ __('settings.remove_logo') }}
                            </button>
                        </div>
                    @endif

                    <input type="file" wire:model="logo" accept="image/*" class="mt-3 block w-full text-sm text-[var(--text-primary)] file:mr-3 file:min-h-[44px] file:rounded-xl file:border-0 file:bg-[var(--navbar-primary-color)] file:px-4 file:py-2 file:text-sm file:font-bold file:text-white">
                    <div wire:loading wire:target="logo" class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('settings.uploading') }}</div>
                    @if ($logo)
                        <img src="{{ $logo->temporaryUrl() }}" alt="" class="mt-2 h-16 w-16 rounded-xl border border-black/10 bg-white/70 object-contain p-1">
                    @endif
                    <x-input-error :messages="$errors->get('logo')" class="mt-1" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button>{{ __('settings.upload_logo') }}</x-primary-button>
                </div>
            </form>
        </div>

        {{-- Receipt --}}
        <div x-show="tab === 'receipt'" x-cloak class="glass-panel p-4 sm:p-6">
            <form wire:submit="saveReceipt" class="max-w-lg space-y-4">
                <div>
                    <x-input-label for="receiptHeaderText" :value="__('settings.receipt_header_text')" />
                    <textarea id="receiptHeaderText" wire:model="receiptHeaderText" rows="2" class="mt-1 w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"></textarea>
                    <p class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('settings.receipt_header_hint') }}</p>
                    <x-input-error :messages="$errors->get('receiptHeaderText')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="receiptFooterText" :value="__('settings.receipt_footer_text')" />
                    <textarea id="receiptFooterText" wire:model="receiptFooterText" rows="2" class="mt-1 w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)] focus:border-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]"></textarea>
                    <p class="mt-1 text-xs text-[var(--text-secondary)]">{{ __('settings.receipt_footer_hint') }}</p>
                    <x-input-error :messages="$errors->get('receiptFooterText')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="receiptPaperWidth" :value="__('settings.receipt_paper_width')" />
                    <select id="receiptPaperWidth" wire:model="receiptPaperWidth" class="mt-1 min-h-[44px] w-full rounded-xl border border-black/10 bg-white/70 px-4 py-2 text-base font-medium text-[var(--text-primary)]">
                        <option value="58mm">58mm</option>
                        <option value="80mm">80mm</option>
                    </select>
                    <x-input-error :messages="$errors->get('receiptPaperWidth')" class="mt-1" />
                </div>

                <label class="flex min-h-[44px] items-center gap-2 text-base font-medium text-[var(--text-primary)]">
                    <input type="checkbox" wire:model="receiptShowLogo" class="h-5 w-5 rounded border-black/20 text-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]">
                    {{ __('settings.receipt_show_logo') }}
                </label>

                <div class="flex justify-end">
                    <x-primary-button>{{ __('settings.save') }}</x-primary-button>
                </div>
            </form>
        </div>

        {{-- Theme --}}
        <div x-show="tab === 'theme'" x-cloak class="glass-panel p-4 sm:p-6">
            <h3 class="mb-2 text-lg font-bold text-[var(--text-primary)]">{{ __('settings.theme_presets') }}</h3>
            <p class="mb-4 text-sm text-[var(--text-secondary)]">{{ __('settings.theme_presets_hint') }}</p>

            <div class="mb-6 grid grid-cols-2 gap-3 sm:grid-cols-4">
                @foreach ($presets as $index => $preset)
                    <button
                        type="button"
                        wire:click="applyPreset({{ $index }})"
                        class="overflow-hidden rounded-xl border border-black/10 text-start shadow-sm transition hover:opacity-90"
                    >
                        <div class="h-12" style="background: linear-gradient(90deg, {{ $preset['navbar_primary_color'] }}, {{ $preset['sidebar_gradient_from'] }}, {{ $preset['sidebar_gradient_to'] }});"></div>
                        <div class="bg-white/70 px-3 py-2 text-sm font-bold text-[var(--text-primary)]">{{ $preset['name'] }}</div>
                    </button>
                @endforeach
            </div>

            <form wire:submit="saveTheme" class="max-w-2xl space-y-6">
                <div>
                    <h4 class="mb-3 text-base font-bold text-[var(--text-primary)]">{{ __('settings.navbar_colors') }}</h4>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="navbarPrimaryColor" :value="__('settings.navbar_primary_color')" />
                            <div class="mt-1 flex items-center gap-2">
                                <input type="color" wire:model.live="navbarPrimaryColor" class="h-11 w-14 cursor-pointer rounded-lg border border-black/10 bg-white/70">
                                <x-text-input type="text" wire:model="navbarPrimaryColor" class="flex-1 font-mono text-sm" />
                            </div>
                            <x-input-error :messages="$errors->get('navbarPrimaryColor')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="navbarAccentColor" :value="__('settings.navbar_accent_color')" />
                            <div class="mt-1 flex items-center gap-2">
                                <input type="color" wire:model.live="navbarAccentColor" class="h-11 w-14 cursor-pointer rounded-lg border border-black/10 bg-white/70">
                                <x-text-input type="text" wire:model="navbarAccentColor" class="flex-1 font-mono text-sm" />
                            </div>
                            <x-input-error :messages="$errors->get('navbarAccentColor')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="mb-3 text-base font-bold text-[var(--text-primary)]">{{ __('settings.sidebar_colors') }}</h4>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="sidebarPrimaryColor" :value="__('settings.sidebar_primary_color')" />
                            <div class="mt-1 flex items-center gap-2">
                                <input type="color" wire:model.live="sidebarPrimaryColor" class="h-11 w-14 cursor-pointer rounded-lg border border-black/10 bg-white/70">
                                <x-text-input type="text" wire:model="sidebarPrimaryColor" class="flex-1 font-mono text-sm" />
                            </div>
                            <x-input-error :messages="$errors->get('sidebarPrimaryColor')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="sidebarAccentColor" :value="__('settings.sidebar_accent_color')" />
                            <div class="mt-1 flex items-center gap-2">
                                <input type="color" wire:model.live="sidebarAccentColor" class="h-11 w-14 cursor-pointer rounded-lg border border-black/10 bg-white/70">
                                <x-text-input type="text" wire:model="sidebarAccentColor" class="flex-1 font-mono text-sm" />
                            </div>
                            <x-input-error :messages="$errors->get('sidebarAccentColor')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="mb-3 text-base font-bold text-[var(--text-primary)]">{{ __('settings.sidebar_gradient') }}</h4>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="sidebarGradientFrom" :value="__('settings.sidebar_gradient_from')" />
                            <div class="mt-1 flex items-center gap-2">
                                <input type="color" wire:model.live="sidebarGradientFrom" class="h-11 w-14 cursor-pointer rounded-lg border border-black/10 bg-white/70">
                                <x-text-input type="text" wire:model="sidebarGradientFrom" class="flex-1 font-mono text-sm" />
                            </div>
                            <x-input-error :messages="$errors->get('sidebarGradientFrom')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="sidebarGradientTo" :value="__('settings.sidebar_gradient_to')" />
                            <div class="mt-1 flex items-center gap-2">
                                <input type="color" wire:model.live="sidebarGradientTo" class="h-11 w-14 cursor-pointer rounded-lg border border-black/10 bg-white/70">
                                <x-text-input type="text" wire:model="sidebarGradientTo" class="flex-1 font-mono text-sm" />
                            </div>
                            <x-input-error :messages="$errors->get('sidebarGradientTo')" class="mt-1" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label :value="__('settings.preview')" />
                        <div
                            class="mt-1 h-16 w-full rounded-xl border border-black/10"
                            style="background: linear-gradient(180deg, {{ $sidebarGradientFrom }}, {{ $sidebarGradientTo }});"
                        ></div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-primary-button>{{ __('settings.save') }}</x-primary-button>
                </div>
            </form>
        </div>

        {{-- Bank Accounts --}}
        <div x-show="tab === 'banks'" x-cloak>
            <livewire:admin.bank-account-manager />
        </div>

        {{-- Banners --}}
        <div x-show="tab === 'banners'" x-cloak>
            <livewire:admin.banner-manager />
        </div>

        {{-- Developer Tools --}}
        @can('developer-tools.manage')
            <div x-show="tab === 'developer'" x-cloak>
                <livewire:admin.developer-tools />
            </div>
        @endcan
    </div>
</div>
