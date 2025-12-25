<!DOCTYPE html>
<html lang="id" data-theme="light" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Kuukok Creative Agency</title>
    <meta name="description" content="Mengenal lebih dekat tim Kuukok Creative Agency, visi, misi, dan anggota tim kami.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <h2 class="text-3xl font-bold text-base-content">Mitra Digital Terpercaya Anda</h2>
                <p class="text-base-content/70 text-lg leading-relaxed">
                    Kuukok Creative Agency lahir dari semangat untuk membantu bisnis dan individu bertransformasi di era digital. Kami percaya bahwa setiap brand memiliki cerita unik yang layak didengar, dan teknologi adalah jembatan terbaik untuk menyampaikannya.
                </p>
                <p class="text-base-content/70 text-lg leading-relaxed">
                    Dengan tim yang berdedikasi dan berpengalaman, kami fokus memberikan solusi kreatif yang tidak hanya estetis, tetapi juga fungsional dan berdampak nyata bagi pertumbuhan bisnis Anda.
                </p>
                <div class="grid grid-cols-2 gap-6 pt-4">
                    <div>
                        <div class="text-3xl font-bold text-primary mb-1">5+</div>
                        <div class="text-sm text-base-content/60">Tahun Pengalaman</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary mb-1">100+</div>
                        <div class="text-sm text-base-content/60">Proyek Selesai</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary mb-1">50+</div>
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
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop" alt="Tim Kuukok" class="rounded-xl shadow-2xl w-full h-auto object-cover">
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
                        Menjadi agensi kreatif digital terdepan yang memberdayakan UMKM dan bisnis di Indonesia melalui inovasi teknologi dan desain yang berdampak.
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
                        <li class="flex items-start gap-2">
                            <span class="text-primary mt-1">•</span>
                            Menyediakan solusi digital berkualitas tinggi dengan harga terjangkau.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary mt-1">•</span>
                            Membangun ekosistem digital yang ramah pengguna dan mudah dikelola.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary mt-1">•</span>
                            Memberikan edukasi dan dukungan teknis berkelanjutan bagi klien.
                        </li>
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 reveal-on-scroll">
                <!-- Member 1 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 group">
                    <figure class="px-4 pt-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1887&auto=format&fit=crop" alt="Member" class="rounded-xl w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-xl">Ahmad Rizky</h3>
                        <p class="text-primary font-medium text-sm uppercase tracking-wide">Lead Developer</p>
                        <p class="text-base-content/60 text-sm line-clamp-2">Full-stack wizard dengan passion di Laravel & Vue.js.</p>
                        <div class="card-actions mt-4">
                            <a href="{{ route('team.show') }}" class="btn btn-outline btn-primary btn-sm rounded-full">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 group">
                    <figure class="px-4 pt-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1887&auto=format&fit=crop" alt="Member" class="rounded-xl w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-xl">Sarah Putri</h3>
                        <p class="text-primary font-medium text-sm uppercase tracking-wide">UI/UX Designer</p>
                        <p class="text-base-content/60 text-sm line-clamp-2">Pencipta antarmuka yang indah dan pengalaman pengguna yang mulus.</p>
                        <div class="card-actions mt-4">
                            <a href="{{ route('team.show') }}" class="btn btn-outline btn-primary btn-sm rounded-full">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 group">
                    <figure class="px-4 pt-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1887&auto=format&fit=crop" alt="Member" class="rounded-xl w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-xl">Budi Santoso</h3>
                        <p class="text-primary font-medium text-sm uppercase tracking-wide">Project Manager</p>
                        <p class="text-base-content/60 text-sm line-clamp-2">Menjaga proyek tetap on-track dan klien tetap bahagia.</p>
                        <div class="card-actions mt-4">
                            <a href="{{ route('team.show') }}" class="btn btn-outline btn-primary btn-sm rounded-full">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Member 4 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 group">
                    <figure class="px-4 pt-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1888&auto=format&fit=crop" alt="Member" class="rounded-xl w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-xl">Linda Wijaya</h3>
                        <p class="text-primary font-medium text-sm uppercase tracking-wide">Content Strategist</p>
                        <p class="text-base-content/60 text-sm line-clamp-2">Merangkai kata-kata yang memikat dan menjual.</p>
                        <div class="card-actions mt-4">
                            <a href="{{ route('team.show') }}" class="btn btn-outline btn-primary btn-sm rounded-full">Lihat Detail</a>
                        </div>
                    </div>
                </div>
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