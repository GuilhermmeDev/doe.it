<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Malico\LaravelNanoid\HasNanoids;

class Campaign extends Model
{
    use HasFactory, HasNanoids, SoftDeletes;

    protected $fillable = [
        'id',
        'Title',
        'Description',
        'meta',
        'user_id',
        'address_id',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validatorUsers()
    {
        return $this->hasMany(CampaignValidatorUser::class);
    }

    public function allValidatorsIncludingOwner()
    {
        $acceptedValidatorUserIds = $this->validatorUsers()
            ->where('status', 'accepted')
            ->pluck('user_id');

        $validators = User::whereIn('id', $acceptedValidatorUserIds)->get();

        return $validators->prepend($this->user);
    }
}
