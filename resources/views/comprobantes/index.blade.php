@extends('layouts.app')

@section('title', 'Mis Comprobantes - MarketPlace Plus')

@section('content')
<div class="bg-background text-on-surface font-body-lg">

    {{-- ===================== TOP NAV ===================== --}}
    <nav class="bg-surface-container-lowest border-b border-outline-variant sticky top-0 z-50">
        <div class="flex items-center justify-between w-full max-w-container-max mx-auto px-margin-mobile py-4 gap-4">
            <a href="{{ route('home') }}"
               class="text-headline-lg font-headline-lg text-primary tracking-tight shrink-0">
                MarketPlace Plus
            </a>
            <div class="flex-1 max-w-2xl mx-gutter">
                <div class="relative w-full">
                    <input class="w-full pl-10 pr-10 py-2 bg-surface-container-low border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20"
                           placeholder="¿Qué vamos a comprar hoy?" type="text">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-on-surface-variant">search</span>
                </div>
            </div>
            <div class="flex items-center gap-6 text-primary">
                <a href="{{ route('home') }}" class="material-symbols-outlined cursor-pointer hover:bg-surface-container-low p-2 rounded-full transition-colors">home</a>
                <button class="material-symbols-outlined cursor-pointer hover:bg-surface-container-low p-2 rounded-full transition-colors">favorite</button>
                <a href="{{ route('tratos.index') }}" class="material-symbols-outlined cursor-pointer hover:bg-surface-container-low p-2 rounded-full transition-colors" style="font-variation-settings:'FILL' 1">handshake</a>
                <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary font-bold border border-outline-variant">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </div>
            </div>
        </div>
    </nav>

    <div class="flex max-w-container-max mx-auto min-h-screen">

        {{-- ===================== SIDEBAR ===================== --}}
        <aside class="hidden lg:flex flex-col w-sidebar-width bg-surface-container-lowest border-r border-outline-variant p-base gap-2 sticky top-[73px] h-[calc(100vh-73px)]">
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

            <div class="px-4 mb-2">
                <a href="{{ route('seller.products.create') }}"
                   class="w-full bg-secondary-container text-on-secondary-container font-bold py-3 rounded-xl flex items-center justify-center gap-2 shadow-sm hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined">swap_horiz</span>
                    Cambiar a Vendedor
                </a>
            </div>

            <nav class="flex-1 space-y-1 px-2">
                <a href="{{ route('home') }}"
                   class="flex items-center gap-3 p-3 text-on-surface hover:bg-surface-container-low rounded-xl transition-all">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-label-caps">Panel</span>
                </a>
                <a href="{{ route('tratos.index') }}"
                   class="flex items-center gap-3 p-3 text-on-surface hover:bg-surface-container-low rounded-xl transition-all">
                    <span class="material-symbols-outlined">handshake</span>
                    <span class="text-label-caps">Mis Tratos</span>
                </a>
                <a href="{{ route('proximamente') }}"
                   class="flex items-center gap-3 p-3 text-on-surface hover:bg-surface-container-low rounded-xl transition-all">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="text-label-caps">Delivery</span>
                </a>
                {{-- Mis Comprobantes activo --}}
                <a href="{{ route('comprobantes.index') }}"
                   class="flex items-center gap-3 p-3 bg-primary text-on-primary font-bold rounded-xl shadow-sm">
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">receipt_long</span>
                    <span class="text-label-caps">Mis Comprobantes</span>
                </a>
            </nav>

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

            <div class="mb-8">
                <h1 class="text-headline-lg font-headline-lg text-on-surface">Mis Comprobantes</h1>
                <p class="text-on-surface-variant mt-2">Aquí tienes un resumen detallado de tus transacciones realizadas.</p>
            </div>

            {{-- Mensaje flash de éxito o info --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-xl flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-100 text-blue-800 rounded-xl flex items-center gap-2">
                    <span class="material-symbols-outlined">info</span>
                    {{ session('info') }}
                </div>
            @endif

            {{-- Lista de comprobantes --}}
            <div class="flex flex-col gap-6">

                @forelse($comprobantes as $comp)
                @php
                    // Imagen del producto (URL externa o storage local)
                    $imgs    = $comp->product->image_path ?? [];
                    $imgSrc  = isset($imgs[0])
                        ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0]))
                        : null;

                    // Icono del método de pago
                    $payIcon = match(strtolower($comp->payment_method)) {
                        'tarjeta'                => 'credit_card',
                        'yape', 'plin'           => 'account_balance_wallet',
                        'efectivo'               => 'payments',
                        'transferencia bancaria' => 'account_balance',
                        default                  => 'receipt',
                    };
                @endphp
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row">

                        {{-- Imagen del producto --}}
                        <div class="w-full md:w-56 h-56 md:h-auto shrink-0 bg-surface-container">
                            @if($imgSrc)
                                <img class="w-full h-full object-cover" src="{{ $imgSrc }}"
                                     alt="{{ $comp->product->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-outline" style="font-size:64px">image</span>
                                </div>
                            @endif
                        </div>

                        {{-- Datos del comprobante --}}
                        <div class="flex-1 p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-headline-md font-headline-md text-on-surface pr-4">
                                    {{ $comp->product->title }}
                                </h3>
                                <p class="text-price-display font-price-display text-primary shrink-0">
                                    S/. {{ number_format($comp->price, 2) }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-4 gap-x-8 border-t border-outline-variant pt-4">

                                <div>
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">ID Transacción</p>
                                    <p class="text-body-sm text-on-surface font-semibold">#{{ $comp->transaction_code }}</p>
                                </div>

                                <div>
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Fecha</p>
                                    <p class="text-body-sm text-on-surface font-semibold">
                                        {{ $comp->created_at->format('d M, Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Comprador</p>
                                    <p class="text-body-sm text-on-surface font-semibold">
                                        {{ $comp->buyer->first_name }} {{ $comp->buyer->last_name }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Vendedor</p>
                                    <p class="text-body-sm text-on-surface font-semibold">
                                        {{ $comp->seller->first_name }} {{ $comp->seller->last_name }}
                                    </p>
                                </div>

                                <div class="col-span-2 sm:col-span-1">
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Método de Pago</p>
                                    <p class="text-body-sm text-on-surface font-semibold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">{{ $payIcon }}</span>
                                        {{ $comp->payment_method }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @empty
                {{-- Estado vacío: aún no hay comprobantes generados --}}
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-16 text-center">
                    <span class="material-symbols-outlined text-outline" style="font-size:64px">receipt_long</span>
                    <h3 class="text-headline-md font-bold text-on-surface mt-4">Aún no tienes comprobantes</h3>
                    <p class="text-body-sm text-on-surface-variant mt-2">
                        Cuando completes un trato y lo marques como recibido, podrás generar tu comprobante desde el detalle del trato.
                    </p>
                    <a href="{{ route('tratos.index') }}"
                       class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined">handshake</span>
                        Ver mis tratos
                    </a>
                </div>
                @endforelse

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
