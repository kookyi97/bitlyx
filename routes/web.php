<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::get('/user/dashboard', [\App\Http\Controllers\UserDashboardController::class, 'index'])
    ->middleware(['auth', 'rol:usuario'])
    ->name('user.dashboard');

Route::get('/leccion/{id}', [\App\Http\Controllers\LeccionController::class, 'show'])
    ->middleware(['auth', 'rol:usuario'])
    ->name('leccion.show');

Route::post('/leccion/{id}/completar', [\App\Http\Controllers\LeccionController::class, 'completar'])
    ->middleware(['auth', 'rol:usuario'])
    ->name('leccion.completar');
