<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalUsers    = User::where('role', 'cliente')->count();
        $totalOrders   = Order::count();
        $totalRevenue  = Order::where('status', 'paid')->sum('total');

        $bestSellers = Product::with('category')
            ->orderBy('sales_count', 'desc')
            ->limit(5)
            ->get();

        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'bestSellers',
            'recentOrders'
        ));
    }
}