<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx Academy — Mi Aprendizaje</title>
    <!-- Google Fonts: Nunito + Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 (íconos sutiles) -->
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
        }

        /* Header / Navbar — estilo Bitlyx */
        .header {
            background: #FFFFFF;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #E5E7EB;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .logo {
            font-family: 'Nunito', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, #15803D 0%, #4ADE80 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .xp-display {
            background: #E8F5E9;
            padding: 0.4rem 1rem;
            border-radius: 40px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #15803D;
        }

        .xp-icon {
            font-size: 1rem;
        }

        .xp-value {
            font-weight: 700;
        }

        .user-name {
            font-weight: 500;
            color: #374151;
        }

        .logout-btn {
            background: none;
            border: 1px solid #E5E7EB;
            color: #6B7280;
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .logout-btn:hover {
            background: #4ADE80;
            border-color: #4ADE80;
            color: #064E3B;
        }

        /* Contenedor principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* Tarjetas de estadísticas — estilo clean cards */
        .stats-container {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .stat-card {
            background: #FFFFFF;
            border-radius: 28px;
            padding: 1.5rem;
            flex: 1;
            min-width: 160px;
            text-align: center;
            border: 1px solid #E5E7EB;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02), 0 1px 2px rgba(0, 0, 0, 0.03);
            transition: all 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: #D1D5DB;
            box-shadow: 0 12px 20px -12px rgba(0, 0, 0, 0.08);
        }

        .stat-number {
            font-family: 'Nunito', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6B7280;
        }

        /* Módulos */
        .section-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.65rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .section-title:before {
            content: "📚";
            font-size: 1.6rem;
        }

        .modulo-card {
            background: #FFFFFF;
            border-radius: 28px;
            padding: 1.5rem;
            margin-bottom: 1.8rem;
            border: 1px solid #E5E7EB;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            transition: all 0.2s;
        }

        .modulo-header {
            margin-bottom: 1.2rem;
        }

        .modulo-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.4rem;
        }

        .modulo-description {
            font-size: 0.9rem;
            color: #6B7280;
            line-height: 1.4;
        }

        .lecciones-count {
            font-size: 0.75rem;
            font-weight: 600;
            color: #4ADE80;
            background: #E8F5E9;
            display: inline-block;
            padding: 0.2rem 0.8rem;
            border-radius: 40px;
            margin-top: 0.6rem;
        }

        /* Lista de lecciones */
        .lecciones-list {
            margin: 1.2rem 0;
            background: #F9FAFB;
            border-radius: 20px;
            padding: 0.2rem 0;
        }

        .leccion-item {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #EEF2F6;
        }
        .leccion-item:last-child {
            border-bottom: none;
        }

        .leccion-check {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .leccion-check.completed {
            background: #4ADE80;
            color: #064E3B;
        }

        .leccion-check.pending {
            border: 2px solid #D1D5DB;
            background: white;
        }

        .leccion-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: #1F2937;
            flex: 1;
        }

        .modulo-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #E5E7EB;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .modulo-progress {
            font-size: 0.9rem;
            font-weight: 800;
            background: #E8F5E9;
            padding: 0.3rem 1rem;
            border-radius: 40px;
            color: #15803D;
        }

        .start-btn {
            background: #4ADE80;
            color: #064E3B;
            padding: 0.6rem 1.6rem;
            border-radius: 40px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            transition: all 0.2s;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .start-btn:hover {
            background: #15803D;
            color: white;
            transform: scale(0.97);
        }

        .start-btn.disabled {
            background: #E5E7EB;
            color: #9CA3AF;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }
            .container {
                padding: 1.5rem;
            }
            .stats-container {
                flex-direction: column;
            }
            .modulo-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Bitlyx Academy</div>
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
        <!-- Tarjetas de estadísticas (mismas variables, nuevo estilo visual) -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number">{{ $leccionesCompletadasGlobal ?? 0 }} / {{ $totalLeccionesGenerales ?? 0 }}</div>
                <div class="stat-label">Lecciones completadas</div>
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

        <!-- Módulos disponibles (exactamente la misma lógica de foreach) -->
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
                <div class="modulo-progress">{{ $progresos[$modulo->id]['porcentaje'] ?? 0 }}% completado</div>
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
