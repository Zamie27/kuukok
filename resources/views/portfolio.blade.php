<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', ['title' => 'Portfolio - Kuukok | Showcase Proyek Digital Terbaik'])
    <meta name="description" content="Lihat koleksi lengkap portfolio Kuukok. Dari web development, UI/UX design, hingga digital marketing solutions untuk berbagai industri.">
    <meta name="keywords" content="portfolio kuukok, web development portfolio, UI/UX design, digital solutions, project showcase">
</head>

<body class="bg-base-100 font-sans min-h-screen flex flex-col">

    @include('components.navbar')

    <!-- Breadcrumb & Header -->
    <div class="bg-base-200 px-4 pb-8 pt-24">
        <div class="mx-auto max-w-7xl">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary">Home</a></li>
                    <li>Portfolio</li>
                </ul>
            </div>
            <h1 class="mb-2 mt-4 text-4xl font-bold md:text-5xl text-base-content">Portfolio Kami</h1>
            <p class="text-lg text-base-content/70">
                Jelajahi koleksi proyek digital yang telah kami kerjakan dengan penuh dedikasi dan kreativitas
            </p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-base-100 px-4 py-8">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex flex-col items-center justify-between gap-4 md:flex-row">
                <!-- Filter Buttons -->
                <div class="flex flex-wrap justify-center gap-2 md:justify-start" id="portfolio-filters">
                    <button class="btn btn-primary btn-sm filter-btn" data-filter="all">
                        Semua <span class="badge badge-sm ml-1">12</span>
                    </button>
                    <button class="btn btn-outline btn-sm filter-btn" data-filter="web">
                        Web Development <span class="badge badge-sm ml-1">5</span>
                    </button>
                    <button class="btn btn-outline btn-sm filter-btn" data-filter="design">
                        UI/UX Design <span class="badge badge-sm ml-1">4</span>
                    </button>
                    <button class="btn btn-outline btn-sm filter-btn" data-filter="app">
                        Mobile App <span class="badge badge-sm ml-1">3</span>
                    </button>
                </div>

                <!-- Search/Sort -->
                <div class="form-control">
                    <div class="join">
                        <input type="text" placeholder="Cari project..." class="input input-bordered input-sm w-full max-w-xs join-item bg-base-100" />
                        <button class="btn btn-square btn-sm btn-primary join-item text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3" id="portfolio-grid">

                <!-- Project 1 (Web) -->
                <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 portfolio-item" data-category="web">
                    <figure class="relative h-56 overflow-hidden group">
                        <a href="#" class="block w-full h-full">
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
                        <h3 class="card-title mb-2 text-xl font-bold text-base-content">
                            <a href="#" class="hover:text-primary transition-colors">TokoOnline Indonesia</a>
                        </h3>
                        <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                            Platform e-commerce modern dengan fitur pembayaran lengkap dan manajemen inventaris real-time.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <div class="badge badge-ghost badge-sm">Laravel</div>
                            <div class="badge badge-ghost badge-sm">Vue.js</div>
                            <div class="badge badge-ghost badge-sm">MySQL</div>
                        </div>
                    </div>
                </div>

                <!-- Project 2 (Design) -->
                <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 portfolio-item" data-category="design">
                    <figure class="relative h-56 overflow-hidden group">
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
                        <h3 class="card-title mb-2 text-xl font-bold text-base-content">
                            <a href="{{ route('portfolio.show') }}" class="hover:text-primary transition-colors">FinTrack Mobile App</a>
                        </h3>
                        <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                            Desain antarmuka aplikasi manajemen keuangan pribadi dengan fokus pada kemudahan penggunaan.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <div class="badge badge-ghost badge-sm">Figma</div>
                            <div class="badge badge-ghost badge-sm">Prototyping</div>
                        </div>
                    </div>
                </div>

                <!-- Project 3 (App) -->
                <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 portfolio-item" data-category="app">
                    <figure class="relative h-56 overflow-hidden group">
                        <a href="#" class="block w-full h-full">
                            <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=800&auto=format&fit=crop" alt="Health Tracker" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/80 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <span class="btn btn-primary btn-sm w-full text-white pointer-events-none">Lihat Detail</span>
                            </div>
                        </a>
                    </figure>
                    <div class="card-body p-6">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="badge badge-accent badge-outline text-xs font-bold uppercase tracking-wide">Mobile App</span>
                            <span class="text-xs text-base-content/60">2024</span>
                        </div>
                        <h3 class="card-title mb-2 text-xl font-bold text-base-content">
                            <a href="#" class="hover:text-primary transition-colors">HealthFit Pro</a>
                        </h3>
                        <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                            Aplikasi pelacak kesehatan dan kebugaran dengan integrasi smartwatch dan AI coach.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <div class="badge badge-ghost badge-sm">Flutter</div>
                            <div class="badge badge-ghost badge-sm">Firebase</div>
                        </div>
                    </div>
                </div>

                <!-- Project 4 (Web) -->
                <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 portfolio-item" data-category="web">
                    <figure class="relative h-56 overflow-hidden group">
                        <a href="{{ route('portfolio.show') }}" class="block w-full h-full">
                            <img src="https://source.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=800&q=80" alt="Corporate Website" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/80 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <span class="btn btn-primary btn-sm w-full text-white pointer-events-none">Lihat Detail</span>
                            </div>
                        </a>
                    </figure>
                    <div class="card-body p-6">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="badge badge-primary badge-outline text-xs font-bold uppercase tracking-wide">Web Development</span>
                            <span class="text-xs text-base-content/60">2023</span>
                        </div>
                        <h3 class="card-title mb-2 text-xl font-bold text-base-content">
                            <a href="{{ route('portfolio.show') }}" class="hover:text-primary transition-colors">MegaCorp Profile</a>
                        </h3>
                        <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                            Website profil perusahaan multinasional dengan fitur investor relations dan karir.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <div class="badge badge-ghost badge-sm">Wordpress</div>
                            <div class="badge badge-ghost badge-sm">PHP</div>
                        </div>
                    </div>
                </div>

                <!-- Project 5 (Design) -->
                <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 portfolio-item" data-category="design">
                    <figure class="relative h-56 overflow-hidden group">
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
                        <h3 class="card-title mb-2 text-xl font-bold text-base-content">
                            <a href="#" class="hover:text-primary transition-colors">Analytics Dashboard</a>
                        </h3>
                        <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                            Redesign dashboard analitik untuk platform SaaS B2B dengan fokus pada visualisasi data.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <div class="badge badge-ghost badge-sm">Sketch</div>
                            <div class="badge badge-ghost badge-sm">Data Viz</div>
                        </div>
                    </div>
                </div>

                <!-- Project 6 (App) -->
                <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 portfolio-item" data-category="app">
                    <figure class="relative h-56 overflow-hidden group">
                        <a href="{{ route('portfolio.show') }}" class="block w-full h-full">
                            <img src="https://source.unsplash.com/photo-1526498460520-4c246339dccb?w=800&q=80" alt="Travel App" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/80 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <span class="btn btn-primary btn-sm w-full text-white pointer-events-none">Lihat Detail</span>
                            </div>
                        </a>
                    </figure>
                    <div class="card-body p-6">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="badge badge-accent badge-outline text-xs font-bold uppercase tracking-wide">Mobile App</span>
                            <span class="text-xs text-base-content/60">2023</span>
                        </div>
                        <h3 class="card-title mb-2 text-xl font-bold text-base-content">
                            <a href="{{ route('portfolio.show') }}" class="hover:text-primary transition-colors">Wanderlust Travel</a>
                        </h3>
                        <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                            Aplikasi booking travel dan itinerary planner untuk traveler mandiri.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <div class="badge badge-ghost badge-sm">React Native</div>
                            <div class="badge badge-ghost badge-sm">Maps API</div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center reveal-on-scroll">
                <div class="join">
                    <button class="join-item btn btn-disabled">«</button>
                    <button class="join-item btn btn-active btn-primary text-white">1</button>
                    <button class="join-item btn bg-base-100">2</button>
                    <button class="join-item btn bg-base-100">3</button>
                    <button class="join-item btn bg-base-100">4</button>
                    <button class="join-item btn bg-base-100">»</button>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-base-200 px-4 py-20 reveal-on-scroll">
        <div class="mx-auto max-w-5xl">
            <div class="card to-primary-focus bg-gradient-to-br from-primary text-white shadow-2xl">
                <div class="card-body py-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold md:text-4xl">
                        Punya Ide Proyek?
                    </h2>
                    <p class="mx-auto mb-6 max-w-2xl text-lg opacity-90">
                        Mari diskusikan bagaimana kami dapat membantu mewujudkan visi digital Anda
                    </p>
                    <div class="flex flex-col justify-center gap-4 sm:flex-row">
                        <a href="{{ route('home') }}#kontak" class="btn btn-accent btn-lg text-neutral font-bold border-none">
                            Hubungi Kami
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary hover:border-white">
                            Baca Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>

</html>
