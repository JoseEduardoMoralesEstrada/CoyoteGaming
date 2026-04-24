@extends('layouts.app')

@section('title', 'Mis Pedidos')

@section('content')
<div class="container" style="padding:40px 20px;">
    <h1 style="color:#f97316; margin-bottom:30px;">Mis Pedidos</h1>

    @if($orders->isEmpty())
        <div style="text-align:center; padding:60px;">
            <p style="color:#9ca3af; font-size:20px; margin-bottom:30px;">Aún no tienes pedidos</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Ver productos</a>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>#Pedido</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td style="color:#f97316; font-weight:bold;">${{ number_format($order->total, 2) }}</td>
                    <td>
                        <span style="background:{{ $order->status === 'paid' ? '#16a34a' : '#374151' }}; padding:4px 12px; border-radius:20px; font-size:13px;">
                            {{ $order->status === 'paid' ? 'Pagado' : ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary" style="padding:6px 14px;">
                            Ver detalle
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:30px;">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection