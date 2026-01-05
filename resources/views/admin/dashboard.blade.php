<x-layouts.admin title="Admin Dashboard">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

        <!-- General Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-title">Pengunjung Hari Ini</div>
                            <div class="stat-value text-neutral">{{ number_format($stats['today_visitors']) }}</div>
                            <div class="stat-desc">Total: {{ number_format($stats['total_visitors']) }} (Unique IP/Day)</div>
                        </div>
                        <div class="text-neutral">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Stats -->
        <h2 class="text-2xl font-bold mb-4">Artikel Analytics</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-title">Total Views Artikel</div>
                            <div class="stat-value">{{ number_format($stats['total_views']) }}</div>
                            <div class="stat-desc">Akumulasi semua artikel</div>
                        </div>
                        <div class="text-info">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-title">Total Lama Baca</div>
                            <div class="stat-value">{{ number_format($stats['total_read_time']) }}</div>
                            <div class="stat-desc">Menit (akumulasi waktu dibaca)</div>
                        </div>
                        <div class="text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="stat-title">Total Interaksi CTA</div>
                            <div class="stat-value">{{ number_format($stats['total_cta']) }}</div>
                            <div class="stat-desc">Klik WhatsApp & Share</div>
                        </div>
                        <div class="text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Widgets -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            <!-- Popular Posts -->
            <div class="card bg-base-100 shadow-xl h-full">
                <div class="card-body p-4">
                    <h2 class="card-title text-lg mb-4 flex justify-between">
                        Paling Banyak Dilihat
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
                            <li class="text-center py-4 text-base-content/50 text-sm">Belum ada data.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Most CTA -->
            <div class="card bg-base-100 shadow-xl h-full">
                <div class="card-body p-4">
                    <h2 class="card-title text-lg mb-4 flex justify-between">
                        Interaksi Tertinggi (CTA)
                    </h2>
                    <div class="overflow-y-auto max-h-80">
                        <ul class="space-y-3">
                            @forelse($mostCtaPosts as $post)
                            <li class="flex items-start gap-3 p-2 hover:bg-base-200 rounded-lg transition-colors">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium truncate">{{ $post->title }}</p>
                                    <p class="text-xs text-base-content/60">{{ $post->total_cta }} interactions (WA/Share)</p>
                                </div>
                                <a href="{{ route('blog.show', $post) }}" target="_blank" class="btn btn-ghost btn-xs btn-square">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </li>
                            @empty
                            <li class="text-center py-4 text-base-content/50 text-sm">Belum ada data.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Longest Read -->
            <div class="card bg-base-100 shadow-xl h-full">
                <div class="card-body p-4">
                    <h2 class="card-title text-lg mb-4 flex justify-between">
                        Durasi Baca Terlama
                    </h2>
                    <div class="overflow-y-auto max-h-80">
                        <ul class="space-y-3">
                            @forelse($longestReadPosts as $post)
                            <li class="flex items-start gap-3 p-2 hover:bg-base-200 rounded-lg transition-colors">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium truncate">{{ $post->title }}</p>
                                    @php
                                        $totalSeconds = (int) ($post->total_seconds_read ?? 0);
                                        if ($totalSeconds > 3600) {
                                            $hours = floor($totalSeconds / 3600);
                                            $minutes = floor(($totalSeconds % 3600) / 60);
                                            $timeText = "{$hours} Jam {$minutes} Menit";
                                        } else {
                                            $minutes = ceil($totalSeconds / 60);
                                            $timeText = "{$minutes} Menit";
                                        }
                                    @endphp
                                    <p class="text-xs text-base-content/60">~{{ $timeText }}</p>
                                </div>
                                <a href="{{ route('blog.show', $post) }}" target="_blank" class="btn btn-ghost btn-xs btn-square">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </li>
                            @empty
                            <li class="text-center py-4 text-base-content/50 text-sm">Belum ada data.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <!-- Full Analytics Table -->
        <div class="card bg-base-100 shadow-xl mb-8">
            <div class="card-body p-6">
                <h2 class="card-title text-lg mb-4">
                    Full Article Analytics
                </h2>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort' => 'title', 'direction' => $sort === 'title' && $direction === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-1 hover:text-primary">
                                        Judul Artikel
                                        @if($sort === 'title') <span class="text-xs">{{ $direction === 'asc' ? '▲' : '▼' }}</span> @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort' => 'views', 'direction' => $sort === 'views' && $direction === 'desc' ? 'asc' : 'desc']) }}" class="flex items-center gap-1 hover:text-primary">
                                        Views
                                        @if($sort === 'views') <span class="text-xs">{{ $direction === 'asc' ? '▲' : '▼' }}</span> @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort' => 'total_cta', 'direction' => $sort === 'total_cta' && $direction === 'desc' ? 'asc' : 'desc']) }}" class="flex items-center gap-1 hover:text-primary">
                                        Interaksi CTA
                                        @if($sort === 'total_cta') <span class="text-xs">{{ $direction === 'asc' ? '▲' : '▼' }}</span> @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort' => 'read_time', 'direction' => $sort === 'read_time' && $direction === 'desc' ? 'asc' : 'desc']) }}" class="flex items-center gap-1 hover:text-primary">
                                        Durasi Baca
                                        @if($sort === 'read_time') <span class="text-xs">{{ $direction === 'asc' ? '▲' : '▼' }}</span> @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort' => 'created_at', 'direction' => $sort === 'created_at' && $direction === 'desc' ? 'asc' : 'desc']) }}" class="flex items-center gap-1 hover:text-primary">
                                        Tanggal
                                        @if($sort === 'created_at') <span class="text-xs">{{ $direction === 'asc' ? '▲' : '▼' }}</span> @endif
                                    </a>
                                </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($analyticsPosts as $post)
                            <tr>
                                <td>
                                    <div class="font-bold line-clamp-1 max-w-xs" title="{{ $post->title }}">{{ $post->title }}</div>
                                    <div class="text-xs opacity-50">{{ $post->status }}</div>
                                </td>
                                <td>{{ number_format($post->views) }}</td>
                                <td>
                                    <div class="tooltip" data-tip="WA: {{ $post->whatsapp_clicks }} | Share: {{ $post->share_clicks }}">
                                        {{ $post->total_cta ?? ($post->whatsapp_clicks + $post->share_clicks) }}
                                    </div>
                                </td>
                                @php
                                    $totalSeconds = (int) ($post->total_seconds_read ?? 0);
                                    if ($totalSeconds > 3600) {
                                        $hours = floor($totalSeconds / 3600);
                                        $minutes = floor(($totalSeconds % 3600) / 60);
                                        $timeText = "{$hours} Jam {$minutes} Menit";
                                    } else {
                                        $minutes = ceil($totalSeconds / 60);
                                        $timeText = "{$minutes} Menit";
                                    }
                                @endphp
                                <td>{{ $timeText }}</td>
                                <td>{{ $post->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('blog.show', $post) }}" target="_blank" class="btn btn-ghost btn-xs">View</a>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-ghost btn-xs text-primary">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $analyticsPosts->links() }}
                </div>
            </div>
        </div>

        <!-- Recent Messages (Full Width) -->
        <div class="card bg-base-100 shadow-xl mb-8">
            <div class="card-body p-6">
                <h2 class="card-title text-lg mb-4 flex justify-between items-center">
                    Pesan Masuk Terbaru
                    <a href="{{ route('admin.messages.index') }}" class="text-xs font-normal text-primary">View All</a>
                </h2>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMessages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge {{ $message->status === 'unread' ? 'badge-warning' : 'badge-ghost' }}">
                                        {{ $message->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-ghost">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-base-content/50">Belum ada pesan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
