<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoyoteGaming — @yield('title', 'Tu tienda de videojuegos')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #0f0f0f; color: #fff; }
        .alert-success { background: #16a34a; color: #fff; padding: 10px 20px; text-align: center; }
        .alert-error { background: #dc2626; color: #fff; padding: 10px 20px; text-align: center; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .btn { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #f97316; color: #fff; }
        .btn-primary:hover { background: #ea6c0a; }
        .btn-danger { background: #dc2626; color: #fff; }
        .btn-secondary { background: #374151; color: #fff; }
    </style>
</head>
<body>
    @include('components.navbar')

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('components.footer')
</body>
</html>