<!DOCTYPE html>
<html>
<head>
    <title>Editar Módulo</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
        button { background: #2196F3; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px; }
        .cancelar { margin-left: 10px; color: #999; text-decoration: none; }
    </style>
</head>
<body>
    <a href="/admin/dashboard" style="background: #2c3e50; color: white; padding: 8px 16px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px;">🏠 Volver al Dashboard</a>
    <h1>Editar Módulo</h1>
    
    <form action="/modulos/{{ $modulo->id }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Título:</label>
            <input type="text" name="titulo" value="{{ $modulo->titulo }}" required>
        </div>
        
        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion" rows="5">{{ $modulo->descripcion }}</textarea>
        </div>
        
        <button type="submit">Actualizar</button>
        <a href="/modulos" class="cancelar">Cancelar</a>
    </form>
</body>
</html>