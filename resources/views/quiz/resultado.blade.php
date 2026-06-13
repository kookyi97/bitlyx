<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bitlyx — Resultados</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
  <style>
    :root{--bg:#f8fafc;--surface:#fff;--border:#e2e8f0;--text:#0f172a;--muted:#64748b;--ok-bg:#dcfce7;--ok-text:#14532d;--ok-border:#86efac;--primary:#15803d;--accent:#2563eb;--stat-bg:#f1f5f9}
    .dark{--bg:#0f172a;--surface:#1e293b;--border:#334155;--text:#f1f5f9;--muted:#94a3b8;--ok-bg:#14532d;--ok-text:#bbf7d0;--ok-border:#15803d;--primary:#4ade80;--accent:#60a5fa;--stat-bg:#0f172a}
    *{box-sizing:border-box;margin:0;padding:0}
    body{min-height:100vh;background:var(--bg);font-family:'Inter',sans-serif;color:var(--text);display:flex;align-items:center;justify-content:center;padding:24px;transition:background .25s,color .25s}
    .card{background:var(--surface);border:1px solid var(--border);border-radius:22px;padding:44px 40px;max-width:540px;width:100%;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,.06);transition:background .25s,border-color .25s;position:relative}
    .trophy{font-size:60px;margin-bottom:12px}
    h1{font-family:'Nunito',sans-serif;font-size:26px;font-weight:800;margin-bottom:4px}
    .sub{font-size:14px;color:var(--muted);margin-bottom:16px}
    .badge-mod{display:inline-block;background:var(--ok-bg);color:var(--ok-text);font-size:13px;font-weight:600;padding:4px 14px;border-radius:20px;margin-bottom:16px}
    .badge-mejora{display:inline-block;background:#EFF6FF;color:#1E3A8A;font-size:13px;font-weight:600;padding:4px 14px;border-radius:20px;margin-bottom:20px}
    .stats-row{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:20px}
    .stat{background:var(--stat-bg);border:1px solid var(--border);border-radius:14px;padding:16px 10px;transition:background .25s,border-color .25s}
    .stat-val{font-family:'Nunito',sans-serif;font-size:26px;font-weight:800;display:block;margin-bottom:3px}
    .verde{color:#16a34a}.azul{color:var(--accent)}
    .stat-lbl{font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.4px}
    .prog-wrap{background:var(--border);border-radius:99px;height:8px;margin-bottom:28px;overflow:hidden}
    .prog-fill{height:100%;background:linear-gradient(90deg,var(--primary),var(--accent));border-radius:99px}
    .intentos-box{text-align:left;margin-bottom:20px;background:var(--stat-bg);border:1px solid var(--border);border-radius:14px;overflow:hidden;transition:background .25s,border-color .25s}
    .intentos-title{font-size:12px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;padding:10px 16px;border-bottom:1px solid var(--border)}
    .intento-row{display:flex;align-items:center;justify-content:space-between;padding:9px 16px;font-size:13px;border-bottom:1px solid var(--border)}
    .intento-row:last-child{border-bottom:none}
    .intento-num{color:var(--muted);font-weight:600;min-width:20px}
    .intento-pct{font-size:12px;font-weight:700;padding:2px 9px;border-radius:20px;background:var(--ok-bg);color:var(--ok-text)}
    .intento-pct.bajo{background:#fee2e2;color:#7f1d1d}
    .intento-fecha{font-size:11px;color:var(--muted)}
    .btn-primary,.btn-secondary{display:block;width:100%;padding:13px;border-radius:11px;font-size:15px;font-weight:600;text-decoration:none;text-align:center;cursor:pointer;margin-bottom:10px;border:none;transition:opacity .15s,transform .1s}
    .btn-primary:hover,.btn-secondary:hover{opacity:.88;transform:translateY(-1px)}
    .btn-primary{background:var(--text);color:var(--surface)}
    .btn-secondary{background:var(--surface);color:var(--text);border:1.5px solid var(--border)}

    /* Aprobado banner */
    .aprobado-banner{background:linear-gradient(135deg,#DCFCE7,#BBF7D0);border:1px solid #4ADE80;border-radius:14px;padding:16px;margin-bottom:20px;display:flex;align-items:center;gap:12px}
    .dark .aprobado-banner{background:linear-gradient(135deg,#14532d,#15803d);border-color:#4ade80}
    .aprobado-banner .ab-icon{font-size:28px;flex-shrink:0}
    .aprobado-banner .ab-text h3{font-family:'Nunito',sans-serif;font-size:1rem;font-weight:800;color:#065F46;margin-bottom:2px}
    .dark .aprobado-banner .ab-text h3{color:#bbf7d0}
    .aprobado-banner .ab-text p{font-size:.8rem;color:#15803D}
    .dark .aprobado-banner .ab-text p{color:#4ade80}

    /* Dark toggle */
    .dark-btn{position:fixed;top:16px;right:16px;background:var(--surface);border:1px solid var(--border);border-radius:50%;width:40px;height:40px;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,.1);transition:background .2s,transform .15s;z-index:100}
    .dark-btn:hover{transform:scale(1.1)}

    /* Confetti canvas */
    #confetti-canvas{position:fixed;inset:0;pointer-events:none;z-index:999}
  </style>
</head>
<body>
  <canvas id="confetti-canvas"></canvas>
  <button class="dark-btn" id="dark-btn" title="Cambiar tema">🌙</button>

  <div class="card">
    <div class="trophy">
      @if($porcentaje >= 70)🏆@elseif($porcentaje >= 50)🎯@else📚@endif
    </div>
    <h1>¡Quiz completado!</h1>
    <p class="sub">Quiz final del módulo</p>
    <div class="badge-mod">📚 {{ $modulo->titulo }}</div>

    @if(!empty($datos['mejoro']))
      <div><span class="badge-mejora">⬆ ¡Mejoraste tu puntaje!</span></div>
    @endif

    @if($porcentaje >= 70)
    <div class="aprobado-banner">
      <div class="ab-icon">🎉</div>
      <div class="ab-text">
        <h3>¡Módulo aprobado!</h3>
        <p>Sacaste {{ $porcentaje }}% — superaste el mínimo requerido (70%)</p>
      </div>
    </div>
    @endif

    <div class="stats-row">
      <div class="stat"><span class="stat-val verde">{{ $porcentaje }}%</span><span class="stat-lbl">Puntaje</span></div>
      <div class="stat"><span class="stat-val">{{ $datos['correctas'] }}/{{ $datos['total'] }}</span><span class="stat-lbl">Correctas</span></div>
      <div class="stat"><span class="stat-val azul">+{{ $datos['xp_ganado'] }}</span><span class="stat-lbl">XP</span></div>
    </div>

    <div class="prog-wrap"><div class="prog-fill" style="width:{{ max(0,min(100,intval($porcentaje))) }}%"></div></div>

    @if(isset($intentos) && $intentos->count() > 1)
    <div class="intentos-box">
      <div class="intentos-title">Últimos {{ $intentos->count() }} intentos</div>
      @foreach($intentos as $idx => $intento)
        @php $pct = $intento->total > 0 ? round($intento->correctas/$intento->total*100) : 0; @endphp
        <div class="intento-row">
          <span class="intento-num">#{{ $idx+1 }}</span>
          <span>{{ $intento->correctas }}/{{ $intento->total }}</span>
          <span class="intento-pct {{ $pct<70?'bajo':'' }}">{{ $pct }}%</span>
          <span class="intento-fecha">{{ \Carbon\Carbon::parse($intento->fecha)->format('d/m H:i') }}</span>
        </div>
      @endforeach
    </div>
    @endif

    <a href="{{ route('user.dashboard') }}" class="btn-primary">Volver al dashboard →</a>

    @if($tieneRevision)
      <a href="{{ route('quiz.revision', $datos['modulo_id']) }}" class="btn-secondary">📋 Ver revisión de respuestas</a>
    @endif

    <a href="{{ route('quiz.reintentar', $datos['modulo_id']) }}" class="btn-secondary">🔄 Reintentar quiz</a>
  </div>

  <script>
  // ── Dark mode ────────────────────────────────────────────
  const btn  = document.getElementById('dark-btn');
  const html = document.getElementById('html-root');
  const saved = localStorage.getItem('bitlyx-dark');
  if (saved === '1') { html.classList.add('dark'); btn.textContent = '☀️'; }
  btn.addEventListener('click', () => {
    const on = html.classList.toggle('dark');
    btn.textContent = on ? '☀️' : '🌙';
    localStorage.setItem('bitlyx-dark', on ? '1' : '0');
  });

  // ── Confetti (solo si aprobó ≥70%) ──────────────────────
  @if($porcentaje >= 70)
  (function() {
    const canvas = document.getElementById('confetti-canvas');
    const ctx    = canvas.getContext('2d');
    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;

    const COLORS = ['#15803D','#4ADE80','#2563EB','#60A5FA','#F59E0B','#EF4444','#8B5CF6','#EC4899'];
    const pieces = [];
    const COUNT  = 120;

    for (let i = 0; i < COUNT; i++) {
      pieces.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height - canvas.height,
        w: Math.random() * 10 + 6,
        h: Math.random() * 5 + 4,
        color: COLORS[Math.floor(Math.random() * COLORS.length)],
        speed: Math.random() * 3 + 2,
        angle: Math.random() * Math.PI * 2,
        spin:  (Math.random() - 0.5) * 0.15,
        drift: (Math.random() - 0.5) * 1.5,
        opacity: 1,
      });
    }

    let frame = 0;
    function draw() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      let alive = false;
      pieces.forEach(p => {
        p.y     += p.speed;
        p.x     += p.drift;
        p.angle += p.spin;
        if (frame > 120) p.opacity = Math.max(0, p.opacity - 0.008);
        if (p.y < canvas.height + 20) alive = true;

        ctx.save();
        ctx.globalAlpha = p.opacity;
        ctx.translate(p.x, p.y);
        ctx.rotate(p.angle);
        ctx.fillStyle = p.color;
        ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
        ctx.restore();
      });
      frame++;
      if (alive && frame < 300) requestAnimationFrame(draw);
      else ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
    // Pequeño delay para que el usuario vea la pantalla primero
    setTimeout(draw, 400);

    window.addEventListener('resize', () => {
      canvas.width  = window.innerWidth;
      canvas.height = window.innerHeight;
    });
  })();
  @endif
  </script>
</body>
</html>
