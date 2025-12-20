<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head')
</head>

<body class="bg-base-100 font-sans min-h-screen">
    @include('components.navbar')

    <!-- Hero section: XXI-style two-column within container -->
    <section class="relative min-h-screen overflow-hidden">
        <!-- Background Image & Overlay -->
        <div class="absolute inset-0 z-0">
            <!-- Light Mode Background -->
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-300 ease-in-out opacity-100 dark:opacity-0"
                style="background-image: url('/image/bghero-light.jpg');">
                <div class="absolute inset-0 bg-white/30"></div>
            </div>

            <!-- Dark Mode Background -->
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-300 ease-in-out opacity-0 dark:opacity-100"
                style="background-image: url('/image/bghero-dark.jpg'); filter: brightness(70%);">
                <div class="absolute inset-0 bg-slate-900/50"></div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 lg:px-8 min-h-screen flex flex-col md:flex-row gap-8 pt-20">
            <div class="w-full md:w-1/2 flex flex-col justify-start pt-24 md:pt-36 flex-1">
                <h1 class="text-base-content tracking-tight text-2xl md:text-4xl lg:text-5xl leading-tight">
                    Saat Tantangan Datang, Kami Hadir untuk Membantu Bisnismu dan Masa Depanmu
                </h1>
            </div>
            <div class="w-full md:w-1/2 flex flex-col justify-end pb-20 md:pb-32 items-end">
                <p class="text-sm md:text-base text-base-content/70 max-w-xl text-right">
                    Kuukok Solusi digital profesional yang dirancang khusus untuk mengakselerasi pertumbuhan bisnis Anda dengan pendekatan yang terukur dan hasil yang nyata.
                </p>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="tentang-kami" class="relative bg-base-100">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 flex flex-col gap-12 md:gap-16 py-24 md:py-32">
            <!-- Title -->
            <div class="text-center space-y-3 animate-fade-up">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-base-content">Tentang Kami</h2>
                <p class="text-base md:text-lg text-base-content/70">Solusi digital profesional dengan fokus pada kualitas, konsistensi, dan hasil nyata</p>
            </div>

            <div class="divider"></div>

            <!-- Feature grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-fade-up">
                <div class="card bg-base-100 border border-base-300 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M3 5h18M3 12h18M3 19h18" />
                                </svg>
                            </span>
                            <h3 class="text-base font-semibold text-base-content">Web Development</h3>
                        </div>
                        <p class="text-sm text-base-content/70">Website modern, responsif, dan SEO-friendly dengan teknologi terkini.</p>
                    </div>
                </div>
                <div class="card bg-base-100 border border-base-300 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M4 4h9v9H4zM13 13l7 7" />
                                </svg>
                            </span>
                            <h3 class="text-base font-semibold text-base-content">Graphic Design</h3>
                        </div>
                        <p class="text-sm text-base-content/70">Desain visual menarik dan konsisten dengan brand identity.</p>
                    </div>
                </div>
                <div class="card bg-base-100 border border-base-300 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M5 5h14v14H5zM7 7h10M7 11h10M7 15h10" />
                                </svg>
                            </span>
                            <h3 class="text-base font-semibold text-base-content">Content Writing</h3>
                        </div>
                        <p class="text-sm text-base-content/70">Konten berkualitas yang engaging dan dioptimasi untuk konversi.</p>
                    </div>
                </div>
                <div class="card bg-base-100 border border-base-300 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 6v6l4 2M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                                </svg>
                            </span>
                            <h3 class="text-base font-semibold text-base-content">Support 24/7</h3>
                        </div>
                        <p class="text-sm text-base-content/70">Dukungan teknis dan konsultasi kapan saja Anda butuhkan.</p>
                    </div>
                </div>
            </div>

            <!-- Centered stats strip -->
            <div class="animate-fade-up flex justify-center">
                <div class="stats stats-vertical sm:stats-horizontal w-full max-w-full sm:max-w-3xl shadow-sm bg-base-100/80 backdrop-blur-sm border border-base-300 rounded-2xl text-center">
                    <div class="stat">
                        <div class="stat-title text-base-content/70">Projects Completed</div>
                        <div class="stat-value text-primary">50+</div>
                        <div class="stat-desc text-base-content/60">Proyek selesai dengan sukses</div>
                    </div>
                    <div class="stat">
                        <div class="stat-title text-base-content/70">Happy Clients</div>
                        <div class="stat-value text-primary">40+</div>
                        <div class="stat-desc text-base-content/60">Kepuasan klien tinggi</div>
                    </div>
                    <div class="stat">
                        <div class="stat-title text-base-content/70">Response Time</div>
                        <div class="stat-value text-primary">24/7</div>
                        <div class="stat-desc text-base-content/60">Support cepat setiap saat</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portofolio -->
    <section id="portfolio" class="relative bg-base-100">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10 portfolio">
            <div class="text-center space-y-3 animate-fade-up">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-base-content">Portofolio</h2>
                <p class="text-base md:text-lg text-base-content/70">Beberapa proyek terbaik yang telah kami kerjakan</p>
            </div>

            <div class="portfolio__grid animate-fade-up">
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">Web Development</div>
                        <h3 class="portfolio__title">Corporate Website</h3>
                        <p class="portfolio__desc">Website perusahaan dengan CMS dan dashboard admin.</p>
                        <div class="card-actions justify-end"><a href="#" class="portfolio__link">Lihat Detail →</a></div>
                    </div>
                </article>
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">Design</div>
                        <h3 class="portfolio__title">Brand Identity</h3>
                        <p class="portfolio__desc">Logo, color palette, dan brand guideline lengkap.</p>
                        <div class="card-actions justify-end"><a href="#" class="link link-primary">Lihat Detail →</a></div>
                    </div>
                </article>
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">Web App</div>
                        <h3 class="portfolio__title">E‑Commerce Platform</h3>
                        <p class="portfolio__desc">Toko online dengan payment gateway terintegrasi.</p>
                        <div class="card-actions justify-end"><a href="#" class="link link-primary">Lihat Detail →</a></div>
                    </div>
                </article>
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">UI/UX</div>
                        <h3 class="portfolio__title">Mobile App UI/UX</h3>
                        <p class="portfolio__desc">Desain aplikasi mobile yang user‑friendly.</p>
                        <div class="card-actions justify-end"><a href="#" class="link link-primary">Lihat Detail →</a></div>
                    </div>
                </article>
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">Data Viz</div>
                        <h3 class="portfolio__title">Dashboard Analytics</h3>
                        <p class="portfolio__desc">Platform analitik dengan visualisasi data real‑time.</p>
                        <div class="card-actions justify-end"><a href="#" class="link link-primary">Lihat Detail →</a></div>
                    </div>
                </article>
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">Content</div>
                        <h3 class="portfolio__title">Social Media Content</h3>
                        <p class="portfolio__desc">Konten visual dan video marketing untuk sosmed.</p>
                        <div class="card-actions justify-end"><a href="#" class="link link-primary">Lihat Detail →</a></div>
                    </div>
                </article>
            </div>
            <div class="flex justify-center">
                <a href="{{ route('portfolio.index') }}" class="btn btn-outline btn-primary">Lihat Portofolio Lainnya →</a>
            </div>
        </div>
    </section>

    <!-- Harga -->
    <section id="pricing" class="relative bg-base-100">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10 pricing">
            <div class="text-center space-y-3 animate-fade-up">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-base-content">Paket & Layanan</h2>
                <p class="text-base md:text-lg text-base-content/70">Harga terjangkau dengan kualitas profesional untuk berbagai kebutuhan</p>
            </div>

            <div class="pricing__grid animate-fade-up">
                <!-- Basic -->
                <article class="pricing__card interactive-transition">
                    <div class="card-body space-y-4">
                        <div class="badge badge-outline">Basic</div>
                        <h3 class="text-xl font-semibold text-base-content">Web Development</h3>
                        <div class="pricing__price">Mulai dari Rp 100K</div>
                        <p class="text-xs text-base-content/60">per proyek</p>
                        <ul class="text-sm text-base-content/70 space-y-2">
                            <li class="flex items-center gap-2"><span class="i-[check] text-primary">✓</span> Landing page responsif</li>
                            <li class="flex items-center gap-2">✓ Custom design minimalis</li>
                            <li class="flex items-center gap-2">✓ SEO‑friendly structure</li>
                            <li class="flex items-center gap-2">✓ Fast loading speed</li>
                            <li class="flex items-center gap-2">✓ 2x revisi gratis</li>
                        </ul>
                        <a href="#" class="pricing__cta">Pesan Sekarang</a>
                    </div>
                </article>

                <!-- Pro (Recommended) -->
                <article class="pricing__card pricing__card--recommended interactive-transition">
                    <div class="card-body space-y-4">
                        <div class="badge badge-success">Populer</div>
                        <h3 class="text-xl font-semibold text-base-content">Graphic Design</h3>
                        <div class="pricing__price">Mulai dari Rp 20K</div>
                        <p class="text-xs text-base-content/60">per desain</p>
                        <ul class="text-sm text-base-content/70 space-y-2">
                            <li>✓ Logo design profesional</li>
                            <li>✓ Social media content</li>
                            <li>✓ Brand guidelines</li>
                            <li>✓ Source file (AI/EPS)</li>
                            <li>✓ Unlimited revisions</li>
                        </ul>
                        <a href="#" class="pricing__cta">Pesan Sekarang</a>
                    </div>
                </article>

                <!-- Enterprise -->
                <article class="pricing__card interactive-transition">
                    <div class="card-body space-y-4">
                        <div class="badge badge-outline">Enterprise</div>
                        <h3 class="text-xl font-semibold text-base-content">Full Service</h3>
                        <div class="pricing__price">Custom</div>
                        <p class="text-xs text-base-content/60">sesuai kebutuhan</p>
                        <ul class="text-sm text-base-content/70 space-y-2">
                            <li>✓ Web Development + Design</li>
                            <li>✓ Priority support 24/7</li>
                            <li>✓ Dedicated manager</li>
                            <li>✓ Maintenance bulanan</li>
                            <li>✓ Konsultasi bisnis</li>
                        </ul>
                        <a href="#" class="pricing__cta">Hubungi Kami</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="relative bg-base-100">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10 testimoni">
            <div class="text-center space-y-3 animate-fade-up">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-base-content">Testimoni</h2>
                <p class="text-base md:text-lg text-base-content/70">Apa kata klien kami tentang hasil kerja kami</p>
            </div>

            <!-- Horizontal Scrollable Carousel -->
            <div class="relative w-full overflow-hidden">
                <div id="testimoniCarousel" class="testimoni__track scrollbar-hide py-4 px-2">
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

                <!-- Dots Indicators -->
                <div class="testimoni__dots flex justify-center gap-2 mt-8">
                    <button class="testimoni__dot w-3 h-3 rounded-full bg-primary/30 transition-all duration-300 testimoni__dot--active" data-index="0"></button>
                    <button class="testimoni__dot w-3 h-3 rounded-full bg-primary/30 transition-all duration-300" data-index="1"></button>
                    <button class="testimoni__dot w-3 h-3 rounded-full bg-primary/30 transition-all duration-300" data-index="2"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel (Placeholder) -->
    <section id="artikel" class="relative bg-base-100">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10">
            <div class="text-center space-y-3 animate-fade-up">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-base-content">Artikel Terbaru</h2>
                <p class="text-base md:text-lg text-base-content/70">Wawasan dan tips seputar teknologi dan bisnis</p>
            </div>
            <!-- Horizontal Scrollable List -->
            <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-6 scrollbar-hide">
                <!-- 6 Placeholder Items + 1 Blur Item -->
                @for ($i = 1; $i <= 6; $i++)
                    <div class="card bg-base-100 border border-base-300 shadow-sm min-w-[280px] md:min-w-[320px] snap-center">
                    <figure class="px-4 pt-4">
                        <div class="rounded-xl bg-base-200 h-40 w-full animate-pulse"></div>
                    </figure>
                    <div class="card-body">
                        <div class="h-4 bg-base-200 rounded w-3/4 animate-pulse"></div>
                        <div class="h-3 bg-base-200 rounded w-full animate-pulse mt-2"></div>
                        <div class="h-3 bg-base-200 rounded w-2/3 animate-pulse mt-1"></div>
                    </div>
            </div>
            @endfor
            <!-- Last Item: Blur & See More -->
            <div class="card bg-base-100 border border-base-300 shadow-sm min-w-[280px] md:min-w-[320px] snap-center relative overflow-hidden group cursor-pointer">
                <div class="absolute inset-0 bg-base-100/60 backdrop-blur-sm z-10 flex items-center justify-center">
                    <a href="#" class="btn btn-primary">Lihat Lainnya</a>
                </div>
                <figure class="px-4 pt-4 blur-sm">
                    <div class="rounded-xl bg-base-200 h-40 w-full"></div>
                </figure>
                <div class="card-body blur-sm">
                    <div class="h-4 bg-base-200 rounded w-3/4"></div>
                    <div class="h-3 bg-base-200 rounded w-full mt-2"></div>
                    <div class="h-3 bg-base-200 rounded w-2/3 mt-1"></div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="contact">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <h2 class="text-3xl font-bold mb-8 text-center text-base-content">Hubungi Kami</h2>
            <div class="contact__grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Email -->
                <article class="contact__card">
                    <div class="flex items-center p-4">
                        <div class="contact__icon mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="contact__label">Email</span>
                            <a href="mailto:info@kuukok.test" class="contact__link">info@kuukok.test</a>
                        </div>
                    </div>
                </article>

                <!-- WhatsApp -->
                <article class="contact__card">
                    <div class="flex items-center p-4">
                        <div class="contact__icon mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 5.25V4.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="contact__label">WhatsApp</span>
                            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" class="contact__link">+62 812-3456-7890</a>
                        </div>
                    </div>
                </article>

                <!-- Instagram -->
                <article class="contact__card">
                    <div class="flex items-center p-4">
                        <div class="contact__icon mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.2c3.2 0 3.6 0 4.8.1a6.9 6.9 0 014.9 4.9c.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8a6.9 6.9 0 01-4.9 4.9c-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1a6.9 6.9 0 01-4.9-4.9C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8a6.9 6.9 0 014.9-4.9C8.4 2.2 8.8 2.2 12 2.2zm0 3a6.8 6.8 0 100 13.6 6.8 6.8 0 000-13.6zm0 2.4a4.4 4.4 0 11-4.4 4.4A4.4 4.4 0 0112 7.6z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="contact__label">Instagram</span>
                            <a href="https://ig.me/@username_instagram" target="_blank" rel="noopener" class="contact__link">@username_instagram</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    @include('components.footer')
</body>

</html>
