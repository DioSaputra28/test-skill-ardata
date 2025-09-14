@extends('admins.layouts.main')

@section('title', 'Edit Rute - Admin Dashboard')
@section('page', 'rutes')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Edit Data Rute
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('rutes.index') }}">Rute /</a>
                </li>
                <li class="font-medium text-primary">Edit</li>
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

    <form action="{{ route('rutes.update', $rute->rute_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Data Rute
                </h3>

                <div class="flex items-center gap-2">
                    <a href="{{ route('rutes.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 8H2M2 8L6 4M2 8L6 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 7L10 14L6 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Update Rute
                    </button>
                </div>
            </div>

            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

                <!-- Route Visual Preview -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Preview Rute</h4>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-2xl text-green-500"></i>
                            <span class="text-sm font-medium text-gray-800 dark:text-white" id="departure-preview">{{ old('departure', $rute->departure) ?: 'Lokasi Keberangkatan' }}</span>
                        </div>
                        <div class="flex-1 mx-4">
                            <div class="border-t-2 border-dashed border-gray-400 dark:border-gray-600 relative">
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white dark:bg-gray-800 px-2 py-1 rounded-full">
                                    <span class="text-xs text-gray-600 dark:text-gray-400" id="distance-preview">{{ old('distance', $rute->distance) ?: '0' }} km</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-gray-800 dark:text-white" id="destination-preview">{{ old('destination', $rute->destination) ?: 'Lokasi Tujuan' }}</span>
                            <i class="fa-solid fa-flag-checkered text-2xl text-red-500"></i>
                        </div>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Departure -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Lokasi Keberangkatan <span class="text-error-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-location-dot text-green-500"></i>
                            </div>
                            <input
                                type="text"
                                name="departure"
                                id="departure"
                                value="{{ old('departure', $rute->departure) }}"
                                placeholder="Contoh: Pelabuhan Bakauheni"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('departure') border-error-500 @enderror"
                                required />
                        </div>
                        @error('departure')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Destination -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Lokasi Tujuan <span class="text-error-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-flag-checkered text-red-500"></i>
                            </div>
                            <input
                                type="text"
                                name="destination"
                                id="destination"
                                value="{{ old('destination', $rute->destination) }}"
                                placeholder="Contoh: Pelabuhan Merak"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('destination') border-error-500 @enderror"
                                required />
                        </div>
                        @error('destination')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Distance -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Jarak (dalam kilometer) <span class="text-error-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-route text-blue-500"></i>
                        </div>
                        <input
                            type="number"
                            name="distance"
                            id="distance"
                            value="{{ old('distance', $rute->distance) }}"
                            placeholder="Contoh: 30"
                            min="1"
                            step="0.1"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('distance') border-error-500 @enderror"
                            required />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-sm text-gray-500 dark:text-gray-400">km</span>
                        </div>
                    </div>
                    @error('distance')
                        <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Masukkan jarak tempuh antara lokasi keberangkatan dan tujuan
                    </p>
                </div>

                <!-- Tips Section -->
                <div class="rounded-lg bg-info-50 dark:bg-info-500/10 p-4 border border-info-200 dark:border-info-500/30">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-circle-info text-info-500 mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-medium text-info-800 dark:text-info-400">Tips Pengisian:</h4>
                            <ul class="mt-2 space-y-1 text-xs text-info-700 dark:text-info-300">
                                <li>• Pastikan nama lokasi keberangkatan dan tujuan jelas dan spesifik</li>
                                <li>• Gunakan nama resmi pelabuhan atau terminal</li>
                                <li>• Jarak harus dalam satuan kilometer (km)</li>
                                <li>• Perubahan rute akan mempengaruhi jadwal yang sudah ada</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Form Actions Mobile -->
                <div class="flex items-center justify-end gap-3 lg:hidden">
                    <a href="{{ route('rutes.index') }}" class="flex-1 text-center px-4 py-2.5 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-4 py-2.5 text-sm font-medium text-white transition rounded-lg bg-brand-500 hover:bg-brand-600">
                        Update Rute
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>

@push('scripts')
<script>
    document.getElementById('departure').addEventListener('input', function(e) {
        const preview = document.getElementById('departure-preview');
        preview.textContent = e.target.value || 'Lokasi Keberangkatan';
    });

    document.getElementById('destination').addEventListener('input', function(e) {
        const preview = document.getElementById('destination-preview');
        preview.textContent = e.target.value || 'Lokasi Tujuan';
    });

    document.getElementById('distance').addEventListener('input', function(e) {
        const preview = document.getElementById('distance-preview');
        preview.textContent = (e.target.value || '0') + ' km';
    });
</script>
@endpush

@endsection
