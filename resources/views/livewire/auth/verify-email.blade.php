<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    @include('components.head', [
        'title' => 'Verifikasi Email - Kuukok'
    ])
</head>
<body class="bg-base-100 font-sans min-h-screen flex flex-col">
    @include('components.navbar')

    <div class="px-4 pb-16 pt-24">
        <div class="mx-auto max-w-md">
            <div class="card bg-base-200 shadow-xl">
                <div class="card-body">
                    <h1 class="text-2xl font-bold mb-2">Verifikasi Email</h1>
                    <p class="text-sm text-base-content/70 mb-4">Kami telah mengirimkan email verifikasi. Jika belum menerima, minta ulang.</p>
                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            <div><span>{{ session('status') }}</span></div>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
                        @csrf
                        <button type="submit" class="btn btn-primary w-full text-white">Kirim Ulang Email Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
