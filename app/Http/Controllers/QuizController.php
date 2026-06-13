<?php

namespace App\Http\Controllers;

use App\Models\IntentoQuiz;
use App\Models\Modulo;
use App\Models\Pregunta;
use App\Models\ProgresoUsuario;
use App\Models\ResultadoQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    // ── Mostrar quiz del módulo ───────────────────────────────────
    public function show($modulo_id)
    {
        $usuario = Auth::user();
        $modulo  = Modulo::with('lecciones')->findOrFail($modulo_id);

        // Verificar que completó todas las lecciones
        $leccionesIds   = $modulo->lecciones->pluck('id');
        $totalLecciones = $leccionesIds->count();

        if ($totalLecciones === 0) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Este módulo no tiene lecciones todavía.');
        }

        $completadas = ProgresoUsuario::where('usuario_id', $usuario->id)
            ->whereIn('leccion_id', $leccionesIds)
            ->where('completada', 1)
            ->count();

        if ($completadas < $totalLecciones) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Debes completar todas las lecciones del módulo antes de hacer el quiz.');
        }

        // Cargar preguntas del módulo
            $preguntas = Pregunta::with('opciones')
                ->where('modulo_id', $modulo_id)
                ->get()
                ->shuffle();

        if ($preguntas->isEmpty()) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Este módulo no tiene preguntas en el quiz todavía.');
        }

        $preguntasData = $preguntas->map(fn($p) => [
            'id'       => $p->id,
            'enunciado'=> $p->enunciado,
            'xp'       => $p->xp,
            'opciones' => $p->opciones->shuffle()->map(fn($o) => [
                'id'          => $o->id,
                'texto'       => $o->texto,
                'es_correcta' => (bool) $o->es_correcta,
            ])->values(),
        ])->values();

        $intentoAnterior = ResultadoQuiz::where('usuario_id', $usuario->id)
            ->where('modulo_id', $modulo_id)
            ->first();

        return view('quiz.show', [
            'modulo'          => $modulo,
            'usuario'         => $usuario,
            'preguntasJson'   => $preguntasData->toJson(),
            'intentoAnterior' => $intentoAnterior,
        ]);
    }

    // ── Guardar resultado ─────────────────────────────────────────
    public function guardar(Request $request)
    {
        $request->validate([
            'modulo_id'  => 'required|integer',
            'correctas'  => 'required|integer|min:0',
            'total'      => 'required|integer|min:1',
            'xp_ganado'  => 'required|integer|min:0',
            'respuestas' => 'nullable|array',
        ]);

        $usuario = Auth::user();

        // 1. Siempre registrar el intento
        IntentoQuiz::create([
            'usuario_id' => $usuario->id,
            'modulo_id'  => $request->modulo_id,
            'correctas'  => $request->correctas,
            'total'      => $request->total,
            'xp_ganado'  => $request->xp_ganado,
        ]);

        // 2. Actualizar mejor resultado y XP
        $existente = ResultadoQuiz::where('usuario_id', $usuario->id)
            ->where('modulo_id', $request->modulo_id)
            ->first();

        $mejoro = false;

        if (!$existente) {
            ResultadoQuiz::create([
                'usuario_id' => $usuario->id,
                'modulo_id'  => $request->modulo_id,
                'correctas'  => $request->correctas,
                'total'      => $request->total,
                'xp_ganado'  => $request->xp_ganado,
            ]);
            DB::table('usuarios')->where('id', $usuario->id)->increment('xp_total', $request->xp_ganado);

        } elseif ($request->correctas > $existente->correctas) {
            $xpDif = max(0, $request->xp_ganado - $existente->xp_ganado);
            $existente->update([
                'correctas' => $request->correctas,
                'total'     => $request->total,
                'xp_ganado' => $request->xp_ganado,
            ]);
            if ($xpDif > 0) {
                DB::table('usuarios')->where('id', $usuario->id)->increment('xp_total', $xpDif);
            }
            $mejoro = true;
        }

        // 3. Guardar en sesión para revisión
        session([
            'quiz_resultado' => [
                'correctas'  => $request->correctas,
                'total'      => $request->total,
                'xp_ganado'  => $request->xp_ganado,
                'modulo_id'  => $request->modulo_id,
                'mejoro'     => $mejoro,
            ],
            'quiz_revision_' . $request->modulo_id => $request->respuestas ?? [],
        ]);

        return response()->json([
            'redirect' => route('quiz.resultado', $request->modulo_id)
        ]);
    }

    // ── Resultado ─────────────────────────────────────────────────
    public function resultado($modulo_id)
    {
        $datos  = session('quiz_resultado');
        $modulo = Modulo::findOrFail($modulo_id);

        if (!$datos) {
            $resultado = ResultadoQuiz::where('usuario_id', Auth::id())
                ->where('modulo_id', $modulo_id)
                ->latest('id')->first();

            if (!$resultado) return redirect()->route('user.dashboard');

            $datos = [
                'correctas' => $resultado->correctas,
                'total'     => $resultado->total,
                'xp_ganado' => $resultado->xp_ganado,
                'modulo_id' => $modulo_id,
                'mejoro'    => false,
            ];
        }

        $porcentaje    = round(($datos['correctas'] / $datos['total']) * 100);
        $tieneRevision = session()->has('quiz_revision_' . $modulo_id)
            && count(session('quiz_revision_' . $modulo_id, [])) > 0;

        $intentos = IntentoQuiz::where('usuario_id', Auth::id())
            ->where('modulo_id', $modulo_id)
            ->orderByDesc('id')->take(5)->get();

        session()->forget('quiz_resultado');

        return view('quiz.resultado', compact(
            'datos', 'modulo', 'porcentaje', 'tieneRevision', 'intentos'
        ));
    }

    // ── Revisión ──────────────────────────────────────────────────
    public function revision($modulo_id)
    {
        $respuestasUsuario = session('quiz_revision_' . $modulo_id, []);
        $modulo            = Modulo::findOrFail($modulo_id);

        if (empty($respuestasUsuario)) {
            return redirect()->route('user.dashboard')
                ->with('error', 'No hay datos de revisión disponibles.');
        }

        $preguntas      = Pregunta::with('opciones')->where('modulo_id', $modulo_id)->orderBy('id')->get();
        $mapaRespuestas = collect($respuestasUsuario)->keyBy('pregunta_id');

        session()->forget('quiz_revision_' . $modulo_id);

        return view('quiz.revision', [
            'preguntas'      => $preguntas,
            'mapaRespuestas' => $mapaRespuestas,
            'modulo'         => $modulo,
        ]);
    }

    // ── Reintentar ────────────────────────────────────────────────
    public function reintentar($modulo_id)
    {
        session()->forget('quiz_revision_' . $modulo_id);
        return redirect()->route('quiz.show', $modulo_id);
    }
}
