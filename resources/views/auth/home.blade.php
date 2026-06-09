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
                    <button class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-fixed-dim transition-colors text-label-caps font-label-caps flex items-center gap-1 active:scale-95 duration-150">
                        <span class="material-symbols-outlined text-[20px]" data-icon="home">home</span>
                    </button>
                    <button class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-fixed-dim transition-colors text-label-caps font-label-caps flex items-center gap-1 active:scale-95 duration-150">
                        <span class="material-symbols-outlined text-[20px]" data-icon="favorite">favorite</span>
                    </button>
                    <button class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-fixed-dim transition-colors text-label-caps font-label-caps flex items-center gap-1 active:scale-95 duration-150">
                        <span class="material-symbols-outlined text-[20px]" data-icon="handshake">handshake</span>
                    </button>
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
            <div class="flex flex-col items-center gap-2 mb-4">
                <div class="relative">
                    <img alt="User Avatar" class="w-20 h-20 rounded-full border-2 border-primary-container p-0.5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAFHNtEgrHwb-LA7yua_F_VPYR8tRwrDM1uKo4U7ZgD2uctNs-dKmA_Dl_HZvJHU8RpBvXZgaVPDh0u1DZJAAKU7Zxx_b25R1nPPPYRERuDHb7TLoFkjc-7CJ1qmPVqzi326FFBSigtwTXuOO00zgSn-ZHmPeRqA2QhRUaOo6h9uvgK4herEbgC4loH3JNWU5YxV_Jye6CjnxkwRjKB4cDnWiI4tjSH6CjQR5xvUxwN8gLp7qXz0CaoCApL-SM8aEcGz-udSKNwjlU">
                    <div class="absolute bottom-1 right-1 w-4 h-4 bg-tertiary-fixed rounded-full border-2 border-surface-container-lowest"></div>
                </div>
                <div class="text-center">
                    <h2 class="text-headline-md font-headline-md font-bold text-primary">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </h2>
                    <p class="text-body-sm text-outline">Comprador</p>
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
                <a class="flex items-center gap-3 p-3 bg-primary-container text-on-primary-container font-bold rounded-xl transition-all translate-x-1 duration-200" href="{{ route('proximamente') }}">
                    <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                    <span class="text-body-lg font-body-lg">Panel</span>
                </a>
                <a class="flex items-center gap-3 p-3 text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all" href="{{ route('proximamente') }}">
                    <span class="material-symbols-outlined" data-icon="handshake">handshake</span>
                    <span class="text-body-lg font-body-lg">Mis Tratos</span>
                </a>
                <a class="flex items-center gap-3 p-3 text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all" href="{{ route('proximamente') }}">
                    <span class="material-symbols-outlined" data-icon="local_shipping">local_shipping</span>
                    <span class="text-body-lg font-body-lg">Delivery</span>
                </a>
                <a class="flex items-center gap-3 p-3 text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all" href="{{ route('proximamente') }}">
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
            <!-- Publicidad Widget Nike -->
            <div class="mt-auto p-4 bg-inverse-surface text-on-primary rounded-xl overflow-hidden relative group">
                <img alt="Nike Ad" class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:scale-110 transition-transform duration-700" data-alt="A professional product shot of a classic red Nike sneaker against a clean studio background. The lighting is crisp and modern, highlighting the shoe's sleek design. The overall aesthetic is high-end corporate retail with a focus on vibrant colors and minimalist composition, fitting a professional marketplace theme." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxNXZItFVZyu0FVJOgTUzHeif_LIpHFF_8KbqQd5AA9-XRbSZuZcucYphlOeTlFpRPEdliKY3yVzQfD1t9Kkz0zpEfTwXFXPLWLFsclecwkQM4K6D9pZ-FEOt-7MortoLOTjtO6PK2_HtO1YjWi69Hsp8gMncmy6USw61kPH0ZDvUvVnacKVk-8YcdSEOaRJqDDq-qxznUQug80P1_aC3OP-3IfGfulmDSaBh-oENHYtRKqkZqa1dQq8Z-ut_0aHTDmil-qePPlcU">
                <div class="relative z-10">
                    <span class="text-[10px] font-bold uppercase tracking-widest opacity-70">Publicidad</span>
                    <h3 class="text-headline-md font-bold mt-1">Just Do It.</h3>
                    <p class="text-body-sm mt-2">Nuevos modelos Nike Air ya disponibles.</p>
                    <button class="mt-4 px-4 py-1.5 border border-white rounded-full text-label-caps hover:bg-white hover:text-primary transition-colors">Ver Nike</button>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 min-w-0 p-4 md:p-gutter">
            <!-- Hero Banner -->
            <section class="mb-10 rounded-2xl overflow-hidden bg-primary-container relative h-[300px] md:h-[400px] flex items-center">
                <img alt="Promo Hero" class="absolute inset-0 w-full h-full object-cover opacity-30" data-alt="A futuristic tech-focused scene featuring high-end laptops and mobile devices floating in a vibrant abstract digital space. Bold orange and blue gradients dominate the composition, creating a high-energy call-to-action atmosphere. The lighting is cinematic and clean, emphasizing speed and professional reliability for a modern tech marketplace." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAW5P4yXrDqkEWq_SRw0ftj7R3nOxTkuRrDyxxVLreNHFN1RITU5U33PYmWh6_aZK4bDXoSyDoatkJ-SISRRqJXLb7OOTbyP3yudFJMtHDeB84izJF4XDUZHEIjNwwy1kLNPK45KK1-55dU0FlbWO5VDxb_Dh7WHSUbaoEPBlCCutCtRh4sj18xEirFQe0yE7-9LlXFurWU20mRThi6Vjh6vpZBD27lLD9gzXBjIv9BVRoUveKfzVnxAdeJ0wezn4F3SPdxtIfz8XE">
                <div class="relative z-10 px-8 md:px-16 max-w-2xl">
                    <span class="inline-block px-3 py-1 bg-secondary-container text-on-secondary text-label-caps rounded-full mb-4">Lanzamiento 2026</span>
                    <h1 class="text-headline-lg-mobile md:text-headline-lg text-on-primary mb-4 leading-tight">Future Tech Unleashed</h1>
                    <p class="text-body-lg text-primary-fixed-dim mb-8">Experimenta la innovación con los nuevos equipos de alta gama disponibles para trato directo.</p>
                    <button class="px-8 py-3 bg-secondary-container text-on-secondary font-bold rounded-xl flex items-center gap-2 hover:shadow-lg transition-shadow">
                        Comprar Ahora
                        <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
                    </button>
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
                <!-- Product Card 1 -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden product-card-hover flex flex-col">
                    <div class="aspect-square bg-surface-container overflow-hidden">
                        <img alt="MacBook Pro" class="w-full h-full object-cover" data-alt="A clean, minimalist product shot of a silver MacBook Pro sitting on a light gray surface. The lighting is soft and even, highlighting the sleek metallic finish and premium build quality. The composition is centered and professional, reflecting a high-trust intermediary marketplace aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4I-KrUMLgKxiMq78qgde3oBQoIabPS5IXNI_gPK44PtLHbGaE6Ja6VnZHexveGUUM3RRRMgrBtt9iltlEpLVuqer_RB0EQyqu088RE7g4ltK7RF_yi9Gec3LnUpSYKwxNElcbyiJ-CJESLzNbxqameH21wi9fwYF1iku1QEkjWEKrEkLB9BlITuqgXdt5KhOdNH6NUL3hDauA2wP2nr3buUlv5YfqRzcJUwZXQPSzDcGAVAuFSSi2t3e5X9fX-NuQuMifnRXte-k">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1">Laptops</p>
                        <h3 class="text-headline-md text-on-surface line-clamp-1 mb-2">MacBook Pro M3 512GB</h3>
                        <div class="mt-auto">
                            <p class="text-price-display text-primary">S/. 950.00</p>
                            <button class="w-full mt-4 py-3 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined" data-icon="handshake" style="font-variation-settings: 'FILL' 1;">handshake</span>
                                Trato Directo
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Product Card 2 -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden product-card-hover flex flex-col">
                    <div class="aspect-square bg-surface-container overflow-hidden">
                        <img alt="Sony Headphones" class="w-full h-full object-cover" data-alt="A studio portrait of premium black over-ear noise-cancelling headphones. The lighting creates subtle highlights on the matte texture of the product. The background is a neutral light gray, emphasizing the high-tech functional design suited for a professional electronic marketplace." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBb4goNJdR7GVj57882ULwnl1--zCNjyTuZpowtxrmjBpQ0C7XmIQ7xJhtt-nzBSd3nW73tL_ZGfspRortqfwtqjIzHbyX_TS5vMafDEO4XiRtWA1VNJrgDf5MkSiY8FNk3QbFijs5Tv2V56SYYXMPVB1b9wQhb3n81aTC91X_budflUs0EUbNgk9XBC05WYnXM_vD3vd8GtWB-HufEg5ls3q9VM_pYX-Uva4IC5cmZKijyULChyHfEzsH7r7oXOCY-SrUGuTIH-0s">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1">Audio</p>
                        <h3 class="text-headline-md text-on-surface line-clamp-1 mb-2">Sony WH-1000XM5 ANC</h3>
                        <div class="mt-auto">
                            <p class="text-price-display text-primary">S/. 520.00</p>
                            <button class="w-full mt-4 py-3 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined" data-icon="handshake" style="font-variation-settings: 'FILL' 1; transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); transform: scale(1) rotate(0deg);">handshake</span>
                                Trato Directo
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Product Card 3 -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden product-card-hover flex flex-col">
                    <div class="aspect-square bg-surface-container overflow-hidden">
                        <img alt="Samsung S24" class="w-full h-full object-cover" data-alt="A modern smartphone with a large vibrant screen showing abstract colorful wallpapers. The device is captured at a slight angle to showcase its slim profile and premium build materials. Soft professional lighting creates a clean, commercial look perfect for an online tech catalog." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4LEcD_s3WUNR_hZNmTWZecZn6D8ffGkjIfakXo_Tj5Gn955OjTQdtB6j5K7ipOIJE29JdiZUi-lQJTu5Rd43pJHGNEH77Z-lwKpjYrqYNQzvYbqymbnw-63JcvTk2AyiUjj-14ktXbISxOC82RaT48yMDM5TBNeWAeKoqJJL6j3G99kWPvH6aZ_19wOcUtS2RUYdCYj7mK-xQoyk_UNt_evWjvuhcuO-iybz9_NkuMyfuIUiBN7kGGtDtB9RhE0DQt_Wey-_eEVE">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1">Celulares</p>
                        <h3 class="text-headline-md text-on-surface line-clamp-1 mb-2">Samsung Galaxy S24 Ultra</h3>
                        <div class="mt-auto">
                            <p class="text-price-display text-primary">S/. 850.00</p>
                            <button class="w-full mt-4 py-3 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined" data-icon="handshake" style="font-variation-settings: 'FILL' 1;">handshake</span>
                                Trato Directo
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Product Card 4 -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden product-card-hover flex flex-col">
                    <div class="aspect-square bg-surface-container overflow-hidden">
                        <img alt="Watch" class="w-full h-full object-cover" data-alt="A close-up shot of a modern minimalist white smartwatch. The focus is on the watch face and the clean silicone strap. The overall aesthetic is bright and high-key, using soft daylight to create an inviting yet professional product presentation for a reliable marketplace." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBsjk8L9h_dChU7lH5dSqXiwZW8ac83gM7CRqP5RSw726gVHQWhUKFXK55D3v0wdJBvKIgnDIx7yqSeO5cbzRFath7aov4_C-yTxn33xbUEOd0LrSWpFKPwdY97eyYHX0RkhKd-of2Ie1zZjoi_bTc4yPip0n1oBgTuYl-b5C_piwcD4r-3AG-3B0X3_WTwm6X2-yABMpRcxkj1eMCJ6xeDHIFQEPiFIxI6IvKFn837iyooYY2YCZ4v_QRyGM43JEOWy6873IxS4bY">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1">Wearables</p>
                        <h3 class="text-headline-md text-on-surface line-clamp-1 mb-2">Apple Watch Series 9</h3>
                        <div class="mt-auto">
                            <p class="text-price-display text-primary">S/. 420.00</p>
                            <button class="w-full mt-4 py-3 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined" data-icon="handshake" style="font-variation-settings: 'FILL' 1;">handshake</span>
                                Trato Directo
                            </button>
                        </div>
                    </div>
                </div>
                <!-- More products to fill grid -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden product-card-hover flex flex-col">
                    <div class="aspect-square bg-surface-container overflow-hidden">
                        <img alt="TV" class="w-full h-full object-cover" data-alt="A sleek flat-screen television displaying a high-resolution nature landscape. The frame is minimal and thin, set against a modern interior backdrop. Lighting is soft and atmospheric, highlighting the premium quality of home entertainment technology in a clean corporate style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8jtbZMr_luf1-RUq9Efx1xY81ZmlVZR9W1B-OO7NZhv9riR-UkcLEmtamvZfJe69J--NUMoC5M-_zKcnX_RMPjibVEsE5e7uNDI2YTrpSZiVUgm1dqfMktGTvYRxCEYjIIVGv3lSdqqPoW6ZAJ4w7c9YKWTGbkY1jDWD9VlOMAHPYdYBe7_uitkk8p9NijS8cmiPs27CM6b8nZbeaRkkJn15PbdHTAnjK-Tb0lsUln5PjMRbPuYtNeGyzTNeTliok16Lpd8va2iw">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1">Smart Home</p>
                        <h3 class="text-headline-md text-on-surface line-clamp-1 mb-2">Smart TV OLED 55"</h3>
                        <div class="mt-auto">
                            <p class="text-price-display text-primary">S/. 780.00</p>
                            <button class="w-full mt-4 py-3 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined" data-icon="handshake" style="font-variation-settings: 'FILL' 1; transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); transform: scale(1) rotate(0deg);">handshake</span>
                                Trato Directo
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden product-card-hover flex flex-col">
                    <div class="aspect-square bg-surface-container overflow-hidden">
                        <img alt="Shoes" class="w-full h-full object-cover" data-alt="A side view of a vibrant red athletic sneaker. The image is captured with professional studio lighting, creating deep shadows and bright highlights that emphasize the textures of the fabric and the sleek sole. The background is a clean white, typical for high-end e-commerce." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBZpBkEsXSKxB9zefH2xU_8CnVxFzN_hHFk6Kh0MeE2Zkd6jQuywi-RCL7alnZ2fPfeYNdI5gwPHN1foxqpJ1Bi_B6ovrLznO8q2jGK3O-78TWqAYIUiuNQl58SVDT-TJX_dRsyFJPq-DHcFT3VZUcjMVJ1RWdZF098GPRz2BKGdYEsUn_zUGTxUAZSnlX4ooSVL0t-3mBu9DyUYlfYTjzn-mTrxGgQdlwr01k1gzNY10koXOVg-BTZLnKJoMSCLjEuGxr7qTj93pg">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1">Deportes</p>
                        <h3 class="text-headline-md text-on-surface line-clamp-1 mb-2">Zapatillas Pro Runner X</h3>
                        <div class="mt-auto">
                            <p class="text-price-display text-primary">S/. 150.00</p>
                            <button class="w-full mt-4 py-3 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined" data-icon="handshake" style="font-variation-settings: 'FILL' 1; transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); transform: scale(1) rotate(0deg);">handshake</span>
                                Trato Directo
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden product-card-hover flex flex-col">
                    <div class="aspect-square bg-surface-container overflow-hidden">
                        <img alt="Camera" class="w-full h-full object-cover" data-alt="A professional mirrorless camera with a large lens attached. The camera is showcased on a dark textured surface with dramatic side lighting that picks out the dials and buttons. The visual style is technical and high-performance, appealing to professional users." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYkoSc6HCsPWPlz9hfAV5D9vpebNqQMVkSeQmpVhqALmmVggpbc03iYzkDRg-v8-RZz-peRfkGz2o5s5YChULHtHeVdFQr-BfXaJs0b03mU9ai93KWLNn1vsqg0ZY0FIJm4euKd5dn7Gwn3l2_5ZDviuY2yCuseVla-qxUqgLKRIVnhz7O30k2G0RNwkIRUtgVfNj063Z4-POwpGjtiHAuPerkBVqoRTjRrsvvrXykTIu9LyF5eCn3JIhW9Waj4Ipz7Da3TUoXVas">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1">Cámaras</p>
                        <h3 class="text-headline-md text-on-surface line-clamp-1 mb-2">Lumix Digital G7 4K</h3>
                        <div class="mt-auto">
                            <p class="text-price-display text-primary">S/. 890.00</p>
                            <button class="w-full mt-4 py-3 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined" data-icon="handshake" style="font-variation-settings: 'FILL' 1; transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); transform: scale(1) rotate(0deg);">handshake</span>
                                Trato Directo
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden product-card-hover flex flex-col">
                    <div class="aspect-square bg-surface-container overflow-hidden">
                        <img alt="Tablet" class="w-full h-full object-cover" data-alt="A modern tablet with a high-resolution display showcasing artistic digital illustrations. The device is being held by a user, showing its thin bezel and portable size. The background is a soft-focus creative workspace, giving the product a lifestyle yet professional context." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBEIfnm2nfvD18v5H4sGwM5gzdtuJJRHE9Py_ZNHlnS3al2StCJn31tJpSO-BQgy3D5dHq1AoqtEFZ7TIOMwXvi9cfHQbQm0fpdYEDvPrNJJ0bwpfTXe3M9rTKUZDf137E_tBed7Lw_AwaFLh4DxO9EembmmYfjzpundHGq3WzX2A1iNZA6ESgwtH7wnrnEb2T33STqYrS-4_Sw8Lzkrrxi07hyqfLeZ8YBZaBAIBOEcmVxcn5OVvwQeG3fFX9f4eevzCSg7CVaSlQ">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1">Tablets</p>
                        <h3 class="text-headline-md text-on-surface line-clamp-1 mb-2">iPad Air 5th Gen</h3>
                        <div class="mt-auto">
                            <p class="text-price-display text-primary">S/. 650.00</p>
                            <button class="w-full mt-4 py-3 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined" data-icon="handshake" style="font-variation-settings: 'FILL' 1;">handshake</span>
                                Trato Directo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Simple Pagination -->
            <div class="flex items-center justify-center gap-2 mt-12 py-8 border-t border-outline-variant">
                <button class="p-2 rounded-lg hover:bg-surface-container transition-colors disabled:opacity-30" disabled="">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="w-10 h-10 rounded-lg bg-primary text-on-primary font-bold">1</button>
                <button class="w-10 h-10 rounded-lg hover:bg-surface-container transition-colors">2</button>
                <button class="w-10 h-10 rounded-lg hover:bg-surface-container transition-colors">3</button>
                <span class="px-2">...</span>
                <button class="w-10 h-10 rounded-lg hover:bg-surface-container transition-colors">12</button>
                <button class="p-2 rounded-lg hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
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
                    <li class=""><a class="text-body-sm text-surface-variant dark:text-on-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Comprar producto</a></li>
                    <li class=""><a class="text-body-sm text-surface-variant dark:text-on-surface-variant hover:text-on-primary transition-colors" href="{{ route('proximamente') }}">Mis tratos</a></li>
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