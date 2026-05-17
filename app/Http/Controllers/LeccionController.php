<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leccion;
use App\Models\Modulo;
use App\Models\ProgresoUsuario;

class LeccionController extends Controller
{
     //Muestra el contenido de una lección. 
     
    public function show(int $id)
    {
        $leccion = Leccion::with('modulo')->findOrFail($id);
        $usuario = Auth::user();

        // Todas las lecciones del mismo módulo, en orden
        $leccionesDelModulo = Leccion::where('modulo_id', $leccion->modulo_id)
            ->orderBy('orden')
            ->get();

        // Buscar la posición actual
        $indice   = $leccionesDelModulo->search(fn($l) => $l->id === $leccion->id);
        $anterior = $indice > 0 ? $leccionesDelModulo[$indice - 1] : null;
        $siguiente = isset($leccionesDelModulo[$indice + 1]) ? $leccionesDelModulo[$indice + 1] : null;

        // Progreso de este usuario en esta lección
        $progreso = ProgresoUsuario::where('usuario_id', $usuario->id)
            ->where('leccion_id', $leccion->id)
            ->first();

        // Progreso total del módulo
        $leccionesCompletadas = ProgresoUsuario::where('usuario_id', $usuario->id)
            ->whereIn('leccion_id', $leccionesDelModulo->pluck('id'))
            ->where('completada', 1)
            ->count();

        $porcentajeModulo = $leccionesDelModulo->count() > 0
            ? round(($leccionesCompletadas / $leccionesDelModulo->count()) * 100)
            : 0;

        return view('user.leccion', compact(
            'leccion',
            'anterior',
            'siguiente',
            'progreso',
            'porcentajeModulo',
            'leccionesDelModulo',
            'leccionesCompletadas',
            'usuario'
        ));
    }

    /**
     * Marca una lección como completada (POST desde el botón).
     * Si ya existe el registro, lo actualiza. Si no, lo crea.
     */
    public function completar(Request $request, int $id)
    {
        $usuario = Auth::user();
        $leccion = Leccion::findOrFail($id);

        ProgresoUsuario::updateOrCreate(
            ['usuario_id' => $usuario->id, 'leccion_id' => $leccion->id],
            ['completada' => 1]
        );

        // Redirigir a la siguiente lección si existe, sino al dashboard
        $leccionesDelModulo = Leccion::where('modulo_id', $leccion->modulo_id)
            ->orderBy('orden')
            ->get();

        $indice    = $leccionesDelModulo->search(fn($l) => $l->id === $leccion->id);
        $siguiente = isset($leccionesDelModulo[$indice + 1]) ? $leccionesDelModulo[$indice + 1] : null;

        if ($siguiente) {
            return redirect()->route('leccion.show', $siguiente->id)
                ->with('success', '¡Lección completada! Continuando...');
        }

        return redirect()->route('user.dashboard')
            ->with('success', '¡Módulo completado! Buen trabajo.');
    }
}
