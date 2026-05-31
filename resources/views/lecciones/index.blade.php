<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx Academy — Lecciones del Módulo</title>
    <!-- Google Fonts: Nunito + Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Nunito', sans-serif;
            background: #F3F4F6;
            color: #111827;
            line-height: 1.5;
            padding: 2rem;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header con info del módulo */
        .module-header {
            background: #FFFFFF;
            border-radius: 28px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            border: 1px solid #E5E7EB;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .module-header h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .module-badge {
            display: inline-block;
            background: #E8F5E9;
            color: #15803D;
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Botones de acción (Volver, Nueva Lección) */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.8rem;
            flex-wrap: wrap;
        }

        .btn-info {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            color: #374151;
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-info:hover {
            background: #4ADE80;
            border-color: #4ADE80;
            color: #064E3B;
        }

        .btn-success {
            background: #4ADE80;
            color: #064E3B;
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-success:hover {
            background: #15803D;
            color: white;
            transform: scale(0.98);
        }

        /* Alertas */
        .alert {
            background: #E8F5E9;
            border-left: 4px solid #4ADE80;
            color: #15803D;
            padding: 1rem 1.2rem;
            border-radius: 16px;
            margin-bottom: 1.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Tabla moderna */
        .table-wrapper {
            background: #FFFFFF;
            border-radius: 24px;
            border: 1px solid #E5E7EB;
            overflow-x: auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        th {
            text-align: left;
            padding: 1rem 1.2rem;
            background: #F9FAFB;
            font-weight: 700;
            color: #374151;
            border-bottom: 1px solid #E5E7EB;
            font-family: 'Nunito', sans-serif;
        }

        td {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid #F3F4F6;
            color: #4B5563;
            vertical-align: top;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #FEFCE8;
        }

        /* Columna de contenido con límite de ancho */
        .contenido-cell {
            max-width: 300px;
            white-space: pre-wrap;
            word-break: break-word;
        }

        /* Botones de acción dentro de la tabla */
        .btn-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-warning {
            background: #FEF3C7;
            color: #B45309;
            padding: 0.4rem 1rem;
            border-radius: 40px;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-warning:hover {
            background: #F59E0B;
            color: white;
        }

        .btn-danger {
            background: #FEE2E2;
            color: #B91C1C;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-danger:hover {
            background: #DC2626;
            color: white;
        }

        /* Mensaje cuando no hay lecciones */
        .empty-message {
            background: #FFFFFF;
            border-radius: 24px;
            padding: 3rem;
            text-align: center;
            border: 1px solid #E5E7EB;
            color: #6B7280;
        }

        .empty-message i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #D1D5DB;
        }

        /* Paginación */
        .pagination-wrapper {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }
        .pagination a, .pagination span {
            padding: 0.5rem 1rem;
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 40px;
            text-decoration: none;
            color: #374151;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        .pagination a:hover {
            background: #4ADE80;
            border-color: #4ADE80;
            color: #064E3B;
        }
        .pagination .active span {
            background: #15803D;
            color: white;
            border-color: #15803D;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            th, td {
                padding: 0.75rem;
            }
            .contenido-cell {
                max-width: 180px;
            }
            .btn-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabecera con información del módulo -->
        <div class="module-header">
            <h1>Lecciones del Módulo: {{ $modulo->titulo }}</h1>
            <span class="module-badge">
                <i class="fas fa-folder-open"></i> ID Módulo: {{ $modulo->id }}
            </span>
        </div>

        @if(session('success'))
            <div class="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Botones de acción originales -->
        <div class="action-buttons">
            <a href="/modulos" class="btn-info">
                <i class="fas fa-arrow-left"></i> Volver a Módulos
            </a>
            <a href="/modulos/{{ $modulo->id }}/lecciones/create" class="btn-success">
                <i class="fas fa-plus-circle"></i> Nueva Lección
            </a>
        </div>

        @if($lecciones->count() > 0)
            <div class="table-wrapper">
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
                            <td style="width: 80px;">{{ $leccion->orden }}</td>
                            <td><strong>{{ $leccion->titulo }}</strong></td>
                            <td class="contenido-cell">{{ $leccion->contenido }}</td>
                            <td style="width: 180px;">
                                <div class="btn-actions">
                                    <a href="/lecciones/{{ $leccion->id }}/edit" class="btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="/lecciones/{{ $leccion->id }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger" onclick="return confirm('¿Eliminar esta lección?')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="pagination-wrapper">
                {{ $lecciones->links() }}
            </div>
        @else
            <div class="empty-message">
                <i class="fas fa-book-open"></i>
                <p>No hay lecciones en este módulo.</p>
                <a href="/modulos/{{ $modulo->id }}/lecciones/create" class="btn-success" style="margin-top: 1rem; display: inline-block;">
                    <i class="fas fa-plus-circle"></i> Crear primera lección
                </a>
            </div>
        @endif
    </div>
</body>
</html>