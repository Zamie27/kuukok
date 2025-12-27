<x-layouts.admin>
    <x-slot name="title">Edit User</x-slot>

    <div class="flex items-center gap-2 mb-6">
        <a href="{{ route('admin.users.index') }}" class="btn btn-circle btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold">Edit User</h1>
    </div>

    <div class="card bg-base-100 shadow-xl max-w-2xl">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full @error('name') input-error @enderror" required />
                    @error('name')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full @error('email') input-error @enderror" required />
                    @error('email')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select name="role" class="select select-bordered w-full @error('role') select-error @enderror">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @error('role')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="divider">Ubah Password (Opsional)</div>

                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text">Password Baru</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered w-full @error('password') input-error @enderror" />
                    <label class="label">
                        <span class="label-text-alt text-base-content/60">Kosongkan jika tidak ingin mengubah password</span>
                    </label>
                    @error('password')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control w-full mb-6">
                    <label class="label">
                        <span class="label-text">Konfirmasi Password Baru</span>
                    </label>
                    <input type="password" name="password_confirmation" class="input input-bordered w-full" />
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
