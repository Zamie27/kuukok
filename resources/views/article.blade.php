<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', ['title' => $post->meta_title ?? $post->title])
    <meta name="description" content="{{ $post->meta_description ?? Str::limit(strip_tags($post->content), 150) }}">
    <meta name="keywords" content="{{ $post->tags ? implode(', ', $post->tags) : '' }}">
    <meta name="author" content="{{ $post->author->name ?? 'Kuukok' }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $post->meta_title ?? $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?? Str::limit(strip_tags($post->content), 150) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ route('blog.show', $post) }}">
    @if($post->cover_image)
    <meta property="og:image" content="{{ asset('storage/' . $post->cover_image) }}">
    @endif

    <!-- Syntax Highlighting (for code blocks) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        hljs.highlightAll();
    </script>
</head>

<body class="bg-base-100 font-sans min-h-screen">

    <!-- Reading Progress Bar -->
    <div class="progress-bar fixed top-0 left-0 h-1 bg-primary z-50 w-0 transition-all duration-100" id="progressBar"></div>

    @include('components.navbar')

    <!-- Breadcrumb -->
    <div class="pt-24 pb-4 px-4 bg-base-200">
        <div class="max-w-7xl mx-auto">
            <div class="text-sm breadcrumbs">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary">Home</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-primary">Blog</a></li>
                    <li class="line-clamp-1 max-w-xs">{{ $post->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Article Header -->
    <div class="py-8 px-4 bg-base-200">
        <div class="max-w-4xl mx-auto">
            <!-- Category Badge -->
            <div class="flex gap-2 mb-4">
                @if($post->category)
                <div class="badge badge-primary badge-lg">{{ $post->category }}</div>
                @endif
                <div class="badge badge-outline badge-lg">Article</div>
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-6 text-base-content/70 mb-6">
                @if($post->author)
                <div class="flex items-center gap-2">
                    <div class="avatar">
                        <div class="w-10 rounded-full bg-gradient-to-br from-primary to-primary-focus flex items-center justify-center text-white font-bold text-sm">
                            {{ substr($post->author->name, 0, 2) }}
                        </div>
                    </div>
                    <div>
                        <p class="font-semibold text-base-content">{{ $post->author->name }}</p>
                        <p class="text-xs">Author</p>
                    </div>
                </div>
                @endif
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $post->published_at?->translatedFormat('d F Y') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} menit baca</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span>{{ $post->views }} views</span>
                </div>
            </div>

            <!-- Share Buttons -->
            <div class="flex gap-2 mb-6">
                <!-- Simple share buttons (could be improved with real sharing logic later) -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" target="_blank" class="btn btn-circle btn-sm btn-primary" title="Share on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(route('blog.show', $post)) }}" target="_blank" class="btn btn-circle btn-sm btn-info" title="Share on Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                </a>
                <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . route('blog.show', $post)) }}" target="_blank" class="btn btn-circle btn-sm btn-success" title="Share on WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    @if($post->cover_image)
    <div class="px-4 bg-base-200 pb-8">
        <div class="max-w-4xl mx-auto">
            <figure class="rounded-2xl overflow-hidden shadow-2xl h-96 relative">
                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover" />
            </figure>
            @if($post->excerpt)
            <p class="text-center text-sm text-base-content/60 mt-4 italic">
                {{ $post->excerpt }}
            </p>
            @endif
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <div class="py-12 px-4 bg-base-100">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Sidebar (Recent Posts) -->
                <div class="lg:col-span-1 order-2 lg:order-1">
                    <div class="card bg-base-200 shadow-xl sticky top-24">
                        <div class="card-body p-6">
                            <h3 class="font-bold text-lg mb-4 border-b border-base-300 pb-2">Artikel Terbaru</h3>
                            <ul class="space-y-4">
                                @foreach($recent_posts as $recent)
                                <li>
                                    <a href="{{ route('blog.show', $recent) }}" class="group block">
                                        <h4 class="text-sm font-semibold group-hover:text-primary transition-colors line-clamp-2 mb-1">
                                            {{ $recent->title }}
                                        </h4>
                                        <span class="text-xs text-base-content/60">{{ $recent->published_at?->translatedFormat('d M Y') }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="lg:col-span-3 order-1 lg:order-2">
                    <div class="card bg-base-200 shadow-xl">
                        <div class="card-body article-content prose prose-lg max-w-none">
                            {!! $post->content !!}
                        </div>
                    </div>

                    <!-- Related Articles -->
                    @if($related_posts->count() > 0)
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold mb-6">Artikel Terkait</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($related_posts as $related)
                            <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                                <figure class="h-48 overflow-hidden bg-gradient-to-br from-primary to-primary-focus relative">
                                    @if($related->cover_image)
                                    <img src="{{ asset('storage/' . $related->cover_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-6xl text-white">
                                        📝
                                    </div>
                                    @endif
                                </figure>
                                <div class="card-body">
                                    @if($related->category)
                                    <div class="badge badge-accent mb-2">{{ $related->category }}</div>
                                    @endif
                                    <h3 class="card-title text-lg">{{ $related->title }}</h3>
                                    <p class="text-sm text-base-content/60 line-clamp-2">
                                        {{ Str::limit(strip_tags($related->content), 100) }}
                                    </p>
                                    <div class="card-actions mt-4">
                                        <a href="{{ route('blog.show', $related) }}" class="btn btn-ghost btn-sm">Baca Artikel →</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    @include('components.footer')

    <script>
        // Progress Bar
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progressBar").style.width = scrolled + "%";
        };
    </script>
</body>

</html>
