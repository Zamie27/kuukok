<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    @include('components.head', [
        'title' => 'Confirm Password - Kuukok'
    ])
</head>
<body class="bg-base-100 font-sans min-h-screen flex flex-col">
    @include('components.navbar')

    <div class="px-4 pb-16 pt-24">
        <div class="mx-auto max-w-md">
            <div class="card bg-base-200 shadow-xl">
                <div class="card-body">
                    <h1 class="text-2xl font-bold mb-4">Konfirmasi Password</h1>
                    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                        @csrf
                        <div class="form-control">
                            <label class="label"><span class="label-text">Password</span></label>
                            <input type="password" name="password" required class="input input-bordered w-full" />
                        </div>
                        <button type="submit" class="btn btn-primary w-full text-white">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
