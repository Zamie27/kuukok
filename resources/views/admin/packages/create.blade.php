<x-layouts.admin title="Admin - Create Package">
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-bold mb-6">Create Package</h1>
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.packages.store') }}" class="space-y-4">
                    @csrf
                    <div class="form-control">
                        <label class="label"><span class="label-text">Name</span></label>
                        <input type="text" name="name" required class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Price Text</span></label>
                        <input type="text" name="price_text" required class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Label</span></label>
                        <input type="text" name="label" class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Features (one per line)</span></label>
                        <textarea name="features" rows="6" class="textarea textarea-bordered w-full" placeholder="One feature per line"></textarea>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">CTA Link</span></label>
                        <input type="url" name="cta_link" class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Status</span></label>
                        <select name="status" class="select select-bordered w-full">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary text-white">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>