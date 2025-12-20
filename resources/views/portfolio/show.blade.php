<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        @include('partials.head')
        @if ($portfolio->meta_description)
            <meta name="description" content="{{ e($portfolio->meta_description) }}">
        @endif
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
                    <li><a href="{{ route('portfolio.index') }}" class="hover:text-primary">Portfolio</a></li>
                </ul>
            </div>
            <div class="navbar-end gap-2">
                <button type="button" id="themeToggleBtn" class="btn btn-ghost btn-circle" aria-label="Toggle theme">
                    <svg id="iconSun" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.64 17l-.71.71a1 1 0 0 0 0 1.41 1 1 0 0 0 1.41 0l.71-.71A1 1 0 0 0 5.64 17ZM5 12a1 1 0 0 0-1-1H3a1 1 0 0 0 0 2H4a1 1 0 0 0 1-1Zm7-7a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0V4a1 1 0 0 0 1 1ZM5.64 7.05a1 1 0 0 0 .7.29 1 1 0 0 0 .71-.29 1 1 0 0 0 0-1.41l-.71-.71A1 1 0 0 0 4.93 6.34Zm12 .29a1 1 0 0 0 .7-.29l.71-.71a1 1 0 1 0-1.41-1.41L17 5.64a1 1 0 0 0 0 1.41 1 1 0 0 0 .66.29ZM21 11H20a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2Zm-9 8a1 1 0 0 0-1 1v1a1 1 0 0 0 2 0V20a1 1 0 0 0-1-1ZM18.36 17A1 1 0 0 0 17 18.36l.71.71a1 1 0 0 0 1.41 0 1 1 0 0 0 0-1.41ZM12 6.5A5.5 5.5 0 1 0 17.5 12 5.51 5.51 0 0 0 12 6.5Zm0 9A3.5 3.5 0 1 1 15.5 12 3.5 3.5 0 0 1 12 15.5Z"/></svg>
                </button>
            </div>
        </nav>

        <!-- Breadcrumb -->
        <section class="pt-24 pb-4 px-4 bg-base-200">
            <div class="mx-auto max-w-7xl">
                <div class="breadcrumbs text-sm">
                    <ul>
                        <li><a href="{{ route('home') }}" class="text-primary">Home</a></li>
                        <li><a href="{{ route('portfolio.index') }}" class="text-primary">Portfolio</a></li>
                        <li>{{ e($portfolio->title) }}</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Detail -->
        <section class="px-4 py-8">
            <div class="mx-auto max-w-5xl">
                <article class="prose prose-zinc dark:prose-invert max-w-none">
                    <h1 class="mb-2">{{ e($portfolio->title) }}</h1>
                    @if ($portfolio->cover_image)
                        <img src="{{ asset('storage/' . $portfolio->cover_image) }}" alt="{{ e($portfolio->title) }} cover" class="w-full rounded-lg mb-6" />
                    @endif
                    @if ($portfolio->excerpt)
                        <p class="text-secondary">{{ e($portfolio->excerpt) }}</p>
                    @endif
                    @if ($portfolio->description)
                        <div class="mt-4">
                            {!! nl2br(e($portfolio->description)) !!}
                        </div>
                    @endif
                </article>

                @if (!empty($portfolio->gallery))
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold mb-3">Galeri</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($portfolio->gallery as $path)
                                <div class="bg-base-200 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $path) }}" alt="Gallery image" class="w-full h-40 object-cover" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (!empty($portfolio->tags))
                    <div class="mt-6 flex gap-2">
                        @foreach ($portfolio->tags as $tag)
                            <span class="badge badge-outline">{{ e($tag) }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        @vite(['resources/js/app.js'])
    </body>
</html>
