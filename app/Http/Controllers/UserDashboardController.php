<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Modulo;
use App\Models\ProgresoUsuario;

class UserDashboardController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        // Todos los módulos con sus lecciones
        $modulos = Modulo::with('lecciones')->get();

        // IDs de lecciones completadas por este usuario
        $leccionesCompletadasIds = ProgresoUsuario::where('usuario_id', $usuario->id)
            ->where('completada', 1)
            ->pluck('leccion_id')
            ->toArray();

        // Total de lecciones en el sistema
        $totalLecciones = $modulos->sum(fn($m) => $m->lecciones->count());

        // Estadísticas para la vista
        $stats = [
            'lecciones_completadas' => count($leccionesCompletadasIds),
            'total_lecciones'       => $totalLecciones,
            'xp_total'              => $usuario->xp_total ?? 0,
        ];

        // Calcular progreso por módulo
        $modulosConProgreso = $modulos->map(function ($modulo) use ($leccionesCompletadasIds) {
            $totalModulo     = $modulo->lecciones->count();
            $completadasModulo = $modulo->lecciones
                ->filter(fn($l) => in_array($l->id, $leccionesCompletadasIds))
                ->count();

            return [
                'id'          => $modulo->id,
                'titulo'      => $modulo->titulo,
                'descripcion' => $modulo->descripcion,
                'total'       => $totalModulo,
                'completadas' => $completadasModulo,
                'porcentaje'  => $totalModulo > 0
                    ? round(($completadasModulo / $totalModulo) * 100)
                    : 0,
                'lecciones'   => $modulo->lecciones->map(fn($l) => [
                    'id'         => $l->id,
                    'titulo'     => $l->titulo,
                    'orden'      => $l->orden,
                    'completada' => in_array($l->id, $leccionesCompletadasIds),
                ])->values(),
            ];
        })->values();

        return view('user.dashboard', compact('usuario', 'stats', 'modulosConProgreso'));
    }
}
