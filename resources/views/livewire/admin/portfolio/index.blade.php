<div>
    <x-slot name="title">Portfolio Management</x-slot>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Portfolio Management</h1>
        <button wire:click="create" class="btn btn-primary text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add New
        </button>
    </div>

    {{-- Search & Filter --}}
    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <div class="form-control w-full md:w-1/3">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search portfolios..." class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full md:w-1/4">
            <select wire:model.live="statusFilter" class="select select-bordered w-full">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="archived">Archived</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="card bg-base-100 shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                @if($item->cover_image)
                                    <div class="avatar">
                                        <div class="w-12 h-12 rounded">
                                            <img src="{{ asset('storage/'.$item->cover_image) }}" alt="{{ $item->title }}" />
                                        </div>
                                    </div>
                                @else
                                    <div class="avatar placeholder">
                                        <div class="bg-neutral-focus text-neutral-content rounded w-12 h-12">
                                            <span class="text-xs">No Img</span>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="font-bold">{{ $item->title }}</div>
                                <div class="text-sm opacity-50">{{ Str::limit($item->excerpt, 50) }}</div>
                            </td>
                            <td>
                                <div class="badge {{ $item->status === 'published' ? 'badge-success text-white' : ($item->status === 'archived' ? 'badge-warning' : 'badge-ghost') }}">
                                    {{ ucfirst($item->status) }}
                                </div>
                            </td>
                            <td>
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-ghost">Edit</button>
                                    @if($item->status !== 'published')
                                        <button wire:click="publish({{ $item->id }})" class="btn btn-sm btn-ghost text-success">Publish</button>
                                    @else
                                        <button wire:click="unpublish({{ $item->id }})" class="btn btn-sm btn-ghost text-warning">Draft</button>
                                    @endif
                                    <button wire:click="delete({{ $item->id }})" 
                                            wire:confirm="Are you sure you want to delete this portfolio item?" 
                                            class="btn btn-sm btn-ghost text-error">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-base-content/50">No portfolio items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $items->links() }}
        </div>
    </div>

    {{-- Modal --}}
    @if($showModal)
    <div class="modal modal-open">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg mb-4">{{ $editingId ? 'Edit Portfolio' : 'Create Portfolio' }}</h3>
            
            <form wire:submit.prevent="save" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Left Column --}}
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Title</span></label>
                            <input type="text" wire:model.live="title" class="input input-bordered w-full" />
                            @error('title') <span class="text-error text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Slug</span></label>
                            <input type="text" wire:model="slug" class="input input-bordered w-full" />
                            @error('slug') <span class="text-error text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Tags</span> <span class="label-text-alt">(Comma separated)</span></label>
                            <input type="text" wire:model="tagsInput" class="input input-bordered w-full" placeholder="e.g. web, design, laravel" />
                            @error('tagsInput') <span class="text-error text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Status</span></label>
                            <select wire:model="status" class="select select-bordered w-full">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                            @error('status') <span class="text-error text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Excerpt</span></label>
                            <textarea wire:model="excerpt" class="textarea textarea-bordered h-20"></textarea>
                            @error('excerpt') <span class="text-error text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Cover Image</span></label>
                            @if($coverUpload)
                                <img src="{{ $coverUpload->temporaryUrl() }}" class="h-32 w-full object-cover rounded mb-2">
                            @elseif($editingId && $items->find($editingId)->cover_image)
                                <img src="{{ asset('storage/'.$items->find($editingId)->cover_image) }}" class="h-32 w-full object-cover rounded mb-2">
                            @endif
                            <input type="file" wire:model="coverUpload" class="file-input file-input-bordered w-full" accept="image/*" />
                            <div wire:loading wire:target="coverUpload" class="text-sm text-info mt-1">Uploading...</div>
                            @error('coverUpload') <span class="text-error text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Gallery Images</span></label>
                            
                            {{-- Existing Gallery --}}
                            @if(!empty($gallery))
                                <div class="grid grid-cols-4 gap-2 mb-2">
                                    @foreach($gallery as $index => $img)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/'.$img) }}" class="w-full h-16 object-cover rounded">
                                            <div class="absolute inset-0 bg-black/50 hidden group-hover:flex items-center justify-center gap-1">
                                                <button type="button" wire:click="moveGalleryUp({{ $index }})" class="btn btn-xs btn-square">↑</button>
                                                <button type="button" wire:click="moveGalleryDown({{ $index }})" class="btn btn-xs btn-square">↓</button>
                                                <button type="button" wire:click="removeGalleryItem({{ $index }})" class="btn btn-xs btn-error btn-square">×</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <input type="file" wire:model="galleryUploads" multiple class="file-input file-input-bordered w-full" accept="image/*" />
                            <div wire:loading wire:target="galleryUploads" class="text-sm text-info mt-1">Uploading...</div>
                            @error('galleryUploads.*') <span class="text-error text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Description</span></label>
                    <textarea wire:model="description" class="textarea textarea-bordered h-40 font-mono"></textarea>
                    @error('description') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="divider">SEO</div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text">Meta Title</span></label>
                        <input type="text" wire:model="meta_title" class="input input-bordered w-full" />
                        @error('meta_title') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Meta Description</span></label>
                        <input type="text" wire:model="meta_description" class="input input-bordered w-full" />
                        @error('meta_description') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="modal-action">
                    <button type="button" wire:click="$set('showModal', false)" class="btn">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="toast toast-end">
            <div class="alert alert-success">
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif
</div>
