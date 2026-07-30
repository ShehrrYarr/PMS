<?php

use App\Livewire\Forms\SuperAdminLoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.super-admin')] class extends Component
{
    public SuperAdminLoginForm $form;

    /**
     * Handle an incoming super-admin authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('control-panel.index'), navigate: true);
    }
}; ?>

<div class="mx-auto max-w-md">
    <div class="glass-panel-strong px-6 py-8">
        <h1 class="mb-6 text-xl font-bold text-[var(--text-primary)]">{{ __('super_admin.login_title') }}</h1>

        <form wire:submit="login" class="space-y-4">
            <div>
                <x-input-label for="email" :value="__('super_admin.email')" />
                <x-text-input wire:model="form.email" id="email" class="mt-1 w-full" type="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="password" :value="__('super_admin.password')" />
                <x-text-input wire:model="form.password" id="password" class="mt-1 w-full" type="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
            </div>

            <label class="flex min-h-[44px] items-center gap-2 text-base font-medium text-[var(--text-primary)]">
                <input wire:model="form.remember" type="checkbox" class="h-5 w-5 rounded border-black/20 text-[var(--navbar-primary-color)] focus:ring-[var(--navbar-primary-color)]">
                {{ __('super_admin.remember_me') }}
            </label>

            <x-primary-button class="w-full justify-center">
                {{ __('super_admin.log_in') }}
            </x-primary-button>
        </form>
    </div>
</div>
