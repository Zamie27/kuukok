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
    <section id="tentang-kami" class="relative bg-section-light">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 flex flex-col gap-12 md:gap-16 py-24 md:py-32">
            <!-- Title -->
            <div class="text-center space-y-3 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-base-content">Tentang Kami</h2>
                <p class="text-base md:text-lg text-base-content/70">Solusi digital profesional dengan fokus pada kualitas, konsistensi, dan hasil nyata</p>
            </div>

            <div class="divider"></div>

            <!-- Feature grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 reveal-on-scroll">
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
            <div class="reveal-on-scroll flex justify-center">
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
    <section id="portfolio" class="relative bg-section-secondary">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10 portfolio">
            <div class="text-center space-y-3 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-inherit">Portofolio</h2>
                <p class="text-base md:text-lg text-inherit opacity-90">Beberapa proyek terbaik yang telah kami kerjakan</p>
            </div>

            <div class="portfolio__grid reveal-on-scroll">
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80" alt="Corporate Website" loading="lazy">
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
                        <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80" alt="Brand Identity" loading="lazy">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">Design</div>
                        <h3 class="portfolio__title">Brand Identity</h3>
                        <p class="portfolio__desc">Logo, color palette, dan brand guideline lengkap.</p>
                        <div class="card-actions justify-end"><a href="#" class="portfolio__link">Lihat Detail →</a></div>
                    </div>
                </article>
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f7a07d?auto=format&fit=crop&w=800&q=80" alt="E-Commerce Platform" loading="lazy">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">Web App</div>
                        <h3 class="portfolio__title">E‑Commerce Platform</h3>
                        <p class="portfolio__desc">Toko online dengan payment gateway terintegrasi.</p>
                        <div class="card-actions justify-end"><a href="#" class="portfolio__link">Lihat Detail →</a></div>
                    </div>
                </article>
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80" alt="Mobile App UI/UX" loading="lazy">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">UI/UX</div>
                        <h3 class="portfolio__title">Mobile App UI/UX</h3>
                        <p class="portfolio__desc">Desain aplikasi mobile yang user‑friendly.</p>
                        <div class="card-actions justify-end"><a href="#" class="portfolio__link">Lihat Detail →</a></div>
                    </div>
                </article>
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80" alt="Dashboard Analytics" loading="lazy">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">Data Viz</div>
                        <h3 class="portfolio__title">Dashboard Analytics</h3>
                        <p class="portfolio__desc">Platform analitik dengan visualisasi data real‑time.</p>
                        <div class="card-actions justify-end"><a href="#" class="portfolio__link">Lihat Detail →</a></div>
                    </div>
                </article>
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        <img src="https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&w=800&q=80" alt="Social Media Content" loading="lazy">
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">Content</div>
                        <h3 class="portfolio__title">Social Media Content</h3>
                        <p class="portfolio__desc">Konten visual dan video marketing untuk sosmed.</p>
                        <div class="card-actions justify-end"><a href="#" class="portfolio__link">Lihat Detail →</a></div>
                    </div>
                </article>
            </div>
            <div class="flex justify-center">
                <a href="#" class="btn btn-outline btn-primary bg-base-100">Lihat Portofolio Lainnya →</a>
            </div>
        </div>
    </section>

    <!-- Harga -->
    <section id="pricing" class="relative bg-section-light">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10 pricing">
            <div class="text-center space-y-3 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-base-content">Paket & Layanan</h2>
                <p class="text-base md:text-lg text-base-content/70">Harga terjangkau dengan kualitas profesional untuk berbagai kebutuhan</p>
            </div>

            <div class="pricing__grid reveal-on-scroll">
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

    <!-- Artikel -->
    <section id="artikel" class="relative bg-section-light">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10">
            <div class="text-center space-y-3 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-base-content">Artikel Terbaru</h2>
                <p class="text-base md:text-lg text-base-content/70">Wawasan dan tips seputar teknologi dan bisnis</p>
            </div>
            <!-- Horizontal Scrollable List -->
            <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-6 scrollbar-hide reveal-on-scroll">
                <!-- Article 1 -->
                <article class="card bg-base-100 border border-base-300 shadow-sm min-w-[280px] md:min-w-[320px] snap-center hover:shadow-lg transition-shadow duration-300">
                    <figure class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=800&q=80" alt="SEO Strategy" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" loading="lazy">
                    </figure>
                    <div class="card-body p-6">
                        <div class="text-xs text-primary font-bold mb-2">10 Jan 2024</div>
                        <h3 class="card-title text-lg mb-2 text-base-content">Cara Meningkatkan Traffic Website dengan SEO</h3>
                        <p class="text-sm text-base-content/70 mb-4 line-clamp-3">Pelajari strategi SEO dasar hingga lanjut untuk mendatangkan pengunjung organik ke website Anda.</p>
                        <div class="card-actions">
                            <a href="{{ route('blog.index') }}" class="link link-primary no-underline text-sm font-semibold hover:underline">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </article>

                <!-- Article 2 -->
                <article class="card bg-base-100 border border-base-300 shadow-sm min-w-[280px] md:min-w-[320px] snap-center hover:shadow-lg transition-shadow duration-300">
                    <figure class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1626785774573-4b799312afc2?auto=format&fit=crop&w=800&q=80" alt="Graphic Design Trends" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" loading="lazy">
                    </figure>
                    <div class="card-body p-6">
                        <div class="text-xs text-primary font-bold mb-2">15 Jan 2024</div>
                        <h3 class="card-title text-lg mb-2 text-base-content">Tren Desain Grafis 2024 yang Wajib Diketahui</h3>
                        <p class="text-sm text-base-content/70 mb-4 line-clamp-3">Simak prediksi tren visual yang akan mendominasi industri kreatif tahun ini dan cara mengaplikasikannya.</p>
                        <div class="card-actions">
                            <a href="{{ route('blog.index') }}" class="link link-primary no-underline text-sm font-semibold hover:underline">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </article>

                <!-- Article 3 -->
                <article class="card bg-base-100 border border-base-300 shadow-sm min-w-[280px] md:min-w-[320px] snap-center hover:shadow-lg transition-shadow duration-300">
                    <figure class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80" alt="Branding for UMKM" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" loading="lazy">
                    </figure>
                    <div class="card-body p-6">
                        <div class="text-xs text-primary font-bold mb-2">20 Jan 2024</div>
                        <h3 class="card-title text-lg mb-2 text-base-content">Pentingnya Branding untuk UMKM</h3>
                        <p class="text-sm text-base-content/70 mb-4 line-clamp-3">Kenapa branding bukan hanya logo? Temukan jawabannya dan tips membangun brand yang kuat.</p>
                        <div class="card-actions">
                            <a href="{{ route('blog.index') }}" class="link link-primary no-underline text-sm font-semibold hover:underline">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </article>

                <!-- Article 4 -->
                <article class="card bg-base-100 border border-base-300 shadow-sm min-w-[280px] md:min-w-[320px] snap-center hover:shadow-lg transition-shadow duration-300">
                    <figure class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" alt="Web Development" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" loading="lazy">
                    </figure>
                    <div class="card-body p-6">
                        <div class="text-xs text-primary font-bold mb-2">25 Jan 2024</div>
                        <h3 class="card-title text-lg mb-2 text-base-content">Dasar-Dasar Web Development untuk Pemula</h3>
                        <p class="text-sm text-base-content/70 mb-4 line-clamp-3">Panduan lengkap memulai karir sebagai web developer, dari HTML, CSS, hingga JavaScript.</p>
                        <div class="card-actions">
                            <a href="{{ route('blog.index') }}" class="link link-primary no-underline text-sm font-semibold hover:underline">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </article>

                <!-- Last Item: See More -->
                <div class="card bg-base-100 border border-base-300 shadow-sm min-w-[280px] md:min-w-[320px] snap-center relative overflow-hidden group cursor-pointer flex items-center justify-center">
                    <div class="absolute inset-0 bg-base-200/50 backdrop-blur-sm z-0"></div>
                    <div class="relative z-10 text-center p-6">
                        <h3 class="text-xl font-bold text-base-content mb-4">Ingin membaca lebih banyak?</h3>
                        <a href="{{ route('blog.index') }}" class="btn btn-primary text-white rounded-full px-8">Lihat Semua Artikel</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="contact relative bg-section-secondary py-24 md:py-28">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="mx-auto mb-16 max-w-xl text-center reveal-on-scroll">
                <h2 class="mb-4 text-3xl font-bold text-base-content sm:text-4xl lg:text-5xl">
                    Hubungi Kami
                </h2>
                <p class="text-md font-medium text-base-content/70 md:text-lg">
                    Anda bisa hubungi kami dengan memasukan form dibawah ini atau anda
                    bisa mengunjungi sosial media saya untuk menghubungi saya.
                </p>
            </div>

            <form id="my-form" action="#" class="reveal-on-scroll">
                <div class="w-full lg:mx-auto lg:w-2/3">
                    <div class="mb-8 w-full">
                        <label for="name" class="text-base font-bold text-primary block mb-2">Nama</label>
                        <input name="Nama" type="text" id="name" class="input border-none w-full bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-500" />
                    </div>
                    <div class="mb-8 w-full">
                        <label for="email" class="text-base font-bold text-primary block mb-2">Email</label>
                        <input name="Email" type="email" id="email" class="input border-none w-full bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-500" />
                    </div>
                    <div class="mb-8 w-full">
                        <label for="massage" class="text-base font-bold text-primary block mb-2">Pesan</label>
                        <textarea name="Pesan" id="massage" class="textarea border-none w-full h-32 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-500"></textarea>
                    </div>
                    <div class="w-full">
                        <button type="submit" id="submit-button" class="btn btn-primary w-full rounded-full text-white font-semibold transition duration-500 hover:opacity-80 hover:shadow-lg">
                            Kirim
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('components.footer')
</body>

</html>
