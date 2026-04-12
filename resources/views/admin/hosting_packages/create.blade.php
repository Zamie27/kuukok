<x-layouts.admin title="Admin - Tambah Paket Hosting">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.hosting-packages.index') }}" class="btn btn-ghost btn-sm gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
            <h1 class="text-2xl font-bold mt-4">Tambah Paket Hosting Baru</h1>
        </div>

        <div class="card bg-base-100 shadow border border-base-300">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.hosting-packages.store') }}" class="space-y-4">
                    @csrf
                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold">Nama Paket</span></label>
                        <input type="text" name="name" placeholder="Contoh: Hosting Lite" required class="input input-bordered w-full" />
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold">Harga (Teks)</span></label>
                            <input type="text" name="price_text" placeholder="Contoh: Rp 25.000 / bln" required class="input input-bordered w-full" />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold">Label (Opsional)</span></label>
                            <input type="text" name="label" placeholder="Contoh: Best Seller" class="input input-bordered w-full" />
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold">Fitur Hosting (Satu per baris)</span></label>
                        <textarea name="features" rows="8" class="textarea textarea-bordered w-full" placeholder="500MB NVMe Storage&#10;Unlimited Bandwidth&#10;1 Domain&#10;Gratis SSL"></textarea>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold">Link CTA (Opsional)</span></label>
                        <input type="url" name="cta_link" placeholder="https://..." class="input input-bordered w-full" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold">Status</span></label>
                            <select name="status" class="select select-bordered w-full">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold">Urutan (Sort Order)</span></label>
                            <input type="number" name="sort_order" value="0" min="0" class="input input-bordered w-full" />
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary w-full text-white">Simpan Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
