<x-layouts.admin title="Pencairan Cashback">
<div class="mx-auto max-w-7xl">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">Pencairan Cashback</h1>
            <p class="text-base-content/60">Kelola permintaan pencairan dari pengguna.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-6">{{ session('success') }}</div>
    @elseif(session('error'))
    <div class="alert alert-error mb-6 text-white">{{ session('error') }}</div>
    @endif

    <div class="card bg-base-100 shadow border border-base-200">
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th class="bg-base-200">ID</th>
                        <th class="bg-base-200">User</th>
                        <th class="bg-base-200">Jumlah</th>
                        <th class="bg-base-200">Metode</th>
                        <th class="bg-base-200">Tujuan</th>
                        <th class="bg-base-200">Status</th>
                        <th class="bg-base-200">Tanggal</th>
                        <th class="bg-base-200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($withdrawals as $w)
                    <tr>
                        <td class="font-mono text-xs">#{{ $w->id }}</td>
                        <td>
                            <div class="flex flex-col">
                                <span class="font-bold">{{ $w->user->name ?? '-' }}</span>
                                <span class="text-xs text-base-content/50">{{ $w->user->email ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="font-bold text-accent">Rp {{ number_format($w->amount, 0, ',', '.') }}</td>
                        <td><span class="badge badge-outline text-xs">{{ $w->method }}</span></td>
                        <td class="text-sm">
                            <div class="font-semibold">{{ $w->bank_info }}</div>
                            <div class="text-xs text-base-content/50">{{ $w->account_number }}</div>
                            <div class="text-xs text-base-content/50">a.n. {{ $w->account_name }}</div>
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
                        <td class="text-sm text-base-content/60">{{ $w->created_at->format('d M Y') }}</td>
                        <td>
                            @if($w->status === 'pending')
                            <div class="flex gap-1">
                                <form action="{{ route('admin.cashback-withdrawals.approve', $w->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-xs text-white" onclick="return confirm('Setujui pencairan Rp {{ number_format($w->amount, 0, ',', '.') }} ke {{ $w->account_name }}?')">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.cashback-withdrawals.reject', $w->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-error btn-xs btn-outline" onclick="return confirm('Tolak pencairan ini? Saldo akan dikembalikan.')">
                                        Reject
                                    </button>
                                </form>
                            </div>
                            @else
                            <span class="text-xs text-base-content/40 italic">Sudah diproses</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-10 opacity-50">Belum ada permintaan pencairan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($withdrawals->hasPages())
        <div class="p-4 border-t">{{ $withdrawals->links() }}</div>
        @endif
    </div>
</div>
</x-layouts.admin>
