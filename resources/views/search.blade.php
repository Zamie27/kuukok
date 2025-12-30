<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('components.head', [
    'title' => 'Pencarian | Kuukok',
    'meta_description' => 'Hasil pencarian konten Kuukok: portofolio, artikel, dan paket layanan.',
    'canonical' => route('search.index')
    ])
    <style>
        .search-section {
            padding-top: 96px
        }
    </style>
</head>

<body class="bg-base-100">
    @include('components.navbar')

    <section class="search-section max-w-7xl mx-auto px-4 lg:px-8 py-10">
        <h1 class="text-2xl font-semibold mb-6">Hasil Pencarian</h1>
        <form action="{{ route('search.index') }}" method="get" class="mb-8">
            <div class="join w-full">
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari layanan, artikel, atau portofolio" class="input input-bordered join-item w-full" />
                <button type="submit" class="btn btn-primary join-item">Cari</button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h2 class="text-xl font-semibold mb-3">Portofolio</h2>
                <ul class="space-y-3">
                    @forelse($portfolios as $p)
                    <li>
                        <a href="{{ route('portfolio.show', $p) }}" class="link link-hover">
                            {{ $p->title }}
                        </a>
                    </li>
                    @empty
                    <li class="text-base-content/60">Tidak ada hasil</li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-3">Artikel</h2>
                <ul class="space-y-3">
                    @forelse($posts as $post)
                    <li>
                        <a href="{{ route('blog.show', $post) }}" class="link link-hover">
                            {{ $post->title }}
                        </a>
                    </li>
                    @empty
                    <li class="text-base-content/60">Tidak ada hasil</li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-3">Paket</h2>
                <ul class="space-y-3">
                    @forelse($packages as $pkg)
                    <li>
                        <a href="{{ route('pricing.index') }}" class="link link-hover">
                            {{ $pkg->name }}
                        </a>
                    </li>
                    @empty
                    <li class="text-base-content/60">Tidak ada hasil</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>
</body>

</html>
