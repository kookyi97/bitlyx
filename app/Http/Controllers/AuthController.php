<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario) {
            return back()->withErrors([
                'email' => 'El correo electrónico no existe.'
            ]);
        }

        if ($usuario->activo == 0) {
            return back()->withErrors([
                'email' => 'Esta cuenta ha sido desactivada.'
            ]);
        }

        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return back()->withErrors([
                'password' => 'La contraseña es incorrecta.'
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->rol_id == 1) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        Usuario::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol_id' => 2,
            'xp_total' => 0,
            'activo' => 1,
        ]);

        return redirect()->route('login')
            ->with('status', '¡Tu cuenta ha sido creada con éxito! Ya puedes iniciar sesión.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}