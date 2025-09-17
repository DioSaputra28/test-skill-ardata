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
    public function index()
    {
        $costumer = CostumerModel::orderBy('created_at', 'desc')->paginate(10);

        return view('admins.costumers.index', compact('costumer'));
    }

    public function dashboard()
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


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $costumer = CostumerModel::with(['bookings' => function ($q) {
            $q->with(['jadwal.rute', 'jadwal.ship'])->orderBy('booked_at', 'desc');
        }])->find($id);

        if (!$costumer) {
            return redirect()->route('costumers.index')->with('error', 'Customer tidak ditemukan.');
        }

        $bookings = $costumer->bookings;

        return view('admins.costumers.show', compact('costumer', 'bookings'));
    }
}
