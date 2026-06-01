<?php

namespace App\Http\Controllers;

use App\Models\ResultadoQuiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
    public function historial()
    {
        $usuario  = Auth::user();
        $historial = ResultadoQuiz::where('usuario_id', $usuario->id)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($r) {
                $leccion = DB::table('lecciones')->where('id', $r->leccion_id)->first();
                return [
                    'id'          => $r->id,
                    'leccion_id'  => $r->leccion_id,
                    'leccion'     => $leccion->titulo ?? 'Lección eliminada',
                    'correctas'   => $r->correctas,
                    'total'       => $r->total,
                    'xp_ganado'   => $r->xp_ganado,
                    'porcentaje'  => $r->total > 0
                        ? round(($r->correctas / $r->total) * 100) : 0,
                ];
            });

        return view('user.historial', [
            'historial' => $historial,
            'usuario'   => $usuario,
        ]);
    }

    public function leaderboard()
    {
        $usuario = Auth::user();

        $ranking = DB::table('usuarios')
            ->select('id', 'nombre', 'xp_total')
            ->where('activo', 1)
            ->orderBy('xp_total', 'desc')
            ->take(10)
            ->get()
            ->map(function ($u, $i) use ($usuario) {
                return [
                    'posicion'  => $i + 1,
                    'nombre'    => $u->nombre,
                    'xp_total'  => $u->xp_total,
                    'es_yo'     => $u->id === $usuario->id,
                ];
            });

        return view('user.leaderboard', [
            'ranking' => $ranking,
            'usuario' => $usuario,
        ]);
    }
}