<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Bitlyx — Quiz: {{ $leccion->titulo }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div id="quiz-app"
    data-preguntas="{{ $preguntasJson }}"
    data-leccion="{{ json_encode(['id' => $leccion->id, 'titulo' => $leccion->titulo]) }}"
    data-usuario="{{ json_encode(['nombre' => $usuario->nombre, 'xp_total' => $usuario->xp_total]) }}"
  ></div>
</body>
</html>