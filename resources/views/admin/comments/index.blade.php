<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Moderación de Comentarios - Market Place Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-secondary-container": "#703500", "secondary-fixed": "#ffdcc7", "secondary": "#964900",
                        "on-tertiary-fixed": "#002203", "on-tertiary": "#ffffff", "surface-container": "#edeeef",
                        "surface-dim": "#d9dadb", "surface-container-lowest": "#ffffff", "on-surface-variant": "#434652",
                        "surface-container-highest": "#e1e3e4", "primary-fixed-dim": "#b0c6ff",
                        "on-tertiary-fixed-variant": "#18511c", "secondary-container": "#fe9b53",
                        "outline-variant": "#c3c6d4", "on-secondary-fixed": "#311300", "inverse-surface": "#2e3132",
                        "on-tertiary-container": "#8ecc87", "on-primary-container": "#a1bbff",
                        "surface-container-high": "#e7e8e9", "tertiary-fixed": "#b3f2ab", "on-secondary": "#ffffff",
                        "tertiary-container": "#1e5721", "on-error-container": "#93000a", "surface-variant": "#e1e3e4",
                        "on-primary-fixed-variant": "#1e448b", "on-error": "#ffffff", "tertiary": "#003f0b",
                        "surface-tint": "#3a5ca4", "surface-bright": "#f8f9fa", "secondary-fixed-dim": "#ffb787",
                        "primary": "#003178", "inverse-on-surface": "#f0f1f2", "surface-container-low": "#f3f4f5",
                        "on-primary": "#ffffff", "on-primary-fixed": "#001945", "inverse-primary": "#b0c6ff",
                        "background": "#f8f9fa", "error-container": "#ffdad6", "error": "#ba1a1a",
                        "on-background": "#191c1d", "primary-fixed": "#d9e2ff", "surface": "#f8f9fa",
                        "tertiary-fixed-dim": "#98d691", "outline": "#737783", "on-surface": "#191c1d",
                        "primary-container": "#254990", "on-secondary-fixed-variant": "#723600"
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                    spacing: {
                        "gutter": "24px", "container-max": "1280px", "base": "8px",
                        "sidebar-width": "280px", "margin-mobile": "16px"
                    },
                    fontFamily: {
                        "headline-lg": ["Inter"], "headline-md": ["Inter"],
                        "body-lg": ["Inter"], "body-sm": ["Inter"], "label-caps": ["Inter"]
                    },
                    fontSize: {
                        "headline-lg": ["32px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "headline-md": ["20px", { lineHeight: "28px", fontWeight: "600" }],
                        "body-lg": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "body-sm": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                        "label-caps": ["12px", { lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "700" }]
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>

<body class="bg-background text-on-surface min-h-screen flex flex-col">

    <!-- TopNavBar -->
    <header class="bg-surface border-b border-outline-variant fixed top-0 z-50 w-full">
        <div class="flex justify-between items-center px-gutter py-base w-full max-w-container-max mx-auto">
            <div class="flex items-center gap-4">
                <span class="font-headline-md text-headline-md font-bold text-primary">Market Place Plus</span>
                <span class="bg-primary text-on-primary px-3 py-1 rounded text-label-caps font-label-caps">ADMIN</span>
            </div>
            <div class="flex items-center gap-6">
                <span class="hidden md:block text-body-sm font-bold text-on-surface">Gestión de Comentarios</span>
                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary">
                    <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1 pt-16">

        <!-- SideNavBar -->
        <aside class="hidden md:flex flex-col w-sidebar-width bg-surface-container border-r border-outline-variant p-base space-y-4 sticky top-16 self-start h-[calc(100vh-64px)]">
            <div class="px-4 py-6 border-b border-outline-variant/30">
                <h2 class="font-headline-md text-headline-md text-primary font-bold">Panel Admin</h2>
                <p class="text-on-surface-variant text-body-sm">Control central del sitio</p>
            </div>
            <nav class="flex-1 space-y-1">
                <a class="text-on-surface-variant hover:text-on-surface flex items-center px-4 py-3 hover:bg-surface-variant rounded-xl transition-all"
                   href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined mr-3">dashboard</span>
                    <span class="font-body-lg text-body-lg">Dashboard</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface flex items-center px-4 py-3 hover:bg-surface-variant rounded-xl transition-all"
                   href="{{ route('admin.products.index') }}">
                    <span class="material-symbols-outlined mr-3">inventory_2</span>
                    <span class="font-body-lg text-body-lg">Gestionar Publicaciones</span>
                </a>
                {{-- Ítem activo --}}
                <a class="bg-primary text-on-primary rounded-xl font-bold flex items-center px-4 py-3 gap-3 transition-all" href="{{ route('admin.comments.index') }}">
                    <span class="material-symbols-outlined">comment</span>
                    <span class="font-body-lg text-body-lg">Gestionar Comentarios</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all"
                   href="{{ route('admin.banners.index') }}">
                    <span class="material-symbols-outlined">ads_click</span>
                    <span class="font-body-lg text-body-lg">Gestionar Publicidad</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all"
                   href="{{ route('admin.users.index') }}">
                    <span class="material-symbols-outlined">group</span>
                    <span class="font-body-lg text-body-lg">Gestionar Usuarios</span>
                </a>
            </nav>
            <div class="pt-4 border-t border-outline-variant">
                <a href="{{ route('home') }}" class="text-on-surface-variant hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all">
                    <span class="material-symbols-outlined">storefront</span>
                    <span class="font-body-lg">Ver Tienda</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-error hover:bg-error-container rounded-xl flex items-center px-4 py-3 gap-3 transition-all text-left">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="font-body-lg">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow min-h-screen p-gutter">
            <div class="max-w-4xl mx-auto mt-8">

                <header class="mb-10">
                    <h1 class="font-headline-lg text-headline-lg text-primary mb-2">Moderación de Comentarios</h1>
                    <p class="text-on-surface-variant font-body-lg">Supervisa y administra las reseñas publicadas por los usuarios en la plataforma.</p>
                </header>

                {{-- Mensaje de éxito al habilitar/deshabilitar --}}
                @if(session('success'))
                <div class="mb-6 p-4 bg-tertiary-fixed rounded-lg border border-outline-variant text-on-surface font-body-sm font-bold">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Feed de comentarios --}}
                <div class="space-y-6">
                    @forelse($comments as $comment)

                    {{-- Tarjeta de comentario: opacidad reducida si está deshabilitado --}}
                    <article class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow {{ $comment->is_active ? '' : 'opacity-60' }}">
                        <div class="flex items-start justify-between gap-4">

                            {{-- Info del usuario y contenido --}}
                            <div class="flex gap-4 flex-1 min-w-0">

                                {{-- Avatar con inicial del nombre (no hay fotos de perfil) --}}
                                <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold text-lg flex-shrink-0">
                                    {{ strtoupper(substr($comment->user->first_name, 0, 1)) }}
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                                        <h4 class="font-headline-md text-headline-md">
                                            {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                        </h4>
                                        {{-- Badge de estado para comentarios deshabilitados --}}
                                        @unless($comment->is_active)
                                            <span class="bg-error-container text-error text-[10px] font-bold px-2 py-0.5 rounded-full">DESHABILITADO</span>
                                        @endunless
                                        <span class="text-outline text-body-sm">•</span>
                                        <p class="text-on-surface-variant font-body-sm">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>

                                    {{-- Estrellas dinámicas según el valor de rating --}}
                                    <div class="flex items-center gap-0.5 mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= ($comment->rating ?? 0))
                                                <span class="material-symbols-outlined text-secondary-container" style="font-variation-settings: 'FILL' 1; font-size: 18px;">star</span>
                                            @else
                                                <span class="material-symbols-outlined text-outline-variant" style="font-size: 18px;">star</span>
                                            @endif
                                        @endfor
                                    </div>

                                    {{-- Producto al que pertenece el comentario --}}
                                    <p class="font-label-caps text-label-caps text-secondary mb-2 uppercase">
                                        PRODUCTO: {{ Str::upper($comment->product->title) }}
                                    </p>

                                    <p class="font-body-lg text-body-lg text-on-surface max-w-2xl leading-relaxed">
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            </div>

                            {{-- Acción de toggle: deshabilitar si activo, habilitar si inactivo --}}
                            <div class="flex flex-col gap-2 min-w-[130px]">
                                <form action="{{ route('admin.comments.toggle', $comment) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($comment->is_active)
                                        <button type="submit"
                                            class="w-full border border-error text-error font-bold py-2 px-4 rounded-lg hover:bg-error-container transition-all text-body-sm">
                                            Deshabilitar
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="w-full bg-primary text-on-primary font-bold py-2 px-4 rounded-lg hover:brightness-110 transition-all text-body-sm">
                                            Habilitar
                                        </button>
                                    @endif
                                </form>
                            </div>

                        </div>
                    </article>

                    @empty
                    {{-- Estado vacío --}}
                    <div class="text-center py-20 text-on-surface-variant">
                        <span class="material-symbols-outlined text-6xl mb-4 block">forum</span>
                        <p class="font-headline-md text-headline-md">No hay comentarios registrados.</p>
                        <p class="font-body-sm mt-2">Cuando los usuarios dejen reseñas aparecerán aquí.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Paginación --}}
                @if($comments->hasPages())
                <div class="mt-8">
                    {{ $comments->links() }}
                </div>
                @endif

            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-inverse-surface text-surface w-full mt-auto">
        <div class="max-w-container-max mx-auto px-gutter py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div class="flex flex-col gap-4">
                    <span class="font-bold text-xl text-white">Market Place Plus <span class="text-secondary-fixed">Admin</span></span>
                    <p class="text-surface-variant text-body-sm leading-relaxed">Panel de Control Administrativo centralizado para la gestión de catálogo, usuarios y métricas de rendimiento.</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-symbols-outlined text-surface-variant">security</span>
                        <span class="material-symbols-outlined text-surface-variant">monitoring</span>
                        <span class="material-symbols-outlined text-surface-variant">admin_panel_settings</span>
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <h5 class="font-bold text-white uppercase text-label-caps tracking-widest">Políticas de Seguridad</h5>
                    <nav class="flex flex-col gap-3">
                        <a class="text-surface-variant hover:text-white transition-colors text-body-sm" href="{{ route('proximamente') }}">Privacidad de Datos</a>
                        <a class="text-surface-variant hover:text-white transition-colors text-body-sm" href="{{ route('proximamente') }}">Términos de Moderación</a>
                        <a class="text-surface-variant hover:text-white transition-colors text-body-sm" href="{{ route('proximamente') }}">Seguridad de la Plataforma</a>
                    </nav>
                </div>
                <div class="flex flex-col gap-4">
                    <h5 class="font-bold text-white uppercase text-label-caps tracking-widest">Soporte Admin</h5>
                    <nav class="flex flex-col gap-3">
                        <a class="text-surface-variant hover:text-white transition-colors text-body-sm" href="{{ route('proximamente') }}">Centro de Ayuda Admin</a>
                        <a class="text-surface-variant hover:text-white transition-colors text-body-sm" href="{{ route('proximamente') }}">Reportar Incidencia</a>
                        <a class="text-surface-variant hover:text-white transition-colors text-body-sm" href="{{ route('proximamente') }}">Guía de Administrador</a>
                    </nav>
                </div>
                <div class="flex flex-col gap-4">
                    <h5 class="font-bold text-white uppercase text-label-caps tracking-widest">Accesos Rápidos</h5>
                    <nav class="flex flex-col gap-3">
                        <a class="text-surface-variant hover:text-white transition-colors text-body-sm" href="{{ route('admin.products.index') }}">Gestionar Publicaciones</a>
                        <a class="text-surface-variant hover:text-white transition-colors text-body-sm" href="{{ route('admin.comments.index') }}">Gestionar Comentarios</a>
                        <a class="text-surface-variant hover:text-white transition-colors text-body-sm" href="{{ route('admin.banners.index') }}">Gestionar Publicidad</a>
                    </nav>
                </div>
            </div>
            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-surface-variant text-body-sm italic">2024 Market Place Plus. Reservado para uso exclusivo de administradores autorizados.</p>
                <p class="text-surface-variant text-body-sm">v2.4.0 Build 20240501</p>
            </div>
        </div>
    </footer>

    <script>
        // Efecto de escala al presionar botones
        document.querySelectorAll('button[type="submit"]').forEach(btn => {
            btn.addEventListener('mousedown', () => btn.style.transform = 'scale(0.96)');
            btn.addEventListener('mouseup', () => btn.style.transform = 'scale(1)');
            btn.addEventListener('mouseleave', () => btn.style.transform = 'scale(1)');
        });
    </script>

</body>
</html>
