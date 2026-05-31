<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx Academy - Crear Cuenta</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Nunito', sans-serif;
            min-height: 100vh;
            background: #FFFFFF;
        }

        .register-container {
            display: flex;
            min-height: 100vh;
        }

        /* Mitad izquierda - Verde */
        .left-side {
            flex: 1;
            background: linear-gradient(135deg, #4ADE80 0%, #15803D 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" opacity="0.05"><path fill="white" d="M100,0 L200,100 L100,200 L0,100 Z"/></svg>') repeat;
            background-size: 60px;
        }

        .left-content {
            position: relative;
            z-index: 1;
            color: white;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 24px;
            letter-spacing: -0.5px;
        }

        .tagline {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .description {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
        }

        .features {
            margin-top: 48px;
            text-align: left;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 600;
        }

        .feature-text {
            font-size: 14px;
        }

        .feature-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .feature-sub {
            font-size: 12px;
            opacity: 0.8;
        }

        /* Mitad derecha - Formulario */
        .right-side {
            flex: 1;
            background: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .form-box {
            max-width: 420px;
            width: 100%;
        }

        .form-title {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: #6B7280;
            margin-bottom: 32px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #111827;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74,222,128,0.1);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: #4ADE80;
            color: #15803D;
            border: none;
            border-radius: 100px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-register:hover {
            background: #15803D;
            color: white;
            transform: translateY(-1px);
        }

        .error-message {
            background: #FEE2E2;
            color: #DC2626;
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #6B7280;
        }

        .login-link a {
            color: #4ADE80;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .left-side {
                display: none;
            }
            .right-side {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- LADO IZQUIERDO - VERDE -->
        <div class="left-side">
            <div class="left-content">
                <div class="logo">Bitlyx Academy</div>
                <div class="tagline">Comienza tu viaje</div>
                <div class="description">
                    Plataforma de aprendizaje interactiva con cursos, quizzes y seguimiento de progreso.
                </div>
                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">01</div>
                        <div class="feature-text">
                            <div class="feature-title">Aprende a tu ritmo</div>
                            <div class="feature-sub">Accede a todos los cursos cuando quieras</div>
                        </div>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">02</div>
                        <div class="feature-text">
                            <div class="feature-title">Pon a prueba tus conocimientos</div>
                            <div class="feature-sub">Quizzes interactivos en cada lección</div>
                        </div>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">03</div>
                        <div class="feature-text">
                            <div class="feature-title">Sigue tu progreso</div>
                            <div class="feature-sub">Visualiza tu avance en cada módulo</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LADO DERECHO - FORMULARIO BLANCO -->
        <div class="right-side">
            <div class="form-box">
                <div class="form-title">Crear cuenta</div>
                <div class="form-subtitle">Completa el formulario para registrarte</div>

                @if($errors->any())
                    <div class="error-message">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
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
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@bitlyx.com" required>
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