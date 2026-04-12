<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashbackWithdrawal;
use App\Mail\CashbackWithdrawalProcessed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class CashbackWithdrawalController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) abort(403);

        $withdrawals = CashbackWithdrawal::with('user')
            ->latest()
            ->paginate(15);

        return view('admin.cashback_withdrawals.index', compact('withdrawals'));
    }

    public function approve(CashbackWithdrawal $withdrawal)
    {
        if (!Gate::allows('access-admin')) abort(403);

        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Pencairan ini sudah diproses.');
        }

        $withdrawal->update(['status' => 'approved']);

        // Kirim email notifikasi
        try {
            Mail::to($withdrawal->user->email)->send(new CashbackWithdrawalProcessed($withdrawal));
        } catch (\Exception $e) {
            // Log error tapi jangan gagalkan proses
            \Log::error('Failed to send withdrawal email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Pencairan disetujui dan notifikasi email terkirim.');
    }

    public function reject(CashbackWithdrawal $withdrawal)
    {
        if (!Gate::allows('access-admin')) abort(403);

        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Pencairan ini sudah diproses.');
        }

        // Kembalikan saldo
        $withdrawal->user->increment('cashback_balance', $withdrawal->amount);
        $withdrawal->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Pencairan ditolak dan saldo dikembalikan ke user.');
    }
}
