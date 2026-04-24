<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ─── Rutas públicas ───────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
Route::get('/productos/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// ─── Rutas autenticadas (clientes y admins) ───────────────────
Route::middleware(['auth'])->group(function () {

    // Carrito
    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrito/agregar/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/carrito/eliminar/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/procesar', [CheckoutController::class, 'process'])->name('checkout.process');

    // Pedidos
    Route::get('/pedidos', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pedidos/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// ─── Rutas Admin ──────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Productos (CRUD admin)
    Route::resource('products', ProductController::class)->except(['index', 'show']);

    // Categorías
    Route::resource('categories', CategoryController::class);
});

require __DIR__.'/auth.php';