@extends('admins.layouts.main')

@section('title', 'Edit Booking - ' . $booking->booking_code)

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Edit Booking
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('bookings.index') }}">Booking /</a>
                </li>
                <li class="font-medium text-primary">Edit</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->
    
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Edit Booking
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Update status booking
                    </p>
                </div>
                <div>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($booking->status == 'Pending') bg-yellow-100 text-yellow-800
                        @elseif($booking->status == 'Confirmed') bg-green-100 text-green-800
                        @elseif($booking->status == 'Cancelled') bg-red-100 text-red-800
                        @elseif($booking->status == 'Completed') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ $booking->status }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Terdapat {{ $errors->count() }} kesalahan dalam pengisian form:
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <form action="{{ route('bookings.update', $booking->booking_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Informasi Booking -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Booking</h4>
                    <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">ID Booking</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->booking_id }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Kode Booking</label>
                                <div class="mt-1 text-sm text-gray-900 font-medium">
                                    {{ $booking->booking_code }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tanggal Booking</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->booked_at->format('d F Y H:i') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Token</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->token }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Jumlah Kursi</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->seats_total }} kursi
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Total Harga</label>
                                <div class="mt-1 text-sm text-gray-900 font-medium">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Informasi Customer -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Customer</h4>
                    <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->costumer->full_name }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">NIK</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->costumer->nik }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->costumer->email }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nomor Telepon</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->costumer->phone_number }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Usia</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->costumer->age }} tahun
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->costumer->gender }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Informasi Jadwal -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Jadwal</h4>
                    <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tanggal Keberangkatan</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->jadwal->departure_date->format('d F Y') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Waktu Keberangkatan</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->jadwal->departure_time }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Rute</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->jadwal->rute->departure }} - {{ $booking->jadwal->rute->destination }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Kapal</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->jadwal->ship->ship_name }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Harga per Tiket</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    Rp {{ number_format($booking->jadwal->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Kuota Tersedia</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $booking->jadwal->seats_kuota }} kursi
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Edit Status -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Update Status</h4>
                    <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                            <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm rounded-md">
                                <option value="Pending" {{ old('status', $booking->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Confirmed" {{ old('status', $booking->status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="Cancelled" {{ old('status', $booking->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="Completed" {{ old('status', $booking->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('bookings.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                        Batal
                    </a>
                    <button type="submit" 
                       class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection