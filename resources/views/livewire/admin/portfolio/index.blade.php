<div>
    <x-slot name="title">Portfolio Management</x-slot>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Portfolio Management</h1>
        <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add New
        </a>
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
                                <a href="{{ route('admin.portfolios.edit', $item->id) }}" class="btn btn-sm btn-ghost">Edit</a>
                                @if($item->status !== 'published')
                                <button wire:click="publish({{ $item->id }})" class="btn btn-sm btn-ghost text-success">Publish</button>
                                @else
                                <button wire:click="unpublish({{ $item->id }})" class="btn btn-sm btn-ghost text-warning">Draft</button>
                                @endif
                                <form action="{{ route('admin.portfolios.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this portfolio item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-ghost text-error">Delete</button>
                                </form>
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

    {{-- Flash Message --}}
    @if (session()->has('message'))
    <div class="toast toast-end">
        <div class="alert alert-success">
            <span>{{ session('message') }}</span>
        </div>
    </div>
    @endif
</div>
