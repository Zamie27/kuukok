<x-layouts.admin title="Admin Dashboard">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-title">Total Artikel</div>
                            <div class="stat-value text-primary">{{ $stats['posts'] }}</div>
                            <div class="stat-desc">Semua status</div>
                        </div>
                        <div class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-title">Total Portfolio</div>
                            <div class="stat-value text-secondary">{{ $stats['portfolios'] }}</div>
                            <div class="stat-desc">Karya terpublikasi</div>
                        </div>
                        <div class="text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-title">Pesan Baru</div>
                            <div class="stat-value text-accent">{{ $stats['messages_unread'] }}</div>
                            <div class="stat-desc">Belum dibaca</div>
                        </div>
                        <div class="text-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Widgets -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Popular Posts -->
            <div class="card bg-base-100 shadow-xl h-full">
                <div class="card-body p-4">
                    <h2 class="card-title text-lg mb-4 flex justify-between">
                        Artikel Populer
                        <a href="{{ route('admin.posts.index') }}" class="text-xs font-normal text-primary">View All</a>
                    </h2>
                    <div class="overflow-y-auto max-h-80">
                        <ul class="space-y-3">
                            @forelse($popularPosts as $post)
                            <li class="flex items-start gap-3 p-2 hover:bg-base-200 rounded-lg transition-colors">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium truncate">{{ $post->title }}</p>
                                    <p class="text-xs text-base-content/60">{{ $post->views }} views • {{ $post->created_at->format('d M') }}</p>
                                </div>
                                <a href="{{ route('blog.show', $post) }}" target="_blank" class="btn btn-ghost btn-xs btn-square">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </li>
                            @empty
                            <li class="text-center py-4 text-base-content/50 text-sm">Belum ada data view artikel.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="card bg-base-100 shadow-xl h-full">
                <div class="card-body p-4">
                    <h2 class="card-title text-lg mb-4 flex justify-between items-center">
                        Pesan Masuk
                        <a href="{{ route('admin.messages.index') }}" class="text-xs font-normal text-primary">View All</a>
                    </h2>
                    <div class="overflow-y-auto h-80">
                        <ul class="space-y-3">
                            @forelse($recentMessages as $msg)
                            <li class="flex flex-col gap-1 p-3 bg-base-200/50 rounded-lg hover:bg-base-200 transition-colors">
                                <div class="flex justify-between items-start">
                                    <span class="font-medium text-sm">{{ $msg->name }}</span>
                                    <span class="text-xs text-base-content/60">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-base-content/70 line-clamp-2">{{ $msg->body }}</p>
                                <div class="flex justify-end mt-1">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="link link-primary text-xs">Lihat Detail</a>
                                </div>
                            </li>
                            @empty
                            <li class="text-center py-4 text-base-content/50 text-sm">Belum ada pesan masuk.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Todo List -->
            <div>
                @livewire('admin.todo-list')
            </div>

        </div>
    </div>
</x-layouts.admin>
