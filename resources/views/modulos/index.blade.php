<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx Academy — Gestión de Módulos</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            -webkit-font-smoothing: antialiased;
        }

        /* ========= MAIN CONTENT FULL WIDTH ========= */
        .main-content {
            width: 100%;
            padding: 2rem;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .btn-admin {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            color: #374151;
            padding: 0.6rem 1.2rem;
            text-decoration: none;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn-admin:hover {
            background: #4ADE80;
            border-color: #4ADE80;
            color: #064E3B;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(74, 222, 128, 0.2);
        }

        .page-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #111827;
        }

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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .btn-new {
            background: #4ADE80;
            color: #064E3B;
            padding: 0.7rem 1.6rem;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            margin-bottom: 1.5rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(74, 222, 128, 0.2);
        }

        .btn-new:hover {
            background: #15803D;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.3);
        }

        .table-wrapper {
            background: #FFFFFF;
            border-radius: 24px;
            border: 1px solid #E5E7EB;
            overflow: hidden;
            overflow-x: auto;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            min-width: 900px;
        }

        th {
            text-align: left;
            padding: 1rem 1.2rem;
            background: #F9FAFB;
            font-weight: 700;
            color: #374151;
            border-bottom: 1px solid #E5E7EB;
            font-family: 'Nunito', sans-serif;
            white-space: nowrap;
        }

        td {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid #F3F4F6;
            color: #4B5563;
            vertical-align: middle;
        }

        .td-desc {
            max-width: 320px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #F9FAFB;
        }

        .btn-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-info {
            background: #E8F5E9;
            color: #15803D;
            padding: 0.45rem 1rem;
            border-radius: 40px;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-info:hover {
            background: #4ADE80;
            color: #064E3B;
            transform: translateY(-1px);
        }

        .btn-warning {
            background: #FEF3C7;
            color: #B45309;
            padding: 0.45rem 1rem;
            border-radius: 40px;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-warning:hover {
            background: #F59E0B;
            color: white;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #FEE2E2;
            color: #B91C1C;
            border: none;
            padding: 0.45rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-danger:hover {
            background: #DC2626;
            color: white;
            transform: translateY(-1px);
        }

        /* Badges de estado */
        .badge-publicado {
            background: #D1FAE5;
            color: #065F46;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .badge-borrador {
            background: #F3F4F6;
            color: #6B7280;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        /* Botones toggle */
        .btn-toggle-off {
            background: #FEF3C7;
            color: #B45309;
            border: none;
            padding: 0.45rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-toggle-off:hover {
            background: #F59E0B;
            color: white;
            transform: translateY(-1px);
        }

        .btn-toggle-on {
            background: #E8F5E9;
            color: #15803D;
            border: none;
            padding: 0.45rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-toggle-on:hover {
            background: #4ADE80;
            color: #064E3B;
            transform: translateY(-1px);
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

        /* Responsive */
        @media (max-width: 1024px) {
            .btn-actions {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 6px;
            }
            .btn-actions form {
                display: block;
                width: 100%;
            }
            .btn-actions button, .btn-actions a {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem 1rem;
            }
            th, td { 
                padding: 0.75rem 1rem; 
            }
            .header-bar { 
                flex-direction: column; 
                align-items: flex-start; 
            }
            .btn-admin { 
                width: 100%; 
                justify-content: center; 
            }
            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Formulario oculto para logout (sin botón visible) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <main class="main-content">
        <div class="container">

            <div class="header-bar">
                <h1 class="page-title">
                    <i class="fas fa-folder-tree" style="color: #4ADE80; margin-right: 10px;"></i>
                    Gestión de Módulos
                </h1>
                <a href="/admin/dashboard" class="btn-admin">
                    <i class="fas fa-arrow-left"></i> Volver al Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('modulos.create') }}" class="btn-new">
                <i class="fas fa-plus-circle"></i> Nuevo Módulo
            </a>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th style="width: 130px;">Estado</th>
                            <th style="width: 150px;">Lecciones</th>
                            <th style="width: 320px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modulos as $modulo)
                        <tr>
                            <td><strong>#{{ $modulo->id }}</strong></td>
                            <td><strong>{{ $modulo->titulo }}</strong></td>
                            <td>
                                <div class="td-desc" title="{{ $modulo->descripcion }}">
                                    {{ $modulo->descripcion }}
                                </div>
                            </td>

                            {{-- Badge de estado --}}
                            <td>
                                @if($modulo->estado === 'publicado')
                                    <span class="badge-publicado">
                                        <i class="fas fa-circle" style="font-size:0.4rem;"></i> Publicado
                                    </span>
                                @else
                                    <span class="badge-borrador">
                                        <i class="fas fa-circle" style="font-size:0.4rem;"></i> Borrador
                                    </span>
                                @endif
                            </td>

                            <td>
                                <a href="/modulos/{{ $modulo->id }}/lecciones" class="btn-info">
                                    <i class="fas fa-book-open"></i> Ver Lecciones
                                </a>
                            </td>

                            <td>
                                <div class="btn-actions">

                                    {{-- Botón Publicar / Despublicar --}}
                                    <form action="{{ route('modulos.toggleEstado', $modulo) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('PATCH')
                                        @if($modulo->estado === 'publicado')
                                            <button type="submit" class="btn-toggle-off">
                                                <i class="fas fa-eye-slash"></i> Despublicar
                                            </button>
                                        @else
                                            <button type="submit" class="btn-toggle-on">
                                                <i class="fas fa-eye"></i> Publicar
                                            </button>
                                        @endif
                                    </form>

                                    <a href="/modulos/{{ $modulo->id }}/edit" class="btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>

                                    <form action="/modulos/{{ $modulo->id }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger" onclick="return confirm('¿Eliminar este módulo?')">
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

            <div class="pagination-wrapper">
                {{ $modulos->links() }}
            </div>

        </div>
    </main>
</body>
</html>