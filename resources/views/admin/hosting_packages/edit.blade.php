<x-layouts.admin title="Admin - Edit Paket Hosting">
    <div class="mx-auto max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.hosting-packages.index') }}" class="btn btn-ghost btn-sm gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
            <h1 class="text-2xl font-bold mt-4">Edit Paket Hosting: {{ $item->name }}</h1>
        </div>

        <div class="card bg-base-100 shadow border border-base-300">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.hosting-packages.update', $item) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold">Nama Paket</span></label>
                        <input type="text" name="name" value="{{ old('name', $item->name) }}" required class="input input-bordered w-full" />
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold">Harga (Teks)</span></label>
                            <input type="text" name="price_text" value="{{ old('price_text', $item->price_text) }}" required class="input input-bordered w-full" />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold">Label (Opsional)</span></label>
                            <input type="text" name="label" value="{{ old('label', $item->label) }}" class="input input-bordered w-full" />
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold">Fitur Hosting (Satu per baris)</span></label>
                        <textarea name="features" rows="8" class="textarea textarea-bordered w-full">{{ old('features', implode("\n", $item->features ?? [])) }}</textarea>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold">Link CTA (Opsional)</span></label>
                        <input type="url" name="cta_link" value="{{ old('cta_link', $item->cta_link) }}" class="input input-bordered w-full" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold">Status</span></label>
                            <select name="status" class="select select-bordered w-full">
                                <option value="active" {{ $item->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $item->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold">Urutan (Sort Order)</span></label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="input input-bordered w-full" />
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary w-full text-white">Update Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
