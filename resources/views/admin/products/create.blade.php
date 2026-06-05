@extends('layouts.admin')
@section('title', 'Nueva Publicación')
@section('page_title', 'Nueva Publicación')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 text-primary hover:underline font-bold text-body-sm">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Volver a Publicaciones
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-8 max-w-2xl">
    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-8">Nueva Publicación</h1>

    @if($errors->any())
        <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-xl space-y-1">
            @foreach($errors->all() as $e)
                <p class="text-body-sm flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">error</span>{{ $e }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">TÍTULO</label>
            <input name="title" type="text" value="{{ old('title') }}" required
                class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                placeholder="Ej: Smartphone Samsung Galaxy S24">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">CATEGORÍA</label>
                <select name="category" required class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg">
                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>Seleccionar</option>
                    <option value="tecnologia"  {{ old('category')=='tecnologia'  ? 'selected':'' }}>Tecnología</option>
                    <option value="hogar"       {{ old('category')=='hogar'       ? 'selected':'' }}>Hogar</option>
                    <option value="moda"        {{ old('category')=='moda'        ? 'selected':'' }}>Moda</option>
                    <option value="vehiculos"   {{ old('category')=='vehiculos'   ? 'selected':'' }}>Vehículos</option>
                </select>
            </div>
            <div>
                <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">UBICACIÓN</label>
                <select name="location" required class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg">
                    <option value="" disabled {{ old('location') ? '' : 'selected' }}>Seleccionar</option>
                    <option value="Lima"        {{ old('location')=='Lima'        ? 'selected':'' }}>Lima</option>
                    <option value="Arequipa"    {{ old('location')=='Arequipa'    ? 'selected':'' }}>Arequipa</option>
                    <option value="Cusco"       {{ old('location')=='Cusco'       ? 'selected':'' }}>Cusco</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">DESCRIPCIÓN</label>
            <textarea name="description" rows="4" required
                class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                placeholder="Describe el producto...">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">PRECIO (S/.)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">S/.</span>
                <input name="price" type="number" min="0" step="0.01" value="{{ old('price') }}" required
                    class="w-full pl-12 p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                    placeholder="0.00">
            </div>
        </div>

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">IMAGEN (opcional)</label>
            <label class="border-2 border-dashed border-outline-variant rounded-xl p-6 text-center hover:bg-surface-container-low transition-colors cursor-pointer group block">
                <span class="material-symbols-outlined text-3xl text-outline-variant group-hover:text-primary">cloud_upload</span>
                <p class="mt-1 font-body-sm font-bold">Haz clic para subir</p>
                <input type="file" name="image" accept="image/*" class="hidden">
            </label>
        </div>

        <div class="flex gap-4 pt-4">
            <a href="{{ route('admin.products.index') }}"
                class="flex-1 py-4 border border-outline text-on-surface font-bold rounded-xl text-center hover:bg-surface-container-high transition-all">Cancelar</a>
            <button type="submit"
                class="flex-1 py-4 bg-primary text-on-primary font-bold rounded-xl hover:brightness-110 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">save</span> Guardar
            </button>
        </div>
    </form>
</div>
@endsection
