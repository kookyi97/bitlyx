<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modulo;
use App\Models\Pregunta;
use App\Models\Opcion;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function index(Request $request)
    {
        $modulo_id = $request->modulo_id;
        $modulos   = Modulo::orderBy('id')->get();
        $preguntas = $modulo_id
            ? Pregunta::with('opciones')->where('modulo_id', $modulo_id)->get()
            : collect();

        return view('admin.preguntas.index', compact('preguntas', 'modulos', 'modulo_id'));
    }

    public function create(Request $request)
    {
        $modulos   = Modulo::orderBy('id')->get();
        $modulo_id = $request->modulo_id;
        return view('admin.preguntas.create', compact('modulos', 'modulo_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modulo_id'  => 'required|integer',
            'enunciado'  => 'required|string|max:500',
            'xp'         => 'required|integer|min:1|max:100',
            'opciones'   => 'required|array|size:4',
            'opciones.*' => 'required|string|max:255',
            'correcta'   => 'required|integer|between:0,3',
        ]);

        $pregunta = Pregunta::create([
            'modulo_id' => $request->modulo_id,
            'enunciado' => $request->enunciado,
            'xp'        => $request->xp,
        ]);

        foreach ($request->opciones as $i => $texto) {
            Opcion::create([
                'pregunta_id' => $pregunta->id,
                'texto'       => $texto,
                'es_correcta' => ($i == $request->correcta) ? 1 : 0,
            ]);
        }

        return redirect()
            ->route('admin.preguntas.index', ['modulo_id' => $request->modulo_id])
            ->with('success', 'Pregunta creada correctamente.');
    }

    public function edit($id)
    {
        $pregunta = Pregunta::with('opciones')->findOrFail($id);
        $modulos  = Modulo::orderBy('id')->get();
        return view('admin.preguntas.edit', compact('pregunta', 'modulos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'modulo_id'  => 'required|integer',
            'enunciado'  => 'required|string|max:500',
            'xp'         => 'required|integer|min:1|max:100',
            'opciones'   => 'required|array|size:4',
            'opciones.*' => 'required|string|max:255',
            'correcta'   => 'required|integer|between:0,3',
        ]);

        $pregunta = Pregunta::findOrFail($id);
        $pregunta->update([
            'modulo_id' => $request->modulo_id,
            'enunciado' => $request->enunciado,
            'xp'        => $request->xp,
        ]);

        Opcion::where('pregunta_id', $id)->delete();
        foreach ($request->opciones as $i => $texto) {
            Opcion::create([
                'pregunta_id' => $id,
                'texto'       => $texto,
                'es_correcta' => ($i == $request->correcta) ? 1 : 0,
            ]);
        }

        return redirect()
            ->route('admin.preguntas.index', ['modulo_id' => $pregunta->modulo_id])
            ->with('success', 'Pregunta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $pregunta  = Pregunta::findOrFail($id);
        $modulo_id = $pregunta->modulo_id;
        Opcion::where('pregunta_id', $id)->delete();
        $pregunta->delete();

        return redirect()
            ->route('admin.preguntas.index', ['modulo_id' => $modulo_id])
            ->with('success', 'Pregunta eliminada.');
    }
}
