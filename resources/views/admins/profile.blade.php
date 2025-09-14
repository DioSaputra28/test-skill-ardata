@extends('admins.layouts.main')

@section('title', 'Profile - Admin Panel')
@section('page', 'profile')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Profile
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Profile</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Profile</h1>
        <p class="mt-4 text-gray-600 dark:text-gray-300">Halaman profile sementara. Buat konten sesuai kebutuhan.</p>
    </div>
</div>
@endsection
