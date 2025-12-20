<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Portfolio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_unique_slug(): void
    {
        $title = 'My Awesome Project';
        $p1 = Portfolio::factory()->create(['title' => $title, 'slug' => 'my-awesome-project']);
        $p2 = Portfolio::factory()->create(['title' => $title, 'slug' => Portfolio::generateUniqueSlug($title)]);

        $this->assertNotEquals($p1->slug, $p2->slug);
    }

    /** @test */
    public function it_can_publish_and_unpublish(): void
    {
        $p = Portfolio::factory()->create(['status' => 'draft']);
        $this->assertNull($p->published_at);

        $p->publish();
        $this->assertEquals('published', $p->status);
        $this->assertNotNull($p->published_at);

        $p->unpublish();
        $this->assertEquals('draft', $p->status);
        $this->assertNull($p->published_at);
    }
}

