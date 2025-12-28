<footer class="bg-section-footer">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-16 space-y-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="space-y-3">
                <div class="text-2xl font-bold text-white">{{ config('app.name') }}</div>
                <div class="text-base font-medium text-white">Hubungi Kami</div>
                <ul class="text-sm text-gray-400 space-y-1">
                    @php use App\Models\Setting; @endphp
                    <li><a href="mailto:{{ Setting::getValue('contact_email', 'info@kuukok.com') }}" class="hover:text-primary">{{ Setting::getValue('contact_email', 'info@kuukok.com') }}</a></li>
                    <li class="whitespace-pre-line">{{ Setting::getValue('contact_address', "Jl. Raya Ahmad Yani\nSubang, Jawa Barat") }}</li>
                </ul>
                <div class="flex gap-4 pt-2">
                    @if(Setting::getValue('social_facebook'))
                    <a href="{{ Setting::getValue('social_facebook') }}" target="_blank" class="text-gray-400 hover:text-white"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg></a>
                    @endif
                    @if(Setting::getValue('social_instagram'))
                    <a href="{{ Setting::getValue('social_instagram') }}" target="_blank" class="text-gray-400 hover:text-white"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.072 3.252.158 4.777 1.691 4.935 4.935.06 1.266.072 1.646.072 4.85s-.012 3.584-.072 4.85c-.158 3.252-1.683 4.777-4.935 4.935-1.266.06-1.646.072-4.85.072s-3.584-.012-4.85-.072c-3.252-.158-4.777-1.691-4.935-4.935-.06-1.266-.072-1.646-.072-4.85s.012-3.584.072-4.85c.158-3.252 1.683-4.777 4.935-4.935 1.266-.06 1.646-.072 4.85-.072zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg></a>
                    @endif
                    @if(Setting::getValue('social_linkedin'))
                    <a href="{{ Setting::getValue('social_linkedin') }}" target="_blank" class="text-gray-400 hover:text-white"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg></a>
                    @endif
                </div>
            </div>

            <div class="space-y-3">
                <div class="text-base font-bold text-white">Kategori Tulisan</div>
                <ul class="text-sm text-gray-400 space-y-1">
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary">Tutorial</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary">Tips & Trik</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary">Insight</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary">Design</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary">Web Performance</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary">Security</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <div class="text-base font-bold text-white">Tautan</div>
                <ul class="text-sm text-gray-400 space-y-1">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">Home</a></li>
                    <li><a href="{{ route('about.index') }}" class="hover:text-primary">Tentang Kami</a></li>
                    <li><a href="{{ route('portfolio.index') }}" class="hover:text-primary">Portofolio</a></li>
                    <li><a href="{{ route('pricing.index') }}" class="hover:text-primary">Harga</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary">Artikel</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-primary">Kontak</a></li>
                    <li>
                        @auth
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary opacity-60">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" class="hover:text-primary opacity-60">Login</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>

        <div class="divider before:bg-gray-700 after:bg-gray-700"></div>
        <div class="flex flex-col items-center gap-4">
            <p class="text-xs text-gray-500">Dibuat dengan cinta oleh {{ config('app.name') }}, menggunakan <a href="https://tailwindcss.com" class="link link-primary">Tailwind CSS</a>.</p>
        </div>
    </div>
</footer>
