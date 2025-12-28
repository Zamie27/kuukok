<!DOCTYPE html>
<html lang="id" data-theme="light" class="scroll-smooth">

<head>
    @include('components.head', [
    'title' => 'Pricing & Paket Layanan - Kuukok Creative Agency',
    'description' => 'Lihat paket harga layanan Kuukok untuk Web Development, Graphic Design, dan layanan digital lainnya.',
    'keywords' => 'harga jasa website, paket layanan, graphic design, web development',
    'ogUrl' => route('pricing.index')
    ])
</head>

<body class="bg-base-100 font-sans text-base-content antialiased">

    @include('components.navbar')

    <!-- Breadcrumb & Header (Matching Blog/Portfolio Style) -->
    <div class="bg-base-200 px-4 pb-8 pt-24">
        <div class="mx-auto max-w-7xl">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary hover:underline">Home</a></li>
                    <li>Pricing</li>
                </ul>
            </div>
            <h1 class="mb-2 mt-4 text-4xl font-bold md:text-5xl text-base-content">Paket & Harga Layanan</h1>
            <p class="text-lg text-base-content/70">
                Pilih paket yang sesuai dengan kebutuhan dan budget Anda.
            </p>
        </div>
    </div>

    <!-- Pricing Section -->
    <section id="pricing" class="relative bg-section-light">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-16 space-y-10 pricing">
            <div class="pricing__grid reveal-on-scroll">
                @foreach($packages as $package)
                <article class="pricing__card interactive-transition {{ $package->label === 'Paling Laris' || $package->label === 'Populer' ? 'pricing__card--recommended scale-105 z-10 shadow-2xl' : '' }}">
                    <div class="card-body p-8 space-y-6">
                        @if($package->label)
                        <div class="badge {{ $package->label === 'Paling Laris' || $package->label === 'Populer' ? 'badge-primary badge-lg text-white mb-2' : 'badge-outline' }}">
                            {{ $package->label }}
                        </div>
                        @endif
                        <h3 class="text-2xl font-bold text-base-content">{{ $package->name }}</h3>
                        <div class="pricing__price text-4xl">{{ $package->price_text }}</div>
                        {{-- <p class="text-sm text-base-content/60">per proyek</p> --}}

                        @if(is_array($package->features))
                        <ul class="text-base text-base-content/70 space-y-3">
                            @foreach($package->features as $feature)
                            <li class="flex items-center gap-3">
                                <span class="text-primary">✓</span> {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        <a href="{{ $package->cta_link ?? route('home') . '#kontak' }}" class="pricing__cta btn-lg text-lg">
                            Hubungi Kami
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Kelebihan & Pertimbangan Web Development -->
    <section class="py-16 px-4 bg-base-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $settings['pricing_comparison_title'] ?? 'Kelebihan & Pertimbangan Web Development' }}</h2>
                <p class="text-base-content/70 text-lg">{{ $settings['pricing_comparison_subtitle'] ?? 'Transparansi layanan untuk keputusan terbaik bisnis Anda' }}</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 reveal-on-scroll">
                <!-- Kelebihan -->
                <div class="card bg-base-200/50 shadow-sm border border-base-300">
                    <div class="card-body">
                        <h3 class="card-title text-success mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $settings['pricing_pros_title'] ?? 'Kelebihan' }}
                        </h3>
                        <ul class="space-y-3">
                            @php
                            $pros = isset($settings['pricing_pros_items'])
                            ? explode("\n", $settings['pricing_pros_items'])
                            : [
                            'Profesional & kredibel untuk bisnis Anda',
                            'Dapat diakses 24/7 dari mana saja',
                            'Meningkatkan jangkauan pasar secara online',
                            'Mudah di-update dan dikelola',
                            'Dapat terintegrasi dengan berbagai tools & API'
                            ];
                            @endphp
                            @foreach($pros as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-success">✓</span>
                                <span>{{ trim($item) }}</span>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Pertimbangan -->
                <div class="card bg-base-200/50 shadow-sm border border-base-300">
                    <div class="card-body">
                        <h3 class="card-title text-warning mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            {{ $settings['pricing_cons_title'] ?? 'Pertimbangan' }}
                        </h3>
                        <ul class="space-y-3">
                            @php
                            $cons = isset($settings['pricing_cons_items'])
                            ? explode("\n", $settings['pricing_cons_items'])
                            : [
                            'Memerlukan hosting dan domain (biaya tahunan)',
                            'Butuh maintenance dan security update berkala',
                            'Waktu pengerjaan beberapa minggu tergantung kompleksitas',
                            'Perlu konten dan materi yang jelas sebelum mulai'
                            ];
                            @endphp
                            @foreach($cons as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-warning">!</span>
                                <span>{{ trim($item) }}</span>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section (From Home) -->
    <section id="testimoni" class="relative bg-section-secondary">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10 testimoni">
            <div class="text-center space-y-3 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-inherit">Testimoni</h2>
                <p class="text-base md:text-lg text-inherit opacity-90">Apa kata klien kami tentang hasil kerja kami</p>
            </div>

            <!-- Marquee Carousel -->
            <div class="relative w-full overflow-hidden reveal-on-scroll">
                <!-- Gradient Masks -->
                <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-[#F1F5F9] dark:from-[#1E293B] to-transparent z-10 pointer-events-none"></div>
                <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-[#F1F5F9] dark:from-[#1E293B] to-transparent z-10 pointer-events-none"></div>

                <div class="flex animate-marquee gap-6 w-max">
                    @foreach($testimonials as $testimonial)
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">
                                    @if($testimonial->photo)
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                                    @else
                                    {{ substr($testimonial->display_name, 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <h3 class="testimoni__name">{{ $testimonial->display_name }}</h3>
                                    <p class="testimoni__role">{{ $testimonial->role ?? 'Client' }}</p>
                                    <span class="text-xs text-base-content/50">{{ $testimonial->created_at->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                            <div class="testimoni__stars">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    ★
                                    @endfor
                            </div>
                            <p class="testimoni__quote">"{{ $testimonial->content }}"</p>
                        </div>
                    </article>
                    @endforeach

                    <!-- Duplicate for infinite scroll -->
                    @foreach($testimonials as $testimonial)
                    <article class="testimoni__card">
                        <div class="card-body space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="testimoni__avatar">
                                    @if($testimonial->photo)
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                                    @else
                                    {{ substr($testimonial->display_name, 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <h3 class="testimoni__name">{{ $testimonial->display_name }}</h3>
                                    <p class="testimoni__role">{{ $testimonial->role ?? 'Client' }}</p>
                                    <span class="text-xs text-base-content/50">{{ $testimonial->created_at->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                            <div class="testimoni__stars">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    ★
                                    @endfor
                            </div>
                            <p class="testimoni__quote">"{{ $testimonial->content }}"</p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <div class="py-16 px-4 bg-base-200">
        <div class="max-w-4xl mx-auto reveal-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $settings['faq_title'] ?? 'Frequently Asked Questions' }}</h2>
                <p class="text-base-content/70">{{ $settings['faq_description'] ?? 'Pertanyaan yang sering ditanyakan seputar harga dan layanan kami' }}</p>
            </div>

            <div class="space-y-4">
                @foreach($faqs as $faq)
                <div class="collapse collapse-plus bg-base-100 shadow">
                    <input type="radio" name="faq-accordion" @checked($loop->first) />
                    <div class="collapse-title text-xl font-medium">
                        {{ $faq->question }}
                    </div>
                    <div class="collapse-content">
                        <p class="text-base-content/70">{{ $faq->answer }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- CTA Section -->
    <div class="bg-base-200 px-4 py-20 reveal-on-scroll">
        <div class="mx-auto max-w-5xl">
            <div class="card to-primary-focus bg-gradient-to-br from-primary text-white shadow-2xl">
                <div class="card-body py-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold md:text-4xl">
                        Masih Bingung Pilih Paket?
                    </h2>
                    <p class="mx-auto mb-6 max-w-2xl text-lg opacity-90">
                        Konsultasikan kebutuhan bisnis Anda dengan kami secara gratis
                    </p>
                    <div class="flex flex-col justify-center gap-4 sm:flex-row">
                        <a href="{{ route('home') }}/contact" class="btn btn-accent btn-lg text-neutral font-bold border-none">
                            Konsultasi Gratis
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.686 8-8 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 3.686-8 8-8s8 3.582 8 8z" />
                            </svg>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary hover:border-white">
                            Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

</body>

</html>
