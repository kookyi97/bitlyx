<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Bitlyx — Mi Dashboard</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div id="user-dashboard-app"
    data-usuario="{{ json_encode(['nombre' => $usuario->nombre, 'xp_total' => $usuario->xp_total]) }}"
    data-stats="{{ json_encode($stats) }}"
    data-modulos="{{ json_encode($modulosConProgreso) }}"
  ></div>
</body>
</html>
