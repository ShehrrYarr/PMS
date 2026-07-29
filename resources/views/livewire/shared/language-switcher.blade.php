<div class="relative inline-flex items-center gap-1 rounded-full bg-white/40 p-1 text-sm font-semibold" role="group" aria-label="{{ __('nav.language') }}">
    <button
        type="button"
        wire:click="switchTo('en')"
        class="min-h-[44px] min-w-[44px] rounded-full px-2 py-2 transition sm:px-3 {{ $currentLocale === 'en' ? 'bg-[var(--navbar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-white/60' }}"
    >
        {{ __('nav.english') }}
    </button>
    <button
        type="button"
        wire:click="switchTo('ur')"
        class="min-h-[44px] min-w-[44px] rounded-full px-2 py-2 transition sm:px-3 {{ $currentLocale === 'ur' ? 'bg-[var(--navbar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-white/60' }}"
    >
        {{ __('nav.urdu') }}
    </button>
</div>
