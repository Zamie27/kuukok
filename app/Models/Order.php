<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'project_name',
        'whatsapp_number',
        'github_repo_url',
        'package_type',
        'domain_type',
        'domain_name',
        'price_total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function hostingAccount()
    {
        return $this->hasOne(HostingAccount::class);
    }
}
