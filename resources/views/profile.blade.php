<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">
            {{ __('nav.profile') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="glass-panel p-4 sm:p-8">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        <div class="glass-panel p-4 sm:p-8">
            <div class="max-w-xl">
                <livewire:profile.update-password-form />
            </div>
        </div>

        <div class="glass-panel p-4 sm:p-8">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-app-layout>
