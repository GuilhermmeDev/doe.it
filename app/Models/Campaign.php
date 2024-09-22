<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Malico\LaravelNanoid\HasNanoids;

class Campaign extends Model
{
    use HasFactory, HasNanoids;
    
    protected $casts = [
        'meta' => 'array',
    ];
    
    public function address() {
        return $this->belongsTo(Address::class);
    }

    public function donations() {
        return $this->hasMany(Donation::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
