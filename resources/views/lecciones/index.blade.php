<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bitlyx — Lecciones del Módulo</title>
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
        .page-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem}
        .page-title{font-family:'Nunito',sans-serif;font-size:1.6rem;font-weight:800;color:#111827;transition:color .3s}
        .page-sub{font-size:.85rem;color:#6B7280;margin-top:4px}
        .header-right{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
        .dark-btn{background:transparent;border:1px solid #E5E7EB;border-radius:50%;width:36px;height:36px;font-size:17px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0}
        .dark-btn:hover{transform:scale(1.1)}
        .btn-back{display:inline-flex;align-items:center;gap:6px;padding:.5rem 1.1rem;background:#fff;border:1.5px solid #E5E7EB;border-radius:8px;font-size:.85rem;font-weight:600;color:#374151;text-decoration:none;transition:all .2s}
        .btn-back:hover{background:#F3F4F6}
        .btn-new{background:#4ADE80;color:#064E3B;padding:.55rem 1.2rem;border-radius:40px;text-decoration:none;font-weight:700;font-size:.875rem;display:inline-flex;align-items:center;gap:8px;transition:all .2s;border:none;cursor:pointer}
        .btn-new:hover{background:#15803D;color:#fff}
        .alert{background:#E8F5E9;border-left:4px solid #4ADE80;color:#15803D;padding:.875rem 1.2rem;border-radius:12px;margin-bottom:1.25rem;font-weight:500;display:flex;align-items:center;gap:10px}
        .table-wrapper{background:#fff;border-radius:20px;border:1px solid #E5E7EB;overflow:hidden;overflow-x:auto;box-shadow:0 1px 4px rgba(0,0,0,.04);transition:background .3s,border-color .3s}
        table{width:100%;border-collapse:collapse;font-size:.875rem}
        th{text-align:left;padding:.875rem 1.25rem;background:#F9FAFB;font-weight:700;color:#374151;border-bottom:1px solid #E5E7EB;white-space:nowrap;transition:background .3s,color .3s}
        td{padding:.875rem 1.25rem;border-bottom:1px solid #F3F4F6;color:#4B5563;vertical-align:top;transition:color .3s,border-color .3s}
        tr:last-child td{border-bottom:none}
        tr:hover td{background:#F0FDF4}
        .contenido-cell{max-width:300px;white-space:pre-wrap;word-break:break-word;font-size:.82rem;color:#6B7280}
        .btn-actions{display:flex;gap:6px;flex-wrap:wrap}
        .btn-warning{background:#FEF3C7;color:#B45309;padding:.4rem .9rem;border-radius:40px;text-decoration:none;font-size:.75rem;font-weight:600;transition:all .2s;display:inline-flex;align-items:center;gap:5px}
        .btn-warning:hover{background:#F59E0B;color:#fff}
        .btn-danger{background:#FEE2E2;color:#B91C1C;border:none;padding:.4rem .9rem;border-radius:40px;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:5px}
        .btn-danger:hover{background:#DC2626;color:#fff}
        .empty-message{background:#fff;border-radius:20px;padding:3rem;text-align:center;border:1px solid #E5E7EB;color:#6B7280;transition:background .3s,border-color .3s}
        .empty-message i{font-size:2.5rem;margin-bottom:1rem;color:#D1D5DB;display:block}

        /* DARK MODE */
        #html-root.dark body{background:#0D0D0D !important;color:#F9FAFB !important}
        #html-root.dark .sidebar{background:#111111 !important;border-color:#2D2D2D !important}
        #html-root.dark .logo-academy{color:#9CA3AF !important}
        #html-root.dark .nav-item{color:#9CA3AF !important}
        #html-root.dark .nav-item:hover,#html-root.dark .nav-item.active{background:#1A1A1A !important;color:#4ADE80 !important}
        #html-root.dark .nav-item:hover i,#html-root.dark .nav-item.active i{color:#4ADE80 !important}
        #html-root.dark .logout-sidebar{border-color:#2D2D2D !important}
        #html-root.dark .page-title{color:#F9FAFB !important}
        #html-root.dark .page-sub{color:#9CA3AF !important}
        #html-root.dark .table-wrapper,#html-root.dark .empty-message{background:#1A1A1A !important;border-color:#2D2D2D !important}
        #html-root.dark th{background:#111111 !important;color:#9CA3AF !important;border-color:#2D2D2D !important}
        #html-root.dark td{color:#F9FAFB !important;border-color:#2D2D2D !important}
        #html-root.dark tr:hover td{background:#1E3A2F !important}
        #html-root.dark .contenido-cell{color:#9CA3AF !important}
        #html-root.dark .btn-back{background:#1A1A1A !important;border-color:#2D2D2D !important;color:#F9FAFB !important}
        #html-root.dark .dark-btn{border-color:#2D2D2D !important}
        #html-root.dark .alert{background:#14532D !important;color:#bbf7d0 !important}

        @media(max-width:768px){.app-wrapper{flex-direction:column}.sidebar{width:100%;height:auto;position:relative;padding:1rem;border-right:none;border-bottom:1px solid #E5E7EB}.contenido-cell{max-width:160px}}
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
            <a href="/modulos" class="nav-item active">
                <i class="fas fa-folder-tree"></i><span>Módulos</span>
            </a>
            <a href="{{ route('admin.preguntas.index') }}" class="nav-item">
                <i class="fas fa-circle-question"></i><span>Preguntas Quiz</span>
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="nav-item">
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
            <div>
                <h1 class="page-title">
                    <i class="fas fa-book-open" style="color:#4ADE80;margin-right:10px"></i>
                    {{ $modulo->titulo }}
                </h1>
                <p class="page-sub">ID Módulo: #{{ $modulo->id }} · {{ $lecciones->total() }} lecciones</p>
            </div>
            <div class="header-right">
                <button class="dark-btn" id="dark-btn" title="Modo oscuro">🌙</button>
                <a href="/modulos/{{ $modulo->id }}/lecciones/create" class="btn-new">
                    <i class="fas fa-plus-circle"></i> Nueva Lección
                </a>
                <a href="/modulos" class="btn-back">← Módulos</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        @if($lecciones->count() > 0)
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="width:70px">Orden</th>
                        <th>Título</th>
                        <th>Contenido</th>
                        <th style="width:160px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lecciones as $leccion)
                    <tr>
                        <td><strong>{{ $leccion->orden }}</strong></td>
                        <td><strong>{{ $leccion->titulo }}</strong></td>
                        <td class="contenido-cell">{{ Str::limit($leccion->contenido, 120) }}</td>
                        <td>
                            <div class="btn-actions">
                                <a href="/lecciones/{{ $leccion->id }}/edit" class="btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="/lecciones/{{ $leccion->id }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger"
                                            onclick="return confirm('¿Eliminar esta lección?')">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top:1.5rem;display:flex;justify-content:center">
            {{ $lecciones->links() }}
        </div>
        @else
        <div class="empty-message">
            <i class="fas fa-book-open"></i>
            <p style="margin-bottom:1rem">No hay lecciones en este módulo.</p>
            <a href="/modulos/{{ $modulo->id }}/lecciones/create" class="btn-new">
                <i class="fas fa-plus-circle"></i> Crear primera lección
            </a>
        </div>
        @endif
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