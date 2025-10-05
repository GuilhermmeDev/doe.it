<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Malico\LaravelNanoid\HasNanoids;

class Donation extends Model
{
    use HasFactory, HasNanoids;

    protected $casts = [
        'Confirmed_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }
}
