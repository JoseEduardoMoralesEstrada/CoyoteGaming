@extends('layouts.admin')

@section('content')
<h1 style="color:#f97316; margin-bottom:30px;">Editar Producto</h1>

<div style="background:#1f2937; border-radius:10px; padding:30px; max-width:700px;">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label>Categoría *</label>
            <select name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="description" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
            <div class="form-group">
                <label>Precio *</label>
                <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="form-group">
                <label>Stock *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
            <div class="form-group">
                <label>Plataforma *</label>
                <select name="platform" required>
                    <option value="PC" {{ old('platform', $product->platform) == 'PC' ? 'selected' : '' }}>PC</option>
                    <option value="PS5" {{ old('platform', $product->platform) == 'PS5' ? 'selected' : '' }}>PS5</option>
                    <option value="Xbox Series X" {{ old('platform', $product->platform) == 'Xbox Series X' ? 'selected' : '' }}>Xbox Series X</option>
                    <option value="Nintendo Switch" {{ old('platform', $product->platform) == 'Nintendo Switch' ? 'selected' : '' }}>Nintendo Switch</option>
                </select>
            </div>
            <div class="form-group">
                <label>Género</label>
                <input type="text" name="genre" value="{{ old('genre', $product->genre) }}">
            </div>
        </div>

        <div class="form-group">
            <label>Imagen actual</label><br>
            @if($product->image)
                <img src="{{ Storage::url($product->image) }}" style="width:100px; border-radius:6px; margin:10px 0;">
            @else
                <p style="color:#9ca3af; font-size:13px;">Sin imagen</p>
            @endif
            <label style="margin-top:10px;">Cambiar imagen</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div style="display:flex; gap:15px; margin-top:10px;">
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection