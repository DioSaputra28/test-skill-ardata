<?php

namespace App\Http\Controllers;

use App\Models\RuteModel;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rutes = RuteModel::orderBy('created_at', 'desc')->paginate(10);
        return view('admins.rutes.index', compact('rutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.rutes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'distance' => 'required|integer|min:1',
        ], [
            'departure.required' => 'Lokasi keberangkatan wajib diisi.',
            'departure.string' => 'Lokasi keberangkatan harus berupa string.',
            'departure.max' => 'Lokasi keberangkatan maksimal 255 karakter.',
            'destination.required' => 'Lokasi tujuan wajib diisi.',
            'destination.string' => 'Lokasi tujuan harus berupa string.',
            'destination.max' => 'Lokasi tujuan maksimal 255 karakter.',
            'distance.required' => 'Jarak wajib diisi.',
            'distance.integer' => 'Jarak harus berupa angka.',
            'distance.min' => 'Jarak minimal 1.',
        ]);

        RuteModel::create([
            'departure' => $request->departure,
            'destination' => $request->destination,
            'distance' => $request->distance,
        ]);

        return redirect()->route('rutes.index')->with('success', 'Rute berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rute = RuteModel::findOrFail($id);

        if (!$rute) {
            return redirect()->route('rutes.index')->with('error', 'Rute tidak ditemukan.');
        }

        return view('admins.rutes.show', compact('rute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rute = RuteModel::findOrFail($id);

        if (!$rute) {
            return redirect()->route('rutes.index')->with('error', 'Rute tidak ditemukan.');
        }

        return view('admins.rutes.edit', compact('rute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rute = RuteModel::findOrFail($id);

        if (!$rute) {
            return redirect()->route('rutes.index')->with('error', 'Rute tidak ditemukan.');
        }

        $request->validate([
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'distance' => 'required|integer|min:1',
        ], [
            'departure.required' => 'Lokasi keberangkatan wajib diisi.',
            'departure.string' => 'Lokasi keberangkatan harus berupa string.',
            'departure.max' => 'Lokasi keberangkatan maksimal 255 karakter.',
            'destination.required' => 'Lokasi tujuan wajib diisi.',
            'destination.string' => 'Lokasi tujuan harus berupa string.',
            'destination.max' => 'Lokasi tujuan maksimal 255 karakter.',
            'distance.required' => 'Jarak wajib diisi.',
            'distance.integer' => 'Jarak harus berupa angka.',
            'distance.min' => 'Jarak minimal 1.',
        ]);

        $rute->update([
            'departure' => $request->departure,
            'destination' => $request->destination,
            'distance' => $request->distance,
        ]);

        return redirect()->route('rutes.index')->with('success', 'Rute berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rute = RuteModel::findOrFail($id);

        if (!$rute) {
            return redirect()->route('rutes.index')->with('error', 'Rute tidak ditemukan.');
        }

        $rute->delete();

        return redirect()->route('rutes.index')->with('success', 'Rute berhasil dihapus.');
    }
}
