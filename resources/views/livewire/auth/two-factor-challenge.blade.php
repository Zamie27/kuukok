<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    @include('components.head', [
        'title' => 'Two Factor Challenge - Kuukok'
    ])
</head>
<body class="bg-base-100 font-sans min-h-screen flex flex-col">
    @include('components.navbar')

    <div class="px-4 pb-16 pt-24">
        <div class="mx-auto max-w-md">
            <div class="card bg-base-200 shadow-xl">
                <div class="card-body">
                    <h1 class="text-2xl font-bold mb-4">Two-Factor Authentication</h1>
                    <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-4">
                        @csrf
                        <div class="form-control">
                            <label class="label"><span class="label-text">Code</span></label>
                            <input type="text" name="code" class="input input-bordered w-full" />
                        </div>
                        <div class="text-center text-sm">or use recovery code</div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Recovery Code</span></label>
                            <input type="text" name="recovery_code" class="input input-bordered w-full" />
                        </div>
                        <button type="submit" class="btn btn-primary w-full text-white">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
