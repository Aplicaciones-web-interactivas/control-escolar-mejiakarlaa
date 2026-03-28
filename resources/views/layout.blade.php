<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; margin: 0; background: #f5f5f5; }
        .navbar { background: #2d3748; color: white; padding: 12px 24px; display: flex; gap: 20px; align-items: center; }
        .navbar a { color: #e2e8f0; text-decoration: none; font-size: 14px; }
        .navbar a:hover { color: white; text-decoration: underline; }
        .navbar .brand { font-weight: bold; font-size: 16px; color: white; margin-right: 16px; }
        .container { max-width: 960px; margin: 32px auto; padding: 0 16px; }
        .alert-success { background: #c6f6d5; border: 1px solid #9ae6b4; color: #276749; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; }
        .alert-error { background: #fed7d7; border: 1px solid #fc8181; color: #9b2c2c; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; }
        .btn { display: inline-block; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-size: 14px; cursor: pointer; border: none; }
        .btn-primary { background: #4299e1; color: white; }
        .btn-success { background: #48bb78; color: white; }
        .btn-sm { padding: 4px 10px; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        th { background: #edf2f7; text-align: left; padding: 10px 14px; font-size: 13px; color: #4a5568; }
        td { padding: 10px 14px; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 99px; font-size: 11px; font-weight: 600; }
        .badge-green { background: #c6f6d5; color: #276749; }
        .badge-blue  { background: #bee3f8; color: #2c5282; }
        .badge-gray  { background: #e2e8f0; color: #4a5568; }
        .card { background: white; border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,.1); margin-bottom: 20px; }
        h2 { margin-top: 0; color: #2d3748; }
        label { display: block; margin-bottom: 4px; font-size: 13px; font-weight: 600; color: #4a5568; }
        input[type=text], input[type=date], textarea, select {
            width: 100%; padding: 8px 10px; border: 1px solid #cbd5e0;
            border-radius: 5px; font-size: 14px; box-sizing: border-box; margin-bottom: 14px;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <span class="brand">🏫 Sistema Escolar</span>
    <a href="/inscripciones">Inscripciones</a>
    <a href="/calificaciones">Calificaciones</a>
    <a href="/tareas?maestro_id=1">Tareas (Maestro)</a>
    <a href="/entregas?alumno_id=2">Tareas (Alumno)</a>
</nav>
<div class="container">
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
