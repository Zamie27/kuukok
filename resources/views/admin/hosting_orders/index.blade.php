<x-layouts.admin title="Daftar Pemesanan Hosting">
<div class="mx-auto max-w-7xl">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">Daftar Pemesanan Hosting</h1>
            <p class="text-base-content/60">Kelola dan verifikasi pesanan hosting dari pengguna.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-error mb-6 text-white">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <!-- Pengaturan Pembayaran -->
    @php
        $qrisImage = \App\Models\Setting::where('key', 'payment_qris_image')->value('value');
        $paymentRecipient = \App\Models\Setting::where('key', 'payment_recipient')->value('value') ?? '';
        $paymentAccounts = \App\Models\Setting::where('key', 'payment_accounts')->value('value') ?? '';
    @endphp
    <div class="collapse collapse-arrow bg-base-100 shadow border border-base-200 mb-6">
        <input type="checkbox" />
        <div class="collapse-title">
            <h3 class="font-bold text-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                Pengaturan Pembayaran
                @if(!$qrisImage && !$paymentRecipient)
                <span class="badge badge-warning badge-sm">Belum diatur</span>
                @endif
            </h3>
        </div>
        <div class="collapse-content">
            <form action="{{ route('admin.hosting-orders.upload-qris') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- QRIS -->
                <div class="border border-base-300 rounded-lg p-4">
                    <label class="label"><span class="label-text font-bold">QR Pembayaran (QRIS)</span></label>
                    <div class="flex flex-col md:flex-row items-start gap-4 mt-2">
                        @if($qrisImage)
                        <img src="{{ asset('storage/' . $qrisImage) }}" alt="QRIS" class="w-36 h-36 object-contain rounded-lg shadow-sm border bg-white p-2 flex-shrink-0">
                        @endif
                        <input type="file" name="payment_qris_image" class="file-input file-input-bordered file-input-sm w-full max-w-sm" accept="image/*" />
                    </div>
                </div>

                <!-- Penerima -->
                <div class="border border-base-300 rounded-lg p-4">
                    <label class="label"><span class="label-text font-bold">Nama Penerima</span></label>
                    <input type="text" name="payment_recipient" value="{{ $paymentRecipient }}" placeholder="Contoh: Zamie / Kuukok Creative" class="input input-bordered input-sm w-full max-w-md" />
                </div>

                <!-- Rekening -->
                <div class="border border-base-300 rounded-lg p-4">
                    <label class="label"><span class="label-text font-bold">Daftar Rekening / E-Wallet</span></label>
                    <p class="text-xs text-base-content/50 mb-2">Tulis satu rekening per baris. Format: <code>Label: NomorRekening</code></p>
                    <textarea name="payment_accounts" class="textarea textarea-bordered w-full max-w-md h-28 font-mono text-sm" placeholder="Bank BCA: 1234567890&#10;DANA: 081234567890&#10;OVO: 081234567890">{{ $paymentAccounts }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">
                    Simpan Pengaturan Pembayaran
                </button>
            </form>
        </div>
    </div>

    <div class="card bg-base-100 shadow border border-base-200">
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th class="bg-base-200">ID</th>
                        <th class="bg-base-200">User</th>
                        <th class="bg-base-200">Paket</th>
                        <th class="bg-base-200">Project</th>
                        <th class="bg-base-200">Total</th>
                        <th class="bg-base-200">Status</th>
                        <th class="bg-base-200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="font-mono text-xs">#{{ $order->id }}</td>
                        <td>
                            <div class="flex flex-col">
                                <span class="font-bold">{{ $order->customer_name }}</span>
                                <span class="text-xs text-base-content/50">{{ $order->customer_email }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-outline">{{ $order->hostingPackage->name ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <div class="flex flex-col">
                                <span class="font-medium">{{ $order->project_name }}</span>
                                <div class="flex gap-1 mt-1">
                                    <span class="badge badge-xs badge-ghost opacity-70">{{ $order->framework }}</span>
                                    <span class="badge badge-xs badge-ghost opacity-70">{{ $order->database }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="font-bold">Rp {{ number_format($order->price_total, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badgeClass = match($order->status) {
                                    'pending_payment' => 'badge-ghost',
                                    'waiting_confirmation' => 'badge-warning',
                                    'active' => 'badge-success text-white',
                                    'rejected' => 'badge-error text-white',
                                    default => 'badge-ghost',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} font-semibold">{{ $order->status_label }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.hosting-orders.show', $order->id) }}" class="btn btn-primary btn-sm rounded-lg">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 opacity-50">Belum ada pemesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
        <div class="p-4 border-t">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
</x-layouts.admin>
