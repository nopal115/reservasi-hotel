
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/reservasi/{room_id}', [ReservationController::class, 'create']);
Route::post('/reservasi', [ReservationController::class, 'store']);
