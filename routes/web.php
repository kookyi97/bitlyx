<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Dashboards
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('admin.dashboard');

Route::get('/user/dashboard', [\App\Http\Controllers\UserDashboardController::class, 'index'])
    ->middleware(['auth', 'rol:usuario'])
    ->name('user.dashboard');

// CRUD de Módulos
Route::get('/modulos', [ModuloController::class, 'index'])->name('modulos.index');
Route::get('/modulos/create', [ModuloController::class, 'create'])->name('modulos.create');
Route::post('/modulos', [ModuloController::class, 'store'])->name('modulos.store');
Route::get('/modulos/{modulo}/edit', [ModuloController::class, 'edit'])->name('modulos.edit');
Route::put('/modulos/{modulo}', [ModuloController::class, 'update'])->name('modulos.update');
Route::delete('/modulos/{modulo}', [ModuloController::class, 'destroy'])->name('modulos.destroy');


Route::get('/modulos/{id}/lecciones', [LeccionController::class, 'index'])->name('lecciones.index');
Route::get('/modulos/{id}/lecciones/create', [LeccionController::class, 'create'])->name('lecciones.create');
Route::post('/modulos/{id}/lecciones', [LeccionController::class, 'store'])->name('lecciones.store');
Route::get('/lecciones/{id}/edit', [LeccionController::class, 'edit'])->name('lecciones.edit');
Route::put('/lecciones/{id}', [LeccionController::class, 'update'])->name('lecciones.update');
Route::delete('/lecciones/{id}', [LeccionController::class, 'destroy'])->name('lecciones.destroy');


Route::get('/leccion/{id}', [\App\Http\Controllers\LeccionController::class, 'show'])
    ->middleware(['auth', 'rol:usuario'])
    ->name('leccion.show');

Route::post('/leccion/{id}/completar', [\App\Http\Controllers\LeccionController::class, 'completar'])
    ->middleware(['auth', 'rol:usuario'])
    ->name('leccion.completar');