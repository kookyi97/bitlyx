<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitlyx — Editar Lección</title>
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
        .dark-btn{background:transparent;border:1px solid #E5E7EB;border-radius:50%;width:36px;height:36px;font-size:17px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0}
        .dark-btn:hover{transform:scale(1.1)}
        .btn-back{display:inline-flex;align-items:center;gap:6px;padding:.5rem 1.1rem;background:#fff;border:1.5px solid #E5E7EB;border-radius:8px;font-size:.85rem;font-weight:600;color:#374151;text-decoration:none;transition:all .2s}
        .btn-back:hover{background:#F3F4F6}
        .form-card{background:#fff;border:1px solid #E5E7EB;border-radius:20px;padding:2rem;max-width:720px;transition:background .3s,border-color .3s}
        .form-group{margin-bottom:1.5rem}
        .form-label{display:block;margin-bottom:.5rem;font-weight:600;color:#374151;font-size:.85rem;text-transform:uppercase;letter-spacing:.4px}
        .form-label i{margin-right:6px;color:#4ADE80}
        .form-input,.form-textarea,.form-select{width:100%;padding:.75rem 1rem;border:1.5px solid #D1D5DB;border-radius:12px;font-family:'Inter',sans-serif;font-size:.9rem;transition:all .2s;background:#fff;outline:none;color:#111827}
        .form-input:focus,.form-textarea:focus,.form-select:focus{border-color:#4ADE80;box-shadow:0 0 0 3px rgba(74,222,128,.15)}
        .form-textarea{resize:vertical;min-height:140px}
        .form-actions{display:flex;gap:.75rem;margin-top:1.5rem;flex-wrap:wrap}
        .btn-primary{background:linear-gradient(105deg,#15803D,#4ADE80);color:#fff;border:none;padding:.75rem 1.75rem;border-radius:40px;font-weight:700;font-size:.875rem;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:8px;font-family:'Inter',sans-serif}
        .btn-primary:hover{transform:translateY(-1px);box-shadow:0 6px 16px -4px rgba(21,128,61,.4)}
        .btn-secondary{background:#fff;color:#6B7280;border:1.5px solid #D1D5DB;padding:.75rem 1.75rem;border-radius:40px;font-weight:600;font-size:.875rem;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .2s;font-family:'Inter',sans-serif}
        .btn-secondary:hover{border-color:#4ADE80;color:#15803D}
        /* DARK MODE */
        #html-root.dark body{background:#0D0D0D !important;color:#F9FAFB !important}
        #html-root.dark .sidebar{background:#111111 !important;border-color:#2D2D2D !important}
        #html-root.dark .logo-academy{color:#9CA3AF !important}
        #html-root.dark .nav-item{color:#9CA3AF !important}
        #html-root.dark .nav-item:hover,#html-root.dark .nav-item.active{background:#1A1A1A !important;color:#4ADE80 !important}
        #html-root.dark .nav-item:hover i,#html-root.dark .nav-item.active i{color:#4ADE80 !important}
        #html-root.dark .logout-sidebar{border-color:#2D2D2D !important}
        #html-root.dark .page-title{color:#F9FAFB !important}
        #html-root.dark .form-card{background:#1A1A1A !important;border-color:#2D2D2D !important}
        #html-root.dark .form-label{color:#9CA3AF !important}
        #html-root.dark .form-input,#html-root.dark .form-textarea,#html-root.dark .form-select{background:#111111 !important;border-color:#2D2D2D !important;color:#F9FAFB !important}
        #html-root.dark .btn-back{background:#1A1A1A !important;border-color:#2D2D2D !important;color:#F9FAFB !important}
        #html-root.dark .btn-secondary{background:#1A1A1A !important;border-color:#2D2D2D !important;color:#9CA3AF !important}
        #html-root.dark .dark-btn{border-color:#2D2D2D !important}
        @media(max-width:768px){.app-wrapper{flex-direction:column}.sidebar{width:100%;height:auto;position:relative;padding:1rem;border-right:none;border-bottom:1px solid #E5E7EB}}</style>
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
                <h1 class="page-title"><i class="fas fa-pen-alt" style="color:#4ADE80;margin-right:10px"></i>Editar Lección</h1>
                <p class="page-sub">{{ $leccion->titulo }} · Módulo: {{ $leccion->modulo->titulo }}</p>
            </div>
            <div style="display:flex;gap:10px;align-items:center">
                <button class="dark-btn" id="dark-btn" title="Modo oscuro">🌙</button>
                <a href="/modulos/{{ $leccion->modulo_id }}/lecciones" class="btn-back">← Volver</a>
            </div>
        </div>
        <div class="form-card">
            <form action="/lecciones/{{ $leccion->id }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-tag"></i> Título</label>
                    <input type="text" name="titulo" class="form-input" required maxlength="150"
                           value="{{ old('titulo', $leccion->titulo) }}" placeholder="Título de la lección">
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-align-left"></i> Contenido</label>
                    <textarea name="contenido" class="form-textarea" rows="6"
                              placeholder="Contenido de la lección...">{{ old('contenido', $leccion->contenido) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-sort-numeric-up"></i> Orden</label>
                    <input type="number" name="orden" class="form-input"
                           value="{{ old('orden', $leccion->orden) }}" min="1" style="max-width:120px">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Actualizar Lección</button>
                    <a href="/modulos/{{ $leccion->modulo_id }}/lecciones" class="btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
                </div>
            </form>
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