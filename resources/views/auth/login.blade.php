<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlix Academy - Iniciar Sesión</title>
    
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

        .login-container {
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

        /* Orb verde grande — esquina superior izquierda */
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

        /* Orb verde pequeño — esquina inferior derecha */
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

        /* Textura de grilla sutil */
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

        /* Título principal */
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

        /* Descripción corta */
        .description {
            font-size: 14.5px;
            line-height: 1.6;
            color: rgba(255,255,255,.5);
            margin-bottom: 36px;
            max-width: 360px;
        }

        /* Feature cards */
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
            transition: background .2s ease, border-color .2s ease;
        }

        .feature:last-child { margin-bottom: 0; }

        .feature:hover {
            background: rgba(255,255,255,.07);
            border-color: rgba(255,255,255,.12);
        }

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

        .feature-title {
            font-weight: 600;
            font-size: 14px;
            color: #fff;
            margin-bottom: 4px;
        }

        .feature-sub {
            font-size: 13px;
            line-height: 1.5;
            color: rgba(255,255,255,.42);
        }

        /* ═══════════════════════════════
           LADO DERECHO — Formulario
        ═══════════════════════════════ */
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
            margin-bottom: 36px;
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

        /* Input con bordes rojos si hay error */
        .form-group input.input-error {
            border-color: #EF4444;
        }
        
        .form-group input.input-error:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        /* Mensaje de error justo debajo del input */
        .field-error {
            color: #DC2626;
            font-size: 13px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }

        /* Alerta de Registro Exitoso */
        .success-alert {
            background: #F0FDF4;
            border: 1px solid #DCFCE7;
            color: #16A34A;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 28px;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 500;
        }

        /* Ojo contraseña */
        .password-wrap {
            position: relative;
        }

        .password-wrap input {
            padding-right: 46px;
        }

        .toggle-pass {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #94A3B8;
            padding: 0;
            display: flex;
            align-items: center;
            transition: color .18s;
            line-height: 0;
        }

        .toggle-pass:hover { color: #475569; }

        .btn-login {
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

        .btn-login:hover {
            background: #15803D;
            box-shadow: 0 8px 12px -3px rgba(21, 128, 61, 0.2);
        }

        .register-link {
            text-align: center;
            margin-top: 28px;
            font-size: 14px;
            color: #64748B;
        }

        .register-link a {
            color: #16A34A;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.15s ease;
        }

        .register-link a:hover {
            color: #15803D;
            text-decoration: underline;
        }

        /* ═══════════════════════════════
           RESPONSIVE
        ═══════════════════════════════ */
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
<div class="login-container">

    <div class="left-side">
        <div class="grid-texture"></div>

        <div class="left-content">
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
                Aprende tecnología<br><em>concepto</em> a concepto.
            </h1>

            <p class="description">
                Módulos precisos, quizzes inteligentes y seguimiento de progreso para la ingeniería moderna.
            </p>

            <div class="features">
                <div class="feature">
                    <div class="feature-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="feature-title">Módulos interactivos</h3>
                        <p class="feature-sub">Contenido estructurado con precisión y fácil de asimilar en pocos minutos.</p>
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <circle cx="12" cy="12" r="6"/>
                            <circle cx="12" cy="12" r="2"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="feature-title">Quizzes dinámicos</h3>
                        <p class="feature-sub">Valida tus competencias de inmediato y consolida los conceptos clave aprendidos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="right-side">
        <div class="form-box">
            <h2 class="form-title">Iniciar Sesión</h2>
            <div class="form-subtitle">Ingresa tus credenciales para continuar</div>

            @if (session('status'))
                <div class="success-alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="@error('email') input-error @enderror" 
                           placeholder="ejemplo@bitlix.com" required autofocus>
                    
                    @error('email')
                        <span class="field-error"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <div class="password-wrap">
                        <input type="password" name="password" id="password" 
                               class="@error('password') input-error @enderror" 
                               placeholder="••••••••" required>
                        <button type="button" class="toggle-pass" onclick="togglePassword()" aria-label="Mostrar u ocultar contraseña">
                            <svg id="icon-eye" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="icon-eye-off" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                    
                    @error('password')
                        <span class="field-error"> {{ $message }}</span>
                    @enderror
                </div>
                <a href="{{ route('recuperar.form') }}" 
                style="font-size:0.8rem; color:#15803D; text-decoration:none; display:block; text-align:right; margin-top:4px;">
                ¿Olvidaste tu contraseña?
                </a>


                <button type="submit" class="btn-login">Iniciar Sesión</button>

                <div class="register-link">
                    ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function togglePassword() {
        var input  = document.getElementById('password');
        var eyeOn  = document.getElementById('icon-eye');
        var eyeOff = document.getElementById('icon-eye-off');
        if (input.type === 'password') {
            input.type        = 'text';
            eyeOn.style.display  = 'none';
            eyeOff.style.display = 'block';
        } else {
            input.type        = 'password';
            eyeOn.style.display  = 'block';
            eyeOff.style.display = 'none';
        }
    }
</script>
</body>
</html>