<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx Academy — Gestión de Usuarios</title>
    <!-- Google Fonts: Nunito + Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            line-height: 1.5;
            padding: 2rem;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header / barra superior */
        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .logo-area h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
        }

        .logo-area span {
            background: linear-gradient(135deg, #15803D, #4ADE80);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Botón Volver al Dashboard */
        .btn-primary {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            color: #374151;
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: #4ADE80;
            border-color: #4ADE80;
            color: #064E3B;
        }

        /* Título principal */
        .page-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        /* Tabla moderna */
        .table-wrapper {
            background: #FFFFFF;
            border-radius: 24px;
            border: 1px solid #E5E7EB;
            overflow-x: auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        th {
            text-align: left;
            padding: 1rem 1rem;
            background: #F9FAFB;
            font-weight: 700;
            color: #374151;
            border-bottom: 1px solid #E5E7EB;
            font-family: 'Nunito', sans-serif;
        }

        td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid #F3F4F6;
            color: #4B5563;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #FEFCE8;
        }

        /* Badges para roles y estados */
        .role-badge {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .role-admin {
            background: #E8F5E9;
            color: #15803D;
        }

        .role-user {
            background: #F3F4F6;
            color: #6B7280;
        }

        .status-active {
            background: #E8F5E9;
            color: #15803D;
        }

        .status-inactive {
            background: #FEE2E2;
            color: #B91C1C;
        }

        /* Botón de activar/desactivar */
        .btn-toggle {
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-toggle.btn-success {
            background: #4ADE80;
            color: #064E3B;
        }

        .btn-toggle.btn-success:hover {
            background: #15803D;
            color: white;
        }

        .btn-toggle.btn-warning {
            background: #FEF3C7;
            color: #B45309;
        }

        .btn-toggle.btn-warning:hover {
            background: #F59E0B;
            color: white;
        }

        /* Paginación */
        .pagination-wrapper {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .pagination a, .pagination span {
            padding: 0.5rem 1rem;
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 40px;
            text-decoration: none;
            color: #374151;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background: #4ADE80;
            border-color: #4ADE80;
            color: #064E3B;
        }

        .pagination .active span {
            background: #15803D;
            color: white;
            border-color: #15803D;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            th, td {
                padding: 0.6rem;
            }
            .btn-toggle {
                padding: 0.3rem 0.7rem;
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header con botón Volver al Dashboard -->
        <div class="header-bar">
            <div class="logo-area">
                <h1>Bitlyx <span>Academy</span></h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-primary">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>

        <h1 class="page-title">Gestión de Usuarios</h1>

        <!-- Tabla de usuarios -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>XP</th>
                        <th>Estado</th>
                        <th>Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $u)
                    <tr>
                        <td>{{ $u->id }}</td>
                        <td><strong>{{ $u->nombre }}</strong></td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="role-badge {{ ($u->rol->nombre ?? 'usuario') == 'admin' ? 'role-admin' : 'role-user' }}">
                                {{ $u->rol->nombre ?? 'usuario' }}
                            </span>
                        </td>
                        <td>{{ $u->xp_total ?? 0 }} XP</td>
                        <td>
                            <span class="role-badge {{ $u->activo ? 'status-active' : 'status-inactive' }}">
                                {{ $u->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($u->created_at)) }}</td>
                        <td>
                            <form action="{{ route('admin.usuarios.toggle', $u->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-toggle {{ $u->activo ? 'btn-warning' : 'btn-success' }}">
                                    <i class="fas {{ $u->activo ? 'fa-ban' : 'fa-check-circle' }}"></i>
                                    {{ $u->activo ? 'Desactivar' : 'Activar' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación (exactamente igual) -->
        <div class="pagination-wrapper">
            {{ $usuarios->links('pagination::simple-bootstrap-4') }}
        </div>
    </div>
</body>
</html>