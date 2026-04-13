<x-layouts.admin title="Konfirmasi Upgrade Paket">
<div class="mx-auto max-w-3xl">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('user.hosting.upgrade.index', $order->id) }}" class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold">Konfirmasi Upgrade</h1>
            <p class="text-base-content/60">Upgrade dari <span class="badge badge-outline">{{ $currentPackage->name }}</span> ke <span class="badge badge-primary text-white">{{ $package->name }}</span></p>
        </div>
    </div>

    <div class="card bg-base-100 shadow border border-base-200">
        <div class="card-body">
            <h2 class="card-title mb-4">Detail Upgrade</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="p-4 bg-base-200 rounded-lg">
                    <p class="text-xs font-bold text-base-content/50 uppercase">Proyek</p>
                    <p class="font-semibold">{{ $order->project_name }}</p>
                </div>
                <div class="p-4 bg-base-200 rounded-lg">
                    <p class="text-xs font-bold text-base-content/50 uppercase">Domain Saat Ini</p>
                    <p class="font-semibold">{{ $order->domain_name }}{{ $order->domain_type === 'subdomain' ? '.kuukok.my.id' : '' }}</p>
                </div>
            </div>

            <form action="{{ route('user.hosting.upgrade.store', $order->id) }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="hosting_package_id" value="{{ $package->id }}">

                <div class="form-control">
                    <label class="label"><span class="label-text font-semibold">Nama Domain {{ $package->is_custom_domain ? 'Baru (Custom)' : 'Tetap/Baru' }}</span></label>
                    <div class="join">
                        <input type="text" name="domain_name" value="{{ $order->domain_name }}" class="input input-bordered w-full join-item" required />
                        @if(!$package->is_custom_domain)
                        <span class="btn join-item no-animation bg-base-200 border-base-300">.kuukok.my.id</span>
                        @endif
                    </div>
                    <label class="label">
                        <span class="label-text-alt text-base-content/60">
                            @if($package->is_custom_domain)
                            Karena Anda memilih paket dengan Custom Domain, silakan masukkan domain lengkap Anda (misal: domainanda.com).
                            @else
                            Anda dapat tetap menggunakan domain lama atau menggantinya. Suffix .kuukok.my.id akan tetap ada.
                            @endif
                        </span>
                    </label>
                </div>

                <div class="alert alert-info py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h4 class="font-bold">Informasi Biaya:</h4>
                        @if(!$package->is_custom_domain)
                        <p class="text-sm">Biaya upgrade adalah selisih harga paket: <strong>Rp {{ number_format(max(0, $package->price - $currentPackage->price), 0, ',', '.') }}</strong></p>
                        @else
                        <p class="text-sm">Harga untuk upgrade ini akan ditentukan oleh admin setelah mengecek harga market domain yang Anda inginkan.</p>
                        @endif
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary w-full text-white font-bold text-lg">
                        {{ $package->is_custom_domain ? 'Kirim Permintaan Upgrade' : 'Konfirmasi Upgrade & Bayar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layouts.admin>
