<footer class="bg-section-footer">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-16 space-y-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="space-y-3">
                <div class="text-2xl font-bold text-white">{{ config('app.name') }}</div>
                <div class="text-base font-medium text-white">Hubungi Kami</div>
                <ul class="text-sm text-gray-400 space-y-1">
                    <li><a href="mailto:info@kuukok.test" class="hover:text-primary">info@kuukok.test</a></li>
                    <li>Jl. Raya Ahmad Yani</li>
                    <li>Subang</li>
                </ul>
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
                </ul>
            </div>
        </div>

        <div class="divider before:bg-gray-700 after:bg-gray-700"></div>
        <div class="flex flex-col items-center gap-4">
            <p class="text-xs text-gray-500">Dibuat dengan cinta oleh {{ config('app.name') }}, menggunakan <a href="https://tailwindcss.com" class="link link-primary">Tailwind CSS</a>.</p>
        </div>
    </div>
</footer>
