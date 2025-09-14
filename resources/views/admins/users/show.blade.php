@extends('admins.layouts.main')

@section('title', 'Detail Pengguna - Admin Dashboard')
@section('page', 'users')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Detail Pengguna
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('user.index') }}">Pengguna /</a>
                </li>
                <li class="font-medium text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                Informasi Pengguna
            </h3>

            <div class="flex items-center gap-2">
                <a href="{{ route('user.edit', $user->user_id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg bg-warning-100 hover:bg-warning-200 dark:bg-warning-500/10 dark:text-warning-400 dark:hover:bg-warning-500/20">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.3333 2.00001C11.5084 1.82491 11.7163 1.68602 11.9451 1.59126C12.1739 1.49649 12.4191 1.44772 12.6667 1.44772C12.9143 1.44772 13.1594 1.49649 13.3882 1.59126C13.617 1.68602 13.8249 1.82491 14 2.00001C14.1751 2.17511 14.314 2.383 14.4088 2.61178C14.5035 2.84055 14.5523 3.08572 14.5523 3.33334C14.5523 3.58096 14.5035 3.82613 14.4088 4.05491C14.314 4.28368 14.1751 4.49157 14 4.66668L5 13.6667L2 14.6667L3 11.6667L11.3333 2.00001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('user.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            
            <!-- User Profile Card -->
            <div class="bg-gradient-to-r from-brand-50 to-purple-50 dark:from-brand-900/20 dark:to-purple-900/20 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center overflow-hidden shadow-xl">
                            @if(isset($user->avatar) && $user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-white font-semibold text-2xl">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $user->name }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300 flex items-center gap-2 mt-1">
                            <i class="fa-solid fa-envelope text-gray-400"></i>
                            {{ $user->email }}
                        </p>
                        <div class="flex items-center gap-3 mt-3">
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-id-badge"></i>
                                ID: #{{ $user->user_id }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information Fields -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-400 opacity-50"></i>
                        </div>
                        <input
                            type="text"
                            value="{{ $user->name }}"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>

                <!-- Email Field -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-400 opacity-50"></i>
                        </div>
                        <input
                            type="email"
                            value="{{ $user->email }}"
                            disabled
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                    </div>
                </div>
            </div>

            <!-- Account Statistics -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-sm font-medium text-gray-800 dark:text-white mb-4">Statistik Akun</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-info-100 dark:bg-info-500/20 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-calendar-plus text-info-600 dark:text-info-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Tanggal Bergabung</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-500/20 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-clock text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Terakhir Diperbarui</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $user->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-brand-100 dark:bg-brand-500/20 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-fingerprint text-brand-600 dark:text-brand-400"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">ID Pengguna</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">#{{ $user->user_id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-sm font-medium text-gray-800 dark:text-white mb-4">Informasi Tambahan</h4>
                <div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Waktu Pembuatan Akun
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-calendar text-gray-400 opacity-50"></i>
                            </div>
                            <input
                                type="text"
                                value="{{ $user->created_at->format('d F Y, H:i:s') }}"
                                disabled
                                class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 cursor-not-allowed opacity-75" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-200 dark:border-gray-700 pt-6">
                @if($user->user_id !== auth()->id())
                <form action="{{ route('user.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-error-500 hover:bg-error-600">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 4H14M5.33333 4V2.66667C5.33333 2.31305 5.47381 1.97391 5.72386 1.72386C5.97391 1.47381 6.31305 1.33333 6.66667 1.33333H9.33333C9.68696 1.33333 10.0261 1.47381 10.2761 1.72386C10.5262 1.97391 10.6667 2.31305 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.687 12.5262 14.0261 12.2761 14.2761C12.0261 14.5262 11.687 14.6667 11.3333 14.6667H4.66667C4.31305 14.6667 3.97391 14.5262 3.72386 14.2761C3.47381 14.0261 3.33333 13.687 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Hapus Pengguna
                    </button>
                </form>
                @endif
                <a href="{{ route('user.edit', $user->user_id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-brand-500 hover:bg-brand-600">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.3333 2.00001C11.5084 1.82491 11.7163 1.68602 11.9451 1.59126C12.1739 1.49649 12.4191 1.44772 12.6667 1.44772C12.9143 1.44772 13.1594 1.49649 13.3882 1.59126C13.617 1.68602 13.8249 1.82491 14 2.00001C14.1751 2.17511 14.314 2.383 14.4088 2.61178C14.5035 2.84055 14.5523 3.08572 14.5523 3.33334C14.5523 3.58096 14.5035 3.82613 14.4088 4.05491C14.314 4.28368 14.1751 4.49157 14 4.66668L5 13.6667L2 14.6667L3 11.6667L11.3333 2.00001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit Pengguna
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
