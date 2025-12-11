@extends('layouts.app')

@section('content')

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <h2 class="text-3xl font-extrabold mb-8 text-gray-800 tracking-wide drop-shadow">
        🛏️ Daftar Kamar Tersedia
    </h2>

    {{-- Jika tidak ada kamar --}}
    @if($kamar->isEmpty())
        <div class="p-6 bg-red-100 text-red-700 rounded-2xl shadow-xl max-w-lg">
            Belum ada kamar yang tersedia saat ini 😢
        </div>
    @else

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($kamar as $k)
            <div class="bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white/30
                        hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">

                <h3 class="font-bold text-xl text-blue-900 mb-2">
                    {{ $k->tipe_kamar }}
                </h3>

                <p class="text-gray-700 mb-1">
                    💰 Harga:
                    <span class="font-semibold text-blue-600">
                        Rp {{ number_format($k->harga, 0, ',', '.') }}
                    </span>
                </p>

                <p class="text-gray-600 mb-4">
                    Status:
                    <span class="font-semibold">{{ ucfirst($k->status) }}</span>
                </p>

                {{-- Tombol Pesan --}}
                <a href="{{ route('order.page', $k->id_kamar) }}"
                    class="block w-full text-center py-2 bg-blue-600 hover:bg-blue-700
                           text-white font-semibold rounded-xl shadow-md
                           hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    Pesan Sekarang →
                </a>

            </div>
            @endforeach

        </div>

    @endif

</div>

@endsection
