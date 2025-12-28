<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apakah harga sudah termasuk revisi?',
                'answer' => 'Ya, setiap paket sudah termasuk revisi sesuai yang tertera di deskripsi paket. Untuk paket Starter web development mendapat 2x revisi, Professional 3x revisi, dan seterusnya. Revisi dilakukan sesuai scope awal yang disepakati.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Bagaimana sistem pembayaran?',
                'answer' => 'Kami menggunakan sistem pembayaran 2 tahap: DP 50% di awal project untuk memulai pengerjaan, dan pelunasan 50% setelah project selesai dan disetujui klien. Pembayaran dapat melalui transfer bank atau e-wallet.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Apakah ada garansi untuk layanan yang diberikan?',
                'answer' => 'Ya, kami memberikan garansi 100% kepuasan. Jika hasil tidak sesuai brief awal, kami akan melakukan revisi hingga Anda puas. Untuk web development, kami juga memberikan support gratis untuk bug fixing sesuai durasi yang tertera di paket (1-6 bulan).',
                'sort_order' => 3,
            ],
            [
                'question' => 'Apa yang didapat dalam paket Professional web development?',
                'answer' => 'Paket Professional mencakup website hingga 15 halaman dengan custom CMS dashboard untuk management konten, database integration, user authentication system, advanced SEO optimization, responsive design, dan 3 bulan support gratis. Cocok untuk bisnis yang membutuhkan website dinamis dengan database.',
                'sort_order' => 4,
            ],
            [
                'question' => 'Berapa lama waktu pengerjaan project?',
                'answer' => 'Waktu pengerjaan bervariasi tergantung kompleksitas project. Untuk landing page sederhana biasanya 3-5 hari kerja. Untuk website company profile standard 1-2 minggu. Untuk website custom dengan fitur kompleks bisa memakan waktu 3-4 minggu atau lebih. Kami akan memberikan timeline detail di awal project.',
                'sort_order' => 5,
            ],
            [
                'question' => 'Apakah ada biaya maintenance setelah project selesai?',
                'answer' => 'Untuk periode support gratis (1-6 bulan tergantung paket), tidak ada biaya tambahan untuk bug fixing dan minor update. Setelah periode tersebut, kami menawarkan paket maintenance mulai dari Rp 500.000/bulan yang mencakup update konten, security patch, backup, dan technical support.',
                'sort_order' => 6,
            ],
            [
                'question' => 'File apa saja yang akan saya terima setelah project selesai?',
                'answer' => 'Untuk web development: source code, database backup, dokumentasi, dan akses ke hosting/domain. Untuk graphic design: file vector (AI/EPS), PNG, JPG, SVG, dan PDF. Untuk brand identity: lengkap dengan brand guidelines PDF. Semua file adalah hak milik Anda sepenuhnya setelah pelunasan.',
                'sort_order' => 7,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(
                ['question' => $faq['question']],
                array_merge($faq, ['active' => true])
            );
        }
    }
}
