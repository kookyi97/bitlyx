<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Bitlyx Academy — Panel Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter','Nunito',sans-serif;background-color:#F3F4F6;color:#111827;line-height:1.5;transition:background .3s,color .3s}
        .app-wrapper{display:flex;min-height:100vh}
        .sidebar{width:280px;background-color:#FFFFFF;border-right:1px solid #E5E7EB;padding:2rem 1.5rem;position:sticky;top:0;height:100vh;display:flex;flex-direction:column;transition:background .3s,border-color .3s}
        .logo-area{margin-bottom:2.5rem}
        .logo-bitlyx{font-family:'Nunito',sans-serif;font-weight:800;font-size:1.8rem;background:linear-gradient(135deg,#15803D 0%,#4ADE80 100%);background-clip:text;-webkit-background-clip:text;color:transparent}
        .logo-academy{font-family:'Nunito',sans-serif;font-weight:600;font-size:1rem;color:#6B7280;margin-left:4px}
        .nav-menu{flex:1;display:flex;flex-direction:column;gap:.5rem}
        .nav-item{display:flex;align-items:center;gap:12px;padding:.75rem 1rem;border-radius:12px;color:#4B5563;font-weight:500;transition:all .2s;text-decoration:none;font-size:.95rem}
        .nav-item i{width:22px;font-size:1.2rem;color:#9CA3AF}
        .nav-item:hover{background-color:#F3F4F6;color:#15803D}
        .nav-item:hover i{color:#4ADE80}
        .nav-item.active{background-color:#E8F5E9;color:#15803D;font-weight:600}
        .nav-item.active i{color:#4ADE80}
        .logout-sidebar{margin-top:2rem;border-top:1px solid #E5E7EB;padding-top:1.5rem}
        .main-content{flex:1;padding:2rem;max-width:calc(100% - 280px)}
        .top-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem}
        .greeting h1{font-family:'Nunito',sans-serif;font-size:1.85rem;font-weight:700;color:#111827;margin-bottom:.25rem}
        .greeting p{color:#6B7280;font-size:.9rem}
        .user-badge{display:flex;align-items:center;gap:12px;background:white;padding:.5rem 1rem .5rem 1.2rem;border-radius:60px;box-shadow:0 1px 2px rgba(0,0,0,.03),0 0 0 1px #E5E7EB;transition:background .3s,box-shadow .3s}
        .user-avatar{background:#4ADE80;width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#064E3B;font-weight:bold}
        .dark-btn{background:transparent;border:1px solid #E5E7EB;border-radius:50%;width:36px;height:36px;font-size:17px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0}
        .dark-btn:hover{transform:scale(1.1)}
        .stats-grid{display:flex;flex-wrap:wrap;gap:1.5rem;margin-bottom:2.5rem}
        .stat-card{background:#FFFFFF;border-radius:24px;padding:1.5rem;flex:1;min-width:180px;box-shadow:0 4px 12px rgba(0,0,0,.02),0 1px 2px rgba(0,0,0,.05);border:1px solid #E5E7EB;transition:all .2s}
        .stat-card:hover{transform:translateY(-2px);box-shadow:0 12px 24px -12px rgba(0,0,0,.1)}
        .stat-icon{background:#E8F5E9;width:48px;height:48px;display:flex;align-items:center;justify-content:center;border-radius:32px;margin-bottom:1rem}
        .stat-icon i{font-size:1.8rem;color:#15803D}
        .stat-card h2{font-family:'Nunito',sans-serif;font-size:2.4rem;font-weight:800;color:#111827;margin:.5rem 0 .2rem}
        .stat-card p{color:#6B7280;font-weight:500;font-size:.85rem}
        .management-section{background:#FFFFFF;border-radius:28px;border:1px solid #E5E7EB;padding:1.8rem 2rem;transition:background .3s,border-color .3s}
        .section-title{font-family:'Nunito',sans-serif;font-weight:700;font-size:1.35rem;margin-bottom:1.2rem;display:flex;align-items:center;gap:10px}
        .section-title i{color:#4ADE80}
        .menu-buttons{display:flex;flex-wrap:wrap;gap:1rem;margin-top:.5rem}
        .btn-bitlyx{display:inline-flex;align-items:center;gap:10px;background-color:#F9FAFB;border:1px solid #E5E7EB;padding:.8rem 1.6rem;border-radius:40px;font-weight:600;font-size:.9rem;color:#1F2937;text-decoration:none;transition:all .2s;font-family:'Inter',sans-serif}
        .btn-bitlyx i{color:#4ADE80}
        .btn-bitlyx:hover{background-color:#4ADE80;border-color:#4ADE80;color:#064E3B}
        .btn-bitlyx:hover i{color:#064E3B}

        /* ── DARK MODE ── */
        #html-root.dark body{background:#0D0D0D !important;color:#F9FAFB !important}
        #html-root.dark .sidebar{background:#111111 !important;border-color:#2D2D2D !important}
        #html-root.dark .logo-academy{color:#9CA3AF !important}
        #html-root.dark .nav-item{color:#9CA3AF !important}
        #html-root.dark .nav-item:hover,#html-root.dark .nav-item.active{background:#1A1A1A !important;color:#4ADE80 !important}
        #html-root.dark .nav-item:hover i,#html-root.dark .nav-item.active i{color:#4ADE80 !important}
        #html-root.dark .logout-sidebar{border-color:#2D2D2D !important}
        #html-root.dark .main-content{background:#0D0D0D !important}
        #html-root.dark .greeting h1{color:#F9FAFB !important}
        #html-root.dark .greeting p{color:#9CA3AF !important}
        #html-root.dark .user-badge{background:#1A1A1A !important;box-shadow:0 0 0 1px #2D2D2D !important;color:#F9FAFB !important}
        #html-root.dark .stat-card{background:#1A1A1A !important;border-color:#2D2D2D !important}
        #html-root.dark .stat-card h2{color:#F9FAFB !important}
        #html-root.dark .stat-card p{color:#9CA3AF !important}
        #html-root.dark .stat-icon{background:#14532D !important}
        #html-root.dark .management-section{background:#1A1A1A !important;border-color:#2D2D2D !important}
        #html-root.dark .section-title{color:#F9FAFB !important}
        #html-root.dark .btn-bitlyx{background:#111111 !important;border-color:#2D2D2D !important;color:#F9FAFB !important}
        #html-root.dark .btn-bitlyx:hover{background:#15803D !important;border-color:#4ADE80 !important;color:#fff !important}
        #html-root.dark .dark-btn{border-color:#2D2D2D !important}

        @media(max-width:768px){.app-wrapper{flex-direction:column}.sidebar{width:100%;height:auto;position:relative;padding:1rem;border-right:none;border-bottom:1px solid #E5E7EB}.main-content{max-width:100%;padding:1.5rem}.stats-grid{flex-direction:column}}
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
                <a href="{{ route('admin.dashboard') }}" class="nav-item active">
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
            <div class="top-header">
                <div class="greeting">
                    <h1>Panel de Administrador</h1>
                    <p>Bienvenido, {{ Auth::user()->nombre ?? Auth::user()->name }}</p>
                </div>
                <div class="user-badge">
                    <button class="dark-btn" id="dark-btn" title="Cambiar tema">🌙</button>
                    <div class="user-avatar"><i class="fas fa-user-graduate"></i></div>
                    <div>{{ Auth::user()->nombre ?? Auth::user()->email }}</div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-cubes"></i></div>
                    <h2>{{ $totalModulos ?? 0 }}</h2>
                    <p>Módulos</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-video"></i></div>
                    <h2>{{ $totalLecciones ?? 0 }}</h2>
                    <p>Lecciones</p>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <h2>{{ $totalUsuarios ?? 0 }}</h2>
                    <p>Usuarios</p>
                </div>
            </div>

            <div class="management-section">
                <div class="section-title">
                    <i class="fas fa-sliders-h"></i>
                    <span>Gestión</span>
                </div>
                <div class="menu-buttons">
                    <a href="/modulos" class="btn-bitlyx">
                        <i class="fas fa-folder-tree"></i> Gestionar Módulos
                    </a>
                    <a href="{{ route('admin.usuarios.index') }}" class="btn-bitlyx">
                        <i class="fas fa-user-shield"></i> Gestionar Usuarios
                    </a>
                    <a href="{{ route('admin.resultados_quiz.index') }}" class="btn-bitlyx">
                        <i class="fas fa-chart-simple"></i> Ver Resultados de Quizzes
                    </a>
                    <a href="{{ route('admin.preguntas.index') }}" class="btn-bitlyx">
                        <i class="fas fa-circle-question"></i> Gestionar Preguntas
                    </a>
                </div>
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
        if (btn) btn.addEventListener('click', function() {
            applyDark(!root.classList.contains('dark'));
        });
    })();
    </script>
</body>
</html>