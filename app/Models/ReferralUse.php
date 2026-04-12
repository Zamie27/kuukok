<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralUse extends Model
{
    protected $fillable = [
        'referral_id',
        'used_by_user_id',
        'order_id',
        'status',
    ];

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }

    public function usedBy()
    {
        return $this->belongsTo(User::class, 'used_by_user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cashback()
    {
        return $this->hasOne(Cashback::class);
    }
}
