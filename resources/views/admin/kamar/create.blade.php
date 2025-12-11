@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto glass p-8 rounded-3xl shadow">

    <h1 class="text-3xl font-bold text-blue-800 mb-6">➕ Tambah Kamar</h1>

    {{-- =============================
         ERROR VALIDATION MESSAGE
    ============================== --}}
    @if ($errors->any())
        <div class="bg-red-200 text-red-700 p-3 rounded-xl mb-4">
            {{ $errors->first() }}
        </div>
    @endif


    <form method="POST" action="{{ route('admin.kamar.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- ============================
             TIPE KAMAR
        ============================ --}}
        <label class="font-semibold">Tipe Kamar</label>
        <select name="tipe_kamar" class="w-full p-3 rounded-xl border mb-4" required>

            <optgroup label="🏨 Tipe Berdasarkan Fasilitas & Tingkatan">
                <option value="Standard Room">Standard Room — Tipe dasar, fasilitas standar</option>
                <option value="Superior Room">Superior Room — Lebih baik dari Standard</option>
                <option value="Deluxe Room">Deluxe Room — Lebih luas & mewah</option>
                <option value="Junior Suite">Junior Suite — Ruang tidur + ruang tamu kecil</option>
                <option value="Suite Room">Suite Room — Ruang tamu terpisah, premium</option>
                <option value="Presidential Suite">Presidential Suite — Tipe paling mewah</option>
            </optgroup>

            <optgroup label="🛏️ Tipe Berdasarkan Ranjang & Penggunaan">
                <option value="Single Room">Single Room — Untuk 1 tamu</option>
                <option value="Double Room">Double Room — Untuk 2 tamu (1 kasur besar)</option>
                <option value="Twin Room">Twin Room — Untuk 2 tamu (2 kasur)</option>
                <option value="Family Room">Family Room — Untuk keluarga</option>
                <option value="Connecting Room">Connecting Room — Dua kamar saling terhubung</option>
            </optgroup>

        </select>


        {{-- ============================
             HARGA
        ============================ --}}
        <label class="font-semibold">Harga (Rp)</label>
        <input type="number" name="harga" class="w-full p-3 rounded-xl border mb-4" required>


        {{-- ============================
             DESKRIPSI KAMAR (NEW)
        ============================ --}}
        <label class="font-semibold">Deskripsi</label>
        <textarea name="deskripsi" rows="4"
                  class="w-full p-3 rounded-xl border mb-4"
                  placeholder="Masukkan deskripsi lengkap kamar...">{{ old('deskripsi') }}</textarea>


        {{-- ============================
             FASILITAS KAMAR (NEW)
        ============================ --}}
        <label class="font-semibold">Fasilitas</label>
        <div class="grid grid-cols-2 gap-2 mb-4">

            @php
                $listFasilitas = [
                    "WiFi", "AC", "TV", "Sarapan",
                    "Kamar Mandi Dalam", "Air Panas",
                    "Lemari", "Meja Kerja",
                ];
            @endphp

            @foreach($listFasilitas as $fasilitas)
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="fasilitas[]" value="{{ $fasilitas }}">
                    {{ $fasilitas }}
                </label>
            @endforeach

        </div>


        {{-- ============================
             STATUS KAMAR
        ============================ --}}
        <label class="font-semibold">Status</label>
        <select name="status" class="w-full p-3 rounded-xl border mb-6" required>
            <option value="available">Available — Kamar siap dipesan</option>
            <option value="booked">Booked — Sudah dipesan namun belum ditempati</option>
            <option value="maintenance">Maintenance — Sedang perbaikan</option>
            <option value="unavailable">Unavailable — Tidak bisa disewa sementara</option>
        </select>


        {{-- ============================
             FOTO UTAMA KAMAR
        ============================ --}}
        <label class="font-semibold">Foto Kamar</label>
        <input type="file" name="foto_utama" accept="image/*"
               class="w-full p-3 rounded-xl border mb-4 bg-white" required>

        {{-- PREVIEW FOTO --}}
        <img id="preview" class="hidden w-40 h-40 object-cover rounded-xl border mb-4" />

        {{-- Script Preview Foto --}}
        <script>
            document.querySelector("input[name='foto_utama']").addEventListener("change", function(e) {
                const preview = document.getElementById("preview");
                preview.src = URL.createObjectURL(e.target.files[0]);
                preview.classList.remove("hidden");
            });
        </script>


        {{-- ============================
             SUBMIT
        ============================ --}}
        <button class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition">
            Simpan
        </button>

        {{-- ============================
             TOMBOL KEMBALI (NEW)
        ============================ --}}
        <a href="{{ route('admin.kamar.index') }}"
           class="block text-center text-gray-600 hover:underline mt-4">
           ← Kembali ke daftar kamar
        </a>

    </form>
</div>

@endsection
