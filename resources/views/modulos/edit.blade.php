
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Bitlyx Academy — Editar Módulo</title>
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

        /* Contenido principal - SIN barra superior */
        .main-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Tarjeta de información */
        .module-info-card {
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

        .module-title h2 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #064E3B;
            margin-bottom: 0.25rem;
        }

        .module-title p {
            color: #6B7280;
            font-size: 0.85rem;
        }

        .module-badge {
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
        textarea:focus,
        select:focus {
            border-color: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.15);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%234ADE80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
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
            .module-title h2 {
                font-size: 1.2rem;
            }
            .module-info-card {
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
    <!-- Contenido principal - SIN barra superior -->
    <div class="main-content">
        <!-- Tarjeta de información -->
        <div class="module-info-card">
            <div class="module-title">
                <h2><i class="fas fa-pen-alt" style="color: #4ADE80; margin-right: 10px;"></i> Editar Módulo</h2>
                <p>Modifica los campos del módulo seleccionado</p>
            </div>
            <div class="module-badge">
                <i class="fas fa-edit"></i> ID Módulo: {{ $modulo->id }}
            </div>
        </div>

        <!-- Formulario -->
        <form action="/modulos/{{ $modulo->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>
                    <i class="fas fa-tag"></i> Título
                </label>
                <input type="text" name="titulo" value="{{ old('titulo', $modulo->titulo) }}" required maxlength="150" placeholder="Nombre del módulo">
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-align-left"></i> Descripción
                </label>
                <textarea name="descripcion" rows="5" placeholder="Descripción detallada del módulo...">{{ old('descripcion', $modulo->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-globe"></i> Estado
                </label>
                <select name="estado">
                    <option value="borrador" {{ old('estado', $modulo->estado) === 'borrador' ? 'selected' : '' }}>
                        Borrador
                    </option>
                    <option value="publicado" {{ old('estado', $modulo->estado) === 'publicado' ? 'selected' : '' }}>
                        Publicado
                    </option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Actualizar Módulo
                </button>
                <a href="/modulos" class="btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</body>
</html>
```