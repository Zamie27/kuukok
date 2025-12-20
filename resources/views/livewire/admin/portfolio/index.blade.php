<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Manage Portfolio</h1>
        <div class="flex gap-2">
            <input type="text" placeholder="Search..." class="input input-bordered w-64" wire:model.live.debounce.500ms="search">
            <select class="select select-bordered" wire:model.live="statusFilter">
                <option value="">All</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
            </select>
            <button class="btn btn-primary" wire:click="create">Create Portfolio</button>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="alert alert-success mb-4">{{ session('message') }}</div>
    @endif

    <div class="overflow-x-auto bg-base-200 rounded-lg">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Published At</th>
                    <th>Tags</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $it)
                <tr>
                    <td class="max-w-[320px]">
                        <div class="font-medium">{{ e($it->title) }}</div>
                        <div class="text-xs text-secondary">/{{ e($it->slug) }}</div>
                    </td>
                    <td>
                        @php $status = $it->status; @endphp
                        <span class="badge {{ $status === 'published' ? 'badge-success' : ($status === 'draft' ? 'badge-warning' : 'badge-neutral') }}">{{ e(ucfirst($status)) }}</span>
                    </td>
                    <td>{{ $it->published_at ? $it->published_at->format('Y-m-d') : '-' }}</td>
                    <td>
                        @foreach ((array) $it->tags as $tag)
                        <span class="badge badge-outline">{{ e($tag) }}</span>
                        @endforeach
                    </td>
                    <td class="text-right">
                        <div class="join">
                            <button class="btn btn-sm join-item" wire:click="edit({{ $it->id }})">Edit</button>
                            @if ($it->status !== 'published')
                            <button class="btn btn-sm btn-success join-item" wire:click="publish({{ $it->id }})">Publish</button>
                            @else
                            <button class="btn btn-sm btn-warning join-item" wire:click="unpublish({{ $it->id }})">Unpublish</button>
                            @endif
                            <button class="btn btn-sm btn-error join-item" wire:click="delete({{ $it->id }})" onclick="return confirm('Delete this portfolio?')">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $items->links() }}</div>

    <!-- Modal -->
    <dialog class="modal {{ $showModal ? 'modal-open' : '' }}">
        <div class="modal-box w-11/12 max-w-4xl">
            <h3 class="font-bold text-lg">{{ $editingId ? 'Edit Portfolio' : 'Create Portfolio' }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="label"><span class="label-text">Title</span></label>
                    <input type="text" class="input input-bordered w-full" wire:model.live="title" placeholder="Title">
                    @error('title') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="label"><span class="label-text">Slug</span></label>
                    <input type="text" class="input input-bordered w-full" wire:model.live="slug" placeholder="unique-slug">
                    @error('slug') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="label"><span class="label-text">Excerpt</span></label>
                    <textarea class="textarea textarea-bordered w-full" rows="3" wire:model.live="excerpt" placeholder="Short summary"></textarea>
                    @error('excerpt') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="label"><span class="label-text">Description</span></label>
                    <textarea class="textarea textarea-bordered w-full" rows="6" wire:model.live="description" placeholder="Detailed description"></textarea>
                    @error('description') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="label"><span class="label-text">Status</span></label>
                    <select class="select select-bordered w-full" wire:model.live="status">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                    @error('status') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="label"><span class="label-text">Tags (comma separated)</span></label>
                    <input type="text" class="input input-bordered w-full" wire:model.live="tagsInput" placeholder="web, design, ui">
                    @error('tagsInput') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="label"><span class="label-text">Meta Title</span></label>
                    <input type="text" class="input input-bordered w-full" wire:model.live="meta_title" placeholder="SEO title">
                    @error('meta_title') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="label"><span class="label-text">Meta Description</span></label>
                    <input type="text" class="input input-bordered w-full" wire:model.live="meta_description" placeholder="SEO description">
                    @error('meta_description') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="label"><span class="label-text">Cover Image</span></label>
                    <input type="file" class="file-input file-input-bordered w-full" wire:model="coverUpload" accept="image/jpeg,image/png,image/webp">
                    @error('coverUpload') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    <div wire:loading wire:target="coverUpload" class="text-sm mt-1">Uploading...</div>
                </div>
                <div>
                    <label class="label"><span class="label-text">Gallery Images</span></label>
                    <input type="file" multiple class="file-input file-input-bordered w-full" wire:model="galleryUploads" accept="image/jpeg,image/png,image/webp">
                    @error('galleryUploads.*') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    <div wire:loading wire:target="galleryUploads" class="text-sm mt-1">Uploading...</div>
                </div>
                <div class="md:col-span-2">
                    <label class="label"><span class="label-text">Current Gallery (reorder)</span></label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        @foreach ($gallery as $idx => $path)
                        <div class="bg-base-200 rounded p-2 flex flex-col items-center gap-2">
                            <img src="{{ asset('storage/' . $path) }}" alt="Gallery" class="w-full h-24 object-cover rounded">
                            <div class="join">
                                <button class="btn btn-xs join-item" wire:click="moveGalleryUp({{ $idx }})">Up</button>
                                <button class="btn btn-xs join-item" wire:click="moveGalleryDown({{ $idx }})">Down</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="modal-action">
                <button class="btn" wire:click="$set('showModal', false)">Close</button>
                @if ($editingId)
                <button class="btn btn-primary" wire:click="update">Update</button>
                @else
                <button class="btn btn-primary" wire:click="save">Save</button>
                @endif
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</div>
</div>