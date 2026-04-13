<x-layouts.admin title="Detail Pemesanan #{{ $order->id }}">
<div class="mx-auto max-w-7xl">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.hosting-orders.index') }}" class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <h1 class="text-3xl font-bold">Detail Pemesanan #{{ $order->id }}</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-6">{{ session('success') }}</div>
    @elseif(session('error'))
    <div class="alert alert-error mb-6 text-white">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Informasi Order & User -->
        <div class="lg:col-span-2 space-y-6">
            <div class="card bg-base-100 shadow border border-base-200">
                <div class="card-body">
                    <h2 class="card-title border-b pb-2 mb-4 text-primary">Informasi Pesanan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="space-y-1">
                            <p class="text-base-content/50">Nama Pelanggan:</p>
                            <p class="font-bold text-lg">{{ $order->customer_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-base-content/50">Email:</p>
                            <p class="font-bold">{{ $order->customer_email }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-base-content/50">WhatsApp:</p>
                            <p class="font-bold">{{ $order->whatsapp_number }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-base-content/50">Nama Project:</p>
                            <p class="font-bold">{{ $order->project_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-base-content/50">Paket Hosting:</p>
                            <p class="badge badge-primary text-white font-bold">{{ $order->hostingPackage->name ?? 'N/A' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-base-content/50">Total Bayar:</p>
                            <p class="font-bold text-lg text-accent">Rp {{ number_format($order->price_total, 0, ',', '.') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-base-content/50">Framework:</p>
                            <p class="font-bold">{{ $order->framework ?? '-' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-base-content/50">Database:</p>
                            <p class="font-bold">{{ $order->database ?? '-' }}</p>
                        </div>
                    </div>
                    
                    @if($order->github_repo_url)
                    <div class="mt-6 p-4 bg-base-200 rounded-lg flex items-center justify-between">
                        <div>
                            <p class="text-xs text-base-content/50 uppercase font-bold">Repo Github:</p>
                            <p class="font-mono text-sm">{{ $order->github_repo_url }}</p>
                        </div>
                        <a href="{{ $order->github_repo_url }}" target="_blank" class="btn btn-sm btn-outline">Buka Repo</a>
                    </div>
                    @endif

                    @if($order->referral_code_used)
                    <div class="mt-4 p-4 bg-primary/5 border border-primary/20 rounded-lg">
                        <p class="text-xs text-primary uppercase font-bold">Referral Digunakan:</p>
                        <p class="font-bold text-lg">{{ $order->referral_code_used }}</p>
                        <p class="text-xs opacity-60">Cashback 10k akan dikirim ke pemilik kode jika pesanan diaktifkan.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Provisioning Form (Akses FTP/DB) -->
            <div class="card bg-base-100 shadow border border-base-200">
                <div class="card-body">
                    <h2 class="card-title border-b pb-2 mb-4 text-secondary">Konfigurasi Akses (FTP & Database)</h2>
                    <form action="{{ route('admin.hosting-orders.provision', ['hosting_order' => $order->id]) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">FTP Host</span></label>
                                <input type="text" name="ftp_host" value="{{ $order->hostingAccount->ftp_host ?? 'server.kuukok.com' }}" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">FTP Port</span></label>
                                <input type="text" name="ftp_port" value="{{ $order->hostingAccount->ftp_port ?? '21' }}" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">FTP Username</span></label>
                                <input type="text" name="ftp_username" value="{{ $order->hostingAccount->ftp_username ?? '' }}" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">FTP Password</span></label>
                                <input type="text" name="ftp_password" value="{{ $order->hostingAccount->ftp_password ?? '' }}" class="input input-bordered" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t pt-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">DB Host</span></label>
                                <input type="text" name="db_host" value="{{ $order->hostingAccount->db_host ?? 'localhost' }}" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">DB Name</span></label>
                                <input type="text" name="db_name" value="{{ $order->hostingAccount->db_name ?? '' }}" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">DB Username</span></label>
                                <input type="text" name="db_username" value="{{ $order->hostingAccount->db_username ?? '' }}" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">DB Password</span></label>
                                <input type="text" name="db_password" value="{{ $order->hostingAccount->db_password ?? '' }}" class="input input-bordered" />
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-secondary text-white">Update & Kirim Akses</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar: Status & Payment Proof -->
        <div class="space-y-6">
            <div class="card bg-base-100 shadow border border-base-200 overflow-hidden">
                <div class="p-4 bg-base-200 font-bold border-b">Status Pembayaran</div>
                <div class="card-body text-center">
                    @php
                        $statusLabel = match($order->status) {
                            'pending_payment' => 'Menunggu Pembayaran',
                            'waiting_confirmation' => 'Verifikasi Bukti Bayar',
                            'active' => 'Layanan Aktif',
                            'rejected' => 'Pesanan Ditolak',
                            default => $order->status,
                        };
                    @endphp
                    <div class="text-2xl font-black mb-4">{{ $statusLabel }}</div>
                    
                    @if($order->status == 'waiting_confirmation')
                    <div class="flex flex-col gap-2">
                        <form action="{{ route('admin.hosting-orders.approve', ['hosting_order' => $order->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success text-white w-full" onclick="return confirm('Apakah Anda yakin sudah mengecek saldo dan ingin mengaktifkan layanan ini?')">
                                Setujui & Aktifkan
                            </button>
                        </form>
                        <form action="{{ route('admin.hosting-orders.reject', ['hosting_order' => $order->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-error btn-outline w-full" onclick="return confirm('Tolak pesanan ini?')">
                                Tolak Pesanan
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card bg-base-100 shadow border border-base-200 overflow-hidden">
                <div class="p-4 bg-base-200 font-bold border-b">Bukti Pembayaran</div>
                <div class="card-body p-2">
                    @if($order->payment && $order->payment->proof_image)
                        <a href="{{ asset('storage/' . $order->payment->proof_image) }}" target="_blank">
                            <img src="{{ asset('storage/' . $order->payment->proof_image) }}" alt="Proof" class="w-full h-auto rounded-lg shadow-inner cursor-zoom-in">
                        </a>
                        <div class="mt-4 text-xs space-y-2 p-2 bg-base-200 rounded">
                            <p><strong>Metode:</strong> {{ $order->payment->payment_method }}</p>
                            <p><strong>Atas Nama:</strong> {{ $order->payment->account_name }}</p>
                        </div>
                    @else
                        <div class="py-10 text-center opacity-40 italic text-sm">Belum ada bukti yang diupload.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.admin>
