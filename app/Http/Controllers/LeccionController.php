<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Leccion;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgresoUsuario;

class LeccionController extends Controller
{
    // ========== PARTE 2 - CRUD de Lecciones ==========

    public function index($id)
    {
        $modulo = Modulo::find($id);
        if (!$modulo) return "Módulo con ID " . $id . " no encontrado";
        $lecciones = $modulo->lecciones()->orderBy('orden')->paginate(10);
        return view('lecciones.index', compact('modulo', 'lecciones'));
    }

    public function create($id)
    {
        $modulo = Modulo::findOrFail($id);
        return view('lecciones.create', compact('modulo'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'titulo'    => 'required|max:150',
            'contenido' => 'nullable',
            'orden'     => 'integer'
        ]);
        $modulo = Modulo::findOrFail($id);
        $modulo->lecciones()->create($request->all());
        return redirect()->route('lecciones.index', $modulo->id)->with('success', 'Lección creada');
    }

    public function edit($id)
    {
        $leccion = Leccion::findOrFail($id);
        $modulo  = $leccion->modulo;
        return view('lecciones.edit', compact('leccion', 'modulo'));
    }

    public function update(Request $request, $id)
    {
        $leccion = Leccion::findOrFail($id);
        $request->validate([
            'titulo'    => 'required|max:150',
            'contenido' => 'nullable',
            'orden'     => 'integer'
        ]);
        $leccion->update($request->all());
        return redirect()->route('lecciones.index', $leccion->modulo->id)->with('success', 'Lección actualizada');
    }

    public function destroy($id)
    {
        $leccion   = Leccion::findOrFail($id);
        $modulo_id = $leccion->modulo->id;
        $leccion->delete();
        return redirect()->route('lecciones.index', $modulo_id)->with('success', 'Lección eliminada');
    }

    // ========== PARTE 3 - Aprendizaje ==========

    public function show(int $id)
    {
        $leccion = Leccion::with('modulo')->findOrFail($id);
        $usuario = Auth::user();

        $leccionesDelModulo = Leccion::where('modulo_id', $leccion->modulo_id)
            ->orderBy('orden')->get();

        $indice    = $leccionesDelModulo->search(fn($l) => $l->id === $leccion->id);
        $anterior  = $indice > 0 ? $leccionesDelModulo[$indice - 1] : null;
        $siguiente = isset($leccionesDelModulo[$indice + 1]) ? $leccionesDelModulo[$indice + 1] : null;

        $progreso = ProgresoUsuario::where('usuario_id', $usuario->id)
            ->where('leccion_id', $leccion->id)->first();

        $leccionesCompletadas = ProgresoUsuario::where('usuario_id', $usuario->id)
            ->whereIn('leccion_id', $leccionesDelModulo->pluck('id'))
            ->where('completada', 1)->count();

        $porcentajeModulo = $leccionesDelModulo->count() > 0
            ? round(($leccionesCompletadas / $leccionesDelModulo->count()) * 100)
            : 0;

        return view('user.leccion', compact(
            'leccion', 'anterior', 'siguiente', 'progreso',
            'porcentajeModulo', 'leccionesDelModulo', 'leccionesCompletadas', 'usuario'
        ));
    }

    public function completar(Request $request, int $id)
    {
        $usuario = Auth::user();
        $leccion = Leccion::findOrFail($id);

        // Guardar progreso
        ProgresoUsuario::updateOrCreate(
            ['usuario_id' => $usuario->id, 'leccion_id' => $leccion->id],
            ['completada' => 1]
        );

        // Buscar siguiente lección
        $leccionesDelModulo = Leccion::where('modulo_id', $leccion->modulo_id)
            ->orderBy('orden')->get();

        $indice    = $leccionesDelModulo->search(fn($l) => $l->id === $leccion->id);
        $siguiente = isset($leccionesDelModulo[$indice + 1]) ? $leccionesDelModulo[$indice + 1] : null;

        // Si hay siguiente lección, ir a ella
        if ($siguiente) {
            return redirect()->route('leccion.show', $siguiente->id)
                ->with('success', '¡Lección completada! Continuando...');
        }

        // Es la última lección — verificar si el módulo tiene quiz
        $tieneQuiz = Pregunta::where('modulo_id', $leccion->modulo_id)->exists();

        if (false && $tieneQuiz) { // deshabilitado: ir al dashboard en vez del quiz
            // Mandar directo al quiz
            return redirect()->route('quiz.show', $leccion->modulo_id)
                ->with('info', '¡Lecciones completadas! Ahora haz el quiz final para aprobar el módulo.');
        }

        // Sin quiz — módulo completado directamente
        return redirect()->route('user.dashboard')
            ->with('success', '¡Módulo completado! Buen trabajo.');
    }
}