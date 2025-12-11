<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamars;

class KamarController extends Controller
{
    // =====================================================
    // 🟢 1. LIST KAMAR UNTUK TAMU
    // =====================================================
    public function listKamarTamu()
    {
        // TAMPILKAN HANYA KAMAR AVAILABLE
        $kamar = Kamars::where('status', 'available')->paginate(12);

        return view('tamu.kamar-list', compact('kamar'));
    }


    // =====================================================
    // 🟢 2. LIST KAMAR ADMIN (FILTER + PAGINATION)
    // =====================================================
    public function index(Request $request)
    {
        $query = Kamars::query();

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter tipe kamar
        if ($request->tipe_kamar) {
            $query->where('tipe_kamar', 'like', '%' . $request->tipe_kamar . '%');
        }

        $kamar = $query->paginate(10);

        return view('admin.kamar.index', compact('kamar'));
    }


    // =====================================================
    // 🟢 3. FORM TAMBAH KAMAR
    // =====================================================
    public function create()
    {
        return view('admin.kamar.create');
    }


    // =====================================================
    // 🟢 4. SIMPAN KAMAR BARU
    // =====================================================
    public function store(Request $request)
    {
        $request->validate([
            'tipe_kamar'  => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:available,booked,maintenance,unavailable',
            'deskripsi'   => 'nullable|string',
            'fasilitas'   => 'nullable|array',

            // 📌 DUKUNG HEIC, HEIF, AVIF, MAX 8MB
            'foto_utama'  => 'required|mimes:jpg,jpeg,png,webp,heic,heif,avif|max:8192'
        ]);

        // Upload foto
        $file = $request->file('foto_utama');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/kamar'), $namaFile);

        Kamars::create([
            'tipe_kamar'  => $request->tipe_kamar,
            'harga'       => $request->harga,
            'status'      => $request->status,
            'foto_utama'  => $namaFile,
            'deskripsi'   => $request->deskripsi,
            'fasilitas'   => json_encode($request->fasilitas ?? []),
        ]);

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }


    // =====================================================
    // 🟢 5. FORM EDIT KAMAR
    // =====================================================
    public function edit($id)
    {
        $kamar = Kamars::findOrFail($id);
        return view('admin.kamar.edit', compact('kamar'));
    }


    // =====================================================
    // 🟢 6. UPDATE KAMAR
    // =====================================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipe_kamar'  => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:available,booked,maintenance,unavailable',
            'deskripsi'   => 'nullable|string',
            'fasilitas'   => 'nullable|array',
            'foto_utama'  => 'nullable|mimes:jpg,jpeg,png,webp,heic,heif,avif|max:8192'
        ]);

        $kamar = Kamars::findOrFail($id);

        // Jika ada upload foto baru
        if ($request->hasFile('foto_utama')) {

            if ($kamar->foto_utama && file_exists(public_path('uploads/kamar/' . $kamar->foto_utama))) {
                unlink(public_path('uploads/kamar/' . $kamar->foto_utama));
            }

            $file = $request->file('foto_utama');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kamar'), $namaFile);

            $kamar->foto_utama = $namaFile;
        }

        $kamar->tipe_kamar = $request->tipe_kamar;
        $kamar->harga      = $request->harga;
        $kamar->status     = $request->status;
        $kamar->deskripsi  = $request->deskripsi;
        $kamar->fasilitas  = json_encode($request->fasilitas ?? []);

        $kamar->save();

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil diperbarui!');
    }


    // =====================================================
    // 🟢 7. HAPUS KAMAR
    // =====================================================
    public function destroy($id)
    {
        $kamar = Kamars::findOrFail($id);

        if ($kamar->foto_utama && file_exists(public_path('uploads/kamar/' . $kamar->foto_utama))) {
            unlink(public_path('uploads/kamar/' . $kamar->foto_utama));
        }

        $kamar->delete();

        return redirect()->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }


    // =====================================================
    // 🟢 8. DETAIL KAMAR ADMIN
    // =====================================================
    public function show($id)
    {
        $kamar = Kamars::findOrFail($id);
        return view('admin.kamar.show', compact('kamar'));
    }
}
