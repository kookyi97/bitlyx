<?php
namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\ResultadoQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function show($leccion_id)
    {
        $preguntas = Pregunta::with('opciones')
            ->where('leccion_id', $leccion_id)
            ->orderBy('id')
            ->get();

        if ($preguntas->isEmpty()) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Esta lección no tiene preguntas todavía.');
        }

        $leccion = DB::table('lecciones')->where('id', $leccion_id)->first();
        $usuario = Auth::user();

        $preguntasData = $preguntas->map(fn($p) => [
            'id'        => $p->id,
            'enunciado' => $p->enunciado,
            'xp'        => $p->xp,
            'opciones'  => $p->opciones->map(fn($o) => [
                'id'          => $o->id,
                'texto'       => $o->texto,
                'es_correcta' => (bool) $o->es_correcta,
            ])->values(),
        ])->values();

        return view('quiz.show', [
            'leccion'       => $leccion,
            'usuario'       => $usuario,
            'preguntasJson' => $preguntasData->toJson(),
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'leccion_id' => 'required|integer',
            'correctas'  => 'required|integer|min:0',
            'total'      => 'required|integer|min:1',
            'xp_ganado'  => 'required|integer|min:0',
        ]);

        $usuario    = Auth::user();
        $yaGuardado = ResultadoQuiz::where('usuario_id', $usuario->id)
            ->where('leccion_id', $request->leccion_id)
            ->exists();

        if (!$yaGuardado) {
            ResultadoQuiz::create([
                'usuario_id' => $usuario->id,
                'leccion_id' => $request->leccion_id,
                'correctas'  => $request->correctas,
                'total'      => $request->total,
                'xp_ganado'  => $request->xp_ganado,
            ]);

            // Sumar XP al usuario
            DB::table('usuarios')
                ->where('id', $usuario->id)
                ->increment('xp_total', $request->xp_ganado);
        }

        session([
            'quiz_resultado' => [
                'correctas'  => $request->correctas,
                'total'      => $request->total,
                'xp_ganado'  => $request->xp_ganado,
                'leccion_id' => $request->leccion_id,
            ]
        ]);

        return response()->json([
            'redirect' => route('quiz.resultado', $request->leccion_id)
        ]);
    }

    public function resultado($leccion_id)
    {
        $datos   = session('quiz_resultado');
        $leccion = DB::table('lecciones')->where('id', $leccion_id)->first();

        if (!$datos) {
            $resultado = ResultadoQuiz::where('usuario_id', Auth::id())
                ->where('leccion_id', $leccion_id)
                ->latest('id')->first();

            if (!$resultado) {
                return redirect()->route('user.dashboard');
            }

            $datos = [
                'correctas'  => $resultado->correctas,
                'total'      => $resultado->total,
                'xp_ganado'  => $resultado->xp_ganado,
                'leccion_id' => $leccion_id,
            ];
        }

        $porcentaje = round(($datos['correctas'] / $datos['total']) * 100);
        session()->forget('quiz_resultado');

        return view('quiz.resultado', compact('datos', 'leccion', 'porcentaje'));
    }
}