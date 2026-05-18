<!DOCTYPE html>
<html>
<head>
    <title>Mi Aprendizaje</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { background: #2c3e50; color: white; padding: 20px; border-radius: 10px 10px 0 0; }
        .modulos { display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px; }
        .modulo-card { background: white; border-radius: 10px; padding: 20px; width: calc(33% - 20px); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .modulo-card h3 { margin: 0 0 10px 0; color: #2c3e50; }
        .modulo-card p { color: #666; }
        .btn { background: #3498db; color: white; padding: 8px 16px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 10px; }
        .logout { background: #e74c3c; border: none; cursor: pointer; margin-left: 10px; }
        .progreso { background: #ecf0f1; border-radius: 10px; height: 10px; margin-top: 10px; }
        .progreso-bar { background: #2ecc71; height: 10px; border-radius: 10px; width: 0%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenido, {{ Auth::user()->nombre ?? Auth::user()->name }}</h1>
            <p>Continúa con tu aprendizaje</p>
            <div style="margin-top: 10px;">
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn logout">Cerrar Sesión</button>
                </form>
            </div>
        </div>

        <div class="modulos">
            <h2>Módulos disponibles</h2>
            @foreach($modulos as $modulo)
            <div class="modulo-card">
                <h3>{{ $modulo->titulo }}</h3>
                <p>{{ $modulo->descripcion }}</p>
                <div class="progreso">
                    <div class="progreso-bar" style="width: {{ $progresos[$modulo->id] ?? 0 }}%"></div>
                </div>
                @if($modulo->lecciones->count() > 0)
    <a href="{{ route('leccion.show', $modulo->lecciones->first()->id) }}" class="btn">Comenzar Módulo</a>
@else
    <span class="btn disabled">Próximamente</span>
@endif
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>