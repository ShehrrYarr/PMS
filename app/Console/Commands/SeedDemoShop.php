<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Shop;
use Database\Seeders\DemoShopSeeder;
use Illuminate\Console\Command;

/**
 * Loads (or restores) the public "See Demo" shop's full demo dataset.
 *
 * Deliberately manual and never scheduled: the demo keeps whatever visitors
 * do with it. This is the tool for putting it back to a clean, complete
 * state on purpose.
 */
class SeedDemoShop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-demo-shop
                            {--days=90 : Days of trading history to generate, ending today}
                            {--force : Skip the confirmation prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replace the public demo shop\'s business data with the full demo dataset (products, stock, sales, purchases, customers, vendors, expenses)';

    public function handle(DemoShopSeeder $seeder): int
    {
        $shop = Shop::query()->where('is_demo', true)->first();

        if ($shop === null) {
            $this->error('No shop is flagged as the demo (shops.is_demo) — nothing to seed.');

            return self::FAILURE;
        }

        $days = (int) $this->option('days');

        if ($days < 1) {
            $this->error('--days must be at least 1.');

            return self::FAILURE;
        }

        if (! $this->option('force') && ! $this->confirm("This deletes ALL business data in \"{$shop->name}\" and loads the demo dataset. Continue?")) {
            $this->info('Cancelled — nothing changed.');

            return self::SUCCESS;
        }

        $this->info("Seeding \"{$shop->name}\" with {$days} days of history…");

        $seeder->days = $days;
        $summary = $seeder->setCommand($this)->seed($shop);

        $this->table(['What', 'Rows'], collect($summary)->map(fn (int $rows, string $what) => [$what, $rows])->values()->all());
        $this->info('Demo shop seeded.');

        return self::SUCCESS;
    }
}
