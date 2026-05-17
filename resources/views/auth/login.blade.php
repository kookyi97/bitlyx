<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Bitlyx — Login</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
  <div id="login-app"></div>
  <script>
    window.loginErrors = @json($errors->toArray());
    window.oldEmail    = "{{ old('email') }}";
  </script>
</body>
</html>