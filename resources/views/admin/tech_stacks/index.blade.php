<x-layouts.admin title="Kelola Tech Stacks">
    <div class="mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Tech Stacks</h1>
            <a href="{{ route('admin.tech-stacks.create') }}" class="btn btn-primary text-white">Tambah Tech Stack</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th class="w-16">Logo</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th class="w-40 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($techStacks as $techStack)
                    <tr class="hover">
                        <td>
                            @if($techStack->logo)
                                <div class="avatar">
                                    <div class="mask mask-squircle w-10 h-10">
                                        <img src="{{ asset('storage/' . $techStack->logo) }}" alt="{{ $techStack->name }}" />
                                    </div>
                                </div>
                            @else
                                <div class="avatar placeholder">
                                    <div class="bg-neutral-focus text-neutral-content rounded-full w-10 h-10">
                                        <span class="text-xs">{{ substr($techStack->name, 0, 2) }}</span>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td class="font-medium">{{ $techStack->name }}</td>
                        <td>
                            <span class="badge badge-ghost">{{ $techStack->category }}</span>
                        </td>
                        <td class="flex justify-center gap-2">
                            <a href="{{ route('admin.tech-stacks.edit', $techStack) }}" class="btn btn-sm btn-ghost text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.tech-stacks.destroy', $techStack) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tech stack ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-ghost text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-8 text-base-content/60">
                            Belum ada Tech Stack yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
