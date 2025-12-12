
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

Route::get('/kamar', [RoomController::class, 'index']);
