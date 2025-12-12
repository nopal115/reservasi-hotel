
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['room_id','check_in','check_out','guests','status'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
