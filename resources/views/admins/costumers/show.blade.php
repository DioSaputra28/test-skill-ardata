@extends('admins.layouts.main')

@section('title', 'Detail Customer - ' . $costumer->full_name)
@section('page', 'costumers')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Detail Customer
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('costumers.index') }}">Customer /</a>
                </li>
                <li class="font-medium text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <div class="space-y-5 sm:space-y-6">
        <!-- Customer Info Card -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Informasi Customer
                </h3>
                <div class="flex gap-2">
                    <a href="{{ route('costumers.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg border border-gray-300 bg-white shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Personal Info -->
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-5 dark:border-gray-800 dark:bg-gray-900/50">
                        <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">
                            <i class="fa-solid fa-user mr-2"></i>
                            Informasi Pribadi
                        </h4>
                        
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Nama Lengkap
                                </div>
                                <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                    {{ $costumer->full_name }}
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Jenis Kelamin
                                </div>
                                <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                    {{ $costumer->gender }}
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Usia
                                </div>
                                <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                    {{ $costumer->age }} tahun
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-5 dark:border-gray-800 dark:bg-gray-900/50">
                        <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">
                            <i class="fa-solid fa-address-book mr-2"></i>
                            Informasi Kontak
                        </h4>
                        
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Email
                                </div>
                                <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                    {{ $costumer->email }}
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Telepon
                                </div>
                                <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                    {{ $costumer->phone_number }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Identity Info -->
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-5 dark:border-gray-800 dark:bg-gray-900/50">
                        <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">
                            <i class="fa-solid fa-id-card mr-2"></i>
                            Identitas
                        </h4>
                        
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    NIK
                                </div>
                                <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                    {{ $costumer->nik }}
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Tanggal Bergabung
                                </div>
                                <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                    {{ $costumer->created_at->format('d F Y H:i') }}
                                </div>
                            </div>
                            
                            @if($costumer->deleted_at)
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Tanggal Dihapus
                                </div>
                                <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                    {{ $costumer->deleted_at->format('d F Y H:i') }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Stats Info -->
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-5 dark:border-gray-800 dark:bg-gray-900/50">
                        <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">
                            <i class="fa-solid fa-chart-line mr-2"></i>
                            Statistik
                        </h4>
                        
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Total Booking
                                </div>
                                    <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                        <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-medium dark:bg-blue-900 dark:text-blue-100">
                                            {{ isset($bookings) ? $bookings->count() : ($costumer->bookings_count ?? 0) }} booking
                                        </span>
                                    </div>
                            </div>
                            
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Status
                                </div>
                                <div class="w-2/3 text-sm text-gray-800 dark:text-white/90">
                                    @if($costumer->deleted_at)
                                        <span class="px-2 py-1 rounded-full bg-error-100 text-error-800 text-xs font-medium dark:bg-error-900 dark:text-error-100">
                                            Dihapus
                                        </span>
                                    @else
                                        <span class="px-2 py-1 rounded-full bg-success-100 text-success-800 text-xs font-medium dark:bg-success-900 dark:text-success-100">
                                            Aktif
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bookings History -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Riwayat Booking
                </h3>
            </div>
            
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                @if(isset($bookings) && $bookings->count() > 0)
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="max-w-full overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Kode Booking
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Rute
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Tanggal
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Kursi
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Total Harga
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Status
                                            </p>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @foreach($bookings as $booking)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div>
                                                <span class="block font-medium text-gray-800 text-sm dark:text-white/90">
                                                    {{ $booking->booking_code }}
                                                </span>
                                                <span class="block text-gray-500 text-xs dark:text-gray-400">
                                                    {{ $booking->booked_at->format('d M Y H:i') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex flex-col">
                                            <p class="text-gray-800 text-sm font-medium dark:text-white/90">
                                                {{ $booking->jadwal->rute->departure }} - {{ $booking->jadwal->rute->destination }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex flex-col">
                                            <p class="text-gray-500 text-xs dark:text-gray-400">
                                                {{ $booking->jadwal->departure_date->format('d M Y') }}
                                            </p>
                                            <p class="text-gray-500 text-xs dark:text-gray-400">
                                                {{ $booking->jadwal->departure_time }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-sm dark:text-gray-400">
                                                {{ $booking->seats_total }} kursi
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-800 text-sm font-medium dark:text-white/90">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center justify-center">
                                            @if($booking->status == 'Confirmed')
                                                <span class="rounded-full bg-success-50 px-3 py-1 text-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                                    Dikonfirmasi
                                                </span>
                                            @elseif($booking->status == 'Pending')
                                                <span class="rounded-full bg-warning-50 px-3 py-1 text-xs font-medium text-warning-600 dark:bg-warning-500/15 dark:text-warning-500">
                                                    Menunggu
                                                </span>
                                            @elseif($booking->status == 'Cancelled')
                                                <span class="rounded-full bg-error-50 px-3 py-1 text-xs font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                                                    Dibatalkan
                                                </span>
                                            @elseif($booking->status == 'Completed')
                                                <span class="rounded-full bg-info-50 px-3 py-1 text-xs font-medium text-info-600 dark:bg-info-500/15 dark:text-info-500">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="rounded-full bg-gray-50 px-3 py-1 text-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                                    {{ $booking->status }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="text-center py-8">
                    <i class="fa-solid fa-ticket text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                    <p class="text-gray-500 dark:text-gray-400">
                        Customer ini belum memiliki riwayat booking.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection