@extends('layouts.app')

@section('title', 'Mis Tratos | MarketPlace Plus')

@section('content')
<div class="bg-background text-on-surface font-body-lg overflow-x-hidden min-h-screen flex flex-col">

    {{-- TopNavBar --}}
    <header class="bg-surface-container-lowest border-b border-outline-variant top-0 w-full z-50 sticky">
        <div class="flex items-center justify-between w-full max-w-container-max mx-auto px-margin-mobile py-4 gap-gutter">
            <a href="{{ route('home') }}" class="text-headline-lg font-headline-lg text-primary tracking-tight shrink-0">
                MarketPlace Plus
            </a>
            <div class="flex-1 max-w-2xl relative hidden md:block">
                <input class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-6 py-3 focus:outline-none focus:ring-2 focus:ring-primary/20"
                    placeholder="¿Qué vamos a comprar hoy?" type="text">
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            </div>
            <div class="flex items-center gap-6 text-primary">
                <a href="{{ route('home') }}" class="p-2 hover:bg-surface-container-low rounded-full transition-colors">
                    <span class="material-symbols-outlined">home</span>
                </a>
                <button class="btn-soon p-2 hover:bg-surface-container-low rounded-full transition-colors">
                    <span class="material-symbols-outlined">favorite</span>
                </button>
                <a href="{{ route('tratos.index') }}" class="p-2 hover:bg-surface-container-low rounded-full transition-colors">
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">handshake</span>
                </a>
                <div class="p-1 hover:bg-surface-container-low rounded-full border border-outline-variant">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex max-w-container-max mx-auto w-full min-h-[calc(100vh-80px)]">

        {{-- SideNavBar --}}
        <aside class="hidden lg:flex flex-col p-6 gap-6 bg-surface-container-lowest border-r border-outline-variant w-[280px] shrink-0 sticky top-[80px] h-[calc(100vh-80px)] overflow-y-auto">
            <div class="flex flex-col items-center text-center gap-2">
                <div class="w-24 h-24 rounded-xl bg-primary flex items-center justify-center text-on-primary text-4xl font-bold border-2 border-primary">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </div>
                <p class="font-bold text-on-surface">{{ auth()->user()->full_name }}</p>
                <p class="text-on-surface-variant text-sm">{{ auth()->user()->email }}</p>
            </div>
            <nav class="space-y-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-on-surface-variant hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined">home</span> Inicio
                </a>
                <a href="{{ route('tratos.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-secondary-container text-on-secondary-container font-bold">
                    <span class="material-symbols-outlined">handshake</span> Mis Tratos
                </a>
                <a href="{{ route('seller.products.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-on-surface-variant hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined">add_circle</span> Publicar Producto
                </a>
                <button class="btn-soon w-full flex items-center gap-3 px-4 py-3 rounded-xl text-on-surface-variant">
                    <span class="material-symbols-outlined">local_shipping</span> Delivery
                </button>
                <button class="btn-soon w-full flex items-center gap-3 px-4 py-3 rounded-xl text-on-surface-variant">
                    <span class="material-symbols-outlined">receipt_long</span> Comprobantes
                </button>
                <button class="btn-soon w-full flex items-center gap-3 px-4 py-3 rounded-xl text-on-surface-variant">
                    <span class="material-symbols-outlined">settings</span> Configuración
                </button>
                <div class="pt-4 border-t border-outline-variant">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-error hover:bg-error-container transition-colors">
                            <span class="material-symbols-outlined">logout</span> Cerrar sesión
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- Main --}}
        <main class="flex-1 p-6 overflow-y-auto">

            {{-- Header de sección --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface">Mis Tratos</h1>
                    <p class="text-on-surface-variant text-body-sm mt-1">Gestiona tus acuerdos con compradores y vendedores</p>
                </div>
                <a href="{{ route('seller.products.create') }}"
                    class="flex items-center gap-2 bg-secondary-container text-on-secondary-container font-bold px-5 py-2.5 rounded-xl hover:opacity-90 transition-all shrink-0">
                    <span class="material-symbols-outlined">add</span>
                    Nueva Publicación
                </a>
            </div>

            {{-- Tabs de estado --}}
            <div class="flex gap-2 mb-6 overflow-x-auto no-scrollbar">
                <button class="px-5 py-2 rounded-full bg-primary text-on-primary font-bold text-body-sm shrink-0">Todos</button>
                <button class="btn-soon px-5 py-2 rounded-full border border-outline-variant text-on-surface-variant font-bold text-body-sm shrink-0">En Discusión</button>
                <button class="btn-soon px-5 py-2 rounded-full border border-outline-variant text-on-surface-variant font-bold text-body-sm shrink-0">Acordados</button>
                <button class="btn-soon px-5 py-2 rounded-full border border-outline-variant text-on-surface-variant font-bold text-body-sm shrink-0">Completados</button>
                <button class="btn-soon px-5 py-2 rounded-full border border-outline-variant text-on-surface-variant font-bold text-body-sm shrink-0">Cancelados</button>
            </div>

            {{-- Tabla de tratos --}}
            <div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm">
                <div class="p-6 border-b border-outline-variant flex items-center justify-between">
                    <h2 class="font-headline-md text-headline-md text-on-surface">Tratos Activos</h2>
                    <div class="relative hidden md:block">
                        <input class="bg-surface-container-low border border-outline-variant rounded-lg px-4 py-2 text-body-sm focus:outline-none focus:ring-2 focus:ring-primary/20 w-56"
                            placeholder="Buscar trato..." type="text">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                    </div>
                </div>

                {{-- Tabla desktop --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-surface-container border-b border-outline-variant">
                            <tr>
                                <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">PRODUCTO</th>
                                <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">PRECIO</th>
                                <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">ESTADO</th>
                                <th class="px-6 py-4 text-center font-label-caps text-label-caps text-on-surface-variant">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            {{--
                                Cuando tengas el modelo Trato, reemplaza esto:
                                @forelse ($tratos as $trato)
                                    <tr>...</tr>
                                @empty
                                    <tr><td colspan="4" class="text-center p-8 text-on-surface-variant">No tienes tratos aún.</td></tr>
                                @endforelse
                            --}}

                            {{-- Datos de ejemplo (igual que tu misTratos.html) --}}
                            <tr class="hover:bg-surface-container-low/50 transition-colors">
                                <td class="px-6 py-6 max-w-md">
                                    <div class="flex gap-4">
                                        <div class="w-20 h-20 rounded-lg bg-surface-container-high shrink-0 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-3xl text-outline-variant">smartphone</span>
                                        </div>
                                        <div>
                                            <p class="text-body-sm font-semibold mb-1">Smartphone con pantalla AMOLED y 256GB</p>
                                            <span class="text-[11px] text-on-surface-variant font-medium">SKU: SM-AAD-XL25</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 font-price-display text-price-display text-primary">S/150.00</td>
                                <td class="px-6 py-6">
                                    <span class="bg-tertiary-container/30 text-tertiary px-3 py-1 rounded-full text-label-caps font-bold">ACORDADO</span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center justify-center gap-3">
                                        <button class="btn-soon bg-secondary-container text-on-secondary-container px-6 py-2 rounded-lg text-label-caps font-bold flex items-center gap-2">
                                            DETALLES
                                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-container-low/50 transition-colors">
                                <td class="px-6 py-6 max-w-md">
                                    <div class="flex gap-4">
                                        <div class="w-20 h-20 rounded-lg bg-surface-container-high shrink-0 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-3xl text-outline-variant">headphones</span>
                                        </div>
                                        <div>
                                            <p class="text-body-sm font-semibold mb-1">Auriculares inalámbricos con sonido envolvente</p>
                                            <span class="text-[11px] text-on-surface-variant font-medium">SKU: AU-BT-092</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 font-price-display text-price-display text-primary">S/120.00</td>
                                <td class="px-6 py-6">
                                    <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-label-caps font-bold">EN DISCUSIÓN</span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center justify-center gap-3">
                                        <button class="btn-soon bg-secondary-container text-on-secondary-container px-6 py-2 rounded-lg text-label-caps font-bold flex items-center gap-2">
                                            DETALLES
                                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-container-low/50 transition-colors">
                                <td class="px-6 py-6 max-w-md">
                                    <div class="flex gap-4">
                                        <div class="w-20 h-20 rounded-lg bg-surface-container-high shrink-0 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-3xl text-outline-variant">air</span>
                                        </div>
                                        <div>
                                            <p class="text-body-sm font-semibold mb-1">Unidad split para pared, diseño moderno</p>
                                            <span class="text-[11px] text-on-surface-variant font-medium">SKU: AC-SL-X10</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 font-price-display text-price-display text-primary">S/85.00</td>
                                <td class="px-6 py-6">
                                    <span class="bg-secondary/10 text-secondary px-3 py-1 rounded-full text-label-caps font-bold">RECIBIDO</span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center justify-center gap-3">
                                        <button class="btn-soon bg-secondary-container text-on-secondary-container px-6 py-2 rounded-lg text-label-caps font-bold flex items-center gap-2">
                                            DETALLES
                                            <span class="material-symbols-outlined text-[16px]">info</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Cards mobile --}}
                <div class="md:hidden divide-y divide-outline-variant">
                    <div class="p-4 flex items-start gap-4">
                        <div class="w-16 h-16 rounded-lg bg-surface-container-high shrink-0 flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl text-outline-variant">smartphone</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-body-sm truncate">Smartphone con pantalla AMOLED</p>
                            <p class="text-primary font-bold mt-1">S/150.00</p>
                            <span class="inline-block mt-1 bg-tertiary-container/30 text-tertiary px-2 py-0.5 rounded-full text-[10px] font-bold">ACORDADO</span>
                        </div>
                        <button class="btn-soon p-2 bg-secondary-container text-on-secondary-container rounded-lg">
                            <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        </button>
                    </div>
                </div>

                {{-- Paginación --}}
                <div class="p-6 border-t border-outline-variant flex items-center justify-between">
                    <p class="text-body-sm text-on-surface-variant">Mostrando <span class="font-bold">3</span> tratos de ejemplo</p>
                    <div class="flex gap-2">
                        <button class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <button class="w-10 h-10 flex items-center justify-center bg-primary text-on-primary rounded-lg font-bold">1</button>
                        <button class="btn-soon w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low">2</button>
                        <button class="btn-soon w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('layouts.footer')

</div>
@endsection
