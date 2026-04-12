<x-layouts.admin>
    <div class="space-y-8">
        @if(Auth::user()->isAdmin() || Auth::user()->isStaff())
        <!-- ADMIN DASHBOARD (MATCHING SCREENSHOT) -->
        
        <!-- Top Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Artikel -->
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-base-content/60">Total Artikel</p>
                        <h3 class="text-4xl font-extrabold mt-1">{{ $stats['posts'] }}</h3>
                        <p class="text-xs text-base-content/40 mt-1 lowercase">Semua status</p>
                    </div>
                    <div class="p-3 bg-primary/10 rounded-xl text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Portfolio -->
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-base-content/60">Total Portfolio</p>
                        <h3 class="text-4xl font-extrabold mt-1">{{ $stats['portfolios'] }}</h3>
                        <p class="text-xs text-base-content/40 mt-1 lowercase">Karya terpublikasi</p>
                    </div>
                    <div class="p-3 bg-secondary/10 rounded-xl text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pesan Baru -->
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-base-content/60">Pesan Baru</p>
                        <h3 class="text-4xl font-extrabold mt-1">{{ $stats['messages_unread'] }}</h3>
                        <p class="text-xs text-base-content/40 mt-1 lowercase">Belum dibaca</p>
                    </div>
                    <div class="p-3 bg-info/10 rounded-xl text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pengunjung Hari Ini -->
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-base-content/60">Pengunjung Hari Ini</p>
                        <h3 class="text-4xl font-extrabold mt-1">{{ $stats['today_visitors'] }}</h3>
                        <p class="text-xs text-base-content/40 mt-1">Total: {{ number_format($stats['total_visitors']) }} (Unique IP/Day)</p>
                    </div>
                    <div class="p-3 bg-warning/10 rounded-xl text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Artikel Analytics Header -->
        <h2 class="text-2xl font-bold text-base-content mt-10">Artikel Analytics</h2>
        
        <!-- Analytics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Views -->
            <div class="card bg-base-300/30 p-8 rounded-2xl border border-base-300">
                <p class="text-xs font-medium text-base-content/40 uppercase tracking-widest">Total Views Artikel</p>
                <div class="flex items-end justify-between mt-4">
                    <div>
                        <h3 class="text-5xl font-extrabold">{{ number_format($stats['total_views']) }}</h3>
                        <p class="text-xs text-base-content/50 mt-2">Akumulasi semua artikel</p>
                    </div>
                    <div class="text-primary pb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Lama Baca -->
            <div class="card bg-base-300/30 p-8 rounded-2xl border border-base-300">
                <p class="text-xs font-medium text-base-content/40 uppercase tracking-widest">Total Lama Baca</p>
                <div class="flex items-end justify-between mt-4">
                    <div>
                        <h3 class="text-5xl font-extrabold">{{ $stats['total_read_time'] }}</h3>
                        <p class="text-xs text-base-content/50 mt-2">Menit (akumulasi waktu dibaca)</p>
                    </div>
                    <div class="text-warning pb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Interaksi CTA -->
            <div class="card bg-base-300/30 p-8 rounded-2xl border border-base-300">
                <p class="text-xs font-medium text-base-content/40 uppercase tracking-widest">Total Interaksi CTA</p>
                <div class="flex items-end justify-between mt-4">
                    <div>
                        <h3 class="text-5xl font-extrabold">{{ $stats['total_cta'] }}</h3>
                        <p class="text-xs text-base-content/50 mt-2">Klik WhatsApp & Share</p>
                    </div>
                    <div class="text-success pb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Articles Columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            <!-- Paling Banyak Dilihat -->
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h4 class="text-xl font-bold">Paling Banyak Dilihat</h4>
                    <a href="{{ route('admin.posts.index') }}" class="text-xs text-primary hover:underline">View All</a>
                </div>
                <div class="space-y-6">
                    @foreach($popularPosts as $post)
                    <div class="flex items-start gap-4 group">
                        <div class="flex-1">
                            <h5 class="font-bold line-clamp-2 text-sm leading-relaxed group-hover:text-primary transition-colors">{{ $post->title }}</h5>
                            <p class="text-xs text-base-content/40 mt-1">{{ number_format($post->views) }} views • {{ $post->created_at->format('d M') }}</p>
                        </div>
                        <a href="{{ route('blog.show', $post) }}" target="_blank" class="text-base-content/30 hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Interaksi Tertinggi (CTA) -->
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h4 class="text-xl font-bold">Interaksi Tertinggi (CTA)</h4>
                    <span class="text-xs text-base-content/20 italic">Top 5</span>
                </div>
                <div class="space-y-6">
                    @foreach($mostCtaPosts as $post)
                    <div class="flex items-start gap-4 group">
                        <div class="flex-1">
                            <h5 class="font-bold line-clamp-2 text-sm leading-relaxed group-hover:text-primary transition-colors">{{ $post->title }}</h5>
                            <p class="text-xs text-base-content/40 mt-1">{{ ($post->whatsapp_clicks ?? 0) + ($post->share_clicks ?? 0) }} interactions (WA/Share)</p>
                        </div>
                        <a href="{{ route('blog.show', $post) }}" target="_blank" class="text-base-content/30 hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Durasi Baca Terlama -->
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h4 class="text-xl font-bold">Durasi Baca Terlama</h4>
                    <span class="text-xs text-base-content/20 italic">Top 5</span>
                </div>
                <div class="space-y-6">
                    @foreach($longestReadPosts as $post)
                    <div class="flex items-start gap-4 group">
                        <div class="flex-1">
                            <h5 class="font-bold line-clamp-2 text-sm leading-relaxed group-hover:text-primary transition-colors">{{ $post->title }}</h5>
                            @php
                                $seconds = $post->total_seconds_read ?? 0;
                                $hours = floor($seconds / 3600);
                                $minutes = floor(($seconds % 3600) / 60);
                                $displayReadTime = ($hours > 0 ? $hours . ' Jam ' : '') . ($minutes > 0 ? $minutes . ' Menit' : ($hours == 0 ? '0 Menit' : ''));
                            @endphp
                            <p class="text-xs text-base-content/40 mt-1">~{{ $displayReadTime }}</p>
                        </div>
                        <a href="{{ route('blog.show', $post) }}" target="_blank" class="text-base-content/30 hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Full Article Analytics Table -->
        <div class="mt-16">
            <h3 class="text-2xl font-bold text-base-content mb-6">Full Article Analytics</h3>
            <div class="card bg-base-100 shadow-sm border border-base-300 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50 text-base-content/60">
                                <th class="py-4">Judul Artikel</th>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort' => 'views', 'direction' => $sort === 'views' && $direction === 'desc' ? 'asc' : 'desc']) }}" class="flex items-center gap-1 hover:text-primary transition-colors">
                                        Views
                                        @if($sort === 'views')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $direction === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort' => 'total_cta', 'direction' => $sort === 'total_cta' && $direction === 'desc' ? 'asc' : 'desc']) }}" class="flex items-center gap-1 hover:text-primary transition-colors">
                                        Interaksi CTA
                                        @if($sort === 'total_cta')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $direction === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.dashboard', ['sort' => 'read_time', 'direction' => $sort === 'read_time' && $direction === 'desc' ? 'asc' : 'desc']) }}" class="flex items-center gap-1 hover:text-primary transition-colors">
                                        Durasi Baca
                                        @if($sort === 'read_time')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $direction === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                        @endif
                                    </a>
                                </th>
                                <th>Tanggal</th>
                                <th class="text-right px-8">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-300">
                            @foreach($analyticsPosts as $post)
                            <tr class="hover:bg-base-200/30 transition-colors">
                                <td class="py-4">
                                    <div class="max-w-md">
                                        <p class="font-bold text-base-content line-clamp-1">{{ $post->title }}</p>
                                        <p class="text-[10px] uppercase tracking-widest text-base-content/40 mt-0.5">{{ $post->status }}</p>
                                    </div>
                                </td>
                                <td class="font-medium">{{ number_format($post->views) }}</td>
                                <td class="font-medium">{{ ($post->whatsapp_clicks ?? 0) + ($post->share_clicks ?? 0) }}</td>
                                <td class="font-medium">
                                    @php
                                        $s = $post->total_seconds_read ?? 0;
                                        $h = floor($s / 3600);
                                        $m = floor(($s % 3600) / 60);
                                        echo ($h > 0 ? $h . ' Jam ' : '') . ($m > 0 ? $m . ' Menit' : ($h == 0 ? $m . ' Menit' : ''));
                                    @endphp
                                </td>
                                <td class="text-base-content/60 text-sm italic">{{ $post->created_at->format('d M Y') }}</td>
                                <td class="text-right px-8 space-x-3">
                                    <a href="{{ route('blog.show', $post) }}" target="_blank" class="text-xs font-bold text-primary hover:text-primary-focus transition-colors">View</a>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-xs font-bold text-secondary hover:text-secondary-focus transition-colors">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination if needed -->
                @if($analyticsPosts->hasPages())
                <div class="p-4 border-t border-base-300 bg-base-200/20">
                    {{ $analyticsPosts->links() }}
                </div>
                @endif
            </div>
        </div>

        <!-- Pesan Masuk Terbaru Table -->
        <div class="mt-16">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-base-content">Pesan Masuk Terbaru</h3>
                <a href="{{ route('admin.messages.index') }}" class="text-xs text-primary hover:underline font-bold">View All</a>
            </div>
            <div class="card bg-base-100 shadow-sm border border-base-300 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50 text-base-content/60">
                                <th class="py-4">Nama</th>
                                <th>Email</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="text-right px-8">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-300">
                            @forelse($recentMessages as $message)
                            <tr class="hover:bg-base-200/30 transition-colors">
                                <td class="py-4 font-bold text-base-content">{{ $message->name }}</td>
                                <td class="text-base-content/70">{{ $message->email }}</td>
                                <td class="text-base-content/60 text-sm">{{ $message->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="badge {{ $message->status === 'unread' ? 'badge-warning' : 'badge-ghost' }} font-bold text-[10px] uppercase tracking-widest px-3">
                                        {{ $message->status }}
                                    </div>
                                </td>
                                <td class="text-right px-8">
                                    <a href="{{ route('admin.messages.show', $message) }}" class="text-xs font-bold text-base-content hover:text-primary transition-colors uppercase">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-base-content/40">Belum ada pesan masuk terbaru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @else
        <!-- CLIENT/USER DASHBOARD (KEPT AS PREVIOUSLY IMPLEMENTED) -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-base-content text-white">Halo, {{ Auth::user()->name }}!</h1>
                <p class="text-base-content/60 mt-1">Kelola layanan hosting dan referral Anda di sini.</p>
            </div>
            <div class="text-sm text-base-content/50">
                {{ now()->translatedFormat('d F Y') }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="card bg-primary text-white shadow-xl">
                <div class="card-body">
                    <h2 class="card-title opacity-80 uppercase text-xs tracking-widest">Layanan Aktif</h2>
                    <p class="text-4xl font-bold mt-2">{{ $activeOrders ?? 0 }}</p>
                    <div class="card-actions justify-end mt-4">
                        <a href="{{ route('hosting.index') }}" class="btn btn-sm bg-white/20 border-0 text-white hover:bg-white/40">Beli Hosting</a>
                    </div>
                </div>
            </div>

            <div class="card bg-secondary text-white shadow-xl">
                <div class="card-body">
                    <h2 class="card-title opacity-80 uppercase text-xs tracking-widest">Saldo Referral</h2>
                    <p class="text-4xl font-bold mt-2">Rp {{ number_format(Auth::user()->cashback_balance ?? 0, 0, ',', '.') }}</p>
                    <div class="card-actions justify-end mt-4">
                        @if((Auth::user()->cashback_balance ?? 0) >= 10000)
                        <a href="{{ route('user.cashback.index') }}" class="btn btn-sm bg-white/20 border-0 text-white hover:bg-white/40">Cairkan Saldo</a>
                        @else
                        <span class="text-xs opacity-60">Min. Rp 10.000</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body">
                    <h2 class="card-title text-base-content/60 uppercase text-xs tracking-widest">Kode Referral</h2>
                    <div class="flex items-center justify-between mt-2 bg-base-200 p-4 rounded-xl border border-dashed border-primary/50">
                        <span class="text-2xl font-mono font-bold text-primary">{{ Auth::user()->referral_code ?? 'BELUM ADA' }}</span>
                        <button class="btn btn-ghost btn-sm" onclick="navigator.clipboard.writeText('{{ Auth::user()->referral_code }}')">Copy</button>
                    </div>
                    <p class="text-xs text-base-content/50 mt-4">Bagikan kode ini untuk mendapatkan cashback <strong>Rp 10.000</strong> per undangan. <a href="{{ route('hosting.index') }}#faq" class="text-primary hover:underline">Syarat & Ketentuan</a></p>
                </div>
            </div>
        </div>

        <!-- News/Updates for Users -->
        <div class="card bg-base-100 shadow-xl border border-base-300 mt-10">
            <div class="card-body">
                <h3 class="text-xl font-bold text-base-content mb-4">Berita & Informasi</h3>
                <div class="space-y-4">
                    <div class="flex gap-4 p-4 bg-base-200 rounded-2xl border border-base-300">
                        <div class="bg-primary/10 p-3 rounded-xl text-primary h-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold">Layanan Hosting Diluncurkan!</h4>
                            <p class="text-sm text-base-content/60 mt-1">Sekarang Anda bisa memesan hosting premium langsung melalui dashboard Kuukok.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-4 bg-base-200 rounded-2xl border border-base-300">
                        <div class="bg-secondary/10 p-3 rounded-xl text-secondary h-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold">Sistem Referral Aktif</h4>
                            <p class="text-sm text-base-content/60 mt-1">Dapatkan cashback sampai <strong>Rp 30.000</strong> dengan mengundang teman menggunakan kode referral Anda. <a href="{{ route('hosting.index') }}#faq" class="text-primary hover:underline">Pelajari lebih lanjut →</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-layouts.admin>
