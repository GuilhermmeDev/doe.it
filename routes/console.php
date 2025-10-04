<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    DB::table('donations')->where('Status', '=', 'pending')->where('created_at', '<=', now()->subHours(2))->delete();
})->everyMinute();
