<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx Academy - @yield('title', 'Aprende Tecnología')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Nunito', sans-serif;
            background: #F3F4F6;
            color: #111827;
        }

        /* Layout con sidebar */
        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar minimalista */
        .sidebar {
            width: 280px;
            background: #FFFFFF;
            border-right: 1px solid #E5E7EB;
            padding: 24px 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #15803D;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo span {
            background: #4ADE80;
            color: #15803D;
            font-size: 18px;
            padding: 4px 8px;
            border-radius: 10px;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #6B7280;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s;
            font-weight: 500;
        }

        .nav-link:hover {
            background: #F3F4F6;
            color: #111827;
        }

        .nav-link.active {
            background: #4ADE80;
            color: #15803D;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 32px 40px;
        }

        /* Header superior */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            font-weight: 500;
            color: #111827;
        }

        .logout-btn {
            background: #4ADE80;
            color: #15803D;
            padding: 8px 20px;
            border: none;
            border-radius: 100px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: #15803D;
            color: white;
        }

        /* Tarjetas */
        .card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            transition: box-shadow 0.2s;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        /* Botones */
        .btn-primary {
            background: #4ADE80;
            color: #15803D;
            padding: 10px 24px;
            border: none;
            border-radius: 100px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #15803D;
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #4ADE80;
            color: #15803D;
            padding: 10px 24px;
            border-radius: 100px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        /* Tablas */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            text-align: left;
            padding: 12px 16px;
            background: #F3F4F6;
            color: #6B7280;
            font-weight: 600;
            font-size: 14px;
        }

        .table td {
            padding: 16px;
            border-bottom: 1px solid #E5E7EB;
        }

        /* Paginación */
        .pagination {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 32px;
        }

        .pagination a, .pagination span {
            padding: 8px 14px;
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            text-decoration: none;
            color: #111827;
        }

        .pagination .active span {
            background: #4ADE80;
            color: #15803D;
            border-color: #4ADE80;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <span>B</span> Bitlyx Academy
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('user.dashboard') }}" class="nav-link">📊 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('modulos.index') }}" class="nav-link">📚 Mis Cursos</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">🏆 Logros</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">⚙️ Configuración</a>
                </li>
            </ul>
        </aside>

        <!-- Contenido -->
        <main class="main-content">
            <div class="top-bar">
                <h1 class="page-title">@yield('title-page', 'Dashboard')</h1>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->nombre ?? Auth::user()->name ?? 'Usuario' }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="logout-btn">Cerrar sesión</button>
                    </form>
                </div>
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>