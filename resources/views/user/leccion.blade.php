<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx — {{ $leccion->titulo }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #F3F4F6;
            color: #111827;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        .nav-left { display: flex; align-items: center; gap: 1rem; }

        .btn-volver {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #6B7280;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.4rem 0.75rem;
            border-radius: 8px;
            border: 1px solid #E5E7EB;
            transition: all 0.2s;
        }
        .btn-volver:hover { background: #F3F4F6; color: #111827; border-color: #D1D5DB; }
        .btn-volver svg { width: 16px; height: 16px; }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #9CA3AF;
        }
        .breadcrumb span { color: #6B7280; }
        .breadcrumb strong { color: #111827; font-weight: 600; }

        .nav-right { display: flex; align-items: center; gap: 1rem; }

        .xp-badge {
            background: #DCFCE7;
            color: #15803D;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 0.35rem 1rem;
            border-radius: 40px;
            border: 1px solid #BBF7D0;
        }

        .module-progress-bar {
            height: 4px;
            background: #E5E7EB;
        }
        .module-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #15803D, #4ADE80);
            transition: width 0.5s ease;
        }

        .main {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 2.5rem 1.5rem;
        }

        .leccion-card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 760px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }

        .leccion-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #F3F4F6;
        }

        .leccion-head h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: #111827;
            line-height: 1.25;
        }

        .badge-completada {
            flex-shrink: 0;
            background: #DCFCE7;
            color: #15803D;
            border: 1px solid #BBF7D0;
            padding: 0.3rem 0.9rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .leccion-body {
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            border-radius: 14px;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            line-height: 1.8;
            color: #374151;
        }

        .progreso-modulo {
            margin-bottom: 1.5rem;
        }
        .progreso-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .progreso-texto {
            font-size: 0.8rem;
            color: #6B7280;
            font-weight: 500;
        }
        
        .progreso-nums {
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

        .nav-buttons {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid #F3F4F6;
            flex-wrap: wrap;
        }

        .btn-nav {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.65rem 1.25rem;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-anterior {
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            color: #374151;
        }
        .btn-anterior:hover { background: #F3F4F6; border-color: #D1D5DB; }

        .btn-completar {
            background: linear-gradient(135deg, #15803D, #4ADE80);
            color: white;
            box-shadow: 0 2px 8px rgba(74, 222, 128, 0.3);
        }
        .btn-completar:hover { opacity: 0.92; transform: scale(0.98); box-shadow: 0 4px 12px rgba(74, 222, 128, 0.4); }

        .btn-siguiente {
            background: #111827;
            color: white;
        }
        .btn-siguiente:hover { background: #1F2937; }

        .btn-quiz {
            background: linear-gradient(135deg, #15803D, #4ADE80);
            color: white;
            box-shadow: 0 2px 8px rgba(74, 222, 128, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.65rem 1.5rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }
        .btn-quiz:hover { opacity: 0.92; transform: scale(0.98); }

        .ya-completada {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #DCFCE7;
            color: #15803D;
            border: 1px solid #BBF7D0;
            padding: 0.65rem 1.25rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 700;
        }

        .placeholder { min-width: 120px; }

        @media (max-width: 640px) {
            .navbar { padding: 0 1rem; }
            .main { padding: 1.5rem 1rem; }
            .leccion-card { padding: 1.5rem; }
            .leccion-head h1 { font-size: 1.35rem; }
            .breadcrumb { display: none; }
            .nav-buttons { justify-content: center; }
        }
    
    /* ── DARK MODE GLOBAL ── */
    #html-root.dark body { background: #0D0D0D !important; color: #F9FAFB !important; }
    #html-root.dark .navbar,
    #html-root.dark .sidebar,
    #html-root.dark .quiz-topbar { background: #111111 !important; border-color: #222222 !important; }
    #html-root.dark .leccion-card,
    #html-root.dark .modulo-card,
    #html-root.dark .stat-card,
    #html-root.dark .filter-card,
    #html-root.dark .table-card,
    #html-root.dark .pregunta-card,
    #html-root.dark .quiz-card,
    #html-root.dark .card { background: #1A1A1A !important; border-color: #2D2D2D !important; }
    #html-root.dark h1,
    #html-root.dark h2,
    #html-root.dark h3,
    #html-root.dark .stat-num,
    #html-root.dark .enunciado,
    #html-root.dark .leccion-titulo,
    #html-root.dark .page-title,
    #html-root.dark .page-sub { color: #F9FAFB !important; }
    #html-root.dark p { color: #9CA3AF !important; }
    #html-root.dark .leccion-body { background: #111111 !important; border-color: #2D2D2D !important; color: #E5E7EB !important; }
    #html-root.dark .lecciones-list { background: #111111 !important; border-color: #2D2D2D !important; }
    #html-root.dark .leccion-row { color: #F9FAFB !important; border-bottom-color: #2D2D2D !important; }
    #html-root.dark .leccion-row.completada { color: #9CA3AF !important; }
    #html-root.dark .leccion-row.disponible:hover,
    #html-root.dark .leccion-row.completada:hover { background: #1E3A2F !important; }
    #html-root.dark .progress-bar-bg,
    #html-root.dark .progress-track { background: #2D2D2D !important; }
    #html-root.dark .opcion-btn { background: #1A1A1A !important; border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark .opcion-btn:hover:not(:disabled) { background: #14532D !important; border-color: #4ADE80 !important; }
    #html-root.dark select,
    #html-root.dark input,
    #html-root.dark textarea { background: #1A1A1A !important; border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark table thead th { background: #111111 !important; color: #9CA3AF !important; border-color: #2D2D2D !important; }
    #html-root.dark table tbody td { color: #F9FAFB !important; border-color: #2D2D2D !important; }
    #html-root.dark table tbody tr:hover { background: #1A1A1A !important; }
    #html-root.dark .nav-item { color: #9CA3AF !important; }
    #html-root.dark .nav-item.active,
    #html-root.dark .nav-item:hover { background: #1A1A1A !important; color: #4ADE80 !important; }
    #html-root.dark .nav-item.active i,
    #html-root.dark .nav-item:hover i { color: #4ADE80 !important; }
    #html-root.dark .xp-badge { background: #14532D !important; color: #4ADE80 !important; border-color: #15803D !important; }
    #html-root.dark .modulo-tag { background: #14532D !important; color: #4ADE80 !important; }
    #html-root.dark .xp-tag { background: #14532D !important; color: #4ADE80 !important; border-color: #15803D !important; }
    #html-root.dark .breadcrumb a { color: #9CA3AF !important; }
    #html-root.dark .count-badge { background: #14532D !important; color: #4ADE80 !important; }
    #html-root.dark .opcion-row { background: #1A1A1A !important; border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark .intentos-box { background: #111111 !important; border-color: #2D2D2D !important; }
    #html-root.dark .intento-row { border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark .prog-wrap { background: #2D2D2D !important; }

    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-left">
            {{-- Botón volver al dashboard --}}
            <a href="{{ route('user.dashboard') }}" class="btn-volver">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Volver
            </a>
            {{-- Breadcrumb: Módulo › Lección N de N --}}
            <div class="breadcrumb">
                <span>{{ $leccion->modulo->titulo }}</span>
                <span>›</span>
                <strong>Lección {{ $leccion->orden }} de {{ $leccionesDelModulo->count() }}</strong>
            </div>
        </div>
        <div class="nav-right">
            <div class="xp-badge"> {{ $usuario->xp_total ?? 0 }} XP</div>
            <button id="dark-btn" title="Modo oscuro" style="background:transparent;border:1px solid #E5E7EB;border-radius:50%;width:36px;height:36px;font-size:17px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .2s">🌙</button>
        </div>
    </nav>

    <div class="module-progress-bar">
        <div class="module-progress-fill" style="width: {{ $porcentajeModulo }}%"></div>
    </div>

    <div class="main">
        <div class="leccion-card">

            <div class="leccion-head">
                <h1>{{ $leccion->titulo }}</h1>
                @if($progreso && $progreso->completada)
                    <span class="badge-completada"> Completada</span>
                @endif
            </div>

            <div class="leccion-body">
                {!! nl2br(e($leccion->contenido)) !!}
            </div>

            <div class="progreso-modulo">
                <div class="progreso-header">
                    <span class="progreso-texto"> Progreso del módulo</span>
                    <span class="progreso-nums">{{ $leccionesCompletadas }} / {{ $leccionesDelModulo->count() }} lecciones completadas</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: {{ $porcentajeModulo }}%"></div>
                </div>
            </div>

            <div class="nav-buttons">

                {{-- BOTÓN ANTERIOR --}}
                @if($anterior)
                    <a href="{{ route('leccion.show', $anterior->id) }}" class="btn-nav btn-anterior">
                         Anterior
                    </a>
                @else
                    <div class="placeholder"></div>
                @endif

                {{-- CENTRO: marcar completada o ya completada + quiz --}}
                <div style="display:flex; gap: 0.75rem; align-items: center; flex-wrap: wrap; justify-content: center;">
                    @if(!$progreso || !$progreso->completada)
                        <form method="POST" action="{{ route('leccion.completar', $leccion->id) }}" style="margin:0">
                            @csrf
                            <button type="submit" class="btn-nav btn-completar">
                                 Marcar como completada
                            </button>
                        </form>
                  @else
                    <span class="ya-completada"> Completada</span>
                    @if(!$siguiente)
                        <a href="{{ route('quiz.show', $leccion->modulo_id) }}" class="btn-quiz">
                             Ir al Quiz
                        </a>
                    @endif
                @endif
                </div>

                {{-- BOTÓN SIGUIENTE --}}
                @if($siguiente)
                    <a href="{{ route('leccion.show', $siguiente->id) }}" class="btn-nav btn-siguiente">
                        Siguiente 
                    </a>
                @else
                    <div class="placeholder"></div>
                @endif

            </div>

        </div>
    </div>


    <script>
    (function() {
        var btn  = document.getElementById('dark-btn');
        var root = document.getElementById('html-root');
        function applyDark(on) {
            if (on) { root.classList.add('dark'); }
            else     { root.classList.remove('dark'); }
            if (btn) btn.textContent = on ? '☀️' : '🌙';
            localStorage.setItem('bitlyx-dark', on ? '1' : '0');
        }
        applyDark(localStorage.getItem('bitlyx-dark') === '1');
        if (btn) btn.addEventListener('click', function() {
            applyDark(!root.classList.contains('dark'));
        });
    })();
    </script>

</body>
</html>
