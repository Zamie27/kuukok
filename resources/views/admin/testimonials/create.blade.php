<x-layouts.admin title="Admin - Create Testimonial">
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-bold mb-6">Create Testimonial</h1>
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="form-control">
                        <label class="label"><span class="label-text">Name</span></label>
                        <input type="text" name="name" required class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Role</span></label>
                        <input type="text" name="role" class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Content</span></label>
                        <textarea name="content" rows="6" class="textarea textarea-bordered w-full"></textarea>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Rating</span></label>
                        <input type="number" name="rating" min="1" max="5" value="5" class="input input-bordered w-24" />
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer justify-start gap-4">
                            <span class="label-text">Samarkan Nama (Tampilkan Inisial)</span>
                            <input type="checkbox" name="is_masked" value="1" class="checkbox checkbox-primary" />
                        </label>
                        <span class="text-xs text-base-content/60 ml-1">Contoh: "R**** A* Z******"</span>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Photo</span></label>
                        <input type="file" name="photo" class="file-input file-input-bordered w-full" />
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
