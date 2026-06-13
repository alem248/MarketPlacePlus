@extends('layouts.app')

@section('title', 'Mis Tratos - MarketPlace Plus')

@section('content')
<div class="bg-background text-on-surface font-body-lg overflow-x-hidden">

    {{-- ===================== TOP NAV ===================== --}}
    <header class="bg-surface-container-lowest border-b border-outline-variant top-0 w-full z-50 sticky">
        <div class="flex items-center justify-between w-full max-w-container-max mx-auto px-margin-mobile py-4 gap-gutter">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               class="text-headline-lg font-headline-lg text-primary tracking-tight shrink-0">
                MarketPlace Plus
            </a>

            {{-- Buscador --}}
            <div class="flex-1 max-w-2xl relative hidden md:block">
                <input class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-6 py-3 focus:outline-none focus:ring-2 focus:ring-primary/20"
                       placeholder="¿Qué vamos a comprar hoy?" type="text">
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            </div>

            {{-- Iconos de navegación --}}
            <div class="flex items-center gap-6 text-primary">
                <a href="{{ route('home') }}" class="p-2 hover:bg-surface-container-low rounded-full transition-colors">
                    <span class="material-symbols-outlined">home</span>
                </a>
                <button class="btn-soon p-2 hover:bg-surface-container-low rounded-full transition-colors">
                    <span class="material-symbols-outlined">favorite</span>
                </button>
                {{-- Handshake activo (lleno) porque estamos en Mis Tratos --}}
                <a href="{{ route('tratos.index') }}" class="p-2 hover:bg-surface-container-low rounded-full transition-colors">
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">handshake</span>
                </a>
                {{-- Avatar con inicial del nombre --}}
                <div class="p-1 border border-outline-variant rounded-full">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ===================== LAYOUT PRINCIPAL ===================== --}}
    <div class="flex max-w-container-max mx-auto min-h-[calc(100vh-80px)]">

        {{-- ===================== SIDEBAR ===================== --}}
        <aside class="hidden lg:flex flex-col p-6 gap-6 bg-surface-container-lowest border-r border-outline-variant w-[280px] shrink-0 sticky top-[80px] h-[calc(100vh-80px)] overflow-y-auto">

            {{-- Foto y nombre del usuario --}}
            <div class="flex flex-col items-center text-center gap-2">
                <div class="relative w-24 h-24">
                    {{-- Usamos inicial ya que no hay foto de perfil implementada aún --}}
                    <div class="w-full h-full rounded-xl border-2 border-primary bg-primary flex items-center justify-center text-on-primary text-4xl font-bold">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                    {{-- Indicador de estado en línea --}}
                    <div class="absolute bottom-1 right-1 w-4 h-4 bg-tertiary-container border-2 border-white rounded-full"></div>
                </div>
                <div>
                    <h3 class="text-headline-md font-bold text-primary">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </h3>
                    <p class="text-body-sm text-on-surface-variant">Comprador</p>
                </div>
            </div>

            {{-- Botón cambiar a modo vendedor --}}
            <a href="{{ route('seller.panel') }}"
               class="w-full bg-secondary-container text-on-secondary-container font-bold py-3 rounded-lg flex items-center justify-center gap-2 shadow-sm hover:opacity-90 transition-all">
                <span class="material-symbols-outlined">sync</span>
                Cambiar a Vendedor
            </a>

            {{-- Menú de navegación lateral --}}
            <nav class="flex flex-col gap-1">
                {{-- Panel del comprador: va al home (catálogo principal del comprador) --}}
                <a href="{{ route('home') }}"
                   class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low transition-all rounded-lg">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-medium">Panel</span>
                </a>

                {{-- Mis Tratos activo --}}
                <a href="{{ route('tratos.index') }}"
                   class="flex items-center gap-4 px-4 py-3 bg-primary text-on-primary font-bold rounded-lg shadow-md">
                    <span class="material-symbols-outlined">handshake</span>
                    <span class="font-bold">Mis Tratos</span>
                </a>

                <a href="{{ route('proximamente') }}"
                   class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low transition-all rounded-lg">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="font-medium">Delivery</span>
                </a>

                <a href="{{ route('comprobantes.index') }}"
                   class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low transition-all rounded-lg">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span class="font-medium">Mis Comprobantes</span>
                </a>
            </nav>

            {{-- Cerrar sesión al fondo del sidebar --}}
            <div class="mt-auto pt-6 border-t border-outline-variant">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-4 px-4 py-3 text-error font-semibold hover:bg-error-container/10 transition-all rounded-lg">
                        <span class="material-symbols-outlined">logout</span>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

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
                <div class="flex-1 max-w-lg w-full">
                    <p class="text-center text-label-caps font-label-caps text-on-surface-variant mb-6 tracking-widest">
                        -- ESTADOS DE COMPRAS --
                    </p>
                    <div class="relative flex items-center justify-between px-4">
                        {{-- Línea base gris de fondo --}}
                        <div class="absolute h-0.5 w-[calc(100%-32px)] bg-surface-container-high top-1/2 -translate-y-1/2 z-0 left-4"></div>
                        {{-- Línea de progreso naranja (75% = hasta "Aprobado") --}}
                        <div class="absolute h-0.5 w-[75%] bg-secondary top-1/2 -translate-y-1/2 z-0 left-4"></div>

                        {{-- Paso 1: Pedido Realizado --}}
                        <div class="relative z-10 flex flex-col items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-secondary text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">assignment</span>
                            </div>
                            <span class="text-[10px] font-bold text-center uppercase whitespace-nowrap">Pedido realizado</span>
                        </div>

                        {{-- Paso 2: En Discusión --}}
                        <div class="relative z-10 flex flex-col items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-secondary text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">forum</span>
                            </div>
                            <span class="text-[10px] font-bold text-center uppercase whitespace-nowrap">En discusión</span>
                        </div>

                        {{-- Paso 3: Aprobado (resaltado como estado actual) --}}
                        <div class="relative z-10 flex flex-col items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-secondary text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">check_box</span>
                            </div>
                            <span class="text-[10px] font-bold text-center uppercase whitespace-nowrap text-secondary">Aprobado</span>
                        </div>

                        {{-- Paso 4: Recibido (pendiente, opaco) --}}
                        <div class="relative z-10 flex flex-col items-center gap-2 opacity-30">
                            <div class="w-8 h-8 rounded-full bg-outline-variant flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">inventory_2</span>
                            </div>
                            <span class="text-[10px] font-bold text-center uppercase whitespace-nowrap">Recibido</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== LISTADO DE TRATOS ===== --}}
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">

                {{-- Cabecera de la tabla con filtro --}}
                <div class="p-6 border-b border-outline-variant flex items-center justify-between">
                    <h2 class="text-headline-md font-headline-md">Listado de Tratos</h2>
                    <div class="relative">
                        <select class="appearance-none bg-surface-container-low border border-outline-variant rounded-lg px-4 py-2 pr-10 text-body-sm focus:ring-primary focus:border-primary outline-none">
                            <option>Todos los estados</option>
                            <option>Aprobado</option>
                            <option>En discusión</option>
                            <option>Recibido</option>
                            <option>Cancelado</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                    </div>
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
                                            {{-- Mostramos los primeros 80 caracteres de la descripción --}}
                                            <p class="text-body-sm font-semibold mb-1">
                                                {{ Str::limit($trato->product->description, 80) }}
                                            </p>
                                            <span class="text-[11px] text-on-surface-variant font-medium">
                                                SKU: {{ $trato->sku ?? 'N/A' }}
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

    {{-- ===================== FOOTER ===================== --}}
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
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Ayuda al cliente</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Sobre nosotros</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Términos y condiciones</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-label-caps font-label-caps mb-6 uppercase tracking-wider text-white">Recomendaciones para tus tratos</h4>
                <div class="flex flex-col gap-4 p-4 rounded-xl">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-base text-white">verified_user</span>
                        <p class="text-body-sm leading-tight text-white">Verifica la reputación del vendedor</p>
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
