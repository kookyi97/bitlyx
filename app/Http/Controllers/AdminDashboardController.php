<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Leccion;
use App\Models\Usuario;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalModulos = Modulo::count();
        $totalLecciones = Leccion::count();
        $totalUsuarios = Usuario::count();

        return view('admin.dashboard', compact('totalModulos', 'totalLecciones', 'totalUsuarios'));
    }
}