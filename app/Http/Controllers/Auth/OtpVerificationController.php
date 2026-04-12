<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Notifications\VerifyEmailOtp;

class OtpVerificationController extends Controller
{
    public function show()
    {
        if (auth()->user()->is_active) {
            return redirect()->route('dashboard');
        }

        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = auth()->user();

        if ($user->otp_code === $request->otp && $user->otp_expires_at->isFuture()) {
            $user->is_active = true;
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->email_verified_at = now();
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Akun berhasil diverifikasi!');
        }

        return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kedaluwarsa.']);
    }

    public function resend()
    {
        $user = auth()->user();
        $otp = rand(100000, 999999);

        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        $user->notify(new VerifyEmailOtp($otp, $user->name));

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
