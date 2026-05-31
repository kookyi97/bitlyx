<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('rol')->paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function toggleActivo($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->activo = !$usuario->activo;
        $usuario->save();

        return redirect()->route('admin.usuarios.index')->with('success', 'Estado actualizado');
    }
}