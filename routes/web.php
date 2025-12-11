<?php

use Illuminate\Support\Facades\Route;

// ===============================
// 📌 IMPORT CONTROLLER
// ===============================
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminOrderController;


// ===============================
// 🌐 LANDING PAGE
// ===============================
Route::get('/', function () {
    return view('welcome');
});


// ===============================
// 🔵 AUTH ROUTES
// ===============================
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// ======================================================
// 🔴 ADMIN ROUTES (ROLE: admin only) — PREFIX: /admin
// ======================================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // ===============================
        // 👤 KELOLA ADMIN
        // ===============================
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [AdminUserController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [AdminUserController::class, 'store'])
            ->name('users.store');

        // ===============================
        // 🛏️ KELOLA KAMAR
        // ===============================
        Route::get('/kamar', [KamarController::class, 'index'])
            ->name('kamar.index');

        Route::get('/kamar/create', [KamarController::class, 'create'])
            ->name('kamar.create');

        Route::post('/kamar/store', [KamarController::class, 'store'])
            ->name('kamar.store');

        Route::get('/kamar/edit/{id}', [KamarController::class, 'edit'])
            ->name('kamar.edit');

        // ⭐ Perbaikan satu-satunya: POST → PUT
        Route::put('/kamar/update/{id}', [KamarController::class, 'update'])
            ->name('kamar.update');

        Route::delete('/kamar/delete/{id}', [KamarController::class, 'destroy'])
            ->name('kamar.delete');

        // ⭐⭐⭐ ROUTE DETAIL KAMAR (PERBAIKAN ERROR)
        Route::get('/kamar/show/{id}', [KamarController::class, 'show'])
            ->name('kamar.show');

        // ===============================
        // 💳 VERIFIKASI PEMBAYARAN
        // ===============================
        Route::get('/verifikasi', [AdminPaymentController::class, 'index'])
            ->name('payment.index');

        Route::post('/verifikasi/{id}', [AdminPaymentController::class, 'verify'])
            ->name('payment.verify');

        // ===============================
        // 📑 DATA PEMESANAN
        // ===============================
        Route::get('/pemesanan', [AdminOrderController::class, 'index'])
            ->name('orders.index');
    });


// ======================================================
// 🟢 TAMU ROUTES (ROLE: tamu only) — PREFIX: /tamu
// ======================================================
Route::middleware(['auth', 'role:tamu'])
    ->prefix('tamu')
    ->name('tamu.')
    ->group(function () {

        Route::get('/dashboard', [TamuController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/kamar-saya', [TamuController::class, 'kamarSaya'])
            ->name('kamar.saya');

        Route::get('/daftar-kamar', [TamuController::class, 'daftarKamar'])
            ->name('daftar-kamar');

        Route::get('/orders/history', [ReservasiController::class, 'riwayat'])
            ->name('orders.history');

        Route::get('/order/{id_kamar}', [ReservasiController::class, 'orderPage'])
            ->name('order.page');

        Route::post('/order/store', [ReservasiController::class, 'store'])
            ->name('order.store');

        Route::get('/kamar', [KamarController::class, 'listKamarTamu'])
            ->name('kamar.list');

        Route::get('/upload-bukti/{reservasi_id}', [PaymentController::class, 'create'])
            ->name('payment.upload.form');

        Route::post('/upload-bukti', [PaymentController::class, 'store'])
            ->name('payment.upload');
    });
