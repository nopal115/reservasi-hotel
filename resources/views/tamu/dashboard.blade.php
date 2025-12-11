@extends('layouts.app')

@section('content')

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background: linear-gradient(135deg, #c7e1ff, #e9f3ff, #d0e7ff);
        min-height: 100vh;
    }
</style>

<div class="container mx-auto p-10">

    {{-- Title --}}
    <h1 class="text-4xl font-extrabold mb-10 text-blue-900 tracking-wide drop-shadow-lg">
        Dashboard Tamu
    </h1>

    {{-- 4 Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="p-6 glass rgb-border rounded-2xl shadow-lg hover:shadow-blue-300 hover:scale-105 transition">
            <p class="text-blue-900 font-semibold">Total Reservasi</p>
            <h3 class="text-4xl font-extrabold text-blue-700 mt-2">{{ $totalPemesanan }}</h3>
        </div>

        <div class="p-6 glass rgb-border rounded-2xl shadow-lg hover:shadow-blue-300 hover:scale-105 transition">
            <p class="text-blue-900 font-semibold">Pending</p>
            <h3 class="text-4xl font-extrabold text-yellow-600 mt-2">{{ $pending }}</h3>
        </div>

        <div class="p-6 glass rgb-border rounded-2xl shadow-lg hover:shadow-blue-300 hover:scale-105 transition">
            <p class="text-blue-900 font-semibold">Paid</p>
            <h3 class="text-4xl font-extrabold text-green-600 mt-2">{{ $confirmed }}</h3>
        </div>

        <div class="p-6 glass rgb-border rounded-2xl shadow-lg hover:shadow-blue-300 hover:scale-105 transition">
            <p class="text-blue-900 font-semibold">Cancelled</p>
            <h3 class="text-4xl font-extrabold text-red-600 mt-2">{{ $cancelled }}</h3>
        </div>

    </div>

    {{-- Total jenis kamar --}}
    <div class="mt-10 p-6 bg-blue-700/80 text-white rounded-2xl shadow-xl hover:scale-105 hover:shadow-blue-400 transition backdrop-blur-md">
        <h3 class="text-2xl font-bold">Total Jenis Kamar yang Pernah Anda Pesan</h3>
        <p class="text-6xl font-extrabold mt-2 drop-shadow-xl">{{ $totalKamar }}</p>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-12">

        {{-- Chart 1 --}}
        <div class="glass rgb-border p-8 rounded-2xl shadow-lg hover:shadow-blue-300 transition">
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Reservasi 7 Hari Terakhir</h2>
            <canvas id="chartPemesanan"></canvas>
        </div>

        {{-- Chart 2 --}}
        <div class="glass rgb-border p-8 rounded-2xl shadow-lg hover:shadow-blue-300 transition">
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Jenis Kamar Paling Sering Dipesan</h2>
            <canvas id="chartJenisKamar"></canvas>
        </div>

    </div>

</div>

{{-- Chart Script --}}
<script>
    // === Grafik Pemesanan ===
    new Chart(document.getElementById('chartPemesanan'), {
        type: 'line',
        data: {
            labels: {!! json_encode($tanggal) !!},
            datasets: [{
                label: 'Total Reservasi',
                data: {!! json_encode($total) !!},
                borderWidth: 3,
                borderColor: 'rgb(37,99,235)',
                backgroundColor: 'rgba(37,99,235,0.3)',
                tension: 0.4,
                pointBackgroundColor: 'white',
                pointBorderColor: 'rgb(37,99,235)',
                pointRadius: 5
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // === Grafik Jenis Kamar ===
    new Chart(document.getElementById('chartJenisKamar'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($tipeKamar) !!},
            datasets: [{
                label: 'Jumlah Pesanan',
                data: {!! json_encode($jumlahTipe) !!},
                backgroundColor: 'rgba(37,99,235,0.6)',
                borderColor: 'rgba(37,99,235,1)',
                borderWidth: 2,
                borderRadius: 12
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
</script>

@endsection
