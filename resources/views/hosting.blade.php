<!DOCTYPE html>
<html lang="id" data-theme="light" class="scroll-smooth">

<head>
    @include('components.head', [
    'title' => 'Hosting Web Premium - Kuukok Creative Agency',
    'description' => 'Layanan cloud hosting premium dengan performa tinggi, SSD NVMe, dan support 24/7 untuk website Anda.',
    'keywords' => 'hosting murah, cloud hosting, hosting website, jasa hosting subang',
    'ogUrl' => route('hosting.index')
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
                    <li>Hosting Web</li>
                </ul>
            </div>
            <h1 class="mb-2 mt-4 text-4xl font-bold md:text-5xl text-base-content">Layanan Hosting Web</h1>
            <p class="text-lg text-base-content/70">
                Pilih paket hosting yang sesuai dengan kebutuhan dan budget website Anda.
            </p>
        </div>
    </div>

    <!-- Pricing Section (Cloned Style) -->
    <section id="pricing" class="relative bg-section-light">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-16 space-y-10 pricing">
            <div class="pricing__grid reveal-on-scroll">
                @foreach($packages as $package)
                @php
                    $isPopular = str_contains($package->label ?? '', 'Paling Laris');
                @endphp
                <article class="pricing__card interactive-transition {{ $isPopular ? 'pricing__card--recommended scale-105 z-10 shadow-2xl' : '' }}">
                    <div class="card-body p-8 space-y-6">
                        @if($package->label)
                        <div class="badge {{ $isPopular ? 'badge-primary badge-lg text-white mb-2' : 'badge-outline' }}">
                            {{ $package->label }}
                        </div>
                        @else
                        <div class="badge badge-outline">
                            Hosting
                        </div>
                        @endif
                        <h3 class="text-2xl font-bold text-base-content">{{ $package->name }}</h3>
                        <div class="pricing__price text-4xl">{!! str_replace('/bln', '<span class="text-sm font-normal text-base-content/60">/bln</span>', $package->price_text) !!}</div>
                        
                        <ul class="text-base text-base-content/70 space-y-3">
                            @foreach($package->features as $feature)
                            <li class="flex items-center gap-3">
                                <span class="text-primary font-bold">✓</span> {{ $feature }}
                            </li>
                            @endforeach
                        </ul>

                        <a href="{{ $package->cta_link ?? route('contact.index', ['service' => 'hosting_' . Str::slug($package->name)]) }}" class="pricing__cta btn-lg text-lg">
                            {{ $package->label ? 'Beli Sekarang' : 'Pilih Paket' }}
                        </a>
                    </div>
                </article>
                @endforeach

                @if($packages->isEmpty())
                <div class="col-span-full text-center py-10">
                    <p class="text-xl opacity-50 italic">Belum ada paket hosting yang tersedia.</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Kelebihan & Pertimbangan Hosting -->
    <section class="py-16 px-4 bg-base-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Kelebihan & Pertimbangan Hosting</h2>
                <p class="text-base-content/70 text-lg">Pahami detail layanan kami untuk performa website terbaik</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 reveal-on-scroll">
                <!-- Kelebihan -->
                <div class="card bg-base-200/50 shadow-sm border border-base-300">
                    <div class="card-body">
                        <h3 class="card-title text-success mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Kelebihan Hosting Kuukok
                        </h3>
                        <ul class="space-y-3 font-medium">
                            @php
                                $pros = explode("\n", $settings['hosting_pros_items'] ?? "Performa ultra-cepat dengan NVMe SSD Storage\nKeamanan tingkat tinggi dengan Anti-DDoS & Malware Scan\nSupport teknis 24/7 bahasa Indonesia\nUptime guarantee 99.9% untuk bisnis Anda");
                            @endphp
                            @foreach($pros as $pro)
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-success font-bold">✓</span>
                                <span>{{ trim($pro) }}</span>
                            </li>
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
                            Hal yang Perlu Diperhatikan
                        </h3>
                        <ul class="space-y-3 font-medium">
                            @php
                                $cons = explode("\n", $settings['hosting_cons_items'] ?? "Biaya perpanjangan tahunan untuk Domain & Hosting\nWajib mematuhi ToS (Terms of Service) penggunaan server\nPencadangan data berkala sangat disarankan (Bantuan tersedia)");
                            @endphp
                            @foreach($cons as $con)
                            <li class="flex items-start gap-3">
                                <span class="mt-1 text-warning font-bold">!</span>
                                <span>{{ trim($con) }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section (From Home/Pricing) -->
    <section id="testimoni" class="relative bg-section-secondary">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 md:py-28 space-y-10 testimoni">
            <div class="text-center space-y-3 reveal-on-scroll text-base-content">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight">Testimoni Klien</h2>
                <p class="text-base md:text-lg opacity-90">Kepuasan Anda adalah prioritas utama infrastruktur kami</p>
            </div>

            <!-- Marquee Carousel -->
            <div class="relative w-full overflow-hidden reveal-on-scroll">
                <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-base-100 to-transparent z-10 pointer-events-none"></div>
                <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-base-100 to-transparent z-10 pointer-events-none"></div>

                <div class="flex animate-marquee gap-6 w-max">
                    @foreach($testimonials as $testimonial)
                    <article class="testimoni__card border border-base-200">
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
                            <p class="testimoni__quote italic">"{{ $testimonial->content }}"</p>
                        </div>
                    </article>
                    @endforeach

                    <!-- Duplicate for infinite scroll -->
                    @foreach($testimonials as $testimonial)
                    <article class="testimoni__card border border-base-200">
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
                            <p class="testimoni__quote italic">"{{ $testimonial->content }}"</p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section (Cloned logic) -->
    <div class="py-16 px-4 bg-base-200">
        <div class="max-w-4xl mx-auto reveal-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Pertanyaan Seputar Hosting</h2>
                <p class="text-base-content/70">Segala yang perlu Anda ketahui tentang layanan cloud kami</p>
            </div>

            <div class="space-y-4">
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" checked />
                    <div class="collapse-title text-xl font-medium">
                        Apa itu layanan hosting capstone ini?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Layanan ini membantu mahasiswa untuk meng-online-kan website capstone agar bisa diakses secara online saat demo atau sidang, tanpa perlu repot setup server sendiri.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Berapa lama masa aktif hosting?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Hosting aktif hingga akhir periode capstone (± sampai bulan September atau sesuai kebutuhan semester).</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apa perbedaan Basic dan Pro?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Basic: kamu deploy sendiri (self deploy)<br>Pro: deploy dibantu oleh admin (langsung jadi & siap pakai)</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah bisa pakai domain sendiri?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Bisa. Kamu bisa memilih paket Custom Domain atau Full Service untuk menggunakan domain pribadi seperti .my.id atau .web.id dan lainnya.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah website saya aman?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Ya. Semua website sudah menggunakan SSL (HTTPS) sehingga aman saat diakses.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah saya dapat akses ke hosting?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Ya. Kamu akan mendapatkan Akses FTP dan Akses database MySQL.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah ada batasan penggunaan?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Untuk menjaga stabilitas server bersama, Website dengan penggunaan resource berlebihan (CPU, RAM, atau storage) dapat ditangguhkan sementara.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Bagaimana sistem pembayarannya?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Pembayaran dilakukan melalui metode yang tersedia (transfer / QRIS), kemudian user mengupload bukti pembayaran melalui dashboard untuk dikonfirmasi oleh admin.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Berapa lama proses aktivasi?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Setelah pembayaran dikonfirmasi, Estimasi 1–24 jam (tergantung antrean).</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Jam operasional admin?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Jam kerja admin: 12.00 – 22.00 WIB. Diluar jam tersebut, respon tergantung ketersediaan admin.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Jika ada kendala bagaimana?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Kamu bisa menghubungi admin melalui halaman Kontak yang tersedia di website untuk bantuan lebih lanjut.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apa itu sistem referral?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Setiap user akan mendapatkan kode undangan unik yang bisa dibagikan ke teman.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Berapa cashback yang didapat?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Rp10.000 per user yang berhasil diundang. Maksimal cashback: Rp30.000 per user withdraw.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Kapan cashback diberikan?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Cashback akan masuk jika user yang diundang melakukan pemesanan paket hosting (berbayar).</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah semua user bisa langsung dapat cashback?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Tidak. Kode referral hanya aktif sebagai penerima cashback jika user yang membagikan kode sudah pernah melakukan pemesanan hosting.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Berapa lama masa berlaku referral?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Referral berlaku selama 30 hari. Jika tidak ada aktivitas dalam 30 hari: cashback akan hangus.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah cashback bisa dicairkan?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Ya, cashback dapat dicairkan dengan mengisi Metode (Bank / E-Wallet) dan Nama pemilik akun. Proses pencairan dilakukan oleh admin.</p>
                    </div>
                </div>
                <div class="collapse collapse-plus bg-base-100 shadow border border-base-200">
                    <input type="radio" name="faq-accordion" />
                    <div class="collapse-title text-xl font-medium">
                        Apakah bisa membuat akun dummy untuk referral?
                    </div>
                    <div class="collapse-content text-base-content/70">
                        <p>Tidak, karena cashback hanya dihitung jika user yang diundang melakukan pembayaran dan sistem akan divalidasi oleh admin.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-base-200 px-4 py-20 reveal-on-scroll">
        <div class="mx-auto max-w-5xl">
            <div class="card to-primary-focus bg-gradient-to-br from-primary text-white shadow-2xl">
                <div class="card-body py-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold md:text-4xl">
                        Website Lambat Bikin Rugi?
                    </h2>
                    <p class="mx-auto mb-6 max-w-2xl text-lg opacity-90">
                        Pindahkan website Anda sekarang dan rasakan performa cloud kelas dunia.
                    </p>
                    <div class="flex flex-col justify-center gap-4 sm:flex-row">
                        <a href="{{ route('contact.index', ['service' => 'hosting_consultation']) }}" class="btn btn-accent btn-lg text-neutral font-bold border-none">
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
