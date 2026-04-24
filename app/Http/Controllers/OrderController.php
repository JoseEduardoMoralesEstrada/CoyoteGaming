<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Solo el dueño de la orden o un admin puede verla
        if ($order->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $order->load('items.product');
        return view('orders.show', compact('order'));
    }
}