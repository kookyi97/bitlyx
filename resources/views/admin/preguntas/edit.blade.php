<!DOCTYPE html>
<html>
<head>
    <title>Editar Pregunta</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
        button { background: #2196F3; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px; }
        .btn-primary { background: #2196F3; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px; display: inline-block; }
    </style>
</head>
<body>
    <h1>Editar Pregunta</h1>
    <a href="{{ route('admin.preguntas.index') }}" class="btn-primary">Volver</a>

    <form method="POST" action="{{ route('admin.preguntas.update', $pregunta->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Lección ID:</label>
            <input type="number" name="leccion_id" value="{{ $pregunta->leccion_id }}" required>
        </div>
        <div class="form-group">
            <label>Enunciado:</label>
            <textarea name="enunciado" rows="5" required>{{ $pregunta->enunciado }}</textarea>
        </div>
        <div class="form-group">
            <label>XP:</label>
            <input type="number" name="xp" value="{{ $pregunta->xp }}" required>
        </div>
        <h3>Opciones</h3>
        @foreach($pregunta->opciones as $index => $opcion)
        <div class="form-group">
            <label>Opción {{ $index+1 }}:</label>
            <input type="text" name="opciones[]" value="{{ $opcion->texto }}" required>
        </div>
        @endforeach
        <div class="form-group">
            <label>Correcta (0-3):</label>
            <input type="number" name="correcta" min="0" max="3" required>
        </div>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>