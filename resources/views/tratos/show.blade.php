@extends('layouts.app')

@section('title', 'Seguimiento de Trato - MarketPlace Plus')

@section('content')
@php
    /*
     * Calculamos el orden numérico del estado actual para controlar
     * qué pasos del timeline se muestran como completados.
     * Orden: pedido_realizado(1) → en_discusion(2) → aprobado(3) → recibido(4)
     */
    $statusOrder = \App\Models\Trato::STATUS_ORDER[$trato->status] ?? 0;

    // Ancho de la barra de progreso naranja según el estado
    $progressWidth = match($trato->status) {
        'pedido_realizado' => 'w-0',
        'en_discusion'     => 'w-1/3',
        'aprobado'         => 'w-2/3',
        'recibido'         => 'w-full',
        default            => 'w-0',
    };

    // Primera imagen del producto (URL externa o almacenamiento local)
    $imgs    = $trato->product->image_path ?? [];
    $imgSrc  = isset($imgs[0])
        ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0]))
        : null;

    // ID del trato formateado como #TRX-00001
    $tratoId = '#TRX-' . str_pad($trato->id, 5, '0', STR_PAD_LEFT);

    // Solo se puede calificar y generar comprobante cuando el estado es 'recibido'
    $isRecibido = $trato->status === 'recibido';

    // Solo se puede cancelar si el trato aún no fue recibido ni cancelado
    $canCancel = !in_array($trato->status, ['recibido', 'cancelado']);
@endphp

<div class="bg-background text-on-surface font-body-lg">

    {{-- ===================== TOP NAV ===================== --}}
    <nav class="bg-surface-container-lowest border-b border-outline-variant sticky top-0 z-50">
        <div class="flex items-center justify-between w-full max-w-container-max mx-auto px-margin-mobile py-4 gap-4">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               class="text-headline-lg font-headline-lg text-primary tracking-tight shrink-0">
                MarketPlace Plus
            </a>

            {{-- Buscador --}}
            <div class="flex-1 max-w-2xl mx-gutter">
                <div class="relative w-full">
                    <input class="w-full pl-10 pr-10 py-2 bg-surface-container-low border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20"
                           placeholder="¿Qué vamos a comprar hoy?" type="text">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-on-surface-variant">search</span>
                </div>
            </div>

            {{-- Iconos de navegación --}}
            <div class="flex items-center gap-6 text-primary">
                <a href="{{ route('home') }}" class="material-symbols-outlined cursor-pointer hover:bg-surface-container-low p-2 rounded-full transition-colors">home</a>
                <button class="btn-soon material-symbols-outlined cursor-pointer hover:bg-surface-container-low p-2 rounded-full transition-colors">favorite</button>
                <a href="{{ route('tratos.index') }}" class="material-symbols-outlined cursor-pointer hover:bg-surface-container-low p-2 rounded-full transition-colors" style="font-variation-settings:'FILL' 1">handshake</a>
                {{-- Inicial del usuario como avatar --}}
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary font-bold border border-outline-variant">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </div>
            </div>
        </div>
    </nav>

    <div class="flex max-w-container-max mx-auto min-h-screen">

        {{-- ===================== SIDEBAR ===================== --}}
        <aside class="hidden lg:flex flex-col w-sidebar-width bg-surface-container-lowest border-r border-outline-variant p-base gap-2 sticky top-[73px] h-[calc(100vh-73px)]">

            {{-- Perfil del usuario --}}
            <div class="p-6 flex flex-col items-center text-center gap-2">
                <div class="relative inline-block">
                    <div class="w-20 h-20 rounded-xl border-2 border-primary bg-primary flex items-center justify-center text-on-primary text-3xl font-bold">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                    <div class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                </div>
                <div>
                    <h3 class="text-headline-md font-bold text-primary">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </h3>
                    <p class="text-body-sm text-on-surface-variant">Comprador</p>
                </div>
            </div>

            {{-- Botón cambiar a vendedor --}}
            <div class="px-4 mb-2">
                <a href="{{ route('seller.panel') }}"
                   class="w-full bg-secondary-container text-on-secondary-container font-bold py-3 rounded-xl flex items-center justify-center gap-2 shadow-sm hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined">swap_horiz</span>
                    Cambiar a Vendedor
                </a>
            </div>

            {{-- Menú de navegación --}}
            <nav class="flex-1 space-y-1 px-2">
                {{-- Panel del comprador: va al home (catálogo principal del comprador) --}}
                <a href="{{ route('home') }}"
                   class="flex items-center gap-3 p-3 text-on-surface hover:bg-surface-container-low rounded-xl transition-all">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-label-caps">Panel</span>
                </a>

                {{-- "Mis Tratos" activo --}}
                <a href="{{ route('tratos.index') }}"
                   class="flex items-center gap-3 p-3 bg-primary text-on-primary font-bold rounded-xl shadow-sm">
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">handshake</span>
                    <span class="text-label-caps">Mis Tratos</span>
                </a>

                <a href="{{ route('proximamente') }}"
                   class="flex items-center gap-3 p-3 text-on-surface hover:bg-surface-container-low rounded-xl transition-all">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="text-label-caps">Delivery</span>
                </a>

                <a href="{{ route('comprobantes.index') }}"
                   class="flex items-center gap-3 p-3 text-on-surface hover:bg-surface-container-low rounded-xl transition-all">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span class="text-label-caps">Mis Comprobantes</span>
                </a>
            </nav>

            {{-- Cerrar sesión --}}
            <div class="mt-auto border-t border-outline-variant pt-4 p-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 p-3 text-error hover:bg-error-container/20 rounded-xl transition-all">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-label-caps font-bold">Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- ===================== CONTENIDO PRINCIPAL ===================== --}}
        <main class="flex-1 p-gutter bg-surface">

            {{-- Encabezado de página + botón generar comprobante --}}
            <header class="mb-gutter flex items-center justify-between">
                <div class="flex items-center gap-3">
                    {{-- Volver al listado de tratos --}}
                    <a href="{{ route('tratos.index') }}"
                       class="p-2 hover:bg-surface-container-low rounded-full transition-colors text-primary">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                    <h1 class="text-headline-lg font-headline-lg text-on-surface">Seguimiento de Trato</h1>
                </div>

                {{--
                    Botón "Generar comprobante":
                    - Activo SOLO cuando status = 'recibido' (lógica completa viene después,
                      cuando implementemos la vista del vendedor y la confirmación doble).
                    - Por ahora está bloqueado visualmente si no es 'recibido'.
                --}}
                @if($isRecibido)
                    {{-- Formulario POST que genera el comprobante y redirige a Mis Comprobantes --}}
                    <form action="{{ route('comprobantes.store', $trato) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="bg-secondary-container hover:bg-secondary transition-all text-on-secondary-container hover:text-on-secondary px-6 py-3 rounded-xl font-bold flex items-center gap-2 shadow-md">
                            <span class="material-symbols-outlined">receipt_long</span>
                            Generar comprobante de venta
                        </button>
                    </form>
                @else
                    <button disabled
                            title="Disponible cuando ambas partes marquen como recibido"
                            class="opacity-40 cursor-not-allowed bg-surface-container-high text-on-surface-variant px-6 py-3 rounded-xl font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined">receipt_long</span>
                        Generar comprobante de venta
                    </button>
                @endif
            </header>

            {{-- ===== GRID: columna izquierda (producto + detalles) | columna derecha (timeline) ===== --}}
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-gutter">

                {{-- ============ COLUMNA IZQUIERDA ============ --}}
                <div class="xl:col-span-5 flex flex-col gap-gutter">

                    {{-- Tarjeta del producto --}}
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm">

                        {{-- Imagen del producto --}}
                        <div class="aspect-square w-full rounded-xl overflow-hidden bg-surface-container-low mb-6">
                            @if($imgSrc)
                                <img src="{{ $imgSrc }}" alt="{{ $trato->product->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-outline" style="font-size:64px">image</span>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-4">
                            {{-- Badge de categoría --}}
                            <span class="text-label-caps font-bold text-secondary-container px-3 py-1 bg-secondary-fixed rounded-lg uppercase">
                                {{ $trato->product->category }}
                            </span>

                            {{-- Título y precio del trato --}}
                            <h2 class="text-headline-md font-headline-md text-on-surface">
                                {{ $trato->product->title }}
                            </h2>
                            <p class="text-price-display font-price-display text-primary">
                                S/ {{ number_format($trato->price, 2) }}
                            </p>

                            <hr class="border-outline-variant">

                            {{-- Info del vendedor --}}
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-lg">
                                        {{ strtoupper(substr($trato->seller->first_name, 0, 1)) }}{{ strtoupper(substr($trato->seller->last_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-body-sm font-bold text-on-surface">
                                            Vendedor: {{ $trato->seller->first_name }} {{ $trato->seller->last_name }}
                                        </p>
                                        {{-- Estrellas decorativas (sin sistema de rating real aún) --}}
                                        <div class="flex items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="material-symbols-outlined text-secondary-container text-[18px]"
                                                      style="font-variation-settings:'FILL' {{ $i <= 4 ? 1 : 0 }}">
                                                    {{ $i <= 4 ? 'star' : 'star_half' }}
                                                </span>
                                            @endfor
                                            <span class="text-on-surface-variant text-[12px] font-bold ml-1">(4.5)</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Botón de chat (visual, la lógica viene después) --}}
                                <button class="p-3 text-primary hover:bg-primary-fixed rounded-xl transition-colors border border-outline-variant">
                                    <span class="material-symbols-outlined">forum</span>
                                </button>
                            </div>

                            {{-- ===== SECCIÓN CALIFICAR VENDEDOR =====
                                 Solo habilitada cuando status = 'recibido'.
                                 Envía POST a /tratos/{trato}/calificar y guarda en la tabla comments.
                            --}}
                            <div class="mt-6 pt-6 border-t border-outline-variant
                                        {{ !$isRecibido ? 'opacity-40 pointer-events-none select-none' : '' }}">
                                <h3 class="text-body-sm font-bold text-on-surface mb-3 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-secondary text-[20px]"
                                          style="font-variation-settings:'FILL' 1">stars</span>
                                    Calificar Vendedor
                                    @if(!$isRecibido)
                                        <span class="text-[10px] font-normal text-outline italic ml-1">
                                            (disponible al marcar como recibido)
                                        </span>
                                    @endif
                                </h3>

                                {{-- Mensaje de éxito después de enviar --}}
                                @if(session('success_calificacion'))
                                    <div class="mb-3 p-3 bg-green-100 text-green-800 rounded-xl text-body-sm font-medium flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                        {{ session('success_calificacion') }}
                                    </div>
                                @endif

                                {{-- Mensaje de error (ya calificado o validación) --}}
                                @if(session('error_calificacion'))
                                    <div class="mb-3 p-3 bg-red-100 text-red-800 rounded-xl text-body-sm font-medium flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px]">error</span>
                                        {{ session('error_calificacion') }}
                                    </div>
                                @endif
                                @error('rating')
                                    <div class="mb-3 p-3 bg-red-100 text-red-800 rounded-xl text-body-sm font-medium flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px]">error</span>
                                        {{ $message }}
                                    </div>
                                @enderror

                                {{-- Formulario que guarda rating + comentario en la BD --}}
                                <form action="{{ route('tratos.calificar', $trato) }}" method="POST"
                                      class="flex flex-col gap-4">
                                    @csrf

                                    {{-- Campo oculto que se llena con JS al hacer clic en una estrella --}}
                                    <input type="hidden" name="rating" id="rating-value" value="">

                                    {{-- Estrellas interactivas --}}
                                    <div class="flex gap-1 text-outline-variant" id="star-rating">
                                        @for($s = 1; $s <= 5; $s++)
                                            <button type="button" data-star="{{ $s }}"
                                                    class="material-symbols-outlined hover:text-secondary-container transition-colors cursor-pointer text-[28px] star-btn">
                                                star
                                            </button>
                                        @endfor
                                    </div>

                                    <textarea name="content"
                                              class="w-full bg-surface-container-low border border-outline-variant rounded-xl p-3 text-body-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none resize-none"
                                              placeholder="Escribe un comentario sobre tu experiencia..."
                                              rows="3">{{ old('content') }}</textarea>
                                    @error('content')
                                        <p class="text-[11px] text-red-600">{{ $message }}</p>
                                    @enderror

                                    <button type="submit"
                                            class="w-full py-2 bg-primary text-on-primary rounded-lg font-bold text-body-sm hover:opacity-90 transition-opacity">
                                        Enviar Calificación
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Tarjeta de detalles del trato --}}
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm">
                        <h3 class="text-headline-md font-headline-md mb-6 flex items-center gap-2 text-primary">
                            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">info</span>
                            Detalles del Trato
                        </h3>

                        <div class="space-y-5">
                            {{-- ID del trato --}}
                            <div class="flex justify-between items-center">
                                <span class="text-body-sm text-on-surface-variant font-medium">ID de Trato:</span>
                                <span class="text-body-sm font-bold text-on-surface">{{ $tratoId }}</span>
                            </div>

                            {{-- Fecha de inicio --}}
                            <div class="flex justify-between items-center">
                                <span class="text-body-sm text-on-surface-variant font-medium">Fecha de Inicio:</span>
                                <span class="text-body-sm font-bold text-on-surface">
                                    {{ $trato->created_at->format('d M, Y') }}
                                </span>
                            </div>

                            {{--
                                Campo editable de método de pago.
                                El guardado se implementará más adelante con un PATCH /tratos/{id}/payment.
                                Por ahora es solo visual.
                            --}}
                            <div class="space-y-2">
                                <label class="text-body-sm text-on-surface-variant font-medium block">
                                    Método de Pago:
                                </label>
                                <input id="payment-method-input"
                                       class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-bold text-on-surface"
                                       type="text"
                                       value="{{ $trato->payment_method ?? '' }}"
                                       placeholder="Ej: Transferencia Bancaria, Yape...">
                            </div>
                        </div>

                        {{-- Botón cancelar trato --}}
                        <div class="mt-6 pt-6 border-t border-outline-variant">
                            @if($canCancel)
                                {{--
                                    TODO: conectar con ruta DELETE /tratos/{id}
                                    cuando se implemente la lógica completa del flujo.
                                --}}
                                <button class="w-full flex items-center justify-center gap-2 px-4 py-2 border-2 border-error text-error hover:bg-error-container/10 transition-colors rounded-xl font-bold text-body-sm">
                                    <span class="material-symbols-outlined">cancel</span>
                                    Cancelar Trato
                                </button>
                                <p class="text-[10px] text-on-surface-variant text-center mt-2 italic">
                                    * Solo se puede cancelar antes de marcar como recibido.
                                </p>
                            @else
                                {{-- Si ya fue recibido no se puede cancelar --}}
                                <div class="text-center text-body-sm text-on-surface-variant italic">
                                    Este trato ya no puede cancelarse.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ============ COLUMNA DERECHA: Timeline de estados + Chat ============ --}}
                <div class="xl:col-span-7 flex flex-col gap-gutter">
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-8 shadow-sm">

                        {{-- Título del tracker --}}
                        <div class="mb-10">
                            <h3 class="text-headline-md font-headline-md text-on-surface">Estado del Pedido</h3>
                            <p class="text-body-sm text-on-surface-variant mt-1">
                                @switch($trato->status)
                                    @case('pedido_realizado') Tu pedido ha sido registrado y está esperando respuesta. @break
                                    @case('en_discusion')     Tu pedido está siendo discutido con el vendedor. @break
                                    @case('aprobado')         Tu pedido se encuentra actualmente en la fase de aprobación final. @break
                                    @case('recibido')         ¡Trato completado! Ya puedes calificar al vendedor. @break
                                    @default                  Estado en proceso.
                                @endswitch
                            </p>
                        </div>

                        {{-- ===== TIMELINE DE PASOS ===== --}}
                        <div class="relative py-12 px-6">

                            {{-- Línea de fondo (gris) --}}
                            <div class="absolute top-[84px] left-12 right-12 h-1.5 bg-surface-container-high rounded-full"></div>

                            {{-- Línea de progreso (naranja), su ancho depende del estado --}}
                            <div class="absolute top-[84px] left-12 h-1.5 bg-secondary-container rounded-full shadow-sm {{ $progressWidth }}"></div>

                            <div class="relative flex justify-between">

                                {{-- Paso 1: Pedido Realizado — siempre completado --}}
                                @php $step1Done = $statusOrder >= 1; @endphp
                                <div class="flex flex-col items-center gap-5">
                                    <div class="w-14 h-14 rounded-xl flex items-center justify-center shadow-lg border-4 border-surface-container-lowest
                                                {{ $step1Done ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-container-high text-on-surface-variant' }}">
                                        <span class="material-symbols-outlined text-[28px]"
                                              style="font-variation-settings:'FILL' 1">assignment</span>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-body-sm font-bold text-on-surface">Pedido realizado</p>
                                        <span class="text-[11px] text-on-surface-variant font-medium">
                                            {{ $trato->created_at->format('d M, h:i A') }}
                                        </span>
                                    </div>
                                    {{-- Checkbox siempre marcado y deshabilitado --}}
                                    <input type="checkbox" checked disabled
                                           class="w-5 h-5 rounded border-secondary-container text-secondary-container cursor-default">
                                </div>

                                {{-- Paso 2: En Discusión --}}
                                @php $step2Done = $statusOrder >= 2; @endphp
                                <div class="flex flex-col items-center gap-5 {{ !$step2Done ? 'opacity-40' : '' }}">
                                    <div class="w-14 h-14 rounded-xl flex items-center justify-center shadow-lg border-4 border-surface-container-lowest
                                                {{ $step2Done ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-container-high text-on-surface-variant' }}">
                                        <span class="material-symbols-outlined text-[28px]"
                                              style="font-variation-settings:'FILL' 1">forum</span>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-body-sm font-bold text-on-surface">En discusión</p>
                                        <span class="text-[11px] text-on-surface-variant font-medium">
                                            {{ $step2Done ? $trato->updated_at->format('d M, h:i A') : 'Pendiente' }}
                                        </span>
                                    </div>
                                    <input type="checkbox" {{ $step2Done ? 'checked' : '' }} disabled
                                           class="w-5 h-5 rounded border-secondary-container text-secondary-container cursor-default">
                                </div>

                                {{-- Paso 3: Aprobado — resaltado si es el estado actual --}}
                                @php
                                    $step3Done    = $statusOrder >= 3;
                                    $step3Current = $trato->status === 'aprobado';
                                @endphp
                                <div class="flex flex-col items-center gap-5 {{ !$step3Done ? 'opacity-40' : '' }}">
                                    <div class="w-14 h-14 rounded-xl flex items-center justify-center shadow-lg border-4 border-surface-container-lowest
                                                {{ $step3Done ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-container-high text-on-surface-variant' }}
                                                {{ $step3Current ? 'ring-4 ring-secondary-fixed' : '' }}">
                                        <span class="material-symbols-outlined text-[28px]"
                                              style="font-variation-settings:'FILL' 1">verified</span>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-body-sm font-bold {{ $step3Current ? 'text-secondary-container' : 'text-on-surface' }}">
                                            Aprobado
                                        </p>
                                        <span class="text-[11px] text-on-surface-variant font-medium">
                                            {{ $step3Done ? 'Hoy, ' . $trato->updated_at->format('h:i A') : 'Pendiente' }}
                                        </span>
                                    </div>
                                    <input type="checkbox" {{ $step3Done ? 'checked' : '' }} disabled
                                           class="w-5 h-5 rounded border-secondary-container text-secondary-container cursor-default">
                                </div>

                                {{-- Paso 4: Recibido — se activa cuando ambas partes confirman (lógica futura) --}}
                                @php $step4Done = $statusOrder >= 4; @endphp
                                <div class="flex flex-col items-center gap-5 {{ !$step4Done ? 'opacity-40' : '' }}">
                                    <div class="w-14 h-14 rounded-xl flex items-center justify-center border-4 border-surface-container-lowest
                                                {{ $step4Done ? 'bg-secondary-container text-on-secondary-container shadow-lg' : 'bg-surface-container-high text-on-surface-variant' }}">
                                        <span class="material-symbols-outlined text-[28px]">inventory_2</span>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-body-sm font-bold text-on-surface">Recibido</p>
                                        <span class="text-[11px] text-on-surface-variant font-medium">
                                            {{ $step4Done ? $trato->updated_at->format('d M, h:i A') : 'Pendiente' }}
                                        </span>
                                    </div>
                                    {{--
                                        TODO: este checkbox será interactivo en la siguiente fase.
                                        Tanto comprador como vendedor deben marcarlo para avanzar el estado.
                                        Por ahora es solo visual.
                                    --}}
                                    <input type="checkbox" {{ $step4Done ? 'checked' : '' }} disabled
                                           class="w-5 h-5 rounded border-outline-variant text-primary cursor-not-allowed">
                                </div>

                            </div>
                        </div>

                        {{-- Nota informativa sobre el método de pago --}}
                        <div class="mt-12 p-6 bg-surface-container-low rounded-xl border border-outline-variant/30 italic text-body-sm text-on-surface-variant">
                            * Una vez marcado recibido, podrás generar tu comprobante de venta.
                            Recuerda escribir el método de pago para que aparezca en tu comprobante.
                        </div>

                        {{-- Nota sobre calificación del vendedor --}}
                        <div class="mt-4 p-4 bg-tertiary-container/10 rounded-xl border border-tertiary/20 flex items-center gap-3">
                            <span class="material-symbols-outlined text-tertiary">info</span>
                            <p class="text-body-sm text-on-surface font-medium">
                                Una vez recibido el producto puedes calificar al vendedor.
                            </p>
                        </div>
                    </div>

                    {{-- ===== CHAT DEL COMPRADOR: burbujas predefinidas + botón WA ===== --}}
                    @php
                        // Links de WhatsApp hacia el VENDEDOR con mensajes pre-escritos
                        $waSellerNum = preg_replace('/[^0-9]/', '', $trato->seller->phone ?? '');
                        $waTratoDisponible = $waSellerNum
                            ? 'https://wa.me/' . $waSellerNum . '?text=' . rawurlencode('Hola! ¿Sigue disponible: ' . $trato->product->title . '?')
                            : '#';
                        $waTratoInteresa = $waSellerNum
                            ? 'https://wa.me/' . $waSellerNum . '?text=' . rawurlencode('Hola! Me interesa adquirir: ' . $trato->product->title . '. ¿Podemos coordinar?')
                            : '#';
                        $waTratoBase = $waSellerNum
                            ? 'https://wa.me/' . $waSellerNum
                            : '#';
                    @endphp
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm flex flex-col overflow-hidden">

                        {{-- Header del chat del comprador --}}
                        <div class="px-5 py-4 border-b border-outline-variant bg-surface-bright flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">chat_bubble</span>
                                <div>
                                    <span class="font-bold text-primary">
                                        Chat con {{ $trato->seller->first_name }}
                                    </span>
                                    <p class="text-[11px] text-on-surface-variant">
                                        Vendedor del producto
                                    </p>
                                </div>
                            </div>
                            <span class="text-body-sm text-green-600 font-bold flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
                                En línea
                            </span>
                        </div>

                        {{-- Área de mensajes: vacía hasta que el comprador haga clic en una burbuja --}}
                        <div id="trato-chat-messages"
                             class="p-5 min-h-[140px] flex items-center justify-center bg-surface-container-lowest">
                            <p class="text-body-sm text-outline text-center italic">
                                Usa los mensajes de abajo para iniciar la conversación
                            </p>
                        </div>

                        {{-- Mensajes predefinidos: burbujas flotantes de chat --}}
                        <div class="p-4 bg-surface-container-low border-t border-outline-variant">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-outline mb-3">
                                Mensajes frecuentes
                            </p>
                            <div class="space-y-2">

                                {{--
                                    Burbuja 1: ¿Sigue disponible?
                                    Click burbuja → aparece en el chat como enviado.
                                    Click WA → abre WhatsApp con mensaje pre-escrito.
                                --}}
                                <div class="flex items-center gap-2">
                                    <button onclick="sendTratoMessage('¿Sigue disponible?')"
                                            class="flex-1 text-left group">
                                        <div class="bg-surface-container text-on-surface px-4 py-2.5 rounded-2xl rounded-tl-none shadow-sm border border-outline-variant/50 group-hover:border-primary/50 group-active:scale-[0.98] transition-all">
                                            <p class="text-body-sm">¿Sigue disponible?</p>
                                        </div>
                                    </button>
                                    <a href="{{ $waTratoDisponible }}" target="_blank"
                                       title="Enviar por WhatsApp"
                                       class="w-9 h-9 rounded-xl bg-[#25D366] flex items-center justify-center text-white shrink-0 hover:brightness-110 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/>
                                        </svg>
                                    </a>
                                </div>

                                {{--
                                    Burbuja 2: Me interesa adquirir el producto
                                    Mismo comportamiento doble: chat + WhatsApp.
                                --}}
                                <div class="flex items-center gap-2">
                                    <button onclick="sendTratoMessage('Me interesa adquirir el producto')"
                                            class="flex-1 text-left group">
                                        <div class="bg-surface-container text-on-surface px-4 py-2.5 rounded-2xl rounded-tl-none shadow-sm border border-outline-variant/50 group-hover:border-primary/50 group-active:scale-[0.98] transition-all">
                                            <p class="text-body-sm">Me interesa adquirir el producto</p>
                                        </div>
                                    </button>
                                    <a href="{{ $waTratoInteresa }}" target="_blank"
                                       title="Enviar por WhatsApp"
                                       class="w-9 h-9 rounded-xl bg-[#25D366] flex items-center justify-center text-white shrink-0 hover:brightness-110 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Botón CONCRETAR POR WHATSAPP (igual estilo que products/show) --}}
                        <div class="p-4 bg-surface-container-highest">
                            <a href="{{ $waTratoBase }}" target="_blank"
                               class="w-full py-3.5 bg-[#25D366] text-white rounded-xl font-bold flex items-center justify-center gap-3 hover:opacity-90 transition-all shadow-md">
                                <svg fill="currentColor" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.417-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.305 1.652zm6.599-3.835c1.405.836 3.125 1.333 4.909 1.334 5.431 0 9.851-4.42 9.854-9.853.002-5.439-4.417-9.856-9.854-9.856-5.432 0-9.853 4.42-9.855 9.855-.001 1.925.548 3.797 1.586 5.404l-.991 3.616 3.702-.971zm10.109-6.954c-.302-.151-1.785-.882-2.062-.982-.277-.1-.478-.151-.68.151-.202.302-.782.982-.958 1.183-.176.201-.352.226-.654.076-.302-.151-1.274-.469-2.426-1.496-.897-.8-1.501-1.788-1.677-2.09-.176-.302-.019-.465.132-.614.136-.134.302-.352.453-.528.151-.176.201-.302.302-.503.101-.201.05-.377-.025-.528-.075-.151-.68-1.636-.932-2.246-.247-.591-.497-.512-.68-.522l-.579-.011c-.201 0-.528.075-.805.377-.277.301-1.057 1.031-1.057 2.515 0 1.485 1.082 2.919 1.233 3.121.151.201 2.13 3.253 5.159 4.561.72.311 1.282.497 1.719.637.724.23 1.383.197 1.903.12.58-.086 1.785-.73 2.037-1.435.252-.704.252-1.308.176-1.434-.075-.126-.276-.201-.578-.352z"/>
                                </svg>
                                CONCRETAR POR WHATSAPP
                            </a>
                        </div>
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

@push('scripts')
<script>
    const tratoChatBox = document.getElementById('trato-chat-messages');

    // Envía una burbuja predefinida al chat del comprador dentro de tratos/show
    function sendTratoMessage(text) {
        // Elimina el placeholder inicial
        tratoChatBox.innerHTML = '';
        tratoChatBox.classList.remove('flex', 'items-center', 'justify-center');
        tratoChatBox.classList.add('space-y-3', 'p-5');

        const now = new Date().toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit' });

        // Inserta el mensaje como burbuja enviada (derecha, estilo comprador)
        tratoChatBox.insertAdjacentHTML('beforeend', `
            <div class="flex flex-col items-end max-w-[80%] ml-auto">
                <div class="bg-primary-container text-on-primary-container px-4 py-3 rounded-2xl rounded-tr-none shadow-sm">
                    <p class="text-body-sm">${escHtml(text)}</p>
                </div>
                <span class="text-[10px] text-outline mt-1 mr-1 flex items-center gap-1">
                    ${now}
                    <span class="material-symbols-outlined" style="font-size:12px;font-variation-settings:'FILL' 1">done_all</span>
                </span>
            </div>
        `);
        tratoChatBox.scrollTop = tratoChatBox.scrollHeight;
    }

    // Escapa HTML para evitar inyección en innerHTML
    function escHtml(str) {
        const d = document.createElement('div');
        d.appendChild(document.createTextNode(str));
        return d.innerHTML;
    }
</script>
@endpush

@push('scripts')
<script>
    const ratingInput = document.getElementById('rating-value');
    const starBtns = document.querySelectorAll('.star-btn');

    // Al hacer clic: fija el rating y lo guarda en el input oculto del formulario
    starBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const selected = parseInt(btn.dataset.star);
            ratingInput.value = selected;
            paintStars(selected);
        });

        // Hover: muestra una vista previa de cuántas estrellas quedarían
        btn.addEventListener('mouseenter', () => {
            paintStars(parseInt(btn.dataset.star));
        });
    });

    // Al salir del hover vuelve al valor seleccionado (o vacío si no hay ninguno)
    document.getElementById('star-rating').addEventListener('mouseleave', () => {
        paintStars(parseInt(ratingInput.value) || 0);
    });

    // Pinta visualmente N estrellas rellenas y el resto vacías
    function paintStars(n) {
        starBtns.forEach((s, i) => {
            s.style.fontVariationSettings = i < n ? "'FILL' 1" : "'FILL' 0";
            s.classList.toggle('text-secondary-container', i < n);
            s.classList.toggle('text-outline-variant', i >= n);
        });
    }
</script>
@endpush
