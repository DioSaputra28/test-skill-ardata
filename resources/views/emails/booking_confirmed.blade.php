<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking - TiketKapal</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <!-- Header -->
        <div style="background: #1a73e8; color: white; padding: 20px; text-align: center;">
            <h1 style="margin: 0; font-size: 24px;">TiketKapal</h1>
            <p style="margin: 5px 0 0; font-size: 16px;">Sistem Pemesanan Tiket Kapal</p>
        </div>

        <!-- Body -->
        <div style="padding: 30px;">
            <h2 style="color: #1a73e8; margin-top: 0;">Konfirmasi Booking</h2>
            
            <p>Halo <strong>{{ $booking->costumer->full_name ?? 'Pelanggan' }}</strong>,</p>

            <p>Terima kasih! Booking Anda telah berhasil dibuat.</p>

            <div style="background: #f8f9fa; border-left: 4px solid #1a73e8; padding: 15px; margin: 20px 0;">
                <h3 style="margin-top: 0; color: #1a73e8;">Detail Booking</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;"><strong>Kode Booking:</strong></td>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;">{{ $booking->booking_code }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;"><strong>Jumlah Kursi:</strong></td>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;">{{ $booking->seats_total }} kursi</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;"><strong>Total Harga:</strong></td>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0;"><strong>Tanggal Booking:</strong></td>
                        <td style="padding: 5px 0;">{{ $booking->booked_at->format('d F Y H:i') }}</td>
                    </tr>
                </table>
            </div>

            <p style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/booking/'.$booking->token.'/'.$booking->booking_code) }}" 
                   style="display: inline-block; padding: 12px 30px; background: #1a73e8; color: #ffffff; border-radius: 6px; text-decoration: none; font-weight: 600; box-shadow: 0 2px 4px rgba(26,115,232,0.3);">
                    Lihat Detail Pemesanan
                </a>
            </p>

            <p>Jika Anda memiliki pertanyaan, silakan balas email ini.</p>

            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                <p style="margin: 0;">Salam hangat,</p>
                <p style="margin: 5px 0 0; font-weight: bold;">Tim TiketKapal</p>
            </div>
        </div>

        <!-- Footer -->
        <div style="background: #f8f9fa; padding: 20px; text-align: center; font-size: 12px; color: #666;">
            <p style="margin: 0;">Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p style="margin: 5px 0 0;">&copy; {{ date('Y') }} TiketKapal. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</body>
</html>