<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin | Bitlyx</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f5f5f5; }
        .header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .stats { display: flex; gap: 20px; margin-bottom: 40px; flex-wrap: wrap; }
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            flex: 1;
            min-width: 150px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .stat-card h2 { font-size: 42px; margin-bottom: 10px; }
        .stat-card p { color: #666; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; }
        .stat-card.modulos h2 { color: #3498db; }
        .stat-card.lecciones h2 { color: #2ecc71; }
        .stat-card.usuarios h2 { color: #e74c3c; }
        .menu {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .menu h3 { margin-bottom: 20px; color: #333; border-bottom: 2px solid #3498db; display: inline-block; }
        .menu-buttons { display: flex; gap: 15px; flex-wrap: wrap; margin-top: 20px; }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary { background: #3498db; color: white; }
        .btn-success { background: #2ecc71; color: white; }
        .btn-info { background: #1abc9c; color: white; }
        .logout {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #e74c3c;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Panel de Administración</h1>
        <p>Bienvenido, {{ Auth::user()->nombre ?? 'Admin' }}</p>
    </div>

    <div class="container">
        <div class="stats">
            <div class="stat-card modulos">
                <h2>{{ $totalModulos ?? 0 }}</h2>
                <p>Módulos</p>
            </div>
            <div class="stat-card lecciones">
                <h2>{{ $totalLecciones ?? 0 }}</h2>
                <p>Lecciones</p>
            </div>
            <div class="stat-card usuarios">
                <h2>{{ $totalUsuarios ?? 0 }}</h2>
                <p>Usuarios</p>
            </div>
        </div>

        <div class="menu">
            <h3>📋 Gestión de Contenido</h3>
            <div class="menu-buttons">
                <a href="{{ route('modulos.index') }}" class="btn btn-primary">📚 Gestionar Módulos</a>
               <a href="{{ route('modulos.create') }}" class="btn btn-success">➕ Crear Módulo</a>
            </div>
        </div>
    </div>

    <form action="{{ route('logout') }}" method="POST" style="position: fixed; top: 20px; right: 20px;">
        @csrf
        <button type="submit" class="btn" style="background: #e74c3c; color: white; padding: 8px 16px;">🚪 Cerrar Sesión</button>
    </form>
</body>
</html>