<x-layouts.admin title="Admin - Packages">
    <div class="mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Packages</h1>
            <a href="{{ route('admin.packages.create') }}" class="btn btn-primary text-white">Create</a>
        </div>
        <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Label</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price_text }}</td>
                        <td>{{ $item->label }}</td>
                        <td>{{ $item->status }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('admin.packages.edit', $item) }}" class="btn btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.packages.destroy', $item) }}" onsubmit="return confirm('Delete?')">
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

        <!-- Pricing Page Settings Section -->
        <div class="mt-12">
            <h2 class="text-xl font-bold mb-4">Pengaturan Halaman Harga (Kelebihan & Kekurangan)</h2>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Section Header -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Judul Section</span></label>
                                <input type="text" name="pricing_comparison_title" value="{{ $settings['pricing_comparison_title'] ?? 'Kelebihan & Pertimbangan Web Development' }}" class="input input-bordered w-full" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Sub-Judul</span></label>
                                <input type="text" name="pricing_comparison_subtitle" value="{{ $settings['pricing_comparison_subtitle'] ?? 'Transparansi layanan untuk keputusan terbaik bisnis Anda' }}" class="input input-bordered w-full" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Pros (Kelebihan) -->
                            <div class="space-y-4">
                                <h3 class="font-semibold text-success">Bagian Kelebihan (Pros)</h3>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Judul Kolom</span></label>
                                    <input type="text" name="pricing_pros_title" value="{{ $settings['pricing_pros_title'] ?? 'Kelebihan' }}" class="input input-bordered w-full" />
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Daftar Poin (Satu per baris)</span></label>
                                    <textarea name="pricing_pros_items" rows="6" class="textarea textarea-bordered w-full">{{ $settings['pricing_pros_items'] ?? "Profesional & kredibel untuk bisnis Anda\nDapat diakses 24/7 dari mana saja\nMeningkatkan jangkauan pasar secara online\nMudah di-update dan dikelola\nDapat terintegrasi dengan berbagai tools & API" }}</textarea>
                                </div>
                            </div>

                            <!-- Cons (Kekurangan/Pertimbangan) -->
                            <div class="space-y-4">
                                <h3 class="font-semibold text-warning">Bagian Pertimbangan (Cons)</h3>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Judul Kolom</span></label>
                                    <input type="text" name="pricing_cons_title" value="{{ $settings['pricing_cons_title'] ?? 'Pertimbangan' }}" class="input input-bordered w-full" />
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Daftar Poin (Satu per baris)</span></label>
                                    <textarea name="pricing_cons_items" rows="6" class="textarea textarea-bordered w-full">{{ $settings['pricing_cons_items'] ?? "Memerlukan hosting dan domain (biaya tahunan)\nButuh maintenance dan security update berkala\nWaktu pengerjaan beberapa minggu tergantung kompleksitas\nPerlu konten dan materi yang jelas sebelum mulai" }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary text-white">Simpan Pengaturan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
