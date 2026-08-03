<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\ReceiptSetting;
use App\Models\ThemeSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class SettingsPage extends Component
{
    use WithFileUploads;

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

    /**
     * A free +/- stepper, not named presets — clamped to a range that keeps
     * text from becoming illegibly small or breaking layouts at the top end.
     */
    private const MIN_FONT_SIZE_PERCENT = 80;

    private const MAX_FONT_SIZE_PERCENT = 150;

    private const FONT_SIZE_STEP = 10;

    // Keep in sync with MIN/MAX_FONT_SIZE_PERCENT above — Livewire's
    // #[Validate] attribute needs a literal string, not a class constant.
    #[Validate('required|integer|min:80|max:150')]
    public int $fontSizePercent = 100;

    /**
     * Deliberately excludes svg: the generic `image` rule accepts
     * image/svg+xml, and an SVG can embed a <script> tag that executes when
     * its stored URL is opened directly (not just used inside an <img> tag)
     * — a stored-XSS vector on the app's own origin.
     */
    private const ALLOWED_LOGO_EXTENSIONS = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];

    #[Validate('nullable|mimes:jpg,jpeg,png,webp,gif|max:1024')]
    public ?TemporaryUploadedFile $logo = null;

    public ?string $logoPath = null;

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
        $this->fontSizePercent = $theme->font_size_percent;

        $this->receiptHeaderText = (string) $receipt->header_text;
        $this->receiptFooterText = (string) $receipt->footer_text;
        $this->receiptShowLogo = $receipt->show_logo;
        $this->receiptPaperWidth = $receipt->paper_width;

        $this->logoPath = $theme->logo_path;
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
        $this->dispatch('branding-updated');
    }

    public function saveLogo(): void
    {
        $this->authorize('branding.manage');

        $this->validate([
            'logo' => 'required|mimes:jpg,jpeg,png,webp,gif|max:1024',
        ]);

        $theme = ThemeSetting::current();

        if ($theme->logo_path !== null) {
            Storage::disk('public')->delete($theme->logo_path);
        }

        // The stored extension is derived from the validated mime type, not
        // the client-supplied original filename — an attacker can't smuggle
        // an arbitrary extension (e.g. .phtml) onto a stored file just by
        // naming their upload that way.
        $extension = self::ALLOWED_LOGO_EXTENSIONS[$this->logo->getMimeType()] ?? 'jpg';
        $path = $this->logo->storeAs('branding', 'shop-logo-'.now()->timestamp.'.'.$extension, 'public');

        $theme->update(['logo_path' => $path]);

        $this->logoPath = $path;
        $this->logo = null;

        session()->flash('success', __('settings.saved'));
        $this->dispatch('branding-updated');
    }

    public function removeLogo(): void
    {
        $this->authorize('branding.manage');

        $theme = ThemeSetting::current();

        if ($theme->logo_path !== null) {
            Storage::disk('public')->delete($theme->logo_path);
        }

        $theme->update(['logo_path' => null]);

        $this->logoPath = null;

        $this->dispatch('branding-updated');
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
            'fontSizePercent' => 'required|integer|min:'.self::MIN_FONT_SIZE_PERCENT.'|max:'.self::MAX_FONT_SIZE_PERCENT,
        ]);

        ThemeSetting::current()->update([
            'navbar_primary_color' => $this->navbarPrimaryColor,
            'navbar_accent_color' => $this->navbarAccentColor,
            'sidebar_primary_color' => $this->sidebarPrimaryColor,
            'sidebar_accent_color' => $this->sidebarAccentColor,
            'sidebar_gradient_from' => $this->sidebarGradientFrom,
            'sidebar_gradient_to' => $this->sidebarGradientTo,
            'font_size_percent' => $this->fontSizePercent,
        ]);

        session()->flash('success', __('settings.saved'));
        $this->dispatch('branding-updated');
    }

    public function increaseFontSize(): void
    {
        $this->authorize('branding.manage');

        $this->fontSizePercent = min(self::MAX_FONT_SIZE_PERCENT, $this->fontSizePercent + self::FONT_SIZE_STEP);
    }

    public function decreaseFontSize(): void
    {
        $this->authorize('branding.manage');

        $this->fontSizePercent = max(self::MIN_FONT_SIZE_PERCENT, $this->fontSizePercent - self::FONT_SIZE_STEP);
    }

    public function render(): View
    {
        return view('livewire.admin.settings-page', [
            'presets' => self::PRESET_THEMES,
        ]);
    }
}
