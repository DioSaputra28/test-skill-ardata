@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Cari Jadwal Keberangkatan</h1>
            <p class="text-gray-600">Temukan jadwal kapal yang sesuai dengan kebutuhan Anda</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <form action="{{ route('customer.ship_search') }}" method="GET" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="route" class="block text-sm font-medium text-gray-700 mb-2">
                            Rute Perjalanan
                        </label>
                        <select 
                            id="route" 
                            name="route" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            onchange="updateHiddenInputs()"
                        >
                            <option value="">Pilih Rute Perjalanan</option>
                            @foreach($rute as $route)
                                <option value="{{ $route->departure }}|{{ $route->destination }}">
                                    {{ $route->departure }} - {{ $route->destination }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Hidden inputs for departure and destination -->
                    <input type="hidden" id="departure" name="departure" value="">
                    <input type="hidden" id="destination" name="destination" value="">

                    <div>
                        <label for="ship_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kapal
                        </label>
                        <select 
                            id="ship_name" 
                            name="ship_name" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        >
                            <option value="">Semua Kapal</option>
                            @foreach($ship as $s)
                                <option value="{{ $s->ship_name }}">{{ $s->ship_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="departure_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Keberangkatan
                        </label>
                        <select 
                            id="departure_date" 
                            name="departure_date" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        >
                            <option value="">Pilih Tanggal</option>
                            @php $seenDates = []; @endphp
                            @foreach($jadwal as $schedule)
                                @if($schedule->departure_date)
                                    @php $d = $schedule->departure_date->format('Y-m-d'); @endphp
                                    @if(!in_array($d, $seenDates))
                                        <option value="{{ $d }}">
                                            {{ \Carbon\Carbon::parse($d)->format('d F Y') }}
                                        </option>
                                        @php $seenDates[] = $d; @endphp
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="departure_time" class="block text-sm font-medium text-gray-700 mb-2">
                        Jam Keberangkatan
                    </label>
                    <select 
                        id="departure_time" 
                        name="departure_time" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    >
                        <option value="">Pilih Jam</option>
                        @php $seenTimes = []; @endphp
                        @foreach($jadwal as $schedule)
                            @if($schedule->departure_time)
                                @php $t = $schedule->departure_time; @endphp
                                @if(!in_array($t, $seenTimes))
                                    <option value="{{ $t }}">{{ $t }}</option>
                                    @php $seenTimes[] = $t; @endphp
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-[1.02]"
                    >
                        Cari Jadwal
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Section -->
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-blue-800">Petunjuk Pencarian</h3>
                    <div class="mt-2 text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Pilih rute perjalanan (asal - tujuan) dari daftar</li>
                            <li>Filter berdasarkan nama kapal jika diperlukan</li>
                            <li>Pilih tanggal dan jam keberangkatan yang diinginkan</li>
                            <li>Klik tombol "Cari Jadwal" untuk melihat hasil</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateHiddenInputs() {
        const routeSelect = document.getElementById('route');
        const departureInput = document.getElementById('departure');
        const destinationInput = document.getElementById('destination');
        
        const selectedValue = routeSelect.value;
        if (selectedValue) {
            const [departure, destination] = selectedValue.split('|');
            departureInput.value = departure;
            destinationInput.value = destination;
        } else {
            departureInput.value = '';
            destinationInput.value = '';
        }
    }
</script>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#route').select2({
            placeholder: "Cari rute perjalanan...",
            allowClear: true
        });
        
        $('#ship_name').select2({
            placeholder: "Cari nama kapal...",
            allowClear: true
        });
        
        $('#departure_date').select2({
            placeholder: "Pilih tanggal...",
            allowClear: true
        });
        
        $('#departure_time').select2({
            placeholder: "Pilih jam...",
            allowClear: true
        });
    });
</script>
@endsection
@endsection