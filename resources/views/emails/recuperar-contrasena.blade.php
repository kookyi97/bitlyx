<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera tu contraseña — Bitlyx Academy</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #F3F4F6;
            padding: 40px 20px;
            color: #111827;
        }
        .email-wrap {
            max-width: 520px;
            margin: 0 auto;
        }
        .email-card {
            background: #FFFFFF;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #E5E7EB;
        }
        .email-header {
            background: linear-gradient(135deg, #15803D, #4ADE80);
            padding: 32px 40px;
            text-align: center;
        }
        .email-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.5px;
        }
        .email-header p {
            font-size: 14px;
            color: rgba(255,255,255,0.85);
            margin-top: 4px;
        }
        .email-body {
            padding: 36px 40px;
        }
        .email-body p {
            font-size: 15px;
            line-height: 1.7;
            color: #374151;
            margin-bottom: 16px;
        }
        .email-body strong { color: #111827; }
        .btn-reset {
            display: block;
            background: linear-gradient(135deg, #15803D, #4ADE80);
            color: #FFFFFF !important;
            text-decoration: none;
            text-align: center;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            margin: 24px 0;
        }
        .aviso {
            background: #FEF9C3;
            border: 1px solid #FDE68A;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            color: #92400E;
            margin-bottom: 16px;
        }
        .enlace-texto {
            font-size: 12px;
            color: #9CA3AF;
            word-break: break-all;
            margin-top: 8px;
        }
        .email-footer {
            border-top: 1px solid #F3F4F6;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #9CA3AF;
        }
    </style>
</head>
<body>
    <div class="email-wrap">
        <div class="email-card">

            <div class="email-header">
                <h1>Bitlyx Academy</h1>
                <p>Sistema Interactivo de Aprendizaje</p>
            </div>

            <div class="email-body">
                <p>Hola, <strong>{{ $nombreUsuario }}</strong>.</p>

                <p>Recibimos una solicitud para restablecer la contraseña de tu cuenta en Bitlyx Academy. Si fuiste tú, haz clic en el botón de abajo:</p>

                <a href="{{ $enlace }}" class="btn-reset">
                    Restablecer mi contraseña
                </a>

                <div class="aviso">
                    Este enlace expira en <strong>60 minutos</strong>. Si no lo usas a tiempo, deberás solicitar uno nuevo.
                </div>

                <p>Si tú no solicitaste este cambio, ignora este correo. Tu contraseña seguirá siendo la misma.</p>

                <p class="enlace-texto">Si el botón no funciona, copia y pega este enlace en tu navegador:<br>{{ $enlace }}</p>
            </div>

            <div class="email-footer">
                © {{ date('Y') }} Bitlyx Academy — Universidad Gerardo Barrios<br>
                Este es un correo automático, no respondas a este mensaje.
            </div>

        </div>
    </div>
</body>
</html>
