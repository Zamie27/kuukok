<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e5e7eb; border-radius: 8px; }
        .header { background-color: #10b981; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 0.875rem; }
        .status-badge { display: inline-block; padding: 6px 12px; background-color: #ecfdf5; color: #059669; border-radius: 9999px; font-weight: bold; font-size: 0.875rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pembayaran Diterima</h1>
        </div>
        <div class="content">
            <h2>Hore, {{ $order->customer_name }}!</h2>
            <p>Bukti pembayaran Anda untuk proyek <strong>{{ $order->project_name }}</strong> telah kami terima dan diverifikasi.</p>
            
            <p><span class="status-badge">Pembayaran Berhasil</span></p>

            <p>Admin kami sedang menyiapkan detail akun hosting Anda (FTP & Database). Anda akan menerima email berikutnya segera setelah detail tersebut siap.</p>
            
            <p>Terima kasih telah mempercayakan layanan hosting Anda kepada Kuukok!</p>

            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 30px;">
                Jika dalam 1x24 jam Anda belum menerima detail akun, silakan hubungi kami via WhatsApp.
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Kuukok. All rights reserved.
        </div>
    </div>
</body>
</html>
