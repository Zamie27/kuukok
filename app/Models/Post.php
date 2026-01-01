<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
        'content_blocks',
        'cover_image',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'keywords',
        'tags',
        'author_id',
        'views',
        'whatsapp_clicks',
        'share_clicks',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
        'read_time' => 'integer',
        'content_blocks' => 'array',
        'tags' => 'array',
    ];

    protected $appends = ['toc', 'category_color'];

    protected static function booted(): void
    {
        static::creating(function (Post $post): void {
            if (empty($post->slug)) {
                $post->slug = static::generateUniqueSlug((string) $post->title);
            }
        });

        static::saving(function (Post $post): void {
            $wordCount = str_word_count(strip_tags($post->content ?? ''));
            // Also count text in content_blocks if content is empty or to be accurate
            if (!empty($post->content_blocks) && is_array($post->content_blocks)) {
                foreach ($post->content_blocks as $block) {
                    if (isset($block['data']['text'])) {
                        $wordCount += str_word_count(strip_tags($block['data']['text']));
                    }
                }
            }
            $post->read_time = (int) ceil($wordCount / 200);

            // Generate Meta Description if empty
            if (empty($post->meta_description)) {
                $descriptionText = '';
                if (!empty($post->content_blocks) && is_array($post->content_blocks)) {
                    foreach ($post->content_blocks as $block) {
                        if (($block['type'] === 'paragraph' || $block['type'] === 'text') && isset($block['data']['text'])) {
                            $descriptionText .= $block['data']['text'] . ' ';
                        }
                    }
                } else {
                    $descriptionText = strip_tags($post->content ?? '');
                }
                $post->meta_description = Str::limit(trim($descriptionText), 155);
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getTocAttribute(): array
    {
        $toc = [];

        // Generate TOC from Content Blocks if available
        if (!empty($this->content_blocks) && is_array($this->content_blocks)) {
            foreach ($this->content_blocks as $block) {
                if ($block['type'] === 'heading' && !empty($block['data']['text'])) {
                    $toc[] = [
                        'level' => $block['data']['level'] ?? 'h2', // Default to h2 if missing
                        'text' => strip_tags($block['data']['text']),
                        'id' => Str::slug(strip_tags($block['data']['text'])),
                    ];
                }
            }
        }

        // Fallback to HTML content parsing if blocks yielded no TOC or aren't used
        if (empty($toc)) {
            preg_match_all('/<h([2-3]).*?>(.*?)<\/h[2-3]>/i', $this->content ?? '', $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $toc[] = [
                    'level' => 'h' . $match[1],
                    'text' => strip_tags($match[2]),
                    'id' => Str::slug(strip_tags($match[2])),
                ];
            }
        }

        return $toc;
    }

    public function getCategoryColorAttribute(): string
    {
        if (!$this->category) {
            return 'primary';
        }

        $colors = ['primary', 'secondary', 'accent', 'info', 'success', 'warning', 'error'];
        $hash = crc32($this->category);
        return $colors[abs($hash) % count($colors)];
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereJsonContains('tags', $search);
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->where('category', $category);
        });

        $query->when($filters['tag'] ?? false, function ($query, $tag) {
            $query->whereJsonContains('tags', $tag);
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }

        if ($this->content) {
            return Str::limit(strip_tags($this->content), 150);
        }

        if (!empty($this->content_blocks) && is_array($this->content_blocks)) {
            $text = '';
            foreach ($this->content_blocks as $block) {
                if (($block['type'] === 'paragraph' || $block['type'] === 'text') && isset($block['data']['text'])) {
                    $text .= $block['data']['text'] . ' ';
                }
            }
            return Str::limit(strip_tags(trim($text)), 150);
        }

        return '';
    }

    public static function generateUniqueSlug(string $base): string
    {
        $slug = Str::slug($base);
        $original = $slug;
        $i = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i;
            $i++;
        }
        return $slug;
    }
}
