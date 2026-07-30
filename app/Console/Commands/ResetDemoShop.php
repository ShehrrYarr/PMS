<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\DemoShopResetService;
use Illuminate\Console\Command;

class ResetDemoShop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-demo-shop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wipe and reseed the public "See Demo" shop\'s business data (no-op if no shop is flagged is_demo)';

    public function handle(DemoShopResetService $demoShopResetService): int
    {
        $demoShopResetService->reset();

        $this->info('Demo shop reset.');

        return self::SUCCESS;
    }
}
