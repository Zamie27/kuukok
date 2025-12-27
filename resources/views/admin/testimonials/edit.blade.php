<x-layouts.admin title="Admin - Edit Testimonial">
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-bold mb-6">Edit Testimonial</h1>
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.testimonials.update', $item) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="form-control">
                        <label class="label"><span class="label-text">Name</span></label>
                        <input type="text" name="name" value="{{ $item->name }}" required class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Role</span></label>
                        <input type="text" name="role" value="{{ $item->role }}" class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Content</span></label>
                        <textarea name="content" rows="6" class="textarea textarea-bordered w-full">{{ $item->content }}</textarea>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Rating</span></label>
                        <input type="number" name="rating" min="1" max="5" value="{{ $item->rating }}" class="input input-bordered w-24" />
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer justify-start gap-4">
                            <span class="label-text">Samarkan Nama (Tampilkan Inisial)</span>
                            <input type="checkbox" name="is_masked" value="1" @checked($item->is_masked) class="checkbox checkbox-primary" />
                        </label>
                        <span class="text-xs text-base-content/60 ml-1">Contoh: "R**** A* Z******"</span>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Photo</span></label>
                        <input type="file" name="photo" class="file-input file-input-bordered w-full" />
                        @if($item->photo)
                        <div class="mt-2 text-sm">Current: <a href="{{ asset('storage/'.$item->photo) }}" class="link link-hover">view</a></div>
                        @endif
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
