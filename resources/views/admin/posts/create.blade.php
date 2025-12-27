<x-layouts.admin title="Admin - Create Post">
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-bold mb-6">Create Post</h1>
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="form-control">
                        <label class="label"><span class="label-text">Title</span></label>
                        <input type="text" name="title" required class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Slug</span></label>
                        <input type="text" name="slug" class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Category</span></label>
                        <input type="text" name="category" class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Content</span></label>
                        <textarea name="content" rows="8" class="textarea textarea-bordered w-full"></textarea>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Cover Image</span></label>
                        <input type="file" name="cover_image" class="file-input file-input-bordered w-full" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Meta Title</span></label>
                            <input type="text" name="meta_title" class="input input-bordered w-full" />
                        </div>
                        <div class="form-control md:col-span-2">
                            <label class="label"><span class="label-text">Meta Description</span></label>
                            <input type="text" name="meta_description" class="input input-bordered w-full" />
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Keywords</span></label>
                        <input type="text" name="keywords" class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Status</span></label>
                        <select name="status" class="select select-bordered w-full">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary text-white">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
