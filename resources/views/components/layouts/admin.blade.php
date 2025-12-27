<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Dashboard' }} - Kuukok</title>
    <link rel="icon" href="{{ asset('image/icon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('image/icon.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script>
        // Initialize theme from localStorage or system preference
        if (localStorage.getItem('kuukok-theme') === 'dark' || (!('kuukok-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
        }
    </script>
</head>

<body class="bg-base-200 font-sans antialiased">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col min-h-screen">
            <!-- Navbar -->
            @include('components.admin-navbar')

            <!-- Page Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
        <div class="drawer-side z-40">
            <label for="my-drawer-2" class="drawer-overlay"></label>
            @include('components.admin-sidebar')
        </div>
    </div>

    <script>
        // Theme toggle logic
        document.addEventListener('DOMContentLoaded', () => {
            const themeController = document.querySelector('.theme-controller');
            if (themeController) {
                // Set initial state based on current attribute
                themeController.checked = document.documentElement.getAttribute('data-theme') === 'dark';

                themeController.addEventListener('change', function(e) {
                    const theme = e.target.checked ? 'dark' : 'light';
                    document.documentElement.setAttribute('data-theme', theme);
                    localStorage.setItem('kuukok-theme', theme);
                });
            }
        });
    </script>
</body>

</html>
