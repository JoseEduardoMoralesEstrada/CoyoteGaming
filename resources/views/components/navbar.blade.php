<nav style="background:#1a1a2e; padding:15px 0; border-bottom:2px solid #f97316;">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center;">

        <a href="{{ route('home') }}" style="color:#f97316; font-size:22px; font-weight:bold; text-decoration:none;">
            🎮 CoyoteGaming
        </a>

        <div style="display:flex; gap:20px; align-items:center;">
            <a href="{{ route('products.index') }}" style="color:#fff; text-decoration:none;">Productos</a>

            @auth
                <a href="{{ route('cart.index') }}" style="color:#fff; text-decoration:none;">🛒 Carrito</a>
                <a href="{{ route('orders.index') }}" style="color:#fff; text-decoration:none;">Mis pedidos</a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" style="color:#f97316; text-decoration:none; font-weight:bold;">Panel Admin</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:#f97316; border:none; color:#fff; padding:8px 16px; border-radius:6px; cursor:pointer;">
                        Salir
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color:#fff; text-decoration:none;">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
            @endauth
        </div>

    </div>
</nav>