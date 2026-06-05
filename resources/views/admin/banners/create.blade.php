@extends('layouts.admin')
@section('title', 'Nuevo Banner')
@section('page_title', 'Subir Nuevo Banner')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-2 text-primary hover:underline font-bold text-body-sm">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Volver a Banners
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-8 max-w-2xl">
    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-8">Nuevo Banner</h1>

    @if($errors->any())
        <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-xl space-y-1">
            @foreach($errors->all() as $e)
                <p class="text-body-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">error</span>{{ $e }}
                </p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">TÍTULO DEL BANNER</label>
            <input name="title" type="text" value="{{ old('title') }}" required
                class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                placeholder="Ej: Campaña de Verano 2026">
        </div>

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">URL DE ENLACE</label>
            <input name="link_url" type="text" value="{{ old('link_url') }}"
                class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                placeholder="/promociones/verano-tecnologia">
            <p class="text-body-sm text-on-surface-variant mt-1">Ruta interna del marketplace (ej: /categorias/tecnologia)</p>
        </div>

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">FECHA DE FIN</label>
            <input name="end_date" type="date" value="{{ old('end_date') }}"
                class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg">
        </div>

        <div>
            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">IMAGEN DEL BANNER</label>
            <label class="border-2 border-dashed border-outline-variant rounded-xl p-8 text-center hover:bg-surface-container-low transition-colors cursor-pointer group block">
                <span class="material-symbols-outlined text-4xl text-outline-variant group-hover:text-primary transition-colors">cloud_upload</span>
                <p class="mt-2 font-body-lg font-bold text-on-surface">Haz clic para subir</p>
                <p class="text-on-surface-variant text-sm">JPG, WebP, PNG — Máx. 5MB — Ideal: 1200×450px</p>
                <input type="file" name="image" accept="image/*" class="hidden">
            </label>
        </div>

        <div class="flex gap-4 pt-4">
            <a href="{{ route('admin.banners.index') }}"
                class="flex-1 py-4 border border-outline text-on-surface font-bold rounded-xl text-center hover:bg-surface-container-high transition-all">
                Cancelar
            </a>
            <button type="submit"
                class="flex-1 py-4 bg-primary text-on-primary font-bold rounded-xl hover:brightness-110 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">save</span> Guardar Banner
            </button>
        </div>
    </form>
</div>
@endsection
