
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->filled('tipe')) {
            $query->where('type', $request->tipe);
        }

        if ($request->filled('min_harga')) {
            $query->where('price', '>=', $request->min_harga);
        }

        if ($request->filled('max_harga')) {
            $query->where('price', '<=', $request->max_harga);
        }

        $rooms = $query->get();

        return view('rooms.index', compact('rooms'));
    }
}
