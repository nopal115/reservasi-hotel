@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-5">Detail Pemesanan</h1>

<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="font-bold text-lg">Informasi Pelanggan</h2>
    <p>Nama: {{ $order->user->name }}</p>
    <p>Email: {{ $order->user->email }}</p>

    <hr class="my-4">

    <h2 class="font-bold text-lg">Informasi Kamar</h2>
    <p>Tipe: {{ $order->kamar->tipe_kamar }}</p>
    <p>Harga: Rp {{ number_format($order->kamar->harga, 0, ',', '.') }}</p>

    <hr class="my-4">

    <h2 class="font-bold text-lg">Detail Reservasi</h2>
    <p>Check-in: {{ $order->tgl_checkin }}</p>
    <p>Check-out: {{ $order->tgl_checkout }}</p>
    <p>Status Reservasi: <strong>{{ $order->status_reservasi }}</strong></p>

    <form action="{{ route('admin.orders.updateStatus', $order->id_reservasi) }}" method="POST" class="mt-4">
        @csrf
        <label class="block mb-2 font-semibold">Ubah Status</label>
        <select name="status_reservasi" class="p-2 border rounded">
            <option value="pending">Pending</option>
            <option value="confirmed">Dikonfirmasi</option>
            <option value="completed">Selesai</option>
            <option value="cancelled">Dibatalkan</option>
        </select>

        <button class="px-4 py-2 bg-green-600 text-white rounded ml-2">Update</button>
    </form>
</div>

@endsection
