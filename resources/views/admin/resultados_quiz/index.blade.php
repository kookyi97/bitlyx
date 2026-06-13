<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitlyx — Resultados de Quizzes</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',sans-serif;background:#F3F4F6;color:#111827;line-height:1.5;transition:background .3s,color .3s}
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
        .page-title{font-family:'Nunito',sans-serif;font-size:1.6rem;font-weight:800;color:#111827}
        .page-sub{font-size:.85rem;color:#6B7280;margin-top:2px}
        .stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem}
        .stat-card{background:#fff;border:1px solid #E5E7EB;border-radius:16px;padding:1.25rem 1.5rem;display:flex;align-items:center;gap:1rem;transition:background .3s,border-color .3s}
        .stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
        .stat-val{font-family:'Nunito',sans-serif;font-size:1.8rem;font-weight:800;color:#111827;line-height:1}
        .stat-lbl{font-size:.75rem;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:.4px}
        .filter-card{background:#fff;border:1px solid #E5E7EB;border-radius:16px;padding:1.25rem 1.5rem;margin-bottom:1.5rem;display:flex;gap:1rem;flex-wrap:wrap;align-items:flex-end;transition:background .3s,border-color .3s}
        .filter-group{display:flex;flex-direction:column;gap:4px;flex:1;min-width:160px}
        .filter-group label{font-size:.75rem;font-weight:600;color:#6B7280;text-transform:uppercase;letter-spacing:.4px}
        .filter-group select{padding:.55rem .75rem;border:1.5px solid #E5E7EB;border-radius:8px;font-size:.875rem;color:#111827;background:#fff;transition:background .3s,border-color .3s,color .3s}
        .btn-filter{padding:.6rem 1.4rem;background:#15803D;color:#fff;border:none;border-radius:8px;font-size:.875rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;white-space:nowrap}
        .btn-filter:hover{background:#166534}
        .table-card{background:#fff;border:1px solid #E5E7EB;border-radius:16px;overflow:hidden;transition:background .3s,border-color .3s}
        .table-header{padding:1rem 1.5rem;border-bottom:1px solid #E5E7EB;display:flex;align-items:center;gap:.5rem;font-size:.875rem;font-weight:700;color:#374151;transition:border-color .3s}
        .count-badge{background:#DCFCE7;color:#15803D;font-size:.75rem;font-weight:700;padding:2px 10px;border-radius:20px}
        table{width:100%;border-collapse:collapse}
        thead th{padding:.875rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid #F3F4F6;background:#F9FAFB;transition:background .3s,color .3s}
        tbody td{padding:.875rem 1.25rem;font-size:.875rem;border-bottom:1px solid #F9FAFB;vertical-align:middle;transition:color .3s,border-color .3s}
        tbody tr:hover{background:#F9FAFB}
        tbody tr:last-child td{border-bottom:none}
        .badge-aprobado{background:#DCFCE7;color:#14532D;font-size:.75rem;font-weight:700;padding:3px 10px;border-radius:20px}
        .badge-reprobado{background:#FEE2E2;color:#991B1B;font-size:.75rem;font-weight:700;padding:3px 10px;border-radius:20px}
        .pct-bar-bg{background:#F3F4F6;border-radius:99px;height:6px;width:80px;overflow:hidden;display:inline-block;vertical-align:middle;margin-right:6px}
        .pct-bar-fill{height:100%;background:linear-gradient(90deg,#15803D,#4ADE80);border-radius:99px}
        .empty-state{padding:3rem;text-align:center;color:#9CA3AF;font-size:.9rem}
        .pagination-wrap{padding:1rem 1.5rem;border-top:1px solid #F3F4F6;display:flex;justify-content:flex-end}
        .btn-back{display:inline-flex;align-items:center;gap:6px;padding:.5rem 1.1rem;background:#fff;border:1.5px solid #E5E7EB;border-radius:8px;font-size:.85rem;font-weight:600;color:#374151;text-decoration:none}
        .btn-back:hover{background:#F3F4F6}

        /* DARK MODE */
        #html-root.dark body{background:#0D0D0D !important;color:#F9FAFB !important}
        #html-root.dark .sidebar{background:#111111 !important;border-color:#2D2D2D !important}
        #html-root.dark .logo-academy{color:#9CA3AF !important}
        #html-root.dark .nav-item{color:#9CA3AF !important}
        #html-root.dark .nav-item:hover,#html-root.dark .nav-item.active{background:#1A1A1A !important;color:#4ADE80 !important}
        #html-root.dark .nav-item:hover i,#html-root.dark .nav-item.active i{color:#4ADE80 !important}
        #html-root.dark .logout-sidebar{border-color:#2D2D2D !important}
        #html-root.dark .page-title{color:#F9FAFB !important}
        #html-root.dark .stat-card,#html-root.dark .filter-card,#html-root.dark .table-card{background:#1A1A1A !important;border-color:#2D2D2D !important}
        #html-root.dark .stat-val{color:#F9FAFB !important}
        #html-root.dark .table-header{border-color:#2D2D2D !important;color:#F9FAFB !important}
        #html-root.dark thead th{background:#111111 !important;color:#9CA3AF !important;border-color:#2D2D2D !important}
        #html-root.dark tbody td{color:#F9FAFB !important;border-color:#2D2D2D !important}
        #html-root.dark tbody tr:hover{background:#111111 !important}
        #html-root.dark .filter-group select{background:#1A1A1A !important;border-color:#2D2D2D !important;color:#F9FAFB !important}
        #html-root.dark .btn-back{background:#1A1A1A !important;border-color:#2D2D2D !important;color:#F9FAFB !important}
        #html-root.dark .pct-bar-bg{background:#2D2D2D !important}
        #html-root.dark .pagination-wrap{border-color:#2D2D2D !important}
        #html-root.dark .dark-btn{border-color:#2D2D2D !important}

        @media(max-width:768px){.app-wrapper{flex-direction:column}.sidebar{width:100%;height:auto;position:relative;padding:1rem;border-right:none;border-bottom:1px solid #E5E7EB}.stats-grid{grid-template-columns:1fr}}
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
            <a href="{{ route('admin.usuarios.index') }}" class="nav-item">
                <i class="fas fa-user-shield"></i><span>Usuarios</span>
            </a>
            <a href="{{ route('admin.resultados_quiz.index') }}" class="nav-item active">
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
                <h1 class="page-title">Resultados de Quizzes</h1>
                <p class="page-sub">Historial de intentos y puntuaciones de todos los usuarios</p>
            </div>
            <div style="display:flex;gap:10px;align-items:center">
                <button class="dark-btn" id="dark-btn" title="Cambiar tema"
                    style="background:transparent;border:1px solid #E5E7EB;border-radius:50%;width:36px;height:36px;font-size:17px;cursor:pointer;display:flex;align-items:center;justify-content:center">🌙</button>
                <a href="{{ route('admin.dashboard') }}" class="btn-back">← Dashboard</a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background:#DCFCE7">📋</div>
                <div><div class="stat-val">{{ $totalResultados }}</div><div class="stat-lbl">Total resultados</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#FEF9C3">🏆</div>
                <div><div class="stat-val" style="color:#15803D">{{ $totalAprobados }}</div><div class="stat-lbl">Aprobados (≥70%)</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#EDE9FE">⚡</div>
                <div><div class="stat-val" style="color:#7C3AED">{{ $xpPromedio }}</div><div class="stat-lbl">XP promedio</div></div>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.resultados_quiz.index') }}">
            <div class="filter-card">
                <div class="filter-group">
                    <label>Usuario</label>
                    <select name="usuario_id">
                        <option value="">Todos los usuarios</option>
                        @foreach($usuarios as $u)
                            <option value="{{ $u->id }}" {{ request('usuario_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->nombre ?? $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Módulo</label>
                    <select name="modulo_id">
                        <option value="">Todos los módulos</option>
                        @foreach($modulos as $m)
                            <option value="{{ $m->id }}" {{ request('modulo_id') == $m->id ? 'selected' : '' }}>
                                {{ $m->titulo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-filter"><i class="fas fa-search"></i> Filtrar</button>
            </div>
        </form>

        <div class="table-card">
            <div class="table-header">
                <i class="fas fa-list" style="color:#4ADE80"></i>
                Resultados
                <span class="count-badge">{{ $resultados->total() }}</span>
            </div>

            @if($resultados->count())
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Módulo</th>
                        <th>Puntaje</th>
                        <th>Correctas</th>
                        <th>XP</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resultados as $r)
                    @php $pct = $r->total > 0 ? round($r->correctas/$r->total*100) : 0; @endphp
                    <tr>
                        <td><strong>{{ $r->usuario->nombre ?? $r->usuario->name ?? '—' }}</strong></td>
                        <td>{{ $r->modulo->titulo ?? '—' }}</td>
                        <td>
                            <div class="pct-bar-bg"><div class="pct-bar-fill" style="width:{{ $pct }}%"></div></div>
                            <strong>{{ $pct }}%</strong>
                        </td>
                        <td>{{ $r->correctas }} / {{ $r->total }}</td>
                        <td><strong style="color:#15803D">+{{ $r->xp_ganado }} XP</strong></td>
                        <td>
                            @if($pct >= 70)
                                <span class="badge-aprobado">✓ Aprobado</span>
                            @else
                                <span class="badge-reprobado">✗ Reprobado</span>
                            @endif
                        </td>
                        <td style="color:#6B7280;font-size:.8rem">{{ \Carbon\Carbon::parse($r->fecha)->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrap">{{ $resultados->appends(request()->query())->links() }}</div>
            @else
            <div class="empty-state">
                <div style="font-size:2rem;margin-bottom:8px">📊</div>
                No hay resultados con ese filtro
            </div>
            @endif
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