@extends('admins.layouts.main')

@section('title', 'Ship Detail - Admin Dashboard')
@section('page', 'ships')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Detail Data Kapal
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('ships.index') }}">Kapal /</a>
                </li>
                <li class="font-medium text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                Data Kapal #{{ $ship->ship_id }}
            </h3>

            <div class="flex items-center gap-2">
                <a href="{{ route('ships.edit', $ship->ship_id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg bg-warning-100 hover:bg-warning-200 dark:bg-warning-500/10 dark:text-warning-400 dark:hover:bg-warning-500/20">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.3333 2.00001C11.5084 1.82491 11.7163 1.68602 11.9451 1.59126C12.1739 1.49649 12.4191 1.44772 12.6667 1.44772C12.9143 1.44772 13.1594 1.49649 13.3882 1.59126C13.617 1.68602 13.8249 1.82491 14 2.00001C14.1751 2.17511 14.314 2.383 14.4088 2.61178C14.5035 2.84055 14.5523 3.08572 14.5523 3.33334C14.5523 3.58096 14.5035 3.82613 14.4088 4.05491C14.314 4.28368 14.1751 4.49157 14 4.66668L5 13.6667L2 14.6667L3 11.6667L11.3333 2.00001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('ships.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            
            <!-- Ship Information Card -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Ship Name -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nama Kapal
                        </label>
                        <input
                            type="text"
                            value="{{ $ship->ship_name }}"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>

                    <!-- Ship Type -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Tipe Kapal
                        </label>
                        <input
                            type="text"
                            value="{{ $ship->ship_type }}"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Capacity -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Kapasitas Kapal
                        </label>
                        <input
                            type="number"
                            value="{{ $ship->capacity }}"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-sm font-medium text-gray-800 dark:text-white mb-4">Informasi Tambahan</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">ID Kapal</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">#{{ $ship->ship_id }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Dibuat Pada</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $ship->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Terakhir Diupdate</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $ship->updated_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Total Jadwal</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $ship->jadwals->count() }} Jadwal</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 dark:border-gray-700 pt-6">
                <form action="{{ route('ships.destroy', $ship->ship_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kapal ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-error-500 hover:bg-error-600">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 4H14M5.33333 4V2.66667C5.33333 2.31305 5.47381 1.97391 5.72386 1.72386C5.97391 1.47381 6.31305 1.33333 6.66667 1.33333H9.33333C9.68696 1.33333 10.0261 1.47381 10.2761 1.72386C10.5262 1.97391 10.6667 2.31305 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.687 12.5262 14.0261 12.2761 14.2761C12.0261 14.5262 11.687 14.6667 11.3333 14.6667H4.66667C4.31305 14.6667 3.97391 14.5262 3.72386 14.2761C3.47381 14.0261 3.33333 13.687 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Hapus
                    </button>
                </form>
                <a href="{{ route('ships.edit', $ship->ship_id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 hover:bg-brand-600">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.3333 2.00001C11.5084 1.82491 11.7163 1.68602 11.9451 1.59126C12.1739 1.49649 12.4191 1.44772 12.6667 1.44772C12.9143 1.44772 13.1594 1.49649 13.3882 1.59126C13.617 1.68602 13.8249 1.82491 14 2.00001C14.1751 2.17511 14.314 2.383 14.4088 2.61178C14.5035 2.84055 14.5523 3.08572 14.5523 3.33334C14.5523 3.58096 14.5035 3.82613 14.4088 4.05491C14.314 4.28368 14.1751 4.49157 14 4.66668L5 13.6667L2 14.6667L3 11.6667L11.3333 2.00001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit Kapal
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
