<!DOCTYPE html>
<html>
<head>
    <title>Preguntas | Bitlyx Admin</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .header { background: #2c3e50; color: white; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #4CAF50; color: white; }
        .btn { padding: 6px 12px; margin: 2px; text-decoration: none; display: inline-block; border-radius: 4px; font-size: 13px; border: none; cursor: pointer; }
        .btn-success { background: #4CAF50; color: white; }
        .btn-warning { background: #ff9800; color: white; }
        .btn-danger  { background: #f44336; color: white; }
        .btn-admin   { background: #2c3e50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        .alert { padding: 10px; background: #4CAF50; color: white; margin-bottom: 15px; border-radius: 4px; }
        .filtro { background: white; padding: 16px; border-radius: 8px; margin-bottom: 16px; display: flex; gap: 12px; align-items: center; }
        select { padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; }
        .badge-correcta { background: #4CAF50; color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Gestión de Preguntas</h2>
        <a href="/admin/dashboard" class="btn-admin">🏠 Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="filtro">
        <form method="GET" action="{{ route('admin.preguntas.index') }}" style="display:flex;gap:10px;align-items:center;">
            <label><b>Filtrar por lección:</b></label>
            <select name="leccion_id" onchange="this.form.submit()">
                <option value="">-- Selecciona una lección --</option>
                @foreach($lecciones as $lec)
                    <option value="{{ $lec->id }}" {{ $leccion_id == $lec->id ? 'selected' : '' }}>
                        {{ $lec->titulo }}
                    </option>
                @endforeach
            </select>
        </form>
        @if($leccion_id)
            <a href="{{ route('admin.preguntas.create', ['leccion_id' => $leccion_id]) }}" class="btn btn-success">
                + Nueva Pregunta
            </a>
        @endif
    </div>

    @if($leccion_id)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Enunciado</th>
                    <th>XP</th>
                    <th>Opciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($preguntas as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->enunciado }}</td>
                    <td>{{ $p->xp }} XP</td>
                    <td>
                        @foreach($p->opciones as $op)
                            <div>
                                {{ $op->texto }}
                                @if($op->es_correcta)
                                    <span class="badge-correcta">✓ Correcta</span>
                                @endif
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.preguntas.edit', $p->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.preguntas.destroy', $p->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Eliminar esta pregunta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:#999;">No hay preguntas para esta lección.</td></tr>
                @endforelse
            </tbody>
        </table>
    @else
        <p style="color:#999;text-align:center;padding:40px;">Selecciona una lección para ver sus preguntas.</p>
    @endif
</body>
</html>