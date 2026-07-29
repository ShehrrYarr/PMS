<?php

declare(strict_types=1);

namespace App\Livewire\Shared;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    private const SUPPORTED_LOCALES = ['en', 'ur'];

    /**
     * Persist the chosen locale in the session and reload so every string
     * (including lang files resolved server-side) reflects it immediately.
     */
    public function switchTo(string $locale): void
    {
        if (! in_array($locale, self::SUPPORTED_LOCALES, true)) {
            return;
        }

        session(['locale' => $locale]);

        $this->redirect(url()->previous(), navigate: false);
    }

    public function render(): View
    {
        return view('livewire.shared.language-switcher', [
            'currentLocale' => app()->getLocale(),
        ]);
    }
}
