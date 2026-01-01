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
                    @if($posts->count() > 0)
                    @php
                    $featured = $posts->first();
                    $others = $posts->skip(1);
                    @endphp

                    <!-- Featured Post -->
                    <div class="card bg-base-200 blog-card mb-8 shadow-2xl reveal-on-scroll">
                        <figure class="to-primary-dark h-80 overflow-hidden bg-gradient-to-br from-primary relative">
                            @if($featured->cover_image)
                            <img src="{{ asset('storage/' . $featured->cover_image) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                            @else
                            <div class="flex h-full w-full items-center justify-center text-8xl text-white">
                                🚀
                            </div>
                            @endif
                        </figure>
                        <div class="card-body">
                            <div class="mb-2 flex gap-2">
                                <div class="badge badge-primary">Featured</div>
                                @if($featured->category)
                                <div class="badge badge-outline">{{ $featured->category }}</div>
                                @endif
                            </div>
                            <h2 class="card-title text-2xl md:text-3xl text-base-content">
                                {{ $featured->title }}
                            </h2>
                            <div class="mb-4 flex items-center gap-4 text-sm text-base-content/70">
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $featured->published_at?->translatedFormat('d F Y') ?? 'Draft' }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ ceil(str_word_count(strip_tags($featured->content)) / 200) }} menit baca
                                </span>
                                @if($featured->author)
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $featured->author->name }}
                                </span>
                                @endif
                            </div>
                            <p class="mb-6 text-base-content/70">
                                {{ Str::limit(strip_tags($featured->content), 150) }}
                            </p>
                            <div class="card-actions">
                                <a href="{{ route('blog.show', $featured) }}" class="btn btn-primary text-white">
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
                        @foreach($others as $post)
                        <div class="card bg-base-200 blog-card shadow-xl">
                            <figure class="h-48 overflow-hidden bg-gradient-to-br from-secondary to-slate-700 relative">
                                @if($post->cover_image)
                                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                                @else
                                <div class="flex h-full w-full items-center justify-center text-6xl text-white">
                                    📝
                                </div>
                                @endif
                            </figure>
                            <div class="card-body">
                                @if($post->category)
                                <div class="badge badge-secondary mb-2">{{ $post->category }}</div>
                                @endif
                                <h3 class="card-title text-lg text-base-content">
                                    {{ $post->title }}
                                </h3>
                                <div class="mb-2 flex items-center gap-2 text-xs text-base-content/70">
                                    <span>{{ $post->published_at?->translatedFormat('d M Y') }}</span>
                                    <span>•</span>
                                    <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} menit</span>
                                </div>
                                <p class="text-sm text-base-content/70">
                                    {{ Str::limit(strip_tags($post->content), 100) }}
                                </p>
                                <div class="card-actions mt-4">
                                    <a href="{{ route('blog.show', $post) }}" class="btn btn-ghost btn-sm text-primary">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center reveal-on-scroll">
                        {{ $posts->links() }}
                    </div>

                    @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">📭</div>
                        <h3 class="text-2xl font-bold mb-2">Belum ada artikel</h3>
                        <p class="text-base-content/70">Nantikan artikel menarik dari kami segera.</p>
                    </div>
                    @endif
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
                                    @foreach($categories as $cat)
                                    <li class="category-item">
                                        <a href="{{ route('blog.index', ['q' => $cat->category]) }}" class="flex items-center justify-between hover:text-primary text-base-content/70 transition-colors">
                                            <span class="flex items-center gap-2">
                                                <div class="h-2 w-2 rounded-full bg-primary"></div>
                                                {{ $cat->category }}
                                            </span>
                                            <span class="badge badge-sm">{{ $cat->total }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                    @if($categories->isEmpty())
                                    <li class="text-sm text-base-content/60 italic">Belum ada kategori</li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <!-- Recent Posts -->
                        <div class="card bg-base-200 shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title mb-4 text-lg text-base-content">Artikel Terbaru</h3>
                                <ul class="space-y-4">
                                    @foreach($recent_posts as $recent)
                                    <li>
                                        <a href="{{ route('blog.show', $recent) }}" class="group flex gap-3">
                                            <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-primary to-primary-focus overflow-hidden">
                                                @if($recent->cover_image)
                                                <img src="{{ asset('storage/' . $recent->cover_image) }}" alt="{{ $recent->title }}" class="w-full h-full object-cover" />
                                                @else
                                                <span class="text-2xl text-white">📝</span>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="line-clamp-2 text-sm font-semibold transition-colors group-hover:text-primary text-base-content">
                                                    {{ $recent->title }}
                                                </h4>
                                                <p class="mt-1 text-xs text-base-content/70">
                                                    {{ $recent->published_at?->translatedFormat('d M Y') }}
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="card bg-base-200 shadow-xl">
                            <div class="card-body">
                                <h3 class="card-title mb-4 text-lg text-base-content">Tags Populer</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($popular_tags as $tag => $count)
                                    <a href="{{ route('blog.index', array_merge(request()->query(), ['tag' => $tag])) }}" class="badge badge-lg hover:badge-primary transition-colors bg-base-100 border-base-300 {{ request('tag') == $tag ? 'badge-primary text-white' : '' }}">
                                        {{ $tag }}
                                        @if($count > 1)
                                        <span class="ml-1 text-xs opacity-70">({{ $count }})</span>
                                        @endif
                                    </a>
                                    @endforeach
                                    @if($popular_tags->isEmpty())
                                    <span class="text-sm text-base-content/60 italic">Belum ada tags</span>
                                    @endif
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
