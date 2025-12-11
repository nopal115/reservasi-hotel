<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_reservasi', 'metode_bayar',
        'jumlah', 'status'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }
}
