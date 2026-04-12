<x-layouts.admin title="Layanan Hosting Saya">
<div class="mx-auto max-w-7xl">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">Layanan Hosting Saya</h1>
            <p class="text-base-content/60 mt-1">Kelola dan lihat detail akses hosting Anda di sini.</p>
        </div>
        <a href="{{ route('user.hosting.buy') }}" class="btn btn-primary text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Beli Hosting Baru
        </a>
    </div>

    @if($orders->isEmpty())
    <div class="card bg-base-100 shadow border border-dashed border-base-300">
        <div class="card-body items-center text-center py-16">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-base-content/20 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
            <h2 class="text-2xl font-bold opacity-50">Belum Ada Pesanan Hosting</h2>
            <p class="max-w-md text-base-content/50 mt-2">Segera pesan layanan hosting pertama Anda dan nikmati performa website terbaik untuk proyek Anda.</p>
            <div class="card-actions mt-6">
                <a href="{{ route('user.hosting.buy') }}" class="btn btn-primary text-white">Pesan Sekarang</a>
            </div>
        </div>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @foreach($orders as $order)
        @php
            $badgeColor = match($order->status) {
                'active' => 'badge-success',
                'waiting_confirmation' => 'badge-warning',
                'pending_payment' => 'badge-info',
                'rejected' => 'badge-error',
                default => 'badge-ghost',
            };
        @endphp
        <div class="card bg-base-100 shadow-lg border border-base-200 overflow-hidden">
            <div class="bg-primary/10 p-4 border-b border-primary/20 flex justify-between items-center">
                <div>
                    <h2 class="font-bold text-lg text-primary">{{ $order->project_name }}</h2>
                    <p class="text-xs text-base-content/60">{{ $order->hostingPackage->name }}</p>
                </div>
                <span class="badge {{ $badgeColor }} text-white font-bold">{{ $order->status_label }}</span>
            </div>
            <div class="card-body">
                @if($order->status === 'active')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- FTP Details -->
                    <div class="space-y-4">
                        <h3 class="font-bold text-lg border-b pb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>
                            Akses FTP
                        </h3>
                        @if($order->hostingAccount)
                        <div class="space-y-2 text-sm">
                            <div class="flex flex-col">
                                <span class="text-xs text-base-content/50">Host:</span>
                                <span class="font-mono bg-base-200 px-2 py-1 rounded">{{ $order->hostingAccount->ftp_host }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-base-content/50">Port:</span>
                                <span class="font-mono bg-base-200 px-2 py-1 rounded">{{ $order->hostingAccount->ftp_port ?? '21' }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-base-content/50">Username:</span>
                                <span class="font-mono bg-base-200 px-2 py-1 rounded">{{ $order->hostingAccount->ftp_username }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-base-content/50">Password:</span>
                                <span class="font-mono bg-base-200 px-2 py-1 rounded">{{ $order->hostingAccount->ftp_password }}</span>
                            </div>
                        </div>
                        @else
                        <p class="text-xs italic text-base-content/50 px-2">Data FTP sedang disiapkan oleh admin...</p>
                        @endif
                    </div>

                    <!-- DB Details -->
                    <div class="space-y-4">
                        <h3 class="font-bold text-lg border-b pb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>
                            Akses Database
                        </h3>
                        @if($order->hostingAccount)
                        <div class="space-y-2 text-sm">
                            <div class="flex flex-col">
                                <span class="text-xs text-base-content/50">Host:</span>
                                <span class="font-mono bg-base-200 px-2 py-1 rounded">{{ $order->hostingAccount->db_host }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-base-content/50">Database Name:</span>
                                <span class="font-mono bg-base-200 px-2 py-1 rounded">{{ $order->hostingAccount->db_name }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-base-content/50">Username:</span>
                                <span class="font-mono bg-base-200 px-2 py-1 rounded">{{ $order->hostingAccount->db_username }}</span>
                            </div>
                        </div>
                        @else
                        <p class="text-xs italic text-base-content/50 px-2">Data database sedang disiapkan oleh admin...</p>
                        @endif
                    </div>
                </div>
                @elseif($order->status === 'waiting_confirmation')
                <div class="py-8 text-center bg-warning/5 rounded-xl border border-warning/20">
                    <div class="loading loading-spinner loading-lg text-warning mb-4"></div>
                    <h3 class="font-bold text-lg text-warning">Menunggu Konfirmasi Admin</h3>
                    <p class="text-sm text-base-content/60 max-w-xs mx-auto mt-2">Bukti pembayaran Anda sedang dicek. Hosting akan segera disiapkan setelah dikonfirmasi.</p>
                </div>
                @elseif($order->status === 'pending_payment')
                <div class="py-8 text-center bg-info/5 rounded-xl border border-info/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-info mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <h3 class="font-bold text-lg text-info">Belum Konfirmasi Bayar</h3>
                    <p class="text-sm text-base-content/60 max-w-xs mx-auto mt-2 mb-4">Anda belum mengunggah bukti pembayaran untuk pesanan ini.</p>
                    <a href="{{ route('user.hosting.payment', $order->id) }}" class="btn btn-info btn-sm text-white">Bayar Sekarang</a>
                </div>
                @else
                <div class="py-8 text-center bg-error/5 rounded-xl border border-error/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-error mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <h3 class="font-bold text-lg text-error">Pesanan Ditolak</h3>
                    <p class="text-sm text-base-content/60 max-w-xs mx-auto mt-2">{{ $order->admin_notes ?? 'Pesanan Anda tidak dapat diproses. Mohon hubungi admin.' }}</p>
                </div>
                @endif

                <div class="mt-6 pt-4 border-t flex items-center justify-between">
                    <div class="text-xs">
                        <p class="font-bold text-base-content/70">Waktu Update:</p>
                        <p>{{ $order->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                    @if($order->github_repo_url)
                    <a href="{{ $order->github_repo_url }}" target="_blank" class="btn btn-outline btn-sm gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
                        Repo
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
</x-layouts.admin>
