@extends('layouts.app')

@section('title', 'Hasil Pencarian Jadwal')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Hasil Pencarian Jadwal</h1>
            <p class="text-gray-600">Berikut adalah jadwal kapal yang sesuai dengan kriteria pencarian Anda</p>
        </div>

        <!-- Search Criteria Summary -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kriteria Pencarian</h2>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="border-l-4 border-blue-500 pl-4">
                    <p class="text-sm text-gray-500">Asal</p>
                    <p class="font-medium">{{ request('departure') ?? '-' }}</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <p class="text-sm text-gray-500">Tujuan</p>
                    <p class="font-medium">{{ request('destination') ?? '-' }}</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <p class="text-sm text-gray-500">Kapal</p>
                    <p class="font-medium">{{ request('ship_name') ?? 'Semua Kapal' }}</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <p class="text-sm text-gray-500">Tanggal</p>
                    <p class="font-medium">{{ request('departure_date') ? date('d F Y', strtotime(request('departure_date'))) : '-' }}</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <p class="text-sm text-gray-500">Jam</p>
                    <p class="font-medium">{{ request('departure_time') ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        @if(isset($results) && $results->count() > 0)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Jadwal Tersedia</h2>
                <p class="text-gray-600">{{ $results->count() }} jadwal ditemukan</p>
            </div>
            
            <div class="divide-y divide-gray-200">
                @foreach($results as $schedule)
                <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-4">
                                <div class="mr-4">
                                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-ship text-blue-600 text-xl"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $schedule->ship->ship_name }}</h3>
                                    <p class="text-gray-600">{{ $schedule->ship->ship_type }}</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ml-16">
                                <div>
                                    <p class="text-sm text-gray-500">Keberangkatan</p>
                                    <p class="font-medium">{{ $schedule->rute->departure }}</p>
                                    <p class="text-gray-600">{{ date('d F Y', strtotime($schedule->departure_date)) }}</p>
                                    <p class="text-gray-600">{{ $schedule->departure_time }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Tujuan</p>
                                    <p class="font-medium">{{ $schedule->rute->destination }}</p>
                                    <p class="text-gray-600">{{ $schedule->rute->distance }} km</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Ketersediaan</p>
                                    <p class="font-medium">Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
                                    <p class="text-gray-600">{{ $schedule->seats_kuota }} kursi tersedia</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 md:mt-0 md:ml-6">
                            <a href="{{ route('customer.booking', $schedule->jadwal_id) }}" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300 ease-in-out">
                                Pesan Tiket
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <div class="mx-auto w-24 h-24 rounded-full bg-red-100 flex items-center justify-center mb-6">
                <i class="fas fa-exclamation-circle text-red-500 text-4xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Jadwal Ditemukan</h3>
            <p class="text-gray-600 mb-6">Tidak ada jadwal kapal yang sesuai dengan kriteria pencarian Anda.</p>
            <a href="{{ route('costomer') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-300 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Pencarian
            </a>
        </div>
        @endif
    </div>
</div>
@endsection