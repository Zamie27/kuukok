<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', [
        'title' => $title ?? 'Portfolio - Kuukok',
        'meta_description' => 'Lihat koleksi lengkap portfolio Kuukok. Dari web development, UI/UX design, hingga digital marketing solutions.',
        'keywords' => 'portfolio kuukok, web development portfolio, UI/UX design, digital solutions, project showcase'
    ])
</head>

<body class="bg-base-100 font-sans min-h-screen flex flex-col">

    @include('components.navbar')

    <!-- Breadcrumb & Header -->
    <div class="bg-base-200 px-4 pb-8 pt-24">
        <div class="mx-auto max-w-7xl">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary hover:underline">Home</a></li>
                    <li>Portfolio</li>
                </ul>
            </div>
            <h1 class="mb-2 mt-4 text-4xl font-bold md:text-5xl text-base-content">Portfolio Kami</h1>
            <p class="text-lg text-base-content/70">
                Jelajahi koleksi proyek digital yang telah kami kerjakan dengan penuh dedikasi dan kreativitas
            </p>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-base-100 px-4 py-8">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex flex-col items-center justify-between gap-4 md:flex-row">
                <!-- Search -->
                <div class="form-control w-full md:w-auto">
                    <form action="{{ route('portfolio.index') }}" method="GET">
                        <div class="join w-full">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari project..." class="input input-bordered input-sm w-full max-w-xs join-item bg-base-100" />
                            <button type="submit" class="btn btn-square btn-sm btn-primary join-item text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Portfolio Grid -->
            @if($portfolios->count() > 0)
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($portfolios as $item)
                    <div class="card bg-base-100 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl border border-base-200 group">
                        <figure class="relative h-56 overflow-hidden">
                            <a href="{{ route('portfolio.show', $item) }}" class="block w-full h-full">
                                @if($item->cover_image)
                                    <img src="{{ asset('storage/'.$item->cover_image) }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                @else
                                    <div class="h-full w-full bg-base-300 flex items-center justify-center text-base-content/50">
                                        No Image
                                    </div>
                                @endif
                                <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/80 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                    <span class="btn btn-primary btn-sm w-full text-white pointer-events-none">Lihat Detail</span>
                                </div>
                            </a>
                        </figure>
                        <div class="card-body p-6">
                            <div class="mb-2 flex items-center justify-between">
                                <span class="badge badge-primary badge-outline text-xs font-bold uppercase tracking-wide">
                                    {{ $item->tags[0] ?? 'Project' }}
                                </span>
                                <span class="text-xs text-base-content/60">{{ $item->published_at ? $item->published_at->year : $item->created_at->year }}</span>
                            </div>
                            <h3 class="card-title mb-2 text-xl font-bold text-base-content">
                                <a href="{{ route('portfolio.show', $item) }}" class="hover:text-primary transition-colors">{{ $item->title }}</a>
                            </h3>
                            <p class="mb-4 line-clamp-2 text-sm text-base-content/70">
                                {{ $item->excerpt ?? Str::limit(strip_tags($item->description), 100) }}
                            </p>
                            @if(!empty($item->tags))
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($item->tags, 0, 3) as $tag)
                                    <div class="badge badge-ghost badge-sm">{{ $tag }}</div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $portfolios->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <h3 class="text-lg font-semibold text-base-content">Belum ada portfolio ditemukan.</h3>
                    <p class="text-base-content/60">Silakan coba kata kunci lain atau kembali lagi nanti.</p>
                </div>
            @endif
        </div>
    </div>

    @include('components.footer')

</body>
</html>
