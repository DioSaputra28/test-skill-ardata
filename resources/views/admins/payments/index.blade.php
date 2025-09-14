@extends('admins.layouts.main')

@section('title', 'Manajemen Pembayaran')
@section('page', 'payments')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Manajemen Pembayaran
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Pembayaran</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Payments List
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
                                                Payment ID
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Booking Code
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
                                                Payment Method
                                            </p>
                                        </div>
                                    </th>
                                    <th class="px-5 py-3 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Amount
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
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-xs uppercase tracking-wider dark:text-gray-400">
                                                Date
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
                            <!-- Table Body -->
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse($payments as $payment)
                                <tr>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-800 text-sm font-medium dark:text-white/90">
                                                #{{ $payment->payment_id }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                                                    <i class="fa-solid fa-receipt text-primary"></i>
                                                </div>
                                                <div>
                                                    <span class="block font-medium text-gray-800 text-sm dark:text-white/90">
                                                        {{ $payment->booking->booking_code }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-sm dark:text-gray-400">
                                                {{ $payment->booking->costumer->full_name }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-2">
                                                @if(str_contains(strtolower($payment->payment_method), 'bank'))
                                                    <i class="fa-solid fa-building-columns text-blue-500"></i>
                                                @elseif(str_contains(strtolower($payment->payment_method), 'cash'))
                                                    <i class="fa-solid fa-money-bill text-green-500"></i>
                                                @elseif(str_contains(strtolower($payment->payment_method), 'card'))
                                                    <i class="fa-solid fa-credit-card text-purple-500"></i>
                                                @else
                                                    <i class="fa-solid fa-wallet text-orange-500"></i>
                                                @endif
                                                <span class="text-gray-500 text-sm dark:text-gray-400">
                                                    {{ $payment->payment_method }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-800 text-sm font-medium dark:text-white/90">
                                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            @if($payment->payment_status == 'success' || $payment->payment_status == 'paid')
                                                <p class="rounded-full bg-success-50 px-2 py-0.5 text-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                    Success
                                                </p>
                                            @elseif($payment->payment_status == 'pending')
                                                <p class="rounded-full bg-warning-50 px-2 py-0.5 text-xs font-medium text-warning-700 dark:bg-warning-500/15 dark:text-warning-400">
                                                    Pending
                                                </p>
                                            @elseif($payment->payment_status == 'failed')
                                                <p class="rounded-full bg-error-50 px-2 py-0.5 text-xs font-medium text-error-700 dark:bg-error-500/15 dark:text-error-500">
                                                    Failed
                                                </p>
                                            @else
                                                <p class="rounded-full bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-700 dark:bg-gray-500/15 dark:text-gray-400">
                                                    {{ $payment->payment_status }}
                                                </p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-sm dark:text-gray-400">
                                                {{ $payment->created_at->format('d M Y H:i') }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('payments.show', $payment->payment_id) }}" class="rounded-md bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-500 hover:bg-blue-500/20">
                                                View
                                            </a>
                                            <a href="#" class="rounded-md bg-green-500/10 px-3 py-1 text-xs font-medium text-green-500 hover:bg-green-500/20">
                                                Receipt
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-5 py-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-money-bill text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                                            <p class="text-gray-500 dark:text-gray-400">No payments found</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Table End -->

                @if($payments->hasPages())
                <div class="mt-5">
                    {{ $payments->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
