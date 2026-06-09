<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitlyx — Nueva contraseña</title>
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
        }
        .alert-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #DC2626;
            border-radius: 10px;
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
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
        .form-hint { font-size: 0.78rem; color: #9CA3AF; margin-top: 0.3rem; }
        .btn-guardar {
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
        .btn-guardar:hover { opacity: 0.92; transform: scale(0.99); }
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
        <div class="titulo">Crear nueva contraseña</div>
        <div class="subtitulo">Ingresa tu nueva contraseña para recuperar el acceso.</div>

        {{-- Errores generales --}}
        @if($errors->has('email'))
            <div class="alert-error">✗ {{ $errors->first('email') }}</div>
        @endif

        <form method="POST" action="{{ route('recuperar.resetear') }}">
            @csrf
            {{-- Token y email ocultos --}}
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label>Nueva contraseña</label>
                <input
                    type="password"
                    name="password"
                    class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                    placeholder="••••••••"
                    autofocus
                >
                <div class="form-hint">Mínimo 8 caracteres.</div>
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirmar nueva contraseña</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-input"
                    placeholder="••••••••"
                >
            </div>

            <button type="submit" class="btn-guardar">Guardar nueva contraseña</button>
        </form>

        <a href="{{ route('login') }}" class="volver-link">Volver al inicio de sesión</a>
    </div>
</body>
</html>
