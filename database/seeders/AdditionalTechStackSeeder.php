<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TechStack;

class AdditionalTechStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stacks = [
            // Office & Productivity
            ['name' => 'Microsoft Word', 'category' => TechStack::CATEGORY_OFFICE],
            ['name' => 'Microsoft Excel', 'category' => TechStack::CATEGORY_OFFICE],
            ['name' => 'Microsoft PowerPoint', 'category' => TechStack::CATEGORY_OFFICE],
            ['name' => 'Google Docs', 'category' => TechStack::CATEGORY_OFFICE],
            ['name' => 'Google Sheets', 'category' => TechStack::CATEGORY_OFFICE],
            ['name' => 'Google Slides', 'category' => TechStack::CATEGORY_OFFICE],

            // Design
            ['name' => 'Adobe Photoshop', 'category' => TechStack::CATEGORY_DESIGN],
            ['name' => 'Adobe Illustrator', 'category' => TechStack::CATEGORY_DESIGN],
            ['name' => 'Adobe InDesign', 'category' => TechStack::CATEGORY_DESIGN],
            ['name' => 'CorelDRAW', 'category' => TechStack::CATEGORY_DESIGN],
            ['name' => 'Canva', 'category' => TechStack::CATEGORY_DESIGN],
            ['name' => 'Inkscape', 'category' => TechStack::CATEGORY_DESIGN],

            // Web Programming (Additional)
            ['name' => 'HTML', 'category' => TechStack::CATEGORY_FRONTEND],
            ['name' => 'CSS', 'category' => TechStack::CATEGORY_FRONTEND],
            ['name' => 'SASS/SCSS', 'category' => TechStack::CATEGORY_FRONTEND],
            ['name' => 'TypeScript', 'category' => TechStack::CATEGORY_FRONTEND],
            ['name' => 'Next.js', 'category' => TechStack::CATEGORY_FRONTEND],
            ['name' => 'Nuxt.js', 'category' => TechStack::CATEGORY_FRONTEND],
            
            // Database
            ['name' => 'MySQL', 'category' => TechStack::CATEGORY_DATABASE],
            ['name' => 'PostgreSQL', 'category' => TechStack::CATEGORY_DATABASE],
            ['name' => 'MongoDB', 'category' => TechStack::CATEGORY_DATABASE],
            ['name' => 'SQLite', 'category' => TechStack::CATEGORY_DATABASE],
            ['name' => 'MariaDB', 'category' => TechStack::CATEGORY_DATABASE],
            ['name' => 'Firebase', 'category' => TechStack::CATEGORY_DATABASE],

            // Programming Languages (General/Backend)
            ['name' => 'C++', 'category' => TechStack::CATEGORY_BACKEND],
            ['name' => 'C#', 'category' => TechStack::CATEGORY_BACKEND],
            ['name' => 'Rust', 'category' => TechStack::CATEGORY_BACKEND],
            ['name' => 'Dart', 'category' => TechStack::CATEGORY_BACKEND],

            // Other Tools
            ['name' => 'Trello', 'category' => TechStack::CATEGORY_TOOLS],
            ['name' => 'Notion', 'category' => TechStack::CATEGORY_TOOLS],
            ['name' => 'Slack', 'category' => TechStack::CATEGORY_TOOLS],
            ['name' => 'Zoom', 'category' => TechStack::CATEGORY_TOOLS],
            ['name' => 'XAMPP', 'category' => TechStack::CATEGORY_TOOLS],
        ];

        foreach ($stacks as $stack) {
            // Check if exists to avoid duplicates
            if (!DB::table('tech_stacks')->where('name', $stack['name'])->exists()) {
                DB::table('tech_stacks')->insert([
                    'name' => $stack['name'],
                    'category' => $stack['category'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
