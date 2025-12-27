<x-mail::message>
    # Reset Password

    Halo {{ $user->name }},

    Gunakan kode OTP berikut untuk mereset password akun Anda. Kode ini berlaku selama 10 menit.

    <x-mail::panel>
        {{ $otp }}
    </x-mail::panel>

    Jika Anda tidak meminta reset password, abaikan email ini.

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>
