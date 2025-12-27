<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #374151;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 32px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }
        .otp-box {
            background-color: #f3f4f6;
            border-radius: 6px;
            padding: 16px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 8px;
            margin: 24px 0;
            color: #111827;
            border: 1px dashed #d1d5db;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            margin-top: 20px;
        }
        h1 {
            color: #111827;
            font-size: 22px;
            margin-top: 0;
        }
        p {
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            {{ config('app.name') }}
        </div>
        
        <div class="card">
            <h1>Reset Password</h1>
            
            <p>Halo {{ $user->name }},</p>
            
            <p>Kami menerima permintaan untuk mereset password akun Anda. Gunakan kode OTP di bawah ini untuk melanjutkan proses reset password:</p>
            
            <div class="otp-box">
                {{ $otp }}
            </div>
            
            <p style="font-size: 14px; color: #6b7280;">Kode ini hanya berlaku selama 10 menit. Jangan berikan kode ini kepada siapa pun.</p>
            
            <p>Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini.</p>
        </div>
        
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
