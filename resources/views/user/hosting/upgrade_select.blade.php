<x-layouts.admin title="Pilih Paket Upgrade">
<div class="mx-auto max-w-7xl">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('user.hosting.my-services') }}" class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-base-content">Upgrade Paket Hosting</h1>
            <p class="text-base-content/60 mt-1">Upgrade layanan <strong>{{ $order->project_name }}</strong> ke paket yang lebih tinggi.</p>
        </div>
    </div>

    @if($packages->isEmpty())
    <div class="alert alert-info shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>Anda sudah menggunakan paket tertinggi atau paket upgrade belum tersedia untuk saat ini.</span>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($packages as $package)
        @php
            $isPopular = str_contains($package->label ?? '', 'Paling Laris');
        @endphp
        <div class="card bg-base-100 shadow-xl border border-base-200 hover:shadow-2xl transition-all duration-300 relative overflow-hidden {{ $isPopular ? 'ring-2 ring-primary scale-105 z-10' : '' }}">
            <div class="card-body p-8 space-y-6">
                @if($package->label)
                <div class="badge {{ $isPopular ? 'badge-primary badge-lg text-white' : 'badge-outline' }}">
                    {{ $package->label }}
                </div>
                @endif
                
                <div>
                    <h3 class="text-2xl font-bold">{{ $package->name }}</h3>
                    <div class="text-primary text-3xl font-bold mt-2">{{ $package->price_text }}</div>
                </div>

                @if(!$package->is_custom_domain)
                <div class="bg-primary/5 p-3 rounded-lg border border-primary/20 text-xs font-semibold text-primary">
                    Estimasi Biaya Upgrade: Rp {{ number_format(max(0, $package->price - $currentPackage->price), 0, ',', '.') }}
                </div>
                @else
                <div class="bg-secondary/5 p-3 rounded-lg border border-secondary/20 text-xs font-semibold text-secondary">
                    Harga Domain & Upgrade ditentukan Admin (Custom)
                </div>
                @endif

                @if($package->features)
                <ul class="text-sm space-y-3 flex-grow">
                    @foreach($package->features as $feature)
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
                @endif

                <div class="card-actions mt-auto">
                    <a href="{{ route('user.hosting.upgrade.create', [$order->id, $package->id]) }}" class="btn btn-primary w-full text-white rounded-full">
                        Upgrade ke {{ $package->name }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
</x-layouts.admin>
