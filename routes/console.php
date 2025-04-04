<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

if (config('app.debug')) {
    return;
}
Schedule::command('wallets:update-balances')
    ->everyMinute()
    ->withoutOverlapping();
