<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', [
    'title' => 'Kuukok - Solusi Digital Profesional',
    'meta_description' => 'Kami membantu bisnis Anda tumbuh dengan layanan web development, desain grafis, dan penulisan konten berkualitas tinggi.'
    ])
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
                @foreach($portfolios as $portfolio)
                <article class="portfolio__card interactive-transition">
                    <div class="portfolio__image">
                        @if($portfolio->cover_image)
                        <img src="{{ asset('storage/'.$portfolio->cover_image) }}" alt="{{ $portfolio->title }}" loading="lazy">
                        @else
                        <div class="w-full h-full bg-neutral flex items-center justify-center text-neutral-content">No Image</div>
                        @endif
                        <div class="portfolio__overlay"></div>
                    </div>
                    <div class="portfolio__body">
                        <div class="portfolio__category">{{ $portfolio->tags[0] ?? 'Project' }}</div>
                        <h3 class="portfolio__title">{{ $portfolio->title }}</h3>
                        <p class="portfolio__desc">{{ $portfolio->excerpt }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('portfolio.show', $portfolio) }}" class="portfolio__link">Lihat Detail →</a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            <div class="flex justify-center">
                <a href="{{ route('portfolio.index') }}" class="btn btn-outline btn-primary bg-base-100">Lihat Portofolio Lainnya →</a>
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
                @foreach($packages as $package)
                <article class="pricing__card interactive-transition {{ $package->label === 'Paling Laris' || $package->label === 'Populer' ? 'pricing__card--recommended' : '' }}">
                    <div class="card-body space-y-4">
                        @if($package->label)
                        <div class="badge {{ $package->label === 'Paling Laris' || $package->label === 'Populer' ? 'badge-success' : 'badge-outline' }}">
                            {{ $package->label }}
                        </div>
                        @endif
                        <h3 class="text-xl font-semibold text-base-content">{{ $package->name }}</h3>
                        <div class="pricing__price">{{ $package->price_text }}</div>
                        {{-- <p class="text-xs text-base-content/60">per proyek</p> --}}

                        @if(is_array($package->features))
                        <ul class="text-sm text-base-content/70 space-y-2">
                            @foreach($package->features as $feature)
                            <li class="flex items-center gap-2">
                                <span class="text-primary">✓</span> {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        <a href="{{ $package->cta_link ?? '#kontak' }}" class="pricing__cta">Pesan Sekarang</a>
                    </div>
                </article>
                @endforeach
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
                    @foreach($testimonials as $testimonial)
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar overflow-hidden">
                                    @if($testimonial->photo)
                                    <img src="{{ asset('storage/'.$testimonial->photo) }}" class="w-full h-full object-cover" alt="Avatar">
                                    @else
                                    {{ substr($testimonial->display_name, 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <h3 class="testimoni__name">{{ $testimonial->display_name }}</h3>
                                    <p class="testimoni__role">{{ $testimonial->role }}</p>
                                    <p class="text-xs text-base-content/60">{{ $testimonial->created_at->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="testimoni__stars text-warning tracking-widest">
                                @for($i=0; $i<$testimonial->rating; $i++)★@endfor
                            </div>
                            <p class="testimoni__quote">"{{ $testimonial->content }}"</p>
                        </div>
                    </article>
                    @endforeach

                    <!-- Duplicate for infinite scroll -->
                    @foreach($testimonials as $testimonial)
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar overflow-hidden">
                                    @if($testimonial->photo)
                                    <img src="{{ asset('storage/'.$testimonial->photo) }}" class="w-full h-full object-cover" alt="Avatar">
                                    @else
                                    {{ substr($testimonial->display_name, 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <h3 class="testimoni__name">{{ $testimonial->display_name }}</h3>
                                    <p class="testimoni__role">{{ $testimonial->role }}</p>
                                    <p class="text-xs text-base-content/60">{{ $testimonial->created_at->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="testimoni__stars text-warning tracking-widest">
                                @for($i=0; $i<$testimonial->rating; $i++)★@endfor
                            </div>
                            <p class="testimoni__quote">"{{ $testimonial->content }}"</p>
                        </div>
                    </article>
                    @endforeach
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
