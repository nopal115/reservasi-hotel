@extends('layouts.app')

@section('content')

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <h2 class="text-3xl font-extrabold mb-8 text-gray-700 tracking-wide">
        🛏️ Kamar Saya
    </h2>

    {{-- Jika kosong --}}
    @if($pemesanan->isEmpty())
        <div class="p-6 bg-red-100 text-red-700 rounded-2xl shadow-xl max-w-lg">
            Kamu belum memiliki kamar yang dipesan 😢
        </div>

    @else

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @foreach($pemesanan as $p)
            <div class="bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white/30
                        hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">

                {{-- Nama kamar --}}
                <h3 class="font-bold text-xl text-gray-800">
                    {{ $p->kamar->tipe_kamar }}
                </h3>

                {{-- Harga --}}
                <p class="text-gray-700 mt-2">
                    💰 Harga:
                    <span class="font-semibold text-blue-600">
                        Rp {{ number_format($p->kamar->harga, 0, ',', '.') }}
                    </span>
                </p>

                {{-- Status Pembayaran --}}
                <p class="mt-3">
                    <span class="font-semibold text-gray-700">Status Pembayaran:</span>
                    <span class="
                        px-3 py-1 rounded-full text-white text-sm font-bold
                        @if($p->status_pembayaran == 'pending') bg-yellow-500
                        @elseif($p->status_pembayaran == 'paid') bg-green-600
                        @elseif($p->status_pembayaran == 'cancelled') bg-red-600
                        @else bg-gray-500 @endif
                    ">
                        {{ ucfirst($p->status_pembayaran) }}
                    </span>
                </p>

                {{-- Tanggal --}}
                <p class="mt-3 text-gray-600">📅 Check-in:
                    <span class="font-semibold">{{ $p->tgl_checkin }}</span>
                </p>

                <p class="text-gray-600">📅 Check-out:
                    <span class="font-semibold">{{ $p->tgl_checkout }}</span>
                </p>

            </div>
        @endforeach

    </div>

    @endif

</div>

@endsection
