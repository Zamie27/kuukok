<x-layouts.admin title="Admin - Edit Portfolio">
    <div class="mx-auto max-w-4xl">
        <h1 class="text-2xl font-bold mb-6">Edit Portfolio Item</h1>
        
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.portfolios.update', $portfolio) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Title</span></label>
                                <input type="text" name="title" required class="input input-bordered w-full" value="{{ old('title', $portfolio->title) }}" />
                                @error('title') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Slug</span></label>
                                <input type="text" name="slug" required class="input input-bordered w-full" value="{{ old('slug', $portfolio->slug) }}" />
                                @error('slug') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Tags</span> <span class="label-text-alt">(Comma separated)</span></label>
                                <input type="text" name="tags" class="input input-bordered w-full" value="{{ old('tags', implode(', ', $portfolio->tags ?? [])) }}" />
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Status</span></label>
                                <select name="status" class="select select-bordered w-full">
                                    <option value="draft" {{ old('status', $portfolio->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $portfolio->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status', $portfolio->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Cover Image</span></label>
                                @if($portfolio->cover_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/'.$portfolio->cover_image) }}" alt="Cover" class="h-32 rounded object-cover">
                                    </div>
                                @endif
                                <input type="file" name="cover_image" class="file-input file-input-bordered w-full" accept="image/*" />
                                <span class="label-text-alt text-base-content/60">Upload to replace existing cover</span>
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Add Gallery Images</span></label>
                                <input type="file" name="gallery[]" multiple class="file-input file-input-bordered w-full" accept="image/*" />
                            </div>
                        </div>
                    </div>

                    <!-- Existing Gallery Management -->
                    @if(!empty($portfolio->gallery))
                        <div class="divider">Current Gallery</div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($portfolio->gallery as $image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/'.$image) }}" class="w-full h-32 object-cover rounded border border-base-300">
                                    <div class="absolute top-1 right-1">
                                        <label class="label cursor-pointer bg-base-100/80 rounded p-1">
                                            <input type="checkbox" name="remove_gallery_images[]" value="{{ $image }}" class="checkbox checkbox-error checkbox-xs" />
                                            <span class="label-text ml-1 text-xs text-error font-bold">Delete</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-control">
                        <label class="label"><span class="label-text">Description / Content</span></label>
                        <textarea name="description" rows="8" class="textarea textarea-bordered w-full font-mono">{{ old('description', $portfolio->description) }}</textarea>
                    </div>

                    <div class="divider">SEO Settings</div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Meta Title</span></label>
                            <input type="text" name="meta_title" class="input input-bordered w-full" value="{{ old('meta_title', $portfolio->meta_title) }}" />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Meta Description</span></label>
                            <input type="text" name="meta_description" class="input input-bordered w-full" value="{{ old('meta_description', $portfolio->meta_description) }}" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-ghost">Cancel</a>
                        <button type="submit" class="btn btn-primary text-white">Update Portfolio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
