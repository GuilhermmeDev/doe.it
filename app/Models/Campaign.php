<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Malico\LaravelNanoid\HasNanoids;

class Campaign extends Model
{
    use HasFactory, HasNanoids;

    public function address() {
        return $this->belongsTo(Address::class);
    }
}
