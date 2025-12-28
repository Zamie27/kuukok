<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('components.head', [
    'title' => ($portfolio->meta_title ?: $portfolio->title) . ' - Portfolio Kuukok',
    'meta_description' => $portfolio->meta_description ?? Str::limit(strip_tags($portfolio->description), 160),
    'keywords' => is_array($portfolio->tags) ? implode(', ', $portfolio->tags) : 'portfolio, kuukok',
    'og_image' => $portfolio->cover_image ? asset('storage/'.$portfolio->cover_image) : null
    ])
</head>

<body class="bg-base-100 font-sans min-h-screen flex flex-col" x-data="{ lightboxOpen: false, lightboxImage: '' }">

    @include('components.navbar')

    <!-- Hero Section -->
    <div class="relative h-[60vh] min-h-[500px] w-full overflow-hidden bg-base-200">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            @if($portfolio->cover_image)
            <img src="{{ asset('storage/'.$portfolio->cover_image) }}" alt="{{ $portfolio->title }}" class="h-full w-full object-cover" />
            @else
            <div class="h-full w-full bg-neutral"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-base-100 via-base-100/50 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 flex h-full items-end pb-12 pt-32">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="max-w-4xl animate-fade-up">
                    <div class="mb-4 flex flex-wrap gap-2">
                        @if(!empty($portfolio->tags))
                        <span class="badge badge-primary badge-lg border-none text-white">{{ $portfolio->tags[0] }}</span>
                        @endif
                        <span class="badge badge-ghost badge-lg bg-base-100/50 backdrop-blur">{{ $portfolio->published_at ? $portfolio->published_at->year : $portfolio->created_at->year }}</span>
                    </div>
                    <h1 class="mb-4 text-4xl font-bold leading-tight text-base-content md:text-5xl lg:text-6xl">
                        {{ $portfolio->title }}
                    </h1>
                    @if($portfolio->excerpt)
                    <p class="max-w-2xl text-lg text-base-content/80 md:text-xl">
                        {{ $portfolio->excerpt }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-16 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-3">

            <!-- Sidebar / Project Info -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
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
                                        @if($portfolio->is_personal_project)
                                        <span class="badge badge-secondary badge-outline font-medium mt-0.5">Personal Project</span>
                                        @else
                                        <p class="font-medium text-base-content">{{ $portfolio->client_name ?? '-' }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase text-base-content/60">Timeline</p>
                                        <p class="font-medium text-base-content">{{ $portfolio->timeline_label }}</p>
                                        @if($portfolio->duration_label)
                                        <span class="text-xs text-base-content/70">({{ $portfolio->duration_label }})</span>
                                        @endif
                                    </div>
                                </div>

                                @if($portfolio->project_status)
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase text-base-content/60">Status</p>
                                        <div class="badge {{ $portfolio->project_status === 'Selesai' ? 'badge-success' : ($portfolio->project_status === 'Dalam Pengerjaan' ? 'badge-info' : 'badge-warning') }} badge-outline gap-2 mt-1">
                                            {{ $portfolio->project_status }}
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($portfolio->team_size || ($portfolio->teamMembers->count() > 0))
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase text-base-content/60">Tim</p>
                                        <p class="font-medium text-base-content">{{ $portfolio->team_size ?? $portfolio->teamMembers->count() }} Anggota</p>

                                        {{-- Display Roles (Manual Input) --}}
                                        @if(!empty($portfolio->project_roles))
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach($portfolio->project_roles as $role)
                                            <span class="badge badge-secondary badge-sm badge-outline">{{ $role }}</span>
                                            @endforeach
                                        </div>
                                        @endif

                                        {{-- Display Linked Members Roles if no manual roles --}}
                                        @if(empty($portfolio->project_roles) && $portfolio->teamMembers->count() > 0)
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach($portfolio->teamMembers->pluck('pivot.role')->filter()->unique() as $role)
                                            <span class="badge badge-secondary badge-sm badge-outline">{{ $role }}</span>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                @if(!empty($portfolio->tags))
                                <div class="flex items-start gap-3">
                                    <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase text-base-content/60">Tags / Layanan</p>
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach($portfolio->tags as $tag)
                                            <span class="badge badge-sm badge-ghost">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($portfolio->techStacks->count() > 0)
                                <div class="pt-2">
                                    <p class="text-xs font-semibold uppercase text-base-content/60 mb-2">Tech Stack</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($portfolio->techStacks as $stack)
                                        <div class="tooltip" data-tip="{{ $stack->name }}">
                                            <div class="w-8 h-8 rounded-full bg-base-100 border border-base-300 flex items-center justify-center p-1.5 shadow-sm">
                                                @if($stack->logo)
                                                <img src="{{ asset('storage/'.$stack->logo) }}" alt="{{ $stack->name }}" class="w-full h-full object-contain">
                                                @else
                                                <span class="text-[10px] font-bold">{{ substr($stack->name, 0, 2) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if($portfolio->live_demo_link)
                                <div class="pt-4">
                                    <a href="{{ $portfolio->live_demo_link }}" target="_blank" class="btn btn-primary btn-block text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        Lihat Live Demo
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Share -->
                    <div class="card bg-base-100 border border-base-200">
                        <div class="card-body p-4">
                            <p class="text-sm font-semibold text-base-content/70 mb-2">Bagikan:</p>
                            <div class="flex gap-2">
                                <a href="https://wa.me/?text={{ urlencode($portfolio->title . ' ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-circle btn-ghost text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($portfolio->title) }}" target="_blank" class="btn btn-sm btn-circle btn-ghost">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Description -->
                <div class="prose prose-lg max-w-none prose-img:rounded-xl">
                    {!! nl2br(e($portfolio->description)) !!}
                </div>

                <!-- Gallery Grid -->
                @if(!empty($portfolio->gallery))
                <div>
                    <h2 class="text-2xl font-bold mb-6">Gallery</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($portfolio->gallery as $image)
                        <div class="relative group overflow-hidden rounded-xl cursor-pointer"
                            @click="lightboxOpen = true; lightboxImage = '{{ asset('storage/'.$image) }}'">
                            <img src="{{ asset('storage/'.$image) }}" alt="Gallery Image" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                </svg>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- CTA -->
                <div class="card bg-primary text-primary-content mt-12">
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-2xl">Tertarik membuat project serupa?</h3>
                        <p>Konsultasikan kebutuhan digital bisnis Anda bersama tim kami.</p>
                        <div class="card-actions justify-end mt-4">
                            <a href="{{ route('contact.index') }}" class="btn btn-secondary text-white">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('components.footer')

    <!-- Lightbox Modal -->
    <div x-show="lightboxOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/95 p-4"
        style="display: none;">

        <button @click="lightboxOpen = false" class="absolute top-4 right-4 text-white hover:text-gray-300 z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div @click.outside="lightboxOpen = false" class="relative max-w-full max-h-full">
            <img :src="lightboxImage" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl" alt="Full size image">
        </div>
    </div>

</body>

</html>
