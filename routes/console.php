<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\MonitorCommand;
use App\Console\Commands\BackupCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
Schedule::command(MonitorCommand::class)->everyMinute();
Schedule::command(BackupCommand::class)->daily();
