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
        <aside class="hidden md:flex flex-col fixed h-[calc(100vh-64px)] left-0 w-sidebar-width bg-surface border-r border-outline-variant p-4 z-40">
            <nav class="flex-1 space-y-1">
                <div class="mb-4 px-4">
                    <h3 class="font-label-caps text-on-surface-variant text-[11px] mb-2">ADMINISTRACIÓN</h3>
                    <p class="font-headline-md text-primary font-bold">Panel Admin</p>
                </div>
                <a class="sidebar-active flex items-center px-4 py-3 gap-3 transition-colors" href="#">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-body-lg">Dashboard</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high rounded-lg flex items-center px-4 py-3 gap-3 transition-all" href="#">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="font-body-lg">Gestionar Publicaciones</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high rounded-lg flex items-center px-4 py-3 gap-3 transition-all" href="#">
                    <span class="material-symbols-outlined">chat_bubble</span>
                    <span class="font-body-lg">Gestionar Comentarios</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high rounded-lg flex items-center px-4 py-3 gap-3 transition-all" href="#">
                    <span class="material-symbols-outlined">ads_click</span>
                    <span class="font-body-lg">Gestionar Publicidad</span>
                </a>
            </nav>
            <div class="pt-4 border-t border-outline-variant">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors flex items-center gap-2 w-full text-left">
                        <span class="material-symbols-outlined text-body-md">logout</span>
                        Cerrar sesión
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
                            <button class="text-primary font-bold font-body-sm hover:underline">Ver todas</button>
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
                                                    @if($product->image_path)
                                                    <img alt="{{ $product->title }}" class="w-full h-full object-cover" src="{{ asset('storage/' . (is_array($product->image_path) ? $product->image_path[0] : $product->image_path)) }}">
                                                    @else
                                                    <div class="w-full h-full bg-surface-variant flex items-center justify-center text-outline text-[10px]">Sin foto</div>
                                                    @endif
                                                </div>
                                                <span class="font-semibold text-body-lg">{{ $product->title }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-body-sm">{{ $product->user->first_name.' '.$product->user->last_name  ?? 'Sin asignar' }}</td>
                                        <td class="px-6 py-4 text-right font-body-lg font-bold">${{ number_format((float)$product->price, 2) }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 rounded-full {{ $product->is_active ? 'bg-tertiary-fixed' : 'bg-error-container' }} text-[10px] font-bold">
                                                {{ $product->is_active ? 'ACTIVO' : 'INACTIVO' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-primary hover:bg-primary-fixed p-1 rounded-full"><span class="material-symbols-outlined">edit</span></a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-error hover:bg-error-container p-1 rounded-full ml-2"><span class="material-symbols-outlined">delete</span></button>
                                            </form>
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
                                <div class="p-4 bg-surface-container-low rounded-lg border border-outline-variant">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <p class="font-bold text-primary">Juan P.</p>
                                            <div class="flex text-secondary-container">
                                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                                <span class="material-symbols-outlined text-xs">star</span>
                                            </div>
                                        </div>
                                        <span class="text-[10px] text-on-surface-variant font-medium">HACE 1H</span>
                                    </div>
                                    <p class="text-body-sm text-on-surface italic mb-4">"¿Haces envíos a domicilio hoy mismo? Me urge para un regalo."</p>
                                    <div class="flex gap-2 justify-end">
                                        <button class="px-3 py-1 text-[11px] font-bold border border-error text-error rounded-md hover:bg-error-container transition-colors">Rechazar</button>
                                        <button class="px-3 py-1 text-[11px] font-bold bg-primary text-on-primary rounded-md hover:brightness-110 transition-all">Aprobar</button>
                                    </div>
                                </div>
                                <div class="p-4 bg-surface-container-low rounded-lg border border-outline-variant">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <p class="font-bold text-primary">Sofía R.</p>
                                            <div class="flex text-secondary-container">
                                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                            </div>
                                        </div>
                                        <span class="text-[10px] text-on-surface-variant font-medium">HACE 2H</span>
                                    </div>
                                    <p class="text-body-sm text-on-surface italic mb-4">"Llegó en perfecto estado y muy rápido. Recomendado."</p>
                                    <div class="flex gap-2 justify-end">
                                        <button class="px-3 py-1 text-[11px] font-bold border border-error text-error rounded-md hover:bg-error-container">Rechazar</button>
                                        <button class="px-3 py-1 text-[11px] font-bold bg-primary text-on-primary rounded-md hover:brightness-110">Aprobar</button>
                                    </div>
                                </div>
                            </div>
                            <button class="m-6 mt-0 py-2 border border-outline text-on-surface font-bold rounded-lg hover:bg-surface-container-high transition-all text-sm">Ver todos los pendientes</button>
                        </div>
                        <!-- Advertising Management -->
                        <div class="bg-surface-container-lowest rounded-lg border border-outline-variant shadow-sm flex flex-col">
                            <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-white">
                                <h2 class="font-headline-md text-on-surface">Gestión de Publicidad</h2>
                                <span class="material-symbols-outlined text-secondary">campaign</span>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="relative group cursor-pointer overflow-hidden rounded-lg border border-outline-variant aspect-video bg-surface-container">
                                        <img alt="Banner Ads" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDPjNF-5b-GDjijf-lyDcJpzlbFnWYEMLR7YSdc-tbTd57MXLnazyA2ZzcF_ZdwbrMAxQ2yI7azPmVNxLz3brTQ8yvO2XYP6Sqg9_cb1TgU5v8yshyMK1Da_mM9wBuAryAyIoe8c2cPiybuycqYz7BMHCr8oEMOM1RMcG6eW_Zc0wL6SxgbLPYxP9BfcRQH8n4Gow7xeb8JJtWELX-q7shopWba7MJUs_dbr5mTaxXLHI9gz7E62PwZBglsetI6R95FRL2xU5VSEvQ">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                            <button class="p-1.5 bg-white rounded-full text-primary"><span class="material-symbols-outlined text-sm">edit</span></button>
                                            <button class="p-1.5 bg-white rounded-full text-error"><span class="material-symbols-outlined text-sm">delete</span></button>
                                        </div>
                                        <div class="absolute bottom-2 left-2 bg-secondary text-on-secondary text-[9px] px-1.5 py-0.5 rounded font-bold uppercase">Activo</div>
                                    </div>
                                    <div class="relative group cursor-pointer overflow-hidden rounded-lg border border-outline-variant aspect-video bg-surface-container">
                                        <img alt="Banner Ads" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbXZQn-3yEBjNuEcf3NugxSszgwR_KNGydyugfEkS9WHs19qafrpma4bJ6Og5_iKBwHiL-rSWUTqZbPIVEBcm2NsWKF4iTe0qQ23PKf2Zspa1tIWzlmUyHOcbUKrYWo_uMX9EAVsm-EYBrodaSY36HgHvz9SeC8K2iAy3E2jQZf7_a99f9aaEKSIN8d733i4EIqwSJmlQE1gDfhzu3RD1ucoON9ZSagRQPfhUGZ1RwNpxhnHVKb2mz7D8xvBK7gOYkmkT0n_8olGo">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                            <button class="p-1.5 bg-white rounded-full text-primary"><span class="material-symbols-outlined text-sm">edit</span></button>
                                            <button class="p-1.5 bg-white rounded-full text-error"><span class="material-symbols-outlined text-sm">delete</span></button>
                                        </div>
                                        <div class="absolute bottom-2 left-2 bg-outline text-white text-[9px] px-1.5 py-0.5 rounded font-bold uppercase">Pausado</div>
                                    </div>
                                </div>
                                <div class="bg-primary-container/10 p-4 rounded-lg border border-primary/20 mt-2">
                                    <p class="font-body-sm font-semibold text-primary mb-1">Campaña Global de Verano</p>
                                    <p class="text-[12px] text-on-surface-variant">Click-through rate: 4.2% • Impresiones hoy: 12.5k</p>
                                </div>
                            </div>
                            <div class="p-6 pt-0 mt-auto">
                                <button class="w-full bg-primary text-on-primary font-bold py-3 rounded-lg flex items-center justify-center gap-2 hover:brightness-110 active:scale-[0.98] transition-all">
                                    <span class="material-symbols-outlined">add_photo_alternate</span>
                                    Subir Nuevo Anuncio
                                </button>
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
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="#">Privacidad de Datos</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="#">Términos de Moderación</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="#">Protocolos Admin</a>
                        </nav>
                    </div>
                    <div class="space-y-3">
                        <p class="font-label-caps text-secondary font-bold uppercase">ACCESOS RÁPIDOS</p>
                        <nav class="flex flex-col gap-2">
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="#">Gestionar Publicaciones</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="#">Gestionar Comentarios</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="#">Gestionar Publicidad</a>
                        </nav>
                    </div>
                    <div class="space-y-3">
                        <p class="font-label-caps text-secondary font-bold uppercase">SOPORTE ADMIN</p>
                        <nav class="flex flex-col gap-2">
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="#">Centro de Ayuda</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="#">Reportar Incidencia</a>
                            <a class="text-surface-variant text-body-sm hover:text-white transition-colors" href="#">Manual de Uso</a>
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