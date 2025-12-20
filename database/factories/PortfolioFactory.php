<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Portfolio::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3);
        $status = $this->faker->randomElement(['draft', 'published', 'archived']);

        return [
            'title' => $title,
            'slug' => Portfolio::generateUniqueSlug($title),
            'excerpt' => $this->faker->optional()->text(160),
            'description' => $this->faker->paragraphs(3, true),
            'cover_image' => null,
            'gallery' => [],
            'tags' => $this->faker->randomElements([
                'web', 'design', 'ui', 'ux', 'branding', 'seo', 'marketing',
            ], $this->faker->numberBetween(0, 4)),
            'status' => $status,
            'published_at' => null,
            'meta_title' => $this->faker->optional()->sentence(6),
            'meta_description' => $this->faker->optional()->text(160),
            'author_id' => User::query()->inRandomOrder()->value('id'),
        ];
    }

    /**
     * Ensure published_at reflects final status after overrides.
     */
    public function configure(): self
    {
        return $this
            ->afterMaking(function (Portfolio $p): void {
                $p->published_at = $p->status === 'published' ? ($p->published_at ?? now()) : null;
            })
            ->afterCreating(function (Portfolio $p): void {
                $p->published_at = $p->status === 'published' ? ($p->published_at ?? now()) : null;
                $p->saveQuietly();
            });
    }

    /**
     * Indicate the portfolio is published.
     */
    public function published(): self
    {
        return $this->state(function (): array {
            return [
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
            ];
        });
    }
}
