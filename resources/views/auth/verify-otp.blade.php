<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi OTP - Kuukok</title>
    <link rel="icon" href="{{ asset('image/icon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Initialize theme
        if (localStorage.getItem('kuukok-theme') === 'dark' || (!('kuukok-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
        }
    </script>
</head>
<body class="bg-base-200 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <img src="{{ asset('image/icon.png') }}" alt="Kuukok Logo" class="h-16 mx-auto mb-4">
            <h1 class="text-3xl font-bold">Verifikasi Email</h1>
            <p class="text-base-content/60 mt-2">Kami telah mengirimkan kode OTP ke email <strong>{{ auth()->user()->email }}</strong></p>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success mb-4 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('otp.verify') }}" method="POST">
                    @csrf
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold">Masukkan 6 Digit Kode OTP</span>
                        </label>
                        <input type="text" name="otp" maxlength="6" class="input input-bordered w-full text-center text-2xl tracking-[0.5em] font-bold @error('otp') input-error @enderror" placeholder="000000" required autofocus>
                        @error('otp')
                            <label class="label">
                                <span class="label-text-alt text-error font-bold">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary w-full text-white font-bold">Verifikasi Akun</button>
                    </div>
                </form>

                <div class="divider text-xs text-base-content/40 uppercase">Atau</div>

                <div class="text-center">
                    <p class="text-sm text-base-content/60 mb-2">Tidak menerima kode?</p>
                    <form action="{{ route('otp.resend') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-ghost btn-sm text-primary font-bold">Kirim Ulang OTP</button>
                    </form>
                </div>

                <div class="mt-8 pt-6 border-t border-base-300 text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm link link-error opacity-70 hover:opacity-100">Keluar & Daftar Ulang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
