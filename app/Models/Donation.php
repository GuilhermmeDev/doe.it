<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Malico\LaravelNanoid\HasNanoids;

class Donation extends Model
{
    use HasFactory, HasNanoids;

    protected $fillable = [
        'id',
        'campaign_id',
        'user_id',
        'Quantity',
        'Description',
        'Confirmed_at',
        'Status',
    ];

    protected $casts = [
        'Confirmed_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id')->withTrashed();
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
