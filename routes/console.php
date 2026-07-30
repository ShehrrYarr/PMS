<?php

use App\Console\Commands\CheckExpiringBatches;
use App\Console\Commands\ResetDemoShop;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(CheckExpiringBatches::class)->daily();
Schedule::command(ResetDemoShop::class)->daily();
