@extends('layouts.app')

@section('title', 'Booking Tidak Ditemukan')

@section('content')
<div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
    <div class="text-center">
        <p class="text-sm font-semibold text-brand-600 uppercase tracking-wide">404 error</p>
        <h1 class="mt-2 text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">Booking Tidak Ditemukan</h1>
        <p class="mt-2 text-lg text-gray-500">Maaf, kami tidak dapat menemukan booking yang Anda cari.</p>
        <div class="mt-6">
            <a href="{{ route('costomer') }}" class="text-base font-medium text-brand-600 hover:text-brand-500">
                Kembali ke halaman utama
                <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>
    </div>
    <div class="mt-10">
        <h2 class="text-sm font-semibold text-gray-500 tracking-wide uppercase">Informasi</h2>
        <ul class="mt-4 border-t border-b border-gray-200 divide-y divide-gray-200">
            <li class="py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-3 text-base text-gray-500">Pastikan Anda menggunakan link yang benar</span>
                </div>
            </li>
            <li class="py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-3 text-base text-gray-500">Link mungkin sudah kedaluwarsa</span>
                </div>
            </li>
            <li class="py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span class="ml-3 text-base text-gray-500">Hubungi layanan pelanggan jika Anda yakin ini adalah kesalahan</span>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection