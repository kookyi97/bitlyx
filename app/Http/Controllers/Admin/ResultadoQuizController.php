<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResultadoQuiz;
use App\Models\Usuario;
use App\Models\Modulo;
use Illuminate\Http\Request;

class ResultadoQuizController extends Controller
{
    public function index(Request $request)
    {
        $query = ResultadoQuiz::with(['usuario', 'modulo']);

        if ($request->filled('usuario_id')) {
            $query->where('usuario_id', $request->usuario_id);
        }
        if ($request->filled('modulo_id')) {
            $query->where('modulo_id', $request->modulo_id);
        }

        $resultados = $query->orderByDesc('id')->paginate(15);
        $usuarios   = Usuario::orderBy('nombre')->get();
        $modulos    = Modulo::orderBy('id')->get();

        $totalResultados = ResultadoQuiz::count();
        $totalAprobados  = ResultadoQuiz::whereRaw('correctas/total >= 0.7')->count();
        $xpPromedio      = round(ResultadoQuiz::avg('xp_ganado') ?? 0);

        return view('admin.resultados_quiz.index', compact(
            'resultados', 'usuarios', 'modulos',
            'totalResultados', 'totalAprobados', 'xpPromedio'
        ));
    }
}