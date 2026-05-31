<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResultadoQuiz;
use App\Models\Usuario;
use App\Models\Leccion;
use Illuminate\Http\Request;

class ResultadoQuizController extends Controller
{
    public function index(Request $request)
    {
        $query = ResultadoQuiz::with(['usuario', 'leccion']);

        if ($request->filled('usuario_id')) {
            $query->where('usuario_id', $request->usuario_id);
        }
        if ($request->filled('leccion_id')) {
            $query->where('leccion_id', $request->leccion_id);
        }

        $resultados = $query->paginate(10);
        $usuarios = Usuario::all();
        $lecciones = Leccion::all();

        return view('admin.resultados_quiz.index', compact('resultados', 'usuarios', 'lecciones'));
    }
}