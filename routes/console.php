<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;

Schedule::call(function () {
    DB::table('donations')->where('Status', '=', 'pending')->where('created_at', '<=', now()->subHours(2))->delete();
})->everyMinute();