@extends('admins.layouts.main')

@section('title', 'Manajemen Pengguna - Admin Dashboard')
@section('page', 'users')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Manajemen Pengguna
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Pengguna</li>
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
                    Daftar Pengguna
                </h3>
                <a href="{{ route('user.create') }}" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Tambah Pengguna
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
                                    <th class="px-5 py-3 sm:px-6 text-left">
                                        <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                            Pengguna
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-left">
                                        <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                            Email
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-left">
                                        <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                            Tanggal Bergabung
                                        </p>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6 text-center">
                                        <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                            Aksi
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center overflow-hidden">
                                                @if(isset($user->avatar) && $user->avatar)
                                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-white font-medium text-sm">
                                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="block font-medium text-gray-800 text-sm dark:text-white/90">
                                                    {{ $user->name }}
                                                </span>
                                                <span class="block text-gray-500 text-xs dark:text-gray-400">
                                                    ID: #{{ $user->user_id }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-envelope text-gray-400 text-sm"></i>
                                            <p class="text-gray-600 text-sm dark:text-gray-300">
                                                {{ $user->email }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-600 text-sm dark:text-gray-300">
                                            {{ $user->created_at->format('d M Y') }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('user.show', $user->user_id) }}" class="rounded-md bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-500 hover:bg-blue-500/20">
                                                View
                                            </a>
                                            <a href="{{ route('user.edit', $user->user_id) }}" class="rounded-md bg-warning-500/10 px-3 py-1 text-xs font-medium text-warning-500 hover:bg-warning-500/20">
                                                Edit
                                            </a>
                                            @if($user->user_id !== auth()->id())
                                            <form action="{{ route('user.destroy', $user->user_id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-md bg-error-500/10 px-3 py-1 text-xs font-medium text-error-500 hover:bg-error-500/20">
                                                    Delete
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-users-slash text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                                            <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada data pengguna</p>
                                            <a href="{{ route('user.create') }}" class="mt-3 text-brand-500 hover:text-brand-600 text-sm font-medium">
                                                Tambah pengguna pertama
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

                @if(method_exists($users, 'hasPages') && $users->hasPages())
                <div class="mt-5">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
