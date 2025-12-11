@extends('layouts.app')

@section('content')

<div class="p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100 min-h-screen rounded-2xl">

    <h2 class="text-3xl font-extrabold mb-8 text-gray-700 tracking-wide">
        🛏️ Pilih Kamar
    </h2>

    {{-- Jika tidak ada kamar --}}
    @if($kamar->isEmpty())
        <div class="p-6 bg-red-100 text-red-700 rounded-2xl shadow-xl max-w-xl">
            Tidak ada kamar yang tersedia saat ini 😢
        </div>
    @else

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @foreach($kamar as $k)
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl border border-white/30
                        hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                {{-- FOTO KAMAR --}}
                <div class="h-48 w-full bg-gray-200">
                    @if($k->foto_utama)
                        <img src="{{ asset('uploads/kamar/' . $k->foto_utama) }}"
                             alt="Foto {{ $k->tipe_kamar }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-500">
                            Tidak ada foto
                        </div>
                    @endif
                </div>

                <div class="p-6">

                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ $k->tipe_kamar }}
                    </h3>

                    <p class="text-gray-600 font-medium mb-4">
                        💰 Harga:
                        <span class="text-blue-600 font-bold">
                            Rp {{ number_format($k->harga, 0, ',', '.') }}
                        </span>
                    </p>

                    {{-- PERBAIKAN ROUTE --}}
                    <a href="{{ route('tamu.order.page', $k->id_kamar) }}"
                       class="inline-block px-5 py-3 bg-blue-600 text-white rounded-xl font-semibold
                              shadow-md hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5
                              transition-all duration-300">
                        Pesan Sekarang →
                    </a>

                </div>

            </div>
        @endforeach

    </div>

    @endif

</div>

@endsection
