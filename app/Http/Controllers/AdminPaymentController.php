<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPaymentController extends Controller
{
    /**
     * Menampilkan semua pembayaran untuk diverifikasi admin
     */
    public function index()
    {
        // Ambil semua data pembayaran beserta relasi reservasi
        $payments = Payment::with('reservasi')
            ->orderBy('created_at', 'desc')
            ->get();

        // ARAHKAN KE VIEW BARU: admin/pembayaran/index.blade.php
        return view('admin.pembayaran.index', compact('payments'));
    }

    /**
     * Proses verifikasi pembayaran oleh admin
     */
    public function verify(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,rejected',
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([
            'status'             => $request->status,
            'admin_id'           => Auth::user()->id,
            'tanggal_verifikasi' => now(),
        ]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }
}
