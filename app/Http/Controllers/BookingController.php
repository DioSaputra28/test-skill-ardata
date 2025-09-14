<?php

namespace App\Http\Controllers;

use App\Models\BookingModel;
use App\Models\CostumerModel;
use App\Models\JadwalModel;
use App\Mail\BookingConfirmed;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $date = $request->input('date');

        $bookings = BookingModel::when($search, function ($query, $search) {
            $query->whereHas('costumer', function ($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone_number', 'like', '%' . $search . '%');
            })->orWhereHas('jadwal.rute', function ($q) use ($search) {
                $q->where('departure', 'like', '%' . $search . '%')
                    ->orWhere('destination', 'like', '%' . $search . '%');
            })->orWhereHas('jadwal.ship', function ($q) use ($search) {
                $q->where('ship_name', 'like', '%' . $search . '%');
            })->orWhere('booking_code', 'like', '%' . $search . '%');
        })
            ->when($date, function ($query, $date) {
                $query->whereDate('booked_at', $date);
            })
            ->with(['costumer', 'jadwal'])
            ->orderBy('booked_at', 'desc')
            ->paginate(10)
            ->appends($request->only('search', 'date'));

        return view('admins.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $jadwal = JadwalModel::findOrFail($id);

        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        return view('costumers.bookings.create', compact('jadwal'));
    }

    private function costumerStore(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:costumers,email',
            'phone_number' => 'required|string|max:15',
            'nik' => 'required|string|max:16|unique:costumers,nik',
            'age' => 'required|integer|min:1',
            'gender' => 'required|string|in:Laki-laki,Perempuan'
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.string' => 'Nama lengkap harus berupa string.',
            'full_name.max' => 'Nama lengkap maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.string' => 'Nomor telepon harus berupa string.',
            'phone_number.max' => 'Nomor telepon maksimal 15 karakter.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa string.',
            'nik.max' => 'NIK maksimal 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'age.required' => 'Usia wajib diisi.',
            'age.integer' => 'Usia harus berupa angka.',
            'age.min' => 'Usia minimal 1 tahun.',
            'gender.required' => 'Jenis kelamin wajib diisi.',
            'gender.string' => 'Jenis kelamin harus berupa string.',
            'gender.in' => 'Jenis kelamin tidak valid. Pilih Laki-laki atau Perempuan.'
        ]);

        return CostumerModel::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'nik' => $request->nik,
            'age' => $request->age,
            'gender' => $request->gender,
        ]);
    }

    private function payment($params)
    {
        $payload = [
            'external_id' => $params['external_id'],
            'amount' => $params['amount'],
            'description' => $params['description'] ?? 'Booking Payment',
            'customer' => [
                'given_names' => $params['given_names'] ?? null,
                'surname' => $params['surname'] ?? null,
                'email' => $params['email'] ?? null,
                'mobile' => $params['mobile'] ?? null,
            ],
        ];

        $base = env('XENDIT_BASE_URL');
        $key = env('XENDIT_API_KEY');

        try {
            $headers = [
                'Authorization' => 'Basic ' . base64_encode($key . ':'),
                'Content-Type' => 'application/json',
            ];

            $httpClient = Http::withHeaders($headers)->withOptions([
                'verify' => false
            ]);

            $response = $httpClient->post(rtrim($base, '/') . '/v2/invoices', $payload);

            if ($response->successful()) {
                $data = $response->json();

                $payment = PaymentModel::create([
                    'booking_id' => $params['booking_id'],
                    'external_id' => $data['external_id'] ?? $params['external_id'],
                    'payment_method' => 'xendit',
                    'payment_status' => $data['status'] ?? 'PENDING',
                    'amount' => $data['amount'] ?? $params['amount'],
                    'payment_url' => $data['invoice_url'] ?? null,
                ]);

                return [
                    'success' => true,
                    'payment' => $payment,
                    'xendit' => $data,
                ];
            }

            Log::error('Xendit create invoice failed: ' . $response->body());
            return ['success' => false, 'error' => $response->body()];
        } catch (\Exception $e) {
            Log::error('Xendit exception: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'costumer_id' => 'nullable|exists:costumers,costumer_id',
            'jadwal_id' => 'required|exists:jadwals,jadwal_id',
            'seats_total' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0'
        ], [
            'costumer_id.exists' => 'Costumer ID tidak valid.',
            'jadwal_id.required' => 'Jadwal ID wajib diisi.',
            'jadwal_id.exists' => 'Jadwal ID tidak valid.',
            'seats_total.required' => 'Total kursi wajib diisi.',
            'seats_total.integer' => 'Total kursi harus berupa angka.',
            'seats_total.min' => 'Total kursi minimal 1.',
            'total_price.required' => 'Total harga wajib diisi.',
            'total_price.numeric' => 'Total harga harus berupa angka.',
            'total_price.min' => 'Total harga minimal 0.'
        ]);

        $costumer = CostumerModel::where('nik', $request->nik)->first();

        if (!$costumer) {
            $costumer = $this->costumerStore($request);
        }


        $booking_code = 'BKG-' . strtoupper(uniqid());

        $token = strtoupper(uniqid());

        $booking = BookingModel::create([
            'costumer_id' => $costumer->costumer_id,
            'jadwal_id' => $request->jadwal_id,
            'seats_total' => $request->seats_total,
            'total_price' => $request->total_price,
            'booking_code' => $booking_code,
            'token' => $token,
            'status' => 'Pending',
            'booked_at' => now()
        ]);

        $payParams = [
            'booking_id' => $booking->booking_id,
            'external_id' => $booking->booking_code,
            'amount' => $booking->total_price,
            'description' => 'Pembayaran booking ' . $booking->booking_code,
            'given_names' => $costumer->full_name,
            'surname' => $costumer->full_name,
            'email' => $costumer->email,
            'mobile' => $costumer->phone_number,
        ];

        $paymentResult = $this->payment($payParams);

        if ($paymentResult['success']) {
            $invoiceUrl = $paymentResult['xendit']['invoice_url'] ?? '#';

            try {
                $recipient = $costumer->email ?? null;
                if ($recipient) {
                    Mail::to($recipient)->queue(new BookingConfirmed($booking));
                }
            } catch (\Exception $e) {
                Log::error('Failed to queue booking confirmation email: ' . $e->getMessage());
            }

            return redirect($invoiceUrl);
        } else {
            $booking->delete();

            Log::error('Payment creation failed: ' . ($paymentResult['error'] ?? 'Unknown error'));
            return redirect()->back()->with('error', 'Gagal membuat pembayaran. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = BookingModel::with(['costumer', 'jadwal.rute', 'jadwal.ship', 'payments'])->findOrFail($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }

        return view('admins.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = BookingModel::with(['costumer', 'jadwal.rute', 'jadwal.ship', 'payments'])->findOrFail($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }
        return view('admins.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = BookingModel::with(['costumer', 'jadwal.rute', 'jadwal.ship', 'payments'])->findOrFail($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }
        $validateData = $request->validate([
            'status' => 'required|in:Pending,Confirmed,Cancelled,Completed',
        ], [
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status tidak valid. Pilih Pending, Confirmed, Cancelled, atau Completed.',
        ]);
        $booking->update($validateData);
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function booking(string $token, string $code)
    {
        $booking = BookingModel::with(['costumer', 'jadwal'])->where('token', $token)->where('booking_code', $code)->first();

        if (!$booking) {
            return response()->view('costumers.bookings.404', [], 404);
        }

        return view('costumers.bookings.show', compact('booking'));
    }
}
