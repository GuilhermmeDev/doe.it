<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('donation.{donationId}', function () { return true;});
