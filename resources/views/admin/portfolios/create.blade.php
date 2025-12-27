<x-layouts.admin title="Admin - Create Portfolio">
    <div class="mx-auto max-w-4xl">
        <h1 class="text-2xl font-bold mb-6">Create Portfolio Item</h1>
        
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Title</span></label>
                                <input type="text" name="title" required class="input input-bordered w-full" value="{{ old('title') }}" />
                                @error('title') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Slug</span> <span class="label-text-alt">(Optional)</span></label>
                                <input type="text" name="slug" class="input input-bordered w-full" value="{{ old('slug') }}" />
                                @error('slug') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Tags</span> <span class="label-text-alt">(Comma separated)</span></label>
                                <input type="text" name="tags" class="input input-bordered w-full" placeholder="web design, laravel, branding" value="{{ old('tags') }}" />
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Status</span></label>
                                <select name="status" class="select select-bordered w-full">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Cover Image</span></label>
                                <input type="file" name="cover_image" class="file-input file-input-bordered w-full" accept="image/*" />
                                @error('cover_image') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Gallery Images</span> <span class="label-text-alt">(Multiple)</span></label>
                                <input type="file" name="gallery[]" multiple class="file-input file-input-bordered w-full" accept="image/*" />
                                @error('gallery.*') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Description / Content</span></label>
                        <textarea name="description" rows="8" class="textarea textarea-bordered w-full font-mono">{{ old('description') }}</textarea>
                        @error('description') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="divider">SEO Settings</div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Meta Title</span></label>
                            <input type="text" name="meta_title" class="input input-bordered w-full" value="{{ old('meta_title') }}" />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Meta Description</span></label>
                            <input type="text" name="meta_description" class="input input-bordered w-full" value="{{ old('meta_description') }}" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-ghost">Cancel</a>
                        <button type="submit" class="btn btn-primary text-white">Save Portfolio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
