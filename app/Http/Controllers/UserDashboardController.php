<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\ProgresoUsuario;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Unificamos el filtro 'publicado' junto con la carga de la relación lecciones
        $modulos = Modulo::where('estado', 'publicado')->with('lecciones')->get();       
        $usuario = Auth::user();
        
        $totalLeccionesGenerales = 0;
        $leccionesCompletadasGlobal = 0;
        $progresos = [];
        
        foreach ($modulos as $modulo) {
            $leccionesIds = $modulo->lecciones->pluck('id')->toArray();
            $totalLecciones = count($leccionesIds);
            $totalLeccionesGenerales += $totalLecciones;
            
            $completadas = ProgresoUsuario::where('usuario_id', $usuario->id)
                ->whereIn('leccion_id', $leccionesIds)
                ->where('completada', 1)
                ->count();
            
            $leccionesCompletadasGlobal += $completadas;
            
            $completadasMap = ProgresoUsuario::where('usuario_id', $usuario->id)
                ->whereIn('leccion_id', $leccionesIds)
                ->pluck('completada', 'leccion_id')
                ->toArray();
            
            $progresos[$modulo->id] = [
                'porcentaje' => $totalLecciones > 0 ? round(($completadas / $totalLecciones) * 100) : 0,
                'completadas' => $completadasMap,
                'primeraLeccion' => $modulo->lecciones->first()->id ?? null,
            ];
        }
        
        $porcentajeGlobal = $totalLeccionesGenerales > 0 
            ? round(($leccionesCompletadasGlobal / $totalLeccionesGenerales) * 100) 
            : 0;
        
        return view('user.dashboard', compact(
            'modulos', 
            'progresos', 
            'porcentajeGlobal', 
            'leccionesCompletadasGlobal',
            'totalLeccionesGenerales'
        ));
    }
}