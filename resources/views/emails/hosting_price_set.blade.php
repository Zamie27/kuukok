<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e5e7eb; border-radius: 8px; }
        .header { background-color: #6366f1; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 0.875rem; }
        .btn { display: inline-block; padding: 12px 24px; background-color: #6366f1; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 20px; }
        .price-box { background-color: #f3f4f6; padding: 15px; border-radius: 6px; margin: 20px 0; border: 1px dashed #d1d5db; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Kuukok Hosting</h1>
        </div>
        <div class="content">
            <h2>Halo, {{ $order->customer_name }}!</h2>
            <p>Admin kami telah meninjau pesanan hosting Anda untuk proyek <strong>{{ $order->project_name }}</strong>.</p>
            
            <div class="price-box">
                <p style="margin: 0; font-size: 0.875rem; color: #6b7280;">Total yang harus dibayar:</p>
                <p style="margin: 5px 0; font-size: 1.5rem; font-weight: bold; color: #111827;">Rp {{ number_format($order->price_total, 0, ',', '.') }}</p>
                
                @if($order->admin_notes)
                <p style="margin: 10px 0 0 0; font-size: 0.875rem; font-style: italic; color: #374151;">
                    <strong>Keterangan Admin:</strong> "{{ $order->admin_notes }}"
                </p>
                @endif
            </div>

            <p>Silakan lakukan pembayaran dan unggah bukti transfer melalui dashboard Anda untuk mulai mengaktifkan layanan.</p>
            
            <center>
                <a href="{{ route('user.hosting.payment', $order->id) }}" class="btn">Bayar Sekarang</a>
            </center>

            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 30px;">
                Jika Anda memiliki pertanyaan, silakan hubungi kami via WhatsApp.
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Kuukok. All rights reserved.
        </div>
    </div>
</body>
</html>
