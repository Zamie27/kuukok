<?php

namespace Database\Seeders;

use App\Models\TechStack;
use Illuminate\Database\Seeder;

class TechStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stacks = [
            // Backend
            ['name' => 'Node.js', 'category' => 'Backend'],
            ['name' => 'Python', 'category' => 'Backend'],
            ['name' => 'Java', 'category' => 'Backend'],
            ['name' => 'PHP', 'category' => 'Backend'],
            ['name' => 'Ruby', 'category' => 'Backend'],
            ['name' => 'Go', 'category' => 'Backend'],
            ['name' => 'Laravel', 'category' => 'Backend'],
            
            // Frontend
            ['name' => 'React', 'category' => 'Frontend'],
            ['name' => 'Vue', 'category' => 'Frontend'],
            ['name' => 'Angular', 'category' => 'Frontend'],
            ['name' => 'Svelte', 'category' => 'Frontend'],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend'],
            ['name' => 'Bootstrap', 'category' => 'Frontend'],

            // Tools
            ['name' => 'Docker', 'category' => 'Tools'],
            ['name' => 'Git', 'category' => 'Tools'],
            ['name' => 'VS Code', 'category' => 'Tools'],
            ['name' => 'Figma', 'category' => 'Tools'],
            ['name' => 'Jira', 'category' => 'Tools'],
            ['name' => 'Postman', 'category' => 'Tools'],
        ];

        foreach ($stacks as $stack) {
            TechStack::firstOrCreate(['name' => $stack['name']], $stack);
        }
    }
}
