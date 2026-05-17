<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Bitlyx — {{ $leccion->titulo }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div id="leccion-app"
    data-leccion="{{ json_encode([
        'id'      => $leccion->id,
        'titulo'  => $leccion->titulo,
        'contenido' => $leccion->contenido,
        'modulo'  => $leccion->modulo->titulo,
        'orden'   => $leccion->orden,
        'completada' => $progreso ? (bool)$progreso->completada : false,
    ]) }}"
    data-anterior="{{ $anterior ? json_encode(['id' => $anterior->id, 'titulo' => $anterior->titulo]) : 'null' }}"
    data-siguiente="{{ $siguiente ? json_encode(['id' => $siguiente->id, 'titulo' => $siguiente->titulo]) : 'null' }}"
    data-porcentaje="{{ $porcentajeModulo }}"
    data-total="{{ $leccionesDelModulo->count() }}"
    data-completadas="{{ $leccionesCompletadas }}"
    data-usuario="{{ json_encode(['nombre' => $usuario->nombre, 'xp_total' => $usuario->xp_total]) }}"
  ></div>
</body>
</html>
