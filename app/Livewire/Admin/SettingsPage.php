<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\ReceiptSetting;
use App\Models\ThemeSetting;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
class SettingsPage extends Component
{
    /**
     * Four curated palettes an admin can apply with one click, then still
     * fine-tune — each sets both the solid navbar colors and the sidebar's
     * two-stop gradient together for a cohesive look.
     *
     * @var list<array{name: string, navbar_primary_color: string, navbar_accent_color: string, sidebar_primary_color: string, sidebar_accent_color: string, sidebar_gradient_from: string, sidebar_gradient_to: string}>
     */
    public const PRESET_THEMES = [
        [
            'name' => 'Forest',
            'navbar_primary_color' => '#2f6f4f',
            'navbar_accent_color' => '#e8f5ee',
            'sidebar_primary_color' => '#1f4d38',
            'sidebar_accent_color' => '#eaf6f0',
            'sidebar_gradient_from' => '#1f4d38',
            'sidebar_gradient_to' => '#0d2b1f',
        ],
        [
            'name' => 'Ocean',
            'navbar_primary_color' => '#1e5f8c',
            'navbar_accent_color' => '#e6f2fa',
            'sidebar_primary_color' => '#123a56',
            'sidebar_accent_color' => '#e3f0f9',
            'sidebar_gradient_from' => '#123a56',
            'sidebar_gradient_to' => '#0a2438',
        ],
        [
            'name' => 'Sunset',
            'navbar_primary_color' => '#c1552c',
            'navbar_accent_color' => '#fbeee7',
            'sidebar_primary_color' => '#7a3418',
            'sidebar_accent_color' => '#fbeee7',
            'sidebar_gradient_from' => '#7a3418',
            'sidebar_gradient_to' => '#4a1f0d',
        ],
        [
            'name' => 'Royal',
            'navbar_primary_color' => '#5b3a8e',
            'navbar_accent_color' => '#efe9f8',
            'sidebar_primary_color' => '#3a2459',
            'sidebar_accent_color' => '#efe9f8',
            'sidebar_gradient_from' => '#3a2459',
            'sidebar_gradient_to' => '#1f1330',
        ],
    ];

    #[Validate('nullable|string|max:255')]
    public string $shopName = '';

    #[Validate('nullable|string|max:1000')]
    public string $receiptHeaderText = '';

    #[Validate('nullable|string|max:1000')]
    public string $receiptFooterText = '';

    #[Validate('boolean')]
    public bool $receiptShowLogo = true;

    #[Validate('required|in:58mm,80mm')]
    public string $receiptPaperWidth = '80mm';

    #[Validate('required|regex:/^#[0-9a-fA-F]{6}$/')]
    public string $navbarPrimaryColor = '#2f6f4f';

    #[Validate('required|regex:/^#[0-9a-fA-F]{6}$/')]
    public string $navbarAccentColor = '#e8f5ee';

    #[Validate('required|regex:/^#[0-9a-fA-F]{6}$/')]
    public string $sidebarPrimaryColor = '#1f4d38';

    #[Validate('required|regex:/^#[0-9a-fA-F]{6}$/')]
    public string $sidebarAccentColor = '#eaf6f0';

    #[Validate('required|regex:/^#[0-9a-fA-F]{6}$/')]
    public string $sidebarGradientFrom = '#1f4d38';

    #[Validate('required|regex:/^#[0-9a-fA-F]{6}$/')]
    public string $sidebarGradientTo = '#1f4d38';

    public function mount(): void
    {
        $this->authorize('branding.manage');

        $theme = ThemeSetting::current();
        $receipt = ReceiptSetting::current();

        $this->shopName = (string) $theme->shop_name;
        $this->navbarPrimaryColor = $theme->navbar_primary_color;
        $this->navbarAccentColor = $theme->navbar_accent_color;
        $this->sidebarPrimaryColor = $theme->sidebar_primary_color;
        $this->sidebarAccentColor = $theme->sidebar_accent_color;
        $this->sidebarGradientFrom = $theme->sidebar_gradient_from;
        $this->sidebarGradientTo = $theme->sidebar_gradient_to;

        $this->receiptHeaderText = (string) $receipt->header_text;
        $this->receiptFooterText = (string) $receipt->footer_text;
        $this->receiptShowLogo = $receipt->show_logo;
        $this->receiptPaperWidth = $receipt->paper_width;
    }

    public function saveGeneral(): void
    {
        $this->authorize('branding.manage');

        $this->validate([
            'shopName' => 'nullable|string|max:255',
        ]);

        ThemeSetting::current()->update([
            'shop_name' => $this->shopName !== '' ? $this->shopName : null,
        ]);

        session()->flash('success', __('settings.saved'));
    }

    public function saveReceipt(): void
    {
        $this->authorize('receipt-settings.manage');

        $this->validate([
            'receiptHeaderText' => 'nullable|string|max:1000',
            'receiptFooterText' => 'nullable|string|max:1000',
            'receiptShowLogo' => 'boolean',
            'receiptPaperWidth' => 'required|in:58mm,80mm',
        ]);

        ReceiptSetting::current()->update([
            'header_text' => $this->receiptHeaderText !== '' ? $this->receiptHeaderText : null,
            'footer_text' => $this->receiptFooterText !== '' ? $this->receiptFooterText : null,
            'show_logo' => $this->receiptShowLogo,
            'paper_width' => $this->receiptPaperWidth,
        ]);

        session()->flash('success', __('settings.saved'));
    }

    public function applyPreset(int $index): void
    {
        $this->authorize('branding.manage');

        $preset = self::PRESET_THEMES[$index] ?? null;

        if ($preset === null) {
            return;
        }

        $this->navbarPrimaryColor = $preset['navbar_primary_color'];
        $this->navbarAccentColor = $preset['navbar_accent_color'];
        $this->sidebarPrimaryColor = $preset['sidebar_primary_color'];
        $this->sidebarAccentColor = $preset['sidebar_accent_color'];
        $this->sidebarGradientFrom = $preset['sidebar_gradient_from'];
        $this->sidebarGradientTo = $preset['sidebar_gradient_to'];
    }

    public function saveTheme(): void
    {
        $this->authorize('branding.manage');

        $this->validate([
            'navbarPrimaryColor' => 'required|regex:/^#[0-9a-fA-F]{6}$/',
            'navbarAccentColor' => 'required|regex:/^#[0-9a-fA-F]{6}$/',
            'sidebarPrimaryColor' => 'required|regex:/^#[0-9a-fA-F]{6}$/',
            'sidebarAccentColor' => 'required|regex:/^#[0-9a-fA-F]{6}$/',
            'sidebarGradientFrom' => 'required|regex:/^#[0-9a-fA-F]{6}$/',
            'sidebarGradientTo' => 'required|regex:/^#[0-9a-fA-F]{6}$/',
        ]);

        ThemeSetting::current()->update([
            'navbar_primary_color' => $this->navbarPrimaryColor,
            'navbar_accent_color' => $this->navbarAccentColor,
            'sidebar_primary_color' => $this->sidebarPrimaryColor,
            'sidebar_accent_color' => $this->sidebarAccentColor,
            'sidebar_gradient_from' => $this->sidebarGradientFrom,
            'sidebar_gradient_to' => $this->sidebarGradientTo,
        ]);

        session()->flash('success', __('settings.saved'));
    }

    public function render(): View
    {
        return view('livewire.admin.settings-page', [
            'presets' => self::PRESET_THEMES,
        ]);
    }
}
