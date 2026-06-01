<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx Academy — Mi Aprendizaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #F3F4F6;
            color: #111827;
            min-height: 100vh;
        }

        .navbar {
            background: #FFFFFF;
            border-bottom: 1px solid #E5E7EB;
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-left { display: flex; align-items: center; gap: 1.5rem; }

        .logo {
            font-family: 'Nunito', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            background: linear-gradient(135deg, #15803D 0%, #4ADE80 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6B7280;
            text-decoration: none;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-link:hover { background: #F3F4F6; color: #111827; }
        .nav-link.active { color: #15803D; font-weight: 600; }

        .nav-right { display: flex; align-items: center; gap: 1rem; }

        .xp-badge {
            background: #DCFCE7;
            color: #15803D;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 0.35rem 1rem;
            border-radius: 40px;
            border: 1px solid #BBF7D0;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #15803D, #4ADE80);
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
        }

        .btn-logout {
            background: none;
            border: 1px solid #E5E7EB;
            color: #6B7280;
            padding: 0.4rem 1rem;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }
        .btn-logout:hover { background: #FEE2E2; border-color: #FECACA; color: #DC2626; }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
        }

        .welcome {
            margin-bottom: 2rem;
        }
        .welcome h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.9rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 0.3rem;
        }
        .welcome h1 span { color: #15803D; }
        .welcome p { font-size: 0.95rem; color: #6B7280; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.07); }

        .stat-icon { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .stat-num {
            font-family: 'Nunito', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: #111827;
            line-height: 1;
            margin-bottom: 0.4rem;
        }
        .stat-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9CA3AF;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }
        .section-header h2 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #111827;
        }

        .modulo-card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            transition: box-shadow 0.2s;
        }
        .modulo-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.07); }

        .modulo-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .modulo-info h3 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.3rem;
        }
        .modulo-info p {
            font-size: 0.875rem;
            color: #6B7280;
            margin-bottom: 0.5rem;
        }
        .modulo-tag {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #15803D;
            background: #DCFCE7;
            padding: 0.2rem 0.75rem;
            border-radius: 40px;
        }

        .progress-wrap {
            margin-bottom: 1rem;
        }
        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .progress-label-text {
            font-size: 0.8rem;
            font-weight: 600;
            color: #6B7280;
        }
    
        .progress-nums {
            font-size: 0.8rem;
            font-weight: 700;
            color: #15803D;
        }
        .progress-bar-bg {
            background: #F3F4F6;
            border-radius: 99px;
            height: 8px;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #15803D, #4ADE80);
            border-radius: 99px;
            transition: width 0.5s ease;
        }

        .lecciones-list {
            background: #F9FAFB;
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 1rem;
            border: 1px solid #F3F4F6;
        }

        .leccion-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #F3F4F6;
            text-decoration: none;
            color: #111827;
            transition: background 0.15s;
            cursor: pointer;
        }
        .leccion-row:last-child { border-bottom: none; }

        .leccion-row.completada { color: #6B7280; }
        .leccion-row.completada:hover { background: #F0FDF4; }

        .leccion-row.disponible:hover { background: #F0FDF4; }

        .leccion-row.bloqueada {
            cursor: not-allowed;
            opacity: 0.55;
            pointer-events: none;
        }

        .leccion-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        .leccion-icon.done { background: #4ADE80; color: #064E3B; }
        .leccion-icon.next { background: #DCFCE7; color: #15803D; border: 2px solid #4ADE80; }
        .leccion-icon.locked { background: #F3F4F6; color: #9CA3AF; border: 2px solid #E5E7EB; }

        .leccion-titulo { flex: 1; font-size: 0.9rem; font-weight: 500; }
        .leccion-status { font-size: 0.75rem; font-weight: 600; color: #9CA3AF; }
        .leccion-status.done { color: #15803D; }

        .modulo-footer {
            display: flex;
            justify-content: flex-end;
            padding-top: 0.75rem;
            border-top: 1px solid #F3F4F6;
        }

        .btn-continuar {
            background: #4ADE80;
            color: #064E3B;
            padding: 0.6rem 1.5rem;
            border-radius: 40px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .btn-continuar:hover { background: #15803D; color: white; transform: scale(0.97); }

        .badge-completado {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #DCFCE7;
            color: #15803D;
            border: 1px solid #BBF7D0;
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-size: 0.875rem;
            font-weight: 700;
        }

        .banner-completado {
            background: linear-gradient(135deg, #DCFCE7, #BBF7D0);
            border: 1px solid #4ADE80;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .banner-completado .banner-icon { font-size: 2rem; }
        .banner-completado h3 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #065F46;
        }
        .banner-completado p { font-size: 0.875rem; color: #15803D; }

        .profile-link {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: #6B7280;
            text-decoration: none;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .profile-link:hover { background: #F3F4F6; color: #111827; }

        
        @media (max-width: 640px) {
            .navbar { padding: 0 1rem; }
            .container { padding: 1.5rem 1rem; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .welcome h1 { font-size: 1.5rem; }
            .nav-link { display: none; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-left">
            <div class="logo">Bitlyx</div>
            <a href="{{ route('user.dashboard') }}" class="nav-link active">Inicio</a>
            <a href="{{ route('user.perfil') }}" class="nav-link">Mi perfil</a>
        </div>
        <div class="nav-right">
            <div class="xp-badge">
                 {{ Auth::user()->xp_total ?? 0 }} XP
            </div>
            @php
                $nombreCompleto = Auth::user()->nombre ?? Auth::user()->name ?? '';
                $partes = explode(' ', trim($nombreCompleto));
                $iniciales = strtoupper(substr($partes[0] ?? '', 0, 1) . substr($partes[1] ?? '', 0, 1));
            @endphp
            <div class="avatar">{{ $iniciales }}</div>
            <form action="{{ route('logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="btn-logout">Salir</button>
            </form>
        </div>
    </nav>

    <div class="container">

        {{-- BANNER de módulo completado (flash message) --}}
        @if(session('success') && str_contains(session('success'), 'completado'))
        <div class="banner-completado">
            <div class="banner-icon"> </div>
            <div>
                <h3>¡Módulo completado!</h3>
                <p>{{ session('success') }} Sigue así, vas muy bien.</p>
            </div>
        </div>
        @endif

        <div class="welcome">
            <h1>Bienvenido, <span>{{ Auth::user()->nombre ?? Auth::user()->name }}</span></h1>
            <p>Continúa desde donde lo dejaste.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"> </div>
                <div class="stat-num">{{ $leccionesCompletadasGlobal ?? 0 }} / {{ $totalLeccionesGenerales ?? 0 }}</div>
                <div class="stat-label">Lecciones</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"> </div>
                <div class="stat-num">{{ Auth::user()->xp_total ?? 0 }}</div>
                <div class="stat-label">Puntos XP</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"> </div>
                <div class="stat-num">{{ $porcentajeGlobal ?? 0 }}%</div>
                <div class="stat-label">Progreso global</div>
            </div>
        </div>

        <div class="section-header">
            <span> </span>
            <h2>Mis módulos</h2>
        </div>

        @forelse($modulos as $modulo)
        @php
            $progMod    = $progresos[$modulo->id] ?? [];
            $porcentaje = $progMod['porcentaje'] ?? 0;
            $completadasMap = $progMod['completadas'] ?? [];
            $totalLec   = $modulo->lecciones->count();
            $completadasCount = collect($completadasMap)->filter()->count();
            $moduloCompleto = ($totalLec > 0 && $completadasCount >= $totalLec);

            // Primera lección no completada (para botón continuar)
            $proximaLeccion = null;
            foreach ($modulo->lecciones as $lec) {
                if (!isset($completadasMap[$lec->id]) || !$completadasMap[$lec->id]) {
                    $proximaLeccion = $lec;
                    break;
                }
            }
        @endphp

        <div class="modulo-card">
            <div class="modulo-top">
                <div class="modulo-info">
                    <h3>{{ $modulo->titulo }}</h3>
                    <p>{{ $modulo->descripcion }}</p>
                    <span class="modulo-tag">{{ $totalLec }} lecciones</span>
                </div>
            </div>

            {{-- PROGRESO VISUAL MEJORADO: barra + X/N lecciones + % --}}
            <div class="progress-wrap">
                <div class="progress-header">
                    <span class="progress-label-text">Progreso del módulo</span>
                    <span class="progress-nums">{{ $completadasCount }} / {{ $totalLec }} lecciones · {{ $porcentaje }}%</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: {{ $porcentaje }}%"> </div>
                </div>
            </div>

            {{-- LISTA DE LECCIONES CON BLOQUEO --}}
            <div class="lecciones-list">
                @foreach($modulo->lecciones->sortBy('orden') as $index => $leccion)
                @php
                    $estaCompletada = isset($completadasMap[$leccion->id]) && $completadasMap[$leccion->id];

                    // Una lección está disponible si:
                    // - Es la primera (índice 0), o
                    // - La lección anterior está completada
                    $leccionAnterior = $modulo->lecciones->sortBy('orden')->values()->get($index - 1);
                    $anteriorCompletada = $index === 0 ||
                        ($leccionAnterior && isset($completadasMap[$leccionAnterior->id]) && $completadasMap[$leccionAnterior->id]);

                    $bloqueada = !$estaCompletada && !$anteriorCompletada;
                @endphp

                @if($estaCompletada)
                    {{-- COMPLETADA: puede volver a verla --}}
                    <a href="{{ route('leccion.show', $leccion->id) }}" class="leccion-row completada">
                        <div class="leccion-icon done">✓</div>
                        <span class="leccion-titulo">{{ $leccion->titulo }}</span>
                        <span class="leccion-status done">Completada</span>
                    </a>
                @elseif($bloqueada)
                    {{-- BLOQUEADA: no clickeable --}}
                    <div class="leccion-row bloqueada">
                        <div class="leccion-icon locked">🔒</div>
                        <span class="leccion-titulo">{{ $leccion->titulo }}</span>
                        <span class="leccion-status">Bloqueada</span>
                    </div>
                @else
                    {{-- DISPONIBLE: siguiente a completar --}}
                    <a href="{{ route('leccion.show', $leccion->id) }}" class="leccion-row disponible">
                        <div class="leccion-icon next">{{ $leccion->orden }}</div>
                        <span class="leccion-titulo">{{ $leccion->titulo }}</span>
                        <span class="leccion-status">Disponible</span>
                    </a>
                @endif
                @endforeach
            </div>

            {{-- FOOTER: botón continuar o badge completado --}}
            <div class="modulo-footer">
                @if($moduloCompleto)
                    <span class="badge-completado"> Módulo completado</span>
                @elseif($proximaLeccion)
                    <a href="{{ route('leccion.show', $proximaLeccion->id) }}" class="btn-continuar">
                        {{ $completadasCount === 0 ? 'Comenzar' : 'Continuar' }} →
                    </a>
                @endif
            </div>
        </div>
        @empty
        <div style="text-align:center; padding: 3rem; color: #9CA3AF; font-size: 0.95rem;">
            No hay módulos disponibles todavía.
        </div>
        @endforelse

    </div>
</body>
</html>
