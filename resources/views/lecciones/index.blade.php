<!DOCTYPE html>
<html>
<head>
    <title>Lecciones</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .btn { padding: 5px 10px; margin: 2px; text-decoration: none; display: inline-block; border-radius: 3px; }
        .btn-success { background: #4CAF50; color: white; }
        .btn-warning { background: #ff9800; color: white; }
        .btn-danger { background: #f44336; color: white; }
        .btn-info { background: #2196F3; color: white; }
        .alert { padding: 10px; background: #4CAF50; color: white; margin-bottom: 20px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>Lecciones del Módulo: {{ $modulo->titulo }}</h1>
    
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif
    
    <a href="/modulos" class="btn btn-info">Volver a Módulos</a>
    <a href="/modulos/{{ $modulo->id }}/lecciones/create" class="btn btn-success">Nueva Lección</a>
    
    @if($lecciones->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lecciones as $leccion)
                <tr>
                    <td>{{ $leccion->orden }}</td>
                    <td>{{ $leccion->titulo }}</td>
                    <td>{{ $leccion->contenido }}</td>
                    <td>
                        <a href="/lecciones/{{ $leccion->id }}/edit" class="btn btn-warning">Editar</a>
                        <form action="/lecciones/{{ $leccion->id }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta lección?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay lecciones en este módulo.</p>
    @endif
</body>
</html>