<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostingPackage extends Model
{
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

    /**
     * Parse numeric price from price_text (e.g., "Rp.50.000 / Project" -> 50000)
     */
    public function getPriceAttribute()
    {
        // Remove all non-numeric characters except decimals if any (though usually prices here are integer-like in display)
        $numeric = preg_replace('/[^0-9]/', '', $this->price_text);
        return (float) $numeric;
    }
}
