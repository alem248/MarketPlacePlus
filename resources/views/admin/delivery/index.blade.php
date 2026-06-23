<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Gestionar Deliveries - Panel Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-container": "#703500", "secondary-fixed": "#ffdcc7", "secondary": "#964900",
                        "on-tertiary-fixed": "#002203", "on-tertiary": "#ffffff", "surface-container": "#edeeef",
                        "surface-dim": "#d9dadb", "surface-container-lowest": "#ffffff", "on-surface-variant": "#434652",
                        "surface-container-highest": "#e1e3e4", "primary-fixed-dim": "#b0c6ff",
                        "secondary-container": "#fe9b53", "outline-variant": "#c3c6d4", "outline": "#737783",
                        "on-surface": "#191c1d", "surface-variant": "#e1e3e4", "primary-container": "#254990",
                        "surface": "#f8f9fa", "background": "#f3f4f5", "on-primary": "#ffffff",
                        "primary": "#0a3880", "on-primary-container": "#d8e2ff", "surface-container-low": "#f3f4f5",
                        "surface-container-high": "#e7e8e9", "error": "#ba1a1a", "error-container": "#ffdad6",
                        "on-error": "#ffffff", "on-error-container": "#93000a", "on-secondary": "#ffffff",
                        "on-background": "#191c1d", "inverse-surface": "#2e3132", "inverse-on-surface": "#f0f1f2"
                    },
                    "borderRadius": { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                    "spacing": { "gutter": "24px", "container-max": "1280px", "base": "8px", "sidebar-width": "280px", "margin-mobile": "16px" },
                    "fontFamily": { "price-display": ["Inter"], "label-caps": ["Inter"], "headline-md": ["Inter"], "headline-lg": ["Inter"], "body-lg": ["Inter"], "body-sm": ["Inter"] },
                    "fontSize": {
                        "price-display": ["24px", {"lineHeight": "24px", "fontWeight": "700"}],
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700"}],
                        "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}]
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .sidebar-active { background-color: #254990 !important; color: #ffffff !important; border-radius: 0.5rem; font-weight: 600; }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen flex flex-col">

    {{-- Top Nav --}}
    <header class="fixed top-0 left-0 w-full z-50 bg-surface border-b border-outline-variant h-16">
        <div class="flex justify-between items-center px-gutter h-full w-full">
            <div class="font-headline-md text-headline-md font-bold text-primary">Panel Admin</div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary">
                    <span class="material-symbols-outlined">admin_panel_settings</span>
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1 pt-16">
        {{-- Sidebar --}}
        <aside class="hidden md:flex flex-col fixed h-[calc(100vh-64px)] left-0 w-sidebar-width bg-surface-container border-r border-outline-variant p-base space-y-4 z-40 overflow-y-auto">
            <div class="px-4 py-6 border-b border-outline-variant/30">
                <h2 class="font-headline-md text-headline-md text-primary font-bold">Panel Admin</h2>
                <p class="text-on-surface-variant text-body-sm">Control central del sitio</p>
            </div>
            <nav class="flex-1 space-y-1">
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all" href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span><span class="font-body-lg">Dashboard</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all" href="{{ route('admin.products.index') }}">
                    <span class="material-symbols-outlined">inventory_2</span><span class="font-body-lg">Publicaciones</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all" href="{{ route('admin.comments.index') }}">
                    <span class="material-symbols-outlined">comment</span><span class="font-body-lg">Comentarios</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all" href="{{ route('admin.banners.index') }}">
                    <span class="material-symbols-outlined">ads_click</span><span class="font-body-lg">Publicidad</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all" href="{{ route('admin.users.index') }}">
                    <span class="material-symbols-outlined">group</span><span class="font-body-lg">Usuarios</span>
                </a>
                <a class="sidebar-active flex items-center px-4 py-3 gap-3 transition-all" href="{{ route('admin.delivery.index') }}">
                    <span class="material-symbols-outlined">local_shipping</span><span class="font-body-lg">Deliveries</span>
                </a>
            </nav>
            <div class="pt-4 border-t border-outline-variant">
                <a href="{{ route('home') }}" class="text-on-surface-variant hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all">
                    <span class="material-symbols-outlined">storefront</span><span class="font-body-lg">Ver Tienda</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-error hover:bg-error-container rounded-xl flex items-center px-4 py-3 gap-3 transition-all text-left">
                        <span class="material-symbols-outlined">logout</span><span class="font-body-lg">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <main class="flex-1 md:ml-[280px] p-gutter bg-surface-container-low min-h-screen">
            <div class="max-w-6xl mx-auto space-y-8 pb-12">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="font-headline-lg text-headline-lg text-primary">Gestión de Deliveries</h1>
                        <p class="font-body-lg text-on-surface-variant">Revisa, aprueba y rechaza las solicitudes de envío de los vendedores.</p>
                    </div>
                    {{-- Contador de pendientes --}}
                    @php $pendientes = $deliveries->where('status', 'pendiente')->count(); @endphp
                    @if($pendientes > 0)
                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-bold text-body-sm">
                        <span class="material-symbols-outlined" style="font-size:18px">hourglass_top</span>
                        {{ $pendientes }} pendiente{{ $pendientes > 1 ? 's' : '' }}
                    </span>
                    @endif
                </div>

                @if(session('success'))
                <div class="p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    <p class="text-green-800 font-bold">{{ session('success') }}</p>
                </div>
                @endif

                {{-- Tabla de deliveries --}}
                <div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-surface-container-low border-b border-outline-variant">
                                <tr>
                                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">PRODUCTO</th>
                                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">VENDEDOR</th>
                                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">COMPRADOR</th>
                                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">TIPO</th>
                                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">ESTADO</th>
                                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">FECHA</th>
                                    <th class="px-4 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse($deliveries as $delivery)
                                @php
                                    $statusMap = [
                                        'pendiente'  => ['label' => 'En espera',  'class' => 'bg-yellow-100 text-yellow-800'],
                                        'aprobado'   => ['label' => 'Aprobado',   'class' => 'bg-green-100 text-green-800'],
                                        'rechazado'  => ['label' => 'Rechazado',  'class' => 'bg-red-100 text-red-800'],
                                        'en_camino'  => ['label' => 'En camino',  'class' => 'bg-blue-100 text-blue-800'],
                                        'entregado'  => ['label' => 'Entregado',  'class' => 'bg-gray-100 text-gray-600'],
                                    ];
                                    $s = $statusMap[$delivery->status] ?? $statusMap['pendiente'];
                                @endphp
                                <tr class="hover:bg-surface-container-low transition-colors {{ $delivery->status === 'pendiente' ? 'bg-yellow-50/40' : '' }}">
                                    <td class="px-4 py-3">
                                        <p class="font-bold text-on-surface text-body-sm truncate max-w-[180px]">{{ $delivery->trato->product->title }}</p>
                                        <p class="text-[11px] text-on-surface-variant">MPP-{{ $delivery->trato_id }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-body-sm text-on-surface">
                                        {{ $delivery->trato->seller->first_name }} {{ $delivery->trato->seller->last_name }}
                                    </td>
                                    <td class="px-4 py-3 text-body-sm text-on-surface">
                                        {{ $delivery->trato->buyer->first_name }} {{ $delivery->trato->buyer->last_name }}
                                    </td>
                                    <td class="px-4 py-3 text-body-sm text-on-surface-variant">
                                        {{ $delivery->shipping_type === 'express' ? 'Express' : 'Regular' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 rounded-full text-[11px] font-bold {{ $s['class'] }}">
                                            {{ $s['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-body-sm text-on-surface-variant">
                                        {{ $delivery->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('admin.delivery.show', $delivery) }}"
                                           class="inline-flex items-center gap-1 px-4 py-1.5 text-body-sm font-bold
                                                  {{ $delivery->status === 'pendiente' ? 'bg-primary text-on-primary' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container' }}
                                                  rounded-lg transition-all">
                                            {{ $delivery->status === 'pendiente' ? 'Gestionar' : 'Ver' }}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-16 text-center">
                                        <span class="material-symbols-outlined text-outline block mb-3" style="font-size:48px">local_shipping</span>
                                        <p class="font-body-lg text-on-surface-variant">No hay solicitudes de delivery aún.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($deliveries->hasPages())
                    <div class="px-4 py-3 border-t border-outline-variant">
                        {{ $deliveries->links() }}
                    </div>
                    @endif
                </div>

            </div>
        </main>
    </div>
</body>
</html>
