<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CostumerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CostumerController::class, 'index'])->name('costomer');
Route::get('/ship_search', [CostumerController::class, 'searchResults'])->name('customer.ship_search');
Route::get('/booking/{id}', [BookingController::class, 'create'])->name('customer.booking');
Route::post('/booking/store', [BookingController::class, 'store'])->name('customers.booking.store');
Route::get('/booking/{token}/{code}', [BookingController::class, 'booking'])->name('customer.booking.view');

Route::post('/payments/callback', [PaymentController::class, 'callback'])->name('payments.callback');
Route::post('/payments/webhook', [PaymentController::class, 'webhook'])->name('payments.webhook');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/proses-login', [AuthController::class, 'prosesLogin'])->name('prosesLogin');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Admin profile/settings/logout used by header
    Route::get('/admin/profile', function () {
        // Placeholder view - create resources/views/admins/profile.blade.php if you want a full page
        return view('admins.profile');
    })->name('admin.profile');

    Route::get('/admin/settings', function () {
        return view('admins.settings');
    })->name('admin.settings');

    Route::post('/admin/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/create/user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit/user/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/delete/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/show/user/{id}', [UserController::class, 'show'])->name('user.show');
    
    Route::get('/ships', [ShipController::class, 'index'])->name('ships.index');
    Route::get('/create/ship', [ShipController::class, 'create'])->name('ships.create');
    Route::post('/store/ship', [ShipController::class, 'store'])->name('ships.store');
    Route::get('/edit/ship/{id}', [ShipController::class, 'edit'])->name('ships.edit');
    Route::put('/update/ship/{id}', [ShipController::class, 'update'])->name('ships.update');
    Route::delete('/delete/ship/{id}', [ShipController::class, 'destroy'])->name('ships.destroy');
    Route::get('/show/ship/{id}', [ShipController::class, 'show'])->name('ships.show');

    Route::get('/rutes', [RuteController::class, 'index'])->name('rutes.index');
    Route::get('/create/rute', [RuteController::class, 'create'])->name('rutes.create');
    Route::post('/store/rute', [RuteController::class, 'store'])->name('rutes.store');
    Route::get('/edit/rute/{id}', [RuteController::class, 'edit'])->name('rutes.edit');
    Route::put('/update/rute/{id}', [RuteController::class, 'update'])->name('rutes.update');
    Route::delete('/delete/rute/{id}', [RuteController::class, 'destroy'])->name('rutes.destroy');
    Route::get('/show/rute/{id}', [RuteController::class, 'show'])->name('rutes.show');

    Route::get('/jadwals', [JadwalController::class, 'index'])->name('jadwals.index');
    Route::get('/create/jadwal', [JadwalController::class, 'create'])->name('jadwals.create');
    Route::post('/store/jadwal', [JadwalController::class, 'store'])->name('jadwals.store');
    Route::get('/edit/jadwal/{id}', [JadwalController::class, 'edit'])->name('jadwals.edit');
    Route::put('/update/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwals.update');
    Route::delete('/delete/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwals.destroy');
    Route::get('/show/jadwal/{id}', [JadwalController::class, 'show'])->name('jadwals.show');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
    
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/edit/{id}', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/update/{id}', [BookingController::class, 'update'])->name('bookings.update');
});