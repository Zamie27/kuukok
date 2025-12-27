<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Package;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\Message;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admins = [
            ['name' => 'Super Admin', 'email' => 'admin@kuukok.test', 'role' => 'admin'],
            ['name' => 'Editor Kuukok', 'email' => 'editor@kuukok.test', 'role' => 'editor'],
            ['name' => 'Penulis Kuukok', 'email' => 'penulis@kuukok.test', 'role' => 'penulis'],
        ];

        foreach ($admins as $a) {
            $user = User::firstOrCreate(
                ['email' => $a['email']],
                [
                    'name' => $a['name'],
                    'password' => 'password',
                    'email_verified_at' => now(),
                    'role' => $a['role'],
                ]
            );
            Profile::firstOrCreate([
                'user_id' => $user->id,
            ], [
                'position' => 'Team Member',
                'bio' => 'Profil tim Kuukok.',
                'social_links' => ['linkedin' => '#', 'github' => '#'],
            ]);
        }

        Portfolio::factory()->count(6)->published()->create();
        Portfolio::factory()->count(4)->create();

        $packages = [
            ['name' => 'Basic', 'price_text' => 'Mulai dari Rp 100K', 'label' => null, 'features' => ['Landing page responsif','Custom design minimalis','SEO-friendly structure'], 'cta_link' => route('contact.index'), 'status' => 'active', 'sort_order' => 1],
            ['name' => 'Graphic Design', 'price_text' => 'Mulai dari Rp 20K', 'label' => 'Paling Laris', 'features' => ['Logo design profesional','Social media content','Brand guidelines'], 'cta_link' => route('contact.index'), 'status' => 'active', 'sort_order' => 2],
            ['name' => 'Full Service', 'price_text' => 'Custom', 'label' => 'Enterprise', 'features' => ['Web Development + Design','Priority support 24/7','Maintenance bulanan'], 'cta_link' => route('contact.index'), 'status' => 'active', 'sort_order' => 3],
        ];
        foreach ($packages as $p) {
            Package::firstOrCreate(['name' => $p['name']], $p);
        }

        $faqs = [
            ['question' => 'Bagaimana proses pengerjaan proyek?', 'answer' => 'Kami memulai dengan konsultasi, perencanaan, desain, implementasi, dan testing.', 'active' => true, 'sort_order' => 1],
            ['question' => 'Apakah ada garansi?', 'answer' => 'Ya, kami menyediakan masa dukungan setelah proyek selesai.', 'active' => true, 'sort_order' => 2],
            ['question' => 'Apakah harga bisa dinegosiasikan?', 'answer' => 'Kami fleksibel sesuai kebutuhan dan ruang lingkup.', 'active' => true, 'sort_order' => 3],
        ];
        foreach ($faqs as $f) {
            Faq::firstOrCreate(['question' => $f['question']], $f);
        }

        $posts = [
            ['title' => 'Membangun Website Modern dengan TailwindCSS', 'category' => 'Tutorial', 'content' => 'Konten artikel...', 'status' => 'published', 'meta_title' => 'TailwindCSS Modern', 'meta_description' => 'Panduan membuat website modern.', 'keywords' => 'tailwind, modern, tutorial'],
            ['title' => 'Optimasi SEO untuk UMKM', 'category' => 'SEO', 'content' => 'Konten artikel...', 'status' => 'draft', 'meta_title' => 'SEO UMKM', 'meta_description' => 'Cara optimasi SEO.', 'keywords' => 'seo, umkm'],
            ['title' => 'Pengantar Livewire di Laravel 12', 'category' => 'Laravel', 'content' => 'Konten artikel...', 'status' => 'published', 'meta_title' => 'Livewire Laravel', 'meta_description' => 'Menggunakan Livewire.', 'keywords' => 'livewire, laravel'],
        ];
        foreach ($posts as $p) {
            $post = new Post($p);
            $post->author_id = User::where('role', 'penulis')->first()?->id;
            if ($post->status === 'published') {
                $post->published_at = now();
            }
            $post->save();
        }

        $testimonials = [
            ['name' => 'Budi Santoso', 'role' => 'CEO TechCorp', 'content' => 'Kuukok sangat profesional.', 'rating' => 5, 'status' => 'active', 'sort_order' => 1],
            ['name' => 'Siti Aisyah', 'role' => 'Owner UMKM', 'content' => 'Hasil desain memuaskan.', 'rating' => 5, 'status' => 'active', 'sort_order' => 2],
            ['name' => 'Andi Pratama', 'role' => 'CTO Startup', 'content' => 'Performa website sangat cepat.', 'rating' => 4, 'status' => 'active', 'sort_order' => 3],
        ];
        foreach ($testimonials as $t) {
            Testimonial::firstOrCreate(['name' => $t['name'], 'content' => $t['content']], $t);
        }

        $messages = [
            ['name' => 'Calon Klien', 'email' => 'klien@example.com', 'subject' => 'Inquiry', 'body' => 'Saya tertarik menggunakan layanan Kuukok.', 'status' => 'unread'],
            ['name' => 'Partner', 'email' => 'partner@example.com', 'subject' => 'Kolaborasi', 'body' => 'Ayo kolaborasi buat event digital.', 'status' => 'unread'],
        ];
        foreach ($messages as $m) {
            Message::create($m);
        }
    }
}
