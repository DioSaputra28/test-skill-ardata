<?php

namespace App\Http\Controllers;

use App\Models\ShipModel;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ships = ShipModel::orderBy('created_at', 'desc')->paginate(10);
        return view('admins.ships.index', compact('ships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.ships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ship_name' => 'required|string|max:255',
            'ship_type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ], [
            'ship_name.required' => 'Nama kapal wajib diisi.',
            'ship_name.string' => 'Nama kapal harus berupa string.',
            'ship_name.max' => 'Nama kapal maksimal 255 karakter.',
            'ship_type.required' => 'Tipe kapal wajib diisi.',
            'ship_type.string' => 'Tipe kapal harus berupa string.',
            'ship_type.max' => 'Tipe kapal maksimal 255 karakter.',
            'capacity.required' => 'Kapasitas kapal wajib diisi.',
            'capacity.integer' => 'Kapasitas kapal harus berupa angka.',
            'capacity.min' => 'Kapasitas kapal minimal 1.',
        ]);

        ShipModel::create([
            'ship_name' => $request->ship_name,
            'ship_type' => $request->ship_type,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('ships.index')->with('success', 'Kapal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ship = ShipModel::findOrFail($id);
        return view('admins.ships.show', compact('ship'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ship = ShipModel::findOrFail($id);
        return view('admins.ships.edit', compact('ship'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ship = ShipModel::findOrFail($id);

        $request->validate([
            'ship_name' => 'required|string|max:255',
            'ship_type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ], [
            'ship_name.required' => 'Nama kapal wajib diisi.',
            'ship_name.string' => 'Nama kapal harus berupa string.',
            'ship_name.max' => 'Nama kapal maksimal 255 karakter.',
            'ship_type.required' => 'Tipe kapal wajib diisi.',
            'ship_type.string' => 'Tipe kapal harus berupa string.',
            'ship_type.max' => 'Tipe kapal maksimal 255 karakter.',
            'capacity.required' => 'Kapasitas kapal wajib diisi.',
            'capacity.integer' => 'Kapasitas kapal harus berupa angka.',
            'capacity.min' => 'Kapasitas kapal minimal 1.',
        ]);

        $ship->update([
            'ship_name' => $request->ship_name,
            'ship_type' => $request->ship_type,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('ships.index')->with('success', 'Kapal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ship = ShipModel::findOrFail($id);
        $ship->delete();

        return redirect()->route('ships.index')->with('success', 'Kapal berhasil dihapus.');
    }
}
