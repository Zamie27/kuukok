<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', ['title' => 'Blog - Kuukok | Tips, Tutorial & Insight Digital Marketing'])
    <meta name="description" content="Baca artikel, tips, dan tutorial seputar web development, design, dan digital marketing dari tim profesional Kuukok.">
    <meta name="keywords" content="blog kuukok, tutorial web development, tips design, digital marketing, UI/UX, TailwindCSS, DaisyUI">
    <meta name="author" content="Kuukok Creative Agency">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Blog - Kuukok | Tips & Tutorial Digital">
    <meta property="og:description" content="Baca artikel, tips, dan tutorial seputar web development, design, dan digital marketing.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('blog.index') }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Blog - Kuukok">
    <meta name="twitter:description" content="Tips, tutorial & insight seputar dunia digital.">
</head>

<body class="bg-base-100 font-sans min-h-screen flex flex-col">
    @include('components.navbar')

    <!-- Breadcrumb -->
    <div class="bg-base-200 px-4 pb-8 pt-24">
        <div class="mx-auto max-w-7xl">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary">Home</a></li>
                    <li>Blog</li>
                </ul>
            </div>
            <h1 class="mb-2 mt-4 text-4xl font-bold md:text-5xl text-base-content">Blog & Artikel</h1>
            <p class="text-lg text-base-content/70">
                Tips, tutorial, dan insight seputar dunia digital dan teknologi
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-base-100 px-4 py-12 flex-grow">
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Main Blog Content -->
                <div class="lg:col-span-2">
                    <!-- Featured Post -->
                    <div class="card bg-base-200 blog-card mb-8 shadow-2xl reveal-on-scroll">
                        <figure class="to-primary-dark h-80 overflow-hidden bg-gradient-to-br from-primary">
                            <div class="flex h-full w-full items-center justify-center text-8xl text-white">
                                🚀
                            </div>
                        </figure>
                        <div class="card-body">
                            <div class="mb-2 flex gap-2">
                                <div class="badge badge-primary">Featured</div>
                                <div class="badge badge-outline">Tutorial</div>
                            </div>
                            <h2 class="card-title text-2xl md:text-3xl text-base-content">
                                Panduan Lengkap Membuat Website Modern dengan TailwindCSS dan DaisyUI
                            </h2>
                            <div class="mb-4 flex items-center gap-4 text-sm text-base-content/70">
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    8 Desember 2025
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    10 menit baca
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Andi Pratama
                                </span>
                            </div>
                            <p class="mb-6 text-base-content/70">
                                Pelajari cara membuat website yang responsif, modern, dan profesional menggunakan framework TailwindCSS dan komponen library DaisyUI. Tutorial ini mencakup setup project, konfigurasi, dan best practices untuk development.
                            </p>
                            <div class="card-actions">
                                <a href="{{ route('blog.show') }}" class="btn btn-primary text-white">
                                    Baca Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Posts Grid -->
                    <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 reveal-on-scroll">
                        <!-- Blog Post 1 -->
                        <div class="card bg-base-200 blog-card shadow-xl">
                            <figure class="from-accent h-48 overflow-hidden bg-gradient-to-br to-yellow-600">
                                <div class="text-neutral flex h-full w-full items-center justify-center text-6xl">
                                    💡
                                </div>
                            </figure>
                            <div class="card-body">
                                <div class="badge badge-accent mb-2">Tips</div>
                                <h3 class="card-title text-lg text-base-content">
                                    10 Tips Desain UI/UX untuk Pemula
                                </h3>
                                <div class="mb-2 flex items-center gap-2 text-xs text-base-content/70">
                                    <span>7 Des 2025</span>
                                    <span>•</span>
                                    <span>7 menit</span>
                                </div>
                                <p class="text-sm text-base-content/70">
                                    Temukan prinsip-prinsip dasar desain UI/UX yang akan meningkatkan kualitas produk digital Anda...
                                </p>
                                <div class="card-actions mt-4">
                                    <a href="{{ route('blog.show') }}" class="btn btn-ghost btn-sm text-primary">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Blog Post 2 -->
                        <div class="card bg-base-200 blog-card shadow-xl">
                            <figure class="h-48 overflow-hidden bg-gradient-to-br from-secondary to-slate-700">
                                <div class="flex h-full w-full items-center justify-center text-6xl text-white">
                                    📊
                                </div>
                            </figure>
                            <div class="card-body">
                                <div class="badge badge-secondary mb-2">Insight</div>
                                <h3 class="card-title text-lg text-base-content">Tren Web Development 2025</h3>
                                <div class="mb-2 flex items-center gap-2 text-xs text-base-content/70">
                                    <span>5 Des 2025</span>
                                    <span>•</span>
                                    <span>6 menit</span>
                                </div>
                                <p class="text-sm text-base-content/70">
                                    Simak tren teknologi web terbaru yang akan mendominasi industri di tahun 2025...
                                </p>
                                <div class="card-actions mt-4">
                                    <a href="{{ route('blog.show') }}" class="btn btn-ghost btn-sm text-primary">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Blog Post 3 -->
                        <div class="card bg-base-200 blog-card shadow-xl">
                            <figure class="h-48 overflow-hidden bg-gradient-to-br from-primary to-blue-800">
                                <div class="flex h-full w-full items-center justify-center text-6xl text-white">
                                    🎨
                                </div>
                            </figure>
                            <div class="card-body">
                                <div class="badge badge-primary mb-2">Design</div>
                                <h3 class="card-title text-lg text-base-content">
                                    Cara Memilih Color Palette yang Tepat
                                </h3>
                                <div class="mb-2 flex items-center gap-2 text-xs text-base-content/70">
                                    <span>3 Des 2025</span>
                                    <span>•</span>
                                    <span>5 menit</span>
                                </div>
                                <p class="text-sm text-base-content/70">
                                    Panduan lengkap memilih kombinasi warna yang harmonis untuk website dan aplikasi Anda...
                                </p>
                                <div class="card-actions mt-4">
                                    <a href="{{ route('blog.show') }}" class="btn btn-ghost btn-sm text-primary">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Blog Post 4 -->
                        <div class="card bg-base-200 blog-card shadow-xl">
                            <figure class="from-accent h-48 overflow-hidden bg-gradient-to-br to-orange-500">
                                <div class="text-neutral flex h-full w-full items-center justify-center text-6xl">
                                    ⚡
                                </div>
                            </figure>
                            <div class="card-body">
                                <div class="badge badge-accent mb-2">Performance</div>
                                <h3 class="card-title text-lg text-base-content">
                                    Optimasi Loading Speed Website
                                </h3>
                                <div class="mb-2 flex items-center gap-2 text-xs text-base-content/70">
                                    <span>1 Des 2025</span>
                                    <span>•</span>
                                    <span>8 menit</span>
                                </div>
                                <p class="text-sm text-base-content/70">
                                    Teknik-teknik efektif untuk meningkatkan performa website Anda dan memberikan pengalaman terbaik...
                                </p>
                                <div class="card-actions mt-4">
                                    <a href="{{ route('blog.show') }}" class="btn btn-ghost btn-sm text-primary">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Blog Post 5 -->
                        <div class="card bg-base-200 blog-card shadow-xl">
                            <figure class="h-48 overflow-hidden bg-gradient-to-br from-secondary to-indigo-700">
                                <div class="flex h-full w-full items-center justify-center text-6xl text-white">
                                    🔒
                                </div>
                            </figure>
                            <div class="card-body">
                                <div class="badge badge-secondary mb-2">Security</div>
                                <h3 class="card-title text-lg text-base-content">
                                    Web Security Best Practices 2025
                                </h3>
                                <div class="mb-2 flex items-center gap-2 text-xs text-base-content/70">
                                    <span>28 Nov 2025</span>
                                    <span>•</span>
                                    <span>9 menit</span>
                                </div>
                                <p class="text-sm text-base-content/70">
                                    Pelajari cara mengamankan website Anda dari berbagai ancaman cyber...
                                </p>
                                <div class="card-actions mt-4">
                                    <a href="{{ route('blog.show') }}" class="btn btn-ghost btn-sm text-primary">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Blog Post 6 -->
                        <div class="card bg-base-200 blog-card shadow-xl">
                            <figure class="h-48 overflow-hidden bg-gradient-to-br from-primary to-cyan-600">
                                <div class="flex h-full w-full items-center justify-center text-6xl text-white">
                                    📱
                                </div>
                            </figure>
                            <div class="card-body">
                                <div class="badge badge-primary mb-2">Mobile</div>
                                <h3 class="card-title text-lg text-base-content">
                                    Mobile-First Design Strategy
                                </h3>
                                <div class="mb-2 flex items-center gap-2 text-xs text-base-content/70">
                                    <span>25 Nov 2025</span>
                                    <span>•</span>
                                    <span>6 menit</span>
                                </div>
                                <p class="text-sm text-base-content/70">
                                    Mengapa mobile-first approach penting dan bagaimana mengimplementasikannya...
                                </p>
                                <div class="card-actions mt-4">
                                    <a href="{{ route('blog.show') }}" class="btn btn-ghost btn-sm text-primary">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center reveal-on-scroll">
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

                <!-- Sidebar -->
                <div class="lg:col-span-1 reveal-on-scroll">
                    <div class="sticky top-24 space-y-6 self-start">
                        <!-- Search Box -->
                        <div class="card bg-base-200 shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title mb-4 text-lg text-base-content">Cari Artikel</h3>
                                <div class="form-control">
                                    <div class="join w-full">
                                        <input type="text" placeholder="Cari artikel..." class="input input-bordered join-item w-full bg-base-100" />
                                        <button class="btn btn-square btn-primary join-item text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="card bg-base-200 shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title mb-4 text-lg text-base-content">Kategori</h3>
                                <ul class="space-y-3">
                                    <li class="category-item">
                                        <a href="#" class="flex items-center justify-between hover:text-primary text-base-content/70 transition-colors">
                                            <span class="flex items-center gap-2">
                                                <div class="h-2 w-2 rounded-full bg-primary"></div>
                                                Tutorial
                                            </span>
                                            <span class="badge badge-sm">12</span>
                                        </a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="flex items-center justify-between hover:text-primary text-base-content/70 transition-colors">
                                            <span class="flex items-center gap-2">
                                                <div class="bg-accent h-2 w-2 rounded-full"></div>
                                                Tips & Tricks
                                            </span>
                                            <span class="badge badge-sm">8</span>
                                        </a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="flex items-center justify-between hover:text-primary text-base-content/70 transition-colors">
                                            <span class="flex items-center gap-2">
                                                <div class="h-2 w-2 rounded-full bg-secondary"></div>
                                                Insight
                                            </span>
                                            <span class="badge badge-sm">15</span>
                                        </a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="flex items-center justify-between hover:text-primary text-base-content/70 transition-colors">
                                            <span class="flex items-center gap-2">
                                                <div class="h-2 w-2 rounded-full bg-primary"></div>
                                                Web Development
                                            </span>
                                            <span class="badge badge-sm">20</span>
                                        </a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="flex items-center justify-between hover:text-primary text-base-content/70 transition-colors">
                                            <span class="flex items-center gap-2">
                                                <div class="bg-accent h-2 w-2 rounded-full"></div>
                                                UI/UX Design
                                            </span>
                                            <span class="badge badge-sm">10</span>
                                        </a>
                                    </li>
                                    <li class="category-item">
                                        <a href="#" class="flex items-center justify-between hover:text-primary text-base-content/70 transition-colors">
                                            <span class="flex items-center gap-2">
                                                <div class="h-2 w-2 rounded-full bg-secondary"></div>
                                                Digital Marketing
                                            </span>
                                            <span class="badge badge-sm">7</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recent Posts -->
                        <div class="card bg-base-200 shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title mb-4 text-lg text-base-content">Artikel Terbaru</h3>
                                <ul class="space-y-4">
                                    <li>
                                        <a href="{{ route('blog.show') }}" class="group flex gap-3">
                                            <div class="to-primary-focus flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-primary text-2xl text-white">
                                                🚀
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="line-clamp-2 text-sm font-semibold transition-colors group-hover:text-primary text-base-content">
                                                    Panduan TailwindCSS dan DaisyUI
                                                </h4>
                                                <p class="mt-1 text-xs text-base-content/70">8 Des 2025</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.show') }}" class="group flex gap-3">
                                            <div class="from-accent flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br to-yellow-600 text-2xl text-white">
                                                💡
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="line-clamp-2 text-sm font-semibold transition-colors group-hover:text-primary text-base-content">
                                                    10 Tips Desain UI/UX
                                                </h4>
                                                <p class="mt-1 text-xs text-base-content/70">7 Des 2025</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.show') }}" class="group flex gap-3">
                                            <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-secondary to-slate-700 text-2xl text-white">
                                                📊
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="line-clamp-2 text-sm font-semibold transition-colors group-hover:text-primary text-base-content">
                                                    Tren Web Development 2025
                                                </h4>
                                                <p class="mt-1 text-xs text-base-content/70">5 Des 2025</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.show') }}" class="group flex gap-3">
                                            <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-primary to-blue-800 text-2xl text-white">
                                                🎨
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="line-clamp-2 text-sm font-semibold transition-colors group-hover:text-primary text-base-content">
                                                    Memilih Color Palette
                                                </h4>
                                                <p class="mt-1 text-xs text-base-content/70">3 Des 2025</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="card bg-base-200 shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title mb-4 text-lg text-base-content">Tags Populer</h3>
                                <div class="flex flex-wrap gap-2">
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">TailwindCSS</a>
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">DaisyUI</a>
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">React</a>
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">UI/UX</a>
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">JavaScript</a>
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">CSS</a>
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">Design</a>
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">Frontend</a>
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">SEO</a>
                                    <a href="#" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300">Performance</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <a href="{{ route('home') }}#portfolio" class="btn btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary hover:border-white">
                            Lihat Portfolio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="btn btn-circle btn-primary fixed bottom-8 right-8 z-40 hidden shadow-lg text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <script>
        // Scroll to Top Visibility
        window.addEventListener('scroll', () => {
            const scrollBtn = document.getElementById('scrollToTop');
            if (window.scrollY > 300) {
                scrollBtn.classList.remove('hidden');
            } else {
                scrollBtn.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
