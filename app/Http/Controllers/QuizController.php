<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\ResultadoQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    // ── Mostrar quiz ────────────────────────────────────────────────
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

        // Verificar si ya hizo el quiz antes
        $intentoAnterior = ResultadoQuiz::where('usuario_id', $usuario->id)
            ->where('leccion_id', $leccion_id)
            ->first();

        return view('quiz.show', [
            'leccion'         => $leccion,
            'usuario'         => $usuario,
            'preguntasJson'   => $preguntasData->toJson(),
            'intentoAnterior' => $intentoAnterior,
        ]);
    }

    // ── Guardar resultado (permite reintentar) ──────────────────────
    public function guardar(Request $request)
    {
        $request->validate([
            'leccion_id' => 'required|integer',
            'correctas'  => 'required|integer|min:0',
            'total'      => 'required|integer|min:1',
            'xp_ganado'  => 'required|integer|min:0',
            'respuestas' => 'nullable|array',
        ]);

        $usuario   = Auth::user();
        $existente = ResultadoQuiz::where('usuario_id', $usuario->id)
            ->where('leccion_id', $request->leccion_id)
            ->first();

        $mejoro = false;

        if (!$existente) {
            // Primer intento
            ResultadoQuiz::create([
                'usuario_id' => $usuario->id,
                'leccion_id' => $request->leccion_id,
                'correctas'  => $request->correctas,
                'total'      => $request->total,
                'xp_ganado'  => $request->xp_ganado,
            ]);

            DB::table('usuarios')
                ->where('id', $usuario->id)
                ->increment('xp_total', $request->xp_ganado);

        } elseif ($request->correctas > $existente->correctas) {
            // Reintento con mejor puntaje
            $xpDif = max(0, $request->xp_ganado - $existente->xp_ganado);
            $existente->update([
                'correctas' => $request->correctas,
                'total'     => $request->total,
                'xp_ganado' => $request->xp_ganado,
            ]);

            if ($xpDif > 0) {
                DB::table('usuarios')
                    ->where('id', $usuario->id)
                    ->increment('xp_total', $xpDif);
            }

            $mejoro = true;
        }

        // Guardar datos en sesión
        session([
            'quiz_resultado' => [
                'correctas'  => $request->correctas,
                'total'      => $request->total,
                'xp_ganado'  => $request->xp_ganado,
                'leccion_id' => $request->leccion_id,
                'mejoro'     => $mejoro,
            ],
            'quiz_revision_' . $request->leccion_id => $request->respuestas ?? [],
        ]);

        return response()->json([
            'redirect' => route('quiz.resultado', $request->leccion_id)
        ]);
    }

    // ── Pantalla de resultados ──────────────────────────────────────
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
                'mejoro'     => false,
            ];
        }

        $porcentaje = round(($datos['correctas'] / $datos['total']) * 100);

        // Revisar si hay datos de revisión disponibles
        $tieneRevision = session()->has('quiz_revision_' . $leccion_id)
            && count(session('quiz_revision_' . $leccion_id, [])) > 0;

        session()->forget('quiz_resultado');

        return view('quiz.resultado', compact(
            'datos', 'leccion', 'porcentaje', 'tieneRevision'
        ));
    }

    // ── Vista de revisión ───────────────────────────────────────────
    public function revision($leccion_id)
    {
        $respuestasUsuario = session('quiz_revision_' . $leccion_id, []);
        $leccion           = DB::table('lecciones')->where('id', $leccion_id)->first();

        if (empty($respuestasUsuario)) {
            return redirect()->route('user.dashboard')
                ->with('error', 'No hay datos de revisión disponibles.');
        }

        $preguntas = Pregunta::with('opciones')
            ->where('leccion_id', $leccion_id)
            ->orderBy('id')
            ->get();

        // Mapear respuestas por pregunta_id para fácil acceso
        $mapaRespuestas = collect($respuestasUsuario)
            ->keyBy('pregunta_id');

        session()->forget('quiz_revision_' . $leccion_id);

        return view('quiz.revision', [
            'preguntas'      => $preguntas,
            'mapaRespuestas' => $mapaRespuestas,
            'leccion'        => $leccion,
        ]);
    }

    // ── Reintentar quiz ─────────────────────────────────────────────
    public function reintentar($leccion_id)
    {
        session()->forget('quiz_revision_' . $leccion_id);
        return redirect()->route('quiz.show', $leccion_id);
    }
}