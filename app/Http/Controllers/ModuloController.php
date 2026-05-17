<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    // Mostrar lista de módulos
    public function index()
    {
        $modulos = Modulo::all();
        return view('modulos.index', compact('modulos'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('modulos.create');
    }

    // Guardar nuevo módulo
    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|max:150',
        'descripcion' => 'nullable'
    ]);

    Modulo::create($request->all());
    return redirect()->route('modulos.index')->with('success', 'Módulo creado');
}

    // Mostrar formulario para editar
    public function edit(Modulo $modulo)
    {
        return view('modulos.edit', compact('modulo'));
    }

    // Actualizar módulo
    public function update(Request $request, Modulo $modulo)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'descripcion' => 'nullable'
        ]);

        $modulo->update($request->all());
        return redirect()->route('modulos.index')->with('success', 'Módulo actualizado');
    }

    // Eliminar módulo
    public function destroy(Modulo $modulo)
    {
        $modulo->delete();
        return redirect()->route('modulos.index')->with('success', 'Módulo eliminado');
    }
}