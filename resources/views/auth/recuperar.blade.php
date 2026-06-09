<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitlyx — Recuperar contraseña</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #F3F4F6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }
        .logo {
            font-family: 'Nunito', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #15803D, #4ADE80);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        .titulo {
            font-family: 'Nunito', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #111827;
            text-align: center;
            margin-bottom: 0.4rem;
        }
        .subtitulo {
            font-size: 0.875rem;
            color: #6B7280;
            text-align: center;
            margin-bottom: 2rem;
            line-height: 1.5;
        }
        .alert-success {
            background: #DCFCE7;
            border: 1px solid #BBF7D0;
            color: #15803D;
            border-radius: 10px;
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
        }
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
            padding: 0.75rem 1rem;
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            color: #111827;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input:focus {
            border-color: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74,222,128,0.15);
        }
        .form-input.error { border-color: #FCA5A5; }
        .field-error {
            font-size: 0.78rem;
            color: #DC2626;
            margin-top: 0.3rem;
        }
        .btn-enviar {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, #15803D, #4ADE80);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(74,222,128,0.3);
            margin-bottom: 1rem;
        }
        .btn-enviar:hover { opacity: 0.92; transform: scale(0.99); }
        .volver-link {
            display: block;
            text-align: center;
            font-size: 0.875rem;
            color: #6B7280;
            text-decoration: none;
            transition: color 0.2s;
        }
        .volver-link:hover { color: #15803D; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">Bitlyx</div>
        <div class="titulo">¿Olvidaste tu contraseña?</div>
        <div class="subtitulo">Ingresa tu correo y te enviaremos un enlace para restablecerla.</div>

        {{-- Mensaje de éxito --}}
        @if(session('status'))
            <div class="alert-success">
                <span>✓</span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('recuperar.enviar') }}">
            @csrf
            <div class="form-group">
                <label>Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                    value="{{ old('email') }}"
                    placeholder="tu@correo.com"
                    autofocus
                >
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-enviar">Enviar enlace de recuperación</button>
        </form>

        <a href="{{ route('login') }}" class="volver-link">Volver al inicio de sesión</a>
    </div>
</body>
</html>
