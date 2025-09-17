<?php

namespace App\Mail;

use App\Models\BookingModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BookingConfirmed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(BookingModel $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        Log::info('Building BookingConfirmed email for booking code: ' . $this->booking->booking_code);
        return $this->subject('Konfirmasi Booking - ' . $this->booking->booking_code)
                    ->view('emails.booking_confirmed');
    }
}
