@php
    $dashboardRoute = Auth::user()->isStaff() ? route('admin.dashboard') : route('user.dashboard');
    $isDashboard = request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard');
@endphp
<aside class="min-h-full w-80 bg-base-100 text-base-content border-r border-base-300 flex flex-col">
    <div class="p-6 mb-2 hidden lg:block">
        <a href="{{ $dashboardRoute }}" class="text-2xl font-bold text-primary flex items-center gap-2">
            <span>Kuukok{{ Auth::user()->isStaff() ? ' Admin' : '' }}</span>
        </a>
    </div>

    <ul class="menu w-full px-4 space-y-1">
        <li>
            <a href="{{ $dashboardRoute }}" aria-current="{{ $isDashboard ? 'page' : '' }}" class="{{ $isDashboard ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
        </li>
        @if(Auth::user()->isStaff())
        <li>
            <a href="{{ route('admin.posts.index') }}" aria-current="{{ (request()->routeIs('admin.posts.*') || request()->is('admin/posts*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.posts.*') || request()->is('admin/posts*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                Post/Artikel
            </a>
        </li>
        <li>
            <a href="{{ route('admin.packages.index') }}" aria-current="{{ (request()->routeIs('admin.packages.*') || request()->is('admin/packages*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.packages.*') || request()->is('admin/packages*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Manajemen Harga
            </a>
        </li>
        <li>
            <a href="{{ route('admin.hosting-packages.index') }}" aria-current="{{ (request()->routeIs('admin.hosting-packages.*') || request()->is('admin/hosting-packages*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.hosting-packages.*') || request()->is('admin/hosting-packages*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                </svg>
                Manajemen Hosting
            </a>
        </li>
        <li>
            <a href="{{ route('admin.hosting-orders.index') }}" aria-current="{{ (request()->routeIs('admin.hosting-orders.*') || request()->is('admin/hosting-orders*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.hosting-orders.*') || request()->is('admin/hosting-orders*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Pesanan Hosting
            </a>
        </li>
        <li>
            <a href="{{ route('admin.portfolios.index') }}" aria-current="{{ (request()->routeIs('admin.portfolios.*') || request()->is('admin/portfolios*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.portfolios.*') || request()->is('admin/portfolios*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Portfolio
            </a>
        </li>
        <li>
            <a href="{{ route('admin.messages.index') }}" aria-current="{{ (request()->routeIs('admin.messages.*') || request()->is('admin/messages*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.messages.*') || request()->is('admin/messages*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Kontak
            </a>
        </li>
        <li>
            <a href="{{ route('admin.testimonials.index') }}" aria-current="{{ (request()->routeIs('admin.testimonials.*') || request()->is('admin/testimonials*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.testimonials.*') || request()->is('admin/testimonials*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Testimonial
            </a>
        </li>
        <li>
            <a href="{{ route('admin.faqs.index') }}" aria-current="{{ (request()->routeIs('admin.faqs.*') || request()->is('admin/faqs*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.faqs.*') || request()->is('admin/faqs*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                FAQ
            </a>
        </li>
        <li>
            <a href="{{ route('admin.settings.index') }}" aria-current="{{ (request()->routeIs('admin.settings.*') || request()->is('admin/settings*') || request()->routeIs('admin.tech-stacks.*') || request()->is('admin/tech-stacks*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.settings.*') || request()->is('admin/settings*') || request()->routeIs('admin.tech-stacks.*') || request()->is('admin/tech-stacks*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Pengaturan Website
            </a>
        </li>
        @endif
        @can('manage-users')
        <li>
            <a href="{{ route('admin.users.index') }}" aria-current="{{ (request()->routeIs('admin.users.*') || request()->is('admin/users*')) ? 'page' : '' }}" class="{{ (request()->routeIs('admin.users.*') || request()->is('admin/users*')) ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Manajemen User
            </a>
        </li>
        @endcan
        @if(Auth::user()->isStaff())
        <li>
            <a href="{{ route('admin.cashback-withdrawals.index') }}" aria-current="{{ request()->routeIs('admin.cashback-withdrawals.*') ? 'page' : '' }}" class="{{ request()->routeIs('admin.cashback-withdrawals.*') ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Pencairan Cashback
            </a>
        </li>
        @endif
        
        @if(Auth::user()->isUser())
        <div class="divider text-xs opacity-50 uppercase px-4 mt-4">Hosting</div>
        <li>
            <a href="{{ route('user.hosting.buy') }}" aria-current="{{ request()->routeIs('user.hosting.buy') || request()->routeIs('user.hosting.order') ? 'page' : '' }}" class="{{ request()->routeIs('user.hosting.buy') || request()->routeIs('user.hosting.order') ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Beli Hosting
            </a>
        </li>
        <li>
            <a href="{{ route('user.hosting.my-services') }}" aria-current="{{ request()->routeIs('user.hosting.my-services') ? 'page' : '' }}" class="{{ request()->routeIs('user.hosting.my-services') ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                </svg>
                Layanan Saya
            </a>
        <li>
            <a href="{{ route('user.cashback.index') }}" aria-current="{{ request()->routeIs('user.cashback.*') ? 'page' : '' }}" class="{{ request()->routeIs('user.cashback.*') ? 'menu-active active bg-base-300 text-base-content rounded-md' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Cashback Saya
            </a>
        </li>
        @endif
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="text-error hover:bg-error/10 hover:text-error flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Logout</span>
                </a>
            </form>
        </li>
    </ul>
</aside>
