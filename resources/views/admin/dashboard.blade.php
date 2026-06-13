<!DOCTYPE html>
<html class="light" lang="es" style="">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Panel de Administración - Market Place Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet">
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
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .sidebar-active {
            background-color: #254990 !important;
            /* primary-container */
            color: #ffffff !important;
            /* on-primary */
            border-radius: 0.5rem;
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-background text-on-surface min-h-screen flex flex-col">
    <!-- TopNavBar -->
    <header class="fixed top-0 left-0 w-full z-50 bg-surface border-b border-outline-variant h-16">
        <div class="flex justify-between items-center px-gutter h-full w-full">
            <div class="flex items-center gap-8">
                <div class="font-headline-md text-headline-md font-bold text-primary">Panel Admin</div>
                <div class="hidden md:flex items-center relative">
                    <span class="material-symbols-outlined absolute left-3 text-outline">search</span>
                    <input class="pl-10 pr-4 py-1.5 bg-surface-container rounded-lg border-none focus:ring-2 focus:ring-primary text-body-sm w-80" placeholder="Buscar en el panel..." type="text">
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="p-2 text-on-surface-variant hover:bg-surface-variant rounded-full relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-surface"></span>
                </button>
                <div class="flex items-center gap-3 pl-4 border-l border-outline-variant">
                    <div class="text-right hidden sm:block">
                        <p class="font-body-sm font-semibold leading-none">Administrador</p>
                        <p class="text-[11px] text-on-surface-variant">Admin Principal</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary">
                        <span class="material-symbols-outlined">admin_panel_settings</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="flex flex-1 pt-16">
        <!-- SideNavBar -->
        <aside class="hidden md:flex flex-col fixed h-[calc(100vh-64px)] left-0 w-sidebar-width bg-surface-container border-r border-outline-variant p-base space-y-4 z-40 overflow-y-auto">
            <div class="px-4 py-6 border-b border-outline-variant/30">
                <h2 class="font-headline-md text-headline-md text-primary font-bold">Panel Admin</h2>
                <p class="text-on-surface-variant text-body-sm">Control central del sitio</p>
            </div>
            <nav class="flex-1 space-y-1">
                <a class="bg-primary text-on-primary rounded-xl font-bold flex items-center px-4 py-3 gap-3 transition-all"
                   href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-body-lg">Dashboard</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all"
                   href="{{ route('admin.products.index') }}">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="font-body-lg">Gestionar Publicaciones</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all"
                   href="{{ route('admin.comments.index') }}">
                    <span class="material-symbols-outlined">comment</span>
                    <span class="font-body-lg">Gestionar Comentarios</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all"
                   href="{{ route('admin.banners.index') }}">
                    <span class="material-symbols-outlined">ads_click</span>
                    <span class="font-body-lg">Gestionar Publicidad</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant rounded-xl flex items-center px-4 py-3 gap-3 transition-all"
                   href="{{ route('admin.users.index') }}">
                    <span class="material-symbols-outlined">group</span>
                    <span class="font-body-lg">Gestionar Usuarios</span>
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
        <main class="flex-1 md:ml-[280px] p-gutter bg-surface-container-low min-h-screen">
            <div class="max-w-6xl mx-auto space-y-8 pb-12">
                <section>
                    <h1 class="font-headline-lg text-headline-lg text-primary">Panel de Administración</h1>
                    <p class="font-body-lg text-on-surface-variant">Acceso directo a los módulos de gestión crítica del sistema.</p>
                </section>
                <div class="grid grid-cols-1 gap-8">
                    <!-- Recent Publications Management -->
                    <div class="bg-surface-container-lowest rounded-lg border border-outline-variant overflow-hidden shadow-sm" style="opacity: 1; transform: translateY(0px); transition: opacity 0.6s, transform 0.6s;">
                        <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-white">
                            <h2 class="font-headline-md text-on-surface">Publicaciones Recientes</h2>
                            <a href="{{ route('admin.products.index') }}"
                                class="text-primary font-bold font-body-sm hover:underline">
                                Ver todas
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-surface-container-low">
                                    <tr>
                                        <th class="px-6 py-3 font-label-caps text-on-surface-variant">Producto</th>
                                        <th class="px-6 py-3 font-label-caps text-on-surface-variant">Vendedor</th>
                                        <th class="px-6 py-3 font-label-caps text-on-surface-variant text-right">Precio</th>
                                        <th class="px-6 py-3 font-label-caps text-on-surface-variant text-center">Estado</th>
                                        <th class="px-6 py-3 font-label-caps text-on-surface-variant text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-outline-variant">
                                    @forelse($products as $product)
                                    <tr class="hover:bg-surface-container-low transition-colors group">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 rounded bg-surface-container-high overflow-hidden flex-shrink-0">
                                                    @php
                                                        $firstImage = is_array($product->image_path) && count($product->image_path) > 0
                                                            ? $product->image_path[0]
                                                            : null;
                                                    @endphp
                                                    @if($firstImage)
                                                    <img alt="{{ $product->title }}" class="w-full h-full object-cover" src="{{ asset('storage/' . $firstImage) }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                                    <div class="w-full h-full bg-surface-variant items-center justify-center hidden"><span class="material-symbols-outlined text-outline" style="font-size:18px">image</span></div>
                                                    @else
                                                    <div class="w-full h-full bg-surface-variant flex items-center justify-center"><span class="material-symbols-outlined text-outline" style="font-size:18px">image</span></div>
                                                    @endif
                                                </div>
                                                <span class="font-semibold text-body-lg">{{ $product->title }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-body-sm">{{ $product->user->first_name.' '.$product->user->last_name  ?? 'Sin asignar' }}</td>
                                        <td class="px-6 py-4 text-right font-body-lg font-bold">S/. {{ number_format((float)$product->price, 2) }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 rounded-full {{ $product->is_active ? 'bg-tertiary-fixed' : 'bg-error-container' }} text-[10px] font-bold">
                                                {{ $product->is_active ? 'ACTIVO' : 'INACTIVO' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-primary hover:bg-primary-fixed p-1 rounded-full" title="Editar"><span class="material-symbols-outlined">edit</span></a>
                                            @if($product->is_active)
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Desactivar esta publicación?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-error hover:bg-error-container p-1 rounded-full ml-2" title="Desactivar"><span class="material-symbols-outlined">block</span></button>
                                                </form>
                                            @else
                                                <button disabled class="text-on-surface-variant p-1 rounded-full ml-2 opacity-50 cursor-not-allowed" title="Publicación desactivada"><span class="material-symbols-outlined">block</span></button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-outline">No hay publicaciones registradas.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8" style="opacity: 1; transform: translateY(0px); transition: opacity 0.6s, transform 0.6s;">
                        <!-- Pending Comments Management -->
                        <div class="bg-surface-container-lowest rounded-lg border border-outline-variant shadow-sm flex flex-col">
                            <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-white">
                                <h2 class="font-headline-md text-on-surface">Moderación de Comentarios</h2>
                                <span class="material-symbols-outlined text-outline">forum</span>
                            </div>
                            <div class="p-6 space-y-4 flex-1">
                                @forelse($recentComments as $comment)
                                <div class="p-4 bg-surface-container-low rounded-lg border border-outline-variant {{ $comment->is_active ? '' : 'opacity-60' }}">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <p class="font-bold text-primary">{{ $comment->user->first_name }} {{ substr($comment->user->last_name, 0, 1) }}.</p>
                                            {{-- Estrellas dinámicas según el rating del comentario --}}
                                            <div class="flex text-secondary-container">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= ($comment->rating ?? 0))
                                                        <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                                    @else
                                                        <span class="material-symbols-outlined text-xs text-outline-variant">star</span>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <span class="text-[10px] text-on-surface-variant font-medium uppercase">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-body-sm text-on-surface italic mb-3 line-clamp-2">"{{ $comment->content }}"</p>
                                    {{-- Botón toggle: deshabilitar si activo, habilitar si inactivo --}}
                                    <div class="flex gap-2 justify-end">
                                        <form action="{{ route('admin.comments.toggle', $comment) }}" method="POST">
                                            @csrf @method('PATCH')
                                            @if($comment->is_active)
                                                <button type="submit" class="px-3 py-1 text-[11px] font-bold border border-error text-error rounded-md hover:bg-error-container transition-colors">Deshabilitar</button>
                                            @else
                                                <button type="submit" class="px-3 py-1 text-[11px] font-bold bg-primary text-on-primary rounded-md hover:brightness-110 transition-all">Habilitar</button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <p class="text-body-sm text-on-surface-variant text-center py-4">No hay comentarios registrados.</p>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.comments.index') }}" class="m-6 mt-0 py-2 border border-outline text-on-surface font-bold rounded-lg hover:bg-surface-container-high transition-all text-sm text-center block">Ver todos los comentarios</a>
                        </div>
                        <!-- Advertising Management -->
                        <div class="bg-surface-container-lowest rounded-lg border border-outline-variant shadow-sm flex flex-col">
                            <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-white">
                                <h2 class="font-headline-md text-on-surface">Gestión de Publicidad</h2>
                                <span class="material-symbols-outlined text-secondary">campaign</span>
                            </div>
                            <div class="p-6 space-y-4">
                                {{-- Vista previa de los 2 primeros banners de la DB --}}
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach($banners->take(2) as $banner)
                                    <div class="relative overflow-hidden rounded-lg border border-outline-variant aspect-video bg-surface-container {{ !$banner->is_active ? 'grayscale opacity-60' : '' }}">
                                        @php
                                            $imgSrc = Str::startsWith($banner->image_path ?? '', ['http://', 'https://'])
                                                ? $banner->image_path
                                                : asset('storage/' . $banner->image_path);
                                        @endphp
                                        @if($banner->image_path)
                                            <img alt="{{ $banner->title }}" class="w-full h-full object-cover" src="{{ $imgSrc }}">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center"><span class="material-symbols-outlined text-3xl text-outline">image</span></div>
                                        @endif
                                        <div class="absolute bottom-2 left-2 {{ $banner->is_active ? 'bg-secondary text-on-secondary' : 'bg-surface-container-highest text-on-surface-variant' }} text-[9px] px-1.5 py-0.5 rounded font-bold uppercase">
                                            {{ $banner->is_active ? 'Activo' : 'Inactivo' }}
                                        </div>
                                    </div>
                                    @endforeach
                                    {{-- Rellena con placeholders si hay menos de 2 banners --}}
                                    @for($i = $banners->count(); $i < 2; $i++)
                                    <div class="overflow-hidden rounded-lg border-2 border-dashed border-outline-variant aspect-video bg-surface-container flex items-center justify-center">
                                        <span class="material-symbols-outlined text-3xl text-outline">add_photo_alternate</span>
                                    </div>
                                    @endfor
                                </div>
                                <div class="bg-primary-container/10 p-4 rounded-lg border border-primary/20 mt-2">
                                    <p class="font-body-sm font-semibold text-primary mb-1">
                                        Banners activos: {{ $banners->where('is_active', true)->count() }}
                                    </p>
                                    <p class="text-[12px] text-on-surface-variant">
                                        Total registrados: {{ $banners->count() }}
                                    </p>
                                </div>
                            </div>
                            <div class="p-6 pt-0 mt-auto">
                                <a href="{{ route('admin.banners.index') }}"
                                   class="w-full bg-primary text-on-primary font-bold py-3 rounded-lg flex items-center justify-center gap-2 hover:brightness-110 active:scale-[0.98] transition-all">
                                    <span class="material-symbols-outlined">add_photo_alternate</span>
                                    Gestionar Banners
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Full Width Footer -->
    <footer class="w-full bg-inverse-surface py-12 px-gutter">
        <div class="max-w-container-max mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div class="space-y-4">
                    <div class="font-headline-md text-white font-bold">Market Place Plus</div>
                    <p class="font-body-sm text-surface-variant max-w-sm opacity-80">© 2024 Market Place Plus. Panel de Administración Autorizado.</p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-12">
                    <div class="space-y-3">
                        <p class="font-label-caps text-secondary font-bold uppercase">POLÍTICAS DE SEGURIDAD</p>
                        <nav class="flex flex-col gap-2">
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="{{ route('proximamente') }}">Privacidad de Datos</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="{{ route('proximamente') }}">Términos de Moderación</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="{{ route('proximamente') }}">Protocolos Admin</a>
                        </nav>
                    </div>
                    <div class="space-y-3">
                        <p class="font-label-caps text-secondary font-bold uppercase">ACCESOS RÁPIDOS</p>
                        <nav class="flex flex-col gap-2">
                            <a href="{{ route('admin.products.index') }}"
                                class="text-surface-variant text-body-sm hover:text-white transition-colors">
                                Gestionar Publicaciones
                            </a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="{{ route('admin.comments.index') }}">Gestionar Comentarios</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="{{ route('admin.banners.index') }}">Gestionar Publicidad</a>
                        </nav>
                    </div>
                    <div class="space-y-3">
                        <p class="font-label-caps text-secondary font-bold uppercase">SOPORTE ADMIN</p>
                        <nav class="flex flex-col gap-2">
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="{{ route('proximamente') }}">Centro de Ayuda</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="{{ route('proximamente') }}">Reportar Incidencia</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="{{ route('proximamente') }}">Manual de Uso</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        // Entrance animations for modules
        window.addEventListener('load', () => {
            const sections = document.querySelectorAll('main > div > div > div');
            sections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(15px)';
                section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });

        // Hover effects for primary actions
        document.querySelectorAll('button.bg-primary').forEach(btn => {
            btn.addEventListener('mouseenter', () => btn.classList.add('shadow-lg'));
            btn.addEventListener('mouseleave', () => btn.classList.remove('shadow-lg'));
        });
    </script>


</body>

</html>
