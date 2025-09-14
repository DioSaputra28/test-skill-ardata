@extends('admins.layouts.main')

@section('title', 'Edit Ship - Admin Dashboard')
@section('page', 'ships')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Edit Data Kapal
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('ships.index') }}">Kapal /</a>
                </li>
                <li class="font-medium text-primary">Edit</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- Display Validation Errors -->
    @if ($errors->any())
    <div class="mb-4 rounded-lg border border-error-200 bg-error-50 p-4 dark:border-error-800 dark:bg-error-900/20">
        <div class="flex items-center gap-3">
            <svg class="h-5 w-5 text-error-600 dark:text-error-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M10 6V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M10 14H10.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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

    <form action="{{ route('ships.update', $ship->ship_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Edit Data Kapal #{{ $ship->ship_id }}
                </h3>

                <div class="flex items-center gap-2">
                    <a href="{{ route('ships.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12L2 8L6 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 8H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 10L8.33333 13.3333L15 6.66667" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>

            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Ship Name -->
                        <div>
                            <label for="ship_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Nama Kapal <span class="text-error-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="ship_name"
                                name="ship_name"
                                value="{{ old('ship_name', $ship->ship_name) }}"
                                placeholder="Masukkan nama kapal"
                                required
                                class="@error('ship_name') border-error-500 @enderror dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                            @error('ship_name')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ship Type -->
                        <div>
                            <label for="ship_type" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Tipe Kapal <span class="text-error-500">*</span>
                            </label>
                            <select
                                id="ship_type"
                                name="ship_type"
                                required
                                class="@error('ship_type') border-error-500 @enderror dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="" disabled>Pilih tipe kapal</option>
                                <option value="Ferry" {{ old('ship_type', $ship->ship_type) == 'Ferry' ? 'selected' : '' }}>Ferry</option>
                                <option value="Speed Boat" {{ old('ship_type', $ship->ship_type) == 'Speed Boat' ? 'selected' : '' }}>Speed Boat</option>
                                <option value="Kapal Penumpang" {{ old('ship_type', $ship->ship_type) == 'Kapal Penumpang' ? 'selected' : '' }}>Kapal Penumpang</option>
                                <option value="Kapal Cepat" {{ old('ship_type', $ship->ship_type) == 'Kapal Cepat' ? 'selected' : '' }}>Kapal Cepat</option>
                                <option value="KMP" {{ old('ship_type', $ship->ship_type) == 'KMP' ? 'selected' : '' }}>KMP (Kapal Motor Penumpang)</option>
                            </select>
                            @error('ship_type')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Capacity -->
                        <div>
                            <label for="capacity" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Kapasitas Kapal <span class="text-error-500">*</span>
                            </label>
                            <div class="relative">
                                <input
                                    type="number"
                                    id="capacity"
                                    name="capacity"
                                    value="{{ old('capacity', $ship->capacity) }}"
                                    placeholder="Masukkan kapasitas kapal"
                                    min="1"
                                    required
                                    class="@error('capacity') border-error-500 @enderror dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm text-gray-500 dark:text-gray-400">penumpang</span>
                            </div>
                            @error('capacity')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Information Box -->
                        <div class="rounded-lg border border-info-200 bg-info-50 p-4 dark:border-info-800 dark:bg-info-900/20">
                            <div class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-info-600 dark:text-info-400 mt-0.5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10 14V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10 6H10.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-info-800 dark:text-info-300">Informasi Penting</h4>
                                    <ul class="mt-1 text-xs text-info-700 dark:text-info-400 space-y-1">
                                        <li>• Pastikan nama kapal sesuai dengan dokumen resmi</li>
                                        <li>• Kapasitas kapal harus sesuai dengan sertifikat keselamatan</li>
                                        <li>• Perubahan status kapal akan mempengaruhi ketersediaan jadwal</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
</div>
@endsection