<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name', 'Kuukok') }}</title>
<meta name="description" content="{{ $meta_description ?? 'Kuukok - Solusi digital profesional untuk pertumbuhan bisnis Anda. Web development, desain grafis, dan penulisan konten berkualitas.' }}">
<meta name="keywords" content="{{ $keywords ?? 'web development, graphic design, content writing, digital agency, kuukok' }}">
<meta name="author" content="Kuukok">
<meta name="robots" content="index, follow">

<script>
    // Theme Initialization
    if (localStorage.getItem('kuukok-theme') === 'dark' || (!('kuukok-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.setAttribute('data-theme', 'dark');
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
    }
</script>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $og_type ?? 'website' }}">
<meta property="og:url" content="{{ $og_url ?? url()->current() }}">
<meta property="og:title" content="{{ $title ?? config('app.name', 'Kuukok') }}">
<meta property="og:description" content="{{ $meta_description ?? 'Kuukok - Solusi digital profesional untuk pertumbuhan bisnis Anda.' }}">
<meta property="og:image" content="{{ $og_image ?? asset('image/og-image.jpg') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $og_url ?? url()->current() }}">
<meta property="twitter:title" content="{{ $title ?? config('app.name', 'Kuukok') }}">
<meta property="twitter:description" content="{{ $meta_description ?? 'Kuukok - Solusi digital profesional untuk pertumbuhan bisnis Anda.' }}">
<meta property="twitter:image" content="{{ $og_image ?? asset('image/og-image.jpg') }}">

<link rel="canonical" href="{{ $canonical ?? url()->current() }}">

<link rel="icon" href="{{ asset('image/icon.png') }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('image/icon.png') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=montserrat:400,600,700" rel="stylesheet" />
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
