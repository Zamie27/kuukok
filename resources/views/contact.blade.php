@use('App\Models\Setting')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', [
    'title' => 'Kontak - Kuukok | Hubungi Kami',
    'meta_description' => 'Hubungi tim Kuukok untuk konsultasi proyek web development, design, atau kerjasama lainnya.'
    ])
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
                                <p class="text-base-content/70 whitespace-pre-line">{{ \App\Models\Setting::getValue('contact_address', "Jl. Raya Ahmad Yani\nSubang, Jawa Barat\nIndonesia") }}</p>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div class="card bg-base-200 shadow-sm">
                            <div class="card-body p-6">
                                <h3 class="flex items-center gap-2 text-lg font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Kontak
                                </h3>
                                <div class="space-y-2">
                                    <p class="text-base-content/70">
                                        <span class="block font-semibold text-base-content">Email:</span>
                                        <a href="mailto:{{ \App\Models\Setting::getValue('contact_email', 'hello@kuukok.com') }}" class="link link-hover">{{ \App\Models\Setting::getValue('contact_email', 'hello@kuukok.com') }}</a>
                                    </p>
                                    <p class="text-base-content/70">
                                        <span class="block font-semibold text-base-content">Telepon/WhatsApp:</span>
                                        <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', \App\Models\Setting::getValue('contact_phone', '6281234567890')) }}" class="link link-hover">{{ \App\Models\Setting::getValue('contact_phone', '+62 812 3456 7890') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Placeholder -->
                    <div class="card bg-base-200 shadow-xl overflow-hidden h-64 relative">
                        @if(Setting::getValue('contact_maps'))
                        {!! Setting::getValue('contact_maps') !!}
                        @else
                        <div class="absolute inset-0 bg-neutral/10 flex items-center justify-center">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-base-content/30 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-1.447-.894L15 7m0 13V7" />
                                </svg>
                                <span class="text-base-content/50 font-medium">Peta Lokasi (Google Maps Embed)</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="font-bold text-lg mb-4">Ikuti Kami</h3>
                        <div class="flex gap-4 flex-wrap">
                            @if(Setting::getValue('social_facebook'))
                            <a href="{{ Setting::getValue('social_facebook') }}" target="_blank" class="btn btn-circle btn-ghost bg-base-200 hover:bg-primary hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            @endif
                            @if(Setting::getValue('social_twitter'))
                            <a href="{{ Setting::getValue('social_twitter') }}" target="_blank" class="btn btn-circle btn-ghost bg-base-200 hover:bg-primary hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </a>
                            @endif
                            @if(Setting::getValue('social_instagram'))
                            <a href="{{ Setting::getValue('social_instagram') }}" target="_blank" class="btn btn-circle btn-ghost bg-base-200 hover:bg-primary hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.072 3.252.158 4.777 1.691 4.935 4.935.06 1.266.072 1.646.072 4.85s-.012 3.584-.072 4.85c-.158 3.252-1.683 4.777-4.935 4.935-1.266.06-1.646.072-4.85.072s-3.584-.012-4.85-.072c-3.252-.158-4.777-1.691-4.935-4.935-.06-1.266-.072-1.646-.072-4.85s.012-3.584.072-4.85c.158-3.252 1.683-4.777 4.935-4.935 1.266-.06 1.646-.072 4.85-.072zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            @endif
                            @if(Setting::getValue('social_linkedin'))
                            <a href="{{ Setting::getValue('social_linkedin') }}" target="_blank" class="btn btn-circle btn-ghost bg-base-200 hover:bg-primary hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                            @endif
                            @if(Setting::getValue('social_github'))
                            <a href="{{ Setting::getValue('social_github') }}" target="_blank" class="btn btn-circle btn-ghost bg-base-200 hover:bg-primary hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <div class="card bg-base-100 shadow-2xl border border-base-200">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-4">Kirim Pesan</h2>
                            @if (session('status'))
                            <div class="alert alert-success mb-4">
                                <div><span>{{ session('status') }}</span></div>
                            </div>
                            @endif
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="mb-8 w-full">
                                    <label for="name" class="text-base font-bold text-primary block mb-2">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama Anda" class="input border-none w-full bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-500" required />
                                </div>

                                <div class="mb-8 w-full">
                                    <label for="email" class="text-base font-bold text-primary block mb-2">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="contoh@email.com" class="input border-none w-full bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-500" required />
                                </div>

                                <div class="mb-8 w-full">
                                    <label for="subject" class="text-base font-bold text-primary block mb-2">Subjek</label>
                                    @php
                                    $subjects = array_filter(array_map('trim', explode("\n", Setting::getValue('contact_subjects', "Penawaran Proyek\nKonsultasi\nKerjasama\nLainnya"))));
                                    @endphp
                                    <select name="subject" id="subject" class="select border-none w-full bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-500">
                                        <option value="" disabled selected>Pilih Subjek Pesan</option>
                                        @foreach($subjects as $subj)
                                        <option value="{{ $subj }}" {{ old('subject') == $subj ? 'selected' : '' }}>{{ $subj }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-8 w-full">
                                    <label for="body" class="text-base font-bold text-primary block mb-2">Pesan</label>
                                    <textarea name="body" id="body" class="textarea border-none w-full h-32 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary placeholder-slate-500" placeholder="Tuliskan pesan Anda di sini..." required>{{ old('body') }}</textarea>
                                </div>

                                <div class="card-actions justify-end">
                                    <button class="btn btn-primary w-full md:w-auto text-white rounded-full px-8">
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
                    <h2 class="text-3xl font-bold mb-4">{{ Setting::getValue('faq_title', 'Pertanyaan Umum') }}</h2>
                    <p class="text-base-content/70 max-w-2xl mx-auto">
                        {{ Setting::getValue('faq_description', 'Beberapa pertanyaan yang sering diajukan oleh klien kami.') }}
                    </p>
                </div>
                <div class="max-w-3xl mx-auto space-y-4">
                    @foreach($faqs as $faq)
                    <div class="collapse collapse-plus bg-base-200">
                        <input type="radio" name="faq-accordion" @checked($loop->first) />
                        <div class="collapse-title text-xl font-medium">
                            {{ $faq->question }}
                        </div>
                        <div class="collapse-content">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                    @endforeach
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
