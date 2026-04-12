<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashbackWithdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'method',
        'account_name',
        'bank_info',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
