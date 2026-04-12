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
        'account_number',
        'bank_info',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => $this->status,
        };
    }
}
