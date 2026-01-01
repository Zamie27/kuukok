<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogAnalyticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_analytics_route_exists_and_works()
    {
        // Create a user and a post
        $user = User::factory()->create();
        $post = Post::create([
            'title' => 'Test Post',
            'slug' => 'test-post',
            'content' => 'Test content',
            'status' => 'published',
            'author_id' => $user->id,
            'published_at' => now(),
        ]);

        // 1. Visit the blog post page to ensure it loads (and route generation works)
        $response = $this->get(route('blog.show', $post));
        $response->assertStatus(200);
        $response->assertSee('Test Post');

        // 2. Test the analytics tracking endpoint (WhatsApp)
        $response = $this->postJson(route('blog.track', $post), [
            'type' => 'whatsapp'
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'whatsapp_clicks' => 1,
            'share_clicks' => 0,
        ]);

        // 3. Test the analytics tracking endpoint (Share)
        $response = $this->postJson(route('blog.track', $post), [
            'type' => 'share'
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'whatsapp_clicks' => 1,
            'share_clicks' => 1,
        ]);
    }

    public function test_seo_meta_description_auto_generation()
    {
        $user = User::factory()->create();

        // Case 1: From content
        $post1 = Post::create([
            'title' => 'Content Post',
            'slug' => 'content-post',
            'content' => 'This is a test content that should be used for meta description.',
            'status' => 'published',
            'author_id' => $user->id,
            'published_at' => now(),
        ]);

        $this->assertEquals('This is a test content that should be used for meta description.', $post1->fresh()->meta_description);

        // Case 2: From content_blocks
        $post2 = Post::create([
            'title' => 'Block Post',
            'slug' => 'block-post',
            'content_blocks' => [
                ['type' => 'paragraph', 'data' => ['text' => 'This is from blocks.']],
                ['type' => 'image', 'data' => ['url' => '...']],
                ['type' => 'paragraph', 'data' => ['text' => 'More text.']]
            ],
            'status' => 'published',
            'author_id' => $user->id,
            'published_at' => now(),
        ]);

        $this->assertEquals('This is from blocks. More text.', $post2->fresh()->meta_description);

        // Case 3: Manual override
        $post3 = Post::create([
            'title' => 'Manual Post',
            'slug' => 'manual-post',
            'content' => 'Content here',
            'meta_description' => 'Manual override',
            'status' => 'published',
            'author_id' => $user->id,
            'published_at' => now(),
        ]);

        $this->assertEquals('Manual override', $post3->fresh()->meta_description);
    }
}
