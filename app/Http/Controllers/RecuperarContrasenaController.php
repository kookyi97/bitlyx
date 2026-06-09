<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\RecuperarContrasena;
use Carbon\Carbon;


class RecuperarContrasenaController extends Controller
{
  
    public function showSolicitarForm()
    {
        return view('auth.recuperar');
    }


    public function enviarEnlace(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email'    => 'Ingresa un correo válido.',
        ]);

        // Verificar si el correo existe en la BD
        $usuario = User::where('email', $request->email)->first();

        // Por seguridad mostramos el mismo mensaje aunque no exista
        if (!$usuario) {
            return back()->with('status', 'Si ese correo está registrado, recibirás un enlace en tu bandeja de entrada.');
        }

        // Eliminar tokens anteriores de este correo
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Generar token único
        $token = Str::random(64);

        // Guardar token en BD
        DB::table('password_resets')->insert([
            'email'      => $request->email,
            'token'      => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        // Construir enlace
        $enlace = url('/recuperar-contrasena/reset/' . $token . '?email=' . urlencode($request->email));

        // Enviar correo
        Mail::to($request->email)->send(new RecuperarContrasena($usuario->nombre, $enlace));

        return back()->with('status', 'Si ese correo está registrado, recibirás un enlace en tu bandeja de entrada.');
    }

   
    public function showResetForm(Request $request, string $token)
    {
        $email = $request->query('email');

        if (!$email) {
            return redirect()->route('recuperar.form')
                ->withErrors(['email' => 'Enlace inválido.']);
        }

        return view('auth.nueva-contrasena', compact('token', 'email'));
    }

    
    public function resetear(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'token'                 => 'required',
            'password'              => 'required|min:6|confirmed',
        ], [
            'password.required'   => 'La nueva contraseña es obligatoria.',
            'password.min'        => 'La contraseña debe tener al menos 8
             caracteres.',
            'password.confirmed'  => 'Las contraseñas no coinciden.',
        ]);

        // Buscar el registro del token
        $registro = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$registro) {
            return back()->withErrors(['email' => 'El enlace no es válido o ya fue usado.']);
        }

        // Verificar que el token coincide
        if (!Hash::check($request->token, $registro->token)) {
            return back()->withErrors(['email' => 'El enlace no es válido o ya fue usado.']);
        }

        // Verificar que el token no haya expirado (60 minutos)
        $creadoEn = Carbon::parse($registro->created_at);
        if (Carbon::now()->diffInMinutes($creadoEn) > 60) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'El enlace ha expirado. Solicita uno nuevo.']);
        }

        // Buscar usuario y actualizar contraseña
        $usuario = User::where('email', $request->email)->first();

        if (!$usuario) {
            return back()->withErrors(['email' => 'No se encontró una cuenta con ese correo.']);
        }

        $usuario->password = Hash::make($request->password);
        $usuario->save();

        // Eliminar el token usado
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')
            ->with('success', '¡Contraseña actualizada correctamente! Ya puedes iniciar sesión.');
    }
}
