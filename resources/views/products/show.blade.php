@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container" style="padding:40px 20px;">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px;">

        <div>
            <img src="{{ $product->image ? Storage::url($product->image) : asset('images/no-image.jpg') }}"
                alt="{{ $product->name }}"
                style="width:100%; border-radius:10px;">
        </div>

        <div>
            <span style="background:#374151; color:#f97316; padding:4px 12px; border-radius:20px; font-size:13px;">
                {{ $product->platform }}
            </span>
            <h1 style="font-size:32px; margin:15px 0 10px;">{{ $product->name }}</h1>
            <p style="color:#9ca3af; margin-bottom:10px;">Categoría: {{ $product->category->name }}</p>
            <p style="color:#9ca3af; margin-bottom:20px;">Género: {{ $product->genre ?? 'N/A' }}</p>
            <p style="color:#d1d5db; margin-bottom:30px;">{{ $product->description }}</p>

            <p style="font-size:36px; color:#f97316; font-weight:bold; margin-bottom:10px;">
                ${{ number_format($product->price, 2) }}
            </p>
            <p style="color:#9ca3af; margin-bottom:30px;">
                Stock disponible: {{ $product->stock }} unidades
            </p>

            @if($product->stock > 0)
                @auth
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="font-size:18px; padding:15px 40px;">
                            🛒 Agregar al carrito
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary" style="font-size:18px; padding:15px 40px;">
                        Inicia sesión para comprar
                    </a>
                @endauth
            @else
                <button class="btn btn-secondary" disabled style="font-size:18px; padding:15px 40px;">
                    Agotado
                </button>
            @endif

            <div style="margin-top:30px;">
                <a href="{{ route('products.index') }}" style="color:#9ca3af; text-decoration:none;">← Volver al catálogo</a>
            </div>
        </div>
    </div>
</div>
@endsection