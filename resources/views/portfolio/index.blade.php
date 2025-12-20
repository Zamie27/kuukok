<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        @include('partials.head')
        <meta name="description" content="Daftar portfolio Kuukok yang telah dipublikasikan.">
    </head>
    <body class="bg-base-100 min-h-screen">
        <!-- Navbar -->
        <nav class="navbar bg-base-200 fixed top-0 z-50 bg-opacity-90 shadow-lg backdrop-blur-lg">
            <div class="navbar-start">
                <a href="{{ route('home') }}" class="btn btn-ghost text-xl font-bold text-primary">{{ config('app.name') }}</a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">Home</a></li>
                    <li><a href="{{ route('portfolio.index') }}" class="text-primary font-semibold">Portfolio</a></li>
                </ul>
            </div>
            <div class="navbar-end gap-2">
                <!-- Theme toggle using localStorage 'kuukok-theme' handled in app.js -->
                <button type="button" id="themeToggleBtn" class="btn btn-ghost btn-circle" aria-label="Toggle theme">
                    <svg id="iconSun" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.64 17l-.71.71a1 1 0 0 0 0 1.41 1 1 0 0 0 1.41 0l.71-.71A1 1 0 0 0 5.64 17ZM5 12a1 1 0 0 0-1-1H3a1 1 0 0 0 0 2H4a1 1 0 0 0 1-1Zm7-7a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0V4a1 1 0 0 0 1 1ZM5.64 7.05a1 1 0 0 0 .7.29 1 1 0 0 0 .71-.29 1 1 0 0 0 0-1.41l-.71-.71A1 1 0 0 0 4.93 6.34Zm12 .29a1 1 0 0 0 .7-.29l.71-.71a1 1 0 1 0-1.41-1.41L17 5.64a1 1 0 0 0 0 1.41 1 1 0 0 0 .66.29ZM21 11H20a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2Zm-9 8a1 1 0 0 0-1 1v1a1 1 0 0 0 2 0V20a1 1 0 0 0-1-1ZM18.36 17A1 1 0 0 0 17 18.36l.71.71a1 1 0 0 0 1.41 0 1 1 0 0 0 0-1.41ZM12 6.5A5.5 5.5 0 1 0 17.5 12 5.51 5.51 0 0 0 12 6.5Zm0 9A3.5 3.5 0 1 1 15.5 12 3.5 3.5 0 0 1 12 15.5Z"/></svg>
                </button>
            </div>
        </nav>

        <!-- Header -->
        <section class="pt-24 pb-6 px-4 bg-base-200">
            <div class="mx-auto max-w-7xl">
                <div class="breadcrumbs text-sm">
                    <ul>
                        <li><a href="{{ route('home') }}" class="text-primary">Home</a></li>
                        <li>Portfolio</li>
                    </ul>
                </div>
                <div class="text-center mt-8">
                    <h1 class="text-4xl md:text-5xl font-bold mb-3">Portfolio Kami</h1>
                    <p class="text-lg text-secondary max-w-3xl mx-auto">Jelajahi proyek digital yang kami publikasikan.</p>
                </div>
            </div>
        </section>

        <!-- Search -->
        <section class="px-4 py-6 bg-base-100">
            <div class="mx-auto max-w-7xl">
                <form action="{{ route('portfolio.index') }}" method="get" class="flex gap-2">
                    <input type="text" name="q" value="{{ e($search) }}" placeholder="Cari portfolio..." class="input input-bordered w-full" />
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </section>

        <!-- Portfolio Grid -->
        <section class="px-4 py-8">
            <div class="mx-auto max-w-7xl">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($portfolios as $item)
                        <article class="card bg-base-200 shadow hover:shadow-xl transition-all">
                            @if ($item->cover_image)
                                <figure class="h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ e($item->title) }} cover" class="w-full h-full object-cover" />
                                </figure>
                            @endif
                            <div class="card-body">
                                <h2 class="card-title"><a href="{{ route('portfolio.show', $item) }}" class="hover:text-primary">{{ e($item->title) }}</a></h2>
                                @if ($item->excerpt)
                                    <p class="text-secondary">{{ e($item->excerpt) }}</p>
                                @endif
                                <div class="flex gap-2 mt-3">
                                    @foreach ((array) $item->tags as $tag)
                                        <span class="badge badge-outline">{{ e($tag) }}</span>
                                    @endforeach
                                </div>
                                <div class="card-actions justify-end mt-4">
                                    <a href="{{ route('portfolio.show', $item) }}" class="btn btn-outline">Detail</a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full">
                            <div class="alert">Tidak ada portfolio yang ditemukan.</div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $portfolios->links() }}
                </div>
            </div>
        </section>

        @vite(['resources/js/app.js'])
    </body>
</html>
