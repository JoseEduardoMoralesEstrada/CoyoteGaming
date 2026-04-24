@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container" style="padding:40px 20px; max-width:600px;">
    <h1 style="color:#f97316; margin-bottom:30px;">Confirmar Compra</h1>

    <div style="background:#1f2937; border-radius:10px; padding:25px; margin-bottom:25px;">
        <h2 style="margin-bottom:20px;">Resumen del pedido</h2>

        @foreach($cart->items as $item)
        <div style="display:flex; justify-content:space-between; margin-bottom:12px; padding-bottom:12px; border-bottom:1px solid #374151;">
            <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
            <span style="color:#f97316;">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
        </div>
        @endforeach

        <div style="display:flex; justify-content:space-between; margin-top:15px;">
            <span style="color:#9ca3af;">Subtotal</span>
            <span>${{ number_format($cart->subtotal(), 2) }}</span>
        </div>
        <div style="display:flex; justify-content:space-between; margin-top:10px;">
            <span style="color:#9ca3af;">IVA (16%)</span>
            <span>${{ number_format($cart->tax(), 2) }}</span>
        </div>
        <hr style="border-color:#374151; margin:15px 0;">
        <div style="display:flex; justify-content:space-between;">
            <span style="font-size:20px; font-weight:bold;">Total</span>
            <span style="font-size:20px; font-weight:bold; color:#f97316;">
                ${{ number_format($cart->total(), 2) }}
            </span>
        </div>
    </div>

    <div style="background:#1f2937; border-radius:10px; padding:25px; margin-bottom:25px; border:1px solid #374151;">
        <p style="color:#9ca3af; text-align:center; margin-bottom:5px;">Pago simulado</p>
        <p style="color:#6b7280; text-align:center; font-size:13px;">No se realizará ningún cargo real</p>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary" style="width:100%; font-size:18px; padding:15px;">
            Confirmar y Pagar
        </button>
    </form>

    <div style="margin-top:15px; text-align:center;">
        <a href="{{ route('cart.index') }}" style="color:#9ca3af; text-decoration:none;">← Volver al carrito</a>
    </div>
</div>
@endsection