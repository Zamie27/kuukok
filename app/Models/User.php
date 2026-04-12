<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the profile associated with the user.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the posts for the user.
     */
    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'referral_code',
        'cashback_balance',
        'lifetime_cashback_earned',
        'has_ordered_hosting',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is admin (or super admin)
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }

    /**
     * Check if user is staff (editor or penulis)
     */
    public function isStaff(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'editor', 'penulis']);
    }

    /**
     * Boot the model
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if (Schema::hasColumn('users', 'referral_code')) {
                $user->referral_code = strtoupper(Str::random(10));
            }
            $user->role = $user->role ?? 'user';
        });

        static::created(function ($user) {
            if (Schema::hasTable('referrals')) {
                $user->referral()->create([
                    'code' => $user->referral_code
                ]);
            }
        });
    }

    /**
     * Check if user is standard user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Relationships
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function referral(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Referral::class);
    }

    public function referralUses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ReferralUse::class, 'used_by_user_id');
    }

    public function cashbacks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Cashback::class);
    }

    public function withdrawals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CashbackWithdrawal::class);
    }

    /**
     * Referral & Cashback Logic
     */
    public function isReferralActive(): bool
    {
        return $this->has_ordered_hosting;
    }

    public function isReferralExpired(): bool
    {
        return $this->created_at->addDays(30)->isPast();
    }

    public function canEarnMoreCashback(): bool
    {
        return $this->lifetime_cashback_earned < 30000;
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
