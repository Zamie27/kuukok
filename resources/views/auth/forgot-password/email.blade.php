<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    @include('components.head', [
        'title' => 'Lupa Password - Kuukok'
    ])
</head>
<body class="bg-base-100 font-sans min-h-screen flex flex-col">
    @include('components.navbar')

    <div class="px-4 pb-16 pt-24 flex-grow">
        <div class="mx-auto max-w-md">
            <div class="card bg-base-200 shadow-xl">
                <div class="card-body">
                    <h1 class="text-2xl font-bold mb-4">Lupa Password</h1>
                    <p class="text-sm text-base-content/70 mb-4">Masukkan email Anda untuk menerima kode OTP reset password.</p>

                    @if(session('status'))
                        <div class="alert alert-success mb-4 text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-error mb-4 text-sm">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="form-control">
                            <label class="label"><span class="label-text">Email</span></label>
                            <input type="email" name="email" class="input input-bordered w-full" placeholder="email@example.com" value="{{ old('email') }}" required />
                        </div>

                        <button type="submit" class="btn btn-primary w-full text-white">
                            Kirim Kode OTP
                        </button>

                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="link link-hover text-sm">Kembali ke Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
