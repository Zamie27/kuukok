<x-layouts.admin title="Pembayaran Hosting">
<div class="mx-auto max-w-4xl">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Instruski Pembayaran -->
        <div class="space-y-6">
            <div class="card bg-base-100 shadow border border-base-200">
                <div class="card-body">
                    <h2 class="card-title text-2xl font-bold mb-4">Metode Pembayaran</h2>
                    
                    <div class="space-y-4">
                        <div class="p-4 bg-primary/5 rounded-lg border border-primary/20">
                            <h3 class="font-bold text-primary mb-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                                Scan QRIS
                            </h3>
                            @if($qrisImage)
                                <img src="{{ asset('storage/' . $qrisImage) }}" alt="QRIS Kuukok" class="w-full h-auto rounded-lg shadow-md border-4 border-white">
                            @else
                                <div class="aspect-square bg-base-300 rounded-lg flex items-center justify-center text-center p-6 italic text-base-content/50">
                                    QRIS belum diupload oleh admin. Silakan hubungi whatsapp admin untuk pembayaran manual.
                                </div>
                            @endif
                            <p class="text-xs text-center mt-3 text-base-content/60">Scan menggunakan aplikasi mobile m-banking atau e-wallet Anda.</p>
                        </div>

                        <div class="divider text-xs text-base-content/40 uppercase">Atau Transfer Manual</div>
                        
                        <div class="p-4 bg-base-200 rounded-lg space-y-2">
                            @if($paymentRecipient)
                            <p class="text-sm font-bold text-base-content/70">Penerima:</p>
                            <p class="text-lg font-bold">{{ $paymentRecipient }}</p>
                            @endif
                            @if($paymentAccounts)
                            @foreach(explode("\n", trim($paymentAccounts)) as $line)
                                @php
                                    $line = trim($line);
                                    if (empty($line)) continue;
                                    $parts = explode(':', $line, 2);
                                    $label = trim($parts[0] ?? '');
                                    $number = trim($parts[1] ?? '');
                                @endphp
                                @if($label && $number)
                                <div class="flex justify-between items-center text-sm">
                                    <span>{{ $label }}: <span class="font-mono">{{ $number }}</span></span>
                                    <button class="btn btn-ghost btn-xs text-primary" onclick="navigator.clipboard.writeText('{{ $number }}')">Salin</button>
                                </div>
                                @endif
                            @endforeach
                            @else
                            <p class="text-sm text-base-content/50 italic">Info rekening belum diatur oleh admin.</p>
                            @endif
                        </div>
                    </div>

                    <div class="alert alert-info mt-6 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Total yang harus dibayar: <strong>Rp {{ number_format($order->price_total, 0, ',', '.') }}</strong></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Bukti Bayar -->
        <div class="space-y-6">
            <div class="card bg-base-100 shadow border border-base-200">
                <div class="card-body">
                    <h2 class="card-title text-2xl font-bold mb-6">Konfirmasi Pembayaran</h2>
                    
                    <form action="{{ route('user.hosting.order.payment.submit', ['hosting_order' => $order->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="form-control">
                            <label class="label"><span class="label-text font-semibold text-base-content">Metode Pembayaran</span></label>
                            <select name="payment_method" class="select select-bordered w-full" required>
                                <option value="" disabled selected>Pilih metode...</option>
                                <option value="BANK">Transfer Antar Bank</option>
                                <option value="EWALLET">E-Wallet</option>
                                <option value="QRIS">QRIS All Payment</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text font-semibold text-base-content">Atas Nama (Pengirim)</span></label>
                            <input type="text" name="account_name" placeholder="Nama sesuai rekening/e-wallet" class="input input-bordered w-full" required />
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text font-semibold text-base-content text-accent">Upload Bukti Pembayaran</span></label>
                            <input type="file" name="proof_image" class="file-input file-input-bordered w-full" accept="image/*" required />
                            <label class="label"><span class="label-text-alt text-base-content/60">Maksimal 2MB (Format: JPG, PNG, WEBP)</span></label>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="btn btn-accent w-full text-neutral font-bold text-lg border-none">
                                Konfirmasi Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card bg-warning/10 border border-warning/30">
                <div class="card-body p-4 text-xs italic text-warning-content">
                    <p>Catatan: Pesanan akan dikonfirmasi manual oleh admin dalam waktu 1-24 jam setelah bukti pembayaran dikirim.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.admin>
