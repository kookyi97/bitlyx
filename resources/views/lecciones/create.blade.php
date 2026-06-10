<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Bitlyx Academy — Nueva Lección</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Nunito', sans-serif;
            background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);
            color: #111827;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
        }

        /* Contenido principal */
        .main-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Tarjeta de información */
        .info-card {
            background: #FFFFFF;
            border-radius: 24px;
            border: 1px solid #E5E7EB;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .info-title h2 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #064E3B;
            margin-bottom: 0.25rem;
        }

        .info-title p {
            color: #6B7280;
            font-size: 0.85rem;
        }

        .info-badge {
            background: #E8F5E9;
            color: #15803D;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Formulario */
        .form-group {
            margin-bottom: 1.8rem;
        }

        label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 600;
            color: #065F46;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        label i {
            margin-right: 8px;
            color: #4ADE80;
            font-size: 0.85rem;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1.5px solid #D1D5DB;
            border-radius: 16px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #FFFFFF;
            outline: none;
            color: #111827;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            border-color: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.15);
        }

        textarea {
            resize: vertical;
            min-height: 200px;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            opacity: 0.5;
        }

        /* Botones de acción */
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-primary {
            background: linear-gradient(105deg, #15803D 0%, #4ADE80 100%);
            color: white;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 40px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary i {
            font-size: 1rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -8px rgba(21, 128, 61, 0.4);
            background: linear-gradient(105deg, #0F5C2E 0%, #3BAA5C 100%);
        }

        .btn-secondary {
            background: #FFFFFF;
            color: #6B7280;
            border: 1.5px solid #D1D5DB;
            padding: 0.85rem 2rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .btn-secondary i {
            color: #9CA3AF;
        }

        .btn-secondary:hover {
            background: #F9FAFB;
            border-color: #4ADE80;
            color: #15803D;
        }

        .btn-secondary:hover i {
            color: #4ADE80;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9CA3AF;
            font-weight: 400;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            .info-title h2 {
                font-size: 1.2rem;
            }
            .info-card {
                padding: 1.2rem;
                flex-direction: column;
                text-align: center;
            }
            .form-actions {
                flex-direction: column;
            }
            .btn-primary, .btn-secondary {
                justify-content: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Contenido principal -->
    <div class="main-content">
        <!-- Tarjeta de información -->
        <div class="info-card">
            <div class="info-title">
                <h2><i class="fas fa-plus-circle" style="color: #4ADE80; margin-right: 10px;"></i> Nueva Lección</h2>
                <p>Agrega una nueva lección al módulo</p>
            </div>
            <div class="info-badge">
                <i class="fas fa-layer-group"></i> Módulo: {{ $modulo->titulo }}
            </div>
        </div>

        <!-- Formulario -->
        <form action="/modulos/{{ $modulo->id }}/lecciones" method="POST">
            @csrf

            <div class="form-group">
                <label>
                    <i class="fas fa-tag"></i> Título
                </label>
                <input type="text" name="titulo" required maxlength="150" value="{{ old('titulo') }}" placeholder="Título de la lección">
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-sort-numeric-down"></i> Orden
                </label>
                <input type="number" name="orden" value="{{ old('orden', 0) }}" placeholder="Número de orden (ej: 1, 2, 3...)">
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-align-left"></i> Contenido
                </label>
                <textarea name="contenido" rows="10" placeholder="Contenido de la lección (video embed, texto, etc.)">{{ old('contenido') }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Guardar Lección
                </button>
                <a href="/modulos/{{ $modulo->id }}/lecciones" class="btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</body>
</html>