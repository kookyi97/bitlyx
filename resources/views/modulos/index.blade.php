<!DOCTYPE html>
<html>
<head>
    <title>Módulos</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .btn { padding: 5px 10px; margin: 2px; text-decoration: none; display: inline-block; border-radius: 3px; }
        .btn-success { background: #4CAF50; color: white; border: none; cursor: pointer; }
        .btn-warning { background: #ff9800; color: white; }
        .btn-danger { background: #f44336; color: white; border: none; cursor: pointer; }
        .btn-info { background: #2196F3; color: white; }
        .alert { padding: 10px; background: #4CAF50; color: white; margin-bottom: 20px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>Gestión de Módulos</h1>
    
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif
    
    <a href="{{ route('modulos.create') }}" class="btn btn-success">+ Nuevo Módulo</a>
    
    @if(isset($modulos) && $modulos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Lecciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modulos as $modulo)
                <tr>
                    <td>{{ $modulo->id }}</td>
                    <td>{{ $modulo->titulo }}</td>
                    <td>{{ $modulo->descripcion }}</td>
                    <td>
                        <a href="/modulos/{{ $modulo->id }}/lecciones" class="btn btn-info">Ver Lecciones</a>
                    </td>
                    <td>
                        <a href="{{ route('modulos.edit', $modulo) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('modulos.destroy', $modulo) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este módulo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay módulos registrados.</p>
    @endif
</body>
</html>