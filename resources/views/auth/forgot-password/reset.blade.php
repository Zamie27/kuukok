<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head', [
    'title' => 'Reset Password Baru - Kuukok'
    ])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-base-100 font-sans min-h-screen flex flex-col">
    @include('components.navbar')

    <div class="px-4 pb-16 pt-24 flex-grow">
        <div class="mx-auto max-w-md">
            <div class="card bg-base-200 shadow-xl">
                <div class="card-body">
                    <h1 class="text-2xl font-bold mb-4">Reset Password Baru</h1>
                    <p class="text-sm text-base-content/70 mb-4">Silakan buat password baru untuk akun Anda.</p>

                    @if($errors->any())
                    <div class="alert alert-error mb-4 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="POST" class="space-y-4" x-data="{
                        password: '',
                        password_confirmation: '',
                        get hasMinLength() { return this.password.length >= 6 },
                        get hasNumber() { return /\d/.test(this.password) },
                        get hasLower() { return /[a-z]/.test(this.password) },
                        get hasUpper() { return /[A-Z]/.test(this.password) },
                        get hasSymbol() { return /[!@#$%^&*(),.?\':{}|<>]/.test(this.password) },
                        get isMatch() { return this.password && this.password === this.password_confirmation },
                        get isValid() { return this.hasMinLength && this.hasNumber && this.hasLower && this.hasUpper && this.hasSymbol && this.isMatch }
                    }">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Password Field -->
                        <div class="form-control" x-data="{ show: false }">
                            <label class="label"><span class="label-text">Password Baru</span></label>
                            <div class="relative">
                                <input
                                    :type="show ? 'text' : 'password'"
                                    name="password"
                                    x-model="password"
                                    class="input input-bordered w-full pr-10"
                                    placeholder="••••••••"
                                    required />
                                <button
                                    type="button"
                                    @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-base-content/70 hover:text-base-content focus:outline-none">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-control" x-data="{ show: false }">
                            <label class="label"><span class="label-text">Konfirmasi Password</span></label>
                            <div class="relative">
                                <input
                                    :type="show ? 'text' : 'password'"
                                    name="password_confirmation"
                                    x-model="password_confirmation"
                                    class="input input-bordered w-full pr-10"
                                    placeholder="••••••••"
                                    required />
                                <button
                                    type="button"
                                    @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-base-content/70 hover:text-base-content focus:outline-none">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="p-4 bg-base-300 rounded-lg text-sm space-y-2">
                            <p class="font-semibold text-base-content/70 mb-2">Syarat Keamanan Password:</p>

                            <div class="flex items-center gap-2" :class="hasMinLength ? 'text-success' : 'text-base-content/50'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                                <span>Minimal 6 karakter</span>
                            </div>

                            <div class="flex items-center gap-2" :class="hasLower ? 'text-success' : 'text-base-content/50'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                                <span>Huruf kecil (a-z)</span>
                            </div>

                            <div class="flex items-center gap-2" :class="hasUpper ? 'text-success' : 'text-base-content/50'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                                <span>Huruf besar (A-Z)</span>
                            </div>

                            <div class="flex items-center gap-2" :class="hasNumber ? 'text-success' : 'text-base-content/50'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                                <span>Angka (0-9)</span>
                            </div>

                            <div class="flex items-center gap-2" :class="hasSymbol ? 'text-success' : 'text-base-content/50'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                                <span>Simbol (!@#$%^&*)</span>
                            </div>

                            <div class="flex items-center gap-2 border-t border-base-content/10 pt-2 mt-2" :class="isMatch && password.length > 0 ? 'text-success' : 'text-base-content/50'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                                <span>Password Cocok</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-full text-white" :disabled="!isValid">
                            Simpan Password Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>

</html>