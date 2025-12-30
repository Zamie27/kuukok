<?php

namespace Tests\Feature\Admin;

use App\Livewire\Admin\Portfolio\Index;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PortfolioCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_portfolio_with_all_fields()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('public');

        $file = UploadedFile::fake()->image('cover.jpg');

        Livewire::test(Index::class)
            ->set('title', 'My Awesome Project')
            ->set('slug', 'my-awesome-project')
            ->set('excerpt', 'Short summary')
            ->set('description', 'Full description')
            ->set('status', 'published')
            ->set('client_name', 'Client A')
            ->set('start_date', '2025-01-01')
            ->set('end_date', '2025-02-01')
            ->set('project_status', 'Completed')
            ->set('live_demo_link', 'https://example.com')
            ->set('team_size', 5)
            ->set('is_personal_project', true)
            ->set('project_roles_input', 'Developer, Designer')
            ->set('tagsInput', 'Laravel, Vue')
            ->set('coverUpload', $file)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('portfolios', [
            'title' => 'My Awesome Project',
            'slug' => 'my-awesome-project',
            'client_name' => 'Client A',
            'project_status' => 'Completed',
            'team_size' => 5,
            'is_personal_project' => true,
        ]);

        $portfolio = Portfolio::where('slug', 'my-awesome-project')->first();
        $this->assertNotNull($portfolio->published_at);
        $this->assertEquals(['Developer', 'Designer'], $portfolio->project_roles);
        $this->assertEquals(['Laravel', 'Vue'], $portfolio->tags);
        $this->assertNotNull($portfolio->cover_image);
        Storage::disk('public')->assertExists($portfolio->cover_image);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(Index::class)
            ->set('status', '') // Clear default value to test validation
            ->call('save')
            ->assertHasErrors(['title', 'slug', 'status']);
    }

    /** @test */
    public function it_can_update_portfolio()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $portfolio = Portfolio::create([
            'title' => 'Old Title',
            'slug' => 'old-title',
            'status' => 'draft',
            'author_id' => $user->id,
        ]);

        Livewire::test(Index::class)
            ->call('edit', $portfolio->id)
            ->set('title', 'New Title')
            ->set('client_name', 'Updated Client')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('portfolios', [
            'id' => $portfolio->id,
            'title' => 'New Title',
            'client_name' => 'Updated Client',
        ]);
    }

    /** @test */
    public function it_can_delete_portfolio()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $portfolio = Portfolio::create([
            'title' => 'To Delete',
            'slug' => 'to-delete',
            'status' => 'draft',
            'author_id' => $user->id,
        ]);

        Livewire::test(Index::class)
            ->call('delete', $portfolio->id);

        $this->assertDatabaseMissing('portfolios', ['id' => $portfolio->id]);
    }
}
