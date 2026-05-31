<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx Academy — Resultados de Quizzes</title>
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

        /* Header / barra superior */
        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .logo-area h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
        }

        .logo-area span {
            background: linear-gradient(135deg, #15803D, #4ADE80);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Botón Volver al Dashboard */
        .btn-back {
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

        .btn-back:hover {
            background: #4ADE80;
            border-color: #4ADE80;
            color: #064E3B;
        }

        /* Título principal */
        .page-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        /* Filtros */
        .filtros {
            background: #FFFFFF;
            border-radius: 24px;
            border: 1px solid #E5E7EB;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .filtros form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1rem;
        }

        .filtros select {
            padding: 0.6rem 1rem;
            border-radius: 40px;
            border: 1px solid #E5E7EB;
            background: #F9FAFB;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            color: #374151;
            outline: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .filtros select:focus {
            border-color: #4ADE80;
            box-shadow: 0 0 0 2px rgba(74,222,128,0.2);
        }

        .filtros button {
            background: #4ADE80;
            color: #064E3B;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .filtros button:hover {
            background: #15803D;
            color: white;
        }

        .filtros a {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            color: #6B7280;
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .filtros a:hover {
            background: #F3F4F6;
            border-color: #D1D5DB;
            color: #374151;
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
            font-size: 0.85rem;
        }

        th {
            text-align: left;
            padding: 1rem 1rem;
            background: #F9FAFB;
            font-weight: 700;
            color: #374151;
            border-bottom: 1px solid #E5E7EB;
            font-family: 'Nunito', sans-serif;
        }

        td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid #F3F4F6;
            color: #4B5563;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #FEFCE8;
        }

        /* Badge para porcentaje */
        .porcentaje-badge {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .porcentaje-alto {
            background: #E8F5E9;
            color: #15803D;
        }

        .porcentaje-medio {
            background: #FEF3C7;
            color: #B45309;
        }

        .porcentaje-bajo {
            background: #FEE2E2;
            color: #B91C1C;
        }

        /* XP badge */
        .xp-badge {
            background: #F3E8FF;
            color: #7E22CE;
            padding: 0.2rem 0.6rem;
            border-radius: 40px;
            font-weight: 700;
            font-size: 0.75rem;
            display: inline-block;
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
            .filtros form {
                flex-direction: column;
                align-items: stretch;
            }
            .filtros select, .filtros button, .filtros a {
                width: 100%;
                justify-content: center;
            }
            th, td {
                padding: 0.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header con botón Volver al Dashboard -->
        <div class="header-bar">
            <div class="logo-area">
                <h1>Bitlyx <span>Academy</span></h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>

        <h1 class="page-title">Resultados de Quizzes</h1>

        <!-- Filtros (exactamente igual estructura) -->
        <div class="filtros">
            <form method="GET" action="">
                <select name="usuario_id">
                    <option value="">Todos los usuarios</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ request('usuario_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nombre }}
                        </option>
                    @endforeach
                </select>

                <select name="leccion_id">
                    <option value="">Todas las lecciones</option>
                    @foreach($lecciones as $leccion)
                        <option value="{{ $leccion->id }}" {{ request('leccion_id') == $leccion->id ? 'selected' : '' }}>
                            {{ $leccion->titulo }}
                        </option>
                    @endforeach
                </select>

                <button type="submit">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
                <a href="{{ route('admin.resultados_quiz.index') }}">
                    <i class="fas fa-eraser"></i> Limpiar
                </a>
            </form>
        </div>

        <!-- Tabla de resultados -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Lección</th>
                        <th>Correctas</th>
                        <th>Porcentaje</th>
                        <th>XP Ganado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resultados as $r)
                    @php
                        $porcentaje = round(($r->correctas / max($r->total, 1)) * 100);
                        $porcentajeClase = $porcentaje >= 70 ? 'porcentaje-alto' : ($porcentaje >= 40 ? 'porcentaje-medio' : 'porcentaje-bajo');
                    @endphp
                    <tr>
                        <td>{{ $r->usuario->nombre ?? 'N/A' }}</td>
                        <td>{{ $r->leccion->titulo ?? 'N/A' }}</td>
                        <td><strong>{{ $r->correctas }}</strong> / {{ $r->total }}</td>
                        <td>
                            <span class="porcentaje-badge {{ $porcentajeClase }}">
                                {{ $porcentaje }}%
                            </span>
                        </td>
                        <td>
                            <span class="xp-badge">
                                <i class="fas fa-star"></i> +{{ $r->xp_ganado }}
                            </span>
                        </td>
                        <td>{{ $r->fecha }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="pagination-wrapper">
            {{ $resultados->links() }}
        </div>
    </div>
</body>
</html>