<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_text',
        'label',
        'features',
        'cta_link',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
