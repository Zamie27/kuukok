<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Portfolio;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_search_posts_by_content_or_meta_description()
    {
        // Create a post with specific content
        Post::create([
            'title' => 'Laravel Tutorial',
            'slug' => 'laravel-tutorial',
            'content' => 'This is a comprehensive guide to Laravel framework.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        // Create a post with specific meta_description
        Post::create([
            'title' => 'PHP Guide',
            'slug' => 'php-guide',
            'content' => 'Something else.',
            'meta_description' => 'Learn PHP basics here.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        // Search for "comprehensive" (in content)
        $response = $this->get('/search?q=comprehensive');
        $response->assertStatus(200);
        $response->assertSee('Laravel Tutorial');
        $response->assertDontSee('PHP Guide');

        // Search for "basics" (in meta_description)
        $response = $this->get('/search?q=basics');
        $response->assertStatus(200);
        $response->assertSee('PHP Guide');
        $response->assertDontSee('Laravel Tutorial');
    }

    /** @test */
    public function it_can_search_portfolios_by_excerpt()
    {
        Portfolio::create([
            'title' => 'E-commerce App',
            'slug' => 'ecommerce-app',
            'excerpt' => 'A scalable online store solution.',
            'description' => 'Full description here.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/search?q=scalable');
        $response->assertStatus(200);
        $response->assertSee('E-commerce App');
    }
}
