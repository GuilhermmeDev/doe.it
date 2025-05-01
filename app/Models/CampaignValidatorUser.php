<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CampaignValidatorUser extends Model
{
    use HasFactory;

    protected $table = 'campaign_validators_users';

    protected $fillable = [
        'campaign_id',
        'invited_by',
        'invite_email',
        'user_id',
        'token',
        'status',
        'accepted_at',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->token)) {
                $model->token = Str::random(40);
            }
        });
    }

    /**
     * Relação com a campanha.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    /**
     * Relação com o usuário que convidou.
     */
    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    /**
     * Relação com o usuário convidado.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
