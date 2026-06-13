<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | Market Place Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-secondary-container": "#703500",
                        "secondary-fixed": "#ffdcc7",
                        "secondary": "#964900",
                        "surface-container": "#edeeef",
                        "surface-container-lowest": "#ffffff",
                        "on-surface-variant": "#434652",
                        "surface-container-highest": "#e1e3e4",
                        "primary-fixed-dim": "#b0c6ff",
                        "secondary-container": "#fe9b53",
                        "outline-variant": "#c3c6d4",
                        "inverse-surface": "#2e3132",
                        "on-tertiary-container": "#8ecc87",
                        "on-primary-container": "#a1bbff",
                        "surface-container-high": "#e7e8e9",
                        "tertiary-fixed": "#b3f2ab",
                        "on-secondary": "#ffffff",
                        "tertiary-container": "#1e5721",
                        "on-error-container": "#93000a",
                        "surface-variant": "#e1e3e4",
                        "on-error": "#ffffff",
                        "tertiary": "#003f0b",
                        "surface-bright": "#f8f9fa",
                        "secondary-fixed-dim": "#ffb787",
                        "primary": "#003178",
                        "inverse-on-surface": "#f0f1f2",
                        "surface-container-low": "#f3f4f5",
                        "on-primary": "#ffffff",
                        "inverse-primary": "#b0c6ff",
                        "background": "#f8f9fa",
                        "error-container": "#ffdad6",
                        "error": "#ba1a1a",
                        "on-background": "#191c1d",
                        "primary-fixed": "#d9e2ff",
                        "surface": "#f8f9fa",
                        "outline": "#737783",
                        "on-surface": "#191c1d",
                        "primary-container": "#254990",
                        "on-secondary-fixed-variant": "#723600"
                    },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                    spacing: { "gutter": "24px", "container-max": "1280px", "sidebar-width": "280px", "base": "8px", "margin-mobile": "16px" },
                    fontFamily: { "headline-lg": ["Inter"], "headline-md": ["Inter"], "body-lg": ["Inter"], "body-sm": ["Inter"], "label-caps": ["Inter"] },
                    fontSize: {
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .active-nav-item { font-variation-settings: 'FILL' 1; }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">

    {{-- TopNavBar Admin --}}
    <header class="bg-surface border-b border-outline-variant fixed top-0 w-full z-50">
        <div class="flex justify-between items-center px-gutter py-base w-full max-w-container-max mx-auto h-[72px]">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.banners.index') }}" class="font-headline-md text-headline-md font-bold text-primary">Market Place Plus</a>
                <span class="bg-primary text-on-primary px-3 py-1 rounded text-label-caps font-label-caps">ADMIN</span>
            </div>
            <div class="flex items-center gap-6">
                <span class="hidden md:block text-body-sm font-bold text-on-surface">@yield('page_title', 'Panel Admin')</span>
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <div class="flex pt-[72px] flex-1 w-full">

        {{-- SideNavBar Admin --}}
        <aside class="left-0 w-sidebar-width bg-surface-container border-r border-outline-variant flex flex-col p-base space-y-4 hidden md:flex sticky top-[72px] self-start" style="height: calc(100vh - 72px); overflow-y: auto;">
            <div class="px-4 py-6">
                <h2 class="font-headline-md text-headline-md text-primary">Panel Admin</h2>
                <p class="text-on-surface-variant text-body-sm">Control central del sitio</p>
            </div>
            <nav class="flex-1 space-y-1">

                @php $route = request()->route()->getName(); @endphp

                <a href="{{ route('admin.dashboard') }}"
                   class="{{ $route === 'admin.dashboard' ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl font-bold flex items-center px-4 py-3 transition-all">
                    <span class="material-symbols-outlined mr-3">dashboard</span>
                    <span class="font-body-lg text-body-lg">Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="{{ str_starts_with($route, 'admin.products') ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl font-bold flex items-center px-4 py-3 transition-all">
                    <span class="material-symbols-outlined mr-3">inventory_2</span>
                    <span class="font-body-lg text-body-lg">Gestionar Publicaciones</span>
                </a>

                <a href="{{ route('admin.comments.index') }}"
                   class="{{ str_starts_with($route, 'admin.comments') ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl font-bold flex items-center px-4 py-3 transition-all">
                    <span class="material-symbols-outlined mr-3">comment</span>
                    <span class="font-body-lg text-body-lg">Gestionar Comentarios</span>
                </a>

                <a href="{{ route('admin.banners.index') }}"
                   class="{{ str_starts_with($route, 'admin.banners') ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl font-bold flex items-center px-4 py-3 transition-all">
                    <span class="material-symbols-outlined mr-3">ads_click</span>
                    <span class="font-body-lg text-body-lg">Gestionar Publicidad</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="{{ str_starts_with($route, 'admin.users') ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl font-bold flex items-center px-4 py-3 transition-all">
                    <span class="material-symbols-outlined mr-3">group</span>
                    <span class="font-body-lg text-body-lg">Gestionar Usuarios</span>
                </a>

            </nav>
            <div class="pt-4 border-t border-outline-variant">
                <a href="{{ route('home') }}" class="text-on-surface-variant hover:bg-surface-variant rounded-lg flex items-center px-4 py-3 gap-3 transition-all">
                    <span class="material-symbols-outlined">storefront</span>
                    <span class="font-body-lg">Ver Tienda</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-error hover:bg-error-container rounded-lg flex items-center px-4 py-3 gap-3 transition-all">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="font-body-lg">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Contenido principal --}}
        <main class="flex-1 p-gutter bg-surface-container/30 overflow-y-auto">
            <div class="max-w-5xl mx-auto">

                {{-- Flash messages --}}
                @if(session('success'))
                    <div class="mb-6 p-4 bg-tertiary-fixed/40 text-on-background border border-tertiary-container/30 rounded-xl flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary-container">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-xl flex items-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    {{-- Footer Admin --}}
    <footer class="bg-inverse-surface text-surface w-full">
        <div class="max-w-container-max mx-auto px-gutter py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-surface-variant text-body-sm italic">© 2026 Market Place Plus. Reservado para uso exclusivo de administradores autorizados.</p>
                <p class="text-surface-variant text-body-sm">v1.0.0</p>
            </div>
        </div>
    </footer>

</body>
</html>
