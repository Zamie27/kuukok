<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Portfolio;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        // Seed sample portfolio records for development/testing
        Portfolio::factory()->count(8)->published()->create();
        Portfolio::factory()->count(5)->create();
    }
}
