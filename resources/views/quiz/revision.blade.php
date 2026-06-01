<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bitlyx — Revisión del Quiz</title>
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
      z-index: 100;
    }
    .topbar-title { font-size: 16px; font-weight: 600; color: #0f172a; }
    .btn-back {
      display: flex;
      align-items: center;
      gap: 6px;
      color: #64748b;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
    }
    .main { max-width: 720px; margin: 0 auto; padding: 40px 24px; }
    .page-title { font-size: 22px; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
    .page-sub { font-size: 14px; color: #64748b; margin-bottom: 32px; }
    .pregunta-card {
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      padding: 24px;
      margin-bottom: 16px;
    }
    .pregunta-num {
      font-size: 11px;
      font-weight: 600;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: .5px;
      margin-bottom: 8px;
    }
    .pregunta-texto {
      font-size: 15px;
      font-weight: 600;
      color: #0f172a;
      margin-bottom: 16px;
      line-height: 1.5;
    }
    .opcion-row {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      border-radius: 8px;
      margin-bottom: 8px;
      border: 1.5px solid #e2e8f0;
      font-size: 14px;
      color: #334155;
    }
    .opcion-row.correcta {
      border-color: #16a34a;
      background: #dcfce7;
      color: #14532d;
      font-weight: 600;
    }
    .opcion-row.incorrecta {
      border-color: #dc2626;
      background: #fee2e2;
      color: #7f1d1d;
    }
    .opcion-row.solo-correcta {
      border-color: #16a34a;
      background: #f0fdf4;
      color: #14532d;
    }
    .opcion-icon { font-size: 15px; flex-shrink: 0; }
    .result-badge {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      font-size: 11px;
      font-weight: 600;
      padding: 3px 10px;
      border-radius: 20px;
      margin-bottom: 12px;
    }
    .badge-ok  { background: #dcfce7; color: #14532d; }
    .badge-mal { background: #fee2e2; color: #7f1d1d; }
    .btn-dashboard {
      display: block;
      text-align: center;
      margin-top: 32px;
      padding: 14px;
      background: #0f172a;
      color: #fff;
      border-radius: 10px;
      text-decoration: none;
      font-size: 15px;
      font-weight: 600;
    }
    .btn-dashboard:hover { background: #1e293b; }
  </style>
</head>
<body>
  <div class="topbar">
    <a href="{{ route('user.dashboard') }}" class="btn-back">← Salir</a>
    <span class="topbar-title">Revisión del Quiz</span>
    <span style="width:60px"></span>
  </div>

  <div class="main">
    <h1 class="page-title">Revisión de respuestas</h1>
    <p class="page-sub">{{ $leccion->titulo }}</p>

    @foreach($preguntas as $i => $pregunta)
      @php
        $respuesta    = $mapaRespuestas->get($pregunta->id);
        $esCorrecta   = $respuesta && $respuesta['es_correcta'];
        $opcionElegida = $respuesta ? $respuesta['opcion_seleccionada_id'] : null;
      @endphp

      <div class="pregunta-card">
        <div class="pregunta-num">Pregunta {{ $i + 1 }}</div>
        <span class="result-badge {{ $esCorrecta ? 'badge-ok' : 'badge-mal' }}">
          {{ $esCorrecta ? '✓ Correcta' : '✗ Incorrecta' }}
        </span>
        <p class="pregunta-texto">{{ $pregunta->enunciado }}</p>

        @foreach($pregunta->opciones as $opcion)
          @php
            $seleccionada  = $opcionElegida == $opcion->id;
            $esLaCorrecta  = $opcion->es_correcta;
            $clase = '';
            if ($seleccionada && $esLaCorrecta)  $clase = 'correcta';
            elseif ($seleccionada && !$esLaCorrecta) $clase = 'incorrecta';
            elseif (!$seleccionada && $esLaCorrecta) $clase = 'solo-correcta';
          @endphp
          <div class="opcion-row {{ $clase }}">
            <span class="opcion-icon">
              @if($seleccionada && $esLaCorrecta) ✓
              @elseif($seleccionada && !$esLaCorrecta) ✗
              @elseif(!$seleccionada && $esLaCorrecta) ➜