@extends('admins.layouts.main')

@section('title', 'Manajemen Customer')
@section('page', 'costumers')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Manajemen Customer
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Customer</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Daftar Customer
                </h3>
            </div>
            
            <!-- Filter Section removed per request -->
            
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <!-- Results Info -->
                <div class="mb-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Menampilkan {{ $costumer->firstItem() }} sampai {{ $costumer->lastItem() }} dari {{ $costumer->total() }} customer
                        @if(request('search'))
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
                                                Customer
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Kontak
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Identitas
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Booking
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
                                @forelse($costumer as $customer)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                                                    <i class="fa-solid fa-user text-primary"></i>
                                                </div>
                                                <div>
                                                    <span class="block font-medium text-gray-800 text-sm dark:text-white/90">
                                                        {{ $customer->full_name }}
                                                    </span>
                                                    <span class="block text-gray-500 text-xs dark:text-gray-400">
                                                        Bergabung {{ $customer->created_at->format('d M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex flex-col">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-solid fa-envelope text-gray-500 text-xs"></i>
                                                <span class="text-gray-800 text-sm dark:text-white/90">
                                                    {{ $customer->email }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <i class="fa-solid fa-phone text-gray-500 text-xs"></i>
                                                <span class="text-gray-800 text-sm dark:text-white/90">
                                                    {{ $customer->phone_number }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex flex-col">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-solid fa-id-card text-gray-500 text-xs"></i>
                                                <span class="text-gray-800 text-sm dark:text-white/90">
                                                    {{ $customer->nik }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <i class="fa-solid fa-calendar text-gray-500 text-xs"></i>
                                                <span class="text-gray-800 text-sm dark:text-white/90">
                                                    {{ $customer->age }} tahun
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <i class="fa-solid fa-venus-mars text-gray-500 text-xs"></i>
                                                <span class="text-gray-800 text-sm dark:text-white/90">
                                                    {{ $customer->gender }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-100">
                                                {{ $customer->bookings_count ?? 0 }} booking
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('costumers.show', $customer->costumer_id) }}" class="rounded-md bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-500 hover:bg-blue-500/20">
                                                Lihat
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-user text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                                            <p class="text-gray-500 dark:text-gray-400">
                                                @if(request('search'))
                                                    Tidak ada customer yang ditemukan dengan filter yang diterapkan.
                                                @else
                                                    Tidak ada customer yang ditemukan.
                                                @endif
                                            </p>
                                            <a href="{{ route('costumers.index') }}" class="mt-3 text-primary hover:underline">
                                                Tampilkan semua customer
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

                @if($costumer->hasPages())
                <div class="mt-5">
                    {{ $costumer->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection