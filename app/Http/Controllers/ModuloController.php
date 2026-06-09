<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function index()
    {
        $modulos = Modulo::paginate(10);
        return view('modulos.index', compact('modulos'));
    }

    public function create()
    {
        return view('modulos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'descripcion' => 'nullable',
            'estado'   => 'required|in:publicado,borrador',
        ]);

        Modulo::create($request->only('titulo', 'descripcion', 'estado'));

        return redirect()->route('modulos.index')->with('success', 'Módulo creado exitosamente.');
    }

    public function edit(Modulo $modulo)
    {
        return view('modulos.edit', compact('modulo'));
    }

    public function update(Request $request, Modulo $modulo)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'descripcion' => 'nullable',
            'estado'   => 'required|in:publicado,borrador',
        ]);

        $modulo->update($request->only('titulo', 'descripcion', 'estado'));

        return redirect()->route('modulos.index')->with('success', 'Módulo actualizado con éxito.');
    }

    public function destroy(Modulo $modulo)
    {
        $modulo->delete();
        return redirect()->route('modulos.index')->with('success', 'Módulo eliminado.');
    }

    public function toggleEstado(Modulo $modulo)
    {
        $modulo->estado = $modulo->estado === 'publicado' ? 'borrador' : 'publicado';
        $modulo->save();

        return back()->with('success', 'Estado del módulo actualizado con éxito.');
    }
}