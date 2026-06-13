<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bitlyx — Nueva Pregunta</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Inter',sans-serif;background:#F3F4F6;color:#111827;min-height:100vh;display:flex}

    /* Sidebar */
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

    /* Main */
    .main{flex:1;padding:2rem 2.5rem;min-width:0}
    .page-header{margin-bottom:2rem}
    .breadcrumb{display:flex;align-items:center;gap:6px;font-size:.8rem;color:#9CA3AF;margin-bottom:.6rem}
    .breadcrumb a{color:#6B7280;text-decoration:none}.breadcrumb a:hover{color:#15803D}
    .page-title{font-family:'Nunito',sans-serif;font-size:1.7rem;font-weight:800;color:#111827}

    /* Layout de 2 columnas */
    .form-layout{display:grid;grid-template-columns:1fr 380px;gap:1.5rem;align-items:start}

    /* Cards */
    .card{background:#fff;border:1px solid #E5E7EB;border-radius:16px;overflow:hidden}
    .card-header{padding:1.1rem 1.6rem;border-bottom:1px solid #F3F4F6;display:flex;align-items:center;gap:8px}
    .card-header-icon{width:32px;height:32px;border-radius:8px;background:#E8F5E9;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .card-header-icon i{color:#15803D;font-size:.9rem}
    .card-title{font-weight:700;font-size:.95rem;color:#111827}
    .card-body{padding:1.4rem 1.6rem;display:flex;flex-direction:column;gap:1.1rem}

    /* Campos */
    .field{display:flex;flex-direction:column;gap:.4rem}
    .field label{font-size:.8rem;font-weight:600;color:#374151}
    .field input,.field textarea,.field select{
      padding:.65rem 1rem;border:1.5px solid #E5E7EB;border-radius:10px;
      font-size:.9rem;color:#111827;font-family:'Inter',sans-serif;
      transition:border-color .2s,box-shadow .2s;background:#fff;width:100%
    }
    .field input:focus,.field textarea:focus,.field select:focus{
      outline:none;border-color:#15803D;box-shadow:0 0 0 3px rgba(21,128,61,.08)
    }
    .field textarea{resize:vertical;min-height:100px;line-height:1.5}
    .hint{font-size:.75rem;color:#9CA3AF}

    /* Select custom arrow */
    .field select{
      appearance:none;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat:no-repeat;background-position:right 12px center;padding-right:36px
    }
    .field select:disabled{background:#F9FAFB;color:#9CA3AF;cursor:not-allowed}

    /* Opciones 2x2 */
    .opciones-grid{display:grid;grid-template-columns:1fr 1fr;gap:.9rem}
    .opcion-wrap{display:flex;flex-direction:column;gap:.35rem}
    .opcion-label{display:flex;align-items:center;gap:7px;font-size:.8rem;font-weight:600;color:#374151}
    .opcion-letra{width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:800;background:#E5E7EB;color:#6B7280;flex-shrink:0;transition:background .2s,color .2s}
    .opcion-wrap input[type=text]{
      padding:.6rem .9rem;border:1.5px solid #E5E7EB;border-radius:10px;
      font-size:.875rem;width:100%;transition:border-color .2s,background .2s;font-family:'Inter',sans-serif
    }
    .opcion-wrap input[type=text]:focus{outline:none;border-color:#15803D;box-shadow:0 0 0 3px rgba(21,128,61,.08)}
    .opcion-wrap.activa input[type=text]{border-color:#15803D;background:#F0FDF4}
    .opcion-wrap.activa .opcion-letra{background:#15803D;color:#fff}

    /* Selector correcta */
    .correcta-grid{display:grid;grid-template-columns:1fr 1fr;gap:.7rem}
    .radio-opt{cursor:pointer;display:block}
    .radio-opt input{display:none}
    .radio-card{
      border:2px solid #E5E7EB;border-radius:11px;padding:.8rem .6rem;
      text-align:center;transition:all .2s;font-size:.82rem;font-weight:600;color:#6B7280;
      display:flex;align-items:center;justify-content:center;gap:6px
    }
    .radio-card .rc-letra{width:22px;height:22px;border-radius:50%;background:#E5E7EB;color:#6B7280;font-size:.7rem;font-weight:800;display:flex;align-items:center;justify-content:center;transition:background .2s,color .2s}
    .radio-opt input:checked + .radio-card{border-color:#15803D;background:#F0FDF4;color:#15803D}
    .radio-opt input:checked + .radio-card .rc-letra{background:#15803D;color:#fff}
    .radio-card:hover{border-color:#86EFAC;background:#F7FFF9}

    /* XP visual */
    .xp-row{display:flex;align-items:center;gap:.8rem}
    .xp-row input{width:100px}
    .xp-preview{background:#EFF6FF;color:#1E3A8A;font-size:.82rem;font-weight:700;padding:.4rem .9rem;border-radius:20px;white-space:nowrap}

    /* Columna derecha: resumen + botones */
    .summary-card .card-body{gap:.8rem}
    .summary-row{display:flex;flex-direction:column;gap:.25rem}
    .summary-label{font-size:.72rem;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:.4px}
    .summary-value{font-size:.9rem;font-weight:600;color:#111827;background:#F9FAFB;border:1px solid #E5E7EB;border-radius:8px;padding:.5rem .9rem;min-height:36px}
    .summary-value.empty{color:#D1D5DB;font-weight:400;font-style:italic}
    .divider{border:none;border-top:1px solid #F3F4F6;margin:.2rem 0}

    /* Botones acción */
    .actions-card .card-body{gap:.7rem}
    .btn-save{width:100%;padding:.75rem;background:#15803D;color:#fff;border:none;border-radius:11px;font-size:.925rem;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;transition:background .2s,transform .1s}
    .btn-save:hover{background:#166534;transform:translateY(-1px)}
    .btn-cancel{width:100%;padding:.7rem;background:#fff;color:#374151;border:1.5px solid #E5E7EB;border-radius:11px;font-size:.9rem;font-weight:600;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:7px;transition:all .2s}
    .btn-cancel:hover{background:#F3F4F6}

    /* Checklist de validación */
    .checklist{display:flex;flex-direction:column;gap:.5rem}
    .check-item{display:flex;align-items:center;gap:8px;font-size:.8rem;color:#9CA3AF}
    .check-item.ok{color:#15803D}
    .check-item i{width:16px;font-size:.8rem}

    .error-box{background:#FEE2E2;color:#991B1B;border:1px solid #FECACA;border-radius:10px;padding:.75rem 1.2rem;margin-bottom:1.2rem;font-size:.85rem;display:flex;align-items:center;gap:8px}

    @media(max-width:1100px){.form-layout{grid-template-columns:1fr}}
  
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
        <i class="fas fa-sign-out-alt" style="width:18px;color:#9CA3AF"></i>Cerrar Sesión
      </button>
    </form>
  </div>
</aside>

<main class="main">
  <div class="page-header">
    <div class="breadcrumb">
      <a href="{{ route('admin.preguntas.index') }}"><i class="fas fa-circle-question"></i> Preguntas</a>
      <span>›</span><span>Nueva Pregunta</span>
    </div>
    <h1 class="page-title">Nueva Pregunta</h1>
  </div>

  @if($errors->any())
    <div class="error-box"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('admin.preguntas.store') }}" id="main-form" onsubmit="return validarFormulario()">
    @csrf
    <div class="form-layout">

      {{-- COLUMNA IZQUIERDA --}}
      <div style="display:flex;flex-direction:column;gap:1.2rem">

        {{-- Ubicación --}}
        <div class="card">
          <div class="card-header">
            <div class="card-header-icon"><i class="fas fa-layer-group"></i></div>
            <span class="card-title">Ubicación</span>
          </div>
          <div class="card-body">
            <div class="field">
              <label>Módulo / Curso</label>
              <select name="modulo_id" id="mod_sel" required onchange="actualizarResumen(); actualizarChecklist()">
                <option value="">— Selecciona un módulo —</option>
                @php $modulos = \App\Models\Modulo::orderBy('id')->get(); @endphp
                @foreach($modulos as $m)
                  <option value="{{ $m->id }}" {{ old('modulo_id')==$m->id ? 'selected' : '' }}>{{ $m->titulo }}</option>
                @endforeach
              </select>
              <span class="hint">Las preguntas pertenecen al quiz final de este módulo</span>
            </div>
          </div>
        </div>

        {{-- Pregunta --}}
        <div class="card">
          <div class="card-header">
            <div class="card-header-icon"><i class="fas fa-question"></i></div>
            <span class="card-title">Pregunta</span>
          </div>
          <div class="card-body">
            <div class="field">
              <label>Enunciado</label>
              <textarea name="enunciado" id="enunciado" rows="4" placeholder="Escribe aquí la pregunta..." required oninput="actualizarResumen()">{{ old('enunciado') }}</textarea>
            </div>
            <div class="field">
              <label>Puntos XP</label>
              <div class="xp-row">
                <input type="number" name="xp" id="xp_input" value="{{ old('xp',10) }}" min="1" max="100" required oninput="actualizarResumen()">
                <span class="xp-preview" id="xp-preview">+10 XP por respuesta correcta</span>
              </div>
              <span class="hint">Entre 1 y 100 puntos</span>
            </div>
          </div>
        </div>

        {{-- Opciones --}}
        <div class="card">
          <div class="card-header">
            <div class="card-header-icon"><i class="fas fa-list-check"></i></div>
            <span class="card-title">Opciones de respuesta</span>
          </div>
          <div class="card-body">
            <div class="opciones-grid">
              @foreach(['A','B','C','D'] as $idx => $letra)
              <div class="opcion-wrap" id="ow-{{ $idx }}">
                <div class="opcion-label">
                  <span class="opcion-letra" id="ol-{{ $idx }}">{{ $letra }}</span>
                  Opción {{ $letra }}
                </div>
                <input type="text" name="opciones[]" id="op-{{ $idx }}"
                  placeholder="Escribe la opción {{ $letra }}..."
                  required value="{{ old('opciones.'.$idx) }}"
                  oninput="actualizarResumen()">
              </div>
              @endforeach
            </div>
          </div>
        </div>

        {{-- Respuesta correcta --}}
        <div class="card">
          <div class="card-header">
            <div class="card-header-icon"><i class="fas fa-check-circle"></i></div>
            <span class="card-title">¿Cuál es la respuesta correcta?</span>
          </div>
          <div class="card-body">
            <div class="correcta-grid">
              @foreach(['A','B','C','D'] as $idx => $letra)
              <label class="radio-opt">
                <input type="radio" name="correcta" value="{{ $idx }}"
                  {{ old('correcta')==$idx?'checked':'' }}
                  onchange="marcarCorrecta({{ $idx }});actualizarResumen()">
                <div class="radio-card">
                  <span class="rc-letra">{{ $letra }}</span>
                  Opción {{ $letra }}
                </div>
              </label>
              @endforeach
            </div>
          </div>
        </div>

      </div>{{-- fin columna izquierda --}}

      {{-- COLUMNA DERECHA --}}
      <div style="display:flex;flex-direction:column;gap:1.2rem;position:sticky;top:2rem">

        {{-- Resumen en vivo --}}
        <div class="card summary-card">
          <div class="card-header">
            <div class="card-header-icon"><i class="fas fa-eye"></i></div>
            <span class="card-title">Vista previa</span>
          </div>
          <div class="card-body">
            <div class="summary-row">
              <span class="summary-label">Pregunta</span>
              <div class="summary-value empty" id="prev-enunciado">Sin enunciado aún...</div>
            </div>
            <hr class="divider">
            <div class="summary-row">
              <span class="summary-label">Opciones</span>
              <div style="display:flex;flex-direction:column;gap:.3rem" id="prev-opciones">
                @foreach(['A','B','C','D'] as $l)
                <div style="font-size:.8rem;color:#9CA3AF;padding:.3rem .7rem;border-radius:7px;border:1px dashed #E5E7EB" id="prev-op-{{ $loop->index }}">{{ $l }}: —</div>
                @endforeach
              </div>
            </div>
            <hr class="divider">
            <div style="display:flex;justify-content:space-between;align-items:center">
              <span class="summary-label">Correcta</span>
              <span style="font-size:.85rem;font-weight:700;color:#15803D" id="prev-correcta">—</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center">
              <span class="summary-label">XP</span>
              <span style="background:#EFF6FF;color:#1E3A8A;font-size:.8rem;font-weight:700;padding:2px 10px;border-radius:20px" id="prev-xp">+10 XP</span>
            </div>
          </div>
        </div>

        {{-- Checklist --}}
        <div class="card">
          <div class="card-header">
            <div class="card-header-icon"><i class="fas fa-clipboard-check"></i></div>
            <span class="card-title">Checklist</span>
          </div>
          <div class="card-body" style="padding-top:1rem;padding-bottom:1rem">
            <div class="checklist">
              <div class="check-item" id="chk-modulo"><i class="fas fa-circle"></i> Módulo seleccionado</div>
              <div class="check-item" id="chk-enunciado"><i class="fas fa-circle"></i> Enunciado escrito</div>
              <div class="check-item" id="chk-opciones"><i class="fas fa-circle"></i> Las 4 opciones completas</div>
              <div class="check-item" id="chk-correcta"><i class="fas fa-circle"></i> Respuesta correcta marcada</div>
            </div>
          </div>
        </div>

        {{-- Botones --}}
        <div class="card actions-card">
          <div class="card-body" style="padding:1.2rem 1.4rem">
            <button type="submit" class="btn-save" id="btn-submit">
              <i class="fas fa-save"></i> Guardar Pregunta
            </button>
            <a href="{{ route('admin.preguntas.index', ['leccion_id'=>request('leccion_id')]) }}" class="btn-cancel">
              <i class="fas fa-arrow-left"></i> Cancelar
            </a>
          </div>
        </div>

      </div>{{-- fin columna derecha --}}
    </div>
  </form>
</main>

<script>

function marcarCorrecta(idx) {
  correctaSeleccionada = idx;
  const letras = ['A','B','C','D'];
  document.querySelectorAll('.opcion-wrap').forEach((el,i)=>el.classList.toggle('activa',i===idx));
  // actualizar preview correcta
  const opTxt = document.getElementById('op-'+idx)?.value||'—';
  document.getElementById('prev-correcta').textContent = letras[idx]+': '+opTxt;
  // highlight opciones preview
  document.querySelectorAll('[id^=prev-op-]').forEach((el,i)=>{
    el.style.borderColor = i===idx?'#15803D':'#E5E7EB';
    el.style.background  = i===idx?'#F0FDF4':'';
    el.style.color       = i===idx?'#15803D':'#9CA3AF';
    el.style.fontWeight  = i===idx?'700':'400';
    el.style.borderStyle = i===idx?'solid':'dashed';
  });
  actualizarChecklist();
}

function actualizarResumen() {
  const letras=['A','B','C','D'];
  // enunciado
  const en = document.getElementById('enunciado').value.trim();
  const prevEn = document.getElementById('prev-enunciado');
  if(en){ prevEn.textContent=en.length>80?en.slice(0,80)+'…':en; prevEn.classList.remove('empty'); }
  else  { prevEn.textContent='Sin enunciado aún...'; prevEn.classList.add('empty'); }
  // xp
  const xp = document.getElementById('xp_input').value||10;
  document.getElementById('prev-xp').textContent='+'+xp+' XP';
  document.getElementById('xp-preview').textContent='+'+xp+' XP por respuesta correcta';
  // opciones
  letras.forEach((l,i)=>{
    const v=document.getElementById('op-'+i)?.value||'';
    const el=document.getElementById('prev-op-'+i);
    el.textContent=l+': '+(v||'—');
  });
  // actualizar correcta si ya hay selección
  if(correctaSeleccionada!==null){
    const opTxt=document.getElementById('op-'+correctaSeleccionada)?.value||'—';
    document.getElementById('prev-correcta').textContent=letras[correctaSeleccionada]+': '+opTxt;
  }
  actualizarChecklist();
}

function actualizarChecklist() {
  const leccion = '';
  const enunciado = document.getElementById('enunciado').value.trim();
  const ops = ['op-0','op-1','op-2','op-3'].map(id=>document.getElementById(id)?.value.trim()||'');
  const todasOps = ops.every(v=>v.length>0);
  const tieneCorrecta = correctaSeleccionada!==null;

  setCheck('chk-modulo', !!leccion);
  setCheck('chk-enunciado', enunciado.length>3);
  setCheck('chk-opciones', todasOps);
  setCheck('chk-correcta', tieneCorrecta);
}

function setCheck(id, ok) {
  const el=document.getElementById(id);
  if(!el)return;
  el.classList.toggle('ok',ok);
  el.querySelector('i').className=ok?'fas fa-check-circle':'fas fa-circle';
}

@if(old('correcta')!==null) marcarCorrecta({{old('correcta')}}); @endif

// Ejecutar al cargar para reflejar estado inicial
document.addEventListener('DOMContentLoaded', function() {
  actualizarResumen();
  actualizarChecklist();
});
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
