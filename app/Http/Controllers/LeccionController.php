<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Modulo;
use App\Models\Leccion;
use Illuminate\Http\Request;

class LeccionController extends Controller
{
    // Listar lecciones de un módulo
    public function index($id)
    {
        $modulo = Modulo::find($id);
        
        if(!$modulo) {
            return "Módulo con ID " . $id . " no encontrado";
        }
        
        $lecciones = $modulo->lecciones()->orderBy('orden')->get();
        return view('lecciones.index', compact('modulo', 'lecciones'));
    }

    // Formulario para crear lección
    public function create($id)
    {
        $modulo = Modulo::findOrFail($id);
        return view('lecciones.create', compact('modulo'));
    }

    // Guardar nueva lección
    public function store(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'contenido' => 'nullable',
            'orden' => 'integer'
        ]);

        $modulo = Modulo::findOrFail($id);
        $modulo->lecciones()->create($request->all());
        return redirect()->route('lecciones.index', $modulo->id)->with('success', 'Lección creada');
    }

    // Formulario para editar
    public function edit($id)
    {
        $leccion = Leccion::findOrFail($id);
        $modulo = $leccion->modulo;
        return view('lecciones.edit', compact('leccion', 'modulo'));
    }

    // Actualizar lección
    public function update(Request $request, $id)
    {
        $leccion = Leccion::findOrFail($id);
        
        $request->validate([
            'titulo' => 'required|max:150',
            'contenido' => 'nullable',
            'orden' => 'integer'
        ]);

        $leccion->update($request->all());
        return redirect()->route('lecciones.index', $leccion->modulo->id)->with('success', 'Lección actualizada');
    }

    // Eliminar lección
    public function destroy($id)
    {
        $leccion = Leccion::findOrFail($id);
        $modulo_id = $leccion->modulo->id;
        $leccion->delete();
        return redirect()->route('lecciones.index', $modulo_id)->with('success', 'Lección eliminada');
    }
}
=======
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
>>>>>>> 8074006363a4f89c4d9d6e456069e7498cf1da13
