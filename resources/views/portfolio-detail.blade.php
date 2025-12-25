<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', ['title' => 'Corporate Website Redesign - Portfolio Kuukok'])
    <meta name="description" content="Detail project Corporate Website Redesign. Platform website corporate modern dengan CMS terintegrasi.">

    <!-- Lightbox CSS (Minimal custom styles that can't be easily done with utility classes alone) -->
    <style>
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 90vh;
            object-fit: contain;
        }
    </style>
</head>

<body class="bg-base-100 font-sans min-h-screen flex flex-col">

    @include('components.navbar')

    <!-- Hero Section -->
    <div class="relative h-[60vh] min-h-[500px] w-full overflow-hidden bg-base-200">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1600&auto=format&fit=crop" alt="Corporate Website Project" class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-t from-base-100 via-base-100/50 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 flex h-full items-end pb-12 pt-32">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="max-w-4xl animate-fade-up">
                    <div class="mb-4 flex flex-wrap gap-2">
                        <span class="badge badge-primary badge-lg border-none text-white">Web Development</span>
                        <span class="badge badge-ghost badge-lg bg-base-100/50 backdrop-blur">2024</span>
                    </div>
                    <h1 class="mb-4 text-4xl font-bold leading-tight text-base-content md:text-5xl lg:text-6xl">
                        Corporate Website Redesign
                    </h1>
                    <p class="max-w-2xl text-lg text-base-content/80 md:text-xl">
                        Revamping corporate identity digital untuk perusahaan teknologi terkemuka dengan fokus pada user experience dan performa.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-16 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-3">

            <!-- Sidebar / Project Info -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-8 animate-fade-up" style="animation-delay: 0.1s;">
                    <!-- Project Stats -->
                    <div class="card bg-base-200 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title mb-4 text-lg text-base-content">Informasi Project</h3>

                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase text-base-content/60">Klien</p>
                                        <p class="font-medium text-base-content">TechCorp Indonesia</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase text-base-content/60">Layanan</p>
                                        <p class="font-medium text-base-content">UI/UX Design, Web Dev</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase text-base-content/60">Durasi</p>
                                        <p class="font-medium text-base-content">3 Bulan</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase text-base-content/60">Website</p>
                                        <a href="#" class="link link-primary font-medium">techcorp.id</a>
                                    </div>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <a href="#" class="btn btn-primary w-full text-white">Kunjungi Website</a>
                        </div>
                    </div>

                    <!-- Tech Stack -->
                    <div class="card bg-base-200 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title mb-4 text-lg text-base-content">Teknologi</h3>
                            <div class="flex flex-wrap gap-2">
                                <span class="badge badge-lg bg-base-100 p-3 hover:bg-primary hover:text-white transition-colors cursor-default">React</span>
                                <span class="badge badge-lg bg-base-100 p-3 hover:bg-primary hover:text-white transition-colors cursor-default">Next.js</span>
                                <span class="badge badge-lg bg-base-100 p-3 hover:bg-primary hover:text-white transition-colors cursor-default">TailwindCSS</span>
                                <span class="badge badge-lg bg-base-100 p-3 hover:bg-primary hover:text-white transition-colors cursor-default">TypeScript</span>
                                <span class="badge badge-lg bg-base-100 p-3 hover:bg-primary hover:text-white transition-colors cursor-default">Framer Motion</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Details -->
            <div class="lg:col-span-2">
                <div class="space-y-12 animate-fade-up" style="animation-delay: 0.2s;">

                    <!-- Overview -->
                    <section>
                        <h2 class="mb-6 text-2xl font-bold text-base-content">Tentang Project</h2>
                        <div class="prose prose-lg max-w-none text-base-content/80">
                            <p>
                                TechCorp Indonesia membutuhkan peremajaan total pada presence digital mereka. Website lama yang kaku dan lambat digantikan dengan platform modern yang dinamis, mencerminkan inovasi teknologi yang menjadi core business mereka.
                            </p>
                            <p>
                                Fokus utama redesign ini adalah meningkatkan engagement user, memperbaiki struktur navigasi, dan mengoptimalkan performa website untuk mencapai skor Core Web Vitals yang hijau.
                            </p>
                        </div>
                    </section>

                    <!-- Challenge & Solution Grid -->
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="card bg-base-200 border-l-4 border-error">
                            <div class="card-body">
                                <h3 class="card-title text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    Tantangan
                                </h3>
                                <ul class="list-disc list-outside ml-4 space-y-2 text-base-content/80">
                                    <li>Loading time website lama > 5 detik</li>
                                    <li>Navigasi yang membingungkan user</li>
                                    <li>Tidak mobile-friendly</li>
                                    <li>CMS sulit digunakan oleh tim marketing</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card bg-base-200 border-l-4 border-success">
                            <div class="card-body">
                                <h3 class="card-title text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Solusi
                                </h3>
                                <ul class="list-disc list-outside ml-4 space-y-2 text-base-content/80">
                                    <li>Migrasi ke Next.js untuk performa</li>
                                    <li>Redesign UI/UX dengan pendekatan user-centric</li>
                                    <li>Implementasi Responsive Design</li>
                                    <li>Custom CMS dengan Sanity.io</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery -->
                    <section>
                        <h2 class="mb-6 text-2xl font-bold text-base-content">Galeri Project</h2>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="group relative overflow-hidden rounded-xl bg-base-200 aspect-video cursor-pointer" onclick="openLightbox(0)">
                                <img src="https://source.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80" alt="Dashboard View" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition-opacity group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="group relative overflow-hidden rounded-xl bg-base-200 aspect-video cursor-pointer" onclick="openLightbox(1)">
                                <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=800&auto=format&fit=crop" alt="Mobile View" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition-opacity group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="group relative overflow-hidden rounded-xl bg-base-200 aspect-video cursor-pointer" onclick="openLightbox(2)">
                                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=800&auto=format&fit=crop" alt="Team Collaboration" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition-opacity group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="group relative overflow-hidden rounded-xl bg-base-200 aspect-video cursor-pointer" onclick="openLightbox(3)">
                                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=800&auto=format&fit=crop" alt="Coding Session" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition-opacity group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Key Results -->
                    <section>
                        <h2 class="mb-6 text-2xl font-bold text-base-content">Hasil & Dampak</h2>
                        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                            <div class="rounded-xl bg-base-200 p-6 text-center">
                                <div class="text-3xl font-bold text-primary mb-1">200%</div>
                                <div class="text-xs text-base-content/60 uppercase font-semibold">Traffic Increase</div>
                            </div>
                            <div class="rounded-xl bg-base-200 p-6 text-center">
                                <div class="text-3xl font-bold text-primary mb-1">0.8s</div>
                                <div class="text-xs text-base-content/60 uppercase font-semibold">Load Time</div>
                            </div>
                            <div class="rounded-xl bg-base-200 p-6 text-center">
                                <div class="text-3xl font-bold text-primary mb-1">45%</div>
                                <div class="text-xs text-base-content/60 uppercase font-semibold">Conversion Rate</div>
                            </div>
                            <div class="rounded-xl bg-base-200 p-6 text-center">
                                <div class="text-3xl font-bold text-primary mb-1">98</div>
                                <div class="text-xs text-base-content/60 uppercase font-semibold">SEO Score</div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

    <!-- Related Projects -->
    <div class="bg-base-100 py-16 border-t border-base-200">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-base-content">Project Terkait</h2>
                <a href="{{ route('portfolio.index') }}" class="btn btn-ghost btn-sm text-primary">Lihat Semua Project &rarr;</a>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Related Project 1 -->
                <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 portfolio-item">
                    <figure class="relative h-48 overflow-hidden group">
                        <a href="{{ route('portfolio.show') }}" class="block w-full h-full">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=800&auto=format&fit=crop" alt="E-Commerce Platform" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/80 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <span class="btn btn-primary btn-sm w-full text-white pointer-events-none">Lihat Detail</span>
                            </div>
                        </a>
                    </figure>
                    <div class="card-body p-6">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="badge badge-primary badge-outline text-xs font-bold uppercase tracking-wide">Web Development</span>
                            <span class="text-xs text-base-content/60">2024</span>
                        </div>
                        <h3 class="card-title mb-2 text-lg font-bold text-base-content">
                            <a href="{{ route('portfolio.show') }}" class="hover:text-primary transition-colors">TokoOnline Indonesia</a>
                        </h3>
                        <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                            Platform e-commerce modern dengan fitur pembayaran lengkap.
                        </p>
                    </div>
                </div>

                <!-- Related Project 2 -->
                <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 portfolio-item">
                    <figure class="relative h-48 overflow-hidden group">
                        <a href="{{ route('portfolio.show') }}" class="block w-full h-full">
                            <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=800&auto=format&fit=crop" alt="Finance App UI" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/80 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <span class="btn btn-primary btn-sm w-full text-white pointer-events-none">Lihat Detail</span>
                            </div>
                        </a>
                    </figure>
                    <div class="card-body p-6">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="badge badge-secondary badge-outline text-xs font-bold uppercase tracking-wide">UI/UX Design</span>
                            <span class="text-xs text-base-content/60">2023</span>
                        </div>
                        <h3 class="card-title mb-2 text-lg font-bold text-base-content">
                            <a href="{{ route('portfolio.show') }}" class="hover:text-primary transition-colors">FinTrack Mobile App</a>
                        </h3>
                        <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                            Desain antarmuka aplikasi manajemen keuangan pribadi.
                        </p>
                    </div>
                </div>

                <!-- Related Project 3 -->
                <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 portfolio-item">
                    <figure class="relative h-48 overflow-hidden group">
                        <a href="{{ route('portfolio.show') }}" class="block w-full h-full">
                            <img src="https://images.unsplash.com/photo-1586717791821-3f44a5638d4f?q=80&w=800&auto=format&fit=crop" alt="Dashboard UI" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/80 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <span class="btn btn-primary btn-sm w-full text-white pointer-events-none">Lihat Detail</span>
                            </div>
                        </a>
                    </figure>
                    <div class="card-body p-6">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="badge badge-secondary badge-outline text-xs font-bold uppercase tracking-wide">UI/UX Design</span>
                            <span class="text-xs text-base-content/60">2024</span>
                        </div>
                        <h3 class="card-title mb-2 text-lg font-bold text-base-content">
                            <a href="{{ route('portfolio.show') }}" class="hover:text-primary transition-colors">Analytics Dashboard</a>
                        </h3>
                        <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                            Redesign dashboard analitik untuk platform SaaS B2B.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA / Next Project -->
    <div class="bg-base-200 py-16">
        <div class="container mx-auto px-4 text-center lg:px-8">
            <h2 class="mb-8 text-3xl font-bold text-base-content">Tertarik dengan hasil seperti ini?</h2>
            <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('portfolio.index') }}" class="btn btn-outline">Lihat Portfolio Lain</a>
                <a href="{{ route('home') }}#kontak" class="btn btn-primary text-white">Mulai Project Anda</a>
            </div>
        </div>
    </div>

    @include('components.footer')

    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
        <span class="lightbox-close" onclick="closeLightbox(event)">&times;</span>
        <div class="lightbox-nav lightbox-prev" onclick="changeImage(-1, event)">&#10094;</div>
        <img id="lightbox-img" src="" alt="Lightbox Image">
        <div class="lightbox-nav lightbox-next" onclick="changeImage(1, event)">&#10095;</div>
    </div>

</body>

</html>
