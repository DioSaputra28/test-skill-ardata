@extends('admins.layouts.main')

@section('title', 'Tambah Jadwal - Admin Dashboard')
@section('page', 'jadwals')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Tambah Jadwal Keberangkatan
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('jadwals.index') }}">Jadwal /</a>
                </li>
                <li class="font-medium text-primary">Tambah</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- Alert for Errors -->
    @if ($errors->any())
    <div class="mb-6 rounded-lg border-l-4 border-error-500 bg-error-50 p-4 dark:bg-error-500/10">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <i class="fa-solid fa-circle-exclamation text-xl text-error-500"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-medium text-error-800 dark:text-error-400">Ada kesalahan dalam formulir:</h3>
                <ul class="mt-2 list-disc list-inside text-sm text-error-600 dark:text-error-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('jadwals.store') }}" method="POST">
        @csrf

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Informasi Jadwal
                </h3>

                <button type="submit" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Simpan Jadwal
                </button>
            </div>

            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

                <!-- Route Selection -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Pilih Rute <span class="text-error-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-route text-gray-400"></i>
                        </div>
                        <select name="rute_id" id="rute_id" 
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-10 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 appearance-none cursor-pointer @error('rute_id') border-error-500 @enderror" 
                                required>
                            <option value="">-- Pilih Rute --</option>
                            @foreach($rutes as $rute)
                                <option value="{{ $rute->rute_id }}" {{ old('rute_id') == $rute->rute_id ? 'selected' : '' }}>
                                    {{ $rute->departure }} - {{ $rute->destination }} ({{ $rute->distance }} km)
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                    @error('rute_id')
                        <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ship Selection -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Pilih Kapal <span class="text-error-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-ship text-gray-400"></i>
                        </div>
                        <select name="ship_id" id="ship_id" 
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-10 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 appearance-none cursor-pointer @error('ship_id') border-error-500 @enderror" 
                                required>
                            <option value="">-- Pilih Kapal --</option>
                            @foreach($ships as $ship)
                                <option value="{{ $ship->ship_id }}" data-capacity="{{ $ship->capacity }}" {{ old('ship_id') == $ship->ship_id ? 'selected' : '' }}>
                                    {{ $ship->ship_name }} - {{ $ship->ship_type }} (Kapasitas: {{ $ship->capacity }} penumpang)
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                    @error('ship_id')
                        <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date and Time -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Departure Date -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Tanggal Keberangkatan <span class="text-error-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-calendar text-gray-400"></i>
                            </div>
                            <input
                                type="date"
                                name="departure_date"
                                id="departure_date"
                                value="{{ old('departure_date') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('departure_date') border-error-500 @enderror"
                                required
                                onclick="this.showPicker()" />
                        </div>
                        @error('departure_date')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Tanggal harus setelah hari ini
                        </p>
                    </div>

                    <!-- Departure Time -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Waktu Keberangkatan (WIB) <span class="text-error-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-clock text-gray-400"></i>
                            </div>
                            <input
                                type="time"
                                name="departure_time"
                                value="{{ old('departure_time') }}"
                                step="60"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('departure_time') border-error-500 @enderror"
                                required
                                id="departure_time"
                                onclick="this.showPicker()" />
                        </div>
                        @error('departure_time')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Format 24 jam (contoh: 13:00, 19:30)
                        </p>
                    </div>
                </div>

                <!-- Price and Seats -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Price -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Harga Tiket <span class="text-error-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-sm">Rp</span>
                            </div>
                            <input
                                type="number"
                                name="price"
                                value="{{ old('price') }}"
                                placeholder="Contoh: 150000"
                                min="0"
                                step="1000"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('price') border-error-500 @enderror"
                                required />
                        </div>
                        @error('price')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Seats Quota -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Kuota Kursi <span class="text-error-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-users text-gray-400"></i>
                            </div>
                            <input
                                type="number"
                                name="seats_kuota"
                                id="seats_kuota"
                                value="{{ old('seats_kuota') }}"
                                placeholder="Maks: 0"
                                min="1"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('seats_kuota') border-error-500 @enderror"
                                required />
                        </div>
                        @error('seats_kuota')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Kuota kursi akan dibatasi sesuai kapasitas kapal yang dipilih
                        </p>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status Jadwal <span class="text-error-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-toggle-on text-gray-400"></i>
                        </div>
                        <select name="status" 
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-10 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 appearance-none cursor-pointer @error('status') border-error-500 @enderror"
                                required>
                            <option value="scheduled" {{ old('status', 'scheduled') == 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                            <option value="departed" {{ old('status') == 'departed' ? 'selected' : '' }}>Berangkat</option>
                            <option value="arrived" {{ old('status') == 'arrived' ? 'selected' : '' }}>Tiba</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                    @error('status')
                        <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Status akan berubah otomatis sesuai dengan waktu keberangkatan
                    </p>
                </div>

                <!-- Tips Section -->
                <div class="rounded-lg bg-info-50 dark:bg-info-500/10 p-4 border border-info-200 dark:border-info-500/30">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-circle-info text-info-500 mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-medium text-info-800 dark:text-info-400">Tips Pengisian:</h4>
                            <ul class="mt-2 space-y-1 text-xs text-info-700 dark:text-info-300">
                                <li>• Pilih rute dan kapal yang sesuai untuk jadwal</li>
                                <li>• Tanggal keberangkatan tidak boleh kurang dari hari ini</li>
                                <li>• Kuota kursi tidak boleh melebihi kapasitas kapal</li>
                                <li>• Harga tiket dalam Rupiah tanpa titik atau koma</li>
                                <li>• Status aktif berarti jadwal dapat dipesan oleh penumpang</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-3 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <a href="{{ route('jadwals.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white transition rounded-lg bg-brand-500 hover:bg-brand-600">
                        <i class="fa-solid fa-save mr-2"></i>
                        Simpan Jadwal
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>

@push('scripts')
<script>
    document.getElementById('ship_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const capacity = selectedOption.getAttribute('data-capacity');
        const seatsInput = document.getElementById('seats_kuota');
        
        if (capacity) {
            seatsInput.setAttribute('max', capacity);
            seatsInput.setAttribute('placeholder', 'Maks: ' + capacity);
            
            if (parseInt(seatsInput.value) > parseInt(capacity)) {
                seatsInput.value = capacity;
            }
        }
    });
    
    if (document.getElementById('ship_id').value) {
        document.getElementById('ship_id').dispatchEvent(new Event('change'));
    }
</script>
@endpush

@endsection
