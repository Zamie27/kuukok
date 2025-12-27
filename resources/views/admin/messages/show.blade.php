<x-layouts.admin title="Admin - Message Detail">
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-bold mb-6">Detail Pesan</h1>
        <div class="card bg-base-100 shadow">
            <div class="card-body space-y-2">
                <div><span class="font-semibold">Nama:</span> {{ $message->name }}</div>
                <div><span class="font-semibold">Email:</span> {{ $message->email }}</div>
                <div><span class="font-semibold">Subjek:</span> {{ $message->subject }}</div>
                <div><span class="font-semibold">Dikirim:</span> {{ $message->created_at->format('d M Y H:i') }}</div>
                <div class="divider"></div>
                <div class="prose max-w-none">{{ $message->body }}</div>
            </div>
        </div>
        <div class="mt-4 flex gap-2">
            @if($message->status === 'unread')
            <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                @csrf
                <button class="btn btn-primary text-white">Tandai Dibaca</button>
            </form>
            @endif
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Hapus pesan?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-error text-white">Hapus</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
