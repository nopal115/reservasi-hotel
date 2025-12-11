<?php

namespace App\Http\Controllers;

use App\Models\Kamars;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    // 🟢 Halaman form order
    public function orderPage($id_kamar)
    {
        $kamar = Kamars::findOrFail($id_kamar);
        return view('tamu.order', compact('kamar'));
    }

    // 🟢 Simpan Reservasi (Tanpa Pemesanan!)
    public function store(Request $req)
    {
        $req->validate([
            'id_kamar' => 'required|exists:kamars,id_kamar',
            'tgl_checkin' => 'required|date|after_or_equal:today',
            'tgl_checkout' => 'required|date|after:tgl_checkin'
        ]);

        // Simpan ke tabel reservasis
        Reservasi::create([
            'id_user' => Auth::id(),
            'id_kamar' => $req->id_kamar,
            'tgl_checkin' => $req->tgl_checkin,
            'tgl_checkout' => $req->tgl_checkout,
            'status_pembayaran' => 'pending'
        ]);

        // Update status kamar menjadi booked
        Kamars::where('id_kamar', $req->id_kamar)->update([
            'status' => 'booked'
        ]);

        return redirect()->route('order.history')
            ->with('success', 'Reservasi berhasil dibuat!');
    }

    // 🟢 Riwayat reservasi tamu (tanpa pemesanan)
    public function riwayat()
    {
        $pemesanan = Reservasi::with('kamar')
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('tamu.riwayat', compact('pemesanan'));
    }
}
