@extends('layouts.app')

@section('title', 'Buat Booking Baru')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Buat Booking Baru
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Silakan isi informasi berikut untuk membuat booking.
            </p>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-error-500 bg-error-50 p-4 dark:border-error-500/30 dark:bg-error-500/15">
                    <div class="flex items-start gap-3">
                        <div class="-mt-0.5 text-error-500">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.3499 12.0004C20.3499 16.612 16.6115 20.3504 11.9999 20.3504C7.38832 20.3504 3.6499 16.612 3.6499 12.0004C3.6499 7.38881 7.38833 3.65039 11.9999 3.65039C16.6115 3.65039 20.3499 7.38881 20.3499 12.0004ZM11.9999 22.1504C17.6056 22.1504 22.1499 17.6061 22.1499 12.0004C22.1499 6.3947 17.6056 1.85039 11.9999 1.85039C6.39421 1.85039 1.8499 6.3947 1.8499 12.0004C1.8499 17.6061 6.39421 22.1504 11.9999 22.1504ZM13.0008 16.4753C13.0008 15.923 12.5531 15.4753 12.0008 15.4753L11.9998 15.4753C11.4475 15.4753 10.9998 15.923 10.9998 16.4753C10.9998 17.0276 11.4475 17.4753 11.9998 17.4753L12.0008 17.4753C12.5531 17.4753 13.0008 17.0276 13.0008 16.4753ZM11.9998 6.62898C12.414 6.62898 12.7498 6.96476 12.7498 7.37898L12.7498 13.0555C12.7498 13.4697 12.414 13.8055 11.9998 13.8055C11.5856 13.8055 11.2498 13.4697 11.2498 13.0555L11.2498 7.37898C11.2498 6.96476 11.5856 6.62898 11.9998 6.62898Z" fill="#F04438" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                Terdapat kesalahan dalam pengisian form
                            </h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Mohon periksa kembali data yang Anda masukkan.
                            </p>
                            <ul class="mt-2 list-disc pl-5 space-y-1 text-sm text-error-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            
            <form action="{{ route('customers.booking.store') }}" method="POST" id="bookingForm">
                @csrf
                
                <!-- Informasi Jadwal -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Jadwal</h4>
                    <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->jadwal_id }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Keberangkatan</label>
                                <div class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    {{ $jadwal->departure_date->format('d F Y') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Keberangkatan</label>
                                <div class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    {{ $jadwal->departure_time }}
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Tiket</label>
                                <div class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    Rp {{ number_format($jadwal->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kuota Tersedia</label>
                                <div class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    {{ $jadwal->seats_kuota }} kursi
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Data Customer -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Data Customer</h4>
                    
                    <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input
                                    type="text"
                                    name="full_name"
                                    id="full_name"
                                    value="{{ old('full_name') }}"
                                    placeholder="Masukkan nama lengkap"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('full_name') border-error-500 @enderror"
                                    required />
                                @error('full_name')
                                    <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK <span class="text-red-500">*</span></label>
                                <input
                                    type="text"
                                    name="nik"
                                    id="nik"
                                    value="{{ old('nik') }}"
                                    placeholder="Masukkan NIK"
                                    maxlength="16"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('nik') border-error-500 @enderror"
                                    required />
                                @error('nik')
                                    <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    placeholder="Masukkan email"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('email') border-error-500 @enderror"
                                    required />
                                @error('email')
                                    <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                                <input
                                    type="text"
                                    name="phone_number"
                                    id="phone_number"
                                    value="{{ old('phone_number') }}"
                                    placeholder="Masukkan nomor telepon"
                                    maxlength="15"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('phone_number') border-error-500 @enderror"
                                    required />
                                @error('phone_number')
                                    <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Usia <span class="text-red-500">*</span></label>
                                <input
                                    type="number"
                                    name="age"
                                    id="age"
                                    value="{{ old('age') }}"
                                    placeholder="Masukkan usia"
                                    min="1"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('age') border-error-500 @enderror"
                                    required />
                                @error('age')
                                    <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex items-center">
                                        <input id="gender-male" name="gender" type="radio" value="Laki-laki" 
                                            class="focus:ring-brand-500 h-4 w-4 text-brand-600 border-gray-300" 
                                            {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}>
                                        <label for="gender-male" class="ml-3 block text-sm font-medium text-gray-700">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="gender-female" name="gender" type="radio" value="Perempuan" 
                                            class="focus:ring-brand-500 h-4 w-4 text-brand-600 border-gray-300" 
                                            {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                        <label for="gender-female" class="ml-3 block text-sm font-medium text-gray-700">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                @error('gender')
                                    <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Data Booking -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Data Booking</h4>
                    <div class="grid grid-cols-1 gap-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="seats_total" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Kursi <span class="text-red-500">*</span></label>
                                <input
                                    type="number"
                                    name="seats_total"
                                    id="seats_total"
                                    value="{{ old('seats_total', 1) }}"
                                    placeholder="Masukkan jumlah kursi"
                                    min="1"
                                    max="{{ $jadwal->seats_kuota }}"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('seats_total') border-error-500 @enderror"
                                    required />
                                @error('seats_total')
                                    <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Kuota tersedia: {{ $jadwal->seats_kuota }} kursi</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Total Harga</label>
                                <div class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    Rp <span id="total_price_display">0</span>
                                    <input type="hidden" name="total_price" id="total_price" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <a href="{{ route('costomer') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                        Batal
                    </a>
                    <button type="submit" 
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                        Simpan Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hitung total harga
        const pricePerSeat = {{ $jadwal->price }};
        const seatsTotalInput = document.getElementById('seats_total');
        const totalPriceDisplay = document.getElementById('total_price_display');
        const totalPriceInput = document.getElementById('total_price');
        
        function calculateTotalPrice() {
            const seats = parseInt(seatsTotalInput.value) || 0;
            const total = seats * pricePerSeat;
            totalPriceDisplay.textContent = total.toLocaleString('id-ID');
            totalPriceInput.value = total;
        }
        
        seatsTotalInput.addEventListener('input', calculateTotalPrice);
        calculateTotalPrice(); // Hitung saat halaman dimuat
    });
</script>
@endsection