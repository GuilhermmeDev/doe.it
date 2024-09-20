<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('testChannel', function () { return true;});
