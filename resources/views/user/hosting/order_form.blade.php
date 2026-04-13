<x-layouts.admin title="Lengkapi Detail Pemesanan">
<div class="mx-auto max-w-3xl">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('user.hosting.buy') }}" class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold">Detail Pemesanan</h1>
            <p class="text-base-content/60">Paket Terpilih: <span class="text-primary font-semibold">{{ $package->name }}</span></p>
        </div>
    </div>

    <div class="card bg-base-100 shadow border border-base-200">
        <div class="card-body">
            <form action="{{ route('user.hosting.order.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="hosting_package_id" value="{{ $package->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label"><span class="label-text font-semibold">Nama Lengkap</span></label>
                        <input type="text" name="customer_name" value="{{ old('customer_name', Auth::user()->name) }}" class="input input-bordered w-full @error('customer_name') border-error @enderror" required />
                        @error('customer_name') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text font-semibold">Email Aktif</span></label>
                        <input type="email" name="customer_email" value="{{ old('customer_email', Auth::user()->email) }}" class="input input-bordered w-full @error('customer_email') border-error @enderror" required />
                        @error('customer_email') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label"><span class="label-text font-semibold">Nomor WhatsApp</span></label>
                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}" placeholder="Contoh: 081234567890" class="input input-bordered w-full @error('whatsapp_number') border-error @enderror" required />
                        @error('whatsapp_number') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text font-semibold">Nama Proyek/Website</span></label>
                        <input type="text" name="project_name" value="{{ old('project_name') }}" placeholder="Contoh: Toko Online Saya" class="input input-bordered w-full @error('project_name') border-error @enderror" required />
                        @error('project_name') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Framework Yang Digunakan</span>
                        </label>
                        <input type="text" name="framework" value="{{ old('framework') }}" placeholder="Contoh: Laravel / Codeigniter" class="input input-bordered w-full @error('framework') border-error @enderror" required />
                        @error('framework') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                        <label class="label mt-[-4px]">
                            <span class="label-text-alt text-base-content/50">Codeigniter/Laravel/dll</span>
                        </label>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Database Yang Digunakan</span>
                        </label>
                        <input type="text" name="database" value="{{ old('database') }}" placeholder="Contoh: MySQL / Supabase" class="input input-bordered w-full @error('database') border-error @enderror" required />
                        @error('database') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                        <label class="label mt-[-4px]">
                            <span class="label-text-alt text-base-content/50">MYSQL/SQlite/MongoDB/SupaBase/dll</span>
                        </label>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-semibold">Nama Domain</span></label>
                    <div class="join w-full">
                        <input type="text" name="domain_name" value="{{ old('domain_name') }}" placeholder="{{ $package->is_custom_domain ? 'Contoh: domainanda.com' : 'Contoh: toko-saya' }}" class="input input-bordered w-full join-item @error('domain_name') border-error @enderror" required />
                        @if(!$package->is_custom_domain)
                        <span class="btn join-item no-animation bg-base-200 border-base-300">.kuukok.my.id</span>
                        @endif
                    </div>
                    @error('domain_name') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                    <label class="label">
                        <span class="label-text-alt text-base-content/60">
                            @if($package->is_custom_domain)
                            Masukkan nama domain lengkap (misal: projectanda.id). Tidak perlu .kuukok.my.id
                            @else
                            Akan otomatis menjadi project-anda.kuukok.my.id
                            @endif
                        </span>
                    </label>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-semibold">URL Repository Github (Opsional)</span></label>
                    <input type="url" name="github_repo_url" value="{{ old('github_repo_url') }}" placeholder="https://github.com/username/repo" class="input input-bordered w-full @error('github_repo_url') border-error @enderror" />
                    @error('github_repo_url') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
                    <label class="label"><span class="label-text-alt text-base-content/60">Digunakan untuk keperluan deploy otomatis oleh admin.</span></label>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-semibold text-primary">Kode Referral (Opsional)</span></label>
                    <input type="text" name="referral_code_used" value="{{ old('referral_code_used') }}" placeholder="Masukkan kode jika ada" class="input input-bordered w-full uppercase @error('referral_code_used') border-error @enderror" />
                    @error('referral_code_used') <span class="text-error text-xs mt-1 font-semibold">{{ $message }}</span> @enderror
                    <label class="label"><span class="label-text-alt text-base-content/60 font-medium">Gunakan kode teman Anda untuk mendapatkan potongan/cashback (jika berlaku).</span></label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary w-full text-white font-bold text-lg">
                        {{ $package->is_custom_domain ? 'Kirim Pesanan untuk Direview Admin' : 'Lanjut ke Pembayaran' }}
                    </button>
                    <p class="text-center text-xs text-base-content/50 mt-4 italic">Dengan mengklik tombol di atas, Anda setuju dengan syarat dan ketentuan layanan kami.</p>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layouts.admin>
