@extends('layouts.admin')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
    <h1 style="color:#f97316;">Categorías</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Nueva Categoría</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Slug</th>
            <th>Productos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td style="color:#9ca3af;">{{ $category->slug }}</td>
            <td>{{ $category->products_count }}</td>
            <td style="display:flex; gap:8px;">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-secondary" style="padding:6px 12px;">✏️</a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar esta categoría?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="padding:6px 12px;">🗑️</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align:center; color:#9ca3af; padding:40px;">No hay categorías</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection