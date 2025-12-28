<x-layouts.admin title="Admin - Messages">
    <div class="mx-auto max-w-7xl">
        <h1 class="text-2xl font-bold mb-6">Pesan Masuk</h1>
        <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ Str::limit($message->subject, 30) }}</td>
                        <td>{{ $message->status }}</td>
                        <td>{{ $message->created_at->diffForHumans() }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm">Lihat</a>
                            @if($message->status === 'unread')
                            <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary text-white">Tandai Dibaca</button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Hapus pesan?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error text-white">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $messages->links() }}</div>
    </div>
</x-layouts.admin>
