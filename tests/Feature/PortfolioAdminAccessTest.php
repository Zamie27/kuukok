<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioAdminAccessTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_portfolios_requires_auth(): void
    {
        $this->get(route('admin.portfolios.index'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function admin_portfolios_accessible_when_authenticated(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('admin.portfolios.index'))
            ->assertStatus(200);
    }
}

