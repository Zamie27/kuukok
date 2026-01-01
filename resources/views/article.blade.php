<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', [
    'title' => $post->meta_title ?? $post->title,
    'meta_description' => $post->meta_description ?? Str::limit(strip_tags($post->content), 150),
    'keywords' => $post->tags ? implode(', ', $post->tags) : null,
    'og_title' => $post->meta_title ?? $post->title,
    'og_description' => $post->meta_description ?? Str::limit(strip_tags($post->content), 150),
    'og_type' => 'article',
    'og_url' => route('blog.show', $post),
    'og_image' => $post->cover_image ? asset('storage/' . $post->cover_image) : null,
    'author' => $post->author->name ?? 'Kuukok'
    ])

    <!-- Syntax Highlighting -->
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
                <div class="badge badge-lg text-white border-none" style="background-color: var(--{{ $post->category_color ?? 'primary' }})">
                    {{ $post->category }}
                </div>
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
                        @if($post->author->profile && $post->author->profile->avatar)
                        <div class="w-10 rounded-full">
                            <img src="{{ Storage::url($post->author->profile->avatar) }}" alt="{{ $post->author->name }}" />
                        </div>
                        @else
                        <div class="w-10 rounded-full bg-gradient-to-br from-primary to-primary-focus flex items-center justify-center text-white font-bold text-sm">
                            {{ substr($post->author->name, 0, 2) }}
                        </div>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-base-content">{{ $post->author->name }}</p>
                        <p class="text-xs">{{ $post->author->profile->position ?? ucwords(str_replace('_', ' ', $post->author->role ?? 'Author')) }}</p>
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
                    @php
                        $totalSeconds = $post->total_seconds_read;
                        if ($totalSeconds > 3600) {
                            $hours = floor($totalSeconds / 3600);
                            $minutes = floor(($totalSeconds % 3600) / 60);
                            $timeText = "{$hours} Jam {$minutes} Menit dibaca";
                        } else {
                            $minutes = ceil($totalSeconds / 60);
                            $timeText = "{$minutes} Menit dibaca";
                        }
                    @endphp
                    <span>{{ $timeText }}</span>
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
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}"
                    target="_blank"
                    onclick="trackClick('share')"
                    class="btn btn-circle btn-sm btn-primary"
                    title="Share on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(route('blog.show', $post)) }}"
                    target="_blank"
                    onclick="trackClick('share')"
                    class="btn btn-circle btn-sm btn-info"
                    title="Share on Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                </a>
                <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . route('blog.show', $post)) }}"
                    target="_blank"
                    onclick="trackClick('whatsapp')"
                    class="btn btn-circle btn-sm btn-success"
                    title="Share on WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                    </svg>
                </a>
                <button x-data @click="
                    navigator.clipboard.writeText(window.location.href).then(() => {
                        alert('Link berhasil disalin!');
                        trackClick('share');
                    }).catch(err => {
                        console.error('Failed to copy: ', err);
                        alert('Gagal menyalin link.');
                    })
                "
                    class="btn btn-circle btn-sm btn-ghost bg-base-300 hover:bg-base-300/80"
                    title="Salin Link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </button>
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

                <!-- Sidebar (TOC) -->
                <div class="lg:col-span-1 order-2 lg:order-1 space-y-8">

                    <!-- Table of Contents -->
                    @if(count($post->toc) > 0)
                    <div class="card bg-base-200 shadow-xl sticky top-24">
                        <div class="card-body p-6">
                            <h3 class="font-bold text-lg mb-4 border-b border-base-300 pb-2">Daftar Isi</h3>
                            <nav>
                                <ul class="space-y-1 text-sm">
                                    @foreach($post->toc as $item)
                                    <li>
                                        <a href="#{{ $item['id'] }}"
                                            class="toc-link block border-l-4 border-transparent py-2 hover:border-base-content/30 hover:text-base-content transition-all duration-200 text-base-content/60 {{ $item['level'] === 'h3' ? 'pl-6 text-xs' : 'pl-3' }}"
                                            data-target="{{ $item['id'] }}">
                                            {{ $item['text'] }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Article Content -->
                <div class="lg:col-span-3 order-1 lg:order-2">
                    <div class="card bg-base-200 shadow-xl">
                        <div class="card-body article-content prose prose-lg max-w-none">
                            @if(!empty($post->content_blocks) && is_array($post->content_blocks))
                            @foreach($post->content_blocks as $block)
                            @switch($block['type'])
                            @case('paragraph')
                            <p class="mb-4">{{ $block['data']['text'] }}</p>
                            @break
                            @case('heading')
                            @php
                            $level = $block['data']['level'] ?? 'h2';
                            $text = $block['data']['text'];
                            $slug = \Illuminate\Support\Str::slug(strip_tags($text));
                            @endphp
                            <{{ $level }} id="{{ $slug }}" class="font-bold {{ $level === 'h2' ? 'text-2xl mt-8 mb-4' : 'text-xl mt-6 mb-3' }}">
                                {{ $text }}
                            </{{ $level }}>
                            @break
                            @case('quote')
                            <blockquote class="italic border-l-4 border-primary pl-4 my-6 bg-base-200/50 p-4 rounded-r-lg">
                                "{{ $block['data']['text'] }}"
                                @if(!empty($block['data']['cite']))
                                <cite class="block text-sm not-italic text-base-content/60 mt-2 font-semibold">— {{ $block['data']['cite'] }}</cite>
                                @endif
                            </blockquote>
                            @break
                            @case('code')
                            <div class="mockup-code my-6 bg-[#282c34] text-neutral-content p-0 overflow-hidden">
                                <pre class="p-0"><code class="language-{{ $block['data']['language'] ?? 'php' }} block p-4">{{ $block['data']['code'] }}</code></pre>
                            </div>
                            @break
                            @case('image')
                            <figure class="my-8 flex flex-col items-center w-full">
                                <img src="{{ $block['data']['url'] }}" alt="{{ $block['data']['caption'] ?? '' }}" class="rounded-xl shadow-lg w-full object-cover bg-base-200" loading="lazy">
                                @if(!empty($block['data']['caption']))
                                <figcaption class="text-center text-sm text-base-content/60 mt-2 italic w-full block">{{ $block['data']['caption'] }}</figcaption>
                                @endif
                            </figure>
                            @break
                            @case('alert')
                            @php
                            $alertType = $block['data']['type'] ?? 'info';
                            $alertClass = match($alertType) {
                                'success' => 'alert-success',
                                'warning' => 'alert-warning',
                                'error' => 'alert-error',
                                default => 'alert-info',
                            };
                            $alertIcon = match($alertType) {
                            'success' => '
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            'warning' => '
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />',
                            'error' => '
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            default => '
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            };
                            @endphp
                            <div role="alert" class="alert {{ $alertClass }} my-6 shadow-md text-start">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                                    {!! $alertIcon !!}
                                </svg>
                                <span>{{ $block['data']['text'] }}</span>
                            </div>
                            @break
                            @endswitch
                            @endforeach
                            @else
                            {!! $post->content !!}
                            @endif
                        </div>
                    </div>

                    <!-- Tags -->
                    @if($post->tags)
                    <div class="mt-8 flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                        <a href="{{ route('blog.index', ['q' => $tag]) }}" class="badge badge-lg badge-outline hover:badge-primary cursor-pointer transition-colors">#{{ $tag }}</a>
                        @endforeach
                    </div>
                    @endif

                    <!-- Author Bio (Footer) -->
                    @if($post->author)
                    <div class="mt-12 card bg-base-200 shadow-xl">
                        <div class="card-body">
                            <div class="flex flex-col sm:flex-row gap-6">
                                <!-- Avatar -->
                                <div class="flex-shrink-0">
                                    <div class="avatar">
                                        <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                            @if($post->author->profile && $post->author->profile->avatar)
                                            <img src="{{ asset('storage/' . $post->author->profile->avatar) }}" alt="{{ $post->author->name }}" />
                                            @else
                                            <div class="bg-neutral-focus text-neutral-content rounded-full w-full h-full flex items-center justify-center text-3xl font-bold">
                                                {{ $post->author->initials() }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="flex-grow">
                                    <h3 class="text-xl font-bold mb-1">Tentang Saya</h3>
                                    <div class="text-lg font-semibold text-primary">
                                        {{ $post->author->name }}
                                    </div>
                                    <div class="text-sm font-medium text-base-content/70 mb-4">
                                        {{ $post->author->profile->position ?? 'Writer' }}
                                    </div>

                                    <div class="prose prose-sm max-w-none mb-4 text-base-content/80">
                                        {!! $post->author->profile->about_me ?? $post->author->profile->bio ?? 'No biography available.' !!}
                                    </div>

                                    <!-- Social Links -->
                                    @if($post->author->profile && $post->author->profile->social_links)
                                    <div class="flex gap-4">
                                        @php
                                        $socials = is_string($post->author->profile->social_links) ? json_decode($post->author->profile->social_links, true) : $post->author->profile->social_links;
                                        @endphp
                                        @foreach($socials as $platform => $link)
                                        @if($link)
                                        <a href="{{ $link }}" target="_blank" rel="noopener noreferrer" class="btn btn-circle btn-sm btn-ghost hover:bg-base-300">
                                            @if(Str::contains($platform, 'github'))
                                            <!-- GitHub Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                            </svg>
                                            @elseif(Str::contains($platform, 'linkedin'))
                                            <!-- LinkedIn Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                            </svg>
                                            @elseif(Str::contains($platform, 'twitter') || Str::contains($platform, 'x'))
                                            <!-- Twitter/X Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                            </svg>
                                            @else
                                            <!-- Generic Link Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                            </svg>
                                            @endif
                                        </a>
                                        @endif
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Related Articles -->
                    @if($related_posts->count() > 0)
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold mb-6">Artikel Terkait</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($related_posts as $related)
                            <div class="card bg-base-200 blog-card shadow-xl hover:shadow-2xl transition-all duration-300">
                                <figure class="h-48 overflow-hidden bg-gradient-to-br from-secondary to-slate-700 relative">
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
                                    <div class="badge badge-secondary mb-2">{{ $related->category }}</div>
                                    @endif
                                    <h3 class="card-title text-lg text-base-content font-bold line-clamp-2">
                                        <a href="{{ route('blog.show', $related) }}" class="hover:text-primary transition-colors">
                                            {{ $related->title }}
                                        </a>
                                    </h3>
                                    <div class="mb-2 flex items-center gap-2 text-xs text-base-content/70">
                                        <span>{{ $related->published_at?->translatedFormat('d M Y') }}</span>
                                        <span>•</span>
                                        <span>{{ ceil(str_word_count(strip_tags($related->content)) / 200) }} menit</span>
                                    </div>
                                    <p class="text-sm text-base-content/70 line-clamp-3">
                                        {{ Str::limit(strip_tags($related->content), 100) }}
                                    </p>
                                    <div class="card-actions mt-4">
                                        <a href="{{ route('blog.show', $related) }}" class="btn btn-ghost btn-sm text-primary">
                                            Baca Selengkapnya →
                                        </a>
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
        // Reading Progress Bar
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progressBar").style.width = scrolled + "%";
        };

        // Track clicks
        function trackClick(type) {
            const route = "{{ route('blog.track', $post) }}";
            const data = { type: type };
            if (type === 'time') {
                data.seconds = 30; // Must match interval
            }
            fetch(route, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            }).catch(console.error);
        }

        // Track reading time every 30 seconds if page is visible
        setInterval(() => {
            if (document.visibilityState === 'visible') {
                trackClick('time');
            }
        }, 30000);
    </script>
    <!-- TOC Active State Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tocLinks = document.querySelectorAll('.toc-link');
            const headings = Array.from(tocLinks).map(link => {
                const id = link.getAttribute('data-target');
                return document.getElementById(id);
            }).filter(h => h);

            if (headings.length === 0) return;

            const callback = (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Remove active class from all
                        tocLinks.forEach(link => {
                            link.classList.remove('border-primary', 'text-primary', 'font-bold');
                            link.classList.add('border-transparent', 'text-base-content/60');
                        });

                        // Add active class to current
                        const activeLink = document.querySelector(`.toc-link[data-target="${entry.target.id}"]`);
                        if (activeLink) {
                            activeLink.classList.remove('border-transparent', 'text-base-content/60');
                            activeLink.classList.add('border-primary', 'text-primary', 'font-bold');
                        }
                    }
                });
            };

            const observer = new IntersectionObserver(callback, {
                rootMargin: '-100px 0px -60% 0px',
                threshold: 0
            });

            headings.forEach(heading => observer.observe(heading));
        });
    </script>
</body>

</html>
