<?php

use Illuminate\Support\Facades\Schedule;

use App\Models\SeatLock;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::call(function () {
    SeatLock::where('locked_until', '<', now())
            ->whereNull('booking_id')
            ->delete();
})->everyMinute();

Schedule::command('bookings:expire-pending')->everyMinute();