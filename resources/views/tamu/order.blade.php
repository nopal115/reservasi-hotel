@extends('layouts.app')

@section('content')

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <h2 class="text-3xl font-extrabold mb-10 text-gray-700 tracking-wide">
        📝 Form Reservasi Kamar
    </h2>

    <div class="max-w-xl mx-auto bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-xl
                border border-white/30 transition-all">

        {{-- Info Kamar --}}
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-800">{{ $kamar->tipe_kamar }}</h3>
            <p class="text-gray-600 text-lg mt-1">
                💰 Harga per malam:
                <span class="text-blue-600 font-bold">
                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </span>
            </p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('order.store') }}">
            @csrf

            <input type="hidden" name="id_kamar" value="{{ $kamar->id_kamar }}">

            {{-- Check In --}}
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">
                    📅 Tanggal Check-in
                </label>
                <input type="date" name="tgl_checkin" id="checkin"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm
                           focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
                    required>
            </div>

            {{-- Check Out --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    📅 Tanggal Check-out
                </label>
                <input type="date" name="tgl_checkout" id="checkout"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm
                           focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition"
                    required>
            </div>

            <button
                class="w-full py-3 bg-green-600 text-white font-semibold rounded-xl shadow-md
                       hover:bg-green-700 hover:shadow-lg hover:-translate-y-0.5
                       transition-all duration-300">
                Buat Reservasi 🚀
            </button>

        </form>
    </div>

</div>

{{-- Script untuk mencegah pemilihan tanggal yang tidak valid --}}
<script>
    const today = new Date().toISOString().split("T")[0];

    document.getElementById("checkin").setAttribute("min", today);

    document.getElementById("checkin").addEventListener("change", function () {
        const checkin = this.value;
        document.getElementById("checkout").setAttribute("min", checkin);
    });
</script>

@endsection
