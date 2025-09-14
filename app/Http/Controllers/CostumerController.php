<?php

namespace App\Http\Controllers;

use App\Models\CostumerModel;
use App\Models\JadwalModel;
use App\Models\RuteModel;
use App\Models\ShipModel;
use App\Models\User;
use Illuminate\Http\Request;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rute = RuteModel::select('departure', 'destination')->distinct()->get();
        $ship = ShipModel::select('ship_name')->distinct()->get();
        $jadwal = JadwalModel::whereNotNull('departure_date')->whereNotNull('departure_time')->get();
        
        return view('costumers.dashboard', compact('rute', 'ship', 'jadwal'));
    }
    
    /**
     * Show the form for creating a new resource.
     */

    public function searchResults(Request $request)
    {
        $query = JadwalModel::query();

        if ($request->filled('departure') && $request->filled('destination')) {
            $query->whereHas('rute', function ($q) use ($request) {
                $q->where('departure', $request->departure)
                  ->where('destination', $request->destination);
            });
        }

        if ($request->filled('ship_name')) {
            $query->whereHas('ship', function ($q) use ($request) {
                $q->where('ship_name', $request->ship_name);
            });
        }

        if ($request->filled('departure_date')) {
            $query->whereDate('departure_date', $request->departure_date);
        }

        if ($request->filled('departure_time')) {
            $query->where('departure_time', $request->departure_time);
        } 

        $results = $query->with(['rute', 'ship'])->get();

        return view('costumers.search_results', compact('results'));
    }

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'nik' => 'required|string|max:16|unique:users,nik',
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
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa string.',
            'phone.max' => 'Nomor telepon maksimal 15 karakter.',
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

        CostumerModel::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'nik' => $request->nik,
            'age' => $request->age,
            'gender' => $request->gender,
        ]);

        return redirect()->back()->with('success', 'Data costumer berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
