<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bitlyx — Preguntas del Quiz</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Inter',sans-serif;background:#F3F4F6;color:#111827;min-height:100vh;display:flex}
    .sidebar{width:240px;background:#fff;border-right:1px solid #E5E7EB;padding:1.8rem 1.4rem;position:sticky;top:0;height:100vh;display:flex;flex-direction:column;flex-shrink:0}
    .logo-bitlyx{font-family:'Nunito',sans-serif;font-weight:800;font-size:1.6rem;background:linear-gradient(135deg,#15803D,#4ADE80);-webkit-background-clip:text;background-clip:text;color:transparent}
    .logo-academy{font-family:'Nunito',sans-serif;font-weight:600;font-size:.9rem;color:#6B7280;margin-left:3px}
    .logo-area{margin-bottom:1.8rem}
    .nav-menu{flex:1;display:flex;flex-direction:column;gap:.35rem}
    .nav-item{display:flex;align-items:center;gap:10px;padding:.65rem 1rem;border-radius:10px;color:#4B5563;font-weight:500;text-decoration:none;font-size:.88rem;transition:all .2s}
    .nav-item i{width:18px;color:#9CA3AF;font-size:.95rem}
    .nav-item:hover{background:#F3F4F6;color:#15803D}.nav-item:hover i{color:#4ADE80}
    .nav-item.active{background:#E8F5E9;color:#15803D;font-weight:600}.nav-item.active i{color:#4ADE80}
    .sidebar-footer{border-top:1px solid #E5E7EB;padding-top:1rem;margin-top:1rem}
    .main{flex:1;padding:2rem 2.5rem;min-width:0}
    .page-title{font-family:'Nunito',sans-serif;font-size:1.7rem;font-weight:800;color:#111827;margin-bottom:.3rem}
    .page-sub{font-size:.85rem;color:#6B7280;margin-bottom:1.5rem}
    .filter-card{background:#fff;border:1px solid #E5E7EB;border-radius:14px;padding:1.2rem 1.6rem;margin-bottom:1.4rem}
    .filter-row{display:flex;gap:1rem;align-items:flex-end;flex-wrap:wrap}
    .filter-group{display:flex;flex-direction:column;gap:.35rem;flex:1;min-width:200px}
    .filter-group label{font-size:.78rem;font-weight:600;color:#374151}
    .select-f{padding:.6rem 1rem;border:1.5px solid #E5E7EB;border-radius:10px;font-size:.875rem;color:#111827;background:#fff;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:32px}
    .select-f:focus{outline:none;border-color:#15803D}
    .btn-f{padding:.6rem 1.4rem;background:#15803D;color:#fff;border:none;border-radius:10px;font-size:.875rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;height:40px}
    .btn-f:hover{background:#166534}
    .bc{display:flex;align-items:center;gap:8px;margin-bottom:1.2rem;font-size:.85rem;color:#6B7280}
    .bc-chip{background:#E8F5E9;color:#15803D;font-weight:600;padding:3px 12px;border-radius:20px;font-size:.8rem}
    .table-card{background:#fff;border:1px solid #E5E7EB;border-radius:14px;overflow:hidden}
    .table-hdr{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.6rem;border-bottom:1px solid #E5E7EB}
    .table-title{font-weight:700;font-size:.95rem;display:flex;align-items:center;gap:8px}
    .cnt{background:#E8F5E9;color:#15803D;font-size:.72rem;font-weight:700;padding:2px 10px;border-radius:20px}
    .btn-nueva{display:flex;align-items:center;gap:6px;background:#15803D;color:#fff;padding:.5rem 1.1rem;border-radius:10px;font-size:.85rem;font-weight:600;text-decoration:none}
    .btn-nueva:hover{background:#166534}
    table{width:100%;border-collapse:collapse}
    thead th{background:#F9FAFB;padding:.8rem 1.4rem;text-align:left;font-size:.72rem;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:.4px;border-bottom:1px solid #E5E7EB}
    tbody tr{border-bottom:1px solid #F3F4F6;transition:background .15s}
    tbody tr:last-child{border-bottom:none}
    tbody tr:hover{background:#F0FDF4}
    td{padding:.85rem 1.4rem;font-size:.875rem;color:#374151;vertical-align:middle}
    .enunciado-txt{font-weight:500;color:#111827;max-width:320px;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .xp-chip{background:#EFF6FF;color:#1E3A8A;font-weight:700;font-size:.75rem;padding:3px 10px;border-radius:20px}
    .op-ok{color:#15803D;font-weight:700;font-size:.78rem;line-height:1.6}
    .op-no{color:#9CA3AF;font-size:.78rem;line-height:1.6}
    .acciones{display:flex;gap:.5rem}
    .btn-sm{display:inline-flex;align-items:center;gap:5px;padding:.42rem .85rem;border-radius:8px;font-size:.8rem;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:all .15s}
    .btn-edit{background:#FEF3C7;color:#92400E}.btn-edit:hover{background:#FDE68A}
    .btn-del{background:#FEE2E2;color:#991B1B}.btn-del:hover{background:#FECACA}
    .empty-state{text-align:center;padding:3rem;color:#9CA3AF}
    .alert-ok{background:#DCFCE7;color:#14532D;border:1px solid #86EFAC;border-radius:10px;padding:.75rem 1.2rem;margin-bottom:1rem;font-size:.875rem;display:flex;align-items:center;gap:8px}
  
    /* ── DARK MODE ── */
    #html-root.dark body{background:#0D0D0D !important;color:#F9FAFB !important}
    #html-root.dark .sidebar{background:#111111 !important;border-color:#2D2D2D !important}
    #html-root.dark .logo-academy{color:#9CA3AF !important}
    #html-root.dark .nav-item{color:#9CA3AF !important}
    #html-root.dark .nav-item:hover,#html-root.dark .nav-item.active{background:#1A1A1A !important;color:#4ADE80 !important}
    #html-root.dark .nav-item:hover i,#html-root.dark .nav-item.active i{color:#4ADE80 !important}
    #html-root.dark .sidebar-footer{border-color:#2D2D2D !important}
    #html-root.dark .main{background:#0D0D0D !important}
    #html-root.dark .page-title{color:#F9FAFB !important}
    #html-root.dark .filter-card{background:#1A1A1A !important;border-color:#2D2D2D !important}
    #html-root.dark .filter-group label{color:#9CA3AF !important}
    #html-root.dark .select-f{background:#111111 !important;border-color:#2D2D2D !important;color:#F9FAFB !important}
    #html-root.dark .table-card{background:#1A1A1A !important;border-color:#2D2D2D !important}
    #html-root.dark .table-head{background:#111111 !important;border-color:#2D2D2D !important}
    #html-root.dark .th-cell{color:#9CA3AF !important;border-color:#2D2D2D !important}
    #html-root.dark .tr-body{border-color:#2D2D2D !important}
    #html-root.dark tbody tr:hover,#html-root.dark .tr-body:hover{background:#1E3A2F !important}
    #html-root.dark .td-cell{color:#F9FAFB !important;border-color:#2D2D2D !important}
    #html-root.dark .enunciado-txt{color:#F9FAFB !important}
    #html-root.dark .count-badge{background:#14532D !important;color:#4ADE80 !important}
    #html-root.dark .empty-msg{color:#9CA3AF !important}

  </style>
</head>
<body>
<aside class="sidebar">
  <div class="logo-area"><span class="logo-bitlyx">Bitlyx</span><span class="logo-academy">Academy</span></div>
  <nav class="nav-menu">
    <a href="{{ route('admin.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
    <a href="/modulos" class="nav-item"><i class="fas fa-folder-tree"></i>Módulos</a>
    <a href="{{ route('admin.preguntas.index') }}" class="nav-item active"><i class="fas fa-circle-question"></i>Preguntas Quiz</a>
    <a href="{{ route('admin.usuarios.index') }}" class="nav-item"><i class="fas fa-user-shield"></i>Usuarios</a>
    <a href="{{ route('admin.resultados_quiz.index') }}" class="nav-item"><i class="fas fa-chart-simple"></i>Resultados</a>
  </nav>
  <div class="sidebar-footer">
    <form action="{{ route('logout') }}" method="POST">@csrf
      <button type="submit" class="nav-item" style="width:100%;border:none;background:none;cursor:pointer;text-align:left;color:#4B5563;font-weight:500;font-family:inherit">
        <i class="fas fa-sign-out-alt" style="width:18px;color:#9CA3AF"></i>Cerrar Sesión
      </button>
    </form>
  </div>
</aside>
<main class="main">
  <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:.3rem">
      <h1 class="page-title">Preguntas del Quiz</h1>
      <button id="dark-btn" title="Modo oscuro" style="background:transparent;border:1px solid #E5E7EB;border-radius:50%;width:36px;height:36px;font-size:17px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:4px">🌙</button>
    </div>
  <p class="page-sub">Selecciona un módulo para gestionar sus preguntas del quiz final</p>

  @if(session('success'))
    <div class="alert-ok"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
  @endif

  <div class="filter-card">
    <form method="GET" action="{{ route('admin.preguntas.index') }}">
      <div class="filter-row">
        <div class="filter-group">
          <label>Módulo / Curso</label>
          <select name="modulo_id" class="select-f">
            <option value="">— Selecciona un módulo —</option>
            @foreach($modulos as $m)
              <option value="{{ $m->id }}" {{ $modulo_id==$m->id?'selected':'' }}>{{ $m->titulo }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn-f"><i class="fas fa-search"></i> Ver Preguntas</button>
      </div>
    </form>
  </div>

  @if($modulo_id)
    @php $mod = $modulos->firstWhere('id', $modulo_id); @endphp
    @if($mod)
    <div class="bc">
      <i class="fas fa-layer-group" style="color:#4ADE80"></i>
      <span class="bc-chip">{{ $mod->titulo }}</span>
      <span style="color:#D1D5DB">›</span>
      <span style="font-size:.8rem">Quiz final del módulo</span>
    </div>
    @endif
  @endif

  <div class="table-card">
    <div class="table-hdr">
      <span class="table-title">
        <i class="fas fa-list-check" style="color:#4ADE80"></i> Preguntas
        @if($preguntas->count()>0)<span class="cnt">{{ $preguntas->count() }}</span>@endif
      </span>
      @if($modulo_id)
        <a href="{{ route('admin.preguntas.create', ['modulo_id'=>$modulo_id]) }}" class="btn-nueva">
          <i class="fas fa-plus"></i> Nueva Pregunta
        </a>
      @endif
    </div>
    @if(!$modulo_id)
      <div class="empty-state"><div style="font-size:2.5rem;margin-bottom:.8rem">🔍</div><p>Selecciona un módulo arriba</p></div>
    @elseif($preguntas->isEmpty())
      <div class="empty-state">
        <div style="font-size:2.5rem;margin-bottom:.8rem">📝</div>
        <p>Sin preguntas. <a href="{{ route('admin.preguntas.create', ['modulo_id'=>$modulo_id]) }}" style="color:#15803D;font-weight:600">Crear la primera →</a></p>
      </div>
    @else
      <table>
        <thead><tr><th>#</th><th>Enunciado</th><th>Opciones</th><th>XP</th><th>Acciones</th></tr></thead>
        <tbody>
          @foreach($preguntas as $i => $p)
          <tr>
            <td style="color:#9CA3AF;font-weight:700">{{ $i+1 }}</td>
            <td><span class="enunciado-txt" title="{{ $p->enunciado }}">{{ $p->enunciado }}</span></td>
            <td>
              @foreach($p->opciones as $op)
                <span class="{{ $op->es_correcta?'op-ok':'op-no' }}">{{ $op->es_correcta?'✓':'·' }} {{ $op->texto }}</span>
              @endforeach
            </td>
            <td><span class="xp-chip">+{{ $p->xp }} XP</span></td>
            <td>
              <div class="acciones">
                <a href="{{ route('admin.preguntas.edit', $p->id) }}" class="btn-sm btn-edit"><i class="fas fa-pen"></i> Editar</a>
                <form action="{{ route('admin.preguntas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-sm btn-del"><i class="fas fa-trash"></i> Eliminar</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</main>

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