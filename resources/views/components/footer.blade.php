<footer class="bg-base-100">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-16 space-y-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="space-y-3">
                <div class="text-2xl font-bold text-base-content">{{ config('app.name') }}</div>
                <div class="text-base font-medium text-base-content">Hubungi Kami</div>
                <ul class="text-sm text-base-content/70 space-y-1">
                    <li><a href="mailto:info@kuukok.test" class="hover:text-primary">info@kuukok.test</a></li>
                    <li>Jl. Raya Ahmad Yani</li>
                    <li>Subang</li>
                </ul>
            </div>

            <div class="space-y-3">
                <div class="text-base font-bold text-base-content">Kategori Tulisan</div>
                @php
                $__categories = collect($categories ?? ['Programming','Teknologi','Gaya Hidup']);
                $__show = $__categories->take(6);
                $__more = $__categories->count() > 6;
                @endphp
                <ul class="text-sm text-base-content/70 space-y-1">
                    @foreach ($__show as $cat)
                    <li><a href="#" class="hover:text-primary">{{ is_string($cat) ? $cat : ($cat->name ?? 'Kategori') }}</a></li>
                    @endforeach
                    @if ($__more)
                    <li><a href="#" class="text-primary">Lihat kategori lainnya</a></li>
                    @endif
                </ul>
            </div>

            <div class="space-y-3">
                <div class="text-base font-bold text-base-content">Tautan</div>
                <ul class="text-sm text-base-content/70 space-y-1">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">Home</a></li>
                    <li><a href="#tentang-kami" class="hover:text-primary">Tentang Kami</a></li>
                    <li><a href="{{ route('portfolio.index') }}" class="hover:text-primary">Portofolio</a></li>
                    <li><a href="#pricing" class="hover:text-primary">Harga</a></li>
                    <li><a href="#testimoni" class="hover:text-primary">Testimoni</a></li>
                    <li><a href="#artikel" class="hover:text-primary">Artikel</a></li>
                    <li><a href="#kontak" class="hover:text-primary">Kontak</a></li>
                </ul>
            </div>
        </div>

        <div class="divider"></div>
        <div class="flex flex-col items-center gap-4">
            <p class="text-xs text-base-content/60">Dibuat dengan cinta oleh {{ config('app.name') }}, menggunakan <a href="https://tailwindcss.com" class="link link-primary">Tailwind CSS</a>.</p>
        </div>
    </div>
</footer>
