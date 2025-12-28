<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($profile) {
            if (empty($profile->slug) && $profile->user_id) {
                $user = User::find($profile->user_id);
                if ($user) {
                    $slug = Str::slug($user->name);
                    $originalSlug = $slug;
                    $count = 1;
                    while (static::where('slug', $slug)->exists()) {
                        $slug = $originalSlug . '-' . $count++;
                    }
                    $profile->slug = $slug;
                }
            }
        });
    }

    protected $fillable = [
        'user_id',
        'slug',
        'position',
        'gender',
        'bio',
        'quote',
        'about_me',
        'address_city',
        'address_province',
        'address_country',
        'joined_at',
        'specializations',
        'avatar',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
        'specializations' => 'array',
        'joined_at' => 'date',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function techStacks(): BelongsToMany
    {
        return $this->belongsToMany(TechStack::class, 'profile_tech_stack');
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class);
    }

    public function portfolios(): BelongsToMany
    {
        return $this->belongsToMany(Portfolio::class, 'portfolio_team_member')
            ->withPivot('role')
            ->withTimestamps()
            ->where('status', 'published')
            ->orderByDesc('published_at');
    }
}
