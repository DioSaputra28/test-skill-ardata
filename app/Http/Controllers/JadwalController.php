<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use App\Models\RuteModel;
use App\Models\ShipModel;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = JadwalModel::with(['rute', 'ship'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admins.jadwals.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ships = ShipModel::all();
        $rutes = RuteModel::all();
        return view('admins.jadwals.create', compact('ships', 'rutes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rute_id' => 'required|exists:rutes,rute_id',
            'ship_id' => 'required|exists:ships,ship_id',
            'departure_date' => 'required|date|after:today',
            'departure_time' => 'required',
            'status' => 'required|string|in:scheduled,departed,arrived,cancelled',
            'price' => 'required|numeric|min:0',
            'seats_kuota' => 'required|integer|min:1',
        ], [
            'rute_id.required' => 'Rute wajib diisi.',
            'rute_id.exists' => 'Rute tidak valid.',
            'ship_id.required' => 'Kapal wajib diisi.',
            'ship_id.exists' => 'Kapal tidak valid.',
            'departure_date.required' => 'Tanggal keberangkatan wajib diisi.',
            'departure_date.date' => 'Tanggal keberangkatan tidak valid.',
            'departure_date.after' => 'Tanggal keberangkatan harus setelah hari ini.',
            'departure_time.required' => 'Waktu keberangkatan wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'status.string' => 'Status harus berupa string.',
            'status.in' => 'Status tidak valid.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal 0.',
            'seats_kuota.required' => 'Kapasitas kursi wajib diisi.',
            'seats_kuota.integer' => 'Kapasitas kursi harus berupa angka.',
            'seats_kuota.min' => 'Kapasitas kursi minimal 1.',
        ]);

        JadwalModel::create([
            'rute_id' => $request->rute_id,
            'ship_id' => $request->ship_id,
            'departure_date' => $request->departure_date,
            'departure_time' => $request->departure_time,
            'status' => $request->status,
            'price' => $request->price,
            'seats_kuota' => $request->seats_kuota,
        ]);

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal = JadwalModel::with(['rute', 'ship'])->findOrFail($id);
        
        if (!$jadwal) {
            return redirect()->route('jadwals.index')->with('error', 'Jadwal tidak ditemukan.');
        }

        return view('admins.jadwals.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal = JadwalModel::findOrFail($id);
        $ships = ShipModel::all();
        $rutes = RuteModel::all();

        if (!$jadwal) {
            return redirect()->route('jadwals.index')->with('error', 'Jadwal tidak ditemukan.');
        }

        return view('admins.jadwals.edit', compact('jadwal', 'ships', 'rutes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwal = JadwalModel::findOrFail($id);

        if (!$jadwal) {
            return redirect()->route('jadwals.index')->with('error', 'Jadwal tidak ditemukan.');
        }

        $request->validate([
            'rute_id' => 'required|exists:rutes,rute_id',
            'ship_id' => 'required|exists:ships,ship_id',
            'departure_date' => 'required|date|after:today',
            'departure_time' => 'required',
            'status' => 'required|string|in:scheduled,departed,arrived,cancelled',
            'price' => 'required|numeric|min:0',
            'seats_kuota' => 'required|integer|min:1',
        ], [
            'rute_id.required' => 'Rute wajib diisi.',
            'rute_id.exists' => 'Rute tidak valid.',
            'ship_id.required' => 'Kapal wajib diisi.',
            'ship_id.exists' => 'Kapal tidak valid.',
            'departure_date.required' => 'Tanggal keberangkatan wajib diisi.',
            'departure_date.date' => 'Tanggal keberangkatan tidak valid.',
            'departure_date.after' => 'Tanggal keberangkatan harus setelah hari ini.',
            'departure_time.required' => 'Waktu keberangkatan wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'status.string' => 'Status harus berupa string.',
            'status.in' => 'Status tidak valid.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal 0.',
            'seats_kuota.required' => 'Kapasitas kursi wajib diisi.',
            'seats_kuota.integer' => 'Kapasitas kursi harus berupa angka.',
            'seats_kuota.min' => 'Kapasitas kursi minimal 1.',
        ]);

        $jadwal->update([
            'rute_id' => $request->rute_id,
            'ship_id' => $request->ship_id,
            'departure_date' => $request->departure_date,
            'departure_time' => $request->departure_time,
            'status' => $request->status,
            'price' => $request->price,
            'seats_kuota' => $request->seats_kuota,
        ]);

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalModel::findOrFail($id);

        if (!$jadwal) {
            return redirect()->route('jadwals.index')->with('error', 'Jadwal tidak ditemukan.');
        }

        $jadwal->delete();

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
