<!DOCTYPE html>
<html lang="id" data-theme="light" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing & Paket Layanan - Kuukok Creative Agency</title>
    <meta name="description" content="Lihat paket harga layanan Kuukok untuk Web Development, Graphic Design, dan layanan digital lainnya.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-base-100 font-sans text-base-content antialiased">

    @include('components.navbar')

    <!-- Breadcrumb & Header (Matching Blog/Portfolio Style) -->
    <div class="bg-base-200 px-4 pb-8 pt-24">
        <div class="mx-auto max-w-7xl">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary hover:underline">Home</a></li>
                    <li>Pricing</li>
                </ul>
            </div>
            <h1 class="mb-2 mt-4 text-4xl font-bold md:text-5xl text-base-content">Paket & Harga Layanan</h1>
            <p class="text-lg text-base-content/70">
                Pilih paket yang sesuai dengan kebutuhan dan budget Anda.
            </p>
        </div>
    </div>

    <!-- Pricing Section -->
    <section id="pricing" class="relative bg-section-light">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-16 space-y-10 pricing">
            <div class="pricing__grid reveal-on-scroll">
                <!-- Basic -->
                <article class="pricing__card interactive-transition">
                    <div class="card-body p-8 space-y-6">
                        <div class="badge badge-outline">Basic</div>
                        <h3 class="text-2xl font-bold text-base-content">Web Development</h3>
                        <div class="pricing__price text-4xl">Mulai dari Rp 100K</div>
                        <p class="text-sm text-base-content/60">per proyek</p>
                        <ul class="text-base text-base-content/70 space-y-3">
                            <li class="flex items-center gap-3"><span class="i-[check] text-primary">✓</span> Landing page responsif</li>
                            <li class="flex items-center gap-3">✓ Custom design minimalis</li>
                            <li class="flex items-center gap-3">✓ SEO‑friendly structure</li>
                            <li class="flex items-center gap-3">✓ Fast loading speed</li>
                            <li class="flex items-center gap-3">✓ 2x revisi gratis</li>
                        </ul>
                        <a href="{{ route('home') }}#kontak" class="pricing__cta btn-lg text-lg">Hubungi Kami</a>
                    </div>
                </article>

                <!-- Pro (Recommended) -->
                <article class="pricing__card pricing__card--recommended interactive-transition scale-105 z-10 shadow-2xl">
                    <div class="card-body p-8 space-y-6">
                        <div class="badge badge-primary badge-lg text-white mb-2">Paling Laris</div>
                        <h3 class="text-2xl font-bold text-base-content">Graphic Design</h3>
                        <div class="pricing__price text-4xl">Mulai dari Rp 20K</div>
                        <p class="text-sm text-base-content/60">per desain</p>
                        <ul class="text-base text-base-content/70 space-y-3">
                            <li class="flex items-center gap-3">✓ Logo design profesional</li>
                            <li class="flex items-center gap-3">✓ Social media content</li>
                            <li class="flex items-center gap-3">✓ Brand guidelines</li>
                            <li class="flex items-center gap-3">✓ Source file (AI/EPS)</li>
                            <li class="flex items-center gap-3">✓ Unlimited revisions</li>
                        </ul>
                        <a href="{{ route('home') }}#kontak" class="pricing__cta btn-lg text-lg">Hubungi Kami</a>
                    </div>
                </article>

                <!-- Enterprise -->
                <article class="pricing__card interactive-transition">
                    <div class="card-body p-8 space-y-6">
                        <div class="badge badge-primary badge-outline">Enterprise</div>
                        <h3 class="text-2xl font-bold text-base-content">Full Service</h3>
                        <div class="pricing__price text-4xl">Custom</div>
                        <p class="text-sm text-base-content/60">sesuai kebutuhan</p>
                        <ul class="text-base text-base-content/70 space-y-3">
                            <li class="flex items-center gap-3">✓ Web Development + Design</li>
                            <li class="flex items-center gap-3">✓ Priority support 24/7</li>
                            <li class="flex items-center gap-3">✓ Dedicated manager</li>
                            <li class="flex items-center gap-3">✓ Maintenance bulanan</li>
                            <li class="flex items-center gap-3">✓ Konsultasi bisnis</li>
                        </ul>
                        <a href="{{ route('home') }}#kontak" class="pricing__cta btn-lg text-lg">Hubungi Kami</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Kelebihan & Pertimbangan Web Development -->
    <section class="py-16 px-4 bg-base-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Kelebihan & Pertimbangan Web Development</h2>
                <p class="text-base-content/70 text-lg">Transparansi layanan untuk keputusan terbaik bisnis Anda</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 reveal-on-scroll">
                <!-- Kelebihan -->
                <div class="card bg-base-200/50 shadow-sm border border-base-300">
                    <div class="card-body">
                        <h3 class="card-title text-success mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Kelebihan
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-success">✓</span>
                                <span>Profesional & kredibel untuk bisnis Anda</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-success">✓</span>
                                <span>Dapat diakses 24/7 dari mana saja</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-success">✓</span>
                                <span>Meningkatkan jangkauan pasar secara online</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-success">✓</span>
                                <span>Mudah di-update dan dikelola</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-success">✓</span>
                                <span>Dapat terintegrasi dengan berbagai tools & API</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Pertimbangan -->
                <div class="card bg-base-200/50 shadow-sm border border-base-300">
                    <div class="card-body">
                        <h3 class="card-title text-warning mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Pertimbangan
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-warning">!</span>
                                <span>Memerlukan hosting dan domain (biaya tahunan)</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-warning">!</span>
                                <span>Butuh maintenance dan security update berkala</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-warning">!</span>
                                <span>Waktu pengerjaan beberapa minggu tergantung kompleksitas</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-warning">!</span>
                                <span>Perlu konten dan materi yang jelas sebelum mulai</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <div class="py-16 px-4 bg-base-200">
        <div class="max-w-4xl mx-auto reveal-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Frequently Asked Questions</h2>
                <p class="text-base-content/70">Pertanyaan yang sering ditanyakan seputar harga dan layanan kami</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="collapse collapse-plus bg-base-100 shadow">
                    <input type="radio" name="faq-accordion" checked />
                    <div class="collapse-title text-xl font-medium">
                        Apakah harga sudah termasuk revisi?
                    </div>
                    <div class="collapse-content">
                        <p class="text-base-content/70">Ya, setiap paket sudah termasuk revisi sesuai yang tertera di deskripsi paket. Untuk paket Starter web development mendapat 2x revisi, Professional 3x revisi, dan seterusnya. Revisi dilakukan sesuai scope awal yang disepakati.</p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="collapse collapse-plus bg-base-100 shadow">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Bagaimana sistem pembayaran?
                    </div>
                    <div class="collapse-content">
                        <p class="text-base-content/70">Kami menggunakan sistem pembayaran 2 tahap: DP 50% di awal project untuk memulai pengerjaan, dan pelunasan 50% setelah project selesai dan disetujui klien. Pembayaran dapat melalui transfer bank atau e-wallet.</p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="collapse collapse-plus bg-base-100 shadow">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah ada garansi untuk layanan yang diberikan?
                    </div>
                    <div class="collapse-content">
                        <p class="text-base-content/70">Ya, kami memberikan garansi 100% kepuasan. Jika hasil tidak sesuai brief awal, kami akan melakukan revisi hingga Anda puas. Untuk web development, kami juga memberikan support gratis untuk bug fixing sesuai durasi yang tertera di paket (1-6 bulan).</p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="collapse collapse-plus bg-base-100 shadow">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apa yang didapat dalam paket Professional web development?
                    </div>
                    <div class="collapse-content">
                        <p class="text-base-content/70">Paket Professional mencakup website hingga 15 halaman dengan custom CMS dashboard untuk management konten, database integration, user authentication system, advanced SEO optimization, responsive design, dan 3 bulan support gratis. Cocok untuk bisnis yang membutuhkan website dinamis dengan database.</p>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="collapse collapse-plus bg-base-100 shadow">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Berapa lama waktu pengerjaan project?
                    </div>
                    <div class="collapse-content">
                        <p class="text-base-content/70">Waktu pengerjaan berbeda-beda tergantung paket: Starter Web (2 minggu), Professional Web (1 bulan), Enterprise Web (2-3 bulan), Logo Design (5 hari), Brand Identity (2 minggu). Timeline dapat lebih cepat dengan additional rush fee atau lebih lama jika ada permintaan perubahan major dari klien.</p>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="collapse collapse-plus bg-base-100 shadow">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah bisa request custom paket sesuai kebutuhan?
                    </div>
                    <div class="collapse-content">
                        <p class="text-base-content/70">Tentu saja! Paket yang kami tampilkan adalah paket standard. Kami sangat terbuka untuk diskusi custom package sesuai kebutuhan spesifik Anda. Silakan hubungi tim kami untuk konsultasi gratis dan kami akan buatkan penawaran khusus untuk Anda.</p>
                    </div>
                </div>

                <!-- FAQ 7 -->
                <div class="collapse collapse-plus bg-base-100 shadow">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah ada biaya maintenance setelah project selesai?
                    </div>
                    <div class="collapse-content">
                        <p class="text-base-content/70">Untuk periode support gratis (1-6 bulan tergantung paket), tidak ada biaya tambahan untuk bug fixing dan minor update. Setelah periode tersebut, kami menawarkan paket maintenance mulai dari Rp 500.000/bulan yang mencakup update konten, security patch, backup, dan technical support.</p>
                    </div>
                </div>

                <!-- FAQ 8 -->
                <div class="collapse collapse-plus bg-base-100 shadow">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        File apa saja yang akan saya terima setelah project selesai?
                    </div>
                    <div class="collapse-content">
                        <p class="text-base-content/70">Untuk web development: source code, database backup, dokumentasi, dan akses ke hosting/domain. Untuk graphic design: file vector (AI/EPS), PNG, JPG, SVG, dan PDF. Untuk brand identity: lengkap dengan brand guidelines PDF. Semua file adalah hak milik Anda sepenuhnya setelah pelunasan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimoni Section (From Home) -->
    <section id="testimoni" class="relative bg-section-secondary">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10 testimoni">
            <div class="text-center space-y-3 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-inherit">Testimoni</h2>
                <p class="text-base md:text-lg text-inherit opacity-90">Apa kata klien kami tentang hasil kerja kami</p>
            </div>

            <!-- Marquee Carousel -->
            <div class="relative w-full overflow-hidden reveal-on-scroll">
                <!-- Gradient Masks -->
                <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-[#F1F5F9] dark:from-[#1E293B] to-transparent z-10 pointer-events-none"></div>
                <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-[#F1F5F9] dark:from-[#1E293B] to-transparent z-10 pointer-events-none"></div>

                <div class="flex animate-marquee gap-6 w-max">
                    <!-- Item 1 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">JS</div>
                                <div>
                                    <h3 class="testimoni__name">Joko Susilo</h3>
                                    <p class="testimoni__role">CEO, TechStartup</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★★</div>
                            <p class="testimoni__quote">"Pelayanan sangat memuaskan, website jadi lebih cepat dari jadwal. Sangat profesional!"</p>
                        </div>
                    </article>
                    <!-- Item 2 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">AM</div>
                                <div>
                                    <h3 class="testimoni__name">Anita Maharani</h3>
                                    <p class="testimoni__role">Owner, BeautyBrand</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★★</div>
                            <p class="testimoni__quote">"Desainnya elegan dan sesuai dengan brand kami. Adminnya juga ramah dan fast respon."</p>
                        </div>
                    </article>
                    <!-- Item 3 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">BP</div>
                                <div>
                                    <h3 class="testimoni__name">Budi Pratama</h3>
                                    <p class="testimoni__role">Marketing Manager</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★★</div>
                            <p class="testimoni__quote">"Hasil kerja rapi, kode bersih, dan mudah di-maintain. Recommended developer!"</p>
                        </div>
                    </article>
                    <!-- Item 4 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">SR</div>
                                <div>
                                    <h3 class="testimoni__name">Siti Rahma</h3>
                                    <p class="testimoni__role">UMKM Owner</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★☆</div>
                            <p class="testimoni__quote">"Harganya terjangkau untuk UMKM tapi kualitasnya seperti agensi besar. Terima kasih!"</p>
                        </div>
                    </article>
                    <!-- Item 5 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">DK</div>
                                <div>
                                    <h3 class="testimoni__name">Dedi Kurniawan</h3>
                                    <p class="testimoni__role">Freelancer</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★★</div>
                            <p class="testimoni__quote">"Sangat terbantu dengan jasa content writing-nya. Traffic blog saya naik drastis."</p>
                        </div>
                    </article>

                    <!-- Duplicated Items for Seamless Loop -->
                    <!-- Item 1 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">JS</div>
                                <div>
                                    <h3 class="testimoni__name">Joko Susilo</h3>
                                    <p class="testimoni__role">CEO, TechStartup</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★★</div>
                            <p class="testimoni__quote">"Pelayanan sangat memuaskan, website jadi lebih cepat dari jadwal. Sangat profesional!"</p>
                        </div>
                    </article>
                    <!-- Item 2 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">AM</div>
                                <div>
                                    <h3 class="testimoni__name">Anita Maharani</h3>
                                    <p class="testimoni__role">Owner, BeautyBrand</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★★</div>
                            <p class="testimoni__quote">"Desainnya elegan dan sesuai dengan brand kami. Adminnya juga ramah dan fast respon."</p>
                        </div>
                    </article>
                    <!-- Item 3 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">BP</div>
                                <div>
                                    <h3 class="testimoni__name">Budi Pratama</h3>
                                    <p class="testimoni__role">Marketing Manager</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★★</div>
                            <p class="testimoni__quote">"Hasil kerja rapi, kode bersih, dan mudah di-maintain. Recommended developer!"</p>
                        </div>
                    </article>
                    <!-- Item 4 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">SR</div>
                                <div>
                                    <h3 class="testimoni__name">Siti Rahma</h3>
                                    <p class="testimoni__role">UMKM Owner</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★☆</div>
                            <p class="testimoni__quote">"Harganya terjangkau untuk UMKM tapi kualitasnya seperti agensi besar. Terima kasih!"</p>
                        </div>
                    </article>
                    <!-- Item 5 -->
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">DK</div>
                                <div>
                                    <h3 class="testimoni__name">Dedi Kurniawan</h3>
                                    <p class="testimoni__role">Freelancer</p>
                                </div>
                            </div>
                            <div class="testimoni__stars">★★★★★</div>
                            <p class="testimoni__quote">"Sangat terbantu dengan jasa content writing-nya. Traffic blog saya naik drastis."</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <div class="bg-base-200 px-4 py-20 reveal-on-scroll">
        <div class="mx-auto max-w-5xl">
            <div class="card to-primary-focus bg-gradient-to-br from-primary text-white shadow-2xl">
                <div class="card-body py-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold md:text-4xl">
                        Masih Bingung Pilih Paket?
                    </h2>
                    <p class="mx-auto mb-6 max-w-2xl text-lg opacity-90">
                        Konsultasikan kebutuhan bisnis Anda dengan kami secara gratis
                    </p>
                    <div class="flex flex-col justify-center gap-4 sm:flex-row">
                        <a href="{{ route('home') }}#kontak" class="btn btn-accent btn-lg text-neutral font-bold border-none">
                            Konsultasi Gratis
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.686 8-8 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 3.686-8 8-8s8 3.582 8 8z" />
                            </svg>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary hover:border-white">
                            Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

</body>

</html>
