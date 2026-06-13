<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx — Gestión de Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter','Nunito',sans-serif;background:#F3F4F6;color:#111827;line-height:1.5;transition:background .3s,color .3s}
        .app-wrapper{display:flex;min-height:100vh}
        .sidebar{width:260px;background:#fff;border-right:1px solid #E5E7EB;padding:2rem 1.5rem;position:sticky;top:0;height:100vh;display:flex;flex-direction:column;transition:background .3s,border-color .3s;flex-shrink:0}
        .logo-bitlyx{font-family:'Nunito',sans-serif;font-weight:800;font-size:1.8rem;background:linear-gradient(135deg,#15803D,#4ADE80);background-clip:text;-webkit-background-clip:text;color:transparent}
        .logo-academy{font-family:'Nunito',sans-serif;font-weight:600;font-size:1rem;color:#6B7280;margin-left:4px}
        .logo-area{margin-bottom:2rem}
        .nav-menu{flex:1;display:flex;flex-direction:column;gap:.5rem}
        .nav-item{display:flex;align-items:center;gap:12px;padding:.75rem 1rem;border-radius:12px;color:#4B5563;font-weight:500;transition:all .2s;text-decoration:none;font-size:.9rem}
        .nav-item i{width:20px;font-size:1.1rem;color:#9CA3AF}
        .nav-item:hover{background:#F3F4F6;color:#15803D}.nav-item:hover i{color:#4ADE80}
        .nav-item.active{background:#E8F5E9;color:#15803D;font-weight:600}.nav-item.active i{color:#4ADE80}
        .logout-sidebar{margin-top:2rem;border-top:1px solid #E5E7EB;padding-top:1.5rem}
        .main-content{flex:1;padding:2rem;overflow-x:auto}
        .page-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem}
        .page-title{font-family:'Nunito',sans-serif;font-size:1.6rem;font-weight:800;color:#111827;transition:color .3s}
        .btn-back{display:inline-flex;align-items:center;gap:6px;padding:.5rem 1.1rem;background:#fff;border:1.5px solid #E5E7EB;border-radius:8px;font-size:.85rem;font-weight:600;color:#374151;text-decoration:none;transition:all .2s}
        .btn-back:hover{background:#F3F4F6}
        .dark-btn{background:transparent;border:1px solid #E5E7EB;border-radius:50%;width:36px;height:36px;font-size:17px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0}
        .dark-btn:hover{transform:scale(1.1)}
        .table-wrapper{background:#fff;border-radius:20px;border:1px solid #E5E7EB;overflow:hidden;overflow-x:auto;box-shadow:0 1px 4px rgba(0,0,0,.04);transition:background .3s,border-color .3s}
        table{width:100%;border-collapse:collapse;font-size:.875rem}
        th{text-align:left;padding:.875rem 1.25rem;background:#F9FAFB;font-weight:700;color:#374151;border-bottom:1px solid #E5E7EB;white-space:nowrap;transition:background .3s,color .3s}
        td{padding:.875rem 1.25rem;border-bottom:1px solid #F3F4F6;color:#4B5563;vertical-align:middle;transition:color .3s,border-color .3s}
        tr:last-child td{border-bottom:none}
        tr:hover td{background:#FEFCE8}
        .role-badge{display:inline-block;padding:3px 10px;border-radius:40px;font-size:.75rem;font-weight:600}
        .role-admin{background:#E8F5E9;color:#15803D}
        .role-user{background:#F3F4F6;color:#6B7280}
        .status-active{background:#E8F5E9;color:#15803D}
        .status-inactive{background:#FEE2E2;color:#B91C1C}
        .btn-toggle{border:none;padding:.4rem 1rem;border-radius:40px;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:6px}
        .btn-toggle.btn-success{background:#4ADE80;color:#064E3B}
        .btn-toggle.btn-success:hover{background:#15803D;color:#fff}
        .btn-toggle.btn-warning{background:#FEF3C7;color:#B45309}
        .btn-toggle.btn-warning:hover{background:#F59E0B;color:#fff}

        /* DARK MODE */
        #html-root.dark body{background:#0D0D0D !important;color:#F9FAFB !important}
        #html-root.dark .sidebar{background:#111111 !important;border-color:#2D2D2D !important}
        #html-root.dark .logo-academy{color:#9CA3AF !important}
        #html-root.dark .nav-item{color:#9CA3AF !important}
        #html-root.dark .nav-item:hover,#html-root.dark .nav-item.active{background:#1A1A1A !important;color:#4ADE80 !important}
        #html-root.dark .nav-item:hover i,#html-root.dark .nav-item.active i{color:#4ADE80 !important}
        #html-root.dark .logout-sidebar{border-color:#2D2D2D !important}
        #html-root.dark .page-title{color:#F9FAFB !important}
        #html-root.dark .table-wrapper{background:#1A1A1A !important;border-color:#2D2D2D !important}
        #html-root.dark th{background:#111111 !important;color:#9CA3AF !important;border-color:#2D2D2D !important}
        #html-root.dark td{color:#F9FAFB !important;border-color:#2D2D2D !important}
        #html-root.dark tr:hover td{background:#111111 !important}
        #html-root.dark .btn-back{background:#1A1A1A !important;border-color:#2D2D2D !important;color:#F9FAFB !important}
        #html-root.dark .dark-btn{border-color:#2D2D2D !important}
        #html-root.dark .role-user{background:#2D2D2D !important;color:#9CA3AF !important}

        @media(max-width:768px){.app-wrapper{flex-direction:column}.sidebar{width:100%;height:auto;position:relative;padding:1rem;border-right:none;border-bottom:1px solid #E5E7EB}}
    </style>
</head>
<body>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
<div class="app-wrapper">
    <aside class="sidebar">
        <div class="logo-area">
            <span class="logo-bitlyx">Bitlyx</span>
            <span class="logo-academy">Academy</span>
        </div>
        <div class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
            </a>
            <a href="/modulos" class="nav-item">
                <i class="fas fa-folder-tree"></i><span>Módulos</span>
            </a>
            <a href="{{ route('admin.preguntas.index') }}" class="nav-item">
                <i class="fas fa-circle-question"></i><span>Preguntas Quiz</span>
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="nav-item active">
                <i class="fas fa-user-shield"></i><span>Usuarios</span>
            </a>
            <a href="{{ route('admin.resultados_quiz.index') }}" class="nav-item">
                <i class="fas fa-chart-simple"></i><span>Resultados</span>
            </a>
        </div>
        <div class="logout-sidebar">
            <a href="{{ route('logout') }}" class="nav-item"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i><span>Cerrar Sesión</span>
            </a>
        </div>
    </aside>

    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title"><i class="fas fa-user-shield" style="color:#4ADE80;margin-right:10px"></i>Gestión de Usuarios</h1>
            <div style="display:flex;gap:10px;align-items:center">
                <button class="dark-btn" id="dark-btn" title="Modo oscuro">🌙</button>
                <a href="{{ route('admin.dashboard') }}" class="btn-back">← Dashboard</a>
            </div>
        </div>

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
                        <td style="color:#6B7280">{{ $u->email }}</td>
                        <td>
                            <span class="role-badge {{ ($u->rol->nombre ?? 'usuario') == 'admin' ? 'role-admin' : 'role-user' }}">
                                {{ $u->rol->nombre ?? 'usuario' }}
                            </span>
                        </td>
                        <td><strong style="color:#15803D">{{ $u->xp_total ?? 0 }} XP</strong></td>
                        <td>
                            <span class="role-badge {{ $u->activo ? 'status-active' : 'status-inactive' }}">
                                {{ $u->activo ? '✓ Activo' : '✗ Inactivo' }}
                            </span>
                        </td>
                        <td style="color:#6B7280;font-size:.8rem">{{ date('d/m/Y', strtotime($u->created_at)) }}</td>
                        <td>
                            <form action="{{ route('admin.usuarios.toggle', $u->id) }}" method="POST" style="display:inline">
                                @csrf @method('PATCH')
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
        <div style="margin-top:1.5rem;display:flex;justify-content:center">
            {{ $usuarios->links() }}
        </div>
    </main>
</div>

<script>
(function() {
    var btn  = document.getElementById('dark-btn');
    var root = document.getElementById('html-root');
    function applyDark(on) {
        on ? root.classList.add('dark') : root.classList.remove('dark');
        if (btn) btn.textContent = on ? '☀️' : '🌙';
        localStorage.setItem('bitlyx-dark', on ? '1' : '0');
    }
    applyDark(localStorage.getItem('bitlyx-dark') === '1');
    if (btn) btn.addEventListener('click', function() { applyDark(!root.classList.contains('dark')); });
})();
</script>
</body>
</html>