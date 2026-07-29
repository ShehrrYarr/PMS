<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Livewire\Component;
use Throwable;

/**
 * Admin-only server maintenance actions, each a fixed, hardcoded command —
 * none of these ever take user input, so there is no injection surface.
 * Every action re-checks 'developer-tools.manage' itself (not just the
 * parent Settings page) as defense in depth, and is logged with who ran it.
 */
class DeveloperTools extends Component
{
    public string $lastLabel = '';

    public string $output = '';

    public bool $success = false;

    public bool $hasRun = false;

    public function mount(): void
    {
        $this->authorize('developer-tools.manage');
    }

    public function runMigrate(): void
    {
        $this->authorize('developer-tools.manage');

        try {
            $exitCode = Artisan::call('migrate', ['--force' => true]);
            $this->record(__('settings.dev_migrate'), $exitCode === 0, Artisan::output());
        } catch (Throwable $e) {
            $this->record(__('settings.dev_migrate'), false, $e->getMessage());
        }
    }

    public function runOptimize(): void
    {
        $this->authorize('developer-tools.manage');

        try {
            $exitCode = Artisan::call('optimize');
            $this->record(__('settings.dev_optimize'), $exitCode === 0, Artisan::output());
        } catch (Throwable $e) {
            $this->record(__('settings.dev_optimize'), false, $e->getMessage());
        }
    }

    public function runConfigCache(): void
    {
        $this->authorize('developer-tools.manage');

        try {
            $exitCode = Artisan::call('config:cache');
            $this->record(__('settings.dev_config_cache'), $exitCode === 0, Artisan::output());
        } catch (Throwable $e) {
            $this->record(__('settings.dev_config_cache'), false, $e->getMessage());
        }
    }

    public function runGitPull(): void
    {
        $this->authorize('developer-tools.manage');

        if (! File::isDirectory(base_path('.git'))) {
            $this->record(__('settings.dev_git_pull'), false, __('settings.dev_git_not_a_repo'));

            return;
        }

        $result = Process::path(base_path())->timeout(60)->run(['git', 'pull']);

        $combined = trim($result->output()."\n".$result->errorOutput());
        $this->record(__('settings.dev_git_pull'), $result->successful(), $combined);
    }

    private function record(string $label, bool $success, string $output): void
    {
        $this->lastLabel = $label;
        $this->success = $success;
        $this->output = trim($output) !== '' ? trim($output) : __('settings.dev_no_output');
        $this->hasRun = true;

        Log::info('Developer tool executed', [
            'command' => $label,
            'success' => $success,
            'user' => auth()->user()?->email,
        ]);
    }

    public function render(): View
    {
        return view('livewire.admin.developer-tools');
    }
}
