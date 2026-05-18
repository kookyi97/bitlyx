<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pregunta;
use App\Models\Opcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreguntaController extends Controller
{
    public function index(Request $request)
    {
        $leccion_id = $request->leccion_id;
        $lecciones  = DB::table('lecciones')->orderBy('id')->get();
        $preguntas  = $leccion_id
            ? Pregunta::with('opciones')->where('leccion_id', $leccion_id)->get()
            : collect();

        return view('admin.preguntas.index', compact('preguntas', 'lecciones', 'leccion_id'));
    }

    public function create(Request $request)
    {
        $lecciones  = DB::table('lecciones')->orderBy('id')->get();
        $leccion_id = $request->leccion_id;
        return view('admin.preguntas.create', compact('lecciones', 'leccion_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'leccion_id' => 'required|integer',
            'enunciado'  => 'required|string|max:500',
            'xp'         => 'required|integer|min:1|max:100',
            'opciones'   => 'required|array|size:4',
            'opciones.*' => 'required|string|max:255',
            'correcta'   => 'required|integer|between:0,3',
        ]);

        $pregunta = Pregunta::create([
            'leccion_id' => $request->leccion_id,
            'enunciado'  => $request->enunciado,
            'xp'         => $request->xp,
        ]);

        foreach ($request->opciones as $i => $texto) {
            Opcion::create([
                'pregunta_id' => $pregunta->id,
                'texto'       => $texto,
                'es_correcta' => ($i == $request->correcta) ? 1 : 0,
            ]);
        }

        return redirect()
            ->route('admin.preguntas.index', ['leccion_id' => $request->leccion_id])
            ->with('success', 'Pregunta creada correctamente.');
    }

    public function edit($id)
    {
        $pregunta  = Pregunta::with('opciones')->findOrFail($id);
        $lecciones = DB::table('lecciones')->orderBy('id')->get();
        return view('admin.preguntas.edit', compact('pregunta', 'lecciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'leccion_id' => 'required|integer',
            'enunciado'  => 'required|string|max:500',
            'xp'         => 'required|integer|min:1|max:100',
            'opciones'   => 'required|array|size:4',
            'opciones.*' => 'required|string|max:255',
            'correcta'   => 'required|integer|between:0,3',
        ]);

        $pregunta = Pregunta::findOrFail($id);
        $pregunta->update([
            'leccion_id' => $request->leccion_id,
            'enunciado'  => $request->enunciado,
            'xp'         => $request->xp,
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
            ->route('admin.preguntas.index', ['leccion_id' => $pregunta->leccion_id])
            ->with('success', 'Pregunta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $pregunta   = Pregunta::findOrFail($id);
        $leccion_id = $pregunta->leccion_id;
        Opcion::where('pregunta_id', $id)->delete();
        $pregunta->delete();

        return redirect()
            ->route('admin.preguntas.index', ['leccion_id' => $leccion_id])
            ->with('success', 'Pregunta eliminada.');
    }
}