<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>MarketPlace Plus | Catálogo Principal</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "inverse-surface": "#2e3132",
                        "on-error": "#ffffff",
                        "primary-fixed-dim": "#b0c6ff",
                        "background": "#f8f9fa",
                        "secondary-fixed": "#ffdcc6",
                        "surface-container-highest": "#e1e3e4",
                        "on-secondary-fixed": "#311300",
                        "primary-container": "#0d47a1",
                        "tertiary": "#003f0b",
                        "inverse-primary": "#b0c6ff",
                        "on-primary-fixed-variant": "#00429c",
                        "surface-dim": "#d9dadb",
                        "surface-tint": "#2b5bb5",
                        "error": "#ba1a1a",
                        "tertiary-container": "#005914",
                        "on-primary-container": "#a1bbff",
                        "surface-variant": "#e1e3e4",
                        "on-surface": "#191c1d",
                        "surface-bright": "#f8f9fa",
                        "secondary-fixed-dim": "#ffb786",
                        "outline": "#737783",
                        "on-secondary-container": "#5e2c00",
                        "tertiary-fixed-dim": "#88d982",
                        "secondary-container": "#fc820c",
                        "primary": "#003178",
                        "surface-container-lowest": "#ffffff",
                        "inverse-on-surface": "#f0f1f2",
                        "error-container": "#ffdad6",
                        "on-background": "#191c1d",
                        "surface-container": "#edeeef",
                        "tertiary-fixed": "#a3f69c",
                        "surface-container-low": "#f3f4f5",
                        "on-primary-fixed": "#001945",
                        "on-tertiary-fixed": "#002204",
                        "on-tertiary-fixed-variant": "#005312",
                        "surface": "#f8f9fa",
                        "on-secondary-fixed-variant": "#723600",
                        "on-tertiary-container": "#7ecf79",
                        "secondary": "#964900",
                        "outline-variant": "#c3c6d4",
                        "surface-container-high": "#e7e8e9",
                        "on-error-container": "#93000a",
                        "primary-fixed": "#d9e2ff",
                        "on-surface-variant": "#434652",
                        "on-tertiary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "base": "8px",
                        "sidebar-width": "280px",
                        "margin-mobile": "16px",
                        "container-max": "1280px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Inter"],
                        "body-sm": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-caps": ["Inter"],
                        "headline-md": ["Inter"],
                        "price-display": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }],
                        "body-sm": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
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
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "700"
                        }],
                        "headline-md": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "price-display": ["24px", {
                            "lineHeight": "24px",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #e0e0e0;
            border-radius: 10px;
        }

        .product-card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="text-on-background">
    <!-- TopNavBar -->
    <header class="bg-surface-container-lowest dark:bg-inverse-surface border-b border-outline-variant dark:border-outline sticky top-0 z-50">
        <div class="flex justify-between items-center w-full px-margin-mobile md:px-gutter py-2 max-w-container-max mx-auto h-16">
            <div class="flex items-center gap-6">
                <span class="text-headline-md font-headline-md font-bold text-primary dark:text-inverse-primary cursor-pointer">MarketPlace Plus</span>
                <div class="hidden md:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant w-96">
                    <span class="material-symbols-outlined text-outline mr-2" data-icon="search">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-body-sm w-full" placeholder="¿Qué vas a comprar hoy?" type="text">
                </div>
            </div>
            <nav class="flex items-center gap-6">
                <div class="hidden md:flex gap-4">
                    <a href="{{ route('home') }}" class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-fixed-dim transition-colors text-label-caps font-label-caps flex items-center gap-1 active:scale-95 duration-150">
                        <span class="material-symbols-outlined text-[20px]" data-icon="home">home</span>
                    </a>
                    <a href="{{ route('proximamente') }}" class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-fixed-dim transition-colors text-label-caps font-label-caps flex items-center gap-1 active:scale-95 duration-150">
                        <span class="material-symbols-outlined text-[20px]" data-icon="favorite">favorite</span>
                    </a>
                    <a href="{{ route('tratos.index') }}" class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-fixed-dim transition-colors text-label-caps font-label-caps flex items-center gap-1 active:scale-95 duration-150">
                        <span class="material-symbols-outlined text-[20px]" data-icon="handshake">handshake</span>
                    </a>
                </div>
                <div class="flex items-center gap-3 border-l pl-6 border-outline-variant">
                    @auth
                    <img alt="User Profile" class="w-8 h-8 rounded-full border border-primary" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCKE6DBzVhu_JwP93s-Ym6TVG7tOYSGuYclbZnEH-KDA37hRFacmAPd2A9WnHtIyjWBvGVMTO90Xk0RM3qIpTyB32f6oNhOviuZpzZUm3q1dq-0fbhidDoCkZiThytJL3XYG8DXQ6HZ0KM8TFaM_B74c-Xii2wyl3P_ARGbncPmp0xp6x--QNEqbJQ7LOpDwNXxG4M_d2NoEbPheULCfl7-bxfCYlc2sJTtpV2iWJMZvSg8-y7NLvcpnX0P2tvTnPSFZzdk2PhJyHw">
                    <span class="hidden md:block text-label-caps font-label-caps text-primary">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </span>
                    @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 text-body-md font-semibold text-primary hover:underline">
                        <span class="material-symbols-outlined text-base">account_circle</span>
                        Invitado (Para ver esta zona, inicia sesión)
                    </a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>
    <div class="max-w-container-max mx-auto flex">
        <!-- SideNavBar -->
        <aside class="hidden lg:flex flex-col h-[calc(100vh-64px)] w-sidebar-width p-base gap-gutter bg-surface-container-lowest dark:bg-inverse-surface border-r border-outline-variant dark:border-outline sticky top-16 overflow-y-auto sidebar-scroll">
            @auth
            <div class="flex flex-col items-center gap-3 mb-4">
                <div class="relative">
                    @if(!empty(auth()->user()->foto))
                    <img alt="Avatar del Comprador" class="w-24 h-24 rounded-full object-cover border-2 border-primary" src="{{ asset('storage/' . auth()->user()->foto) }}">
                    @else
                    <img alt="Avatar por defecto" class="w-24 h-24 rounded-full object-cover border-2 border-primary" src="{{ asset('img/icon_default.jpg') }}">
                    @endif
                    <div class="absolute bottom-1 right-1 w-5 h-5 bg-tertiary-fixed rounded-full border-2 border-surface-container-lowest"></div>
                </div>
                <div class="text-center">
                    <h2 class="text-headline-md font-headline-md font-bold text-primary">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </h2>
                    <p class="text-body-sm text-outline">Cliente</p>
                </div>
            </div>
            @else
            <div class="bg-surface-container-lowest p-4 rounded-xl border border-outline-variant text-center mb-4 custom-shadow">
                <span class="material-symbols-outlined text-[40px] text-secondary mb-2 inline-block">rocket_launch</span>
                <h3 class="font-headline-md text-on-surface mb-1 text-sm font-bold">¡Únete a la comunidad!</h3>
                <p class="text-body-sm text-on-surface-variant mb-4">
                    Regístrate para publicar productos, gestionar tus compras y conectar de forma segura.
                </p>
                <div class="space-y-2">
                    <a href="{{ route('register') }}" class="block w-full py-2 bg-primary text-on-primary font-semibold rounded-lg text-body-sm hover:brightness-110 transition-all">
                        Crear cuenta nueva
                    </a>
                    <a href="{{ route('login') }}" class="block w-full py-2 bg-surface-container border border-outline-variant text-on-surface font-semibold rounded-lg text-body-sm hover:bg-surface-container-high transition-all">
                        Ingresar
                    </a>
                </div>
            </div>
            @endauth
            <a href="{{ route('seller.panel') }}" class="w-full block text-center py-3 px-4 bg-[#003178] text-white rounded-2xl font-bold transition-all hover:brightness-110">
                Cambiar a Vendedor
            </a>
            <nav class="flex flex-col gap-1">
                <a class="flex items-center gap-3 p-3 bg-primary-container text-on-primary-container font-bold rounded-xl transition-all translate-x-1 duration-200" href="{{ route('home') }}">
                    <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                    <span class="text-body-lg font-body-lg">Panel</span>
                </a>
                <a class="flex items-center gap-3 p-3 text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all" href="{{ route('tratos.index') }}">
                    <span class="material-symbols-outlined" data-icon="handshake">handshake</span>
                    <span class="text-body-lg font-body-lg">Mis Tratos</span>
                </a>
                <a class="flex items-center gap-3 p-3 text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all" href="{{ route('proximamente') }}">
                    <span class="material-symbols-outlined" data-icon="local_shipping">local_shipping</span>
                    <span class="text-body-lg font-body-lg">Delivery</span>
                </a>
                <a class="flex items-center gap-3 p-3 text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all" href="{{ route('comprobantes.index') }}">
                    <span class="material-symbols-outlined" data-icon="receipt_long">receipt_long</span>
                    <span class="text-body-lg font-body-lg">Mis Comprobantes</span>
                </a>
                <div class="my-4 border-t border-outline-variant"></div>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-body-sm text-error hover:bg-error/10 rounded-lg text-left">
                        <span class="material-symbols-outlined text-base" data-icon="logout">logout</span>
                        Cerrar sesión
                    </button>
                </form>
                <form id="logout-form" action="{{ route('login') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
            <!-- Publicidad Widget: usa el segundo banner activo de la base de datos -->
            @php
                $sideBanner  = $banners->get(1);
                $sideImgSrc  = null;
                if ($sideBanner?->image_path) {
                    $sideImgSrc = Str::startsWith($sideBanner->image_path, 'http')
                        ? $sideBanner->image_path
                        : Storage::url($sideBanner->image_path);
                }
            @endphp
            <div class="mt-auto rounded-xl overflow-hidden relative group min-h-[180px] bg-inverse-surface text-on-primary">
                @if($sideImgSrc)
                    <img alt="{{ $sideBanner->title }}"
                         class="absolute inset-0 w-full h-full object-cover object-center opacity-50 group-hover:scale-110 transition-transform duration-700"
                         src="{{ $sideImgSrc }}">
                @endif
                <div class="relative z-10 p-4 flex flex-col h-full min-h-[180px]">
                    <span class="text-[10px] font-bold uppercase tracking-widest opacity-70">Publicidad</span>
                    <h3 class="text-headline-md font-bold mt-1">{{ $sideBanner?->title ?? 'Oferta Especial' }}</h3>
                    <p class="text-body-sm mt-2 opacity-80">Nuevos modelos Nike Air ya disponibles.</p>
                    <a href="{{ $sideBanner?->link_url ?? '#' }}" target="_blank" rel="noopener"
                       class="mt-4 self-start px-4 py-1.5 border border-white rounded-full text-label-caps hover:bg-white hover:text-primary transition-colors">
                        Ver más
                    </a>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 min-w-0 p-4 md:p-gutter">
            <!-- Hero Banner: usa el primer banner activo de la base de datos -->
            @php
                $heroBanner   = $banners->get(0);
                $heroImgSrc   = null;
                if ($heroBanner?->image_path) {
                    $heroImgSrc = Str::startsWith($heroBanner->image_path, 'http')
                        ? $heroBanner->image_path
                        : Storage::url($heroBanner->image_path);
                }
                $heroLink = $heroBanner?->link_url ?? '#';
            @endphp
            <section class="mb-10 rounded-2xl overflow-hidden bg-primary-container relative h-[300px] md:h-[400px] flex items-center">
                @if($heroImgSrc)
                    <img alt="{{ $heroBanner->title }}"
                         class="absolute inset-0 w-full h-full object-cover opacity-30"
                         src="{{ $heroImgSrc }}">
                @endif
                <div class="relative z-10 px-8 md:px-16 max-w-2xl">
                    <span class="inline-block px-3 py-1 bg-secondary-container text-on-secondary text-label-caps rounded-full mb-4">Lanzamiento 2026</span>
                    <h1 class="text-headline-lg-mobile md:text-headline-lg text-on-primary mb-4 leading-tight">
                        {{ $heroBanner?->title ?? 'MarketPlace Plus' }}
                    </h1>
                    <p class="text-body-lg text-primary-fixed-dim mb-8">Experimenta la innovación con los nuevos equipos de alta gama disponibles para trato directo.</p>
                    <a href="{{ $heroLink }}" target="_blank" rel="noopener"
                       class="px-8 py-3 bg-secondary-container text-on-secondary font-bold rounded-xl inline-flex items-center gap-2 hover:shadow-lg transition-shadow">
                        Comprar Ahora
                        <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
                    </a>
                </div>
            </section>
            <!-- Product Grid -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-headline-md font-headline-md text-primary">Catálogo Destacado</h2>
                <div class="flex items-center gap-2">
                    <span class="text-body-sm text-outline">Ordenar por:</span>
                    <select class="bg-surface-container-low border-none text-body-sm rounded-lg focus:ring-primary py-1 px-3">
                        <option>Más recientes</option>
                        <option>Menor precio</option>
                        <option>Mayor precio</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter mb-12">

                {{-- ===== TARJETAS DINÁMICAS desde la base de datos ===== --}}
                @foreach($products as $product)
                @php
                    // Primera imagen del producto; si es URL externa la usamos directo, si no, Storage::url()
                    $images = $product->image_path ?? [];
                    $thumb  = $images[0] ?? null;
                    $imgSrc = $thumb
                        ? (Str::startsWith($thumb, 'http') ? $thumb : Storage::url($thumb))
                        : null;
                @endphp
                {{-- El <a> convierte toda la tarjeta en un enlace al detalle del producto --}}
                <a href="{{ route('products.show', $product) }}"
                   class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden product-card-hover flex flex-col group">
                    <div class="aspect-square bg-surface-container overflow-hidden">
                        @if($imgSrc)
                            <img alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $imgSrc }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-outline" style="font-size:48px">image</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1">{{ $product->category }}</p>
                        <h3 class="text-headline-md text-on-surface line-clamp-1 mb-2">{{ $product->title }}</h3>
                        <div class="mt-auto">
                            <p class="text-price-display text-primary">S/. {{ number_format($product->price, 2) }}</p>
                            {{-- El botón es solo visual; el click lo maneja el <a> padre --}}
                            <div class="w-full mt-4 py-3 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined" data-icon="handshake" style="font-variation-settings: 'FILL' 1;">handshake</span>
                                Trato Directo
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

            
            <!-- Simple Pagination -->
            <div class="mt-12 py-8 border-t border-outline-variant flex justify-center w-full">
                <div class="w-full max-w-fit">
                    {{ $products->links() }}
                </div>
            </div>
        </main>
    </div>
    <!-- Footer -->
    <footer class="w-full mt-gutter bg-inverse-surface dark:bg-surface-container-lowest">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-mobile md:px-gutter py-12 max-w-container-max mx-auto">
            <div class="md:col-span-1">
                <span class="text-headline-md font-headline-md font-bold text-on-primary dark:text-primary">MarketPlace Plus</span>
                <p class="text-body-sm text-surface-variant dark:text-on-surface-variant mt-4">La plataforma líder para conectar compradores y vendedores de forma directa y segura.</p>
            </div>
            <div>
                <h4 class="text-label-caps font-label-caps text-on-primary dark:text-primary mb-6">Enlaces Rápidos</h4>
                <ul class="flex flex-col gap-3">
                    <li class=""><a class="text-body-sm text-surface-variant dark:text-on-surface-variant hover:text-on-primary transition-colors" href="{{ route('home') }}">Comprar producto</a></li>
                    <li class=""><a class="text-body-sm text-surface-variant dark:text-on-surface-variant hover:text-on-primary transition-colors" href="{{ route('tratos.index') }}">Mis tratos</a></li>
                    <li class=""><a class="text-body-sm text-surface-variant dark:text-on-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Rastrear pedido</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-label-caps font-label-caps text-on-primary dark:text-primary mb-6">Soporte</h4>
                <ul class="flex flex-col gap-3">
                    <li class=""><a class="text-body-sm text-surface-variant dark:text-on-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Ayuda al cliente</a></li>
                    <li class=""><a class="text-body-sm text-surface-variant dark:text-on-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Sobre nosotros</a></li>
                    <li class=""><a class="text-body-sm text-surface-variant dark:text-on-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Términos y condiciones</a></li>
                </ul>
            </div>

            <div class="md:col-span-1">
                <h4 class="text-label-caps font-label-caps mb-6 uppercase tracking-wider text-white">Recomendaciones para tus tratos</h4>
                <div class="flex flex-col gap-4 p-4 rounded-xl">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-base text-white" data-icon="verified_user">verified_user</span>
                        <p class="text-body-sm leading-tight text-white">Verifica la reputación del vendedor</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-base text-white" data-icon="location_on">location_on</span>
                        <p class="text-body-sm leading-tight text-white">Realiza tus tratos en lugares públicos</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-base text-white" data-icon="chat_bubble">chat_bubble</span>
                        <p class="text-body-sm leading-tight text-white">Usa WhatsApp para mayor seguridad</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-base text-white" data-icon="security">security</span>
                        <p class="text-body-sm leading-tight text-white">No compartas datos bancarios sensibles</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-outline/30 py-6 px-gutter max-w-container-max mx-auto text-center">
            <p class="text-body-sm text-surface-variant/60">Market Place Plus - eCommerce Template © 2026. Design by Templatecookie</p>
        </div>
    </footer>
    <script>
        // Micro-interactions and effects
        document.querySelectorAll('.product-card-hover').forEach(card => {
            card.addEventListener('mouseenter', () => {
                const icon = card.querySelector('.material-symbols-outlined[data-icon="handshake"]');
                if (icon) {
                    icon.style.transition = 'transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                    icon.style.transform = 'scale(1.2) rotate(-10deg)';
                }
            });
            card.addEventListener('mouseleave', () => {
                const icon = card.querySelector('.material-symbols-outlined[data-icon="handshake"]');
                if (icon) {
                    icon.style.transform = 'scale(1) rotate(0deg)';
                }
            });
        });
    </script>


</body>

</html>