<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\ProgresoUsuario;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
{
    $modulos = Modulo::with('lecciones')->get();
    $usuario = Auth::user();
    
    $progresos = [];
    foreach ($modulos as $modulo) {
        $totalLecciones = $modulo->lecciones->count();
        $completadas = ProgresoUsuario::where('usuario_id', $usuario->id)
            ->whereIn('leccion_id', $modulo->lecciones->pluck('id'))
            ->where('completada', 1)
            ->count();
        
        $progresos[$modulo->id] = $totalLecciones > 0 ? round(($completadas / $totalLecciones) * 100) : 0;
    }
    
    return view('user.dashboard', compact('modulos', 'progresos'));
}
}