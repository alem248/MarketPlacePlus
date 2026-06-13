@extends('layouts.app')

@section('title', 'Mis Tratos Directos - MarketPlace Plus')

@section('content')
@php
    // Total de tratos del vendedor (todos los estados)
    $totalTratos = $tratos->total();

    // Conteos por estado para los filter chips
    $cEnDiscusion = $counts['en_discusion']     ?? 0;
    $cAprobado    = $counts['aprobado']          ?? 0;
    $cRecibido    = $counts['recibido']          ?? 0;
    $cCancelado   = $counts['cancelado']         ?? 0;
@endphp

<div class="bg-background text-on-surface font-body-lg">

    {{-- ===================== TOP NAV (estilo vendedor) ===================== --}}
    <header class="bg-surface-container-lowest border-b border-outline-variant sticky top-0 z-50 w-full">
        <div class="flex items-center justify-between px-gutter h-16 max-w-container-max mx-auto">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               class="font-headline-md text-headline-md font-black text-primary tracking-tight">
                MarketPlace Plus
            </a>

            {{-- Acciones de la derecha (estilo vendedor: notificación + config + perfil) --}}
            <div class="flex items-center gap-4">
                {{-- Notificaciones y ajustes --}}
                <div class="flex items-center gap-1">
                    <button class="p-2 rounded-full hover:bg-surface-container-low transition-colors text-primary">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <button class="p-2 rounded-full hover:bg-surface-container-low transition-colors text-primary">
                        <span class="material-symbols-outlined">settings</span>
                    </button>
                </div>

                {{-- Divisor + nombre + avatar --}}
                <div class="flex items-center gap-3 pl-4 border-l border-outline-variant">
                    <div class="text-right hidden md:block">
                        <p class="text-label-caps font-bold text-on-surface">Vendedor</p>
                        <p class="text-body-sm text-on-surface-variant">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </p>
                    </div>
                    {{-- Avatar con inicial --}}
                    <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary font-bold border border-outline-variant">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex max-w-container-max mx-auto min-h-[calc(100vh-64px)]">

        {{-- ===================== SIDEBAR VENDEDOR ===================== --}}
        <aside class="hidden lg:flex flex-col w-[280px] shrink-0 bg-surface-container-lowest border-r border-outline-variant sticky top-[64px] h-[calc(100vh-64px)] overflow-y-auto">

            {{-- Perfil del vendedor --}}
            <div class="px-6 py-8 flex flex-col items-start gap-3">
                <div class="flex items-center gap-3">
                    {{-- Avatar grande con inicial --}}
                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center text-on-primary text-xl font-bold border border-outline-variant">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-body-lg font-bold text-primary leading-tight">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </h3>
                        {{-- Indicador online --}}
                        <p class="text-xs text-tertiary flex items-center gap-1 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-tertiary inline-block"></span>
                            Vendedor — Online
                        </p>
                    </div>
                </div>

                {{-- Cambiar a cliente: va a la vista de tratos del comprador --}}
                <a href="{{ route('tratos.index') }}"
                   class="w-full mt-2 py-2 px-4 rounded-xl border-2 border-secondary text-secondary font-bold text-label-caps hover:bg-secondary-fixed/20 transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">swap_horiz</span>
                    Cambiar a Cliente
                </a>
            </div>

            {{-- Menú de navegación --}}
            <nav class="flex-1 px-2 space-y-1">
                <a href="{{ route('seller.panel') }}"
                   class="flex items-center gap-3 mx-2 my-1 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-body-lg">Panel</span>
                </a>

                <a href="{{ route('seller.products.create') }}"
                   class="flex items-center gap-3 mx-2 my-1 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all">
                    <span class="material-symbols-outlined">add_box</span>
                    <span class="text-body-lg">Crear Publicación</span>
                </a>

                {{-- Mis Tratos activo --}}
                <a href="{{ route('seller.tratos.index') }}"
                   class="flex items-center gap-3 mx-2 my-1 px-4 py-3 bg-primary text-on-primary font-bold rounded-xl shadow-md">
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">handshake</span>
                    <span class="text-body-lg">Mis Tratos</span>
                </a>

                <a href="{{ route('proximamente') }}"
                   class="flex items-center gap-3 mx-2 my-1 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="text-body-lg">Delivery</span>
                </a>

                <a href="{{ route('proximamente') }}"
                   class="flex items-center gap-3 mx-2 my-1 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span class="text-body-lg">Mis Comprobantes</span>
                </a>
            </nav>

            {{-- Cerrar sesión al fondo --}}
            <div class="border-t border-outline-variant p-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 text-error font-semibold hover:bg-error-container/10 transition-all rounded-xl">
                        <span class="material-symbols-outlined">logout</span>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

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

                {{-- ===== FILTER CHIPS ===== --}}
                <div class="flex gap-3 mb-8 overflow-x-auto pb-2">
                    {{-- "Todos" siempre activo por ahora (el filtrado real se implementa después) --}}
                    <button class="px-5 py-2 rounded-full bg-primary text-on-primary font-label-caps text-label-caps whitespace-nowrap">
                        Todos ({{ $totalTratos }})
                    </button>
                    <button class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-label-caps text-label-caps hover:bg-outline-variant transition-colors whitespace-nowrap">
                        En discusión ({{ $cEnDiscusion }})
                    </button>
                    <button class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-label-caps text-label-caps hover:bg-outline-variant transition-colors whitespace-nowrap">
                        Aprobados ({{ $cAprobado }})
                    </button>
                    <button class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-label-caps text-label-caps hover:bg-outline-variant transition-colors whitespace-nowrap">
                        Recibidos ({{ $cRecibido }})
                    </button>
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
                            {{-- Botón de chat (visual por ahora) --}}
                            <button class="p-2.5 border border-outline-variant text-on-surface-variant rounded-lg hover:bg-surface-container-high transition-colors active:scale-95">
                                <span class="material-symbols-outlined">chat</span>
                            </button>
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

    {{-- ===================== FOOTER (mismo que el resto del proyecto) ===================== --}}
    <footer class="w-full mt-gutter bg-inverse-surface">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-mobile md:px-gutter py-12 max-w-container-max mx-auto">
            <div class="md:col-span-1">
                <span class="text-headline-md font-headline-md font-bold text-on-primary">MarketPlace Plus</span>
                <p class="text-body-sm text-surface-variant mt-4">La plataforma líder para conectar compradores y vendedores de forma directa y segura.</p>
            </div>
            <div>
                <h4 class="text-label-caps font-label-caps text-on-primary mb-6">Enlaces Rápidos</h4>
                <ul class="flex flex-col gap-3">
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="{{ route('home') }}">Comprar producto</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="{{ route('tratos.index') }}">Mis tratos</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Rastrear pedido</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-label-caps font-label-caps text-on-primary mb-6">Soporte</h4>
                <ul class="flex flex-col gap-3">
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="#">Ayuda al cliente</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="#">Sobre nosotros</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="#">Términos y condiciones</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-label-caps font-label-caps mb-6 uppercase tracking-wider text-white">Recomendaciones para tus tratos</h4>
                <div class="flex flex-col gap-4 p-4 rounded-xl">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-base text-white">verified_user</span>
                        <p class="text-body-sm leading-tight text-white">Verifica la identidad del comprador</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-base text-white">location_on</span>
                        <p class="text-body-sm leading-tight text-white">Realiza tus tratos en lugares públicos</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-base text-white">chat_bubble</span>
                        <p class="text-body-sm leading-tight text-white">Usa WhatsApp para mayor seguridad</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-base text-white">security</span>
                        <p class="text-body-sm leading-tight text-white">No compartas datos bancarios sensibles</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-outline/30 py-6 px-gutter max-w-container-max mx-auto text-center">
            <p class="text-body-sm text-surface-variant/60">Market Place Plus - eCommerce Template © 2026.</p>
        </div>
    </footer>

</div>
@endsection
