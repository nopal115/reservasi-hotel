<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika mengikuti konvensi)
    protected $table = 'payments';

    // Field yang boleh diisi mass assignment
    protected $fillable = [
        'reservasi_id',
        'bukti_pembayaran',
        'status',
        'admin_id',
        'tanggal_upload',
        'tanggal_verifikasi',
    ];

    /**
     * Relasi: Payment dimiliki oleh 1 Reservasi
     */
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasi_id', 'id_reservasi');
    }

    /**
     * Relasi: Payment diverifikasi oleh Admin
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
