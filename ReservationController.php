
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;

class ReservationController extends Controller
{
    public function create($room_id)
    {
        $room = Room::findOrFail($room_id);
        return view('reservations.create', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1'
        ]);

        Reservation::create($request->all());

        return redirect('/kamar')->with('success', 'Reservasi berhasil dibuat!');
    }
}
