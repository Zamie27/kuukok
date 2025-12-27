<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'content',
        'rating',
        'photo',
        'status',
        'sort_order',
        'is_masked',
    ];

    protected $casts = [
        'is_masked' => 'boolean',
    ];

    public function getDisplayNameAttribute()
    {
        if ($this->is_masked) {
            $parts = explode(' ', $this->name);
            $maskedParts = array_map(function ($part) {
                if (strlen($part) <= 1) return $part;
                return substr($part, 0, 1) . str_repeat('*', strlen($part) - 1);
            }, $parts);
            return implode(' ', $maskedParts);
        }
        return $this->name;
    }
}
