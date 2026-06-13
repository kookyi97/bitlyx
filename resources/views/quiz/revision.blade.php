<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bitlyx — Revisión</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    body{background:#F3F4F6;font-family:'Inter',sans-serif;color:#111827;padding:24px;min-height:100vh}
    .header{max-width:720px;margin:0 auto 24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px}
    .page-title{font-family:'Nunito',sans-serif;font-size:1.5rem;font-weight:800}
    .page-sub{font-size:.85rem;color:#6B7280;margin-top:2px}
    .btn-back{display:inline-flex;align-items:center;gap:6px;padding:.55rem 1.2rem;background:#fff;border:1.5px solid #E5E7EB;border-radius:10px;font-size:.875rem;font-weight:600;color:#111827;text-decoration:none}
    .btn-back:hover{background:#F9FAFB}

    .pregunta-card{background:#fff;border:1px solid #E5E7EB;border-radius:16px;padding:22px 24px;max-width:720px;margin:0 auto 14px}
    .card-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
    .pregunta-num{font-size:.75rem;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:.4px}
    .badge-ok{background:#DCFCE7;color:#14532D;font-size:.75rem;font-weight:700;padding:3px 12px;border-radius:20px}
    .badge-mal{background:#FEE2E2;color:#991B1B;font-size:.75rem;font-weight:700;padding:3px 12px;border-radius:20px}
    .badge-skip{background:#F3F4F6;color:#6B7280;font-size:.75rem;font-weight:700;padding:3px 12px;border-radius:20px}
    .pregunta-texto{font-size:.975rem;font-weight:600;color:#111827;line-height:1.5;margin-bottom:14px}

    .opcion-row{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;border:1.5px solid #E5E7EB;margin-bottom:8px;font-size:.875rem;color:#374151;background:#fff}
    .opcion-row:last-child{margin-bottom:0}
    .opcion-row.mi-correcta{border-color:#16a34a;background:#F0FDF4;color:#14532D;font-weight:600}
    .opcion-row.mi-incorrecta{border-color:#dc2626;background:#FEF2F2;color:#991B1B;font-weight:600}
    .opcion-icon{font-size:14px;flex-shrink:0;width:20px;text-align:center}

    .footer{max-width:720px;margin:8px auto 0;display:flex;gap:10px;flex-wrap:wrap}
    .btn-retry{display:inline-flex;align-items:center;gap:6px;padding:.65rem 1.4rem;background:#15803D;color:#fff;border-radius:10px;font-size:.875rem;font-weight:600;text-decoration:none}
    .btn-retry:hover{background:#166534}
    .btn-dash{display:inline-flex;align-items:center;gap:6px;padding:.65rem 1.4rem;background:#fff;color:#111827;border:1.5px solid #E5E7EB;border-radius:10px;font-size:.875rem;font-weight:600;text-decoration:none}
    .btn-dash:hover{background:#F9FAFB}
  </style>
</head>
<body>
  <div class="header">
    <div>
      <h1 class="page-title">Revisión de respuestas</h1>
      <p class="page-sub">{{ $modulo->titulo }}</p>
    </div>
    <a href="{{ route('user.dashboard') }}" class="btn-back">← Dashboard</a>
  </div>

  @foreach($preguntas as $i => $pregunta)
    @php
      $respuesta     = $mapaRespuestas->get($pregunta->id);
      $esCorrecta    = $respuesta && $respuesta['es_correcta'];
      $opcionElegida = $respuesta ? $respuesta['opcion_seleccionada_id'] : null;
      $sinRespuesta  = !$opcionElegida;
    @endphp

    <div class="pregunta-card">
      <div class="card-top">
        <span class="pregunta-num">Pregunta {{ $i + 1 }}</span>
        @if($sinRespuesta)
          <span class="badge-skip">⏱ Sin respuesta</span>
        @elseif($esCorrecta)
          <span class="badge-ok">✓ Correcta</span>
        @else
          <span class="badge-mal">✗ Incorrecta</span>
        @endif
      </div>

      <p class="pregunta-texto">{{ $pregunta->enunciado }}</p>

      @foreach($pregunta->opciones as $opcion)
        @php
          $fueElegida   = $opcionElegida == $opcion->id;
          $clase = '';
          if ($fueElegida && $opcion->es_correcta)  $clase = 'mi-correcta';
          elseif ($fueElegida && !$opcion->es_correcta) $clase = 'mi-incorrecta';
        @endphp
        <div class="opcion-row {{ $clase }}">
          <span class="opcion-icon">
            @if($fueElegida && $opcion->es_correcta) ✓
            @elseif($fueElegida && !$opcion->es_correcta) ✗
            @else &nbsp;
            @endif
          </span>
          <span>{{ $opcion->texto }}</span>
        </div>
      @endforeach
    </div>
  @endforeach

  <div class="footer">
    <a href="{{ route('quiz.reintentar', $modulo->id) }}" class="btn-retry">🔄 Reintentar quiz</a>
    <a href="{{ route('user.dashboard') }}" class="btn-dash">← Dashboard</a>
  </div>
</body>
</html>
