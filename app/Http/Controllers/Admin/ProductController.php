<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.products.create', compact('categories', 'tags'));
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
            ->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.products.edit', compact('product', 'categories', 'tags'));
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

        $oldPrice = $product->price;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags ?? []);
        }

        // Auditoría si cambió el precio
        if ($oldPrice != $product->price) {
            ActivityLog::create([
                'user_id'    => auth()->id(),
                'action'     => 'price_changed',
                'model_type' => 'Product',
                'model_id'   => $product->id,
                'changes'    => json_encode(['old_price' => $oldPrice, 'new_price' => $product->price]),
            ]);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado.');
    }
}