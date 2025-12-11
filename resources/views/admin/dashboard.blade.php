@extends('layouts.admin')

@section('content')

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="min-h-screen p-8 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <h1 class="text-4xl font-extrabold text-blue-900 mb-10 flex items-center gap-3">
        📊 Dashboard Admin
    </h1>

    <!-- ===================== STATISTIK ===================== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="p-6 glass rounded-2xl shadow-xl">
            <p class="text-gray-600">Total Tamu</p>
            <h3 class="text-4xl font-extrabold text-blue-700 mt-2">{{ $totalTamu }}</h3>
        </div>

        <div class="p-6 glass rounded-2xl shadow-xl">
            <p class="text-gray-600">Total Kamar</p>
            <h3 class="text-4xl font-extrabold text-purple-700 mt-2">{{ $totalKamar }}</h3>
        </div>

        <div class="p-6 glass rounded-2xl shadow-xl">
            <p class="text-gray-600">Kamar Tersedia</p>
            <h3 class="text-4xl font-extrabold text-green-700 mt-2">{{ $kamarTersedia }}</h3>
        </div>

    </div>

    <!-- Row kedua statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">

        <div class="p-6 glass rounded-2xl shadow-xl">
            <p class="text-gray-600">Total Reservasi</p>
            <h3 class="text-4xl font-extrabold text-blue-600 mt-2">{{ $totalReservasi }}</h3>
        </div>

        <div class="p-6 glass rounded-2xl shadow-xl">
            <p class="text-gray-600">Pending</p>
            <h3 class="text-4xl font-extrabold text-yellow-600 mt-2">{{ $pending }}</h3>
        </div>

        <div class="p-6 glass rounded-2xl shadow-xl">
            <p class="text-gray-600">Paid</p>
            <h3 class="text-4xl font-extrabold text-green-600 mt-2">{{ $paid }}</h3>
        </div>

    </div>

    <!-- =============== GRAFIK SECTION =============== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-16">

        <!-- Grafik Reservasi -->
        <div class="glass p-6 rounded-2xl shadow-xl">
            <h2 class="text-2xl font-bold mb-4 text-blue-900">📅 Reservasi 7 Hari Terakhir</h2>
            <canvas id="reservasiChart"></canvas>
        </div>

        <!-- Grafik Kamar -->
        <div class="glass p-6 rounded-2xl shadow-xl">
            <h2 class="text-2xl font-bold mb-4 text-blue-900">🏨 Status Kamar</h2>
            <canvas id="kamarChart"></canvas>
        </div>

    </div>

    <!-- =============== TABEL TERBARU =============== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        <!-- Reservasi terbaru -->
        <div class="glass p-6 rounded-2xl shadow-xl">
            <h2 class="text-2xl font-bold mb-4">📝 Reservasi Terbaru</h2>

            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="p-2">Tamu</th>
                        <th class="p-2">Kamar</th>
                        <th class="p-2">Check-in</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentReservasi as $r)
                    <tr class="border-b hover:bg-blue-50">
                        <td class="p-2">{{ $r->user->name }}</td>
                        <td class="p-2">{{ $r->kamar->tipe_kamar }}</td>
                        <td class="p-2">{{ $r->tgl_checkin }}</td>
                        <td class="p-2">
                            <span class="px-3 py-1 text-white rounded-xl text-xs
                                @if($r->status_pembayaran=='pending') bg-yellow-600
                                @elseif($r->status_pembayaran=='paid') bg-green-600
                                @else bg-red-600 @endif">
                                {{ ucfirst($r->status_pembayaran) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-4 text-center text-gray-500">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pembayaran terbaru -->
        <div class="glass p-6 rounded-2xl shadow-xl">
            <h2 class="text-2xl font-bold mb-4">💳 Pembayaran Terbaru</h2>

            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="p-2">ID Reservasi</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentPayments as $p)
                    <tr class="border-b hover:bg-blue-50">
                        <td class="p-2">{{ $p->id_reservasi }}</td>
                        <td class="p-2">{{ ucfirst($p->status) }}</td>
                        <td class="p-2">{{ $p->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="p-4 text-center text-gray-500">Belum ada pembayaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>


<!-- ======================= CHART SCRIPT ======================= -->
<script>
    // Chart reservasi
    new Chart(document.getElementById('reservasiChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($chartTanggal) !!},
            datasets: [{
                label: 'Total Reservasi',
                data: {!! json_encode($chartTotal) !!},
                borderWidth: 3,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.3)',
                tension: 0.4,
            }]
        }
    });

    // Chart status kamar
    new Chart(document.getElementById('kamarChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($chartKamar->keys()) !!},
            datasets: [{
                data: {!! json_encode($chartKamar->values()) !!},
                backgroundColor: ['#22c55e', '#f97316', '#dc2626']
            }]
        }
    });
</script>

@endsection
