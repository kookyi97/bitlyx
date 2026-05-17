<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckRol
{
    public function handle(Request $request, Closure $next, string $rol): mixed
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $rolUsuario = Auth::user()->rol->nombre ?? null;

        if ($rolUsuario !== $rol) {
            // Si es admin intentando acceder a zona usuario, redirige a su dashboard
            if ($rolUsuario === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            // Si es usuario intentando acceder a zona admin, redirige a su dashboard
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
