@extends('admins.layouts.main')

@section('title', 'Detail Pembayaran - ' . $payment->external_id)

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Detail Pembayaran
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.payments.index') }}">Pembayaran /</a>
                </li>
                <li class="font-medium text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->
    
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Detail Pembayaran
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Informasi lengkap tentang pembayaran
                    </p>
                </div>
                <div>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($payment->payment_status == 'PENDING') bg-yellow-100 text-yellow-800
                        @elseif($payment->payment_status == 'PAID') bg-green-100 text-green-800
                        @elseif($payment->payment_status == 'EXPIRED') bg-red-100 text-red-800
                        @elseif($payment->payment_status == 'FAILED') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ $payment->payment_status }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            <!-- Informasi Pembayaran -->
            <div class="mb-8">
                <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Pembayaran</h4>
                <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">ID Pembayaran</label>
                            <div class="mt-1 text-sm text-gray-900">
                                {{ $payment->payment_id }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">External ID</label>
                            <div class="mt-1 text-sm text-gray-900 font-medium">
                                {{ $payment->external_id }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Metode Pembayaran</label>
                            <div class="mt-1 text-sm text-gray-900">
                                {{ strtoupper($payment->payment_method ?? 'N/A') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jumlah</label>
                            <div class="mt-1 text-sm text-gray-900 font-medium">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    
                    @if($payment->paid_amount)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jumlah Dibayar</label>
                            <div class="mt-1 text-sm text-gray-900">
                                Rp {{ number_format($payment->paid_amount, 0, ',', '.') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Pembayaran</label>
                            <div class="mt-1 text-sm text-gray-900">
                                {{ $payment->paid_at ? $payment->paid_at->format('d F Y H:i') : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($payment->payment_reference)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Referensi Pembayaran</label>
                            <div class="mt-1 text-sm text-gray-900">
                                {{ $payment->payment_reference }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Informasi Booking Terkait -->
            <div class="mb-8">
                <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Booking Terkait</h4>
                @if($payment->booking)
                <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Kode Booking</label>
                            <div class="mt-1 text-sm text-gray-900">
                                <a href="{{ route('bookings.show', $payment->booking->booking_id) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $payment->booking->booking_code }}
                                </a>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status Booking</label>
                            <div class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($payment->booking->status == 'Pending') bg-yellow-100 text-yellow-800
                                    @elseif($payment->booking->status == 'Confirmed') bg-green-100 text-green-800
                                    @elseif($payment->booking->status == 'Cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $payment->booking->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jumlah Kursi</label>
                            <div class="mt-1 text-sm text-gray-900">
                                {{ $payment->booking->seats_total }} kursi
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Total Harga</label>
                            <div class="mt-1 text-sm text-gray-900 font-medium">
                                Rp {{ number_format($payment->booking->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Informasi Customer -->
                <div class="mt-6">
                    <h5 class="text-sm font-medium text-gray-900 mb-3">Informasi Customer</h5>
                    <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nama</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $payment->booking->costumer->full_name }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $payment->booking->costumer->email }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">NIK</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $payment->booking->costumer->nik }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Telepon</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $payment->booking->costumer->phone_number }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Tidak ada informasi booking terkait untuk pembayaran ini.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('payments.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                    Kembali
                </a>
                
                @if($payment->payment_url)
                <a href="{{ $payment->payment_url }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                    Lihat Invoice
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection