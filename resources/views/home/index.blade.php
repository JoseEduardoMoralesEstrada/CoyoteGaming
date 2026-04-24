@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div style="text-align:center; padding:80px 20px; background:linear-gradient(135deg, #1a1a2e, #16213e);">
    <h1 style="font-size:48px; color:#f97316; margin-bottom:20px;">🎮 CoyoteGaming</h1>
    <p style="font-size:20px; color:#d1d5db; margin-bottom:40px;">Los mejores videojuegos al mejor precio</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary" style="font-size:18px; padding:15px 40px;">
        Ver catálogo
    </a>
</div>
@endsection
