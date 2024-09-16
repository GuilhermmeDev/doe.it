<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Malico\LaravelNanoid\HasNanoids;

class Donation extends Model
{
    use HasFactory, HasNanoids;

    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }
}
