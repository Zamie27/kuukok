<nav class="custom-navbar w-full z-[9999] bg-gradient-to-b from-base-100/70 to-transparent border-b border-base-300">
    <div class="navbar container mx-auto px-4 lg:px-8">
        <div class="navbar-start">
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl font-bold text-white mix-blend-difference">{{ config('app.name') }}</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1 text-white mix-blend-difference">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about.index') }}">Tentang Kami</a></li>
                <li><a href="{{ route('portfolio.index') }}">Portofolio</a></li>
                <li><a href="{{ route('pricing.index') }}">Harga</a></li>
                <li><a href="{{ route('blog.index') }}">Artikel</a></li>
                <li><a href="{{ route('contact.index') }}">Kontak</a></li>
            </ul>
        </div>
        <div class="navbar-end gap-2">
            <!-- Theme toggle uses localStorage key 'kuukok-theme' handled in resources/js/app.js -->
            <button type="button" id="themeToggleBtn" class="btn btn-ghost btn-circle text-white mix-blend-difference" aria-label="Toggle theme">
                <svg class="h-6 w-6 mix-blend-difference" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364 6.364-1.414-1.414M6.05 6.05 4.636 4.636m12.728 0-1.414 1.414M6.05 17.95l-1.414 1.414M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                </svg>
            </button>
            @auth
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost btn-sm text-white mix-blend-difference">Dashboard</a>
            @endauth
            <!-- Mobile menu -->
            <div class="dropdown dropdown-end lg:hidden">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about.index') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('portfolio.index') }}">Portofolio</a></li>
                    <li><a href="{{ route('pricing.index') }}">Harga</a></li>
                    <li><a href="{{ route('blog.index') }}">Artikel</a></li>
                    <li><a href="{{ route('contact.index') }}">Kontak</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
