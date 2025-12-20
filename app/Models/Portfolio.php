<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Portfolio Eloquent Model
 *
 * Represents a portfolio item with SEO, cover image, gallery, and status management.
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $excerpt
 * @property string|null $description
 * @property string|null $cover_image
 * @property array|null $gallery
 * @property array|null $tags
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property int|null $author_id
 */
class Portfolio extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes. Keep list explicit for security.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'description',
        'cover_image',
        'gallery',
        'tags',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'author_id',
    ];

    /**
     * Attribute casting definitions.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'gallery' => 'array',
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    /**
     * Automatically generate a slug when setting the title if slug is not set.
     * Ensures slug conforms to URL-safe format.
     */
    protected static function booted(): void
    {
        static::creating(function (Portfolio $portfolio): void {
            if (empty($portfolio->slug)) {
                $portfolio->slug = static::generateUniqueSlug((string) $portfolio->title);
            }
        });

        static::updating(function (Portfolio $portfolio): void {
            if ($portfolio->isDirty('title') && $portfolio->isClean('slug')) {
                // If title changes but slug is not manually changed, keep slug stable.
                return;
            }

            if ($portfolio->isDirty('slug')) {
                $portfolio->slug = static::generateUniqueSlug((string) $portfolio->slug, true);
            }
        });
    }

    /**
     * Author relationship.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Publish this portfolio item.
     * Sets status to 'published' and published_at to current time.
     */
    public function publish(): void
    {
        $this->status = 'published';
        $this->published_at = now();
        $this->save();
    }

    /**
     * Unpublish this portfolio item (set back to draft).
     */
    public function unpublish(): void
    {
        $this->status = 'draft';
        $this->published_at = null;
        $this->save();
    }

    /**
     * Generate a unique slug for the portfolio.
     *
     * @param string $base The base string to generate slug from.
     * @param bool $fromSlug Whether the $base provided is already a slug string.
     */
    public static function generateUniqueSlug(string $base, bool $fromSlug = false): string
    {
        $slug = $fromSlug ? Str::slug($base) : Str::slug($base);

        $original = $slug;
        $i = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $original.'-'.$i;
            $i++;
        }

        return $slug;
    }
}

