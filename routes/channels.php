<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('donation.{id}', function () { return true;});
Broadcast::channel('campaign.{id}', function () { return true;});
