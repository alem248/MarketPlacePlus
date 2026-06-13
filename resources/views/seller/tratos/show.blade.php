@extends('layouts.app')

@section('title', 'Detalles del Trato - MarketPlace Plus')

@section('content')
@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;

    /*
     * Orden numérico del estado actual para saber qué pasos
     * del timeline mostrar como completados.
     * pedido_realizado(1) → en_discusion(2) → aprobado(3) → recibido(4)
     */
    $statusOrder = \App\Models\Trato::STATUS_ORDER[$trato->status] ?? 0;

    // Primera imagen del producto (URL externa tipo Unsplash o storage local)
    $imgs   = $trato->product->image_path ?? [];
    $imgSrc = isset($imgs[0])
        ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0]))
        : null;

    // ID formateado como #TRX-00001
    $tratoId = '#TRX-' . str_pad($trato->id, 5, '0', STR_PAD_LEFT);

    // Flags de estado para controlar qué botones y secciones se muestran
    $isRecibido  = $trato->status === 'recibido';
    $isCancelado = $trato->status === 'cancelado';
    $canAccept   = in_array($trato->status, ['pedido_realizado', 'en_discusion']);
    $isAprobado  = $trato->status === 'aprobado';
    $canCancel   = !in_array($trato->status, ['recibido', 'cancelado']);

    // Colores del badge de estado
    [$badgeBg, $badgeText] = match($trato->status) {
        'en_discusion'     => ['bg-primary/10',             'text-primary'],
        'aprobado'         => ['bg-tertiary-container/10',  'text-tertiary-container'],
        'recibido'         => ['bg-secondary/10',           'text-secondary'],
        'pedido_realizado' => ['bg-outline/10',             'text-outline'],
        default            => ['bg-error/10',               'text-error'],
    };

    // Enlace base de WhatsApp hacia el comprador (si tiene teléfono en su perfil)
    $waBase = ($trato->buyer->phone ?? null)
        ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $trato->buyer->phone)
        : null;

    // Alias para el botón principal "Concretar por WhatsApp"
    $waLink = $waBase ?? '#';

    // Links de WA con mensajes pre-escritos para cada botón del chat
    $buyerName    = $trato->buyer->first_name;
    $productTitle = $trato->product->title;

    $waDisponible = $waBase
        ? $waBase . '?text=' . rawurlencode('Hola ' . $buyerName . ', te contacto por el producto: ' . $productTitle)
        : '#';

    $waInteresa = $waBase
        ? $waBase . '?text=' . rawurlencode('Hola! Me interesa adquirir: ' . $productTitle . '. ¿Podemos coordinar?')
        : '#';

    $waHablemos = $waBase
        ? $waBase . '?text=' . rawurlencode('Hola ' . $buyerName . '! Hablemos por WhatsApp para coordinar el trato de: ' . $productTitle)
        : '#';
@endphp

<div class="bg-background text-on-surface font-body-lg">

    {{-- ===== TOP NAV (idéntico al de seller/tratos/index) ===== --}}
    <header class="bg-surface-container-lowest border-b border-outline-variant sticky top-0 z-50 w-full">
        <div class="flex items-center justify-between px-gutter h-16 max-w-container-max mx-auto">

            <a href="{{ route('home') }}"
               class="font-headline-md text-headline-md font-black text-primary tracking-tight">
                MarketPlace Plus
            </a>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-1">
                    <button class="p-2 rounded-full hover:bg-surface-container-low transition-colors text-primary">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <button class="p-2 rounded-full hover:bg-surface-container-low transition-colors text-primary">
                        <span class="material-symbols-outlined">settings</span>
                    </button>
                </div>

                <div class="flex items-center gap-3 pl-4 border-l border-outline-variant">
                    <div class="text-right hidden md:block">
                        <p class="text-label-caps font-bold text-on-surface">Vendedor</p>
                        <p class="text-body-sm text-on-surface-variant">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary font-bold border border-outline-variant">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex max-w-container-max mx-auto min-h-[calc(100vh-64px)]">

        {{-- ===== SIDEBAR VENDEDOR (idéntico al de seller/tratos/index) ===== --}}
        <aside class="hidden lg:flex flex-col w-[280px] shrink-0 bg-surface-container-lowest border-r border-outline-variant sticky top-[64px] h-[calc(100vh-64px)] overflow-y-auto">

            {{-- Perfil del vendedor --}}
            <div class="px-6 py-8 flex flex-col items-start gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center text-on-primary text-xl font-bold border border-outline-variant">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-body-lg font-bold text-primary leading-tight">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </h3>
                        <p class="text-xs text-tertiary flex items-center gap-1 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-tertiary inline-block"></span>
                            Vendedor — Online
                        </p>
                    </div>
                </div>

                <a href="{{ route('home') }}"
                   class="w-full mt-2 py-2 px-4 rounded-xl border-2 border-secondary text-secondary font-bold text-label-caps hover:bg-secondary-fixed/20 transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">swap_horiz</span>
                    Cambiar a Cliente
                </a>
            </div>

            {{-- Navegación del sidebar --}}
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

                {{-- Mis Tratos activo (estamos dentro de esta sección) --}}
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

        {{-- ===== CONTENIDO PRINCIPAL ===== --}}
        <main class="flex-1 p-gutter bg-surface-dim/20">

            {{-- Encabezado: título, ID del trato, badge de estado y botón generar comprobante --}}
            <header class="mb-gutter flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center gap-3">
                    {{-- Volver al listado del vendedor --}}
                    <a href="{{ route('seller.tratos.index') }}"
                       class="p-2 hover:bg-surface-container-low rounded-full transition-colors text-primary">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                    <div>
                        <h1 class="text-headline-lg font-headline-lg text-on-surface">Detalles del Trato</h1>
                        <p class="text-body-sm text-on-surface-variant mt-0.5">
                            ID: <span class="font-mono font-bold">{{ $tratoId }}</span> •
                            Comprador: <span class="font-bold">{{ $trato->buyer->first_name }} {{ $trato->buyer->last_name }}</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    {{-- Badge del estado actual --}}
                    <span class="px-4 py-2 rounded-full {{ $badgeBg }} {{ $badgeText }} font-bold text-label-caps flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings:'FILL' 1">sync</span>
                        {{ $trato->status_label }}
                    </span>

                    {{--
                        Botón "Generar Comprobante":
                        - Activo SOLO cuando status = 'recibido' (ambas partes confirmaron).
                        - La lógica completa de generación del PDF/comprobante se implementa después.
                    --}}
                    @if($isRecibido)
                        <button class="bg-secondary-container hover:bg-secondary transition-all text-on-primary hover:text-on-secondary px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow-md">
                            <span class="material-symbols-outlined">receipt_long</span>
                            Generar Comprobante
                        </button>
                    @else
                        <button disabled title="Disponible cuando ambas partes marquen como recibido"
                                class="opacity-40 cursor-not-allowed bg-surface-container-high text-on-surface-variant px-5 py-2.5 rounded-xl font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined">receipt_long</span>
                            Generar Comprobante
                        </button>
                    @endif
                </div>
            </header>

            {{-- ===== GRID 12 COLUMNAS: izquierda (producto + acciones) | derecha (chat) ===== --}}
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-gutter items-start">

                {{-- ==================== COLUMNA IZQUIERDA ==================== --}}
                <div class="xl:col-span-5 flex flex-col gap-6">

                    {{-- Tarjeta del producto: imagen con precio superpuesto + info + acciones --}}
                    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm">

                        {{-- Imagen del producto con el precio en overlay --}}
                        <div class="relative aspect-[4/3]">
                            @if($imgSrc)
                                <img src="{{ $imgSrc }}"
                                     alt="{{ $trato->product->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-surface-container-low">
                                    <span class="material-symbols-outlined text-outline" style="font-size:64px">image</span>
                                </div>
                            @endif

                            {{-- Overlay del precio (esquina superior derecha) --}}
                            <div class="absolute top-3 right-3 bg-surface-container-lowest/90 backdrop-blur-sm px-4 py-2 rounded-xl border border-outline-variant shadow-md">
                                <p class="text-price-display font-price-display text-secondary leading-none">
                                    S/. {{ number_format($trato->price, 2) }}
                                </p>
                                <p class="text-[10px] text-on-surface-variant text-center">precio pactado</p>
                            </div>

                            {{-- Badge de categoría (esquina inferior izquierda) --}}
                            <div class="absolute bottom-3 left-3">
                                <span class="bg-inverse-surface/80 text-on-primary text-label-caps font-bold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">
                                    {{ $trato->product->category }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 space-y-4">

                            {{-- Título del producto y condición --}}
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface leading-tight">
                                    {{ $trato->product->title }}
                                </h2>
                                @if($trato->product->condition ?? null)
                                    <p class="text-body-sm text-on-surface-variant mt-1 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[15px]">info</span>
                                        Estado: {{ $trato->product->condition }}
                                    </p>
                                @endif
                            </div>

                            <div class="h-px bg-outline-variant"></div>

                            {{-- Info del comprador --}}
                            <div class="flex items-center gap-3 p-3 bg-surface-container-low rounded-xl">
                                {{-- Avatar con iniciales --}}
                                <div class="w-12 h-12 rounded-xl bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-lg shrink-0">
                                    {{ strtoupper(substr($trato->buyer->first_name, 0, 1)) }}{{ strtoupper(substr($trato->buyer->last_name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <p class="text-body-sm font-bold text-on-surface">
                                        {{ $trato->buyer->first_name }} {{ $trato->buyer->last_name }}
                                    </p>
                                    <p class="text-[11px] text-on-surface-variant">Comprador</p>
                                    {{-- Estrellas decorativas (sistema de rating se implementa después) --}}
                                    <div class="flex items-center gap-0.5 mt-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-secondary-container text-[14px]"
                                                  style="font-variation-settings:'FILL' {{ $i <= 4 ? 1 : 0 }}">
                                                {{ $i <= 4 ? 'star' : 'star_half' }}
                                            </span>
                                        @endfor
                                        <span class="text-[10px] text-on-surface-variant ml-1 font-bold">(4.5)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="h-px bg-outline-variant"></div>

                            {{-- Botones de acción según el estado del trato --}}
                            <div class="space-y-3">

                                {{--
                                    "Aceptar Oferta": visible y activo cuando el trato está en pedido_realizado o en_discusion.
                                    Al aceptar, el estado pasaría a 'aprobado' (lógica POST se implementa después).
                                    Si ya está aprobado o recibido, se muestra desactivado con estado verde.
                                --}}
                                @if($canAccept)
                                    <button class="w-full bg-secondary-container text-on-primary py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 hover:brightness-105 active:scale-95 transition-all shadow-md">
                                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">check_circle</span>
                                        Aceptar Oferta
                                    </button>
                                    {{-- Rechazar: solo disponible mientras se puede aceptar --}}
                                    @if($canCancel)
                                        <button class="w-full border-2 border-outline-variant text-on-surface-variant py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-surface-container-low active:scale-95 transition-all">
                                            <span class="material-symbols-outlined">cancel</span>
                                            Rechazar Trato
                                        </button>
                                    @endif
                                @elseif($isAprobado)
                                    <button disabled class="w-full bg-tertiary-container/20 text-tertiary-container py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 cursor-not-allowed opacity-80 border border-tertiary-container/30">
                                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">verified</span>
                                        Oferta Aceptada
                                    </button>
                                @elseif($isRecibido)
                                    <button disabled class="w-full bg-secondary/10 text-secondary py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 cursor-not-allowed opacity-80 border border-secondary/30">
                                        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">check_circle</span>
                                        Trato Completado
                                    </button>
                                @elseif($isCancelado)
                                    <button disabled class="w-full bg-error/10 text-error py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 cursor-not-allowed opacity-80">
                                        <span class="material-symbols-outlined">block</span>
                                        Trato Cancelado
                                    </button>
                                @endif

                                {{-- WhatsApp: siempre visible para contactar al comprador --}}
                                <a href="{{ $waLink }}" target="_blank"
                                   class="w-full bg-[#25D366] text-white py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 hover:brightness-110 active:scale-95 transition-all shadow-md">
                                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">chat_bubble</span>
                                    Concretar por WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- ===== TARJETA DE SEGUIMIENTO DEL TRATO ===== --}}
                    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6 shadow-sm">

                        <h3 class="font-headline-md text-headline-md mb-5 flex items-center gap-2 text-primary">
                            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">task_alt</span>
                            Seguimiento del Trato
                        </h3>

                        {{-- Barra de progreso dinámica --}}
                        @php
                            $progressPct = match($trato->status) {
                                'pedido_realizado' => '8%',
                                'en_discusion'     => '38%',
                                'aprobado'         => '68%',
                                'recibido'         => '100%',
                                default            => '0%',
                            };
                        @endphp
                        <div class="relative h-2 bg-surface-container-high rounded-full mb-8 overflow-hidden">
                            <div class="h-2 bg-secondary-container rounded-full transition-all duration-700"
                                 style="width: {{ $progressPct }}"></div>
                        </div>

                        {{-- Pasos del timeline como lista vertical con checkboxes --}}
                        <div class="space-y-3">

                            {{-- Paso 1: Pedido Realizado — siempre completado --}}
                            <div class="flex items-center gap-4 p-3 rounded-xl {{ $statusOrder >= 1 ? 'bg-secondary-container/10' : 'bg-surface-container-low opacity-40' }}">
                                <div class="w-9 h-9 rounded-lg {{ $statusOrder >= 1 ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-container-high text-on-surface-variant' }} flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1">assignment</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-body-sm font-bold text-on-surface">Pedido Realizado</p>
                                    <p class="text-[11px] text-on-surface-variant truncate">{{ $trato->created_at->format('d M Y, h:i A') }}</p>
                                </div>
                                <input type="checkbox" checked disabled
                                       class="w-5 h-5 rounded accent-secondary-container cursor-default shrink-0">
                            </div>

                            {{-- Paso 2: En Discusión --}}
                            @php $step2 = $statusOrder >= 2; @endphp
                            <div class="flex items-center gap-4 p-3 rounded-xl {{ $step2 ? 'bg-secondary-container/10' : 'bg-surface-container-low opacity-40' }}">
                                <div class="w-9 h-9 rounded-lg {{ $step2 ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-container-high text-on-surface-variant' }} flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' {{ $step2 ? 1 : 0 }}">forum</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-body-sm font-bold text-on-surface">En Discusión</p>
                                    <p class="text-[11px] text-on-surface-variant">{{ $step2 ? 'Negociación activa con el comprador' : 'Pendiente' }}</p>
                                </div>
                                <input type="checkbox" {{ $step2 ? 'checked' : '' }} disabled
                                       class="w-5 h-5 rounded accent-secondary-container cursor-default shrink-0">
                            </div>

                            {{-- Paso 3: Aprobado (trato aceptado por el vendedor) --}}
                            @php $step3 = $statusOrder >= 3; @endphp
                            <div class="flex items-center gap-4 p-3 rounded-xl {{ $step3 ? 'bg-secondary-container/10' : 'bg-surface-container-low opacity-40' }}">
                                <div class="w-9 h-9 rounded-lg {{ $step3 ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-container-high text-on-surface-variant' }} flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' {{ $step3 ? 1 : 0 }}">verified</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-body-sm font-bold text-on-surface">Aprobado</p>
                                    <p class="text-[11px] text-on-surface-variant">{{ $step3 ? 'Oferta aceptada' : 'Pendiente de aprobación' }}</p>
                                </div>
                                <input type="checkbox" {{ $step3 ? 'checked' : '' }} disabled
                                       class="w-5 h-5 rounded accent-secondary-container cursor-default shrink-0">
                            </div>

                            {{--
                                Paso 4: Recibido — es el único paso interactivo.
                                Tanto el VENDEDOR como el COMPRADOR deben marcar su checkbox.
                                Cuando ambos marquen, el estado cambia a 'recibido' y se habilita el comprobante.
                                Por ahora la lógica es visual (JS). El guardado real se implementa después.
                            --}}
                            @php $step4 = $statusOrder >= 4; @endphp
                            <div class="p-4 rounded-xl border-2 {{ $step4 ? 'border-secondary-container/40 bg-secondary-container/10' : 'border-dashed border-outline-variant bg-surface-container-low' }}">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-9 h-9 rounded-lg {{ $step4 ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-container-high text-on-surface-variant' }} flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[18px]">inventory_2</span>
                                    </div>
                                    <p class="text-body-sm font-bold text-on-surface flex-1">Recibido</p>
                                    @if(!$step4)
                                        <span class="text-[10px] text-outline italic">ambos deben confirmar</span>
                                    @endif
                                </div>

                                {{-- Checkboxes individuales del vendedor y del comprador --}}
                                <div class="space-y-3 ml-12">

                                    {{-- Checkbox del VENDEDOR (yo): interactivo --}}
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" id="seller-received"
                                               {{ $step4 ? 'checked' : '' }}
                                               class="w-5 h-5 rounded accent-secondary-container"
                                               onchange="handleSellerConfirm(this)">
                                        <span class="text-body-sm text-on-surface group-hover:text-primary transition-colors">
                                            Yo confirmo que entregué el producto
                                        </span>
                                    </label>

                                    {{-- Checkbox del COMPRADOR: solo lectura, refleja su estado real --}}
                                    <label class="flex items-center gap-3 opacity-60">
                                        <input type="checkbox" {{ $step4 ? 'checked' : '' }} disabled
                                               class="w-5 h-5 rounded accent-secondary-container cursor-not-allowed">
                                        <span class="text-body-sm text-on-surface-variant">
                                            Comprador confirma que lo recibió
                                            @if(!$step4)
                                                <span class="text-[10px] italic text-outline ml-1">(pendiente)</span>
                                            @endif
                                        </span>
                                    </label>
                                </div>

                                {{-- Mensaje de espera: aparece cuando el vendedor marca pero el comprador aún no --}}
                                <div id="pending-buyer-msg"
                                     class="{{ $step4 ? 'hidden' : 'hidden' }} mt-3 ml-12 p-2 bg-secondary-fixed/30 rounded-lg border border-secondary-container/20">
                                    <p class="text-[11px] text-on-surface-variant italic flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">hourglass_empty</span>
                                        Esperando que el comprador confirme la recepción...
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Nota informativa sobre el comprobante --}}
                        <p class="text-[11px] text-on-surface-variant italic mt-4">
                            * El comprobante se habilita cuando ambas partes confirman la entrega.
                        </p>
                    </div>
                </div>

                {{-- ==================== COLUMNA DERECHA: CHAT ==================== --}}
                <div class="xl:col-span-7">
                    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm flex flex-col" style="min-height: 700px; max-height: 850px;">

                        {{-- Header del chat --}}
                        <div class="px-6 py-4 border-b border-outline-variant bg-surface-bright shrink-0 rounded-t-xl">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-2.5 h-2.5 rounded-full bg-tertiary animate-pulse shrink-0"></div>
                                    <div>
                                        <h3 class="font-bold text-on-surface">
                                            Chat con {{ $trato->buyer->first_name }}
                                        </h3>
                                        <p class="text-[11px] text-on-surface-variant">
                                            Mensajes predeterminados — concreta el trato por WhatsApp
                                        </p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full {{ $badgeBg }} {{ $badgeText }} text-[10px] font-bold uppercase tracking-wider">
                                    {{ $trato->status_label }}
                                </span>
                            </div>
                        </div>

                        {{--
                            ÁREA DE CHAT: empieza vacía.
                            Los mensajes aparecen aquí cuando el vendedor hace clic en una burbuja de respuesta.
                        --}}
                        <div id="chat-messages"
                             class="flex-1 overflow-y-auto p-5 bg-surface-dim/20 flex items-center justify-center">
                            <p class="text-body-sm text-outline text-center italic">
                                Usa los mensajes de abajo para responder al comprador
                            </p>
                        </div>

                        {{--
                            SECCIÓN DE BURBUJAS PREDEFINIDAS (FUERA del área de chat).
                            Se divide en dos grupos:
                              • Mensajes del comprador: lo que el comprador suele preguntar + botón WA para responder.
                              • Tus respuestas: opciones que el VENDEDOR puede enviar al hacer clic.
                        --}}
                        <div class="border-t border-outline-variant bg-surface-bright shrink-0 overflow-y-auto" style="max-height: 360px;">
                            <div class="p-5 space-y-5">

                                {{-- ---- MENSAJES DEL COMPRADOR ---- --}}
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant mb-3 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[14px]">person</span>
                                        Mensajes del comprador
                                    </p>
                                    <div class="space-y-2">
                                        {{-- Burbuja: ¿Sigue disponible? + WA para responder --}}
                                        <div class="flex items-center gap-2">
                                            <div class="bg-surface-container text-on-surface px-4 py-2.5 rounded-2xl rounded-tl-none shadow-sm border border-outline-variant/40 flex-1">
                                                <p class="text-body-sm">¿Sigue disponible?</p>
                                            </div>
                                            <a href="{{ $waDisponible }}" target="_blank" title="Responder por WhatsApp"
                                               class="w-9 h-9 rounded-xl bg-[#25D366] flex items-center justify-center text-white shrink-0 hover:brightness-110 transition-all shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/></svg>
                                            </a>
                                        </div>
                                        {{-- Burbuja: Me interesa adquirir el producto + WA --}}
                                        <div class="flex items-center gap-2">
                                            <div class="bg-surface-container text-on-surface px-4 py-2.5 rounded-2xl rounded-tl-none shadow-sm border border-outline-variant/40 flex-1">
                                                <p class="text-body-sm">Me interesa adquirir el producto</p>
                                            </div>
                                            <a href="{{ $waInteresa }}" target="_blank" title="Abrir WhatsApp"
                                               class="w-9 h-9 rounded-xl bg-[#25D366] flex items-center justify-center text-white shrink-0 hover:brightness-110 transition-all shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Divisor --}}
                                <div class="flex items-center gap-3">
                                    <div class="h-px flex-1 bg-outline-variant"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant px-2">Tus respuestas</span>
                                    <div class="h-px flex-1 bg-outline-variant"></div>
                                </div>

                                {{--
                                    ---- RESPUESTAS DEL VENDEDOR ----
                                    Son burbujas FLOTANTES clickeables: al hacer clic aparecen en el chat de arriba.
                                    NO están enviadas todavía — son opciones para elegir.
                                --}}
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant mb-3 flex items-center justify-end gap-2">
                                        Mis mensajes
                                        <span class="material-symbols-outlined text-[14px]">person</span>
                                    </p>
                                    <div class="flex flex-col items-end space-y-2">

                                        {{-- Opción: Sí, sigue disponible --}}
                                        <button onclick="addSellerMessage('Sí, sigue disponible.')"
                                                class="group text-left">
                                            <div class="bg-primary text-on-primary px-4 py-2.5 rounded-2xl rounded-tr-none shadow-sm group-hover:brightness-110 group-active:scale-[0.98] transition-all flex items-center gap-2">
                                                <p class="text-body-sm">Sí, sigue disponible.</p>
                                                <span class="material-symbols-outlined text-[14px] opacity-60">send</span>
                                            </div>
                                        </button>

                                        {{-- Opción: No está disponible --}}
                                        <button onclick="addSellerMessage('Lo siento, ya no está disponible.')"
                                                class="group text-left">
                                            <div class="bg-primary text-on-primary px-4 py-2.5 rounded-2xl rounded-tr-none shadow-sm group-hover:brightness-110 group-active:scale-[0.98] transition-all flex items-center gap-2">
                                                <p class="text-body-sm">Lo siento, ya no está disponible.</p>
                                                <span class="material-symbols-outlined text-[14px] opacity-60">send</span>
                                            </div>
                                        </button>

                                    {{--
                                        Respuesta: Hablemos por WhatsApp.
                                        Abre WhatsApp hacia el comprador con mensaje pre-escrito.
                                    --}}
                                    <a href="{{ $waHablemos }}" target="_blank"
                                       class="group text-left">
                                        <div class="bg-[#25D366] text-white px-4 py-2.5 rounded-2xl rounded-tr-none shadow-sm group-hover:brightness-110 group-active:scale-[0.98] transition-all flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 shrink-0"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/></svg>
                                            <p class="text-body-sm font-bold">Hablemos por WhatsApp</p>
                                        </div>
                                    </a>

                                    </div>{{-- fin: flex flex-col items-end space-y-2 --}}
                                </div>{{-- fin: bloque mis mensajes --}}
                            </div>{{-- fin: p-5 space-y-5 --}}
                        </div>{{-- fin: sección predefinidos --}}

                        {{-- Input simple al fondo --}}
                        <div class="p-4 border-t border-outline-variant bg-surface-bright shrink-0 rounded-b-xl">
                            <div class="flex items-center gap-3 bg-surface-container-lowest rounded-full border border-outline-variant px-4 py-2 focus-within:border-primary transition-colors">
                                <span class="material-symbols-outlined text-on-surface-variant text-[20px]">add</span>
                                <input id="chat-input"
                                       class="flex-1 bg-transparent border-none focus:ring-0 text-body-sm outline-none"
                                       placeholder="Escribe un mensaje..."
                                       type="text"
                                       onkeypress="if(event.key==='Enter') sendChatMessage()">
                                <button onclick="sendChatMessage()"
                                        class="material-symbols-outlined text-primary hover:scale-110 transition-transform">
                                    send
                                </button>
                            </div>
                            <p class="text-[10px] text-center text-on-surface-variant mt-2 italic">
                                Para negociaciones importantes, usa el botón de WhatsApp.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    {{-- ===== FOOTER (mismo que el resto del proyecto) ===== --}}
    <footer class="w-full mt-gutter bg-inverse-surface">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-mobile md:px-gutter py-12 max-w-container-max mx-auto">
            <div class="md:col-span-1">
                <span class="text-headline-md font-headline-md font-bold text-on-primary">MarketPlace Plus</span>
                <p class="text-body-sm text-surface-variant mt-4">
                    La plataforma líder para conectar compradores y vendedores de forma directa y segura.
                </p>
            </div>
            <div>
                <h4 class="text-label-caps font-label-caps text-on-primary mb-6">Enlaces Rápidos</h4>
                <ul class="flex flex-col gap-3">
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="{{ route('home') }}">Comprar producto</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="{{ route('seller.tratos.index') }}">Mis tratos</a></li>
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
                <h4 class="text-label-caps font-label-caps mb-6 uppercase tracking-wider text-white">
                    Recomendaciones para tus tratos
                </h4>
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

@push('scripts')
<script>
    // Auto-scroll al fondo del chat al cargar la página
    document.getElementById('chat-bottom')?.scrollIntoView({ behavior: 'smooth' });

    // Envía un mensaje rápido predefinido al chat
    function sendQuickReply(text) {
        appendSellerMessage(text);
    }

    // Envía el texto del input al chat
    function sendChatMessage() {
        const input = document.getElementById('chat-input');
        const text  = input.value.trim();
        if (!text) return;
        appendSellerMessage(text);
        input.value = '';
    }

    // Agrega un mensaje del vendedor al área de chat (burbuja derecha)
    function appendSellerMessage(text) {
        const chatArea = document.getElementById('chat-messages');
        const now = new Date().toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit' });

        // La primera vez: limpia el placeholder y ajusta el layout del área
        if (chatArea.querySelector('p.text-outline')) {
            chatArea.innerHTML = '';
            chatArea.classList.remove('flex', 'items-center', 'justify-center');
            chatArea.classList.add('space-y-3', 'p-5');
        }

        const msgDiv = document.createElement('div');
        msgDiv.className = 'flex flex-col items-end max-w-[80%] ml-auto';
        msgDiv.innerHTML = `
            <div class="bg-primary text-on-primary px-4 py-3 rounded-2xl rounded-tr-none shadow-md">
                <p class="text-body-sm">${escapeHtml(text)}</p>
            </div>
            <span class="text-[10px] text-on-surface-variant mt-1 mr-1 flex items-center gap-1">
                ${now}
                <span class="material-symbols-outlined text-[12px] text-secondary-container"
                      style="font-variation-settings:'FILL' 1">done_all</span>
            </span>
        `;
        chatArea.appendChild(msgDiv);
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    // Escapa HTML para evitar inyección en innerHTML
    function escapeHtml(str) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    /*
     * Cuando el vendedor marca su checkbox de "Recibido":
     * - Muestra el mensaje de espera al comprador si marcó
     * - Oculta el mensaje si desmarcó
     * La confirmación real (cambio de estado en BD) se implementa después,
     * cuando se conecte el endpoint POST /tratos/{id}/confirm-received.
     */
    function handleSellerConfirm(checkbox) {
        const pendingMsg = document.getElementById('pending-buyer-msg');
        if (checkbox.checked) {
            pendingMsg.classList.remove('hidden');
        } else {
            pendingMsg.classList.add('hidden');
        }
    }
</script>
@endpush
