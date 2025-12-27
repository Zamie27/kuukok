<x-layouts.admin title="Admin - FAQs">
    <div class="mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">FAQs</h1>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary text-white">Create</a>
        </div>
        <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
            <table class="table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Active</th>
                        <th>Order</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->question }}</td>
                        <td>{{ $item->active ? 'Yes' : 'No' }}</td>
                        <td>{{ $item->sort_order }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('admin.faqs.edit', $item) }}" class="btn btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.faqs.destroy', $item) }}" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error text-white">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
