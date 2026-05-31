<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalModulos = DB::table('modulos')->count();
        $totalLecciones = DB::table('lecciones')->count();
        $totalUsuarios = DB::table('usuarios')->count();

        return view('admin.dashboard', compact('totalModulos', 'totalLecciones', 'totalUsuarios'));
    }
}