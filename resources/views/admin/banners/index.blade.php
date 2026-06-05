@extends('layouts.admin')
@section('title', 'Gestionar Publicidad')
@section('page_title', 'Gestión de Publicidad y Banners')

@section('content')
<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-surface">Banners del Catálogo</h1>
        <p class="text-on-surface-variant text-body-lg">Administre los activos visuales y enlaces de la página principal</p>
    </div>
    <a href="{{ route('admin.banners.create') }}"
        class="bg-primary text-on-primary px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:brightness-110 transition-all shadow-sm">
        <span class="material-symbols-outlined">upload_file</span>
        Subir Nuevo Banner
    </a>
</div>

{{-- Lista de banners --}}
<div class="space-y-6">
    @forelse($banners as $banner)
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden hover:shadow-md transition-shadow group {{ !$banner->is_active ? 'opacity-70 border-dashed bg-surface-container/30' : '' }}">
            <div class="flex flex-col lg:flex-row items-stretch p-4 gap-6">
                {{-- Imagen --}}
                <div class="w-full lg:w-80 h-40 bg-surface-container rounded-lg overflow-hidden flex-shrink-0 border border-outline-variant relative {{ !$banner->is_active ? 'grayscale' : '' }}">
                    @if($banner->image_path)
                        <img src="{{ asset('storage/' . $banner->image_path) }}"
                             alt="{{ $banner->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl text-outline-variant">image</span>
                        </div>
                    @endif
                    <div class="absolute top-2 left-2">
                        @if($banner->is_active)
                            <span class="bg-tertiary-container text-on-tertiary-container px-2 py-1 rounded text-[10px] font-bold uppercase shadow-sm">Activo</span>
                        @else
                            <span class="bg-surface-container-highest text-on-surface-variant px-2 py-1 rounded text-[10px] font-bold uppercase">Inactivo</span>
                        @endif
                    </div>
                </div>

                {{-- Info --}}
                <div class="flex-1 flex flex-col justify-between py-2">
                    <div>
                        <h3 class="font-headline-md {{ $banner->is_active ? 'text-on-surface' : 'text-on-surface-variant' }} mb-2">
                            {{ $banner->title }}
                        </h3>
                        <div class="flex flex-col gap-2">
                            @if($banner->link_url)
                            <div class="flex items-center text-on-surface-variant text-body-sm gap-2">
                                <span class="material-symbols-outlined text-[18px]">link</span>
                                <span class="font-mono bg-surface-container px-2 py-0.5 rounded">{{ $banner->link_url }}</span>
                            </div>
                            @endif
                            @if($banner->end_date)
                            <div class="flex items-center text-on-surface-variant text-body-sm gap-2">
                                <span class="material-symbols-outlined text-[18px]">{{ $banner->is_active ? 'calendar_today' : 'history' }}</span>
                                <span>{{ $banner->is_active ? 'Fecha fin' : 'Finalizado el' }}: {{ $banner->end_date->format('d \d\e F, Y') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-4">
                        @if($banner->is_active)
                            {{-- Editar --}}
                            <a href="{{ route('admin.banners.edit', $banner) }}"
                                class="flex-1 lg:flex-none px-4 py-2 bg-surface-container-high text-on-surface font-bold rounded-lg hover:bg-outline-variant transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">edit</span> Editar
                            </a>
                            {{-- Desactivar --}}
                            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="title"     value="{{ $banner->title }}">
                                <input type="hidden" name="link_url"  value="{{ $banner->link_url }}">
                                <input type="hidden" name="is_active" value="0">
                                <button type="submit"
                                    class="flex-1 lg:flex-none px-4 py-2 text-error font-bold border border-error/20 hover:bg-error/5 rounded-lg transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[20px]">block</span> Desactivar
                                </button>
                            </form>
                        @else
                            {{-- Reactivar --}}
                            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="title"     value="{{ $banner->title }}">
                                <input type="hidden" name="link_url"  value="{{ $banner->link_url }}">
                                <input type="hidden" name="is_active" value="1">
                                <button type="submit"
                                    class="px-4 py-2 bg-primary/10 text-primary font-bold rounded-lg hover:bg-primary/20 transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[20px]">play_arrow</span> Reactivar
                                </button>
                            </form>
                            {{-- Eliminar definitivamente --}}
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar definitivamente este banner?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-full transition-colors" title="Eliminar definitivamente">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-16 text-on-surface-variant">
            <span class="material-symbols-outlined text-6xl">image_not_supported</span>
            <p class="mt-4 font-body-lg">No hay banners registrados.</p>
            <a href="{{ route('admin.banners.create') }}" class="mt-4 inline-block text-primary font-bold hover:underline">
                Crear el primer banner →
            </a>
        </div>
    @endforelse

    {{-- Botón añadir slot (decorativo) --}}
    <a href="{{ route('admin.banners.create') }}"
        class="w-full border-2 border-dashed border-outline-variant rounded-xl p-10 flex flex-col items-center justify-center gap-4 text-on-surface-variant hover:bg-surface-container-high hover:border-primary/50 transition-all group">
        <div class="w-16 h-16 rounded-full bg-surface-container-highest flex items-center justify-center group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-4xl text-primary">add_photo_alternate</span>
        </div>
        <div class="text-center">
            <span class="block font-bold text-lg text-on-surface">Añadir Slot de Publicidad</span>
            <span class="text-body-sm opacity-60">Resolución ideal: 1200 × 450 px</span>
        </div>
    </a>
</div>

{{-- Lineamientos --}}
<div class="mt-12 p-6 bg-surface-container-low rounded-xl border border-outline-variant">
    <h4 class="font-headline-md text-on-surface flex items-center gap-2 mb-4">
        <span class="material-symbols-outlined text-secondary">verified_user</span>
        Lineamientos de Publicidad
    </h4>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="flex flex-col gap-2">
            <span class="font-bold text-primary">Formato</span>
            <p class="text-body-sm text-on-surface-variant">Use imágenes JPG o WebP de alta calidad. Evite texto pequeño incrustado en el banner.</p>
        </div>
        <div class="flex flex-col gap-2">
            <span class="font-bold text-primary">Links</span>
            <p class="text-body-sm text-on-surface-variant">Todos los enlaces deben apuntar a secciones internas del Marketplace para mantener al usuario.</p>
        </div>
        <div class="flex flex-col gap-2">
            <span class="font-bold text-primary">Cantidad</span>
            <p class="text-body-sm text-on-surface-variant">Recomendamos no tener más de 5 banners rotando para asegurar una carga rápida.</p>
        </div>
    </div>
</div>
@endsection
