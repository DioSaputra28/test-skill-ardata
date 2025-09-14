<?php

namespace App\Http\Controllers;

use App\Models\BookingModel;
use App\Models\CostumerModel;
use App\Models\PaymentModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookingsCount = BookingModel::count();
        $customersCount = CostumerModel::count();
        $revenue = PaymentModel::where('payment_status', 'PAID')->sum('amount');
        $usersCount = User::count(); 

        return view('admins.dashboard', compact('bookingsCount', 'customersCount', 'revenue', 'usersCount'));
    }
}
