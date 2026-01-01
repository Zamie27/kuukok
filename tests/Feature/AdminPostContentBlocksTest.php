<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPostContentBlocksTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_save_post_with_content_blocks()
    {
        // 1. Create Admin User
        $admin = User::factory()->create(['role' => 'admin']);

        // 2. Define Content Blocks
        $blocks = [
            [
                'id' => 1234567890,
                'type' => 'paragraph',
                'data' => ['text' => 'First paragraph block.']
            ],
            [
                'id' => 1234567891,
                'type' => 'heading',
                'data' => ['level' => 'h2', 'text' => 'Heading Block']
            ]
        ];

        // 3. Post Data
        $postData = [
            'title' => 'Test Post with Blocks',
            'slug' => 'test-post-blocks',
            'content' => '<p>First paragraph block.</p><h2>Heading Block</h2>', // Generated HTML
            'content_blocks' => json_encode($blocks), // JSON String as sent by form
            'status' => 'published',
        ];

        // 4. Send Request
        $response = $this->actingAs($admin)
            ->post(route('admin.posts.store'), $postData);

        // 5. Assertions
        $response->assertRedirect(route('admin.posts.index'));

        $this->assertDatabaseHas('posts', [
            'slug' => 'test-post-blocks',
        ]);

        $post = Post::where('slug', 'test-post-blocks')->first();
        $this->assertNotNull($post->content_blocks);
        $this->assertIsArray($post->content_blocks);
        $this->assertEquals('paragraph', $post->content_blocks[0]['type']);
        $this->assertEquals('Heading Block', $post->content_blocks[1]['data']['text']);
    }

    public function test_admin_can_update_post_with_content_blocks()
    {
        // 1. Create Admin User
        $admin = User::factory()->create(['role' => 'admin']);

        // Create Post manually
        $post = new Post([
            'title' => 'Original Title',
            'slug' => 'original-slug',
            'content' => '<p>Original Content</p>',
            'status' => 'draft',
            'author_id' => $admin->id
        ]);
        $post->content_blocks = []; // Empty initially
        $post->save();

        // 2. New Blocks Data
        $newBlocks = [
            [
                'id' => 999,
                'type' => 'quote',
                'data' => ['text' => 'Updated Quote', 'cite' => 'Me']
            ]
        ];

        // 3. Update Data
        $updateData = [
            'title' => $post->title,
            'slug' => $post->slug,
            'content' => '<blockquote>Updated Quote<cite>Me</cite></blockquote>',
            'content_blocks' => json_encode($newBlocks),
            'status' => 'published',
        ];

        // 4. Send Update Request
        $response = $this->actingAs($admin)
            ->put(route('admin.posts.update', $post), $updateData);

        // 5. Assertions
        $response->assertRedirect(route('admin.posts.index'));

        $post->refresh();
        $this->assertNotNull($post->content_blocks);
        $this->assertEquals('quote', $post->content_blocks[0]['type']);
        $this->assertEquals('Updated Quote', $post->content_blocks[0]['data']['text']);
    }
}
