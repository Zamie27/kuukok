<x-layouts.admin title="Edit Tech Stack">
    <div class="mx-auto max-w-2xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.tech-stacks.index') }}" class="btn btn-circle btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold">Edit Tech Stack</h1>
        </div>

        <div class="card bg-base-100 shadow-lg">
            <div class="card-body">
                <form action="{{ route('admin.tech-stacks.update', $techStack) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full mb-4">
                        <label class="label">
                            <span class="label-text font-semibold">Nama Tech Stack</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $techStack->name) }}" placeholder="Contoh: Laravel, React, Photoshop" class="input input-bordered w-full @error('name') input-error @enderror" required />
                        @error('name')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full mb-4">
                        <label class="label">
                            <span class="label-text font-semibold">Kategori</span>
                        </label>
                        <select name="category" class="select select-bordered w-full @error('category') select-error @enderror">
                            @foreach(\App\Models\TechStack::getCategories() as $category)
                                <option value="{{ $category }}" {{ old('category', $techStack->category) == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full mb-6">
                        <label class="label">
                            <span class="label-text font-semibold">Logo</span>
                            <span class="label-text-alt">Biarkan kosong jika tidak ingin mengubah logo</span>
                        </label>
                        
                        @if($techStack->logo)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $techStack->logo) }}" alt="Current Logo" class="h-16 w-16 object-contain rounded-lg border p-1">
                            </div>
                        @endif

                        <input type="file" name="logo" class="file-input file-input-bordered w-full @error('logo') file-input-error @enderror" accept="image/*" />
                        @error('logo')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="card-actions justify-end">
                        <button type="submit" class="btn btn-primary text-white">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
