<?php

declare(strict_types=1);

namespace App\Livewire\SuperAdmin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

/**
 * Server maintenance actions (migrate/optimize/config:cache/git pull) affect
 * the whole platform, not a single shop — so this lives behind the
 * auth:super_admin route middleware (see routes/super_admin.php) rather than
 * a per-shop permission. That guard is the only authorization boundary
 * needed here, same as the rest of the Super Admin panel.
 */
#[Layout('layouts.super-admin')]
class DeveloperTools extends Component
{
    public string $lastLabel = '';

    public string $output = '';

    public bool $success = false;

    public bool $hasRun = false;

    public function runMigrate(): void
    {
        try {
            $exitCode = Artisan::call('migrate', ['--force' => true]);
            $this->record(__('super_admin.dev_migrate'), $exitCode === 0, Artisan::output());
        } catch (Throwable $e) {
            $this->record(__('super_admin.dev_migrate'), false, $e->getMessage());
        }
    }

    public function runOptimize(): void
    {
        try {
            $exitCode = Artisan::call('optimize');
            $this->record(__('super_admin.dev_optimize'), $exitCode === 0, Artisan::output());
        } catch (Throwable $e) {
            $this->record(__('super_admin.dev_optimize'), false, $e->getMessage());
        }
    }

    public function runConfigCache(): void
    {
        try {
            $exitCode = Artisan::call('config:cache');
            $this->record(__('super_admin.dev_config_cache'), $exitCode === 0, Artisan::output());
        } catch (Throwable $e) {
            $this->record(__('super_admin.dev_config_cache'), false, $e->getMessage());
        }
    }

    public function runGitPull(): void
    {
        if (! File::isDirectory(base_path('.git'))) {
            $this->record(__('super_admin.dev_git_pull'), false, __('super_admin.dev_git_not_a_repo'));

            return;
        }

        $result = Process::path(base_path())->timeout(60)->run(['git', 'pull']);

        $combined = trim($result->output()."\n".$result->errorOutput());
        $this->record(__('super_admin.dev_git_pull'), $result->successful(), $combined);
    }

    private function record(string $label, bool $success, string $output): void
    {
        $this->lastLabel = $label;
        $this->success = $success;
        $this->output = trim($output) !== '' ? trim($output) : __('super_admin.dev_no_output');
        $this->hasRun = true;

        Log::info('Developer tool executed', [
            'command' => $label,
            'success' => $success,
            'super_admin' => auth('super_admin')->user()?->email,
        ]);
    }

    public function render(): View
    {
        return view('livewire.super-admin.developer-tools');
    }
}
