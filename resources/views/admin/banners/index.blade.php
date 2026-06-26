@extends('layouts.admin')
@section('title', 'Gestión de Banners')
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

<div class="space-y-6">
    @forelse($banners as $banner)
    @php
        $isEffectivelyActive = $banner->is_active && $banner->zone;
        $zoneLabel = $banner->zone === 'hero' ? 'Hero' : 'Sidebar';
    @endphp
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden hover:shadow-md transition-shadow group
        {{ !$isEffectivelyActive ? 'opacity-70 border-dashed bg-surface-container/30' : '' }}">
        <div class="flex flex-col lg:flex-row items-stretch p-4 gap-6">

            <div class="w-full lg:w-80 h-40 bg-surface-container rounded-lg overflow-hidden flex-shrink-0 border border-outline-variant relative
                {{ !$isEffectivelyActive ? 'grayscale' : '' }}">
                @php
                    $imgSrc = Str::startsWith($banner->image_path ?? '', ['http://', 'https://'])
                        ? $banner->image_path
                        : asset('storage/' . $banner->image_path);
                @endphp
                @if($banner->image_path)
                    <img src="{{ $imgSrc }}" alt="{{ $banner->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-outline-variant">image</span>
                    </div>
                @endif
                <div class="absolute top-2 left-2">
                    @if($banner->is_active && $banner->zone)
                        <span class="bg-tertiary-container text-on-tertiary-container px-2 py-1 rounded text-[10px] font-bold uppercase shadow-sm">Activo</span>
                    @else
                        <span class="bg-surface-container-highest text-on-surface-variant px-2 py-1 rounded text-[10px] font-bold uppercase">Inactivo</span>
                    @endif
                </div>
            </div>

            <div class="flex-1 flex flex-col justify-between py-2">
                <div>
                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                        <h3 class="font-headline-md {{ $banner->is_active ? 'text-on-surface' : 'text-on-surface-variant' }}">
                            {{ $banner->title }}
                        </h3>
                        @if($banner->zone)
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase
                                {{ $banner->zone === 'hero'
                                    ? 'bg-primary/10 text-primary'
                                    : 'bg-secondary/10 text-secondary' }}">
                                {{ $banner->zone === 'hero' ? 'Hero Principal' : 'Lateral Sidebar' }}
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-outline-variant text-on-surface-variant">
                                Sin zona — editar para asignar
                            </span>
                        @endif
                    </div>
                    @if($banner->description)
                        <p class="text-body-sm text-on-surface-variant mb-2 italic">{{ $banner->description }}</p>
                    @endif
                    <div class="flex flex-col gap-2">
                        @if($banner->link_url)
                        <div class="flex items-center text-on-surface-variant text-body-sm gap-2">
                            <span class="material-symbols-outlined text-[18px]">link</span>
                            <span class="font-mono bg-surface-container px-2 py-0.5 rounded truncate max-w-sm">{{ $banner->link_url }}</span>
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
                    <a href="{{ route('admin.banners.edit', $banner) }}"
                        class="px-4 py-2 bg-surface-container-high text-on-surface font-bold rounded-lg hover:bg-outline-variant transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                        Editar
                    </a>

                    @if($isEffectivelyActive)
                        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="title"       value="{{ $banner->title }}">
                            <input type="hidden" name="description" value="{{ $banner->description }}">
                            <input type="hidden" name="link_url"    value="{{ $banner->link_url }}">
                            <input type="hidden" name="zone"        value="{{ $banner->zone }}">
                            <input type="hidden" name="is_active"   value="0">
                            <button type="submit"
                                class="px-4 py-2 text-error font-bold border border-error/20 hover:bg-error/5 rounded-lg transition-colors flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">block</span>
                                Desactivar
                            </button>
                        </form>
                    @elseif($banner->zone)
                        {{-- Inactivo pero con zona: puede reactivarse --}}
                        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="title"       value="{{ $banner->title }}">
                            <input type="hidden" name="description" value="{{ $banner->description }}">
                            <input type="hidden" name="link_url"    value="{{ $banner->link_url }}">
                            <input type="hidden" name="zone"        value="{{ $banner->zone }}">
                            <input type="hidden" name="is_active"   value="1">
                            <button type="submit"
                                class="px-4 py-2 bg-primary/10 text-primary font-bold rounded-lg hover:bg-primary/20 transition-colors flex items-center gap-2"
                                onclick="return confirm('¿Activar este banner? El actual en la zona {{ $zoneLabel }} se desactivará.')">
                                <span class="material-symbols-outlined text-[20px]">play_arrow</span>
                                Activar
                            </button>
                        </form>
                    @else
                        {{-- Sin zona: debe editarse primero --}}
                        <a href="{{ route('admin.banners.edit', $banner) }}"
                            class="px-4 py-2 bg-secondary/10 text-secondary font-bold rounded-lg hover:bg-secondary/20 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">tune</span>
                            Asignar zona
                        </a>
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

<div class="mt-12 p-6 bg-surface-container-low rounded-xl border border-outline-variant mb-8">
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
            <span class="font-bold text-primary">Zonas y límite</span>
            <p class="text-body-sm text-on-surface-variant">Hay 2 zonas: <strong>Hero Principal</strong> (sobre el catálogo) y <strong>Lateral Sidebar</strong>. Solo 1 banner activo por zona — al activar uno nuevo, el anterior se desactiva automáticamente.</p>
        </div>
    </div>
</div>
@endsection
