<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bitlyx — Resultados</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      min-height: 100vh;
      background: #f8fafc;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }
    .card {
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      padding: 48px 40px;
      max-width: 520px;
      width: 100%;
      text-align: center;
    }
    .trophy { font-size: 64px; margin-bottom: 16px; }
    h1 { font-size: 26px; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
    .sub { font-size: 14px; color: #64748b; margin-bottom: 36px; }
    .stats-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      margin-bottom: 28px;
    }
    .stat {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 18px 12px;
    }
    .stat-val { font-size: 26px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px; }
    .stat-val.verde { color: #16a34a; }
    .stat-val.azul  { color: #1e3a8a; }
    .stat-lbl { font-size: 12px; color: #64748b; font-weight: 500; }
    .progress-wrap {
      background: #f1f5f9;
      border-radius: 99px;
      height: 8px;
      margin-bottom: 32px;
      overflow: hidden;
    }
    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, #1e3a8a, #2563eb);
      border-radius: 99px;
    }
    .btn-primary {
      display: block;
      width: 100%;
      padding: 14px;
      background: #0f172a;
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      margin-bottom: 10px;
    }
    .btn-secondary {
      display: block;
      width: 100%;
      padding: 14px;
      background: #fff;
      color: #334155;
      border: 1px solid #e2e8f0;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 500;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="trophy">🏆</div>
    <h1>¡Quiz completado!</h1>
    <p class="sub">{{ $leccion->titulo }}</p>

    <div class="stats-row">
      <div class="stat">
        <span class="stat-val verde">{{ $porcentaje }}%</span>
        <span class="stat-lbl">Puntaje</span>
      </div>
      <div class="stat">
        <span class="stat-val">{{ $datos['correctas'] }}/{{ $datos['total'] }}</span>
        <span class="stat-lbl">Correctas</span>
      </div>
      <div class="stat">
        <span class="stat-val azul">+{{ $datos['xp_ganado'] }}</span>
        <span class="stat-lbl">XP ganados</span>
      </div>
    </div>

    <div class="progress-wrap">
      <div class="progress-fill" style="width: {{ max(0, min(100, intval($porcentaje ?? 0))) }}%"></div>
    </div>

    <a href="{{ route('user.dashboard') }}" class="btn-primary">Volver al dashboard →</a>
    <a href="{{ route('leccion.show', $datos['leccion_id']) }}" class="btn-secondary">Ver la lección</a>
  </div>
</body>
</html>