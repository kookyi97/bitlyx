<!DOCTYPE html>
<html lang="es" id="html-root">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Bitlyx — Quiz: {{ $modulo->titulo }}</title>
  @vite(['resources/js/app.js'])
  <style>
    #html-root.dark body { background: #0D0D0D !important; }
  </style>
</head>
<body>
  <div id="quiz-app"
    data-preguntas="{{ $preguntasJson }}"
    data-modulo="{{ json_encode(['id' => $modulo->id, 'titulo' => $modulo->titulo]) }}"
    data-usuario="{{ json_encode(['nombre' => $usuario->nombre, 'xp_total' => $usuario->xp_total]) }}"
  ></div>
  <script>
  (function() {
    var root = document.getElementById('html-root');
    if (localStorage.getItem('bitlyx-dark') === '1') root.classList.add('dark');
  })();
  </script>
</body>
</html>