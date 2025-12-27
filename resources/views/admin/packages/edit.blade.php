<x-layouts.admin title="Admin - Edit Package">
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-bold mb-6">Edit Package</h1>
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.packages.update', $item) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="form-control">
                        <label class="label"><span class="label-text">Name</span></label>
                        <input type="text" name="name" value="{{ $item->name }}" required class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Price Text</span></label>
                        <input type="text" name="price_text" value="{{ $item->price_text }}" required class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Label</span></label>
                        <input type="text" name="label" value="{{ $item->label }}" class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Features (one per line)</span></label>
                        <textarea name="features" rows="6" class="textarea textarea-bordered w-full" placeholder="One feature per line">{{ is_array($item->features) ? implode("\n", $item->features) : $item->features }}</textarea>
                        <label class="label"><span class="label-text-alt">Note: Implementation might require array inputs depending on controller.</span></label>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">CTA Link</span></label>
                        <input type="url" name="cta_link" value="{{ $item->cta_link }}" class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Status</span></label>
                        <select name="status" class="select select-bordered w-full">
                            <option value="active" @selected($item->status==='active')>Active</option>
                            <option value="inactive" @selected($item->status==='inactive')>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary text-white">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
