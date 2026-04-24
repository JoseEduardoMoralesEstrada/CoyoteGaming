@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<div class="container" style="padding: 40px 20px;">

    <h1 style="color:#f97316; margin-bottom:30px;">Catálogo de Juegos</h1>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('products.index') }}" style="display:flex; gap:15px; margin-bottom:30px; flex-wrap:wrap;">
        <input type="text" name="search" placeholder="Buscar juego..." value="{{ request('search') }}"
            style="padding:10px; background:#1f2937; border:1px solid #374151; border-radius:6px; color:#fff; flex:1; min-width:200px;">

        <select name="category" style="padding:10px; background:#1f2937; border:1px solid #374151; border-radius:6px; color:#fff;">
            <option value="">Todas las categorías</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="platform" style="padding:10px; background:#1f2937; border:1px solid #374151; border-radius:6px; color:#fff;">
            <option value="">Todas las plataformas</option>
            <option value="PC" {{ request('platform') == 'PC' ? 'selected' : '' }}>PC</option>
            <option value="PS5" {{ request('platform') == 'PS5' ? 'selected' : '' }}>PS5</option>
            <option value="Xbox Series X" {{ request('platform') == 'Xbox Series X' ? 'selected' : '' }}>Xbox Series X</option>
            <option value="Nintendo Switch" {{ request('platform') == 'Nintendo Switch' ? 'selected' : '' }}>Nintendo Switch</option>
        </select>

        <select name="sort" style="padding:10px; background:#1f2937; border:1px solid #374151; border-radius:6px; color:#fff;">
            <option value="">Más recientes</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Precio: menor a mayor</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
        </select>

        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Limpiar</a>
    </form>

    {{-- Grid de productos --}}
    @if($products->isEmpty())
        <p style="color:#9ca3af; text-align:center; padding:60px;">No se encontraron productos.</p>
    @else
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(250px, 1fr)); gap:25px;">
            @foreach($products as $product)
                <div style="background:#1f2937; border-radius:10px; overflow:hidden; transition:transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <img src="{{ $product->image ? Storage::url($product->image) : asset('images/no-image.jpg') }}"
                        alt="{{ $product->name }}"
                        style="width:100%; height:180px; object-fit:cover;">

                    <div style="padding:15px;">
                        <span style="background:#374151; color:#f97316; padding:3px 10px; border-radius:20px; font-size:12px;">
                            {{ $product->platform }}
                        </span>
                        <h3 style="margin:10px 0 5px; font-size:16px;">{{ $product->name }}</h3>
                        <p style="color:#9ca3af; font-size:13px; margin-bottom:10px;">{{ $product->category->name }}</p>
                        <p style="color:#f97316; font-size:20px; font-weight:bold; margin-bottom:15px;">
                            ${{ number_format($product->price, 2) }}
                        </p>

                        <div style="display:flex; gap:10px;">
                            @auth
                                <form action="{{ route('cart.add', $product) }}" method="POST" style="flex:1;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="width:100%;"
                                        {{ $product->stock == 0 ? 'disabled' : '' }}>
                                        {{ $product->stock > 0 ? '🛒 Agregar' : 'Agotado' }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary" style="flex:1; text-align:center;">
                                    🛒 Agregar
                                </a>
                            @endauth
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-secondary">Ver</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        <div style="margin-top:40px; display:flex; justify-content:center;">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection