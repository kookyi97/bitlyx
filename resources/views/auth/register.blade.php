<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx - Crear Cuenta</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
        }

        .register-container {
            display: flex;
            min-height: 100vh;
        }

        /* Mitad izquierda - Azul */
        .left-side {
            flex: 1;
            background: linear-gradient(135deg, #1a56db 0%, #0e3a8a 100%);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" opacity="0.1"><path fill="white" d="M100,0 L200,100 L100,200 L0,100 Z"/></svg>') repeat;
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
            margin-bottom: 20px;
        }

        .tagline {
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .description {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
        }

        /* Mitad derecha - Blanca con formulario */
        .right-side {
            flex: 1;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .form-box {
            max-width: 400px;
            width: 100%;
        }

        .form-title {
            font-size: 32px;
            font-weight: 600;
            color: #1a2a3a;
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #1a2a3a;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1a56db;
            box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: #1a56db;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: #0e3a8a;
            transform: translateY(-1px);
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }

        .login-link a {
            color: #1a56db;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .left-side {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- LADO IZQUIERDO - AZUL -->
        <div class="left-side">
            <div class="left-content">
                <div class="logo">Bitlyx</div>
                <div class="tagline">Comienza ahora</div>
                <div class="description">
                    Plataforma de aprendizaje interactiva. Regístrate y accede a todos los cursos.
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