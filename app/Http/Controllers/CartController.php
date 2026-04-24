<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart?->load('items.product');
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return back()->with('error', 'Este producto está agotado.');
        }

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);
        }

        return back()->with('success', '¡Producto añadido al carrito!');
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        auth()->user()->cart?->items()->delete();
        return back()->with('success', 'Carrito vaciado.');
    }
}