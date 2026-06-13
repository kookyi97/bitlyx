<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bitlyx — Editar Pregunta</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Inter',sans-serif;background:#F3F4F6;color:#111827;min-height:100vh;display:flex}
    .sidebar{width:260px;background:#fff;border-right:1px solid #E5E7EB;padding:2rem 1.5rem;position:sticky;top:0;height:100vh;display:flex;flex-direction:column;flex-shrink:0}
    .logo-bitlyx{font-family:'Nunito',sans-serif;font-weight:800;font-size:1.7rem;background:linear-gradient(135deg,#15803D,#4ADE80);-webkit-background-clip:text;background-clip:text;color:transparent}
    .logo-academy{font-family:'Nunito',sans-serif;font-weight:600;font-size:.95rem;color:#6B7280;margin-left:4px}
    .logo-area{margin-bottom:2rem}
    .nav-menu{flex:1;display:flex;flex-direction:column;gap:.4rem}
    .nav-item{display:flex;align-items:center;gap:10px;padding:.7rem 1rem;border-radius:10px;color:#4B5563;font-weight:500;text-decoration:none;font-size:.9rem;transition:all .2s}
    .nav-item i{width:20px;color:#9CA3AF}
    .nav-item:hover{background:#F3F4F6;color:#15803D}.nav-item:hover i{color:#4ADE80}
    .nav-item.active{background:#E8F5E9;color:#15803D;font-weight:600}.nav-item.active i{color:#4ADE80}
    .sidebar-footer{border-top:1px solid #E5E7EB;padding-top:1rem;margin-top:1rem}
    .main{flex:1;padding:2rem;max-width:760px}
    .page-header{margin-bottom:1.8rem}
    .breadcrumb{display:flex;align-items:center;gap:6px;font-size:.82rem;color:#9CA3AF;margin-bottom:.5rem}
    .breadcrumb a{color:#6B7280;text-decoration:none}.breadcrumb a:hover{color:#15803D}
    .page-title{font-family:'Nunito',sans-serif;font-size:1.5rem;font-weight:800;color:#111827}
    .form-card{background:#fff;border:1px solid #E5E7EB;border-radius:18px;overflow:hidden}
    .form-section{padding:1.6rem 2rem;border-bottom:1px solid #F3F4F6}
    .form-section:last-child{border-bottom:none}
    .section-label{font-size:.75rem;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:.5px;margin-bottom:1.1rem;display:flex;align-items:center;gap:6px}
    .section-label i{color:#4ADE80}
    .field{margin-bottom:1.1rem}.field:last-child{margin-bottom:0}
    .field label{display:block;font-size:.82rem;font-weight:600;color:#374151;margin-bottom:.4rem}
    .field input,.field textarea,.field select{width:100%;padding:.65rem 1rem;border:1.5px solid #E5E7EB;border-radius:10px;font-size:.9rem;color:#111827;font-family:'Inter',sans-serif;transition:border-color .2s,box-shadow .2s}
    .field input:focus,.field textarea:focus,.field select:focus{outline:none;border-color:#15803D;box-shadow:0 0 0 3px rgba(21,128,61,.08)}
    .field textarea{resize:vertical;min-height:80px}
    .xp-hint{font-size:.75rem;color:#9CA3AF;margin-top:.3rem}
    .opciones-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
    .opcion-item{position:relative}
    .opcion-item label{display:flex;align-items:center;gap:8px;font-size:.82rem;font-weight:600;color:#374151;margin-bottom:.4rem}
    .opcion-letra{width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;background:#E5E7EB;color:#6B7280;flex-shrink:0}
    .opcion-item input[type=text]{padding:.65rem 1rem;border:1.5px solid #E5E7EB;border-radius:10px;font-size:.875rem;width:100%;transition:border-color .2s}
    .opcion-item input[type=text]:focus{outline:none;border-color:#15803D;box-shadow:0 0 0 3px rgba(21,128,61,.08)}
    .opcion-item.correcta-activa input[type=text]{border-color:#15803D;background:#F0FDF4}
    .opcion-item.correcta-activa .opcion-letra{background:#15803D;color:#fff}
    .correcta-row{display:grid;grid-template-columns:repeat(4,1fr);gap:.7rem;margin-top:.5rem}
    .radio-opcion{cursor:pointer}
    .radio-opcion input{display:none}
    .radio-card{border:2px solid #E5E7EB;border-radius:10px;padding:.7rem;text-align:center;transition:all .2s;font-size:.82rem;font-weight:600;color:#6B7280}
    .radio-opcion input:checked + .radio-card{border-color:#15803D;background:#F0FDF4;color:#15803D}
    .radio-card:hover{border-color:#86EFAC}
    .form-footer{display:flex;justify-content:flex-end;gap:.8rem;padding:1.4rem 2rem;background:#F9FAFB;border-top:1px solid #E5E7EB}
    .btn-cancel{padding:.65rem 1.3rem;border:1.5px solid #E5E7EB;border-radius:10px;font-size:.875rem;font-weight:600;color:#374151;text-decoration:none;background:#fff;transition:all .2s}
    .btn-cancel:hover{background:#F3F4F6}
    .btn-save{padding:.65rem 1.6rem;background:#15803D;color:#fff;border:none;border-radius:10px;font-size:.875rem;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:6px;transition:background .2s}
    .btn-save:hover{background:#166534}
    .error-box{background:#FEE2E2;color:#991B1B;border:1px solid #FECACA;border-radius:10px;padding:.75rem 1.2rem;margin-bottom:1rem;font-size:.85rem}
    .leccion-info{background:#F0FDF4;border:1px solid #86EFAC;border-radius:10px;padding:.75rem 1.2rem;font-size:.85rem;color:#14532D;display:flex;align-items:center;gap:8px}
  
    /* ── DARK MODE ── */
    #html-root.dark body { background: #0D0D0D !important; color: #F9FAFB !important; }
    #html-root.dark .sidebar { background: #111111 !important; border-color: #222 !important; }
    #html-root.dark .main { background: #0D0D0D !important; }
    #html-root.dark .card,.filter-card,.table-card { background: #1A1A1A !important; border-color: #2D2D2D !important; }
    #html-root.dark h1,#html-root.dark h2,#html-root.dark h3,#html-root.dark .page-title { color: #F9FAFB !important; }
    #html-root.dark p,#html-root.dark .page-sub { color: #9CA3AF !important; }
    #html-root.dark table thead th { background: #111111 !important; color: #9CA3AF !important; border-color: #2D2D2D !important; }
    #html-root.dark table tbody td { color: #F9FAFB !important; border-color: #2D2D2D !important; }
    #html-root.dark table tbody tr:hover { background: #1A1A1A !important; }
    #html-root.dark .nav-item { color: #9CA3AF !important; }
    #html-root.dark .nav-item.active { background: #14532D !important; color: #4ADE80 !important; }
    #html-root.dark .nav-item:hover { background: #1A1A1A !important; color: #4ADE80 !important; }
    #html-root.dark select,#html-root.dark input,#html-root.dark textarea { background: #1A1A1A !important; border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark .filter-card { background: #1A1A1A !important; border-color: #2D2D2D !important; }
    #html-root.dark .table-card { background: #1A1A1A !important; border-color: #2D2D2D !important; }
    #html-root.dark .table-header { border-color: #2D2D2D !important; }
    #html-root.dark .stat-card { background: #1A1A1A !important; border-color: #2D2D2D !important; }
    #html-root.dark .stat-val,#html-root.dark .stat-num { color: #F9FAFB !important; }
    #html-root.dark .enunciado-txt { color: #F9FAFB !important; }
    #html-root.dark .opcion-item label { color: #9CA3AF !important; }
    #html-root.dark .opcion-item input[type=text] { background: #1A1A1A !important; border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark .card-header { background: #111111 !important; border-color: #2D2D2D !important; }
    #html-root.dark .card-title { color: #F9FAFB !important; }
    #html-root.dark .radio-card { border-color: #2D2D2D !important; color: #9CA3AF !important; background: #1A1A1A !important; }
    #html-root.dark .summary-value { background: #111111 !important; border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark .bc-chip { background: #14532D !important; color: #4ADE80 !important; }
    #html-root.dark .logo-academy { color: #9CA3AF !important; }

    </style>
</head>
<body>
<aside class="sidebar">
  <div class="logo-area"><span class="logo-bitlyx">Bitlyx</span><span class="logo-academy">Academy</span></div>
  <nav class="nav-menu">
    <a href="{{ route('admin.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
    <a href="/modulos" class="nav-item"><i class="fas fa-folder-tree"></i>Módulos</a>
    <a href="{{ route('admin.preguntas.index') }}" class="nav-item active">
            <button id="dark-btn" title="Modo oscuro" style="background:transparent;border:1px solid #E5E7EB;border-radius:50%;width:34px;height:34px;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-left:auto">🌙</button><i class="fas fa-circle-question"></i>Preguntas Quiz</a>
    <a href="{{ route('admin.usuarios.index') }}" class="nav-item"><i class="fas fa-user-shield"></i>Usuarios</a>
    <a href="{{ route('admin.resultados_quiz.index') }}" class="nav-item"><i class="fas fa-chart-simple"></i>Resultados</a>
  </nav>
  <div class="sidebar-footer">
    <form action="{{ route('logout') }}" method="POST">@csrf
      <button type="submit" class="nav-item" style="width:100%;border:none;background:none;cursor:pointer;text-align:left;color:#4B5563;font-weight:500;font-family:inherit">
        <i class="fas fa-sign-out-alt" style="width:20px;color:#9CA3AF"></i>Cerrar Sesión
      </button>
    </form>
  </div>
</aside>

<main class="main">
  <div class="page-header">
    <div class="breadcrumb">
      <a href="{{ route('admin.preguntas.index', ['leccion_id' => $pregunta->leccion_id]) }}">Preguntas</a>
      <span>›</span><span>Editar Pregunta #{{ $pregunta->id }}</span>
    </div>
    <h1 class="page-title">Editar Pregunta</h1>
  </div>

  @if($errors->any())
    <div class="error-box"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
  @endif

  @php
    $leccionActual = \DB::table('lecciones')->where('id', $pregunta->leccion_id)->first();
    $moduloActual  = $leccionActual ? \DB::table('modulos')->where('id', $leccionActual->modulo_id)->first() : null;
    $correctaIdx   = $pregunta->opciones->search(fn($o) => $o->es_correcta);
  @endphp

  <div class="leccion-info" style="margin-bottom:1.4rem">
    <i class="fas fa-layer-group"></i>
    <strong>{{ $moduloActual->titulo ?? '—' }}</strong>
    <span style="color:#86EFAC">›</span>
    <span>{{ $leccionActual->titulo ?? '—' }}</span>
  </div>

  <form method="POST" action="{{ route('admin.preguntas.update', $pregunta->id) }}">
    @csrf @method('PUT')
    <input type="hidden" name="leccion_id" value="{{ $pregunta->leccion_id }}">

    <div class="form-card">
      {{-- Pregunta --}}
      <div class="form-section">
        <div class="section-label"><i class="fas fa-question"></i> Pregunta</div>
        <div class="field">
          <label>Enunciado</label>
          <textarea name="enunciado" rows="3" required>{{ old('enunciado', $pregunta->enunciado) }}</textarea>
        </div>
        <div class="field" style="max-width:180px">
          <label>Puntos XP</label>
          <input type="number" name="xp" value="{{ old('xp', $pregunta->xp) }}" min="1" max="100" required>
          <p class="xp-hint">Entre 1 y 100 puntos</p>
        </div>
      </div>

      {{-- Opciones --}}
      <div class="form-section">
        <div class="section-label"><i class="fas fa-list-check"></i> Opciones de respuesta</div>
        <div class="opciones-grid">
          @foreach(['A','B','C','D'] as $idx => $letra)
          @php $opcion = $pregunta->opciones[$idx] ?? null; @endphp
          <div class="opcion-item {{ $opcion && $opcion->es_correcta ? 'correcta-activa' : '' }}" id="opcion-wrap-{{ $idx }}">
            <label>
              <span class="opcion-letra" id="letra-{{ $idx }}">{{ $letra }}</span>
              Opción {{ $letra }}
            </label>
            <input type="text" name="opciones[]" value="{{ old('opciones.'.$idx, $opcion->texto ?? '') }}" placeholder="Opción {{ $letra }}..." required>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Correcta --}}
      <div class="form-section">
        <div class="section-label"><i class="fas fa-check-circle"></i> Respuesta correcta</div>
        <div class="correcta-row">
          @foreach(['A','B','C','D'] as $idx => $letra)
          <label class="radio-opcion">
            <input type="radio" name="correcta" value="{{ $idx }}"
              {{ (old('correcta', $correctaIdx) == $idx) ? 'checked' : '' }}
              onchange="marcarCorrecta({{ $idx }})">
            <div class="radio-card">Opción {{ $letra }}</div>
          </label>
          @endforeach
        </div>
      </div>

      <div class="form-footer">
        <a href="{{ route('admin.preguntas.index', ['leccion_id' => $pregunta->leccion_id]) }}" class="btn-cancel">Cancelar</a>
        <button type="submit" class="btn-save"><i class="fas fa-save"></i> Actualizar Pregunta</button>
      </div>
    </div>
  </form>
</main>

<script>
function marcarCorrecta(idx) {
  document.querySelectorAll('.opcion-item').forEach((el, i) => {
    el.classList.toggle('correcta-activa', i === idx);
  });
}
// Marcar la correcta actual al cargar
marcarCorrecta({{ $correctaIdx !== false ? $correctaIdx : 'null' }});
</script>

    <script>
    (function() {
        var btn  = document.getElementById('dark-btn');
        var root = document.getElementById('html-root');
        function applyDark(on) {
            if (on) root.classList.add('dark');
            else root.classList.remove('dark');
            if (btn) btn.textContent = on ? '☀️' : '🌙';
            localStorage.setItem('bitlyx-dark', on ? '1' : '0');
        }
        applyDark(localStorage.getItem('bitlyx-dark') === '1');
        if (btn) btn.addEventListener('click', function() {
            applyDark(!root.classList.contains('dark'));
        });
    })();
    </script>

</body>
</html>
