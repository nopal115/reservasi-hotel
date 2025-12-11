<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservasi; // <-- WAJIB

class Kamars extends Model
{
    use HasFactory;

    protected $table = 'kamars';
    protected $primaryKey = 'id_kamar';

    protected $fillable = [
        'id_hotel',     // <-- tambahkan ini jika kolom masih ada
        'tipe_kamar',
        'harga',
        'status',
        'foto_utama',
        'deskripsi',
        'fasilitas'
    ];

    protected $casts = [
        'fasilitas' => 'array', // auto JSON <-> array
    ];

    public $timestamps = true;

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_kamar');
    }
}
