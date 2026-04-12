<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .info-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f1f5f9; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #64748b; font-size: 14px; }
        .info-value { font-weight: bold; font-family: monospace; color: #1e293b; }
        .warning { background: #fef3cd; border: 1px solid #ffc107; border-radius: 8px; padding: 15px; margin: 20px 0; font-size: 13px; color: #856404; }
        .footer { background: #f8fafc; padding: 20px; text-align: center; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Akun Hosting Anda Siap!</h1>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $order->customer_name }}</strong>,</p>
            <p>Selamat! Akun hosting untuk project <strong>{{ $order->project_name }}</strong> sudah siap digunakan.</p>

            <h3 style="margin-top: 30px;">🔐 Akses FTP</h3>
            <div class="info-box">
                <div class="info-row">
                    <span class="info-label">Host:</span>
                    <span class="info-value">{{ $order->hostingAccount->ftp_host ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Port:</span>
                    <span class="info-value">{{ $order->hostingAccount->ftp_port ?? '21' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Username:</span>
                    <span class="info-value">{{ $order->hostingAccount->ftp_username ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Password:</span>
                    <span class="info-value">{{ $order->hostingAccount->ftp_password ?? '-' }}</span>
                </div>
            </div>

            @if($order->hostingAccount->db_name)
            <h3>🗄️ Akses Database</h3>
            <div class="info-box">
                <div class="info-row">
                    <span class="info-label">DB Host:</span>
                    <span class="info-value">{{ $order->hostingAccount->db_host ?? 'localhost' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">DB Name:</span>
                    <span class="info-value">{{ $order->hostingAccount->db_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">DB Username:</span>
                    <span class="info-value">{{ $order->hostingAccount->db_username ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">DB Password:</span>
                    <span class="info-value">{{ $order->hostingAccount->db_password ?? '-' }}</span>
                </div>
            </div>
            @endif

            <div class="warning">
                ⚠️ <strong>Penting:</strong> Harap simpan informasi ini dengan aman dan jangan bagikan ke pihak yang tidak berwenang.
            </div>

            <p>Anda juga bisa melihat informasi ini kapan saja melalui halaman <strong>Layanan Saya</strong> di dashboard Kuukok.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Kuukok. Semua hak dilindungi.
        </div>
    </div>
</body>
</html>
