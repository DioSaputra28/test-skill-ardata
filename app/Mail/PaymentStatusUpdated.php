<?php

namespace App\Mail;

use App\Models\PaymentModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentStatusUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $payment;
    public $booking;

    public function __construct(PaymentModel $payment)
    {
        $this->payment = $payment;
        $this->booking = $payment->booking;
    }

    public function build()
    {
        // Menentukan subjek email berdasarkan status pembayaran
        $statusLabels = [
            'PAID' => 'Pembayaran Berhasil',
            'PENDING' => 'Menunggu Pembayaran',
            'EXPIRED' => 'Pembayaran Kadaluarsa',
            'FAILED' => 'Pembayaran Gagal'
        ];
        
        $statusLabel = $statusLabels[$this->payment->payment_status] ?? 'Status Pembayaran';
        $subject = $statusLabel . ' - ' . $this->payment->booking->booking_code;
        
        return $this->subject($subject)
                    ->view('emails.payment_status_updated');
    }
}
