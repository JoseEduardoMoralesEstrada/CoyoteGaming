@extends('layouts.app')

@section('title', 'Mi Carrito')

@section('content')
<div class="container" style="padding:40px 20px;">
    <h1 style="color:#f97316; margin-bottom:30px;">Mi Carrito</h1>

    @if(!$cart || $cart->items->isEmpty())
        <div style="text-align:center; padding:60px;">
            <p style="color:#9ca3af; font-size:20px; margin-bottom:30px;">Tu carrito está vacío</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Ver productos</a>
        </div>
    @else
        <div style="display:grid; grid-template-columns:2fr 1fr; gap:30px;">

            {{-- Lista de productos --}}
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->items as $item)
                        <tr>
                            <td style="display:flex; align-items:center; gap:15px;">
                                <img src="{{ $item->product->image ? Storage::url($item->product->image) : asset('images/no-image.jpg') }}"
                                    style="width:60px; height:60px; object-fit:cover; border-radius:6px;">
                                <div>
                                    <p style="font-weight:bold;">{{ $item->product->name }}</p>
                                    <p style="color:#9ca3af; font-size:13px;">{{ $item->product->platform }}</p>
                                </div>
                            </td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td style="color:#f97316; font-weight:bold;">
                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:6px 12px;">✕</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top:15px;">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">Vaciar carrito</button>
                    </form>
                </div>
            </div>

            {{-- Resumen --}}
            <div style="background:#1f2937; border-radius:10px; padding:25px; height:fit-content;">
                <h2 style="margin-bottom:20px;">Resumen</h2>
                <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span style="color:#9ca3af;">Subtotal</span>
                    <span>${{ number_format($cart->subtotal(), 2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span style="color:#9ca3af;">IVA (16%)</span>
                    <span>${{ number_format($cart->tax(), 2) }}</span>
                </div>
                <hr style="border-color:#374151; margin:15px 0;">
                <div style="display:flex; justify-content:space-between; margin-bottom:25px;">
                    <span style="font-size:18px; font-weight:bold;">Total</span>
                    <span style="font-size:18px; font-weight:bold; color:#f97316;">
                        ${{ number_format($cart->total(), 2) }}
                    </span>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary" style="width:100%; text-align:center; font-size:16px; padding:15px;">
                    Proceder al pago
                </a>
            </div>

        </div>
    @endif
</div>
@endsection