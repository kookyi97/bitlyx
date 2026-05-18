<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\PreguntaController;
use App\Http\Controllers\QuizController;

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

// CRUD de Módulos (solo admin)
Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/modulos', [ModuloController::class, 'index'])->name('modulos.index');
    Route::get('/modulos/create', [ModuloController::class, 'create'])->name('modulos.create');
    Route::post('/modulos', [ModuloController::class, 'store'])->name('modulos.store');
    Route::get('/modulos/{modulo}/edit', [ModuloController::class, 'edit'])->name('modulos.edit');
    Route::put('/modulos/{modulo}', [ModuloController::class, 'update'])->name('modulos.update');
    Route::delete('/modulos/{modulo}', [ModuloController::class, 'destroy'])->name('modulos.destroy');

    // CRUD de Lecciones (solo admin)
    Route::get('/modulos/{id}/lecciones', [LeccionController::class, 'index'])->name('lecciones.index');
    Route::get('/modulos/{id}/lecciones/create', [LeccionController::class, 'create'])->name('lecciones.create');
    Route::post('/modulos/{id}/lecciones', [LeccionController::class, 'store'])->name('lecciones.store');
    Route::get('/lecciones/{id}/edit', [LeccionController::class, 'edit'])->name('lecciones.edit');
    Route::put('/lecciones/{id}', [LeccionController::class, 'update'])->name('lecciones.update');
    Route::delete('/lecciones/{id}', [LeccionController::class, 'destroy'])->name('lecciones.destroy');
});

// Rutas de aprendizaje (usuario)
Route::middleware(['auth', 'rol:usuario'])->group(function () {
    Route::get('/leccion/{id}', [LeccionController::class, 'show'])->name('leccion.show');
    Route::post('/leccion/{id}/completar', [LeccionController::class, 'completar'])->name('leccion.completar');
});

// Gestión de Preguntas (Admin)
Route::middleware(['auth', 'rol:admin'])->prefix('admin')->group(function () {
    Route::resource('preguntas', PreguntaController::class)->names('admin.preguntas');
});

// Rutas de Quiz (usuario)
Route::middleware(['auth', 'rol:usuario'])->group(function () {
    Route::get('/quiz/{leccion_id}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/guardar', [QuizController::class, 'guardar'])->name('quiz.guardar');
    Route::get('/quiz/{leccion_id}/resultado', [QuizController::class, 'resultado'])->name('quiz.resultado');
});