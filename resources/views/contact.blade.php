<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', ['title' => 'Kontak - Kuukok | Hubungi Kami'])
    <meta name="description" content="Hubungi tim Kuukok untuk konsultasi proyek web development, design, atau kerjasama lainnya.">
</head>

<body class="bg-base-100 font-sans min-h-screen flex flex-col">
    @include('components.navbar')

    <!-- Breadcrumb -->
    <div class="bg-base-200 px-4 pb-8 pt-24">
        <div class="mx-auto max-w-7xl">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary">Home</a></li>
                    <li>Kontak</li>
                </ul>
            </div>
            <h1 class="mb-2 mt-4 text-4xl font-bold md:text-5xl text-base-content">Hubungi Kami</h1>
            <p class="text-lg text-base-content/70">
                Diskusikan ide proyek Anda atau sekadar menyapa kami
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-base-100 px-4 py-12 flex-grow">
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">

                <!-- Contact Info & Map -->
                <div class="space-y-8">
                    <div class="prose max-w-none">
                        <p class="text-lg">
                            Kami selalu senang mendengar dari Anda. Apakah Anda memiliki pertanyaan tentang layanan kami, ingin meminta penawaran, atau ingin berkolaborasi? Jangan ragu untuk menghubungi kami.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Address -->
                        <div class="card bg-base-200 shadow-sm">
                            <div class="card-body p-6">
                                <h3 class="flex items-center gap-2 text-lg font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Alamat
                                </h3>
                                <p class="text-base-content/70">
                                    Jl. Raya Ahmad Yani<br>
                                    Subang, Jawa Barat<br>
                                    Indonesia
                                </p>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div class="card bg-base-200 shadow-sm">
                            <div class="card-body p-6">
                                <h3 class="flex items-center gap-2 text-lg font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Kontak
                                </h3>
                                <p class="text-base-content/70">
                                    <a href="mailto:info@kuukok.test" class="hover:text-primary">info@kuukok.test</a><br>
                                    <a href="tel:+6281234567890" class="hover:text-primary">+62 812 3456 7890</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Map Placeholder -->
                    <div class="card bg-base-200 shadow-xl overflow-hidden h-64 relative">
                        <div class="absolute inset-0 bg-neutral/10 flex items-center justify-center">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-base-content/30 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-1.447-.894L15 7m0 13V7" />
                                </svg>
                                <span class="text-base-content/50 font-medium">Peta Lokasi (Google Maps Embed)</span>
                            </div>
                        </div>
                        <!-- Replace with actual Google Maps iframe -->
                        <!-- <iframe src="..." width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="font-bold text-lg mb-4">Ikuti Kami</h3>
                        <div class="flex gap-4">
                            <a href="#" class="btn btn-circle btn-ghost bg-base-200 hover:bg-primary hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                            </a>
                            <a href="#" class="btn btn-circle btn-ghost bg-base-200 hover:bg-primary hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.072 3.252.158 4.777 1.691 4.935 4.935.06 1.266.072 1.646.072 4.85s-.012 3.584-.072 4.85c-.158 3.252-1.683 4.777-4.935 4.935-1.266.06-1.646.072-4.85.072s-3.584-.012-4.85-.072c-3.252-.158-4.777-1.691-4.935-4.935-.06-1.266-.072-1.646-.072-4.85s.012-3.584.072-4.85c.158-3.252 1.683-4.777 4.935-4.935 1.266-.06 1.646-.072 4.85-.072zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="#" class="btn btn-circle btn-ghost bg-base-200 hover:bg-primary hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <div class="card bg-base-100 shadow-2xl border border-base-200">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-4">Kirim Pesan</h2>
                            <form action="#" method="POST">
                                <div class="form-control w-full mb-4">
                                    <label class="label">
                                        <span class="label-text font-medium">Nama Lengkap</span>
                                    </label>
                                    <input type="text" placeholder="Masukkan nama Anda" class="input input-bordered w-full focus:input-primary" />
                                </div>

                                <div class="form-control w-full mb-4">
                                    <label class="label">
                                        <span class="label-text font-medium">Email</span>
                                    </label>
                                    <input type="email" placeholder="contoh@email.com" class="input input-bordered w-full focus:input-primary" />
                                </div>

                                <div class="form-control w-full mb-4">
                                    <label class="label">
                                        <span class="label-text font-medium">Subjek</span>
                                    </label>
                                    <select class="select select-bordered w-full focus:select-primary">
                                        <option disabled selected>Pilih subjek pesan</option>
                                        <option>Penawaran Proyek</option>
                                        <option>Konsultasi</option>
                                        <option>Kerjasama</option>
                                        <option>Lainnya</option>
                                    </select>
                                </div>

                                <div class="form-control w-full mb-6">
                                    <label class="label">
                                        <span class="label-text font-medium">Pesan</span>
                                    </label>
                                    <textarea class="textarea textarea-bordered h-32 focus:textarea-primary" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                                </div>

                                <div class="card-actions justify-end">
                                    <button class="btn btn-primary w-full md:w-auto text-white">
                                        Kirim Pesan
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!-- FAQ Section -->
            <div class="mt-24">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4">Pertanyaan Umum</h2>
                    <p class="text-base-content/70 max-w-2xl mx-auto">
                        Beberapa pertanyaan yang sering diajukan oleh klien kami.
                    </p>
                </div>
                <div class="max-w-3xl mx-auto space-y-4">
                    <div class="collapse collapse-plus bg-base-200">
                        <input type="radio" name="my-accordion-3" checked="checked" />
                        <div class="collapse-title text-xl font-medium">
                            Berapa lama waktu pengerjaan website?
                        </div>
                        <div class="collapse-content">
                            <p>Waktu pengerjaan bervariasi tergantung kompleksitas proyek. Untuk website profil perusahaan standar biasanya memakan waktu 2-4 minggu, sedangkan aplikasi web yang lebih kompleks bisa memakan waktu 2-3 bulan atau lebih.</p>
                        </div>
                    </div>
                    <div class="collapse collapse-plus bg-base-200">
                        <input type="radio" name="my-accordion-3" />
                        <div class="collapse-title text-xl font-medium">
                            Apa saja yang perlu saya siapkan sebelum memulai proyek?
                        </div>
                        <div class="collapse-content">
                            <p>Anda perlu menyiapkan konten (teks, gambar, logo), referensi desain yang diinginkan, dan deskripsi fitur yang dibutuhkan. Tim kami akan membantu Anda merumuskan kebutuhan teknisnya.</p>
                        </div>
                    </div>
                    <div class="collapse collapse-plus bg-base-200">
                        <input type="radio" name="my-accordion-3" />
                        <div class="collapse-title text-xl font-medium">
                            Apakah ada layanan maintenance setelah website selesai?
                        </div>
                        <div class="collapse-content">
                            <p>Ya, kami menyediakan layanan maintenance dan support gratis selama 30 hari setelah website live. Setelah itu, Anda bisa memilih paket maintenance bulanan atau tahunan kami.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-24 mb-12">
                <div class="card bg-gradient-to-r from-primary to-primary-focus text-primary-content shadow-xl overflow-hidden relative">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="h-full w-full" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="currentColor" />
                        </svg>
                    </div>

                    <div class="card-body p-8 md:p-12 relative z-10 text-center">
                        <h2 class="card-title text-3xl md:text-4xl font-bold justify-center mb-4 text-white">
                            Siap Mewujudkan Ide Digital Anda?
                        </h2>
                        <p class="text-lg opacity-90 mb-8 max-w-2xl mx-auto text-white">
                            Jangan ragu untuk berkonsultasi dengan kami. Kami siap membantu mentransformasi bisnis Anda ke ranah digital.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="https://wa.me/6281234567890" class="btn btn-secondary border-none text-white hover:bg-white hover:text-primary transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                Chat WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('components.footer')
</body>

</html>