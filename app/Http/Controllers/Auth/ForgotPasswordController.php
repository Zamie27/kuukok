<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Mail\OtpMail;

class ForgotPasswordController extends Controller
{
    /**
     * Show the form to enter email.
     */
    public function showEmailForm()
    {
        return view('auth.forgot-password.email');
    }

    /**
     * Handle the email submission and send OTP.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan.',
        ]);

        $otp = rand(100000, 999999);
        $email = $request->email;

        // Store OTP in cache for 10 minutes
        Cache::put('password_reset_otp_' . $email, $otp, now()->addMinutes(10));

        $user = User::where('email', $email)->first();

        try {
            Mail::to($user)->send(new OtpMail($otp, $user));
            return redirect()->route('password.otp', ['email' => $email])
                ->with('status', 'Kode OTP telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email OTP: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim email. Silakan coba lagi.']);
        }
    }

    /**
     * Show the OTP verification form.
     */
    public function showOtpForm(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        return view('auth.forgot-password.otp', compact('email'));
    }

    /**
     * Verify the OTP.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6',
        ]);

        $cachedOtp = Cache::get('password_reset_otp_' . $request->email);

        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }

        // OTP verified, create a temporary token to allow password reset
        // This prevents users from skipping the OTP step
        $token = \Illuminate\Support\Str::random(60);
        Cache::put('password_reset_token_' . $request->email, $token, now()->addMinutes(15));

        return redirect()->route('password.reset', ['email' => $request->email, 'token' => $token]);
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm(Request $request)
    {
        $email = $request->query('email');
        $token = $request->query('token');

        if (!$email || !$token) {
            return redirect()->route('password.request');
        }

        // Verify the token exists
        if (!Cache::has('password_reset_token_' . $email) || Cache::get('password_reset_token_' . $email) !== $token) {
            return redirect()->route('password.request')->withErrors(['email' => 'Sesi reset password tidak valid atau kadaluarsa.']);
        }

        return view('auth.forgot-password.reset', compact('email', 'token'));
    }

    /**
     * Handle the password reset.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:6',             // Minimal 6 karakter
                'regex:/[a-z]/',      // Huruf kecil
                'regex:/[A-Z]/',      // Huruf besar
                'regex:/[0-9]/',      // Angka
                'regex:/[@$!%*#?&]/', // Simbol
            ],
        ], [
            'password.min' => 'Password minimal 6 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Verify token again
        if (!Cache::has('password_reset_token_' . $request->email) || Cache::get('password_reset_token_' . $request->email) !== $request->token) {
            return back()->withErrors(['email' => 'Sesi reset password tidak valid atau kadaluarsa.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        // Clear all caches
        Cache::forget('password_reset_otp_' . $request->email);
        Cache::forget('password_reset_token_' . $request->email);

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }
}
