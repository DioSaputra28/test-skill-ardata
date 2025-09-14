@extends('admins.layouts.main')

@section('title', 'Tambah Rute - Admin Dashboard')
@section('page', 'rutes')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Tambah Data Rute
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('rutes.index') }}">Rute /</a>
                </li>
                <li class="font-medium text-primary">Tambah</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-error-200 bg-error-50 p-4 dark:border-error-800 dark:bg-error-900/20">
            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 text-error-600 dark:text-error-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 6V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 14H10.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-error-800 dark:text-error-300">Terdapat kesalahan pada form:</h3>
                    <ul class="mt-2 list-disc list-inside text-sm text-error-700 dark:text-error-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('rutes.store') }}" method="POST">
        @csrf
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Data Rute
                </h3>

                <button type="submit" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tambah
                </button>
            </div>

            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

                <!-- Departure -->
                <div>
                    <label for="departure" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Lokasi Keberangkatan <span class="text-error-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-location-dot text-green-500"></i>
                        </div>
                        <input
                            type="text"
                            id="departure"
                            name="departure"
                            value="{{ old('departure') }}"
                            placeholder="Masukkan lokasi keberangkatan (contoh: Pelabuhan Merak)"
                            required
                            maxlength="255"
                            class="@error('departure') border-error-500 @enderror dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>
                    @error('departure')
                        <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Destination -->
                <div>
                    <label for="destination" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Lokasi Tujuan <span class="text-error-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-flag-checkered text-red-500"></i>
                        </div>
                        <input
                            type="text"
                            id="destination"
                            name="destination"
                            value="{{ old('destination') }}"
                            placeholder="Masukkan lokasi tujuan (contoh: Pelabuhan Bakauheni)"
                            required
                            maxlength="255"
                            class="@error('destination') border-error-500 @enderror dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>
                    @error('destination')
                        <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Distance -->
                <div>
                    <label for="distance" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Jarak <span class="text-error-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-route text-blue-500"></i>
                        </div>
                        <input
                            type="number"
                            id="distance"
                            name="distance"
                            value="{{ old('distance') }}"
                            placeholder="Masukkan jarak perjalanan"
                            min="1"
                            required
                            class="@error('distance') border-error-500 @enderror dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-20 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm text-gray-500 dark:text-gray-400">km</span>
                    </div>
                    @error('distance')
                        <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Masukkan jarak dalam kilometer (angka bulat)</p>
                </div>

                <!-- Information Box -->
                <div class="rounded-lg border border-info-200 bg-info-50 p-4 dark:border-info-800 dark:bg-info-900/20">
                    <div class="flex items-start gap-3">
                        <svg class="h-5 w-5 text-info-600 dark:text-info-400 mt-0.5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 14V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 6H10.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-info-800 dark:text-info-300">Tips Pengisian</h4>
                            <ul class="mt-1 text-xs text-info-700 dark:text-info-400 space-y-1">
                                <li>• Gunakan nama lokasi yang jelas dan spesifik (contoh: "Pelabuhan Merak" bukan hanya "Merak")</li>
                                <li>• Pastikan tidak ada rute duplikat dengan keberangkatan dan tujuan yang sama</li>
                                <li>• Jarak harus berupa angka bulat dalam satuan kilometer</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
