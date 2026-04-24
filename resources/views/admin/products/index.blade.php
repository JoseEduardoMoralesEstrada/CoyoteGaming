@extends('layouts.admin')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
    <h1 style="color:#f97316;">Productos</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Nuevo Producto</a>
</div>

<table>
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Plataforma</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>
                <img src="{{ $product->image ? Storage::url($product->image) : asset('images/no-image.jpg') }}"
                    style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->platform }}</td>
            <td style="color:#f97316;">${{ number_format($product->price, 2) }}</td>
            <td>
                <span style="color:{{ $product->stock > 0 ? '#16a34a' : '#dc2626' }}">
                    {{ $product->stock }}
                </span>
            </td>
            <td style="display:flex; gap:8px;">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary" style="padding:6px 12px;">✏️</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar este producto?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="padding:6px 12px;">🗑️</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align:center; color:#9ca3af; padding:40px;">No hay productos</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top:20px;">
    {{ $products->links() }}
</div>
@endsection