<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — CoyoteGaming</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #111827; color: #fff; display: flex; }
        .sidebar { width: 240px; background: #1f2937; min-height: 100vh; padding: 20px; }
        .sidebar h2 { color: #f97316; margin-bottom: 30px; font-size: 20px; }
        .sidebar a { display: block; color: #d1d5db; padding: 10px; border-radius: 6px; text-decoration: none; margin-bottom: 5px; }
        .sidebar a:hover { background: #374151; color: #fff; }
        .main-content { flex: 1; padding: 30px; }
        .alert-success { background: #16a34a; color: #fff; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px; }
        .alert-error { background: #dc2626; color: #fff; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px; }
        .btn { padding: 8px 18px; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #f97316; color: #fff; }
        .btn-danger { background: #dc2626; color: #fff; }
        .btn-secondary { background: #374151; color: #fff; }
        table { width: 100%; border-collapse: collapse; background: #1f2937; border-radius: 8px; overflow: hidden; }
        th { background: #374151; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #374151; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #d1d5db; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px; background: #374151; border: 1px solid #4b5563; border-radius: 6px; color: #fff; font-size: 14px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>🎮 CoyoteGaming</h2>
        <p style="color:#9ca3af; font-size:12px; margin-bottom:20px;">Panel Admin</p>
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('admin.products.create') }}">➕ Nuevo Producto</a>
        <a href="{{ route('admin.products.index') }}">📦 Ver Productos</a>
        <a href="{{ route('admin.categories.index') }}">📂 Categorías</a>
        <hr style="border-color:#374151; margin:20px 0;">
        <a href="{{ route('products.index') }}">🛒 Ver tienda</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none; border:none; color:#d1d5db; padding:10px; cursor:pointer; width:100%; text-align:left;">🚪 Cerrar sesión</button>
        </form>
    </div>

    <div class="main-content">
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