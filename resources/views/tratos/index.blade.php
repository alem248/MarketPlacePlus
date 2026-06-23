@extends('layouts.app')

@section('title', 'Mis Tratos - MarketPlace Plus')

@section('content')
<div class="bg-background text-on-surface font-body-lg overflow-x-hidden">

    {{-- ===================== TOP NAV ===================== --}}
    @include('partials.client-navbar')

    {{-- ===================== LAYOUT PRINCIPAL ===================== --}}
    <div class="flex max-w-container-max mx-auto min-h-[calc(100vh-64px)]">

        {{-- ===================== SIDEBAR ===================== --}}
        @include('partials.client-sidebar', ['activeClientTab' => 'tratos'])

        {{-- ===================== CONTENIDO PRINCIPAL ===================== --}}
        <main class="flex-1 p-gutter bg-surface-bright">

            {{-- ===== ENCABEZADO: perfil + barra de estados de compra ===== --}}
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-8 mb-8 shadow-sm flex flex-col md:flex-row items-center justify-between gap-8">

                {{-- Foto y título --}}
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <div class="w-24 h-24 rounded-xl border-4 border-secondary-container p-1 shadow-md overflow-hidden bg-primary flex items-center justify-center text-on-primary text-4xl font-bold">
                            {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                        </div>
                        <div class="absolute bottom-1 right-1 w-6 h-6 bg-tertiary-container border-2 border-white rounded-full"></div>
                    </div>
                    <div>
                        <h1 class="text-headline-lg font-headline-lg text-primary tracking-tight uppercase">MIS TRATOS</h1>
                        <p class="text-headline-md font-headline-md text-on-surface-variant">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </p>
                    </div>
                </div>

                {{-- Barra de progreso de estados (decorativa — muestra el flujo completo) --}}
                {{-- Guía visual del flujo de compra (informativo, no indica estado actual) --}}
                <div class="flex-1 max-w-lg w-full">
                    <p class="text-center text-label-caps font-label-caps text-on-surface-variant mb-6 tracking-widest">
                        -- FLUJO DE COMPRA --
                    </p>
                    <div class="relative flex items-center justify-between px-4">
                        <div class="absolute h-0.5 w-[calc(100%-32px)] bg-secondary-container/40 top-1/2 -translate-y-1/2 z-0 left-4"></div>

                        @foreach([['assignment','Pedido'],['forum','Discusión'],['verified','Aprobado'],['inventory_2','Recibido']] as $step)
                        <div class="relative z-10 flex flex-col items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-secondary-container/30 text-secondary flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">{{ $step[0] }}</span>
                            </div>
                            <span class="text-[10px] font-bold text-center uppercase whitespace-nowrap text-on-surface-variant">{{ $step[1] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ===== LISTADO DE TRATOS ===== --}}
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">

                {{-- Cabecera de la tabla --}}
                <div class="p-6 border-b border-outline-variant flex items-center justify-between">
                    <h2 class="text-headline-md font-headline-md">Listado de Tratos</h2>
                </div>

                {{-- Tabla de tratos --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-low text-on-surface-variant text-label-caps font-label-caps uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">PRODUCTOS</th>
                                <th class="px-6 py-4">PRECIO</th>
                                <th class="px-6 py-4">ESTADO</th>
                                <th class="px-6 py-4 text-center">ACCIONAR</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">

                            {{-- Loop de tratos reales desde la BD --}}
                            @forelse($tratos as $trato)
                            @php
                                // Primera imagen del producto para el thumbnail
                                $imgs   = $trato->product->image_path ?? [];
                                $thumb  = $imgs[0] ?? null;
                                $imgSrc = $thumb
                                    ? (Str::startsWith($thumb, 'http') ? $thumb : Storage::url($thumb))
                                    : null;

                                // Colores del badge según el estado del trato
                                $badgeClass = match($trato->status) {
                                    'aprobado'         => 'bg-tertiary-container/10 text-tertiary-container',
                                    'en_discusion'     => 'bg-primary/10 text-primary',
                                    'recibido'         => 'bg-secondary/10 text-secondary',
                                    'pedido_realizado' => 'bg-outline/10 text-outline',
                                    default            => 'bg-error/10 text-error',
                                };

                                // Ícono del botón DETALLES según el estado
                                $detallesIcon = $trato->status === 'recibido' ? 'info' : 'open_in_new';
                            @endphp
                            <tr class="hover:bg-surface-container-low/50 transition-colors duration-200">

                                {{-- Columna Producto --}}
                                <td class="px-6 py-6 max-w-md">
                                    <div class="flex gap-4">
                                        {{-- Thumbnail del producto --}}
                                        @if($imgSrc)
                                            <img src="{{ $imgSrc }}" alt="{{ $trato->product->title }}"
                                                 class="w-20 h-20 rounded-lg object-cover bg-surface-dim shrink-0">
                                        @else
                                            <div class="w-20 h-20 rounded-lg bg-surface-container-high shrink-0 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-outline text-3xl">image</span>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="text-body-sm font-semibold mb-1">
                                                {{ $trato->product->title }}
                                            </p>
                                            <span class="text-[11px] text-on-surface-variant font-medium">
                                                {{ Str::limit($trato->product->description, 60) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Columna Precio --}}
                                <td class="px-6 py-6 font-price-display text-price-display text-primary whitespace-nowrap">
                                    S/{{ number_format($trato->price, 2) }}
                                </td>

                                {{-- Columna Estado --}}
                                <td class="px-6 py-6">
                                    <span class="px-3 py-1 rounded-full text-label-caps font-bold {{ $badgeClass }}">
                                        {{ $trato->status_label }}
                                    </span>
                                </td>

                                {{-- Columna Acciones --}}
                                <td class="px-6 py-6">
                                    <div class="flex items-center justify-center gap-3">
                                        {{-- Botón de detalles: lleva a la vista de seguimiento del trato --}}
                                        <a href="{{ route('tratos.show', $trato) }}"
                                           class="bg-secondary-container text-on-secondary-container px-6 py-2 rounded-lg text-label-caps font-bold flex items-center gap-2 hover:brightness-95 transition-all">
                                            DETALLES
                                            <span class="material-symbols-outlined text-[16px]">{{ $detallesIcon }}</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            {{-- Estado vacío: sin tratos todavía --}}
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center text-on-surface-variant">
                                    <span class="material-symbols-outlined text-5xl block mb-4 text-outline">handshake</span>
                                    <p class="font-bold text-body-lg mb-2">Aún no tienes tratos</p>
                                    <p class="text-body-sm">Explora el catálogo y haz click en "Trato Directo" para iniciar uno.</p>
                                    <a href="{{ route('home') }}"
                                       class="inline-block mt-6 px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:opacity-90 transition-all">
                                        Ver catálogo
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pie de tabla con contador y paginación --}}
                <div class="p-6 border-t border-outline-variant flex items-center justify-between">
                    <p class="text-body-sm text-on-surface-variant">
                        Mostrando <span class="font-bold">{{ $tratos->count() }} de {{ $tratos->total() }}</span> tratos activos
                    </p>
                    <div class="flex gap-2">
                        {{-- Paginación de Laravel con estilo personalizado --}}
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
            </div>
        </main>
    </div>

    @include('partials.footer')

</div>
@endsection
