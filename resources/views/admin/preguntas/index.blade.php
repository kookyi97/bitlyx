<!DOCTYPE html>
<html>
<head>
    <title>Gestionar Preguntas</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .btn { padding: 5px 10px; margin: 2px; text-decoration: none; border-radius: 3px; display: inline-block; }
        .btn-success { background: #4CAF50; color: white; }
        .btn-warning { background: #ff9800; color: white; }
        .btn-danger { background: #f44336; color: white; }
        .btn-primary { background: #2196F3; color: white; }
    </style>
</head>
<body>
    <h1>Gestionar Preguntas</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Volver al Dashboard</a>
    <a href="{{ route('admin.preguntas.create') }}" class="btn btn-success">Nueva Pregunta</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Enunciado</th>
                <th>Lección</th>
                <th>XP</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($preguntas as $pregunta)
            <tr>
                <td>{{ $pregunta->id }}</td>
                <td>{{ $pregunta->enunciado }}</td>
                <td>{{ $pregunta->leccion_id }}</td>
                <td>{{ $pregunta->xp }}</td>
                <td>
                    <a href="{{ route('admin.preguntas.edit', $pregunta->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.preguntas.destroy', $pregunta->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>