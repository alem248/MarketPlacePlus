@extends('layouts.admin')
@section('title', 'Editar Publicación')
@section('page_title', 'Editar Publicación')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 text-primary hover:underline font-bold text-body-sm">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Volver a Publicaciones
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-8 max-w-2xl">
    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-2">Editar Publicación</h1>
    <p class="text-on-surface-variant text-body-sm mb-8">Vendedor: <span class="font-bold">{{ $product->user->full_name ?? '—' }}</span></p>

    @if($errors->any())
        <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-xl space-y-1">
            @foreach($errors->all() as $e)
                <p class="text-body-sm flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">error</span>{{ $e }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">TÍTULO</label>
            <input name="title" type="text" value="{{ old('title', $product->title) }}" required
                class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">CATEGORÍA</label>
                <select name="category" required class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg">
                    @foreach(['tecnologia'=>'Tecnología','hogar'=>'Hogar','moda'=>'Moda','vehiculos'=>'Vehículos'] as $val => $label)
                        <option value="{{ $val }}" {{ old('category', $product->category)==$val ? 'selected':'' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">UBICACIÓN</label>
                <select name="location" required class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg">
                    @foreach(['Lima','Arequipa','Cusco'] as $loc)
                        <option value="{{ $loc }}" {{ old('location', $product->location)==$loc ? 'selected':'' }}>{{ $loc }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">DESCRIPCIÓN</label>
            <textarea name="description" rows="4" required
                class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">PRECIO (S/.)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">S/.</span>
                <input name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price) }}" required
                    class="w-full pl-12 p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg">
            </div>
        </div>

        <div class="flex items-center gap-3 p-4 bg-surface-container rounded-xl">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" id="is_active" name="is_active" value="1"
                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                   class="w-5 h-5 accent-primary cursor-pointer">
            <label for="is_active" class="font-body-lg cursor-pointer">Publicación activa (visible en la tienda)</label>
        </div>

        @if($product->image_path)
        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">IMAGEN ACTUAL</label>
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->title }}"
                 class="w-full max-h-48 object-cover rounded-xl border border-outline-variant">
        </div>
        @endif

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">
                {{ $product->image_path ? 'REEMPLAZAR IMAGEN (opcional)' : 'IMAGEN' }}
            </label>
            <label class="border-2 border-dashed border-outline-variant rounded-xl p-6 text-center hover:bg-surface-container-low transition-colors cursor-pointer group block">
                <span class="material-symbols-outlined text-3xl text-outline-variant group-hover:text-primary">cloud_upload</span>
                <p class="mt-1 font-body-sm font-bold">Haz clic para cambiar</p>
                <input type="file" name="image" accept="image/*" class="hidden">
            </label>
        </div>

        <div class="flex gap-4 pt-4">
            <a href="{{ route('admin.products.index') }}"
                class="flex-1 py-4 border border-outline text-on-surface font-bold rounded-xl text-center hover:bg-surface-container-high transition-all">Cancelar</a>
            <button type="submit"
                class="flex-1 py-4 bg-primary text-on-primary font-bold rounded-xl hover:brightness-110 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">save</span> Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
