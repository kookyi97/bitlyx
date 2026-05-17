<!DOCTYPE html>
<html>
<head>
    <title>Editar Lección</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea, input[type="number"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
        button { background: #2196F3; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px; }
        .cancelar { margin-left: 10px; color: #999; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Editar Lección: {{ $leccion->titulo }}</h1>
    
    <form action="/lecciones/{{ $leccion->id }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Título:</label>
            <input type="text" name="titulo" value="{{ $leccion->titulo }}" required>
        </div>
        
        <div class="form-group">
            <label>Orden:</label>
            <input type="number" name="orden" value="{{ $leccion->orden }}">
        </div>
        
        <div class="form-group">
            <label>Contenido:</label>
            <textarea name="contenido" rows="10">{{ $leccion->contenido }}</textarea>
        </div>
        
        <button type="submit">Actualizar</button>
        <a href="/modulos/{{ $leccion->modulo->id }}/lecciones" class="cancelar">Cancelar</a>
    </form>
</body>
</html>