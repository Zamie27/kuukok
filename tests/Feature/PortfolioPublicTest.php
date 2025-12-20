<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Portfolio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioPublicTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function portfolio_index_lists_published_items(): void
    {
        Portfolio::factory()->count(2)->published()->create();
        Portfolio::factory()->count(1)->create(['status' => 'draft']);

        $response = $this->get(route('portfolio.index'));

        $response->assertStatus(200);
        $response->assertSee('Portfolio Kami');
    }

    /** @test */
    public function portfolio_show_only_allows_published(): void
    {
        $published = Portfolio::factory()->published()->create();
        $draft = Portfolio::factory()->create(['status' => 'draft']);

        $this->get(route('portfolio.show', $published))->assertOk();
        $this->get(route('portfolio.show', $draft))->assertStatus(404);
    }
}

