<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
 * @property string|null $client_name
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string|null $project_status
 * @property string|null $live_demo_link
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
        'client_name',
        'start_date',
        'end_date',
        'project_status',
        'live_demo_link',
        'team_size',
        'is_personal_project',
        'project_roles',
    ];

    /**
     * Attribute casting definitions.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'gallery' => 'array',
        'tags' => 'array',
        'project_roles' => 'array',
        'is_personal_project' => 'boolean',
        'published_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the timeline label (e.g., "Januari - Februari 2025").
     */
    public function getTimelineLabelAttribute(): string
    {
        if (!$this->start_date) {
            return '-';
        }

        $start = $this->start_date->locale('id')->isoFormat('MMMM YYYY');

        if (!$this->end_date) {
            return $start . ' - Sekarang';
        }

        $end = $this->end_date->locale('id')->isoFormat('MMMM YYYY');

        if ($start === $end) {
            return $start;
        }

        return $start . ' - ' . $end;
    }

    /**
     * Get the duration label (e.g., "2 Bulan Pengerjaan").
     */
    public function getDurationLabelAttribute(): string
    {
        if (!$this->start_date) {
            return '';
        }

        $end = $this->end_date ?? now();

        // Calculate difference in months, adding 1 to include the starting month partial
        // using float diff in months can be tricky, so let's try strict month diff
        $months = $this->start_date->diffInMonths($end);

        // If less than a month, say "< 1 Bulan" or "1 Bulan"
        if ($months < 1) {
            $days = $this->start_date->diffInDays($end);
            if ($days < 30) {
                // For very short projects
                return $days . ' Hari Pengerjaan';
            }
            return '1 Bulan Pengerjaan';
        }

        return round($months) . ' Bulan Pengerjaan';
    }

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
     * Tech Stacks used in the project
     */
    public function techStacks(): BelongsToMany
    {
        return $this->belongsToMany(TechStack::class, 'portfolio_tech_stack');
    }

    /**
     * Team members who worked on the project
     */
    public function teamMembers(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'portfolio_team_member')
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Get formatted timeline string (e.g., "Januari - Februari 2025")
     */
    public function getTimelineAttribute(): string
    {
        if (!$this->start_date) return '-';

        $start = $this->start_date->translatedFormat('F');
        // If end_date is null, assume 'Present' or similar, but for now let's use logic:
        // User requested "Januari - Februari 2025"

        if (!$this->end_date) {
            return $this->start_date->translatedFormat('F Y') . ' - Sekarang';
        }

        $end = $this->end_date->translatedFormat('F Y');

        // If same year, don't repeat year in start? User example "Januari - Februari 2025" suggests this.
        if ($this->start_date->year === $this->end_date->year) {
            return $this->start_date->translatedFormat('F') . ' - ' . $end;
        }

        return $this->start_date->translatedFormat('F Y') . ' - ' . $end;
    }

    /**
     * Get formatted duration string (e.g., "2 Bulan Pengerjaan")
     */
    public function getDurationAttribute(): string
    {
        if (!$this->start_date || !$this->end_date) return '';

        // Calculate calendar months spanned
        $start = $this->start_date->copy()->startOfMonth();
        $end = $this->end_date->copy()->endOfMonth(); // Use end of month to be safe, or just startOfMonth for both

        // Actually, just comparing start of months is cleaner for "Jan - Feb" logic
        $diff = $this->start_date->copy()->startOfMonth()->diffInMonths($this->end_date->copy()->startOfMonth()) + 1;

        return $diff . ' Bulan Pengerjaan';
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
            $slug = $original . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
