<!DOCTYPE html>
<html>
<head>
    <title>Nueva Pregunta</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px; }
        .btn-primary { background: #2196F3; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px; display: inline-block; }
    </style>
</head>
<body>
    <h1>Nueva Pregunta</h1>
    <a href="{{ route('admin.preguntas.index') }}" class="btn-primary">Volver</a>

    <form method="POST" action="{{ route('admin.preguntas.store') }}">
        @csrf
        <div class="form-group">
            <label>Lección ID:</label>
            <input type="number" name="leccion_id" required>
        </div>
        <div class="form-group">
            <label>Enunciado:</label>
            <textarea name="enunciado" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label>XP:</label>
            <input type="number" name="xp" value="10" required>
        </div>
        <h3>Opciones</h3>
        <div class="form-group">
            <label>Opción 1:</label>
            <input type="text" name="opciones[]" required>
        </div>
        <div class="form-group">
            <label>Opción 2:</label>
            <input type="text" name="opciones[]" required>
        </div>
        <div class="form-group">
            <label>Opción 3:</label>
            <input type="text" name="opciones[]" required>
        </div>
        <div class="form-group">
            <label>Opción 4:</label>
            <input type="text" name="opciones[]" required>
        </div>
        <div class="form-group">
            <label>Correcta (0-3):</label>
            <input type="number" name="correcta" min="0" max="3" required>
        </div>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>