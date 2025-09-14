@extends('admins.layouts.main')

@section('title', 'Detail Jadwal - Admin Dashboard')
@section('page', 'jadwals')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Detail Jadwal Keberangkatan
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('jadwals.index') }}">Jadwal /</a>
                </li>
                <li class="font-medium text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                Informasi Jadwal #{{ $jadwal->jadwal_id }}
            </h3>

            <div class="flex items-center gap-2">
                <a href="{{ route('jadwals.edit', $jadwal->jadwal_id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg bg-warning-100 hover:bg-warning-200 dark:bg-warning-500/10 dark:text-warning-400 dark:hover:bg-warning-500/20">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.3333 2.00001C11.5084 1.82491 11.7163 1.68602 11.9451 1.59126C12.1739 1.49649 12.4191 1.44772 12.6667 1.44772C12.9143 1.44772 13.1594 1.49649 13.3882 1.59126C13.617 1.68602 13.8249 1.82491 14 2.00001C14.1751 2.17511 14.314 2.383 14.4088 2.61178C14.5035 2.84055 14.5523 3.08572 14.5523 3.33334C14.5523 3.58096 14.5035 3.82613 14.4088 4.05491C14.314 4.28368 14.1751 4.49157 14 4.66668L5 13.6667L2 14.6667L3 11.6667L11.3333 2.00001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('jadwals.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            
            <!-- Schedule Visual Card -->
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Route Info -->
                    <div class="text-center lg:text-left">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Rute Perjalanan</p>
                        <div class="flex items-center justify-center lg:justify-start gap-2">
                            <i class="fa-solid fa-location-dot text-green-500"></i>
                            <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $jadwal->rute->departure }}</span>
                        </div>
                        <div class="flex items-center justify-center lg:justify-start gap-2 mt-1">
                            <i class="fa-solid fa-arrow-down text-gray-400 ml-1"></i>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $jadwal->rute->distance }} km</span>
                        </div>
                        <div class="flex items-center justify-center lg:justify-start gap-2 mt-1">
                            <i class="fa-solid fa-flag-checkered text-red-500"></i>
                            <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $jadwal->rute->destination }}</span>
                        </div>
                    </div>
                    
                    <!-- Ship Info -->
                    <div class="text-center">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Kapal</p>
                        <div class="flex items-center justify-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-brand-100 dark:bg-brand-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-ship text-brand-600 dark:text-brand-400"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $jadwal->ship->ship_name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $jadwal->ship->ship_type }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Schedule Time -->
                    <div class="text-center lg:text-right">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Waktu Keberangkatan</p>
                        <p class="text-lg font-semibold text-gray-800 dark:text-white">
                            <i class="fa-solid fa-calendar text-gray-400 text-sm mr-1"></i>
                            {{ \Carbon\Carbon::parse($jadwal->departure_date)->format('d M Y') }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                            <i class="fa-solid fa-clock text-gray-400 text-xs mr-1"></i>
                            {{ $jadwal->departure_time ?? '00:00' }} WIB
                        </p>
                    </div>
                </div>
            </div>

            <!-- Schedule Details -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Route Information -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Rute Perjalanan
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-route text-gray-400 opacity-50"></i>
                        </div>
                        <input
                            type="text"
                            value="{{ $jadwal->rute->departure }} - {{ $jadwal->rute->destination }} ({{ $jadwal->rute->distance }} km)"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>

                <!-- Ship Information -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Kapal
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-ship text-gray-400 opacity-50"></i>
                        </div>
                        <input
                            type="text"
                            value="{{ $jadwal->ship->ship_name }} - {{ $jadwal->ship->ship_type }}"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>

                <!-- Departure Date -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Tanggal Keberangkatan
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-calendar text-gray-400 opacity-50"></i>
                        </div>
                        <input
                            type="text"
                            value="{{ \Carbon\Carbon::parse($jadwal->departure_date)->format('d F Y') }}"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>

                <!-- Departure Time -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Waktu Keberangkatan
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-clock text-gray-400 opacity-50"></i>
                        </div>
                        <input
                            type="text"
                            value="{{ $jadwal->departure_time ?? '00:00' }} WIB"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>

                <!-- Price -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Harga Tiket
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-sm opacity-75">Rp</span>
                        </div>
                        <input
                            type="text"
                            value="{{ number_format($jadwal->price ?? 0, 0, ',', '.') }}"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>

                <!-- Seats Quota -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Kuota Kursi
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-users text-gray-400 opacity-50"></i>
                        </div>
                        <input
                            type="text"
                            value="{{ $jadwal->seats_kuota ?? 0 }} / {{ $jadwal->ship->capacity }} kursi"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>
            </div>

            <!-- Status and Statistics -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-sm font-medium text-gray-800 dark:text-white mb-4">Status & Statistik</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            @php
                                $statusConfig = [
                                    'scheduled' => ['bg' => 'bg-info-100 dark:bg-info-500/20', 'icon' => 'fa-calendar-check text-info-600 dark:text-info-400', 'text' => 'Terjadwal'],
                                    'departed' => ['bg' => 'bg-warning-100 dark:bg-warning-500/20', 'icon' => 'fa-plane-departure text-warning-600 dark:text-warning-400', 'text' => 'Berangkat'],
                                    'arrived' => ['bg' => 'bg-success-100 dark:bg-success-500/20', 'icon' => 'fa-circle-check text-success-600 dark:text-success-400', 'text' => 'Tiba'],
                                    'cancelled' => ['bg' => 'bg-error-100 dark:bg-error-500/20', 'icon' => 'fa-circle-xmark text-error-600 dark:text-error-400', 'text' => 'Dibatalkan'],
                                ];
                                $currentStatus = $jadwal->status ?? 'scheduled';
                                $config = $statusConfig[$currentStatus] ?? $statusConfig['scheduled'];
                            @endphp
                            <div class="w-10 h-10 {{ $config['bg'] }} rounded-lg flex items-center justify-center">
                                <i class="fa-solid {{ $config['icon'] }}"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Status</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">
                                    {{ $config['text'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-info-100 dark:bg-info-500/20 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-chair text-info-600 dark:text-info-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kursi Tersedia</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">
                                    {{ $jadwal->seats_kuota ?? 0 }} kursi
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-500/20 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-ticket text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Terjual</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">
                                    {{ ($jadwal->ship->capacity ?? 0) - ($jadwal->seats_kuota ?? 0) }} tiket
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-brand-100 dark:bg-brand-500/20 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-percentage text-brand-600 dark:text-brand-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Okupansi</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">
                                    @php
                                        $capacity = $jadwal->ship->capacity ?? 1;
                                        $sold = $capacity - ($jadwal->seats_kuota ?? 0);
                                        $percentage = round(($sold / $capacity) * 100);
                                    @endphp
                                    {{ $percentage }}%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seats Availability Visual -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-sm font-medium text-gray-800 dark:text-white mb-4">Ketersediaan Kursi</h4>
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-gray-500 dark:text-gray-400">Terisi</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ ($jadwal->ship->capacity ?? 0) - ($jadwal->seats_kuota ?? 0) }} / {{ $jadwal->ship->capacity ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 overflow-hidden">
                        @php
                            $totalSeats = $jadwal->ship->capacity ?? 100;
                            $availableSeats = $jadwal->seats_kuota ?? 0;
                            $percentage = $totalSeats > 0 ? (($totalSeats - $availableSeats) / $totalSeats) * 100 : 0;
                        @endphp
                        <div class="h-full {{ $percentage < 50 ? 'bg-success-500' : ($percentage < 80 ? 'bg-warning-500' : 'bg-error-500') }}" 
                             style="width: {{ $percentage }}%"></div>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-success-600 dark:text-success-400">Tersedia: {{ $availableSeats }} kursi</span>
                        <span class="text-xs text-gray-600 dark:text-gray-400">{{ round(100 - $percentage) }}% tersisa</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 dark:border-gray-700 pt-6">
                <form action="{{ route('jadwals.destroy', $jadwal->jadwal_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-error-500 hover:bg-error-600">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 4H14M5.33333 4V2.66667C5.33333 2.31305 5.47381 1.97391 5.72386 1.72386C5.97391 1.47381 6.31305 1.33333 6.66667 1.33333H9.33333C9.68696 1.33333 10.0261 1.47381 10.2761 1.72386C10.5262 1.97391 10.6667 2.31305 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.687 12.5262 14.0261 12.2761 14.2761C12.0261 14.5262 11.687 14.6667 11.3333 14.6667H4.66667C4.31305 14.6667 3.97391 14.5262 3.72386 14.2761C3.47381 14.0261 3.33333 13.687 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Hapus
                    </button>
                </form>
                <a href="{{ route('jadwals.edit', $jadwal->jadwal_id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 hover:bg-brand-600">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.3333 2.00001C11.5084 1.82491 11.7163 1.68602 11.9451 1.59126C12.1739 1.49649 12.4191 1.44772 12.6667 1.44772C12.9143 1.44772 13.1594 1.49649 13.3882 1.59126C13.617 1.68602 13.8249 1.82491 14 2.00001C14.1751 2.17511 14.314 2.383 14.4088 2.61178C14.5035 2.84055 14.5523 3.08572 14.5523 3.33334C14.5523 3.58096 14.5035 3.82613 14.4088 4.05491C14.314 4.28368 14.1751 4.49157 14 4.66668L5 13.6667L2 14.6667L3 11.6667L11.3333 2.00001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit Jadwal
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
