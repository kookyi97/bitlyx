<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlix Academy - Crear Cuenta</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #FFFFFF;
            min-height: 100vh;
            color: #1F2937;
            overflow: hidden;
        }

        .register-container {
            display: flex;
            min-height: 100vh;
            height: 100vh;
        }

        /* ═══════════════════════════════
           LADO IZQUIERDO — Dark panel
        ═══════════════════════════════ */
        .left-side {
            flex: 1.1;
            background: #0F172A;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            top: -160px;
            left: -130px;
            background: radial-gradient(circle, rgba(22,163,74,.30) 0%, transparent 65%);
            filter: blur(60px);
            pointer-events: none;
        }

        .left-side::after {
            content: '';
            position: absolute;
            width: 280px;
            height: 280px;
            bottom: -70px;
            right: 30px;
            background: radial-gradient(circle, rgba(74,222,128,.18) 0%, transparent 70%);
            filter: blur(55px);
            pointer-events: none;
        }

        .grid-texture {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
            background-size: 44px 44px;
            pointer-events: none;
            z-index: 0;
        }

        .left-content {
            max-width: 480px;
            position: relative;
            z-index: 10;
            width: 100%;
        }

        /* Logo */
        .logo {
            font-family: 'Nunito', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 40px;
            letter-spacing: -0.4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: #16A34A;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .logo-icon svg { color: #fff; }

        /* Pill badge */
        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(22,163,74,.12);
            border: 1px solid rgba(22,163,74,.25);
            color: #4ADE80;
            padding: 5px 13px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .7px;
            text-transform: uppercase;
            margin-bottom: 22px;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            background: #4ADE80;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: .4; }
        }

        .tagline {
            font-family: 'Nunito', sans-serif;
            font-size: 40px;
            font-weight: 800;
            line-height: 1.13;
            color: #fff;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .tagline em {
            font-style: normal;
            color: #4ADE80;
        }

        .description {
            font-size: 14.5px;
            line-height: 1.6;
            color: rgba(255,255,255,.5);
            margin-bottom: 36px;
            max-width: 360px;
        }

        .features { text-align: left; }

        .feature {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 14px;
            background: rgba(255,255,255,.04);
            padding: 18px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,.07);
        }

        .feature:last-child { margin-bottom: 0; }

        .feature-icon {
            width: 42px;
            height: 42px;
            background: rgba(22,163,74,.15);
            border: 1px solid rgba(22,163,74,.22);
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4ADE80;
            flex-shrink: 0;
        }

        .feature-body {
            flex: 1;
        }

        .feature-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }

        .feature-title {
            font-weight: 600;
            font-size: 14px;
            color: #fff;
        }

        .feature-tag {
            font-size: 11px;
            font-weight: 600;
            background: #F0FDF4;
            color: #16A34A;
            padding: 2px 8px;
            border-radius: 6px;
        }

        .feature-sub {
            font-size: 13px;
            line-height: 1.5;
            color: rgba(255,255,255,.42);
        }

        .app-progress-bar {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 99px;
            margin-top: 12px;
            overflow: hidden;
        }

        .app-progress-fill {
            height: 100%;
            background: #16A34A;
            border-radius: 99px;
        }

        .app-badges-row {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .app-mini-badge {
            font-size: 11px;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            padding: 4px 10px;
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.6);
        }

       
        .right-side {
            flex: 0.9;
            background: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .form-box {
            max-width: 380px;
            width: 100%;
        }

        .form-title {
            font-family: 'Nunito', sans-serif;
            font-size: 32px;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .form-subtitle {
            color: #64748B;
            margin-bottom: 30px;
            font-size: 14.5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #334155;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 16px;
            border: 1px solid #CBD5E1;
            border-radius: 12px;
            font-size: 14.5px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #FFFFFF;
            color: #0F172A;
        }

        .form-group input::placeholder {
            color: #94A3B8;
        }

        .form-group input:focus {
            outline: none;
            border-color: #16A34A;
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.1);
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: #16A34A;
            color: #FFFFFF;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.15);
            margin-top: 12px;
        }

        .btn-register:hover {
            background: #15803D;
            box-shadow: 0 8px 12px -3px rgba(21, 128, 61, 0.2);
        }

        .error-message {
            background: #FEF2F2;
            border: 1px solid #FEE2E2;
            color: #991B1B;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 28px;
            font-size: 14px;
            line-height: 1.5;
        }

        .login-link {
            text-align: center;
            margin-top: 28px;
            font-size: 14px;
            color: #64748B;
        }

        .login-link a {
            color: #16A34A;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.15s ease;
        }

        .login-link a:hover {
            color: #15803D;
            text-decoration: underline;
        }

        @media (max-width: 1024px) {
            .left-side  { padding: 40px; }
            .tagline    { font-size: 34px; }
        }

        @media (max-width: 900px) {
            body        { overflow: auto; }
            .left-side  { display: none; }
            .right-side { flex: 1; padding: 24px; }
        }
    </style>
</head>
<body>
<div class="register-container">

    <!-- ══ PANEL IZQUIERDO  ══ -->
    <div class="left-side">
        <div class="grid-texture"></div>

        <div class="left-content">

            <!-- Logo -->
            <div class="logo">
                <div class="logo-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/>
                        <path d="M8 7h8M8 11h5"/>
                    </svg>
                </div>
                Bitlix Academy
            </div>

            

            <h1 class="tagline">
                Domina la ingeniería<br>de <em>software</em>.
            </h1>

            <p class="description">
                Lecciones ultra cortas y práctica interactiva diaria adaptada a tu ritmo.
            </p>

            <div class="features">
                
                <div class="feature">
                    <div class="feature-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/>
                        </svg>
                    </div>
                    <div class="feature-body">
                        <div class="feature-header">
                            <h3 class="feature-title">Micro-módulos prácticos</h3>
                            <span class="feature-tag">Conceptos base</span>
                        </div>
                        <p class="feature-sub">Bloques ágiles de 5 minutos enfocados directamente en la solución.</p>
                        <div class="app-progress-bar">
                            <div class="app-progress-fill" style="width: 75%;"></div>
                        </div>
                    </div>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <div class="feature-body">
                        <div class="feature-header">
                            <h3 class="feature-title">Evaluación automatizada</h3>
                            <span class="feature-tag" style="background: rgba(37,99,235,.15); color: #60A5FA;">Quizzes</span>
                        </div>
                        <p class="feature-sub">Mide tu nivel técnico y consolida tus objetivos de inmediato.</p>
                        <div class="app-badges-row">
                            <div class="app-mini-badge">✓ Redes</div>
                            <div class="app-mini-badge">✓ Código</div>
                            <div class="app-mini-badge" style="opacity: 0.4;">🔒 Arquitectura</div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>

    <!-- ══ PANEL DERECHO — FORMULARIO BLANCO ══ -->
    <div class="right-side">
        <div class="form-box">
            <h2 class="form-title">Crear cuenta</h2>
            <div class="form-subtitle">Completa el formulario para registrarte</div>

            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        <p style="margin-bottom: 4px;">• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label>Nombre completo</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Tu nombre" required autofocus>
                </div>

                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@bitlix.com" required>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" placeholder="Mínimo 8 caracteres" required>
                </div>

                <div class="form-group">
                    <label>Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" placeholder="Repite tu contraseña" required>
                </div>

                <button type="submit" class="btn-register">Registrarse</button>

                <div class="login-link">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>