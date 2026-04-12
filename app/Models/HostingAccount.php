<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HostingAccount extends Model
{
    protected $fillable = [
        'order_id',
        'ftp_host',
        'ftp_username',
        'ftp_password',
        'ftp_port',
        'db_name',
        'db_username',
        'db_password',
        'db_host',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
