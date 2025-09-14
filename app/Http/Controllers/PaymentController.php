<?php

namespace App\Http\Controllers;

use App\Models\PaymentModel;
use App\Models\BookingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentStatusUpdated;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = PaymentModel::orderBy('created_at', 'desc')->paginate(10);
        return view('admins.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = PaymentModel::with('booking.costumer')->findOrFail($id);

        if (!$payment) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan.');
        }

        return view('admins.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    /**
     * Handle Xendit webhook notification
     */
    public function webhook(Request $request)
    {
        try {
            Log::info('Xendit webhook received', ['data' => $request->all()]);
            
            $data = $request->all();
            
            $payment = PaymentModel::where('external_id', $data['external_id'])->first();
            
            if (!$payment) {
                Log::warning('Payment not found for external_id: ' . $data['external_id']);
                return response()->json(['message' => 'Payment not found'], 404);
            }

            $payment->update([
                'payment_status' => $data['status'],
                'payment_method' => $data['payment_method'] ?? $payment->payment_method,
            ]);
        
            if ($data['status'] === 'PAID') {
                $booking = $payment->booking;
                if ($booking) {
                    $booking->update([
                        'status' => 'Confirmed'
                    ]);
                }

                try {
                    $recipient = $payment->booking->costumer->email ?? null;
                    if ($recipient) {
                        Mail::to($recipient)->queue(new PaymentStatusUpdated($payment));
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to queue payment PAID email: ' . $e->getMessage());
                }
            } elseif ($data['status'] === 'EXPIRED' || $data['status'] === 'FAILED') {

                $booking = $payment->booking;
                if ($booking) {
                    $booking->update([
                        'status' => 'Cancelled'
                    ]);
                }
                try {
                    $recipient = $payment->booking->costumer->email ?? null;
                    if ($recipient) {
                        Mail::to($recipient)->queue(new PaymentStatusUpdated($payment));
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to queue payment FAILED email: ' . $e->getMessage());
                }
            }
            
            Log::info('Payment webhook processed successfully', [
                'payment_id' => $payment->payment_id,
                'external_id' => $data['external_id'],
                'status' => $data['status']
            ]);
            
            return response()->json(['message' => 'Webhook processed successfully'], 200);
            
        } catch (\Exception $e) {
            Log::error('Error processing Xendit webhook: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json(['message' => 'Error processing webhook'], 500);
        }
    }
}
