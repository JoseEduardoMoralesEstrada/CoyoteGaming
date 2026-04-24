<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart?->load('items.product');

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function process()
    {
        $cart = auth()->user()->cart?->load('items.product');

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        // Crear la orden
        $order = Order::create([
            'user_id'  => auth()->id(),
            'subtotal' => $cart->subtotal(),
            'tax'      => $cart->tax(),
            'total'    => $cart->total(),
            'status'   => 'paid',
        ]);

        // Crear los items de la orden y actualizar stock
        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'unit_price' => $item->product->price,
            ]);

            $item->product->decrement('stock', $item->quantity);
            $item->product->increment('sales_count', $item->quantity);
        }

        // Vaciar el carrito
        $cart->items()->delete();

        return redirect()->route('orders.show', $order)
            ->with('success', '¡Compra realizada con éxito! Gracias por comprar en CoyoteGaming.');
    }
}