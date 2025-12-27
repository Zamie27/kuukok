<x-layouts.admin title="Admin - Posts">
    <div class="mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Posts</h1>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary text-white">Create</a>
        </div>
        <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>Updated</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>
                            <span class="badge {{ $post->status === 'published' ? 'badge-success' : 'badge-ghost' }}">
                                {{ $post->status }}
                            </span>
                        </td>
                        <td>{{ optional($post->author)->name }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-error text-white">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-layouts.admin>
