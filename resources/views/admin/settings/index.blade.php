<x-layouts.admin title="Admin - Pengaturan Website">
    <div class="mx-auto max-w-4xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Pengaturan Website</h1>
            <a href="{{ route('admin.tech-stacks.index') }}" class="btn btn-outline btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
                Kelola Tech Stack
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- About Section -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold border-b pb-2">Halaman Tentang Kami</h2>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Judul Utama</span></label>
                            <input type="text" name="about_title" value="{{ $settings['about_title'] ?? '' }}" class="input input-bordered w-full" />
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Deskripsi</span></label>
                            <textarea name="about_description" rows="4" class="textarea textarea-bordered w-full">{{ $settings['about_description'] ?? '' }}</textarea>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Gambar Tentang Kami</span></label>
                            <input type="file" name="about_image" class="file-input file-input-bordered w-full" accept="image/*" />
                            @if(isset($settings['about_image']) && $settings['about_image'])
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $settings['about_image']) }}" alt="About Image" class="w-48 h-auto rounded-lg shadow-sm">
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Vision & Mission -->
                    <div class="space-y-4 pt-4">
                        <h2 class="text-xl font-semibold border-b pb-2">Visi & Misi</h2>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Visi</span></label>
                            <textarea name="vision_text" rows="3" class="textarea textarea-bordered w-full">{{ $settings['vision_text'] ?? '' }}</textarea>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Misi (Satu per baris)</span></label>
                            <textarea name="mission_text" rows="5" class="textarea textarea-bordered w-full">{{ $settings['mission_text'] ?? '' }}</textarea>
                            <label class="label"><span class="label-text-alt text-base-content/60">Gunakan enter untuk memisahkan poin-poin misi.</span></label>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary text-white w-full sm:w-auto">Simpan Pengaturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
