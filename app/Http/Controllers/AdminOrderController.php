<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Menampilkan semua data pemesanan
     */
    public function index()
    {
        // Ambil semua reservasi + relasi kamar + user
        $orders = Reservasi::with(['kamar', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail pemesanan tertentu
     */
    public function show($id)
    {
        $order = Reservasi::with(['kamar', 'user'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status pemesanan (Opsional)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_reservasi' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $order = Reservasi::findOrFail($id);

        $order->update([
            'status_reservasi' => $request->status_reservasi,
        ]);

        return back()->with('success', 'Status pemesanan berhasil diperbarui!');
    }

    /**
     * Hapus pemesanan (Opsional)
     */
    public function destroy($id)
    {
        Reservasi::findOrFail($id)->delete();

        return back()->with('success', 'Pemesanan berhasil dihapus!');
    }
}
