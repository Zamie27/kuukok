<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechStack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'logo',
    ];

    // Categories
    public const CATEGORY_BACKEND = 'Backend';
    public const CATEGORY_FRONTEND = 'Frontend';
    public const CATEGORY_TOOLS = 'Tools';

    public static function getCategories(): array
    {
        return [
            self::CATEGORY_BACKEND,
            self::CATEGORY_FRONTEND,
            self::CATEGORY_TOOLS,
        ];
    }
}
