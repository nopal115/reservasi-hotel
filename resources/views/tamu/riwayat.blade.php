@extends('layouts.app')

@section('content')

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <h1 class="text-3xl font-extrabold text-gray-700 mb-8 tracking-wide">
        📜 Riwayat Reservasi
    </h1>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="mb-5 px-4 py-3 bg-green-200 text-green-800 rounded-xl shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- JIKA KOSONG --}}
    @if($pemesanan->isEmpty())
        <div class="p-6 bg-red-100 text-red-700 rounded-2xl shadow-xl">
            Kamu belum memiliki riwayat pemesanan 😢
        </div>

    @else

        {{-- CARD TABEL --}}
        <div class="bg-white/90 backdrop-blur-xl border border-white/30 rounded-2xl shadow-xl p-6">

            <table class="w-full">
                <thead>
                    <tr class="text-gray-600 text-sm uppercase tracking-wide">
                        <th class="py-3 text-left">Kamar</th>
                        <th class="py-3 text-left">Check-In</th>
                        <th class="py-3 text-left">Check-Out</th>
                        <th class="py-3 text-left">Status</th>
                        <th class="py-3 text-left">Pembayaran</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pemesanan as $psn)
                    <tr class="border-b border-gray-200 hover:bg-purple-50 transition-all">

                        {{-- TIPE KAMAR --}}
                        <td class="py-3 font-semibold text-gray-700">
                            {{ $psn->kamar->tipe_kamar ?? 'Unknown' }}
                        </td>

                        {{-- CHECKIN --}}
                        <td class="py-3 text-gray-600">
                            📅 {{ $psn->tgl_checkin }}
                        </td>

                        {{-- CHECKOUT --}}
                        <td class="py-3 text-gray-600">
                            📅 {{ $psn->tgl_checkout }}
                        </td>

                        {{-- STATUS PEMBAYARAN --}}
                        <td class="py-3">
                            <span class="
                                px-3 py-1 rounded-full text-white text-sm font-semibold
                                @if($psn->status_pembayaran === 'pending') bg-yellow-500
                                @elseif($psn->status_pembayaran === 'paid') bg-green-600
                                @elseif($psn->status_pembayaran === 'cancelled') bg-red-600
                                @else bg-gray-500 @endif
                            ">
                                {{ ucfirst($psn->status_pembayaran) }}
                            </span>
                        </td>

                        {{-- KOLOM AKSI PEMBAYARAN --}}
                        <td class="py-3">

                            {{-- Jika pending → tampilkan tombol upload --}}
                            @if($psn->status_pembayaran === 'pending')

                                <a href="{{ route('payment.upload.form', ['reservasi_id' => $psn->id_reservasi]) }}"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow
                                    hover:bg-blue-700 hover:-translate-y-1 transition-all">
                                    Upload Bukti
                                </a>

                            {{-- Jika sudah bayar --}}
                            @elseif($psn->status_pembayaran === 'paid')

                                <span class="text-green-700 font-semibold">
                                    ✔ Sudah Lunas
                                </span>

                            {{-- Jika dibatalkan --}}
                            @elseif($psn->status_pembayaran === 'cancelled')

                                <span class="text-red-700 font-semibold">
                                    ✖ Dibatalkan
                                </span>

                            @endif

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    @endif

</div>

@endsection
