<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function show()
    {
        return view('user.perfil');
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $rules = [
            'nombre' => 'required|string|max:100',
            'email'  => 'required|email|max:150|unique:usuarios,email,' . $usuario->id,
        ];

        if ($request->filled('password_nueva')) {
            $rules['password_actual'] = 'required';
            $rules['password_nueva']  = 'required|min:6|confirmed';
        }

        $request->validate($rules, [
            'nombre.required'            => 'El nombre es obligatorio.',
            'email.required'             => 'El correo es obligatorio.',
            'email.unique'               => 'Este correo ya está en uso.',
            'password_actual.required'   => 'Debes ingresar tu contraseña actual.',
            'password_nueva.min'         => 'La nueva contraseña debe tener al menos 6 caracteres.',
            'password_nueva.confirmed'   => 'Las contraseñas no coinciden.',
        ]);

        if ($request->filled('password_nueva')) {
            if (!Hash::check($request->password_actual, $usuario->password)) {
                return back()
                    ->withErrors(['password_actual' => 'La contraseña actual es incorrecta.'])
                    ->withInput();
            }
        }

        $usuario->nombre = $request->nombre;
        $usuario->email  = $request->email;

        if ($request->filled('password_nueva')) {
            $usuario->password = Hash::make($request->password_nueva);
        }

        $usuario->save();

        return redirect()->route('user.perfil')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}
