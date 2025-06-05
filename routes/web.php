<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard-admin');


Route::get('/daftar-pengguna', [AdminController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [AdminController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');

Route::get('/data-lahan-parkir', [AdminController::class, 'lahan'])->name('data.lahan');
Route::get('/lahan/{id}', [AdminController::class, 'lahandetail'])->name('detail.lahan');

Route::get('/data-kendaraan', [AdminController::class, 'kendaraan'])->name('data-kendaraan');

Route::get('/riwayat-tiket-online', [AdminController::class, 'tiket'])->name('riwayat-tiket-online');

Route::get('/user-details', function () {
    return view('user-details');
});

Route::get('/user-details-edit', function () {
    return view('user-details-edit');
});

Route::get('/dompet-digital-user', function () {
    return view('dompet-digital-user');
});

Route::get('/riwayat-tiket-online', function () {
    return view('riwayat-tiket-online');
});


Route::get('/dashboard-security', function () {
    return view('dashboard-security');
})->middleware('auth');
