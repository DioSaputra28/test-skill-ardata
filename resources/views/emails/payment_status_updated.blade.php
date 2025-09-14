<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pembayaran - TiketKapal</title>
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
            <h2 style="color: #1a73e8; margin-top: 0;">Status Pembayaran</h2>
            
            <p>Halo <strong>{{ $payment->booking->costumer->full_name ?? 'Pelanggan' }}</strong>,</p>

            <p>Status pembayaran untuk booking <strong>{{ $payment->booking->booking_code }}</strong> telah berubah.</p>

            @php
                $statusColors = [
                    'PAID' => '#28a745',
                    'PENDING' => '#ffc107',
                    'EXPIRED' => '#dc3545',
                    'FAILED' => '#dc3545'
                ];
                $statusLabels = [
                    'PAID' => 'LUNAS',
                    'PENDING' => 'MENUNGGU PEMBAYARAN',
                    'EXPIRED' => 'KADALUARSA',
                    'FAILED' => 'GAGAL'
                ];
                $statusColor = $statusColors[$payment->payment_status] ?? '#6c757d';
                $statusLabel = $statusLabels[$payment->payment_status] ?? $payment->payment_status;
            @endphp

            <div style="background: #f8f9fa; border-left: 4px solid {{ $statusColor }}; padding: 15px; margin: 20px 0;">
                <h3 style="margin-top: 0; color: {{ $statusColor }};">Detail Pembayaran</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;"><strong>ID Pembayaran:</strong></td>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;">{{ $payment->external_id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;"><strong>Jumlah:</strong></td>
                        <td style="padding: 5px 0; border-bottom: 1px solid #eee;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0;"><strong>Status:</strong></td>
                        <td style="padding: 5px 0;">
                            <span style="display: inline-block; padding: 4px 10px; background: {{ $statusColor }}; color: white; border-radius: 4px; font-size: 12px; font-weight: bold;">
                                {{ $statusLabel }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            @if($payment->payment_status === 'PAID')
                <div style="background: #d4edda; border-left: 4px solid #28a745; padding: 15px; margin: 20px 0;">
                    <h3 style="margin-top: 0; color: #28a745;">Pembayaran Berhasil!</h3>
                    <p>Pembayaran Anda telah berhasil diproses. Booking Anda sekarang dalam status <strong>Confirmed</strong>.</p>
                </div>
            @elseif($payment->payment_status === 'PENDING')
                <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
                    <h3 style="margin-top: 0; color: #856404;">Menunggu Pembayaran</h3>
                    <p>Silakan selesaikan pembayaran Anda sesuai dengan instruksi yang telah diberikan.</p>
                </div>
            @elseif($payment->payment_status === 'EXPIRED')
                <div style="background: #f8d7da; border-left: 4px solid #dc3545; padding: 15px; margin: 20px 0;">
                    <h3 style="margin-top: 0; color: #721c24;">Pembayaran Kadaluarsa</h3>
                    <p>Masa waktu pembayaran telah habis. Jika Anda masih ingin melanjutkan, silakan buat booking baru.</p>
                </div>
            @elseif($payment->payment_status === 'FAILED')
                <div style="background: #f8d7da; border-left: 4px solid #dc3545; padding: 15px; margin: 20px 0;">
                    <h3 style="margin-top: 0; color: #721c24;">Pembayaran Gagal</h3>
                    <p>Pembayaran Anda gagal diproses. Silakan coba kembali atau gunakan metode pembayaran lain.</p>
                </div>
            @endif

            <p style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/booking/'.$payment->booking->token.'/'.$payment->booking->booking_code) }}" 
                   style="display: inline-block; padding: 12px 30px; background: #1a73e8; color: #ffffff; border-radius: 6px; text-decoration: none; font-weight: 600; box-shadow: 0 2px 4px rgba(26,115,232,0.3);">
                    Lihat Detail Pesanan
                </a>
            </p>

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