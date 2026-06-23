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

    @include('partials.seller-navbar')

    <div class="flex pt-16 min-h-screen">

        @include('partials.seller-sidebar', ['activeSellerTab' => 'tratos'])

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
                        <a href="{{ route('seller.comprobantes.index') }}"
                           class="bg-secondary-container hover:bg-secondary transition-all text-on-primary hover:text-on-secondary px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow-md">
                            <span class="material-symbols-outlined">receipt_long</span>
                            Ver Comprobante
                        </a>
                    @else
                        <button disabled title="Disponible cuando ambas partes marquen como recibido"
                                class="opacity-40 cursor-not-allowed bg-surface-container-high text-on-surface-variant px-5 py-2.5 rounded-xl font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined">receipt_long</span>
                            Ver Comprobante
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
                                    <form action="{{ route('seller.tratos.accept', $trato) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="w-full bg-secondary-container text-on-primary py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 hover:brightness-105 active:scale-95 transition-all shadow-md">
                                            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">check_circle</span>
                                            Aceptar Oferta
                                        </button>
                                    </form>
                                    @if($canCancel)
                                        <form action="{{ route('seller.tratos.reject', $trato) }}" method="POST"
                                              onsubmit="return confirm('¿Rechazar este trato?')">
                                            @csrf
                                            <button type="submit"
                                                    class="w-full border-2 border-outline-variant text-on-surface-variant py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-surface-container-low active:scale-95 transition-all">
                                                <span class="material-symbols-outlined">cancel</span>
                                                Rechazar Trato
                                            </button>
                                        </form>
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
                        {{-- data-width evita expresiones Blade en style="" que confunden el linter CSS --}}
                        <div class="relative h-2 bg-surface-container-high rounded-full mb-8 overflow-hidden">
                            <div class="h-2 bg-secondary-container rounded-full transition-all duration-700 js-progress-bar"
                                 data-width="{{ $progressPct }}"></div>
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
                                    @if($step2)
                                        <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1">forum</span>
                                    @else
                                        <span class="material-symbols-outlined text-[18px]">forum</span>
                                    @endif
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
                                    @if($step3)
                                        <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1">verified</span>
                                    @else
                                        <span class="material-symbols-outlined text-[18px]">verified</span>
                                    @endif
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

                                    {{-- Checkbox del VENDEDOR (yo): conectado al backend --}}
                                    @if($step4)
                                        {{-- Ambos confirmaron: bloqueado definitivamente --}}
                                        <label class="flex items-center gap-3">
                                            <input type="checkbox" checked disabled
                                                   class="w-5 h-5 rounded accent-secondary-container cursor-default">
                                            <span class="text-body-sm text-on-surface">
                                                Yo confirmo que entregué el producto
                                            </span>
                                        </label>
                                    @elseif($trato->seller_confirmed && !$trato->buyer_confirmed)
                                        {{-- Solo yo confirmé: puedo deshacer porque el comprador aún no marcó --}}
                                        <form action="{{ route('seller.tratos.delivered.undo', $trato) }}" method="POST"
                                              class="flex items-center gap-3">
                                            @csrf
                                            <button type="submit" title="Deshacer confirmación"
                                                    class="w-5 h-5 rounded bg-secondary-container text-on-secondary-container hover:brightness-90 transition-all cursor-pointer shrink-0 flex items-center justify-center text-[10px] font-bold">
                                                ✓
                                            </button>
                                            <span class="text-body-sm text-outline italic">
                                                Confirmado — toca para deshacer
                                            </span>
                                        </form>
                                    @elseif($trato->status === 'aprobado')
                                        {{-- Aún no confirmé: botón para confirmar --}}
                                        <form action="{{ route('seller.tratos.delivered', $trato) }}" method="POST"
                                              class="flex items-center gap-3">
                                            @csrf
                                            <button type="submit"
                                                    class="w-5 h-5 rounded border-2 border-primary bg-surface-container-lowest hover:bg-primary/10 transition-colors cursor-pointer shrink-0 flex items-center justify-center">
                                            </button>
                                            <span class="text-body-sm text-primary font-medium cursor-pointer">
                                                Confirmar que entregué el producto
                                            </span>
                                        </form>
                                    @else
                                        <label class="flex items-center gap-3 opacity-50">
                                            <input type="checkbox" disabled
                                                   class="w-5 h-5 rounded accent-secondary-container cursor-not-allowed">
                                            <span class="text-body-sm text-on-surface-variant">
                                                Yo confirmo que entregué el producto
                                            </span>
                                        </label>
                                    @endif

                                    {{-- Checkbox del COMPRADOR: solo lectura, refleja estado real --}}
                                    <label class="flex items-center gap-3 {{ $trato->buyer_confirmed ? '' : 'opacity-60' }}">
                                        <input type="checkbox" {{ $trato->buyer_confirmed ? 'checked' : '' }} disabled
                                               class="w-5 h-5 rounded accent-secondary-container cursor-not-allowed">
                                        <span class="text-body-sm text-on-surface-variant">
                                            Comprador confirma que lo recibió
                                            @if(!$trato->buyer_confirmed && !$step4)
                                                <span class="text-[10px] italic text-outline ml-1">(pendiente)</span>
                                            @endif
                                        </span>
                                    </label>
                                </div>

                                @if($trato->seller_confirmed && !$trato->buyer_confirmed && !$step4)
                                    <div class="mt-3 ml-12 p-2 bg-secondary-fixed/30 rounded-lg border border-secondary-container/20">
                                        <p class="text-[11px] text-on-surface-variant italic flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">hourglass_empty</span>
                                            Esperando que el comprador confirme la recepción...
                                        </p>
                                    </div>
                                @endif
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
                    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm flex flex-col min-h-[480px] max-h-[600px]">

                        {{-- Header del chat --}}
                        <div class="px-5 py-3 border-b border-outline-variant bg-surface-bright shrink-0 rounded-t-xl">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-tertiary animate-pulse shrink-0"></div>
                                    <div>
                                        <h3 class="font-bold text-on-surface text-body-sm">
                                            Chat con {{ $trato->buyer->first_name }}
                                        </h3>
                                        <p class="text-[10px] text-on-surface-variant">
                                            Solo mensajes predeterminados — coordina por WhatsApp
                                        </p>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded-full {{ $badgeBg }} {{ $badgeText }} text-[10px] font-bold uppercase tracking-wider">
                                    {{ $trato->status_label }}
                                </span>
                            </div>
                        </div>

                        {{-- Historial de mensajes --}}
                        <div id="chat-messages"
                             class="flex-1 overflow-y-auto p-4 bg-surface-dim/20 space-y-2 min-h-[120px]">
                            @forelse($trato->messages as $msg)
                                @php $isMine = $msg->sender_id === auth()->id(); @endphp
                                <div class="flex flex-col {{ $isMine ? 'items-end' : 'items-start' }} max-w-[80%] {{ $isMine ? 'ml-auto' : '' }}">
                                    <div class="{{ $isMine ? 'bg-primary text-on-primary rounded-tr-none' : 'bg-surface-container text-on-surface rounded-tl-none' }} px-3 py-2 rounded-2xl shadow-sm">
                                        <p class="text-body-sm">{{ $msg->body }}</p>
                                    </div>
                                    <span class="text-[10px] text-on-surface-variant mt-0.5 {{ $isMine ? 'mr-1' : 'ml-1' }}">
                                        {{ $msg->sender->first_name }} · {{ $msg->created_at->format('h:i A') }}
                                    </span>
                                </div>
                            @empty
                                <div class="flex items-center justify-center h-full py-6">
                                    <p class="text-body-sm text-outline text-center italic">
                                        Usa los mensajes de abajo para responder al comprador
                                    </p>
                                </div>
                            @endforelse
                            <div id="chat-bottom"></div>
                        </div>

                        {{-- Formulario oculto para respuestas predefinidas --}}
                        <form id="seller-quick-form"
                              action="{{ route('seller.tratos.messages.store', $trato) }}"
                              method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="body" id="seller-quick-body">
                        </form>

                        {{-- Sección de respuestas predefinidas compacta --}}
                        <div class="border-t border-outline-variant bg-surface-bright shrink-0 rounded-b-xl overflow-y-auto max-h-[260px]">
                            <div class="p-4 space-y-4">

                                {{-- Mensajes típicos del comprador (referencia) + WA directo --}}
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant mb-2 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">person</span>
                                        Recibiste
                                    </p>
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2">
                                            <div class="bg-surface-container text-on-surface px-3 py-2 rounded-2xl rounded-tl-none text-body-sm border border-outline-variant/40 flex-1">
                                                ¿Sigue disponible?
                                            </div>
                                            <a href="{{ $waDisponible }}" target="_blank" title="Responder por WhatsApp"
                                               class="w-8 h-8 rounded-xl bg-[#25D366] flex items-center justify-center text-white shrink-0 hover:brightness-110 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/></svg>
                                            </a>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="bg-surface-container text-on-surface px-3 py-2 rounded-2xl rounded-tl-none text-body-sm border border-outline-variant/40 flex-1">
                                                Me interesa adquirir el producto
                                            </div>
                                            <a href="{{ $waInteresa }}" target="_blank" title="Abrir WhatsApp"
                                               class="w-8 h-8 rounded-xl bg-[#25D366] flex items-center justify-center text-white shrink-0 hover:brightness-110 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Divisor --}}
                                <div class="flex items-center gap-2">
                                    <div class="h-px flex-1 bg-outline-variant"></div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant">Tu respuesta</span>
                                    <div class="h-px flex-1 bg-outline-variant"></div>
                                </div>

                                {{-- Respuestas del vendedor --}}
                                <div class="flex flex-col items-end gap-1.5">
                                    <button onclick="sendSellerQuick('Sí, sigue disponible. ¡Hablemos por WhatsApp para coordinar!')"
                                            class="group">
                                        <div class="bg-primary text-on-primary px-3 py-2 rounded-2xl rounded-tr-none text-body-sm group-hover:brightness-110 group-active:scale-[0.98] transition-all flex items-center gap-1.5">
                                            Sí, sigue disponible. ¡Hablemos por WhatsApp!
                                            <span class="material-symbols-outlined text-[13px] opacity-60">send</span>
                                        </div>
                                    </button>
                                    <button onclick="sendSellerQuick('Lo siento, ya no está disponible.')"
                                            class="group">
                                        <div class="bg-primary text-on-primary px-3 py-2 rounded-2xl rounded-tr-none text-body-sm group-hover:brightness-110 group-active:scale-[0.98] transition-all flex items-center gap-1.5">
                                            Lo siento, ya no está disponible.
                                            <span class="material-symbols-outlined text-[13px] opacity-60">send</span>
                                        </div>
                                    </button>
                                    <a href="{{ $waHablemos }}" target="_blank" class="group">
                                        <div class="bg-[#25D366] text-white px-3 py-2 rounded-2xl rounded-tr-none text-body-sm font-bold group-hover:brightness-110 group-active:scale-[0.98] transition-all flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5 shrink-0"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/></svg>
                                            Coordinar por WhatsApp
                                        </div>
                                    </a>

                                    {{-- Rechazar trato desde el chat --}}
                                    @if($canCancel)
                                    <div class="mt-1 pt-2 border-t border-outline-variant/50 w-full text-right">
                                        <form action="{{ route('seller.tratos.reject', $trato) }}" method="POST"
                                              onsubmit="return confirm('¿Rechazar este trato?')">
                                            @csrf
                                            <button type="submit"
                                                    class="text-[11px] text-error/70 hover:text-error transition-colors flex items-center gap-1 ml-auto">
                                                <span class="material-symbols-outlined text-[13px]">cancel</span>
                                                Rechazar trato
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>

                            </div>
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
    // Aplica el ancho de la barra de progreso desde data-width
    document.querySelectorAll('.js-progress-bar').forEach(el => {
        el.style.width = el.dataset.width;
    });

    // Auto-scroll al fondo del chat al cargar la página
    document.getElementById('chat-bottom')?.scrollIntoView({ behavior: 'smooth' });
    const chatArea = document.getElementById('chat-messages');
    if (chatArea) chatArea.scrollTop = chatArea.scrollHeight;

    // Envía un mensaje predefinido del vendedor al backend (guarda en BD)
    function sendSellerQuick(text) {
        document.getElementById('seller-quick-body').value = text;
        document.getElementById('seller-quick-form').submit();
    }
</script>
@endpush
