<!DOCTYPE html>
<html>
<head>
    <title>Nueva Lección</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea, input[type="number"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px; }
        .cancelar { margin-left: 10px; color: #999; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Nueva Lección para: {{ $modulo->titulo }}</h1>
    
    <form action="{{ route('lecciones.store', $modulo) }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Título:</label>
            <input type="text" name="titulo" required maxlength="150">
        </div>
        
        <div class="form-group">
            <label>Orden:</label>
            <input type="number" name="orden" value="0">
        </div>
        
        <div class="form-group">
            <label>Contenido:</label>
            <textarea name="contenido" rows="10"></textarea>
        </div>
        
        <button type="submit">Guardar</button>
        <a href="{{ route('lecciones.index', $modulo) }}" class="cancelar">Cancelar</a>
    </form>
</body>
</html>