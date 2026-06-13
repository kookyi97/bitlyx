<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx — Mi Perfil</title>
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
        .nav-left { display: flex; align-items: center; gap: 1rem; }
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
        .btn-volver:hover { background: #F3F4F6; color: #111827; }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
        }

        .page-header { margin-bottom: 2rem; }
        .page-header h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.7rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 0.3rem;
        }
        .page-header p { font-size: 0.9rem; color: #6B7280; }

        .profile-card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }

        .avatar-section {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #F3F4F6;
        }
        .avatar-lg {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #15803D, #4ADE80);
            color: white;
            font-weight: 800;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
            flex-shrink: 0;
        }
        .avatar-info h3 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #111827;
        }
        .avatar-info p { font-size: 0.85rem; color: #6B7280; }

        .form-group { margin-bottom: 1.25rem; }
        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .form-input {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: #111827;
            background: #FFFFFF;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.15);
        }
        .form-input::placeholder { color: #9CA3AF; }

        .form-hint { font-size: 0.78rem; color: #9CA3AF; margin-top: 0.3rem; }

        .form-divider {
            border: none;
            border-top: 1px solid #F3F4F6;
            margin: 1.5rem 0;
        }

        .section-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 1rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .alert-success { background: #DCFCE7; color: #15803D; border: 1px solid #BBF7D0; }
        .alert-error   { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

        .field-error { font-size: 0.78rem; color: #DC2626; margin-top: 0.3rem; }
        .form-input.error { border-color: #FCA5A5; }

        .btn-guardar {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, #15803D, #4ADE80);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(74, 222, 128, 0.3);
            margin-top: 0.5rem;
        }
        .btn-guardar:hover { opacity: 0.92; transform: scale(0.99); }

        @media (max-width: 640px) {
            .navbar { padding: 0 1rem; }
            .container { padding: 1.5rem 1rem; }
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
            <div class="logo">Bitlyx</div>
            <a href="{{ route('user.dashboard') }}" class="nav-link">Inicio</a>
            <a href="{{ route('user.perfil') }}" class="nav-link active">Mi perfil</a>
        </div>
        <div>
            <a href="{{ route('user.dashboard') }}" class="btn-volver">
                 Volver al inicio
            </a>
        </div>
    </nav>

    <div class="container">

        <div class="page-header">
            <h1>Mi perfil</h1>
            <p>Edita tu información personal y contraseña.</p>
        </div>

        @php
            $nombreCompleto = Auth::user()->nombre ?? Auth::user()->name ?? '';
            $partes = explode(' ', trim($nombreCompleto));
            $iniciales = strtoupper(substr($partes[0] ?? '', 0, 1) . substr($partes[1] ?? '', 0, 1));
        @endphp

        {{-- Mensajes de éxito/error --}}
        @if(session('success'))
            <div class="alert alert-success"> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"> {{ session('error') }}</div>
        @endif

        <div class="profile-card">

            <div class="avatar-section">
                <div class="avatar-lg">{{ $iniciales }}</div>
                <div class="avatar-info">
                    <h3>{{ Auth::user()->nombre ?? Auth::user()->name }}</h3>
                    <p>{{ Auth::user()->email }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('user.perfil.update') }}">
                @csrf
                @method('PUT')

                {{-- DATOS PERSONALES --}}
                <div class="section-label">Datos personales</div>

                <div class="form-group">
                    <label>Nombre completo</label>
                    <input
                        type="text"
                        name="nombre"
                        class="form-input {{ $errors->has('nombre') ? 'error' : '' }}"
                        value="{{ old('nombre', Auth::user()->nombre ?? Auth::user()->name) }}"
                        placeholder="Tu nombre"
                        required
                    >
                    @error('nombre')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input
                        type="email"
                        name="email"
                        class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                        value="{{ old('email', Auth::user()->email) }}"
                        placeholder="tu@correo.com"
                        required
                    >
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="form-divider">

                {{-- CAMBIO DE CONTRASEÑA --}}
                <div class="section-label">Cambiar contraseña <span style="font-weight:400;color:#9CA3AF;">(opcional)</span></div>

                <div class="form-group">
                    <label>Contraseña actual</label>
                    <input
                        type="password"
                        name="password_actual"
                        class="form-input {{ $errors->has('password_actual') ? 'error' : '' }}"
                        placeholder="••••••••"
                    >
                    @error('password_actual')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nueva contraseña</label>
                    <input
                        type="password"
                        name="password_nueva"
                        class="form-input {{ $errors->has('password_nueva') ? 'error' : '' }}"
                        placeholder="••••••••"
                    >
                    <div class="form-hint">Mínimo 8 caracteres. Déjalo en blanco si no quieres cambiarla.</div>
                    @error('password_nueva')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirmar nueva contraseña</label>
                    <input
                        type="password"
                        name="password_nueva_confirmation"
                        class="form-input"
                        placeholder="••••••••"
                    >
                </div>

                <button type="submit" class="btn-guardar">Guardar cambios</button>

            </form>
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
