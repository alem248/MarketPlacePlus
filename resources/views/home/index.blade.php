@extends('layouts.app')

@section('title', 'Inicio | MarketPlace Plus')

@section('content')
<div class="flex flex-col min-h-screen">

    {{-- TopNavBar --}}
    <header class="bg-surface-container-lowest border-b border-outline-variant sticky top-0 w-full z-50">
        <div class="flex items-center justify-between w-full max-w-container-max mx-auto px-margin-mobile py-4 gap-gutter">
            <div class="text-headline-lg font-headline-lg text-primary tracking-tight shrink-0">
                MarketPlace Plus
            </div>
            <div class="flex-1 max-w-2xl relative hidden md:block">
                <input class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-6 py-3 focus:outline-none focus:ring-2 focus:ring-primary/20"
                    placeholder="¿Qué vamos a comprar hoy?" type="text">
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            </div>
            <div class="flex items-center gap-4 text-primary">
                <a href="{{ route('home') }}" class="p-2 hover:bg-surface-container-low rounded-full transition-colors">
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">home</span>
                </a>
                {{-- Favoritos - Próximamente --}}
                <button class="p-2 hover:bg-surface-container-low rounded-full transition-colors btn-soon" title="Próximamente">
                    <span class="material-symbols-outlined">favorite</span>
                </button>
                <a href="{{ route('tratos.index') }}" class="p-2 hover:bg-surface-container-low rounded-full transition-colors" title="Mis Tratos">
                    <span class="material-symbols-outlined">handshake</span>
                </a>
                {{-- Avatar / menú de usuario --}}
                <div class="relative" x-data="{ open: false }">
                    <button onclick="this.nextElementSibling.classList.toggle('hidden')"
                        class="p-1 hover:bg-surface-container-low rounded-full border border-outline-variant">
                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary text-sm font-bold">
                            {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                        </div>
                    </button>
                    <div class="hidden absolute right-0 top-12 w-48 bg-surface-container-lowest border border-outline-variant rounded-xl shadow-lg z-50">
                        <div class="p-4 border-b border-outline-variant">
                            <p class="font-bold text-on-surface text-sm">{{ auth()->user()->full_name }}</p>
                            <p class="text-xs text-on-surface-variant truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('seller.products.create') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-surface-container-low transition-colors">
                            <span class="material-symbols-outlined text-[18px]">add_circle</span> Publicar producto
                        </a>
                        <a href="{{ route('tratos.index') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-surface-container-low transition-colors">
                            <span class="material-symbols-outlined text-[18px]">handshake</span> Mis Tratos
                        </a>
                        <div class="border-t border-outline-variant">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-3 text-sm text-error hover:bg-error-container transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">logout</span> Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-container-max mx-auto w-full px-margin-mobile md:px-gutter py-8">

        {{-- Flash de éxito (ej. tras registro) --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-tertiary-fixed text-on-tertiary-fixed rounded-xl flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Hero de bienvenida --}}
        <section class="mb-10 p-8 bg-primary rounded-xl text-on-primary flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h1 class="font-headline-lg text-headline-lg text-on-primary mb-2">
                    ¡Bienvenido, {{ auth()->user()->first_name }}! 👋
                </h1>
                <p class="text-on-primary/80 font-body-lg">¿Listo para tu próximo trato? Explora los productos disponibles.</p>
            </div>
            <a href="{{ route('seller.products.create') }}"
                class="shrink-0 flex items-center gap-2 bg-secondary-container text-on-secondary-container font-bold px-6 py-3 rounded-xl hover:opacity-90 transition-all">
                <span class="material-symbols-outlined">add</span>
                Publicar Producto
            </a>
        </section>

        {{-- Accesos rápidos --}}
        <section class="mb-10">
            <h2 class="font-headline-md text-headline-md text-on-surface mb-4">Accesos Rápidos</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('seller.products.create') }}"
                    class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col items-center gap-3 hover:shadow-md transition-all text-center">
                    <span class="material-symbols-outlined text-4xl text-secondary-container">add_circle</span>
                    <span class="font-body-lg font-semibold text-on-surface">Publicar</span>
                </a>
                <a href="{{ route('tratos.index') }}"
                    class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col items-center gap-3 hover:shadow-md transition-all text-center">
                    <span class="material-symbols-outlined text-4xl text-primary">handshake</span>
                    <span class="font-body-lg font-semibold text-on-surface">Mis Tratos</span>
                </a>
                {{-- Próximamente --}}
                <button class="btn-soon bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col items-center gap-3 text-center">
                    <span class="material-symbols-outlined text-4xl text-outline">local_shipping</span>
                    <span class="font-body-lg font-semibold text-on-surface-variant">Delivery</span>
                </button>
                <button class="btn-soon bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col items-center gap-3 text-center">
                    <span class="material-symbols-outlined text-4xl text-outline">receipt_long</span>
                    <span class="font-body-lg font-semibold text-on-surface-variant">Comprobantes</span>
                </button>
            </div>
        </section>

        {{-- Sección de productos (placeholder hasta que tengas el modelo) --}}
        <section>
            <h2 class="font-headline-md text-headline-md text-on-surface mb-4">Productos Recientes</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                {{-- Placeholder cards --}}
                @for ($i = 0; $i < 4; $i++)
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <div class="aspect-square bg-surface-container-high flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-outline-variant">inventory_2</span>
                    </div>
                    <div class="p-4 space-y-2">
                        <p class="font-headline-md text-headline-md text-on-surface leading-tight">Producto de ejemplo</p>
                        <p class="font-price-display text-price-display text-primary">S/. 0.00</p>
                        <div class="flex items-center justify-between pt-3 border-t border-outline-variant">
                            <span class="text-sm text-on-surface-variant">Lima</span>
                            <button class="btn-soon bg-secondary-container text-on-secondary-container p-2 rounded-lg">
                                <span class="material-symbols-outlined">handshake</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            <p class="text-center text-on-surface-variant text-body-sm mt-6 p-4 bg-surface-container rounded-xl">
                <span class="material-symbols-outlined text-[16px] mr-1">info</span>
                Los productos reales aparecerán aquí cuando conectes la base de datos y el modelo <strong>Product</strong>.
            </p>
        </section>

    </main>

    @include('layouts.footer')

</div>
@endsection
