<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Vista pública del catálogo
    public function index(Request $request)
    {
        $query = Product::with(['category', 'tags'])->where('stock', '>', 0);

        if ($request->search) {
            $query->search($request->search);
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->platform) {
            $query->where('platform', $request->platform);
        }
        if ($request->sort === 'price_asc') {
            $query->orderBy('price');
        } elseif ($request->sort === 'price_desc') {
            $query->orderByDesc('price');
        } else {
            $query->orderByDesc('created_at');
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // Detalle de un producto
    public function show(Product $product)
    {
        $product->load(['category', 'tags']);
        return view('products.show', compact('product'));
    }

    // --- Métodos solo para Admin ---

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'platform'    => 'required|string',
            'genre'       => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['slug'] = Str::slug($validated['name']) . '-' . time();

        $product = Product::create($validated);

        if ($request->tags) {
            $product->tags()->sync($request->tags);
        }

        ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'product_created',
            'model_type' => 'Product',
            'model_id'   => $product->id,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'platform'    => 'required|string',
            'genre'       => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $oldPrice = $product->price;
        $product->update($validated);

        if ($request->tags) {
            $product->tags()->sync($request->tags);
        }

        // Log si el precio cambió
        if ($oldPrice != $product->price) {
            ActivityLog::create([
                'user_id'    => auth()->id(),
                'action'     => 'product_price_changed',
                'model_type' => 'Product',
                'model_id'   => $product->id,
                'changes'    => json_encode(['old_price' => $oldPrice, 'new_price' => $product->price]),
            ]);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'product_deleted',
            'model_type' => 'Product',
            'model_id'   => $product->id,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado.');
    }
}