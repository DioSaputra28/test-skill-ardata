@extends('admins.layouts.main')

@section('title', 'Jadwal Keberangkatan - Admin Dashboard')
@section('page', 'jadwals')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Jadwal Keberangkatan
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Jadwal</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="mb-6 rounded-lg border-l-4 border-success-500 bg-success-50 p-4 dark:bg-success-500/10">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-check-circle text-xl text-success-500"></i>
            <p class="text-sm text-success-700 dark:text-success-400">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 rounded-lg border-l-4 border-error-500 bg-error-50 p-4 dark:bg-error-500/10">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-exclamation text-xl text-error-500"></i>
            <p class="text-sm text-error-700 dark:text-error-400">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Daftar Jadwal
                </h3>
                <a href="{{ route('jadwals.create') }}" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Tambah Jadwal
                </a>
            </div>
            
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <!-- Table Start -->
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="max-w-full overflow-x-auto">
                        <table class="min-w-full">
                            <!-- Table Header -->
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                ID
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
                                                Kapal
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Tanggal & Waktu
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Harga
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Kuota
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
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Aksi
                                            </p>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse($jadwals as $jadwal)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-800 text-sm font-medium dark:text-white/90">
                                            #{{ $jadwal->jadwal_id }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div>
                                            <p class="font-medium text-gray-800 text-sm dark:text-white/90">
                                                {{ $jadwal->rute->departure }} - {{ $jadwal->rute->destination }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                {{ $jadwal->rute->distance }} km
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-brand-100 dark:bg-brand-500/20 flex items-center justify-center">
                                                <i class="fa-solid fa-ship text-xs text-brand-600 dark:text-brand-400"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                                    {{ $jadwal->ship->ship_name }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $jadwal->ship->ship_type }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                                <i class="fa-solid fa-calendar text-gray-400 text-xs mr-1"></i>
                                                {{ \Carbon\Carbon::parse($jadwal->departure_date)->format('d M Y') }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                <i class="fa-solid fa-clock text-gray-400 text-xs mr-1"></i>
                                                {{ $jadwal->departure_time ?? '00:00' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                            Rp {{ number_format($jadwal->price ?? 0, 0, ',', '.') }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                                                @php
                                                    $totalSeats = $jadwal->ship->capacity ?? 100;
                                                    $availableSeats = $jadwal->seats_kuota ?? 0;
                                                    $percentage = $totalSeats > 0 ? ($availableSeats / $totalSeats) * 100 : 0;
                                                @endphp
                                                <div class="h-full {{ $percentage > 50 ? 'bg-success-500' : ($percentage > 20 ? 'bg-warning-500' : 'bg-error-500') }}" 
                                                     style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span class="text-xs text-gray-600 dark:text-gray-400 min-w-[40px]">
                                                {{ $availableSeats }}/{{ $totalSeats }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        @if(($jadwal->status ?? 'scheduled') == 'scheduled')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-info-50 px-2.5 py-1 text-xs font-medium text-info-700 dark:bg-info-500/15 dark:text-info-400">
                                                <i class="fa-solid fa-circle text-[6px]"></i>
                                                Terjadwal
                                            </span>
                                        @elseif($jadwal->status == 'departed')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-warning-50 px-2.5 py-1 text-xs font-medium text-warning-700 dark:bg-warning-500/15 dark:text-warning-400">
                                                <i class="fa-solid fa-circle text-[6px]"></i>
                                                Berangkat
                                            </span>
                                        @elseif($jadwal->status == 'arrived')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-success-50 px-2.5 py-1 text-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-400">
                                                <i class="fa-solid fa-circle text-[6px]"></i>
                                                Tiba
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 rounded-full bg-error-50 px-2.5 py-1 text-xs font-medium text-error-700 dark:bg-error-500/15 dark:text-error-400">
                                                <i class="fa-solid fa-circle text-[6px]"></i>
                                                Dibatalkan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('jadwals.show', $jadwal->jadwal_id) }}" class="rounded-md bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-500 hover:bg-blue-500/20">
                                                View
                                            </a>
                                            <a href="{{ route('jadwals.edit', $jadwal->jadwal_id) }}" class="rounded-md bg-warning-500/10 px-3 py-1 text-xs font-medium text-warning-500 hover:bg-warning-500/20">
                                                Edit
                                            </a>
                                            <form action="{{ route('jadwals.destroy', $jadwal->jadwal_id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-md bg-error-500/10 px-3 py-1 text-xs font-medium text-error-500 hover:bg-error-500/20">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-5 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-calendar-xmark text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                                            <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada jadwal keberangkatan</p>
                                            <a href="{{ route('jadwals.create') }}" class="mt-3 text-brand-500 hover:text-brand-600 text-sm font-medium">
                                                Tambah jadwal pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Table End -->

                @if($jadwals->hasPages())
                <div class="mt-5">
                    {{ $jadwals->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('page', 'jadwals')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Schedules Management
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Schedules</li>
            </ol>
        </nav>
    </div>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Schedules List
                </h3>
                <a href="#" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Tambah Data
                </a>
            </div>
            
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="max-w-full overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Schedule ID
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Route
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Ship
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Departure
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Price
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Seats
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
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Actions
                                            </p>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse($jadwals as $jadwal)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-800 text-sm font-medium dark:text-white/90">
                                                #{{ $jadwal->jadwal_id }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-sm dark:text-gray-400">
                                                {{ $jadwal->rute->departure }} - {{ $jadwal->rute->destination }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-sm dark:text-gray-400">
                                                {{ $jadwal->ship->ship_name }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex flex-col">
                                            <p class="text-gray-800 text-sm font-medium dark:text-white/90">
                                                {{ \Carbon\Carbon::parse($jadwal->departure_date)->format('d M Y') }}
                                            </p>
                                            <p class="text-gray-500 text-xs dark:text-gray-400">
                                                {{ $jadwal->departure_time }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-800 text-sm font-medium dark:text-white/90">
                                                Rp {{ number_format($jadwal->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-sm dark:text-gray-400">
                                                {{ $jadwal->seats_kuota }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            @if($jadwal->status == 'active')
                                                <p class="rounded-full bg-success-50 px-2 py-0.5 text-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                    Active
                                                </p>
                                            @elseif($jadwal->status == 'pending')
                                                <p class="rounded-full bg-warning-50 px-2 py-0.5 text-xs font-medium text-warning-700 dark:bg-warning-500/15 dark:text-warning-400">
                                                    Pending
                                                </p>
                                            @else
                                                <p class="rounded-full bg-error-50 px-2 py-0.5 text-xs font-medium text-error-700 dark:bg-error-500/15 dark:text-error-500">
                                                    Inactive
                                                </p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="#" class="rounded-md bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-500 hover:bg-blue-500/20">
                                                View
                                            </a>
                                            <a href="#" class="rounded-md bg-warning-500/10 px-3 py-1 text-xs font-medium text-warning-500 hover:bg-warning-500/20">
                                                Edit
                                            </a>
                                            <form action="#" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-md bg-error-500/10 px-3 py-1 text-xs font-medium text-error-500 hover:bg-error-500/20">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-5 py-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-calendar text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                                            <p class="text-gray-500 dark:text-gray-400">No schedules found</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($jadwals->hasPages())
                <div class="mt-5">
                    {{ $jadwals->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
