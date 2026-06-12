@extends('layouts.app')

@section('title', $product->title . ' - MarketPlace Plus')

@section('content')
<div class="bg-background text-on-surface font-body-lg min-h-screen">

    {{-- ===================== TOP NAV ===================== --}}
    <header class="bg-surface-container-lowest sticky top-0 z-50 border-b border-outline-variant">
        <div class="flex justify-between items-center w-full px-margin-mobile md:px-gutter py-2 max-w-container-max mx-auto h-16">

            {{-- Logo --}}
            <div class="flex items-center gap-base">
                <a href="{{ route('home') }}" class="text-headline-md font-headline-md font-bold text-primary">
                    MarketPlace Plus
                </a>
            </div>

            {{-- Buscador --}}
            <div class="hidden md:flex flex-1 max-w-xl mx-gutter">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant rounded-xl focus:outline-none focus:border-primary"
                           placeholder="¿Que vamos a comprar hoy?" type="text">
                </div>
            </div>

            {{-- Iconos de navegación + avatar --}}
            <div class="flex items-center gap-6">
                <nav class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-on-surface-variant hover:text-secondary transition-colors flex flex-col items-center">
                        <span class="material-symbols-outlined">home</span>
                        <span class="text-[10px] font-label-caps uppercase">Home</span>
                    </a>
                    <button class="text-on-surface-variant hover:text-secondary transition-colors flex flex-col items-center btn-soon">
                        <span class="material-symbols-outlined">favorite</span>
                        <span class="text-[10px] font-label-caps uppercase">Favorite</span>
                    </button>
                    <a href="{{ route('tratos.index') }}" class="text-secondary transition-colors flex flex-col items-center">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">handshake</span>
                        <span class="text-[10px] font-label-caps uppercase">Mis Tratos</span>
                    </a>
                </nav>

                {{-- Avatar del usuario autenticado --}}
                <div class="w-10 h-10 rounded-full bg-primary-fixed overflow-hidden border border-outline-variant flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary">person</span>
                </div>
            </div>
        </div>
    </header>

    {{-- ===================== LAYOUT PRINCIPAL (sidebar + contenido) ===================== --}}
    <div class="flex max-w-container-max mx-auto min-h-[calc(100vh-64px)]">

        {{-- ===================== SIDEBAR IZQUIERDO ===================== --}}
        <aside class="hidden md:flex flex-col w-sidebar-width bg-surface-container-lowest border-r border-outline-variant p-base gap-gutter">

            {{-- Tarjeta de perfil del usuario autenticado --}}
            <div class="flex flex-col items-center text-center p-4 bg-surface-container-low rounded-xl">
                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-primary mb-2 bg-surface-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary" style="font-size:32px">person</span>
                </div>
                <h3 class="text-headline-md font-headline-md text-primary">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                <p class="text-body-sm text-on-surface-variant">Comprador</p>

                {{-- Botón para cambiar a modo vendedor --}}
                <a href="{{ route('seller.products.create') }}"
                   class="mt-4 w-full py-2 bg-primary text-on-primary rounded-xl font-bold hover:opacity-90 transition-all text-center block">
                    Cambiar a Vendedor
                </a>
            </div>

            {{-- Menú de navegación lateral --}}
            <nav class="flex flex-col gap-2">
                <a href="{{ route('seller.panel') }}"
                   class="flex items-center gap-4 p-3 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-body-lg font-body-lg">Panel</span>
                </a>
                {{-- "Mis Tratos" activo porque venimos del detalle de producto --}}
                <a href="{{ route('tratos.index') }}"
                   class="flex items-center gap-4 p-3 bg-primary-container text-on-primary-container font-bold rounded-xl translate-x-1 duration-200">
                    <span class="material-symbols-outlined">handshake</span>
                    <span class="text-body-lg font-body-lg">Mis Tratos</span>
                </a>
                <a href="{{ route('proximamente') }}"
                   class="flex items-center gap-4 p-3 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="text-body-lg font-body-lg">Delivery</span>
                </a>
                <a href="{{ route('proximamente') }}"
                   class="flex items-center gap-4 p-3 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-all">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span class="text-body-lg font-body-lg">Mis Comprobantes</span>
                </a>

                <hr class="border-outline-variant my-2">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-4 p-3 text-error hover:bg-error-container/20 rounded-xl transition-all">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-body-lg font-body-lg">Cerrar sesión</span>
                    </button>
                </form>
            </nav>
        </aside>

        {{-- ===================== CONTENIDO PRINCIPAL ===================== --}}
        <main class="flex-1 p-margin-mobile md:p-gutter">

            {{-- Botón volver al catálogo --}}
            <div class="mb-gutter flex items-center gap-base">
                <button onclick="history.back()"
                        class="flex items-center gap-2 text-primary hover:underline transition-all">
                    <span class="material-symbols-outlined">arrow_back</span>
                    <span class="font-bold">Volver al catálogo</span>
                </button>
            </div>

            {{-- ===== GRID: galería/descripción (izq) + acciones/chat (der) ===== --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">

                {{-- ============ COLUMNA IZQUIERDA: Galería + Descripción ============ --}}
                <div class="lg:col-span-7 flex flex-col gap-gutter">

                    {{-- Galería de imágenes --}}
                    <div class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm overflow-hidden">

                        {{-- Imagen principal --}}
                        <div class="aspect-video w-full mb-gutter rounded-lg overflow-hidden bg-surface-container">
                            @php
                                // Primera imagen del array como imagen principal
                                $images = $product->image_path ?? [];
                                $mainImage = $images[0] ?? null;
                            @endphp
                            @if($mainImage)
                                <img id="main-product-image"
                                     class="w-full h-full object-cover"
                                     src="{{ Str::startsWith($mainImage, 'http') ? $mainImage : Storage::url($mainImage) }}"
                                     alt="{{ $product->title }}">
                            @else
                                {{-- Placeholder si no hay imagen --}}
                                <div class="w-full h-full flex items-center justify-center bg-surface-container-high">
                                    <span class="material-symbols-outlined text-outline" style="font-size:64px">image</span>
                                </div>
                            @endif
                        </div>

                        {{-- Miniaturas: resto de imágenes del array --}}
                        <div class="grid grid-cols-4 gap-base">
                            @foreach($images as $index => $img)
                                @php
                                    $src = Str::startsWith($img, 'http') ? $img : Storage::url($img);
                                @endphp
                                <button class="aspect-square {{ $index === 0 ? 'border-2 border-primary' : 'border border-outline-variant hover:border-primary' }} rounded-lg overflow-hidden transition-all"
                                        onclick="document.getElementById('main-product-image').src='{{ $src }}'">
                                    <img class="w-full h-full object-cover" src="{{ $src }}" alt="Imagen {{ $index + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Descripción del producto --}}
                    <div class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant">
                        <h2 class="text-headline-md font-headline-md text-primary mb-4">Descripción</h2>
                        <div class="space-y-4 text-on-surface-variant">
                            {{-- nl2br convierte los saltos de línea del texto en <br> para el HTML --}}
                            {!! nl2br(e($product->description)) !!}
                        </div>

                        {{-- Etiquetas y ubicación --}}
                        <div class="mt-8 pt-6 border-t border-outline-variant">
                            <div class="space-y-6">

                                {{-- Etiquetas (tags) del producto --}}
                                @if(!empty($product->tags))
                                <div>
                                    <h3 class="text-body-sm font-bold text-outline mb-3 uppercase tracking-wider">Etiquetas</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($product->tags as $tag)
                                            <span class="px-4 py-1.5 bg-surface-container-high text-on-surface-variant rounded-full text-body-sm font-semibold hover:bg-primary-container hover:text-on-primary-container transition-colors cursor-pointer">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                {{-- Ubicación del producto --}}
                                @if($product->location)
                                <div>
                                    <h3 class="text-body-sm font-bold text-outline mb-3 uppercase tracking-wider">Ubicación</h3>
                                    <div class="flex flex-wrap gap-2">
                                        {{-- Separamos "Lima - San Isidro" en dos chips --}}
                                        @foreach(explode(' - ', $product->location) as $place)
                                            <span class="px-4 py-1.5 bg-surface-container-high text-on-surface-variant rounded-full text-body-sm font-semibold hover:bg-primary-container hover:text-on-primary-container transition-colors cursor-pointer">
                                                {{ trim($place) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============ COLUMNA DERECHA: Info + Botones + Chat ============ --}}
                <div class="lg:col-span-5 flex flex-col gap-gutter">

                    {{-- Tarjeta principal de compra --}}
                    <div class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm">

                        {{-- Condición del producto --}}
                        <div class="flex justify-between items-start mb-base">
                            @if($product->condition)
                                <span class="px-3 py-1 bg-primary-container text-on-primary-container rounded-full text-label-caps font-label-caps uppercase">
                                    {{ $product->condition }}
                                </span>
                            @else
                                <span></span>
                            @endif

                            {{-- Estrellas decorativas (no hay sistema de rating aún) --}}
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-secondary" style="font-size:20px; font-variation-settings:'FILL' 1">star</span>
                                <span class="material-symbols-outlined text-secondary" style="font-size:20px; font-variation-settings:'FILL' 1">star</span>
                                <span class="material-symbols-outlined text-secondary" style="font-size:20px; font-variation-settings:'FILL' 1">star</span>
                                <span class="material-symbols-outlined text-secondary" style="font-size:20px; font-variation-settings:'FILL' 1">star</span>
                                <span class="material-symbols-outlined text-outline" style="font-size:20px;">star</span>
                            </div>
                        </div>

                        {{-- Título y precio --}}
                        <h1 class="text-headline-lg font-headline-lg text-on-surface mb-2">{{ $product->title }}</h1>
                        <p class="text-price-display font-price-display text-secondary mb-gutter">
                            S/ {{ number_format($product->price, 2) }}
                        </p>

                        {{-- Info del vendedor --}}
                        <div class="flex items-center gap-gutter p-4 bg-surface-container-low rounded-xl mb-gutter">
                            <div class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-primary">person</span>
                            </div>
                            <div>
                                <p class="font-bold text-on-surface">
                                    {{ $product->user->first_name }} {{ $product->user->last_name }}
                                </p>
                                <p class="text-body-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    Vendedor Verificado
                                </p>
                            </div>
                        </div>

                        {{-- Botón Trato Directo (enlaza a la sección de tratos) --}}
                        <a href="{{ route('tratos.index') }}"
                           class="w-full py-4 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-4 hover:scale-[1.02] active:scale-95 transition-all mb-4 h-14">
                            <span class="material-symbols-outlined">handshake</span>
                            TRATO DIRECTO
                        </a>
                    </div>

                    {{-- ======== CHAT ======== --}}
                    {{-- De momento vacío: sin mensajes reales, solo preguntas frecuentes --}}
                    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-lg flex flex-col h-[500px] overflow-hidden">

                        {{-- Cabecera del chat --}}
                        <div class="p-4 bg-surface-container-high border-b border-outline-variant flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">chat_bubble</span>
                                <span class="font-bold text-primary">
                                    Chat con {{ $product->user->first_name }}
                                </span>
                            </div>
                            <span class="text-body-sm text-green-600 font-bold">En línea</span>
                        </div>

                        {{-- Área de mensajes: vacía hasta que el usuario inicie la conversación --}}
                        <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-4 bg-surface-container-lowest flex items-center justify-center">
                            <p class="text-body-sm text-outline text-center">
                                Usa las preguntas de abajo para iniciar la conversación
                            </p>
                        </div>

                        {{-- Preguntas frecuentes predefinidas --}}
                        <div class="p-4 bg-surface-container-low border-t border-outline-variant">
                            <p class="text-[10px] font-label-caps text-outline mb-2 uppercase">Preguntas frecuentes</p>
                            <div class="flex flex-wrap gap-2">
                                <button class="suggestion-btn px-3 py-1 bg-surface-container-lowest border border-outline-variant rounded-full text-body-sm hover:border-primary transition-all">
                                    ¿Cuál es el precio final?
                                </button>
                                <button class="suggestion-btn px-3 py-1 bg-surface-container-lowest border border-outline-variant rounded-full text-body-sm hover:border-primary transition-all">
                                    ¿Haces envíos a provincia?
                                </button>
                                <button class="suggestion-btn px-3 py-1 bg-surface-container-lowest border border-outline-variant rounded-full text-body-sm hover:border-primary transition-all">
                                    ¿Viene con garantía?
                                </button>
                            </div>
                        </div>

                        {{-- Botón WhatsApp: usa el teléfono del vendedor si está registrado --}}
                        <div class="p-4 bg-surface-container-highest">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->user->phone ?? '') }}"
                               target="_blank"
                               class="w-full py-4 bg-[#25D366] text-white rounded-xl font-bold flex items-center justify-center gap-4 hover:opacity-90 transition-all shadow-md">
                                {{-- Ícono SVG de WhatsApp --}}
                                <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
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
    // Resalta la miniatura activa al hacer click
    document.querySelectorAll('[onclick*="main-product-image"]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('[onclick*="main-product-image"]').forEach(b => {
                b.classList.remove('border-2', 'border-primary');
                b.classList.add('border', 'border-outline-variant');
            });
            btn.classList.add('border-2', 'border-primary');
            btn.classList.remove('border', 'border-outline-variant');
        });
    });

    // Al hacer click en una pregunta frecuente, la muestra como mensaje enviado en el chat
    const chatMessages = document.getElementById('chat-messages');
    document.querySelectorAll('.suggestion-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Limpia el mensaje placeholder si existe
            chatMessages.innerHTML = '';

            // Agrega el mensaje del usuario
            chatMessages.insertAdjacentHTML('beforeend', `
                <div class="flex flex-col items-end max-w-[80%] ml-auto">
                    <div class="bg-primary-container text-on-primary-container p-3 rounded-2xl rounded-tr-none">
                        <p class="text-body-sm">${btn.innerText}</p>
                    </div>
                    <span class="text-[10px] text-outline mt-1 mr-1">Ahora</span>
                </div>
            `);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    });
</script>
@endpush
