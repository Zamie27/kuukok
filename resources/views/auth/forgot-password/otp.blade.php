<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    @include('components.head', [
        'title' => 'Verifikasi OTP - Kuukok'
    ])
</head>
<body class="bg-base-100 font-sans min-h-screen flex flex-col">
    @include('components.navbar')

    <div class="px-4 pb-16 pt-24 flex-grow">
        <div class="mx-auto max-w-md">
            <div class="card bg-base-200 shadow-xl">
                <div class="card-body">
                    <h1 class="text-2xl font-bold mb-4">Verifikasi OTP</h1>
                    <p class="text-sm text-base-content/70 mb-4">Kode OTP telah dikirim ke <strong>{{ $email }}</strong>. Masukkan kode 6 digit di bawah ini.</p>

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

                    <form action="{{ route('password.verify-otp') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        
                        <div class="form-control">
                            <label class="label"><span class="label-text">Kode OTP</span></label>
                            <input type="text" name="otp" class="input input-bordered w-full text-center tracking-widest text-2xl" placeholder="123456" maxlength="6" required />
                        </div>

                        <button type="submit" class="btn btn-primary w-full text-white">
                            Verifikasi OTP
                        </button>

                        <div class="text-center mt-4">
                            <form action="{{ route('password.email') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <button type="submit" class="link link-hover text-sm">Kirim Ulang OTP</button>
                            </form>
                            <span class="mx-2 text-base-content/30">|</span>
                            <a href="{{ route('password.request') }}" class="link link-hover text-sm">Ganti Email</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
