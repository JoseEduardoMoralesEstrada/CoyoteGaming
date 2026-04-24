@extends('layouts.admin')

@section('content')
<h1 style="color:#f97316; margin-bottom:30px;">Nueva Categoría</h1>

<div style="background:#1f2937; border-radius:10px; padding:30px; max-width:500px;">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')<p style="color:#dc2626; font-size:13px; margin-top:5px;">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div style="display:flex; gap:15px; margin-top:10px;">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection