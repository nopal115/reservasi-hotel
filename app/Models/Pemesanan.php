<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    protected $fillable = [
        'id_user',
        'id_kamar',
        'tanggal_checkin',
        'tanggal_checkout',
        'status' // contoh: 'pending', 'confirmed'
    ];

    public $timestamps = true;

   
        public function kamar()
        {
            return $this->belongsTo(Kamars::class, 'id_kamar');
        }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
