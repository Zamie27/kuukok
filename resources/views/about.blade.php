<!DOCTYPE html>
<html lang="id" data-theme="light" class="scroll-smooth">

<head>
    @include('components.head', [
    'title' => 'Tentang Kami - Kuukok Creative Agency',
    'meta_description' => 'Mengenal lebih dekat tim Kuukok Creative Agency, visi, misi, dan anggota tim kami.',
    'keywords' => 'tentang Kuukok, tim kreatif, visi misi, agency digital',
    'og_url' => route('about.index')
    ])
</head>

<body class="bg-base-100 font-sans text-base-content antialiased">

    @include('components.navbar')

    <!-- Breadcrumb & Header -->
    <div class="bg-base-200 px-4 pb-8 pt-24">
        <div class="mx-auto max-w-7xl">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary hover:underline">Home</a></li>
                    <li>Tentang Kami</li>
                </ul>
            </div>
            <h1 class="mb-2 mt-4 text-4xl font-bold md:text-5xl text-base-content">Tentang Kami</h1>
            <p class="text-lg text-base-content/70">
                Mengenal lebih dekat siapa di balik layar Kuukok Creative Agency.
            </p>
        </div>
    </div>

    <!-- Company Overview -->
    <section class="py-16 px-4 bg-base-100">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center reveal-on-scroll">
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-base-content">{{ $settings['about_title'] ?? 'Mitra Digital Terpercaya Anda' }}</h2>
                <div class="text-base-content/70 text-lg leading-relaxed whitespace-pre-line">
                    {{ $settings['about_description'] ?? 'Kuukok Creative Agency lahir dari semangat untuk membantu bisnis dan individu bertransformasi di era digital.' }}
                </div>
                <div class="grid grid-cols-2 gap-6 pt-4">
                    <div>
                        <div class="text-3xl font-bold text-primary mb-1">{{ $yearsText }}</div>
                        <div class="text-sm text-base-content/60">Tahun Pengalaman</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary mb-1">{{ $projectCountText }}</div>
                        <div class="text-sm text-base-content/60">Proyek Selesai</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary mb-1">{{ $clientCountText }}</div>
                        <div class="text-sm text-base-content/60">Klien Puas</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary mb-1">24/7</div>
                        <div class="text-sm text-base-content/60">Support</div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-primary/20 rounded-2xl -z-10 transform rotate-3"></div>
                @if(isset($settings['about_image']) && $settings['about_image'])
                <img src="{{ asset('storage/' . $settings['about_image']) }}" alt="Tim Kuukok" class="rounded-xl shadow-2xl w-full h-auto object-cover">
                @else
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop" alt="Tim Kuukok" class="rounded-xl shadow-2xl w-full h-auto object-cover">
                @endif
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-16 px-4 bg-base-200">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8 reveal-on-scroll">
            <div class="card bg-base-100 shadow-lg border border-base-300">
                <div class="card-body">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="card-title text-2xl mb-2">Visi Kami</h3>
                    <p class="text-base-content/70">
                        {{ $settings['vision_text'] ?? 'Menjadi agensi kreatif digital terdepan yang memberdayakan UMKM dan bisnis di Indonesia melalui inovasi teknologi dan desain yang berdampak.' }}
                    </p>
                </div>
            </div>
            <div class="card bg-base-100 shadow-lg border border-base-300">
                <div class="card-body">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="card-title text-2xl mb-2">Misi Kami</h3>
                    <ul class="space-y-2 text-base-content/70">
                        @php
                        $defaultMission = "Menyediakan solusi digital berkualitas tinggi dengan harga terjangkau.\nMembangun ekosistem digital yang ramah pengguna dan mudah dikelola.\nMemberikan edukasi dan dukungan teknis berkelanjutan bagi klien.";
                        $missions = explode("\n", $settings['mission_text'] ?? $defaultMission);
                        @endphp
                        @foreach($missions as $mission)
                        @if(trim($mission))
                        <li class="flex items-start gap-2">
                            <span class="text-primary mt-1">•</span>
                            {{ trim($mission) }}
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 px-4 bg-base-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Tim Hebat Kami</h2>
                <p class="text-base-content/70 text-lg max-w-2xl mx-auto">
                    Bertemu dengan para ahli di balik setiap proyek sukses Kuukok.
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-8 reveal-on-scroll">
                @foreach($team as $member)
                <!-- Member {{ $loop->iteration }} -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 group w-full md:w-[calc(50%-1rem)] lg:w-[calc(25%-1.5rem)]">
                    <figure class="px-4 pt-4 overflow-hidden">
                        @if($member->avatar)
                        <img src="{{ asset('storage/'.$member->avatar) }}" alt="{{ $member->user->name }}" class="rounded-xl w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />
                        @else
                        <div class="w-full h-64 bg-neutral text-neutral-content rounded-xl flex items-center justify-center text-6xl font-bold transition-transform duration-500 group-hover:scale-110">
                            {{ substr($member->user->name ?? 'U', 0, 1) }}
                        </div>
                        @endif
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-xl">{{ $member->user->name }}</h3>
                        <p class="text-primary font-medium text-sm uppercase tracking-wide">{{ $member->position ?? 'Team Member' }}</p>
                        <p class="text-base-content/60 text-sm line-clamp-2">{{ $member->quote ?? 'No quote available.' }}</p>
                        <div class="card-actions mt-4">
                            <a href="{{ route('team.show', $member) }}" class="btn btn-outline btn-primary btn-sm rounded-full">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <div class="bg-base-200 px-4 py-20 reveal-on-scroll">
        <div class="mx-auto max-w-5xl">
            <div class="card to-primary-focus bg-gradient-to-br from-primary text-white shadow-2xl">
                <div class="card-body py-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold md:text-4xl">
                        Ingin Bergabung dengan Tim Kami?
                    </h2>
                    <p class="mx-auto mb-6 max-w-2xl text-lg opacity-90">
                        Kami selalu mencari talenta berbakat untuk tumbuh bersama. Cek lowongan yang tersedia atau kirimkan CV Anda.
                    </p>
                    <div class="flex flex-col justify-center gap-4 sm:flex-row">
                        <a href="mailto:karir@kuukok.test" class="btn btn-accent btn-lg text-neutral font-bold border-none">
                            Kirim CV
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </a>
                        <a href="{{ route('home') }}#kontak" class="btn btn-outline btn-lg border-white text-white hover:bg-white hover:text-primary hover:border-white">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

</body>

</html>
