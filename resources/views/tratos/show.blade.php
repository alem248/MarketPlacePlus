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
    @include('partials.client-navbar')

    <div class="flex max-w-container-max mx-auto min-h-[calc(100vh-64px)]">

        {{-- ===================== SIDEBAR ===================== --}}
        @include('partials.client-sidebar', ['activeClientTab' => 'tratos'])

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
                                {{-- Desplaza a la sección de chat --}}
                                <button type="button"
                                        onclick="document.getElementById('buyer-chat-section').scrollIntoView({behavior:'smooth'})"
                                        class="p-3 text-primary hover:bg-primary-fixed rounded-xl transition-colors border border-outline-variant">
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

                            {{-- Método de pago: se guarda en BD vía PATCH --}}
                            <div class="space-y-2">
                                <label class="text-body-sm text-on-surface-variant font-medium block">
                                    Método de Pago:
                                </label>
                                <form action="{{ route('tratos.payment', $trato) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input name="payment_method"
                                           class="flex-1 bg-surface-container-low border border-outline-variant rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-bold text-on-surface"
                                           type="text"
                                           value="{{ $trato->payment_method ?? '' }}"
                                           placeholder="Ej: Transferencia Bancaria, Yape...">
                                    <button type="submit"
                                            class="px-3 py-2 bg-primary text-on-primary rounded-xl font-bold text-body-sm hover:opacity-90 transition-opacity shrink-0">
                                        <span class="material-symbols-outlined text-[18px]">save</span>
                                    </button>
                                </form>
                                @if(session('success') && str_contains(session('success'), 'pago'))
                                    <p class="text-[11px] text-green-600">✓ Guardado</p>
                                @endif
                            </div>
                        </div>

                        {{-- Botón cancelar trato --}}
                        <div class="mt-6 pt-6 border-t border-outline-variant">
                            @if($canCancel)
                                <form action="{{ route('tratos.cancel', $trato) }}" method="POST"
                                      onsubmit="return confirm('¿Estás seguro de que deseas cancelar este trato?')">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center justify-center gap-2 px-4 py-2 border-2 border-error text-error hover:bg-error-container/10 transition-colors rounded-xl font-bold text-body-sm">
                                        <span class="material-symbols-outlined">cancel</span>
                                        Cancelar Trato
                                    </button>
                                </form>
                                <p class="text-[10px] text-on-surface-variant text-center mt-2 italic">
                                    * Solo se puede cancelar antes de marcar como recibido.
                                </p>
                            @else
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

                                {{-- Paso 4: Recibido — el comprador confirma su recepción --}}
                                @php $step4Done = $statusOrder >= 4; @endphp
                                <div class="flex flex-col items-center gap-5 {{ !$step4Done && $trato->status !== 'aprobado' ? 'opacity-40' : '' }}">
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
                                    @if($step4Done)
                                        {{-- Ambos confirmaron: bloqueado definitivamente --}}
                                        <input type="checkbox" checked disabled
                                               class="w-5 h-5 rounded border-secondary-container text-secondary-container cursor-default">
                                    @elseif($trato->buyer_confirmed && !$trato->seller_confirmed)
                                        {{-- Solo yo confirmé: puedo deshacer porque el vendedor aún no marcó --}}
                                        <form action="{{ route('tratos.received.undo', $trato) }}" method="POST">
                                            @csrf
                                            <button type="submit" title="Deshacer confirmación"
                                                    class="w-5 h-5 rounded bg-secondary-container text-on-secondary-container hover:brightness-90 transition-all cursor-pointer flex items-center justify-center text-[10px] font-bold">
                                                ✓
                                            </button>
                                        </form>
                                        <p class="text-[10px] text-outline text-center -mt-3 italic">Toca para deshacer</p>
                                    @elseif($trato->status === 'aprobado')
                                        {{-- Aún no confirmé: botón para confirmar --}}
                                        <form action="{{ route('tratos.received', $trato) }}" method="POST">
                                            @csrf
                                            <button type="submit" title="Confirmar que recibí el producto"
                                                    class="w-5 h-5 rounded border-2 border-primary bg-surface-container-lowest hover:bg-primary/10 transition-colors cursor-pointer flex items-center justify-center">
                                            </button>
                                        </form>
                                        <p class="text-[10px] text-primary text-center -mt-3 italic">Confirmar recepción</p>
                                    @else
                                        <input type="checkbox" disabled
                                               class="w-5 h-5 rounded border-outline-variant text-primary cursor-not-allowed">
                                    @endif
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
                    <div id="buyer-chat-section" class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm flex flex-col overflow-hidden">

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

                        {{-- Área de mensajes del chat --}}
                        <div id="trato-chat-messages"
                             class="p-5 min-h-[140px] bg-surface-container-lowest space-y-3 max-h-64 overflow-y-auto">
                            @forelse($trato->messages as $msg)
                                @php $isMine = $msg->sender_id === auth()->id(); @endphp
                                <div class="flex flex-col {{ $isMine ? 'items-end' : 'items-start' }} max-w-[80%] {{ $isMine ? 'ml-auto' : '' }}">
                                    <div class="{{ $isMine ? 'bg-primary-container text-on-primary-container rounded-tr-none' : 'bg-surface-container text-on-surface rounded-tl-none' }} px-4 py-3 rounded-2xl shadow-sm">
                                        <p class="text-body-sm">{{ $msg->body }}</p>
                                    </div>
                                    <span class="text-[10px] text-outline mt-1 {{ $isMine ? 'mr-1' : 'ml-1' }}">
                                        {{ $msg->sender->first_name }} · {{ $msg->created_at->format('h:i A') }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-body-sm text-outline text-center italic">
                                    Usa los mensajes de abajo para iniciar la conversación
                                </p>
                            @endforelse
                        </div>

                        {{-- Formulario oculto para enviar mensajes predefinidos --}}
                        <form id="buyer-msg-form" action="{{ route('tratos.messages.store', $trato) }}" method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="body" id="buyer-msg-body">
                        </form>

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
                                    <button onclick="sendBuyerMessage('¿Sigue disponible?')"
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
                                    <button onclick="sendBuyerMessage('Me interesa adquirir el producto')"
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

                            {{-- Opción cancelar trato --}}
                            @if($canCancel)
                            <div class="mt-3 pt-3 border-t border-outline-variant/50">
                                <form action="{{ route('tratos.cancel', $trato) }}" method="POST"
                                      onsubmit="return confirm('¿Estás seguro de que deseas cancelar este trato?')">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left flex items-center gap-1.5 text-[11px] text-error/70 hover:text-error transition-colors px-1 py-1">
                                        <span class="material-symbols-outlined text-[14px]">cancel</span>
                                        Cancelar este trato
                                    </button>
                                </form>
                            </div>
                            @endif
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

    @include('partials.footer')

</div>
@endsection

@push('scripts')
<script>
    // Auto-scroll al último mensaje del chat al cargar
    const chatBox = document.getElementById('trato-chat-messages');
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;

    // Envía un mensaje predefinido al backend (guarda en BD y recarga la página)
    function sendBuyerMessage(text) {
        document.getElementById('buyer-msg-body').value = text;
        document.getElementById('buyer-msg-form').submit();
    }

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
