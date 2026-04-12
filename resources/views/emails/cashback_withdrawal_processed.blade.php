<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .amount { font-size: 36px; font-weight: bold; color: #10b981; text-align: center; margin: 20px 0; }
        .info-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f1f5f9; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #64748b; font-size: 14px; }
        .info-value { font-weight: bold; color: #1e293b; }
        .footer { background: #f8fafc; padding: 20px; text-align: center; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Pencairan Cashback Disetujui</h1>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $withdrawal->user->name }}</strong>,</p>
            <p>Permintaan pencairan cashback Anda telah disetujui dan sedang diproses.</p>

            <div class="amount">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</div>

            <div class="info-box">
                <div class="info-row">
                    <span class="info-label">Metode:</span>
                    <span class="info-value">{{ $withdrawal->method }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tujuan:</span>
                    <span class="info-value">{{ $withdrawal->bank_info }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nomor:</span>
                    <span class="info-value">{{ $withdrawal->account_number }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Atas Nama:</span>
                    <span class="info-value">{{ $withdrawal->account_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal:</span>
                    <span class="info-value">{{ $withdrawal->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            <p>Dana akan dikirimkan ke rekening/e-wallet tujuan dalam waktu 1×24 jam kerja.</p>
            <p>Terima kasih telah menggunakan layanan referral Kuukok!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Kuukok. Semua hak dilindungi.
        </div>
    </div>
</body>
</html>
