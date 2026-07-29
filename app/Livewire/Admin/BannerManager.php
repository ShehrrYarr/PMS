<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Banner;
use App\Models\ThemeSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class BannerManager extends Component
{
    use WithFileUploads;

    #[Validate('nullable|image|max:2048')]
    public ?TemporaryUploadedFile $banner = null;

    #[Validate('required|integer|min:2|max:60')]
    public int $intervalSeconds = 5;

    public function mount(): void
    {
        $this->authorize('branding.manage');

        $this->intervalSeconds = ThemeSetting::current()->banner_interval_seconds;
    }

    public function addBanner(): void
    {
        $this->authorize('branding.manage');

        $this->validate(['banner' => 'required|image|max:2048']);

        Banner::query()->create([
            'image_path' => $this->banner->store('banners', 'public'),
        ]);

        $this->banner = null;
    }

    public function delete(int $bannerId): void
    {
        $this->authorize('branding.manage');

        $banner = Banner::query()->findOrFail($bannerId);

        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();
    }

    public function saveInterval(): void
    {
        $this->authorize('branding.manage');

        $this->validate(['intervalSeconds' => 'required|integer|min:2|max:60']);

        ThemeSetting::current()->update(['banner_interval_seconds' => $this->intervalSeconds]);

        session()->flash('success', __('settings.saved'));
    }

    public function render(): View
    {
        return view('livewire.admin.banner-manager', [
            'banners' => Banner::query()->orderBy('id')->get(),
        ]);
    }
}
