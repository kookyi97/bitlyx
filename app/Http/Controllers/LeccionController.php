<?php

namespace App\Http\Controllers;

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