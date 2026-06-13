<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Gestión de Publicidad y Banners - Market Place Plus</title>
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
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                    spacing: {
                        "gutter": "24px", "container-max": "1280px",
                        "sidebar-width": "280px", "base": "8px", "margin-mobile": "16px"
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
    </style>
</head>

{{--
    Usamos flex-col en el body para que el footer quede siempre debajo del contenido.
    El sidebar es fixed (no sticky) para no interferir con el flujo del documento.
    El main tiene ml-[280px] para compensar el sidebar fijo.
--}}
<body class="bg-background text-on-background min-h-screen flex flex-col">

    <!-- TopNavBar -->
    <header class="bg-surface border-b border-outline-variant fixed top-0 left-0 w-full z-50 h-16">
        <div class="flex justify-between items-center px-gutter h-full w-full max-w-container-max mx-auto">
            <div class="flex items-center gap-4">
                <span class="font-headline-md text-headline-md font-bold text-primary">Market Place Plus</span>
                <span class="bg-primary text-on-primary px-3 py-1 rounded text-label-caps font-label-caps">ADMIN</span>
            </div>
            <div class="flex items-center gap-6">
                <span class="hidden md:block text-body-sm font-bold text-on-surface">Gestión de Publicidad y Banners</span>
                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1 pt-16">

        {{-- Sidebar fixed: igual al dashboard para que el footer no quede tapado --}}
        <aside class="hidden md:flex flex-col fixed h-[calc(100vh-64px)] left-0 w-sidebar-width bg-surface-container border-r border-outline-variant p-base space-y-4 z-40 overflow-y-auto">
            <div class="px-4 py-6">
                <h2 class="font-headline-md text-headline-md text-primary">Panel Admin</h2>
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
                <a class="text-on-surface-variant hover:text-on-surface flex items-center px-4 py-3 hover:bg-surface-variant rounded-xl transition-all"
                   href="{{ route('admin.comments.index') }}">
                    <span class="material-symbols-outlined mr-3">comment</span>
                    <span class="font-body-lg text-body-lg">Gestionar Comentarios</span>
                </a>
                {{-- Ítem activo --}}
                <a class="bg-primary text-on-primary rounded-xl font-bold flex items-center px-4 py-3 gap-3 transition-all" href="{{ route('admin.banners.index') }}">
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

        <!-- Main Content: ml-[280px] para compensar el sidebar fixed -->
        <main class="flex-1 md:ml-[280px] p-gutter bg-surface-dim/10 min-h-screen">
            <div class="max-w-5xl mx-auto mt-8">

                {{-- Mensaje de éxito --}}
                @if(session('success'))
                <div class="mb-6 p-4 bg-tertiary-fixed/40 text-on-background border border-tertiary-container/30 rounded-xl flex items-center gap-2">
                    <span class="material-symbols-outlined text-tertiary-container">check_circle</span>
                    {{ session('success') }}
                </div>
                @endif

                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface">Banners del Catálogo</h1>
                        <p class="text-on-surface-variant text-body-lg">Administre los activos visuales y enlaces de la página principal</p>
                    </div>
                    <a href="{{ route('admin.banners.create') }}"
                        class="bg-primary text-on-primary px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:brightness-110 transition-all shadow-sm">
                        <span class="material-symbols-outlined">upload_file</span>
                        Subir Nuevo Banner
                    </a>
                </div>

                <!-- Lista de banners de la base de datos -->
                <div class="space-y-6">
                    @forelse($banners as $banner)

                    {{-- Tarjeta: borde punteado y opacidad reducida para banners inactivos --}}
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden hover:shadow-md transition-shadow group
                        {{ !$banner->is_active ? 'opacity-70 border-dashed bg-surface-container/30' : '' }}">
                        <div class="flex flex-col lg:flex-row items-stretch p-4 gap-6">

                            {{-- Imagen del banner: grayscale si está inactivo --}}
                            <div class="w-full lg:w-80 h-40 bg-surface-container rounded-lg overflow-hidden flex-shrink-0 border border-outline-variant relative
                                {{ !$banner->is_active ? 'grayscale' : '' }}">
                                @php
                                    // Soporta tanto URLs externas como archivos en storage
                                    $imgSrc = Str::startsWith($banner->image_path ?? '', ['http://', 'https://'])
                                        ? $banner->image_path
                                        : asset('storage/' . $banner->image_path);
                                @endphp
                                @if($banner->image_path)
                                    <img src="{{ $imgSrc }}"
                                         alt="{{ $banner->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-outline-variant">image</span>
                                    </div>
                                @endif
                                {{-- Badge de estado sobre la imagen --}}
                                <div class="absolute top-2 left-2">
                                    @if($banner->is_active)
                                        <span class="bg-tertiary-container text-on-tertiary-container px-2 py-1 rounded text-[10px] font-bold uppercase shadow-sm">Activo</span>
                                    @else
                                        <span class="bg-surface-container-highest text-on-surface-variant px-2 py-1 rounded text-[10px] font-bold uppercase">Inactivo</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Información y acciones del banner -->
                            <div class="flex-1 flex flex-col justify-between py-2">
                                <div>
                                    <h3 class="font-headline-md {{ $banner->is_active ? 'text-on-surface' : 'text-on-surface-variant' }} mb-2">
                                        {{ $banner->title }}
                                    </h3>
                                    <div class="flex flex-col gap-2">
                                        @if($banner->link_url)
                                        <div class="flex items-center text-on-surface-variant text-body-sm gap-2">
                                            <span class="material-symbols-outlined text-[18px]">link</span>
                                            <span class="font-mono bg-surface-container px-2 py-0.5 rounded truncate max-w-sm">{{ $banner->link_url }}</span>
                                        </div>
                                        @endif
                                        @if($banner->end_date)
                                        <div class="flex items-center text-on-surface-variant text-body-sm gap-2">
                                            <span class="material-symbols-outlined text-[18px]">{{ $banner->is_active ? 'calendar_today' : 'history' }}</span>
                                            <span>{{ $banner->is_active ? 'Fecha fin' : 'Finalizado el' }}: {{ $banner->end_date->format('d \d\e F, Y') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Acciones: editar + desactivar/reactivar (sin eliminación) -->
                                <div class="flex items-center gap-3 mt-4">
                                    @if($banner->is_active)
                                        {{-- Editar banner --}}
                                        <a href="{{ route('admin.banners.edit', $banner) }}"
                                            class="flex-1 lg:flex-none px-4 py-2 bg-surface-container-high text-on-surface font-bold rounded-lg hover:bg-outline-variant transition-colors flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                            Editar Enlace
                                        </a>
                                        {{-- Desactivar: envía is_active=0 al UPDATE --}}
                                        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="title"     value="{{ $banner->title }}">
                                            <input type="hidden" name="link_url"  value="{{ $banner->link_url }}">
                                            <input type="hidden" name="is_active" value="0">
                                            <button type="submit"
                                                class="flex-1 lg:flex-none px-4 py-2 text-error font-bold border border-error/20 hover:bg-error/5 rounded-lg transition-colors flex items-center gap-2">
                                                <span class="material-symbols-outlined text-[20px]">block</span>
                                                Desactivar
                                            </button>
                                        </form>
                                    @else
                                        {{-- Reactivar: envía is_active=1 al UPDATE --}}
                                        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="title"     value="{{ $banner->title }}">
                                            <input type="hidden" name="link_url"  value="{{ $banner->link_url }}">
                                            <input type="hidden" name="is_active" value="1">
                                            <button type="submit"
                                                class="px-4 py-2 bg-primary/10 text-primary font-bold rounded-lg hover:bg-primary/20 transition-colors flex items-center gap-2">
                                                <span class="material-symbols-outlined text-[20px]">play_arrow</span>
                                                Reactivar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <div class="text-center py-16 text-on-surface-variant">
                        <span class="material-symbols-outlined text-6xl">image_not_supported</span>
                        <p class="mt-4 font-body-lg">No hay banners registrados.</p>
                        <a href="{{ route('admin.banners.create') }}" class="mt-4 inline-block text-primary font-bold hover:underline">
                            Crear el primer banner →
                        </a>
                    </div>
                    @endforelse

                    {{-- Botón añadir nuevo banner (enlaza al formulario de creación) --}}
                    <a href="{{ route('admin.banners.create') }}"
                        class="w-full border-2 border-dashed border-outline-variant rounded-xl p-10 flex flex-col items-center justify-center gap-4 text-on-surface-variant hover:bg-surface-container-high hover:border-primary/50 transition-all group">
                        <div class="w-16 h-16 rounded-full bg-surface-container-highest flex items-center justify-center group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-4xl text-primary">add_photo_alternate</span>
                        </div>
                        <div class="text-center">
                            <span class="block font-bold text-lg text-on-surface">Añadir Slot de Publicidad</span>
                            <span class="text-body-sm opacity-60">Resolución ideal: 1200 × 450 px</span>
                        </div>
                    </a>
                </div>

                <!-- Lineamientos editoriales para banners -->
                <div class="mt-12 p-6 bg-surface-container-low rounded-xl border border-outline-variant mb-8">
                    <h4 class="font-headline-md text-on-surface flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-secondary">verified_user</span>
                        Lineamientos de Publicidad
                    </h4>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="flex flex-col gap-2">
                            <span class="font-bold text-primary">Formato</span>
                            <p class="text-body-sm text-on-surface-variant">Use imágenes JPG o WebP de alta calidad. Evite texto pequeño incrustado en el banner.</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="font-bold text-primary">Links</span>
                            <p class="text-body-sm text-on-surface-variant">Todos los enlaces deben apuntar a secciones internas del Marketplace para mantener al usuario.</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="font-bold text-primary">Cantidad</span>
                            <p class="text-body-sm text-on-surface-variant">Recomendamos no tener más de 5 banners rotando para asegurar una carga rápida.</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Footer: hermano del div flex → siempre debajo, nunca tapado por el sidebar -->
    <footer class="bg-inverse-surface text-surface w-full">
        <div class="max-w-container-max mx-auto px-gutter py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div class="flex flex-col gap-4">
                    <span class="font-bold text-xl text-white">Market Place Plus <span class="text-secondary-fixed">Admin</span></span>
                    <p class="text-surface-variant text-body-sm leading-relaxed">Panel de Control Administrativo centralizado para la gestión de catálogo, usuarios y métricas de rendimiento de la plataforma.</p>
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
        // Micro-interacción: desplazamiento horizontal al hacer hover en links del nav
        document.querySelectorAll('aside nav a:not(.bg-primary)').forEach(link => {
            link.addEventListener('mouseenter', () => link.style.transform = 'translateX(8px)');
            link.addEventListener('mouseleave', () => link.style.transform = 'translateX(0)');
        });

        // Resalta el borde de la tarjeta al hacer hover (solo banners activos)
        document.querySelectorAll('.group:not(.opacity-70)').forEach(card => {
            card.addEventListener('mouseenter', () => card.style.borderColor = '#003178');
            card.addEventListener('mouseleave', () => card.style.borderColor = '');
        });
    </script>

</body>
</html>
