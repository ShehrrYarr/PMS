<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Events\BatchExpiringSoon;
use App\Services\ExpiryAlertService;
use Illuminate\Console\Command;

class CheckExpiringBatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expiring-batches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flag batches within 30 days of expiry (see prd.md §2.3)';

    public function handle(ExpiryAlertService $expiryAlertService): int
    {
        $batches = $expiryAlertService->expiringWithin(30);

        foreach ($batches as $batch) {
            BatchExpiringSoon::dispatch($batch);
        }

        $this->info("Found {$batches->count()} batch(es) within 30 days of expiry.");

        return self::SUCCESS;
    }
}
