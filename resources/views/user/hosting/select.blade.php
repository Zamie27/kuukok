<x-layouts.admin title="Pilih Paket Hosting">
<div class="mx-auto max-w-7xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-base-content">Layanan Hosting</h1>
        <p class="text-base-content/60 mt-1">Pilih paket hosting yang sesuai dengan kebutuhan proyek Anda.</p>
    </div>

    <!-- Pricing Grid (Matching Landing Page Style) -->
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
                    <a href="{{ route('user.hosting.order', $package->id) }}" class="btn btn-primary w-full text-white rounded-full">
                        Pilih Paket
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-layouts.admin>
