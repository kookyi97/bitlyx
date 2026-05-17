<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Leccion;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalModulos = Modulo::count();
        $totalLecciones = Leccion::count();
        $totalUsuarios = User::count();

        return view('admin.dashboard', compact('totalModulos', 'totalLecciones', 'totalUsuarios'));
    }
}