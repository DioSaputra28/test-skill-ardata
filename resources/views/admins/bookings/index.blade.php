@extends('admins.layouts.main')

@section('title', 'Manajemen Booking')
@section('page', 'bookings')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Manajemen Booking
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Booking</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Daftar Booking
                </h3>
                <a href="#" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tambah Booking
                </a>
            </div>

            <!-- Filter Section -->
            <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-800 sm:px-6">
                <form method="GET" action="{{ route('bookings.index') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cari</label>
                        <input
                            type="text"
                            name="search"
                            id="search"
                            value="{{ request('search') }}"
                            placeholder="Cari berdasarkan nama, email, kode booking, dll..."
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                        <input
                            type="date"
                            name="date"
                            id="date"
                            value="{{ request('date') }}"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
                            onclick="this.showPicker()">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                            Filter
                        </button>
                        <a href="{{ route('bookings.index') }}" class="ml-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">
                            Reset
                        </a>
                    </div>
                </form>

                <!-- Filter Info -->
                @if(request('search') || request('date'))
                <div class="mt-4 flex flex-wrap items-center gap-2 text-sm">
                    <span class="text-gray-600 dark:text-gray-400">Filter aktif:</span>
                    @if(request('search'))
                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-100">
                        Cari: {{ request('search') }}
                        <a href="{{ request()->url() }}?{{ http_build_query(array_filter(request()->except('search'))) }}" class="ml-1 cursor-pointer">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </span>
                    @endif
                    @if(request('date'))
                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-100">
                        Tanggal: {{ \Carbon\Carbon::parse(request('date'))->format('d F Y') }}
                        <a href="{{ request()->url() }}?{{ http_build_query(array_filter(request()->except('date'))) }}" class="ml-1 cursor-pointer">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </span>
                    @endif
                </div>
                @endif
            </div>

            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <!-- Results Info -->
                <div class="mb-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Menampilkan {{ $bookings->firstItem() }} sampai {{ $bookings->lastItem() }} dari {{ $bookings->total() }} booking
                        @if(request('search') || request('date'))
                        <span class="ml-2">(difilter)</span>
                        @endif
                    </div>
                </div>

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
                                                Kode Booking
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Customer
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
                                @forelse($bookings as $booking)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                                                    <i class="fa-solid fa-ticket text-primary"></i>
                                                </div>
                                                <div>
                                                    <span class="block font-medium text-gray-800 text-sm dark:text-white/90">
                                                        {{ $booking->booking_code }}
                                                    </span>
                                                    <span class="block text-gray-500 text-xs dark:text-gray-400">
                                                        {{ \Carbon\Carbon::parse($booking->booked_at)->format('d M Y H:i') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div>
                                                <p class="font-medium text-gray-800 text-sm dark:text-white/90">
                                                    {{ $booking->costumer->full_name }}
                                                </p>
                                                <p class="text-gray-500 text-xs dark:text-gray-400">
                                                    {{ $booking->costumer->phone_number }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex flex-col">
                                            <p class="text-gray-800 text-sm font-medium dark:text-white/90">
                                                {{ $booking->jadwal->rute->departure }} - {{ $booking->jadwal->rute->destination }}
                                            </p>
                                            <p class="text-gray-500 text-xs dark:text-gray-400">
                                                {{ \Carbon\Carbon::parse($booking->jadwal->departure_date)->format('d M Y') }} {{ $booking->jadwal->departure_time }}
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
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('bookings.show', $booking->booking_id) }}" class="rounded-md bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-500 hover:bg-blue-500/20">
                                                Lihat
                                            </a>
                                            <a href="{{ route('bookings.edit', $booking->booking_id) }}" class="rounded-md bg-warning-500/10 px-3 py-1 text-xs font-medium text-warning-500 hover:bg-warning-500/20">
                                                Edit
                                            </a>
                                            <form action="#" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-md bg-error-500/10 px-3 py-1 text-xs font-medium text-error-500 hover:bg-error-500/20">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-ticket text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                                            <p class="text-gray-500 dark:text-gray-400">
                                                @if(request('search') || request('date'))
                                                Tidak ada booking yang ditemukan dengan filter yang diterapkan.
                                                @else
                                                Tidak ada booking yang ditemukan.
                                                @endif
                                            </p>
                                            <a href="{{ route('bookings.index') }}" class="mt-3 text-primary hover:underline">
                                                Tampilkan semua booking
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

                @if($bookings->hasPages())
                <div class="mt-5">
                    {{ $bookings->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection