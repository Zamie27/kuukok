<x-layouts.admin title="Kelola Profil Tim">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

        trix-editor {
            min-height: 200px;
        }

        /* Trix Dark Mode Overrides */
        [data-theme="dark"] trix-toolbar .trix-button {
            background-color: #1d232a;
            /* base-100/base-200 */
            border-bottom-color: #374151;
        }

        [data-theme="dark"] trix-toolbar .trix-button:hover {
            background-color: #2a323c;
        }

        [data-theme="dark"] trix-toolbar .trix-button.trix-active {
            background-color: #374151;
            /* neutral */
        }

        [data-theme="dark"] trix-toolbar .trix-button::before {
            filter: invert(1) brightness(0.8);
            /* Invert black icons to white */
        }

        [data-theme="dark"] trix-editor {
            background-color: #1d232a;
            color: #a6adbb;
            /* base-content */
            border-color: #374151;
        }

        [data-theme="dark"] .trix-button-group {
            border-color: #374151;
        }
    </style>

    <div x-data="profileForm()"
        data-tech-stacks="{{ json_encode($profile->techStacks->pluck('id')) }}"
        data-existing-certs="{{ json_encode($profile->certifications) }}"
        class="mx-auto max-w-6xl p-6 pb-24">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-base-content">Kelola Profil Tim</h1>
                <p class="text-base-content/70 mt-1">Atur informasi profil, keahlian, dan portofolio tim Anda.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('team.show', $profile) }}" target="_blank" class="btn btn-outline btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Preview Live
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success shadow-sm mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-error shadow-sm mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h3 class="font-bold">Terjadi Kesalahan</h3>
                <ul class="list-disc list-inside text-sm mt-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" @submit="submitManual">
            @csrf
            @method('PUT')

            <!-- Tabs Navigation -->
            <div role="tablist" class="tabs tabs-lifted tabs-lg mb-0">
                <a role="tab" class="tab" :class="{ 'tab-active': tab === 'basic' }" @click="tab = 'basic'">Info Dasar</a>
                <a role="tab" class="tab" :class="{ 'tab-active': tab === 'personal' }" @click="tab = 'personal'">Info Personal</a>
                <a role="tab" class="tab" :class="{ 'tab-active': tab === 'social' }" @click="tab = 'social'">Sosial Media</a>
                <a role="tab" class="tab" :class="{ 'tab-active': tab === 'tech' }" @click="tab = 'tech'">Tech Stack</a>
                <a role="tab" class="tab" :class="{ 'tab-active': tab === 'certs' }" @click="tab = 'certs'">Sertifikasi</a>
            </div>

            <!-- Tab Contents -->
            <div class="bg-base-100 border-base-300 rounded-b-box border p-6 min-h-[400px]">

                <!-- 1. Info Dasar -->
                <div x-show="tab === 'basic'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium mb-2">Foto Profil</label>
                            <div class="flex flex-col items-center gap-4 p-6 border-2 border-dashed border-base-300 rounded-xl bg-base-200/50">
                                <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content rounded-full w-32 h-32 ring ring-primary ring-offset-base-100 ring-offset-2 overflow-hidden">
                                        <template x-if="previewUrl">
                                            <img :src="previewUrl" class="object-cover w-full h-full" />
                                        </template>
                                        <template x-if="!previewUrl && '{{ $profile->avatar }}'">
                                            <img src="{{ asset('storage/'.$profile->avatar) }}" class="object-cover w-full h-full" />
                                        </template>
                                        <template x-if="!previewUrl && !'{{ $profile->avatar }}'">
                                            <span class="text-3xl">{{ substr($profile->user->name, 0, 1) }}</span>
                                        </template>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <input type="file" name="avatar" @change="fileChosen" accept="image/jpeg,image/png,image/webp" class="file-input file-input-bordered file-input-sm w-full" />
                                    <div class="text-xs text-base-content/60 mt-2 text-center">JPG, PNG, WEBP. Max 2MB.</div>
                                    @if($profile->avatar)
                                    <div class="mt-2 text-center">
                                        <button type="button" class="btn btn-xs btn-error btn-outline" onclick="if(confirm('Apakah Anda yakin ingin menghapus foto profil?')) document.getElementById('delete-avatar-form').submit();">
                                            Hapus Foto
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2 space-y-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold">Nama Lengkap</span></label>
                                <input type="text" name="name" value="{{ old('name', $profile->user->name) }}" class="input input-bordered w-full" placeholder="Nama lengkap Anda" required />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold">Posisi / Role</span></label>
                                <input type="text" name="position" value="{{ old('position', $profile->position) }}" class="input input-bordered w-full" placeholder="Contoh: Lead Developer, UI Designer" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold">Kutipan / Motto</span></label>
                                <textarea name="quote" class="textarea textarea-bordered h-24" placeholder="Tulis kutipan singkat atau motto kerja Anda (Maks 200 karakter)" maxlength="200">{{ old('quote', $profile->quote) }}</textarea>
                                <label class="label"><span class="label-text-alt">Maksimal 200 karakter</span></label>
                            </div>

                            <div class="divider">Ganti Password</div>

                            <div class="bg-base-200/50 p-4 rounded-xl space-y-4" x-data="{
                                showCurrent: false,
                                showNew: false,
                                showConfirm: false,
                                new_password: '',
                                new_password_confirmation: '',
                                get hasMinLength() { return this.new_password.length >= 6 },
                                get hasNumber() { return /\d/.test(this.new_password) },
                                get hasLower() { return /[a-z]/.test(this.new_password) },
                                get hasUpper() { return /[A-Z]/.test(this.new_password) },
                                get hasSymbol() { return /[!@#$%^&*(),.?\':{}|<>]/.test(this.new_password) },
                                get isMatch() { return this.new_password && this.new_password === this.new_password_confirmation },
                                get isValid() { return this.hasMinLength && this.hasNumber && this.hasLower && this.hasUpper && this.hasSymbol && this.isMatch }
                            }">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">Password Saat Ini</span>
                                        <span class="label-text-alt text-warning" x-show="new_password.length > 0">* Wajib diisi jika ganti password</span>
                                    </label>
                                    <div class="relative">
                                        <input :type="showCurrent ? 'text' : 'password'" name="current_password" class="input input-bordered w-full pr-10" placeholder="Isi password saat ini untuk verifikasi" />
                                        <button type="button" @click="showCurrent = !showCurrent" class="absolute inset-y-0 right-0 pr-3 flex items-center text-base-content/60 hover:text-base-content transition-colors z-10 h-full">
                                            <svg x-show="!showCurrent" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <svg x-show="showCurrent" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 013.999-5.125m3.786-3.225a10.054 10.054 0 013.264-.85c4.478 0 8.268 2.943 9.542 7a10.054 10.054 0 01-3.264 5.85m-2.013 2.014a3 3 0 11-4.242-4.242M8 8l8 8" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('current_password') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-control">
                                        <label class="label"><span class="label-text font-semibold">Password Baru</span></label>
                                        <div class="relative">
                                            <input :type="showNew ? 'text' : 'password'" name="new_password" x-model="new_password" class="input input-bordered w-full pr-10" placeholder="Password baru" />
                                            <button type="button" @click="showNew = !showNew" class="absolute inset-y-0 right-0 pr-3 flex items-center text-base-content/60 hover:text-base-content transition-colors z-10 h-full">
                                                <svg x-show="!showNew" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <svg x-show="showNew" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 013.999-5.125m3.786-3.225a10.054 10.054 0 013.264-.85c4.478 0 8.268 2.943 9.542 7a10.054 10.054 0 01-3.264 5.85m-2.013 2.014a3 3 0 11-4.242-4.242M8 8l8 8" />
                                                </svg>
                                            </button>
                                        </div>
                                        @error('new_password') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-control">
                                        <label class="label"><span class="label-text font-semibold">Konfirmasi Password</span></label>
                                        <div class="relative">
                                            <input :type="showConfirm ? 'text' : 'password'" name="new_password_confirmation" x-model="new_password_confirmation" class="input input-bordered w-full pr-10" placeholder="Ulangi password baru" />
                                            <button type="button" @click="showConfirm = !showConfirm" class="absolute inset-y-0 right-0 pr-3 flex items-center text-base-content/60 hover:text-base-content transition-colors z-10 h-full">
                                                <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <svg x-show="showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 013.999-5.125m3.786-3.225a10.054 10.054 0 013.264-.85c4.478 0 8.268 2.943 9.542 7a10.054 10.054 0 01-3.264 5.85m-2.013 2.014a3 3 0 11-4.242-4.242M8 8l8 8" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Strength Indicator -->
                                <div class="p-4 bg-base-100 rounded-lg text-sm space-y-2 border border-base-300">
                                    <p class="font-semibold text-base-content/70 mb-2">Syarat Keamanan Password:</p>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
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

                                        <div class="flex items-center gap-2" :class="isMatch && new_password.length > 0 ? 'text-success' : 'text-base-content/50'">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                            </svg>
                                            <span>Password Cocok</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Info Personal -->
                <div x-show="tab === 'personal'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                    <div class="space-y-6">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-semibold">Tentang Saya (Bio Lengkap)</span></label>
                            <input id="about_me" type="hidden" name="about_me" value="{{ old('about_me', $profile->about_me) }}">
                            <trix-editor input="about_me" class="textarea textarea-bordered min-h-[200px] leading-relaxed"></trix-editor>
                            <div class="label"><span class="label-text-alt text-info">Tips: Gunakan baris baru untuk paragraf. Mendukung format teks sederhana.</span></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold">Jenis Kelamin</span></label>
                                <select name="gender" class="select select-bordered w-full">
                                    <option value="" disabled {{ !$profile->gender ? 'selected' : '' }}>Pilih Gender</option>
                                    <option value="male" {{ old('gender', $profile->gender) === 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender', $profile->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold">Email Publik</span></label>
                                <input type="email" name="email" value="{{ old('email', $profile->user->email) }}" class="input input-bordered w-full" required />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold">Tanggal Bergabung</span></label>
                                <input type="date" name="joined_at" value="{{ old('joined_at', $profile->joined_at ? $profile->joined_at->format('Y-m-d') : '') }}" class="input input-bordered w-full" />
                            </div>
                        </div>

                        <div class="divider">Alamat & Lokasi</div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Kabupaten / Kota</span></label>
                                <input type="text" name="address_city" value="{{ old('address_city', $profile->address_city) }}" class="input input-bordered w-full" placeholder="Jakarta Selatan" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Provinsi</span></label>
                                <input type="text" name="address_province" value="{{ old('address_province', $profile->address_province) }}" class="input input-bordered w-full" placeholder="DKI Jakarta" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Negara</span></label>
                                <input type="text" name="address_country" value="{{ old('address_country', $profile->address_country) }}" class="input input-bordered w-full" placeholder="Indonesia" />
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text font-semibold">Spesialisasi (Tags)</span></label>
                            <input type="text" name="specializations" value="{{ old('specializations', is_array($profile->specializations) ? implode(', ', $profile->specializations) : $profile->specializations) }}" class="input input-bordered w-full" placeholder="Contoh: Laravel, React, System Design (Pisahkan dengan koma)" />
                        </div>
                    </div>
                </div>

                <!-- 3. Sosial Media -->
                <div x-show="tab === 'social'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                        $socials = $profile->social_links ?? [];
                        @endphp
                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-2"><i class="text-xl w-6 text-center fa-brands fa-linkedin"></i> <span class="label-text font-semibold">LinkedIn</span></label>
                            <input type="text" name="social_links[linkedin]" value="{{ old('social_links.linkedin', $socials['linkedin'] ?? '') }}" class="input input-bordered w-full" placeholder="https://linkedin.com/in/username" />
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-2"><i class="text-xl w-6 text-center fa-brands fa-github"></i> <span class="label-text font-semibold">GitHub</span></label>
                            <input type="text" name="social_links[github]" value="{{ old('social_links.github', $socials['github'] ?? '') }}" class="input input-bordered w-full" placeholder="https://github.com/username" />
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-2"><i class="text-xl w-6 text-center fa-brands fa-instagram"></i> <span class="label-text font-semibold">Instagram</span></label>
                            <input type="text" name="social_links[instagram]" value="{{ old('social_links.instagram', $socials['instagram'] ?? '') }}" class="input input-bordered w-full" placeholder="https://instagram.com/username" />
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-2"><i class="text-xl w-6 text-center fa-brands fa-facebook"></i> <span class="label-text font-semibold">Facebook</span></label>
                            <input type="text" name="social_links[facebook]" value="{{ old('social_links.facebook', $socials['facebook'] ?? '') }}" class="input input-bordered w-full" placeholder="https://facebook.com/username" />
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-2"><i class="text-xl w-6 text-center fa-brands fa-twitter"></i> <span class="label-text font-semibold">Twitter / X</span></label>
                            <input type="text" name="social_links[twitter]" value="{{ old('social_links.twitter', $socials['twitter'] ?? '') }}" class="input input-bordered w-full" placeholder="https://twitter.com/username" />
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-2"><i class="text-xl w-6 text-center fa-brands fa-youtube"></i> <span class="label-text font-semibold">YouTube</span></label>
                            <input type="text" name="social_links[youtube]" value="{{ old('social_links.youtube', $socials['youtube'] ?? '') }}" class="input input-bordered w-full" placeholder="https://youtube.com/@channel" />
                        </div>
                    </div>
                </div>

                <!-- 4. Tech Stack -->
                <div x-show="tab === 'tech'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                    <div class="space-y-6">
                        <div class="form-control">
                            <label class="input input-bordered flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                                    <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                                </svg>
                                <input type="text" class="grow" placeholder="Cari Tech Stack..." x-model="techSearch" />
                            </label>
                        </div>

                        @foreach($techStacks as $category => $stacks)
                        <div class="card bg-base-200 shadow-sm border border-base-300" x-show="shouldShowCategory('{{ $category }}')">
                            <div class="card-body p-4">
                                <h3 class="card-title text-lg mb-2">{{ $category }}</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3">
                                    @foreach($stacks as $stack)
                                    <label class="label cursor-pointer justify-start gap-3 bg-base-100 p-2 rounded-lg border border-base-200 hover:border-primary transition-colors"
                                        :class="{'bg-primary/10 border-primary': selectedTechStacks.includes({{ $stack->id }})}"
                                        x-show="shouldShowStack('{{ $stack->name }}')">
                                        <input type="checkbox" name="tech_stack_ids[]" value="{{ $stack->id }}" class="checkbox checkbox-primary checkbox-sm" x-model="selectedTechStacks" />
                                        <div class="flex items-center gap-2 overflow-hidden">
                                            @if($stack->logo)
                                            <img src="{{ asset('storage/' . $stack->logo) }}" alt="{{ $stack->name }}" class="w-5 h-5 object-contain">
                                            @else
                                            <div class="w-5 h-5 bg-base-300 rounded-full flex items-center justify-center text-[10px] font-bold">
                                                {{ substr($stack->name, 0, 1) }}
                                            </div>
                                            @endif
                                            <span class="label-text truncate font-medium" title="{{ $stack->name }}">{{ $stack->name }}</span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- 5. Sertifikasi -->
                <div x-show="tab === 'certs'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">

                    <!-- Existing Certs -->
                    <div class="space-y-4 mb-8">
                        <h3 class="font-bold text-lg border-b pb-2">Sertifikat Tersimpan</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-show="existingCerts.length > 0">
                            <template x-for="cert in existingCerts" :key="cert.id">
                                <div class="card card-side bg-base-200 shadow-sm border border-base-300 compact group" x-show="!deletedCertIds.includes(cert.id)">
                                    <figure class="w-24 h-full bg-base-300">
                                        <template x-if="cert.file_path">
                                            <img :src="'/storage/' + cert.file_path" alt="Cert" class="w-full h-full object-cover" />
                                        </template>
                                        <template x-if="!cert.file_path">
                                            <div class="flex items-center justify-center w-full h-full text-4xl text-base-content/20"><i class="fa-solid fa-certificate"></i></div>
                                        </template>
                                    </figure>
                                    <div class="card-body p-4">
                                        <h4 class="card-title text-base" x-text="cert.name"></h4>
                                        <p class="text-sm opacity-70"><span x-text="cert.issuer"></span> (<span x-text="cert.year"></span>)</p>
                                        <div class="card-actions justify-end mt-2">
                                            <button type="button" @click="openCert(cert.name, cert.file_path)" class="btn btn-xs btn-ghost">Lihat</button>
                                            <button type="button" class="btn btn-xs btn-error btn-outline" @click="deleteCert(cert.id)">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Hidden inputs for deleted certs -->
                        <template x-for="id in deletedCertIds">
                            <input type="hidden" name="delete_cert_ids[]" :value="id">
                        </template>

                        <div x-show="existingCerts.length === 0" class="text-center py-4 text-base-content/60 italic">Belum ada sertifikat tersimpan.</div>
                    </div>

                    <!-- New Certs -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b pb-2">
                            <h3 class="font-bold text-lg">Tambah Sertifikat Baru</h3>
                            <button type="button" class="btn btn-sm btn-primary" @click="addCertRow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah
                            </button>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(cert, index) in newCerts" :key="index">
                                <div class="card bg-base-200 border border-base-300">
                                    <div class="card-body p-4 relative">
                                        <button type="button" class="btn btn-xs btn-circle btn-ghost absolute top-2 right-2" @click="removeCertRow(index)">✕</button>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="form-control">
                                                <label class="label"><span class="label-text">Nama Sertifikasi</span></label>
                                                <input type="text" :name="`certs_new[${index}][name]`" class="input input-bordered input-sm w-full" required />
                                            </div>
                                            <div class="form-control">
                                                <label class="label"><span class="label-text">Penerbit / Lembaga</span></label>
                                                <input type="text" :name="`certs_new[${index}][issuer]`" class="input input-bordered input-sm w-full" required />
                                            </div>
                                            <div class="form-control">
                                                <label class="label"><span class="label-text">Tahun</span></label>
                                                <input type="number" :name="`certs_new[${index}][year]`" class="input input-bordered input-sm w-full" placeholder="2024" required />
                                            </div>
                                            <div class="form-control">
                                                <label class="label"><span class="label-text">ID Kredensial (Opsional)</span></label>
                                                <input type="text" :name="`certs_new[${index}][credential_id]`" class="input input-bordered input-sm w-full" />
                                            </div>
                                            <div class="form-control md:col-span-2">
                                                <label class="label"><span class="label-text">Upload Bukti (Gambar/PDF)</span></label>
                                                <input type="file" :name="`certs_new[${index}][file]`" class="file-input file-input-bordered file-input-sm w-full" accept=".pdf,.jpg,.jpeg,.png" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="newCerts.length === 0" class="text-center py-8 border-2 border-dashed border-base-300 rounded-xl bg-base-100">
                                <p class="text-base-content/60">Klik tombol "Tambah" di atas untuk menambahkan sertifikat baru.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Floating Action Bar -->
            <div class="fixed bottom-0 left-0 right-0 p-4 bg-base-100 border-t shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] z-40 lg:pl-80 transition-transform duration-300" :class="{'translate-y-full': !isChanged && !isSubmitting, 'translate-y-0': isChanged || isSubmitting}">
                <div class="max-w-6xl mx-auto flex justify-between items-center">
                    <div class="text-sm text-base-content/70 hidden md:block">
                        <span x-show="isChanged" class="text-warning font-semibold">⚠ Ada perubahan belum disimpan</span>
                    </div>
                    <div class="flex gap-4">
                        <button type="button" class="btn btn-ghost" @click="window.location.reload()" :disabled="isSubmitting">Reset</button>
                        <button type="submit" class="btn btn-primary min-w-[150px]" :disabled="isSubmitting">
                            <span x-show="isSubmitting" class="loading loading-spinner loading-xs"></span>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

        </form>

        <!-- Image Modal -->
        <dialog class="modal modal-bottom sm:modal-middle" :class="{ 'modal-open': certModalOpen }">
            <div class="modal-box p-0 overflow-hidden max-w-4xl bg-base-100">
                <div class="flex justify-between items-center p-4 bg-base-200 border-b border-base-300">
                    <h3 class="font-bold text-lg" x-text="certTitle"></h3>
                    <button type="button" class="btn btn-sm btn-circle btn-ghost" @click="certModalOpen = false">✕</button>
                </div>
                <div class="p-4 flex justify-center bg-base-300/50 min-h-[200px]">
                    <img :src="certImage" class="max-h-[80vh] w-auto rounded shadow-lg object-contain" alt="Certificate">
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button type="button" @click="certModalOpen = false">close</button>
            </form>
        </dialog>
    </div>

    <div id="toast-container" class="toast toast-top toast-end z-50"></div>

    <form id="delete-avatar-form" action="{{ route('admin.profile.avatar.destroy') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

</x-layouts.admin>
