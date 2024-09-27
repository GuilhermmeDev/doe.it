<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('testDonation', function () { return true;});
Broadcast::channel('testMeta', function () { return true;});
