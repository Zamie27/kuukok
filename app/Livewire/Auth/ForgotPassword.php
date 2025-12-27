<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Log;

class ForgotPassword extends Component
{
    public $email;
    public $otp;
    public $password;
    public $password_confirmation;
    public $step = 1; // 1: Email, 2: OTP, 3: New Password

    public function sendOtp()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan.',
        ]);

        $otp = rand(100000, 999999);
        Cache::put('password_reset_otp_' . $this->email, $otp, now()->addMinutes(10));

        $user = User::where('email', $this->email)->first();

        try {
            Mail::to($user)->send(new OtpMail($otp, $user));
            $this->step = 2;
            session()->flash('status', 'Kode OTP telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email OTP: ' . $e->getMessage());
            $this->addError('email', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }

    public function verifyOtp()
    {
        $this->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $cachedOtp = Cache::get('password_reset_otp_' . $this->email);

        if (!$cachedOtp || $cachedOtp != $this->otp) {
            $this->addError('otp', 'Kode OTP salah atau sudah kadaluarsa.');
            return;
        }

        $this->step = 3;
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::where('email', $this->email)->first();
        $user->forceFill([
            'password' => Hash::make($this->password),
        ])->save();

        Cache::forget('password_reset_otp_' . $this->email);

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-component');
    }
}
