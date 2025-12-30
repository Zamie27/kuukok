<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name', 'Kuukok') }}</title>
<meta name="description" content="{{ $meta_description ?? 'Kuukok - Jasa website, desain grafis, dan digital untuk Subang & sekitarnya. Murah, cepat, profesional. Cocok untuk mahasiswa, UMKM, dan bisnis lokal.' }}">
<meta name="keywords" content="{{ $keywords ?? 'Kuukok, jasa desain Subang, desain grafis, website Subang, hosting, jasa website, UI/UX, mahasiswa, universitas subang, unsub, murah, jasa joki, makalah, jurnal' }}">
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

<link rel="icon" href="{{ asset('image/icon.png') }}" type="image/png" sizes="32x32">
<link rel="icon" href="{{ asset('image/icon.png') }}" type="image/png" sizes="16x16">
<link rel="apple-touch-icon" href="{{ asset('image/icon.png') }}" sizes="180x180">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=montserrat:400,600,700" rel="stylesheet" />
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])

@php
$socials = [
\App\Models\Setting::getValue('social_instagram'),
\App\Models\Setting::getValue('social_facebook'),
\App\Models\Setting::getValue('social_linkedin'),
];
$socials = array_values(array_filter($socials));
@endphp

<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "ProfessionalService",
        "name": "{{ config('app.name', 'Kuukok') }}",
        "image": "{{ asset('image/icon.png') }}",
        "url": "{{ url('/') }}",
        "telephone": "+6281234567890",
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "Jl. Raya Ahmad Yani",
            "addressLocality": "Subang",
            "addressRegion": "Jawa Barat",
            "postalCode": "41211",
            "addressCountry": "ID"
        },
        "geo": {
            "@@type": "GeoCoordinates",
            "latitude": -6.571589,
            "longitude": 107.758736
        },
        "openingHoursSpecification": {
            "@@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday"
            ],
            "opens": "00:00",
            "closes": "23:59"
        },
        "priceRange": "$",
        "sameAs": @json($socials)
    }
</script>

<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "WebSite",
        "url": "{{ url('/') }}",
        "name": "{{ config('app.name', 'Kuukok') }}",
        "potentialAction": {
            "@@type": "SearchAction",
            "target": "{{ route('search.index') }}?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
</script>

<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "SiteNavigationElement",
        "name": ["Home", "Tentang Kami", "Portofolio", "Harga", "Artikel", "Kontak"],
        "url": [
            "{{ route('home') }}",
            "{{ route('about.index') }}",
            "{{ route('portfolio.index') }}",
            "{{ route('pricing.index') }}",
            "{{ route('blog.index') }}",
            "{{ route('contact.index') }}"
        ]
    }
</script>
