<!DOCTYPE html>
<html>
<head>
    <title>Editar Pregunta | Bitlyx Admin</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .card { background: white; padding: 28px; border-radius: 8px; max-width: 700px; margin: 0 auto; }
        h2 { margin-bottom: 24px; color: #2c3e50; }
        label { display: block; font-weight: bold; margin-bottom: 4px; margin-top: 14px; }
        input, select, textarea { width: 100%; padding: 9px 12px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; font-size: 14px; }
        .opcion-row { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
        .opcion-row input[type="text"] { flex: 1; }
        .opcion-row input[type="radio"] { width: auto; }
        .btn-submit { background: #ff9800; color: white; padding: 10px 24px; border: none; border-radius: 5px; cursor: pointer; font-size: 15px; margin-top: 20px; }
        .btn-back { color: #2196F3; text-decoration: none; display: inline-block; margin-bottom: 16px; }
        .hint { font-weight: normal; color: #666; font-size: 13px; }
    </style>
</head>
<body>
<div class="card">
    <a href="{{ route('admin.preguntas.index', ['leccion_id' => $pregunta->leccion_id]) }}" class="btn-back">← Volver</a>
    <h2>Editar Pregunta</h2>

    @if($errors->any())
        <div style="color:#f44336;margin-bottom:12px;">
            @foreach($errors->all() as $e) <div>• {{ $e }}</div> @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.preguntas.update', $pregunta->id) }}">
        @csrf @method('PUT')

        <label>Lección</label>
        <select name="leccion_id">
            @foreach($lecciones as $lec)
                <option value="{{ $lec->id }}" {{ $pregunta->leccion_id == $lec->id ? 'selected' : '' }}>
                    {{ $lec->titulo }}
                </option>
            @endforeach
        </select>

        <label>Enunciado</label>
        <textarea name="enunciado" rows="3" required>{{ old('enunciado', $pregunta->enunciado) }}</textarea>

        <label>XP por respuesta correcta</label>
        <input type="number" name="xp" value="{{ old('xp', $pregunta->xp) }}" min="1" max="100">

        <label style="margin-top:20px;">
            Opciones
            <span class="hint"> — marca el radio de la correcta</span>
        </label>

        @foreach($pregunta->opciones->values() as $i => $opcion)
        <div class="opcion-row">
            <input type="radio" name="correcta" value="{{ $i }}"
                {{ $opcion->es_correcta ? 'checked' : '' }} required>
            <input type="text" name="opciones[{{ $i }}]"
                value="{{ old('opciones.'.$i, $opcion->texto) }}" required>
        </div>
        @endforeach

        <button type="submit" class="btn-submit">Actualizar Pregunta</button>
    </form>
</div>
</body>
</html>