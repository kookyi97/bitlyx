<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx - Mi Aprendizaje</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: #f5f7fa;
            color: #1a2a3a;
        }

        /* Header / Navbar */
        .header {
            background: white;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #1a56db;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            font-weight: 500;
        }

        .logout-btn {
            background: #dc2626;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        /* Contenedor principal */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Tarjetas de estadísticas */
        .stats-container {
            display: flex;
            gap: 24px;
            margin-bottom: 48px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            flex: 1;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #eef2f6;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #1a2a3a;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: #6c757d;
            font-weight: 500;
        }

        /* Sección de módulos */
        .section-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .modulo-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #eef2f6;
        }

        .modulo-header {
            margin-bottom: 20px;
        }

        .modulo-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .modulo-description {
            font-size: 14px;
            color: #6c757d;
        }

        .lecciones-count {
            font-size: 13px;
            color: #1a56db;
            margin-top: 8px;
        }

        .lecciones-list {
            margin: 16px 0;
        }

        .leccion-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #f0f2f5;
        }

        .leccion-item:last-child {
            border-bottom: none;
        }

        .leccion-check {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .leccion-check.completed {
            background: #059669;
            color: white;
        }

        .leccion-check.pending {
            border: 2px solid #cbd5e1;
            background: white;
        }

        .leccion-name {
            font-size: 14px;
            flex: 1;
        }

        .modulo-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #eef2f6;
        }

        .modulo-progress {
            font-size: 14px;
            font-weight: 600;
            color: #1a56db;
        }

        .start-btn {
            background: #1a56db;
            color: white;
            padding: 8px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .start-btn:hover {
            background: #0e3a8a;
        }

        .start-btn.disabled {
            background: #cbd5e1;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .stats-container {
                flex-direction: column;
            }
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
    <div class="logo">Bitlyx</div>
    <div class="user-menu">
        <div class="xp-display">
            <span class="xp-icon">⭐</span>
            <span class="xp-value">{{ Auth::user()->xp_total ?? 0 }} XP</span>
        </div>
        <span class="user-name">{{ Auth::user()->nombre ?? Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="logout-btn">Cerrar sesión</button>
        </form>
    </div>
</div>

    <div class="container">
        <!-- Tarjetas de estadísticas -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number">{{ $leccionesCompletadasGlobal ?? 0 }} / {{ $totalLeccionesGenerales ?? 0 }}</div>
                <div class="stat-label">Lecciones</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ Auth::user()->xp_total ?? 0 }}</div>
                <div class="stat-label">Puntos XP</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $porcentajeGlobal ?? 0 }}%</div>
                <div class="stat-label">Progreso global</div>
            </div>
        </div>

        <!-- Módulos disponibles -->
        <div class="section-title">Mis módulos</div>

        @foreach($modulos as $modulo)
        <div class="modulo-card">
            <div class="modulo-header">
                <div class="modulo-title">{{ $modulo->titulo }}</div>
                <div class="modulo-description">{{ $modulo->descripcion }}</div>
                <div class="lecciones-count">{{ $modulo->lecciones->count() }} lecciones</div>
            </div>

            <div class="lecciones-list">
                @foreach($modulo->lecciones as $leccion)
                <div class="leccion-item">
                    <div class="leccion-check {{ isset($progresos[$modulo->id]['completadas'][$leccion->id]) && $progresos[$modulo->id]['completadas'][$leccion->id] ? 'completed' : 'pending' }}">
                        @if(isset($progresos[$modulo->id]['completadas'][$leccion->id]) && $progresos[$modulo->id]['completadas'][$leccion->id])
                            ✓
                        @endif
                    </div>
                    <div class="leccion-name">{{ $leccion->titulo }}</div>
                </div>
                @endforeach
            </div>

            <div class="modulo-footer">
                <div class="modulo-progress">{{ $progresos[$modulo->id]['porcentaje'] ?? 0 }}%</div>
                @if(isset($progresos[$modulo->id]['primeraLeccion']))
                    <a href="{{ route('leccion.show', $progresos[$modulo->id]['primeraLeccion']) }}" class="start-btn">Comenzar módulo</a>
                @else
                    <span class="start-btn disabled">Próximamente</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>