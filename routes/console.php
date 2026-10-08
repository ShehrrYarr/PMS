<?php

use App\Console\Commands\CheckExpiringBatches;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(CheckExpiringBatches::class)->daily();

// The public demo shop is intentionally NOT reset on a schedule any more — it
// keeps its data. To restore it on purpose: php artisan app:seed-demo-shop
