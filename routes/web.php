<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\PreguntaController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\ResultadoQuizController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\HistorialController;

Route::get('/', fn() => redirect()->route('login'));

// Autenticación
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);

Route::get('/recuperar-contrasena',               [\App\Http\Controllers\RecuperarContrasenaController::class, 'showSolicitarForm'])->name('recuperar.form');
Route::post('/recuperar-contrasena',              [\App\Http\Controllers\RecuperarContrasenaController::class, 'enviarEnlace'])->name('recuperar.enviar');
Route::get('/recuperar-contrasena/reset/{token}', [\App\Http\Controllers\RecuperarContrasenaController::class, 'showResetForm'])->name('recuperar.reset.form');
Route::post('/recuperar-contrasena/reset',        [\App\Http\Controllers\RecuperarContrasenaController::class, 'resetear'])->name('recuperar.resetear');

// CRUD Módulos
Route::get('/modulos',               [ModuloController::class, 'index'])->name('modulos.index');
Route::get('/modulos/create',        [ModuloController::class, 'create'])->name('modulos.create');
Route::post('/modulos',              [ModuloController::class, 'store'])->name('modulos.store');
Route::get('/modulos/{modulo}/edit', [ModuloController::class, 'edit'])->name('modulos.edit');
Route::put('/modulos/{modulo}',      [ModuloController::class, 'update'])->name('modulos.update');
Route::delete('/modulos/{modulo}',   [ModuloController::class, 'destroy'])->name('modulos.destroy');
Route::patch('modulos/{modulo}/toggle-estado', [ModuloController::class, 'toggleEstado'])->name('modulos.toggleEstado');

// CRUD Lecciones
Route::get('/modulos/{id}/lecciones',        [LeccionController::class, 'index'])->name('lecciones.index');
Route::get('/modulos/{id}/lecciones/create', [LeccionController::class, 'create'])->name('lecciones.create');
Route::post('/modulos/{id}/lecciones',       [LeccionController::class, 'store'])->name('lecciones.store');
Route::get('/lecciones/{id}/edit',           [LeccionController::class, 'edit'])->name('lecciones.edit');
Route::put('/lecciones/{id}',                [LeccionController::class, 'update'])->name('lecciones.update');
Route::delete('/lecciones/{id}',             [LeccionController::class, 'destroy'])->name('lecciones.destroy');

// Dashboards
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');
Route::get('/user/dashboard',  [\App\Http\Controllers\UserDashboardController::class, 'index'])->middleware(['auth','rol:usuario'])->name('user.dashboard');

// Lecciones usuario
Route::get('/leccion/{id}',           [LeccionController::class, 'show'])->middleware(['auth','rol:usuario'])->name('leccion.show');
Route::post('/leccion/{id}/completar',[LeccionController::class, 'completar'])->middleware(['auth','rol:usuario'])->name('leccion.completar');

// Admin
Route::middleware(['auth','rol:admin','no.cache'])->prefix('admin')->group(function () {
    Route::resource('preguntas', PreguntaController::class)->names('admin.preguntas');
});
Route::middleware(['auth','rol:admin'])->prefix('admin')->group(function () {
    Route::get('/usuarios',               [UsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::patch('/usuarios/{id}/toggle', [UsuarioController::class, 'toggleActivo'])->name('admin.usuarios.toggle');
    Route::get('/resultados-quiz',        [ResultadoQuizController::class, 'index'])->name('admin.resultados_quiz.index');
});

// ── QUIZ POR MÓDULO ───────────────────────────────────────────────
Route::middleware(['auth','rol:usuario'])->group(function () {
    Route::get('/quiz/modulo/{modulo_id}',           [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/guardar',                     [QuizController::class, 'guardar'])->name('quiz.guardar');
    Route::get('/quiz/modulo/{modulo_id}/resultado',  [QuizController::class, 'resultado'])->name('quiz.resultado');
    Route::get('/quiz/modulo/{modulo_id}/revision',   [QuizController::class, 'revision'])->name('quiz.revision');
    Route::get('/quiz/modulo/{modulo_id}/reintentar', [QuizController::class, 'reintentar'])->name('quiz.reintentar');
});

// Perfil y extras usuario
Route::get('/user/perfil', [\App\Http\Controllers\PerfilController::class, 'show'])->middleware(['auth','rol:usuario'])->name('user.perfil');
Route::put('/user/perfil', [\App\Http\Controllers\PerfilController::class, 'update'])->middleware(['auth','rol:usuario'])->name('user.perfil.update');

Route::middleware(['auth','rol:usuario','no.cache'])->group(function () {
    Route::get('/historial',   [HistorialController::class, 'historial'])->name('quiz.historial');
    Route::get('/leaderboard', [HistorialController::class, 'leaderboard'])->name('quiz.leaderboard');
});
