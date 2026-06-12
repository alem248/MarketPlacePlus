<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Administrar Publicaciones - Market Place Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-container": "#703500",
                        "secondary-fixed": "#ffdcc7",
                        "secondary": "#964900",
                        "on-tertiary-fixed": "#002203",
                        "on-tertiary": "#ffffff",
                        "surface-container": "#edeeef",
                        "surface-dim": "#d9dadb",
                        "surface-container-lowest": "#ffffff",
                        "on-surface-variant": "#434652",
                        "surface-container-highest": "#e1e3e4",
                        "primary-fixed-dim": "#b0c6ff",
                        "on-tertiary-fixed-variant": "#18511c",
                        "secondary-container": "#fe9b53",
                        "outline-variant": "#c3c6d4",
                        "on-secondary-fixed": "#311300",
                        "inverse-surface": "#2e3132",
                        "on-tertiary-container": "#8ecc87",
                        "on-primary-container": "#a1bbff",
                        "surface-container-high": "#e7e8e9",
                        "tertiary-fixed": "#b3f2ab",
                        "on-secondary": "#ffffff",
                        "tertiary-container": "#1e5721",
                        "on-error-container": "#93000a",
                        "surface-variant": "#e1e3e4",
                        "on-primary-fixed-variant": "#1e448b",
                        "on-error": "#ffffff",
                        "tertiary": "#003f0b",
                        "surface-tint": "#3a5ca4",
                        "surface-bright": "#f8f9fa",
                        "secondary-fixed-dim": "#ffb787",
                        "primary": "#003178",
                        "inverse-on-surface": "#f0f1f2",
                        "surface-container-low": "#f3f4f5",
                        "on-primary": "#ffffff",
                        "on-primary-fixed": "#001945",
                        "inverse-primary": "#b0c6ff",
                        "background": "#f8f9fa",
                        "error-container": "#ffdad6",
                        "error": "#ba1a1a",
                        "on-background": "#191c1d",
                        "primary-fixed": "#d9e2ff",
                        "surface": "#f8f9fa",
                        "tertiary-fixed-dim": "#98d691",
                        "outline": "#737783",
                        "on-surface": "#191c1d",
                        "primary-container": "#254990",
                        "on-secondary-fixed-variant": "#723600"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "container-max": "1280px",
                        "base": "8px",
                        "sidebar-width": "280px",
                        "margin-mobile": "16px"
                    },
                    "fontFamily": {
                        "price-display": ["Inter"],
                        "label-caps": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-lg": ["Inter"],
                        "body-sm": ["Inter"],
                        "headline-lg-mobile": ["Inter"]
                    },
                    "fontSize": {
                        "price-display": ["24px", {
                            "lineHeight": "24px",
                            "fontWeight": "700"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "700"
                        }],
                        "headline-md": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "body-sm": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .table-scroll::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .table-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: #c3c6d4;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-background text-on-background min-h-screen flex flex-col">

    <!-- TopNavBar -->
    <header class="bg-surface docked full-width top-0 border-b border-outline-variant z-50">
        <div class="flex justify-between items-center px-gutter py-base w-full max-w-container-max mx-auto">
            <h1 class="font-headline-md text-headline-md font-bold text-primary">Market Place Plus</h1>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col items-end mr-2">
                    <span class="font-label-caps text-label-caps text-on-surface">Administrador</span>
                    <span class="text-xs text-on-surface-variant">admin@marketplace.com</span>
                </div>
                <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center overflow-hidden border border-outline-variant">
                    <img alt="Admin" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA_IpU6Z_-XZ83HwV0SVkgjXGFAceJrDHUt-OrD07_maYgUpw8EGwEazKlckM98sF41Q_Sv0Inr7PAJOuhOy4Pjr7Zd3kd6oR5czuQBJLsDyH0cVdnY5Zw9f8zElRGZKlS2dSIQBZW1yNX-eD4LbBXILz5lNHh52DqKh-xXE0F4ZdR7YKUe8cBmsRJMghDStR-S8-nW-bNsp71veE7t-KT5Oo8x33bol3BmPgrrskvSFfVFbtr3nfF6IdIzKfC8DXq4fer-d7MIisc">
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1">
        <!-- SideNavBar -->
        <aside class="hidden md:flex flex-col w-sidebar-width bg-surface-container border-r border-outline-variant p-base space-y-4 shrink-0">
            <div class="px-4 py-6 border-b border-outline-variant/30">
                <h2 class="font-headline-md text-headline-md text-primary font-bold">Panel Admin</h2>
            </div>
            <nav class="space-y-1">
                <a class="text-on-surface-variant hover:text-on-surface flex items-center px-4 py-3 hover:bg-surface-variant rounded-xl transition-all translate-x-1 duration-200"
                    href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined mr-3">dashboard</span>
                    <span class="font-body-lg text-body-lg">Dashboard</span>
                </a>
                <a class="bg-primary text-on-primary rounded-xl font-bold flex items-center px-4 py-3 translate-x-1 duration-200 shadow-sm" href="#">
                    <span class="material-symbols-outlined mr-3">inventory_2</span>
                    <span class="font-body-lg text-body-lg">Gestionar Publicaciones</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface flex items-center px-4 py-3 hover:bg-surface-variant rounded-xl transition-all translate-x-1 duration-200" href="#">
                    <span class="material-symbols-outlined mr-3">forum</span>
                    <span class="font-body-lg text-body-lg">Gestionar Comentarios</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface flex items-center px-4 py-3 hover:bg-surface-variant rounded-xl transition-all translate-x-1 duration-200" href="#">
                    <span class="material-symbols-outlined mr-3">campaign</span>
                    <span class="font-body-lg text-body-lg">Gestionar Publicidad</span>
                </a>
            </nav>
            <div class="pt-4 border-t border-outline-variant">
                <a class="text-error hover:bg-error-container rounded-lg flex items-center px-4 py-3 gap-3 transition-all" href="#">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-body-lg">Cerrar Sesión</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-gutter bg-surface-dim/10" x-data>
            <div class="max-w-container-max mx-auto space-y-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <h2 class="font-headline-lg text-headline-lg text-on-background">Administrar Publicaciones</h2>
                    <div class="relative w-full md:w-96">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                        <input class="w-full pl-12 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-full focus:ring-2 focus:ring-primary focus:outline-none transition-all" placeholder="Buscar por producto o vendedor..." type="text">
                    </div>
                </div>

                <!-- Mensajes de éxito -->
                @if(session('success'))
                <div class="flex items-center gap-3 bg-tertiary-fixed text-on-tertiary-fixed-variant px-5 py-3 rounded-xl shadow-sm">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span class="font-body-sm text-body-sm font-semibold">{{ session('success') }}</span>
                </div>
                @endif

                <!-- Table Container -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
                    <div class="table-scroll overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container border-b border-outline-variant">
                                    <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Producto</th>
                                    <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Categoría</th>
                                    <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Vendedor</th>
                                    <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Precio</th>
                                    <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @foreach($products as $product)
                                <tr class="hover:bg-surface-container-low transition-colors group">

                                    <!-- Producto -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 rounded-lg overflow-hidden bg-surface-variant shrink-0 border border-outline-variant">
                                                @php
                                                $firstImage = is_array($product->image_path) ? ($product->image_path[0] ?? '') : $product->image_path;
                                                @endphp
                                                <img alt="{{ $product->title }}" class="w-full h-full object-cover" src="{{ asset('storage/' . $firstImage) }}">
                                            </div>
                                            <span class="font-body-lg text-body-lg font-semibold text-on-surface">{{ $product->title }}</span>
                                        </div>
                                    </td>

                                    <!-- Categoría -->
                                    <td class="px-6 py-4">
                                        <span class="text-on-surface-variant font-body-sm text-body-sm">{{ $product->category }}</span>
                                    </td>

                                    <!-- Vendedor -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-xs">
                                                {{ $product->user ? substr($product->user->first_name, 0, 1) . substr($product->user->last_name, 0, 1) : 'NA' }}
                                            </div>
                                            <span class="font-body-lg text-body-lg text-on-surface">
                                                {{ $product->user ? $product->user->first_name . ' ' . $product->user->last_name : 'Sin usuario' }}
                                            </span>
                                        </div>
                                    </td>

                                    <!-- Precio -->
                                    <td class="px-6 py-4">
                                        <p class="font-body-lg text-body-lg font-bold text-on-surface">S/. {{ number_format($product->price, 2) }}</p>
                                    </td>

                                    <!-- Estado -->
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full {{ $product->is_active ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : 'bg-surface-container-high text-on-surface-variant' }} font-label-caps text-label-caps">
                                            {{ $product->is_active ? 'ACTIVO' : 'PENDIENTE' }}
                                        </span>
                                    </td>

                                    <!-- Acciones -->
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">

                                            {{-- Botón Aprobar (solo si no está activo) --}}
                                            @if(!$product->is_active)
                                            <form action="{{ route('admin.products.updateStatus', $product->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="is_active" value="1">
                                                <button type="submit"
                                                    class="p-2 text-tertiary hover:bg-tertiary-fixed rounded-lg transition-all"
                                                    title="Aprobar publicación">
                                                    <span class="material-symbols-outlined">check_circle</span>
                                                </button>
                                            </form>
                                            @endif

                                            {{-- Botón Suspender — abre el modal global --}}
                                            <button
                                                type="button"
                                                class="p-2 text-error hover:bg-error-container rounded-lg transition-all"
                                                title="Suspender publicación"
                                                @click="$dispatch('abrir-modal-suspender', {
        id: {{ $product->id }},
        titulo: @js($product->title)
    })">
                                                <span class="material-symbols-outlined">block</span>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between font-body-sm text-body-sm text-on-surface-variant">
                    <span>Mostrando {{ $products->count() }} publicaciones</span>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors disabled:opacity-50">Anterior</button>
                        <button class="px-4 py-2 bg-primary text-on-primary rounded-lg font-bold">1</button>
                        <button class="px-4 py-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">2</button>
                        <button class="px-4 py-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">3</button>
                        <button class="px-4 py-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">Siguiente</button>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-[#2a2a2a] w-full text-white">
        <div class="w-full py-12 px-gutter max-w-container-max mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-12 mb-10">
                <div class="space-y-6">
                    <h2 class="text-xl font-bold">Market Place Plus <span class="text-orange-400">Admin</span></h2>
                    <p class="text-sm leading-relaxed text-gray-300">
                        Panel de Control Administrativo centralizado para la gestión de catálogo, usuarios y métricas de rendimiento de la plataforma.
                    </p>
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-gray-300 text-xl cursor-pointer hover:text-white">shield_person</span>
                        <span class="material-symbols-outlined text-gray-300 text-xl cursor-pointer hover:text-white">monitoring</span>
                        <span class="material-symbols-outlined text-gray-300 text-xl cursor-pointer hover:text-white">lock_person</span>
                    </div>
                </div>
                <div class="space-y-6">
                    <h3 class="text-sm font-bold uppercase tracking-widest">Políticas de Seguridad</h3>
                    <nav class="flex flex-col gap-4">
                        <a class="text-sm text-gray-300 hover:text-white transition-all" href="#">Privacidad de Datos</a>
                        <a class="text-sm text-gray-300 hover:text-white transition-all" href="#">Términos de Moderación</a>
                        <a class="text-sm text-gray-300 hover:text-white transition-all" href="#">Seguridad de la Plataforma</a>
                    </nav>
                </div>
                <div class="space-y-6">
                    <h3 class="text-sm font-bold uppercase tracking-widest">Soporte Admin</h3>
                    <nav class="flex flex-col gap-4">
                        <a class="text-sm text-gray-300 hover:text-white transition-all" href="#">Centro de Ayuda Admin</a>
                        <a class="text-sm text-gray-300 hover:text-white transition-all" href="#">Reportar Incidencia</a>
                        <a class="text-sm text-gray-300 hover:text-white transition-all" href="#">Guía de Administrador</a>
                    </nav>
                </div>
                <div class="space-y-6">
                    <h3 class="text-sm font-bold uppercase tracking-widest">Accesos Rápidos</h3>
                    <nav class="flex flex-col gap-4">
                        <a class="text-sm text-gray-300 hover:text-white transition-all" href="#">Gestionar Publicaciones</a>
                        <a class="text-sm text-gray-300 hover:text-white transition-all" href="#">Gestionar Comentarios</a>
                        <a class="text-sm text-gray-300 hover:text-white transition-all" href="#">Gestionar Publicidad</a>
                    </nav>
                </div>
            </div>
            <div class="pt-8 border-t border-gray-600 flex flex-col md:flex-row justify-between items-center gap-4 italic text-sm text-gray-400">
                <p>2024 Market Place Plus. Reservado para uso exclusivo de administradores autorizados.</p>
                <div class="flex gap-6">
                    <span>v2.4.0 Build 20240501</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- ============================================ -->
    <!-- MODAL GLOBAL DE SUSPENSIÓN (Alpine.js) -->
    <!-- ============================================ -->
    <div
        x-data="{ abierto: false, productoId: null, productoTitulo: '' }"
        @abrir-modal-suspender.window="
            abierto = true;
            productoId = $event.detail.id;
            productoTitulo = $event.detail.titulo;
        "
        x-show="abierto"
        x-cloak
        class="fixed inset-0 z-[200] flex items-center justify-center bg-black/50"
        @keydown.escape.window="abierto = false">

        <div
            @click.stop
            x-show="abierto"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-xl w-full max-w-md mx-4 shadow-2xl overflow-hidden">

            <!-- Header del modal -->
            <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100">
                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-red-600">block</span>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-900">Suspender publicación</h2>
                    <p class="text-sm text-gray-500 mt-0.5" x-text="productoTitulo"></p>
                </div>
            </div>

            <!-- Body del modal -->
            <form :action="`/admin/products/${productoId}/suspend`" method="POST" class="px-6 py-5 space-y-4">
                @csrf

                <p class="text-sm text-gray-600">
                    Esta acción <strong>desactivará la publicación</strong>. El vendedor será notificado con el motivo que indiques.
                </p>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Motivo de la suspensión <span class="text-red-500">*</span></label>
                    <textarea
                        name="reason"
                        rows="3"
                        required
                        placeholder="Ej: Contenido que viola las políticas de la plataforma..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent resize-none transition"></textarea>
                </div>

                <!-- Footer del modal -->
                <div class="flex justify-end gap-2 mt-4 pt-4 border-t border-gray-100">
                    <button
                        type="button"
                        @click="abierto = false"
                        class="px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-error text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition-all">
                        Confirmar Suspensión
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>