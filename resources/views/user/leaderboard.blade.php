<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bitlyx — Ranking</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      min-height: 100vh;
      background: #f8fafc;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    .topbar {
      background: #fff;
      border-bottom: 1px solid #e2e8f0;
      height: 60px;
      padding: 0 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
    }
    .brand { font-size: 18px; font-weight: 700; color: #1e3a8a; }
    .nav-links { display: flex; gap: 16px; align-items: center; }
    .nav-links a { font-size: 13px; color: #64748b; text-decoration: none; font-weight: 500; }
    .nav-links a:hover { color: #0f172a; }
    .nav-links a.active { color: #1e3a8a; font-weight: 600; }
    .main { max-width: 620px; margin: 0 auto; padding: 40px 24px; }
    .page-title { font-size: 22px; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
    .page-sub { font-size: 14px; color: #64748b; margin-bottom: 32px; }
    .podium {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 12px;
      margin-bottom: 32px;
      align-items: flex-end;
    }
    .podium-item {
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      padding: 20px 12px;
      text-align: center;
    }
    .podium-item.first  { border-color: #fbbf24; background: #fffbeb; }
    .podium-item.second { border-color: #94a3b8; background: #f8fafc; }
    .podium-item.third  { border-color: #d97706; background: #fff7ed; }
    .podium-medal { font-size: 28px; margin-bottom: 8px; }
    .podium-nombre { font-size: 13px; font-weight: 600; color: #0f172a; margin-bottom: 4px; }
    .podium-xp { font-size: 18px; font-weight: 700; color: #1e3a8a; }
    .ranking-list { display: flex; flex-direction: column; gap: 8px; }
    .ranking-row {
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 14px 20px;
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .ranking-row.es-yo {
      border-color: #2563eb;
      background: #eff6ff;
    }
    .rank-num {
      font-size: 15px;
      font-weight: 700;
      color: #64748b;
      width: 28px;
      text-align: center;
      flex-shrink: 0;
    }
    .rank-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #e2e8f0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: 700;
      color: #475569;
      flex-shrink: 0;
    }
    .rank-avatar.yo { background: #bfdbfe; color: #1e3a8a; }
    .rank-nombre { flex: 1; font-size: 14px; font-weight: 600; color: #0f172a; }
    .rank-xp {
      font-size: 14px;
      font-weight: 700;
      color: #1e3a8a;
    }
    .yo-badge {
      font-size: 11px;
      font-weight: 600;
      background: #2563eb;
      color: #fff;
      padding: 2px 8px;
      border-radius: 20px;
    }
  
    /* ── DARK MODE GLOBAL ── */
    #html-root.dark body { background: #0D0D0D !important; color: #F9FAFB !important; }
    #html-root.dark .navbar,
    #html-root.dark .sidebar,
    #html-root.dark .quiz-topbar { background: #111111 !important; border-color: #222222 !important; }
    #html-root.dark .leccion-card,
    #html-root.dark .modulo-card,
    #html-root.dark .stat-card,
    #html-root.dark .filter-card,
    #html-root.dark .table-card,
    #html-root.dark .pregunta-card,
    #html-root.dark .quiz-card,
    #html-root.dark .card { background: #1A1A1A !important; border-color: #2D2D2D !important; }
    #html-root.dark h1,
    #html-root.dark h2,
    #html-root.dark h3,
    #html-root.dark .stat-num,
    #html-root.dark .enunciado,
    #html-root.dark .leccion-titulo,
    #html-root.dark .page-title,
    #html-root.dark .page-sub { color: #F9FAFB !important; }
    #html-root.dark p { color: #9CA3AF !important; }
    #html-root.dark .leccion-body { background: #111111 !important; border-color: #2D2D2D !important; color: #E5E7EB !important; }
    #html-root.dark .lecciones-list { background: #111111 !important; border-color: #2D2D2D !important; }
    #html-root.dark .leccion-row { color: #F9FAFB !important; border-bottom-color: #2D2D2D !important; }
    #html-root.dark .leccion-row.completada { color: #9CA3AF !important; }
    #html-root.dark .leccion-row.disponible:hover,
    #html-root.dark .leccion-row.completada:hover { background: #1E3A2F !important; }
    #html-root.dark .progress-bar-bg,
    #html-root.dark .progress-track { background: #2D2D2D !important; }
    #html-root.dark .opcion-btn { background: #1A1A1A !important; border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark .opcion-btn:hover:not(:disabled) { background: #14532D !important; border-color: #4ADE80 !important; }
    #html-root.dark select,
    #html-root.dark input,
    #html-root.dark textarea { background: #1A1A1A !important; border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark table thead th { background: #111111 !important; color: #9CA3AF !important; border-color: #2D2D2D !important; }
    #html-root.dark table tbody td { color: #F9FAFB !important; border-color: #2D2D2D !important; }
    #html-root.dark table tbody tr:hover { background: #1A1A1A !important; }
    #html-root.dark .nav-item { color: #9CA3AF !important; }
    #html-root.dark .nav-item.active,
    #html-root.dark .nav-item:hover { background: #1A1A1A !important; color: #4ADE80 !important; }
    #html-root.dark .nav-item.active i,
    #html-root.dark .nav-item:hover i { color: #4ADE80 !important; }
    #html-root.dark .xp-badge { background: #14532D !important; color: #4ADE80 !important; border-color: #15803D !important; }
    #html-root.dark .modulo-tag { background: #14532D !important; color: #4ADE80 !important; }
    #html-root.dark .xp-tag { background: #14532D !important; color: #4ADE80 !important; border-color: #15803D !important; }
    #html-root.dark .breadcrumb a { color: #9CA3AF !important; }
    #html-root.dark .count-badge { background: #14532D !important; color: #4ADE80 !important; }
    #html-root.dark .opcion-row { background: #1A1A1A !important; border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark .intentos-box { background: #111111 !important; border-color: #2D2D2D !important; }
    #html-root.dark .intento-row { border-color: #2D2D2D !important; color: #F9FAFB !important; }
    #html-root.dark .prog-wrap { background: #2D2D2D !important; }

    </style>
</head>
<body>
  <div class="topbar">
    <span class="brand">Bitlyx</span>
    <div class="nav-links">
      <a href="{{ route('user.dashboard') }}">Dashboard</a>
      <a href="{{ route('quiz.historial') }}">Mi Historial</a>
      <a href="{{ route('quiz.leaderboard') }}" class="active">🏅 Ranking</a>
    </div>
  </div>

  <div class="main">
    <h1 class="page-title">🏅 Ranking de Usuarios</h1>
    <p class="page-sub">Top 10 usuarios con más XP acumulado</p>

    @if($ranking->count() >= 3)
    <div class="podium">
      {{-- 2do lugar --}}
      <div class="podium-item second">
        <div class="podium-medal">🥈</div>
        <div class="podium-nombre">{{ $ranking[1]['nombre'] }}</div>
        <div class="podium-xp">{{ $ranking[1]['xp_total'] }} XP</div>
      </div>
      {{-- 1er lugar --}}
      <div class="podium-item first">
        <div class="podium-medal">🥇</div>
        <div class="podium-nombre">{{ $ranking[0]['nombre'] }}</div>
        <div class="podium-xp">{{ $ranking[0]['xp_total'] }} XP</div>
      </div>
      {{-- 3er lugar --}}
      <div class="podium-item third">
        <div class="podium-medal">🥉</div>
        <div class="podium-nombre">{{ $ranking[2]['nombre'] }}</div>
        <div class="podium-xp">{{ $ranking[2]['xp_total'] }} XP</div>
      </div>
    </div>
    @endif

    <div class="ranking-list">
      @foreach($ranking as $item)
        <div class="ranking-row {{ $item['es_yo'] ? 'es-yo' : '' }}">
          <span class="rank-num">{{ $item['posicion'] }}</span>
          <div class="rank-avatar {{ $item['es_yo'] ? 'yo' : '' }}">
            {{ strtoupper(substr($item['nombre'], 0, 2)) }}
          </div>
          <span class="rank-nombre">{{ $item['nombre'] }}</span>
          @if($item['es_yo'])
            <span class="yo-badge">Tú</span>
          @endif
          <span class="rank-xp">{{ $item['xp_total'] }} XP</span>
        </div>
      @endforeach
    </div>
  </div>

    <script>
    (function() {
        var btn  = document.getElementById('dark-btn');
        var root = document.getElementById('html-root');
        function applyDark(on) {
            if (on) { root.classList.add('dark'); }
            else     { root.classList.remove('dark'); }
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