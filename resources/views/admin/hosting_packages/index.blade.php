<x-layouts.admin title="Admin - Manajemen Hosting">
    <div class="mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold font-white">Paket Hosting</h1>
            <a href="{{ route('admin.hosting-packages.create') }}" class="btn btn-primary text-white">Tambah Paket</a>
        </div>
        
        <div class="overflow-x-auto bg-base-100 rounded-lg shadow border border-base-300">
            <table class="table">
                <thead>
                    <tr class="bg-base-200">
                        <th class="font-bold">Nama Paket</th>
                        <th class="font-bold">Harga</th>
                        <th class="font-bold">Label</th>
                        <th class="font-bold">Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr class="hover:bg-base-200/50">
                        <td class="font-medium">{{ $item->name }}</td>
                        <td>{{ $item->price_text }}</td>
                        <td>
                            @if($item->label)
                            <span class="badge badge-primary">{{ $item->label }}</span>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            <div class="badge {{ $item->status === 'active' ? 'badge-success' : 'badge-ghost' }} font-bold text-[10px] uppercase">
                                {{ $item->status }}
                            </div>
                        </td>
                        <td class="flex justify-end gap-2 text-right">
                            <a href="{{ route('admin.hosting-packages.edit', $item) }}" class="btn btn-sm btn-outline">Edit</a>
                            <form method="POST" action="{{ route('admin.hosting-packages.destroy', $item) }}" onsubmit="return confirm('Hapus paket ini?')">
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

        <!-- Hosting Page Settings Section -->
        <div class="mt-12">
            <h2 class="text-xl font-bold mb-4">Pengaturan Halaman Hosting (Kelebihan & Kekurangan)</h2>
            <div class="card bg-base-100 shadow border border-base-300">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.hosting-packages.settings.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Pros (Kelebihan) -->
                            <div class="space-y-4">
                                <h3 class="font-semibold text-success">Bagian Kelebihan (Hosting Pros)</h3>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Daftar Kelebihan (Satu per baris)</span></label>
                                    <textarea name="hosting_pros_items" rows="6" class="textarea textarea-bordered w-full">{{ $settings['hosting_pros_items'] ?? "Server High Performance dengan NVMe SSD\nUptime Guarantee 99.9%\nGratis SSL (Let's Encrypt) Selamanya\nBackup Harian Otomatis\nSupport Teknis 24/7" }}</textarea>
                                </div>
                            </div>

                            <!-- Cons (Kekurangan/Pertimbangan) -->
                            <div class="space-y-4">
                                <h3 class="font-semibold text-warning">Bagian Pertimbangan (Hosting Cons)</h3>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Daftar Pertimbangan (Satu per baris)</span></label>
                                    <textarea name="hosting_cons_items" rows="6" class="textarea textarea-bordered w-full">{{ $settings['hosting_cons_items'] ?? "Penggunaan resource CPU & RAM dibatasi\nTidak untuk situs dengan trafik ekstrim\nPerlu konfigurasi domain secara manual\nBiaya renewal mengikuti harga pasar" }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary text-white">Simpan Pengaturan Hosting</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
