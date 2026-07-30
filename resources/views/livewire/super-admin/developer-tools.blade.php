<div>
    <x-page-header>
        <h2 class="text-2xl font-bold text-[var(--text-primary)]">{{ __('super_admin.tab_developer') }}</h2>
    </x-page-header>

    <div class="space-y-4">
        <div class="rounded-xl border border-[var(--color-warning)]/30 bg-[var(--color-warning)]/10 px-4 py-3 text-sm font-semibold text-[var(--color-warning)]">
            {{ __('super_admin.dev_warning') }}
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="glass-panel p-4 sm:p-5">
                <h4 class="text-base font-bold text-[var(--text-primary)]">{{ __('super_admin.dev_migrate') }}</h4>
                <p class="mt-1 font-mono text-xs text-[var(--text-secondary)]">{{ __('super_admin.dev_migrate_hint') }}</p>
                <button
                    type="button"
                    wire:click="runMigrate"
                    wire:loading.attr="disabled"
                    wire:target="runMigrate"
                    onclick="return confirm('{{ __('super_admin.dev_confirm_migrate') }}')"
                    class="mt-3 inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-4 py-2 text-sm font-bold text-white shadow-sm hover:opacity-90 disabled:opacity-50"
                >
                    <span wire:loading.remove wire:target="runMigrate">{{ __('super_admin.dev_run') }}</span>
                    <span wire:loading wire:target="runMigrate">{{ __('super_admin.dev_running') }}</span>
                </button>
            </div>

            <div class="glass-panel p-4 sm:p-5">
                <h4 class="text-base font-bold text-[var(--text-primary)]">{{ __('super_admin.dev_optimize') }}</h4>
                <p class="mt-1 font-mono text-xs text-[var(--text-secondary)]">{{ __('super_admin.dev_optimize_hint') }}</p>
                <button
                    type="button"
                    wire:click="runOptimize"
                    wire:loading.attr="disabled"
                    wire:target="runOptimize"
                    class="mt-3 inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-4 py-2 text-sm font-bold text-white shadow-sm hover:opacity-90 disabled:opacity-50"
                >
                    <span wire:loading.remove wire:target="runOptimize">{{ __('super_admin.dev_run') }}</span>
                    <span wire:loading wire:target="runOptimize">{{ __('super_admin.dev_running') }}</span>
                </button>
            </div>

            <div class="glass-panel p-4 sm:p-5">
                <h4 class="text-base font-bold text-[var(--text-primary)]">{{ __('super_admin.dev_config_cache') }}</h4>
                <p class="mt-1 font-mono text-xs text-[var(--text-secondary)]">{{ __('super_admin.dev_config_cache_hint') }}</p>
                <button
                    type="button"
                    wire:click="runConfigCache"
                    wire:loading.attr="disabled"
                    wire:target="runConfigCache"
                    class="mt-3 inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-4 py-2 text-sm font-bold text-white shadow-sm hover:opacity-90 disabled:opacity-50"
                >
                    <span wire:loading.remove wire:target="runConfigCache">{{ __('super_admin.dev_run') }}</span>
                    <span wire:loading wire:target="runConfigCache">{{ __('super_admin.dev_running') }}</span>
                </button>
            </div>

            <div class="glass-panel p-4 sm:p-5">
                <h4 class="text-base font-bold text-[var(--text-primary)]">{{ __('super_admin.dev_git_pull') }}</h4>
                <p class="mt-1 font-mono text-xs text-[var(--text-secondary)]">{{ __('super_admin.dev_git_pull_hint') }}</p>
                <button
                    type="button"
                    wire:click="runGitPull"
                    wire:loading.attr="disabled"
                    wire:target="runGitPull"
                    onclick="return confirm('{{ __('super_admin.dev_confirm_git_pull') }}')"
                    class="mt-3 inline-flex min-h-[44px] items-center rounded-xl bg-[var(--navbar-primary-color)] px-4 py-2 text-sm font-bold text-white shadow-sm hover:opacity-90 disabled:opacity-50"
                >
                    <span wire:loading.remove wire:target="runGitPull">{{ __('super_admin.dev_run') }}</span>
                    <span wire:loading wire:target="runGitPull">{{ __('super_admin.dev_running') }}</span>
                </button>
            </div>
        </div>

        @if ($hasRun)
            <div class="glass-panel p-4 sm:p-5">
                <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                    <h4 class="text-base font-bold text-[var(--text-primary)]">{{ $lastLabel }} — {{ __('super_admin.dev_output') }}</h4>
                    <span class="rounded-full px-3 py-1 text-xs font-bold {{ $success ? 'bg-[var(--color-success)]/10 text-[var(--color-success)]' : 'bg-[var(--color-danger)]/10 text-[var(--color-danger)]' }}">
                        {{ $success ? __('super_admin.dev_success') : __('super_admin.dev_failed') }}
                    </span>
                </div>
                <pre class="max-h-96 overflow-auto whitespace-pre-wrap break-words rounded-xl bg-black/90 p-4 font-mono text-xs text-white">{{ $output }}</pre>
            </div>
        @endif
    </div>
</div>
