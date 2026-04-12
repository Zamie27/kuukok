<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashback extends Model
{
    protected $fillable = [
        'user_id',
        'referral_use_id',
        'amount',
        'status',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referralUse()
    {
        return $this->belongsTo(ReferralUse::class);
    }
}
