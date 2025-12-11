<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasis';
    protected $primaryKey = 'id_reservasi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
        'id_kamar',
        'tgl_checkin',
        'tgl_checkout',
        'status_pembayaran',
        'status_reservasi',
    ];

    /**
     * Relasi ke tabel user
     * Setiap reservasi dimiliki oleh 1 user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke tabel kamar
     * Setiap reservasi memilih 1 kamar
     */
    public function kamar()
    {
        return $this->belongsTo(Kamars::class, 'id_kamar');
    }

    /**
     * Relasi ke pembayaran
     * 1 reservasi hanya punya 1 bukti pembayaran
     */
    public function pembayaran()
    {
        return $this->hasOne(Payment::class, 'reservasi_id');
    }
}
