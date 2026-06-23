@extends('layouts.app')

@section('title', 'Mis Tratos Directos - MarketPlace Plus')

@section('content')
@php
    // Conteos por estado para los filter chips (independiente del filtro activo)
    $cEnDiscusion = $counts['en_discusion']     ?? 0;
    $cAprobado    = $counts['aprobado']          ?? 0;
    $cRecibido    = $counts['recibido']          ?? 0;
    $totalTratos  = $counts->sum(); // total real, no el de la página actual

    $activeStatus = request('status'); // null = sin filtro
@endphp

<div class="bg-background text-on-surface font-body-lg">

    @include('partials.seller-navbar')

    <div class="flex pt-16 min-h-screen">

        @include('partials.seller-sidebar', ['activeSellerTab' => 'tratos'])

        {{-- ===================== CONTENIDO PRINCIPAL ===================== --}}
        <main class="flex-1 p-gutter bg-surface">
            <div class="max-w-5xl mx-auto">

                {{-- Encabezado de sección --}}
                <header class="mb-8">
                    <h1 class="text-headline-lg font-headline-lg text-on-surface">Mis Tratos Directos</h1>
                    <p class="text-body-lg text-on-surface-variant mt-1">
                        Gestiona tus negociaciones activas y cierra acuerdos exitosos.
                    </p>
                </header>

                {{-- ===== FILTER CHIPS (URL-based: ?status=...) ===== --}}
                @php
                    $chipBase = 'px-5 py-2 rounded-full font-label-caps text-label-caps whitespace-nowrap transition-colors';
                    $chipOn   = 'bg-primary text-on-primary';
                    $chipOff  = 'bg-surface-container-highest text-on-surface-variant hover:bg-outline-variant';
                @endphp
                <div class="flex gap-3 mb-8 overflow-x-auto pb-2">
                    <a href="{{ route('seller.tratos.index') }}"
                       class="{{ $chipBase }} {{ !$activeStatus ? $chipOn : $chipOff }}">
                        Todos ({{ $totalTratos }})
                    </a>
                    <a href="{{ route('seller.tratos.index', ['status' => 'en_discusion']) }}"
                       class="{{ $chipBase }} {{ $activeStatus === 'en_discusion' ? $chipOn : $chipOff }}">
                        En discusión ({{ $cEnDiscusion }})
                    </a>
                    <a href="{{ route('seller.tratos.index', ['status' => 'aprobado']) }}"
                       class="{{ $chipBase }} {{ $activeStatus === 'aprobado' ? $chipOn : $chipOff }}">
                        Aprobados ({{ $cAprobado }})
                    </a>
                    <a href="{{ route('seller.tratos.index', ['status' => 'recibido']) }}"
                       class="{{ $chipBase }} {{ $activeStatus === 'recibido' ? $chipOn : $chipOff }}">
                        Recibidos ({{ $cRecibido }})
                    </a>
                </div>

                {{-- ===== LISTADO DE TRATOS (tarjetas) ===== --}}
                <div class="grid grid-cols-1 gap-4">

                    @forelse($tratos as $trato)
                    @php
                        // Primera imagen del producto
                        $imgs    = $trato->product->image_path ?? [];
                        $imgSrc  = isset($imgs[0])
                            ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0]))
                            : null;

                        // Colores del badge según el estado
                        [$badgeBg, $badgeText] = match($trato->status) {
                            'en_discusion'     => ['bg-primary/10',           'text-primary'],
                            'aprobado'         => ['bg-tertiary-container/10','text-tertiary-container'],
                            'recibido'         => ['bg-secondary/10',         'text-secondary'],
                            'pedido_realizado' => ['bg-outline/10',           'text-outline'],
                            default            => ['bg-error/10',             'text-error'],
                        };
                    @endphp

                    {{-- Tarjeta individual del trato --}}
                    <div class="deal-card flex flex-col md:flex-row items-center gap-6 p-5 bg-surface-container-lowest border border-outline-variant rounded-xl transition-all duration-300 group hover:shadow-md hover:-translate-y-0.5">

                        {{-- Imagen del producto --}}
                        <div class="w-full md:w-24 h-24 rounded-lg overflow-hidden bg-surface-container shrink-0">
                            @if($imgSrc)
                                <img src="{{ $imgSrc }}"
                                     alt="{{ $trato->product->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-outline text-3xl">image</span>
                                </div>
                            @endif
                        </div>

                        {{-- Nombre del producto y comprador --}}
                        <div class="flex-grow space-y-1 w-full text-center md:text-left">
                            <h3 class="text-body-lg font-bold text-on-surface">
                                {{ $trato->product->title }}
                            </h3>
                            <div class="flex items-center justify-center md:justify-start gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[16px]">person</span>
                                <span class="text-body-sm">
                                    Comprador: {{ $trato->buyer->first_name }} {{ $trato->buyer->last_name }}
                                </span>
                            </div>
                        </div>

                        {{-- Precio + badge de estado --}}
                        <div class="flex flex-col items-center md:items-end w-full md:w-48">
                            <span class="text-body-lg font-bold text-secondary">
                                S/. {{ number_format($trato->price, 2) }}
                            </span>
                            <span class="px-3 py-1 rounded-full {{ $badgeBg }} {{ $badgeText }} font-label-caps text-[10px] mt-1 uppercase tracking-wider">
                                {{ $trato->status_label }}
                            </span>
                        </div>

                        {{-- Acciones: Ver Detalles + Chat --}}
                        <div class="flex gap-2 w-full md:w-auto shrink-0">
                            {{-- Enlaza al detalle del trato del vendedor --}}
                            <a href="{{ route('seller.tratos.show', $trato) }}"
                               class="flex-grow md:flex-none px-6 py-2.5 bg-secondary-container text-on-primary font-bold rounded-lg hover:brightness-110 active:scale-95 transition-all shadow-sm text-center text-label-caps">
                                Ver Detalles
                            </a>
                            {{-- Acceso directo al chat dentro del detalle del trato --}}
                            <a href="{{ route('seller.tratos.show', $trato) }}"
                               class="p-2.5 border border-outline-variant text-on-surface-variant rounded-lg hover:bg-surface-container-high transition-colors active:scale-95"
                               title="Ir al chat de este trato">
                                <span class="material-symbols-outlined">chat</span>
                            </a>
                        </div>
                    </div>

                    @empty
                    {{-- Estado vacío: sin tratos como vendedor --}}
                    <div class="p-16 text-center bg-surface-container-lowest border border-outline-variant rounded-xl">
                        <span class="material-symbols-outlined text-5xl block mb-4 text-outline">handshake</span>
                        <p class="font-bold text-body-lg mb-2">Aún no tienes tratos como vendedor</p>
                        <p class="text-body-sm text-on-surface-variant">
                            Cuando alguien inicie un trato con alguno de tus productos, aparecerá aquí.
                        </p>
                        <a href="{{ route('seller.products.create') }}"
                           class="inline-block mt-6 px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:opacity-90 transition-all">
                            Crear Publicación
                        </a>
                    </div>
                    @endforelse
                </div>

                {{-- ===== PAGINACIÓN ===== --}}
                @if($tratos->hasPages())
                <div class="mt-8 flex items-center justify-between">
                    <p class="text-body-sm text-on-surface-variant">
                        Mostrando <span class="font-bold">{{ $tratos->count() }} de {{ $tratos->total() }}</span> tratos
                    </p>
                    <div class="flex gap-2">
                        <a href="{{ $tratos->previousPageUrl() ?? '#' }}"
                           class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors {{ $tratos->onFirstPage() ? 'opacity-40 pointer-events-none' : '' }}">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </a>

                        @for($i = 1; $i <= $tratos->lastPage(); $i++)
                            <a href="{{ $tratos->url($i) }}"
                               class="w-10 h-10 flex items-center justify-center rounded-lg font-bold transition-colors
                                      {{ $tratos->currentPage() === $i ? 'bg-primary text-on-primary' : 'border border-outline-variant hover:bg-surface-container-low' }}">
                                {{ $i }}
                            </a>
                        @endfor

                        <a href="{{ $tratos->nextPageUrl() ?? '#' }}"
                           class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors {{ !$tratos->hasMorePages() ? 'opacity-40 pointer-events-none' : '' }}">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </a>
                    </div>
                </div>
                @endif

            </div>
        </main>
    </div>

    @include('partials.footer')

</div>
@endsection
