@extends('admins.layouts.main')

@section('title', 'Dashboard - Admin Panel')
@section('page', 'dashboard')

@section('content')
<div class="p-4 mx-auto max-w-[1920px] md:p-6">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Selamat Datang, {{ auth()->user()->name }}!
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        {{-- Metrics Column --}}
        <div class="col-span-12 space-y-6">
            {{-- Metrics Group --}}
            <div class="grid grid-cols-1 gap-4 md:gap-6">
                {{-- All 4 metrics in one column --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4 md:gap-6">
                    {{-- Metric Item: Customers --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <i class="fas fa-users text-gray-800 dark:text-white/90 text-xl"></i>
                        </div>

                        <div class="mt-5 flex items-end justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Customers</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">{{ number_format($customersCount) }}</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Metric Item: Orders --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <i class="fas fa-shopping-cart text-gray-800 dark:text-white/90 text-xl"></i>
                        </div>

                        <div class="mt-5 flex items-end justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Booking</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">{{ number_format($bookingsCount) }}</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Metric Item: Revenue --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <i class="fas fa-dollar-sign text-gray-800 dark:text-white/90 text-xl"></i>
                        </div>

                        <div class="mt-5 flex items-end justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Revenue</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">Rp {{ number_format($revenue, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Metric Item: Users --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <i class="fas fa-users text-gray-800 dark:text-white/90 text-xl"></i>
                        </div>

                        <div class="mt-5 flex items-end justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Users</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">{{ number_format($usersCount) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Chart 1: Sales Overview --}}
                <!-- <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Sales Overview</h4>
                        <select class="text-sm border border-gray-200 rounded-lg px-3 py-1.5 dark:border-gray-800 dark:bg-gray-900">
                            <option>This Week</option>
                            <option>This Month</option>
                            <option>This Year</option>
                        </select>
                    </div>
                    <div class="h-[350px] flex items-center justify-center bg-gray-50 rounded-lg dark:bg-gray-800/50">
                        <p class="text-gray-500 dark:text-gray-400">Chart will be integrated here</p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // You can add your chart initialization scripts here later
    // For example: Chart.js, ApexCharts, etc.
</script>
@endpush