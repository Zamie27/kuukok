<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CashbackWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashbackController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $withdrawals = CashbackWithdrawal::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('user.cashback.index', compact('user', 'withdrawals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'method' => 'required|string|max:50',
            'bank_info' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
        ]);

        $user = Auth::user();

        if ($request->amount > $user->cashback_balance) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi.');
        }

        CashbackWithdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'method' => $request->method,
            'bank_info' => $request->bank_info,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'status' => 'pending',
        ]);

        // Kurangi saldo langsung
        $user->decrement('cashback_balance', $request->amount);

        return redirect()->route('user.cashback.index')->with('success', 'Permintaan pencairan berhasil dikirim. Mohon tunggu konfirmasi admin.');
    }
}
