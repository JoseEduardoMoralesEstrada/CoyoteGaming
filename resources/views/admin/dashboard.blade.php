@extends('layouts.admin')

@section('content')
<h1 style="color:#f97316; margin-bottom:30px;">📊 Dashboard</h1>

{{-- Tarjetas de resumen --}}
<div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; margin-bottom:40px;">
    <div style="background:#1f2937; border-radius:10px; padding:25px; border-left:4px solid #f97316;">
        <p style="color:#9ca3af; font-size:13px;">Total Productos</p>
        <p style="font-size:36px; font-weight:bold; color:#f97316;">{{ $totalProducts }}</p>
    </div>
    <div style="background:#1f2937; border-radius:10px; padding:25px; border-left:4px solid #3b82f6;">
        <p style="color:#9ca3af; font-size:13px;">Clientes</p>
        <p style="font-size:36px; font-weight:bold; color:#3b82f6;">{{ $totalUsers }}</p>
    </div>
    <div style="background:#1f2937; border-radius:10px; padding:25px; border-left:4px solid #16a34a;">
        <p style="color:#9ca3af; font-size:13px;">Pedidos</p>
        <p style="font-size:36px; font-weight:bold; color:#16a34a;">{{ $totalOrders }}</p>
    </div>
    <div style="background:#1f2937; border-radius:10px; padding:25px; border-left:4px solid #8b5cf6;">
        <p style="color:#9ca3af; font-size:13px;">Ingresos Totales</p>
        <p style="font-size:28px; font-weight:bold; color:#8b5cf6;">${{ number_format($totalRevenue, 2) }}</p>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:30px;">

    {{-- Más vendidos --}}
    <div style="background:#1f2937; border-radius:10px; padding:25px;">
        <h2 style="margin-bottom:20px;">Más Vendidos</h2>
        @forelse($bestSellers as $product)
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; padding-bottom:15px; border-bottom:1px solid #374151;">
            <div>
                <p style="font-weight:bold;">{{ $product->name }}</p>
                <p style="color:#9ca3af; font-size:13px;">{{ $product->category->name }}</p>
            </div>
            <span style="background:#374151; padding:4px 12px; border-radius:20px; font-size:13px; color:#f97316;">
                {{ $product->sales_count }} ventas
            </span>
        </div>
        @empty
            <p style="color:#9ca3af;">Sin ventas aún</p>
        @endforelse
    </div>

    {{-- Pedidos recientes --}}
    <div style="background:#1f2937; border-radius:10px; padding:25px;">
        <h2 style="margin-bottom:20px;">🕒 Pedidos Recientes</h2>
        @forelse($recentOrders as $order)
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; padding-bottom:15px; border-bottom:1px solid #374151;">
            <div>
                <p style="font-weight:bold;">{{ $order->user->name }}</p>
                <p style="color:#9ca3af; font-size:13px;">{{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <span style="color:#f97316; font-weight:bold;">${{ number_format($order->total, 2) }}</span>
        </div>
        @empty
            <p style="color:#9ca3af;">Sin pedidos aún</p>
        @endforelse
    </div>

</div>
@endsection