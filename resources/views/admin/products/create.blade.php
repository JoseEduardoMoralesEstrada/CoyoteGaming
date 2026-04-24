@extends('layouts.admin')

@section('content')
<h1 style="color:#f97316; margin-bottom:30px;">Nuevo Producto</h1>

<div style="background:#1f2937; border-radius:10px; padding:30px; max-width:700px;">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')<p style="color:#dc2626; font-size:13px; margin-top:5px;">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>Categoría *</label>
            <select name="category_id" required>
                <option value="">Seleccionar categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')<p style="color:#dc2626; font-size:13px; margin-top:5px;">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
            <div class="form-group">
                <label>Precio *</label>
                <input type="number" name="price" step="0.01" value="{{ old('price') }}" required>
                @error('price')<p style="color:#dc2626; font-size:13px; margin-top:5px;">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>Stock *</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" required>
                @error('stock')<p style="color:#dc2626; font-size:13px; margin-top:5px;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
            <div class="form-group">
                <label>Plataforma *</label>
                <select name="platform" required>
                    <option value="">Seleccionar plataforma</option>
                    <option value="PC" {{ old('platform') == 'PC' ? 'selected' : '' }}>PC</option>
                    <option value="PS5" {{ old('platform') == 'PS5' ? 'selected' : '' }}>PS5</option>
                    <option value="Xbox Series X" {{ old('platform') == 'Xbox Series X' ? 'selected' : '' }}>Xbox Series X</option>
                    <option value="Nintendo Switch" {{ old('platform') == 'Nintendo Switch' ? 'selected' : '' }}>Nintendo Switch</option>
                </select>
            </div>
            <div class="form-group">
                <label>Género</label>
                <input type="text" name="genre" value="{{ old('genre') }}" placeholder="Ej: Acción, RPG...">
            </div>
        </div>

        <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div style="display:flex; gap:15px; margin-top:10px;">
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection