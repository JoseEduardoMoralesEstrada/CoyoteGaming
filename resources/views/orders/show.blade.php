@extends('layouts.app')

@section('title', 'Pedido #' . $order->id)

@section('content')
<div class="container" style="padding:40px 20px; max-width:700px;">
    <h1 style="color:#f97316; margin-bottom:5px;">Pedido #{{ $order->id }}</h1>
    <p style="color:#9ca3af; margin-bottom:30px;">{{ $order->created_at->format('d/m/Y H:i') }}</p>

    <div style="background:#1f2937; border-radius:10px; padding:25px; margin-bottom:25px;">
        <h2 style="margin-bottom:20px;">Productos</h2>
        @foreach($order->items as $item)
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; padding-bottom:15px; border-bottom:1px solid #374151;">
            <div>
                <p style="font-weight:bold;">{{ $item->product->name }}</p>
                <p style="color:#9ca3af; font-size:13px;">{{ $item->product->platform }}</p>
            </div>
            <div style="text-align:right;">
                <p style="color:#9ca3af;">x{{ $item->quantity }}</p>
                <p style="color:#f97316; font-weight:bold;">${{ number_format($item->unit_price * $item->quantity, 2) }}</p>
            </div>
        </div>
        @endforeach

        <div style="display:flex; justify-content:space-between; margin-top:10px;">
            <span style="color:#9ca3af;">Subtotal</span>
            <span>${{ number_format($order->subtotal, 2) }}</span>
        </div>
        <div style="display:flex; justify-content:space-between; margin-top:10px;">
            <span style="color:#9ca3af;">IVA (16%)</span>
            <span>${{ number_format($order->tax, 2) }}</span>
        </div>
        <hr style="border-color:#374151; margin:15px 0;">
        <div style="display:flex; justify-content:space-between;">
            <span style="font-size:20px; font-weight:bold;">Total</span>
            <span style="font-size:20px; font-weight:bold; color:#f97316;">
                ${{ number_format($order->total, 2) }}
            </span>
        </div>
    </div>

    <a href="{{ route('orders.index') }}" style="color:#9ca3af; text-decoration:none;">← Volver a mis pedidos</a>
</div>
@endsection