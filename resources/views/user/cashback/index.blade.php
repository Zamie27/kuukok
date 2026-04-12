<x-layouts.admin title="Cashback Saya">
<div class="mx-auto max-w-4xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Cashback Saya</h1>
        <p class="text-base-content/60 mt-1">Kelola saldo cashback dan ajukan pencairan.</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-6">{{ session('success') }}</div>
    @elseif(session('error'))
    <div class="alert alert-error mb-6 text-white">{{ session('error') }}</div>
    @endif

    <!-- Saldo Card -->
    <div class="card bg-gradient-to-r from-secondary to-primary text-white shadow-xl mb-8">
        <div class="card-body">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <p class="text-sm opacity-80 uppercase tracking-widest">Saldo Cashback</p>
                    <p class="text-5xl font-extrabold mt-2">Rp {{ number_format($user->cashback_balance ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs opacity-60 mt-2">Total cashback diperoleh seumur hidup: Rp {{ number_format($user->lifetime_cashback_earned ?? 0, 0, ',', '.') }} / Rp 30.000</p>
                </div>
                @if(($user->cashback_balance ?? 0) >= 10000)
                <button onclick="document.getElementById('withdrawal_modal').showModal()" class="btn btn-lg bg-white text-secondary hover:bg-white/90 border-0 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    Cairkan Saldo
                </button>
                @else
                <div class="text-sm opacity-70 bg-white/10 px-4 py-2 rounded-lg">Min. pencairan Rp 10.000</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Riwayat Pencairan -->
    <div class="card bg-base-100 shadow border border-base-200">
        <div class="card-body">
            <h2 class="card-title mb-4">Riwayat Pencairan</h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th class="bg-base-200">Tanggal</th>
                            <th class="bg-base-200">Jumlah</th>
                            <th class="bg-base-200">Metode</th>
                            <th class="bg-base-200">Tujuan</th>
                            <th class="bg-base-200">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($withdrawals as $w)
                        <tr>
                            <td class="text-sm">{{ $w->created_at->format('d M Y, H:i') }}</td>
                            <td class="font-bold">Rp {{ number_format($w->amount, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-outline text-xs">{{ $w->method }}</span>
                            </td>
                            <td class="text-sm">
                                <div>{{ $w->bank_info }}</div>
                                <div class="text-xs text-base-content/50">{{ $w->account_number }} - {{ $w->account_name }}</div>
                            </td>
                            <td>
                                @php
                                    $badgeClass = match($w->status) {
                                        'pending' => 'badge-warning',
                                        'approved' => 'badge-success text-white',
                                        'rejected' => 'badge-error text-white',
                                        default => 'badge-ghost',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} font-bold">{{ $w->status_label }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-base-content/40 italic">Belum ada riwayat pencairan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($withdrawals->hasPages())
            <div class="mt-4">{{ $withdrawals->links() }}</div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Pencairan -->
<dialog id="withdrawal_modal" class="modal">
    <div class="modal-box max-w-lg">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-2xl mb-2">Cairkan Saldo Cashback</h3>
        <p class="text-sm text-base-content/60 mb-6">Saldo tersedia: <strong>Rp {{ number_format($user->cashback_balance ?? 0, 0, ',', '.') }}</strong></p>

        <form action="{{ route('user.cashback.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="form-control">
                <label class="label"><span class="label-text font-semibold">Jumlah Pencairan (Rp)</span></label>
                <input type="number" name="amount" min="10000" max="{{ $user->cashback_balance ?? 0 }}" value="{{ $user->cashback_balance ?? 0 }}" class="input input-bordered w-full" required />
                <label class="label"><span class="label-text-alt text-base-content/50">Minimum Rp 10.000</span></label>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text font-semibold">Metode Pencairan</span></label>
                <select name="method" class="select select-bordered w-full" required onchange="updateBankLabel(this.value)">
                    <option value="" disabled selected>Pilih metode...</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="DANA">E-Wallet DANA</option>
                    <option value="OVO">E-Wallet OVO</option>
                    <option value="GoPay">E-Wallet GoPay</option>
                    <option value="ShopeePay">ShopeePay</option>
                </select>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text font-semibold" id="bank_label">Nama Bank / E-Wallet</span></label>
                <input type="text" name="bank_info" placeholder="Contoh: BCA, BRI, DANA, dll" class="input input-bordered w-full" required />
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text font-semibold">Nomor Rekening / HP</span></label>
                <input type="text" name="account_number" placeholder="Nomor rekening atau nomor HP" class="input input-bordered w-full" required />
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text font-semibold">Atas Nama</span></label>
                <input type="text" name="account_name" placeholder="Nama pemilik rekening/e-wallet" class="input input-bordered w-full" value="{{ $user->name }}" required />
            </div>

            <div class="alert alert-warning text-sm mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                <span>Pastikan data tujuan transfer sudah benar. Kesalahan data menjadi tanggung jawab Anda.</span>
            </div>

            <button type="submit" class="btn btn-secondary text-white w-full mt-2" onclick="return confirm('Apakah Anda yakin ingin mencairkan saldo ini?')">
                Kirim Permintaan Pencairan
            </button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

<script>
function updateBankLabel(value) {
    const label = document.getElementById('bank_label');
    if (value === 'Bank Transfer') {
        label.textContent = 'Nama Bank';
    } else {
        label.textContent = 'Nama E-Wallet';
    }
}
</script>
</x-layouts.admin>
