<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'parent_id',
        'customer_name',
        'customer_email',
        'project_name',
        'framework',
        'database',
        'whatsapp_number',
        'github_repo_url',
        'hosting_package_id',
        'domain_type',
        'domain_name',
        'price_total',
        'unique_code',
        'referral_code_used',
        'status',
        'payment_proof',
        'is_suspended',
        'admin_notes',
    ];

    public function getFinalPriceAttribute(): float
    {
        return (float) ($this->price_total + $this->unique_code);
    }

    /**
     * Relationships
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hostingPackage(): BelongsTo
    {
        return $this->belongsTo(HostingPackage::class);
    }

    public function parentOrder(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function upgradeOrders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function hostingAccount(): HasOne
    {
        return $this->hasOne(HostingAccount::class);
    }

    /**
     * Get human-readable status
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'waiting_price' => 'Menunggu Penentuan Harga',
            'pending_payment' => 'Menunggu Pembayaran',
            'waiting_confirmation' => 'Menunggu Konfirmasi',
            'active' => 'Aktif',
            'rejected' => 'Ditolak',
            'upgraded' => 'Sudah Upgrade',
            default => $this->status,
        };
    }
}
