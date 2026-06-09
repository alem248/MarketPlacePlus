<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Market Place Plus - Modo Vendedor</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <!-- Shared Components Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "background": "#f8f9fa",
                        "surface-container": "#edeeef",
                        "tertiary": "#003f0b",
                        "surface-variant": "#e1e3e4",
                        "tertiary-fixed": "#a3f69c",
                        "surface-dim": "#d9dadb",
                        "surface": "#f8f9fa",
                        "tertiary-fixed-dim": "#88d982",
                        "on-error-container": "#93000a",
                        "error-container": "#ffdad6",
                        "secondary-fixed-dim": "#ffb786",
                        "on-secondary-fixed": "#311300",
                        "on-primary-container": "#a1bbff",
                        "surface-bright": "#f8f9fa",
                        "on-surface-variant": "#434652",
                        "surface-container-low": "#f3f4f5",
                        "on-primary": "#ffffff",
                        "primary-container": "#0d47a1",
                        "on-error": "#ffffff",
                        "surface-container-highest": "#e1e3e4",
                        "on-tertiary-fixed-variant": "#005312",
                        "on-primary-fixed-variant": "#00429c",
                        "inverse-primary": "#b0c6ff",
                        "tertiary-container": "#005914",
                        "secondary-fixed": "#ffdcc6",
                        "primary": "#003178",
                        "surface-tint": "#2b5bb5",
                        "on-primary-fixed": "#001945",
                        "outline": "#737783",
                        "secondary-container": "#fc820c",
                        "on-tertiary-container": "#7ecf79",
                        "on-tertiary-fixed": "#002204",
                        "primary-fixed-dim": "#b0c6ff",
                        "on-secondary-container": "#5e2c00",
                        "primary-fixed": "#d9e2ff",
                        "surface-container-high": "#e7e8e9",
                        "secondary": "#964900",
                        "on-surface": "#191c1d",
                        "on-tertiary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "outline-variant": "#c3c6d4",
                        "inverse-on-surface": "#f0f1f2",
                        "error": "#ba1a1a",
                        "on-background": "#191c1d",
                        "on-secondary-fixed-variant": "#723600",
                        "inverse-surface": "#2e3132",
                        "on-secondary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "base": "8px",
                        "margin-mobile": "16px",
                        "sidebar-width": "280px",
                        "container-max": "1280px"
                    },
                    "fontFamily": {
                        "label-caps": ["Inter"],
                        "body-sm": ["Inter"],
                        "body-lg": ["Inter"],
                        "price-display": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "headline-lg": ["Inter"]
                    },
                    "fontSize": {
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "700"
                        }],
                        "body-sm": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "price-display": ["24px", {
                            "lineHeight": "24px",
                            "fontWeight": "700"
                        }],
                        "headline-md": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .bento-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .bento-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="bg-background text-on-surface">
    <!-- TopNavBar -->
    <nav class="bg-surface dark:bg-surface-dim border-b border-outline-variant dark:border-outline fixed full-width top-0 z-50 w-full">
        <div class="flex justify-between items-center px-gutter py-base w-full max-w-container-max mx-auto h-16">
            <div class="flex items-center gap-4">
                <span class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed-dim">Market Place Plus</span>
            </div>
            <div class="hidden md:flex items-center">
                <h1 class="font-headline-md text-headline-md text-on-surface">¿Qué vamos a vender hoy?</h1>
            </div>
            <div class="hidden md:flex items-center gap-6">
                <button class="bg-secondary-container text-on-secondary-container px-6 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:opacity-90 transition-all scale-95 active:transition-all">
                    <span class="material-symbols-outlined">add_circle</span>
                    Crear Publicación
                </button>
            </div>
        </div>
    </nav>
    <div class="flex pt-16 min-h-screen"> <!-- Container for Sidebar and Main Content -->
        <!-- SideNavBar -->
        <aside class="w-sidebar-width bg-surface-container dark:bg-surface-container-low border-r border-outline-variant flex flex-col p-base space-y-4 hidden md:flex sticky top-16 self-start shrink-0">
            <div class="p-4 bg-surface-container-lowest rounded-2xl mb-4 border border-outline-variant">
    <div class="p-4 bg-surface-container-lowest rounded-2xl mb-4 border border-outline-variant">
    <div class="flex flex-col items-center gap-3 mb-4">
    <div class="relative">
        @if(!empty(auth()->user()->foto))
            <img alt="Avatar del Comprador" class="w-24 h-24 rounded-full object-cover border-2 border-primary" src="{{ asset('storage/' . auth()->user()->foto) }}">
        @else
            <img alt="Avatar por defecto" class="w-24 h-24 rounded-full object-cover border-2 border-primary" src="{{ asset('img/icon_default.jpg') }}">
        @endif
        <div class="absolute bottom-1 right-1 w-5 h-5 bg-tertiary-fixed rounded-full border-2 border-surface-container-lowest"></div>
    </div>
    
    <div class="text-center mt-1">
        <h2 class="text-headline-md font-headline-md font-bold text-primary">
            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
        </h2>
        <p class="text-body-sm text-outline">Comprador</p>
    </div>
</div>
</div>
    <a href="{{ route('home') }}" class="w-full block text-center py-3 px-4 bg-[#003178] text-white rounded-2xl font-bold font-headline-md text-headline-md transition-all hover:brightness-110">
        Cambiar a Cliente
    </a>
</div>
            <nav class="space-y-1">
                <a class="bg-secondary-container text-on-secondary-container rounded-xl font-bold flex items-center px-4 py-3" href="#">
                    <span class="material-symbols-outlined mr-3">dashboard</span>
                    <span class="font-body-lg text-body-lg">Panel</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface flex items-center px-4 py-3 hover:bg-surface-variant rounded-xl transition-all" href="#">
                    <span class="material-symbols-outlined mr-3">add_circle</span>
                    <span class="font-body-lg text-body-lg">Crear Publicación</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface flex items-center px-4 py-3 hover:bg-surface-variant rounded-xl transition-all" href="#">
                    <span class="material-symbols-outlined mr-3">handshake</span>
                    <span class="font-body-lg text-body-lg">Mis Tratos</span>
                </a>
                <a class="text-on-surface-variant hover:text-on-surface flex items-center px-4 py-3 hover:bg-surface-variant rounded-xl transition-all" href="#">
                    <span class="material-symbols-outlined mr-3">receipt_long</span>
                    <span class="font-body-lg text-body-lg">Mis Comprobantes</span>
                </a>
            </nav>
        </aside>
        <!-- Main Content Canvas -->
        <div class="flex-1 flex flex-col min-w-0">
            <main class="flex-1 p-gutter bg-background">
                <!-- Hero Dashboard Banner -->
                <div class="relative overflow-hidden rounded-3xl bg-primary-container text-on-primary-container p-8 mb-8 flex flex-col md:flex-row justify-between items-center">
                    <div class="relative z-10 max-w-xl">
                        <h1 class="font-headline-lg text-headline-lg mb-2">¿Qué vamos a vender hoy?</h1>
                        <p class="font-body-lg text-body-lg opacity-90 mb-6">La clave de una buena venta es la confianza. Descripciones claras y fotos impecables garantizan éxito.</p>
                        <button class="bg-secondary-container text-on-secondary-container px-8 py-4 rounded-xl font-bold font-headline-md text-headline-md flex items-center gap-2 hover:scale-105 transition-transform">
                            PUBLICAR PRODUCTO
                            <span class="material-symbols-outlined">add_box</span>
                        </button>
                    </div>
                    <div class="hidden lg:block opacity-20">
                        <span class="material-symbols-outlined text-[160px]" style="font-variation-settings: 'FILL' 1;">shopping_bag</span>
                    </div>
                </div>
                <!-- Bento Content Sections -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8"><!-- Left Column -->
                    <div class="lg:col-span-2 space-y-12">
                        <!-- Manage Listings Section -->
                        <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <h2 class="font-headline-lg text-headline-lg text-on-surface">Gestionar Publicaciones</h2>
                                <button class="text-primary font-bold hover:underline">Ver todas</button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Product Card 1 -->
                                <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl overflow-hidden group hover:shadow-lg transition-all">
                                    <div class="h-48 overflow-hidden relative">
                                        <img class="w-full h-full object-cover transition-transform group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH8VbE_szHnwG3V6BpVceglpg7-vwQ9Qu4aqyifSA6jswNT30EtHqcOlsDXB0dieH_kr7g0l8RDD2NrkPmCVskiIevnZ5SX-dG3O2YfyQVyKcvBlCZp8cV6_5qMuI0wyksrABT1mRSxzr2Dc-9Cnx6Q7GrJItxnaEDHajaqy-qQGgbtbT4UGivTxZF1xUHCrNl-_Jrui91qV5XRdM41GcsHL3gMzr9BP1naQ0L94Wj5R3JrAH9d9yLsNlTAGeMJwGfVkyiREKiCYU">
                                        <div class="absolute top-2 right-2 flex gap-1">
                                            <button class="p-2 bg-white/90 rounded-full hover:bg-white text-primary transition-colors"><span class="material-symbols-outlined text-sm">edit</span></button>
                                            <button class="p-2 bg-white/90 rounded-full hover:bg-white text-error transition-colors"><span class="material-symbols-outlined text-sm">delete</span></button>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <span class="font-label-caps text-label-caps text-on-surface-variant">SMARTPHONES</span>
                                        <h3 class="font-headline-md text-headline-md mb-2">iPhone 13 Pro Max - 256GB</h3>
                                        <p class="font-price-display text-price-display text-primary">S/. 850.00</p>
                                        <div class="mt-4 pt-4 border-t border-outline-variant flex justify-between items-center">
                                            <button class="bg-secondary text-on-secondary px-4 py-2 rounded-lg font-bold text-sm">Trato Directo</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Card 2 -->
                                <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl overflow-hidden group hover:shadow-lg transition-all">
                                    <div class="h-48 overflow-hidden relative">
                                        <img class="w-full h-full object-cover transition-transform group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwYA38Fa_-NBn1_bwhvDDy4APnjmx-FMv40PiUxshh-AgBnBqB69THPUleKuab6FACZHmbKavZH_RmSaoTauIc5tqDJ4Q4D-lbWtQu0KV536ubxyWIquQBH64RIOLXtB9GXMjJQOPCugPQv1XUmlYgTRiqzLjBKdTcG7K6OML55N95rVusJexfUTPlCtT7hIlX3ae7U5P2XCLeH6J3L3qPNSPpcYo4dLlaHN6pTbGH1Ib8jS_QFGbs1yBWT8D4yYXcDt9N3UOCq-g">
                                        <div class="absolute top-2 right-2 flex gap-1">
                                            <button class="p-2 bg-white/90 rounded-full hover:bg-white text-primary transition-colors"><span class="material-symbols-outlined text-sm">edit</span></button>
                                            <button class="p-2 bg-white/90 rounded-full hover:bg-white text-error transition-colors"><span class="material-symbols-outlined text-sm">delete</span></button>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <span class="font-label-caps text-label-caps text-on-surface-variant">LAPTOPS</span>
                                        <h3 class="font-headline-md text-headline-md mb-2">MacBook Air M2 2023</h3>
                                        <p class="font-price-display text-price-display text-primary">S/. 1,100.00</p>
                                        <div class="mt-4 pt-4 border-t border-outline-variant flex justify-between items-center">
                                            <button class="bg-secondary text-on-secondary px-4 py-2 rounded-lg font-bold text-sm">Trato Directo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Mis Comentarios Section (Restored Styles) -->
                        <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <h2 class="font-headline-lg text-headline-lg text-on-surface">Mis Comentarios</h2>
                                <button class="text-primary font-bold hover:underline">Ver todos</button>
                            </div>
                            <div class="space-y-4">
                                <!-- Testimonial 1 -->
                                <div class="p-6 bg-surface-container-lowest border border-outline-variant rounded-2xl hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-bold text-on-surface">Carlos Ruiz</h4>
                                        <div class="flex text-secondary-container">
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                        </div>
                                    </div>
                                    <p class="text-on-surface-variant text-body-sm leading-relaxed italic">"Excelente vendedor, el producto llegó en perfectas condiciones y el trato fue muy profesional. Totalmente recomendado."</p>
                                </div>
                                <!-- Testimonial 2 -->
                                <div class="p-6 bg-surface-container-lowest border border-outline-variant rounded-2xl hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-bold text-on-surface">Lucía Torres</h4>
                                        <div class="flex text-secondary-container">
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm">star</span>
                                        </div>
                                    </div>
                                    <p class="text-on-surface-variant text-body-sm leading-relaxed italic">"Muy buena comunicación. Hubo un pequeño retraso en el envío pero siempre estuvo pendiente. El iPhone está impecable."</p>
                                </div>
                                <!-- Testimonial 3 -->
                                <div class="p-6 bg-surface-container-lowest border border-outline-variant rounded-2xl hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-bold text-on-surface">Marco Peña</h4>
                                        <div class="flex text-secondary-container">
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                        </div>
                                    </div>
                                    <p class="text-on-surface-variant text-body-sm leading-relaxed italic">"La MacBook Air funciona de maravilla. El empaque era muy seguro. Gran experiencia de compra."</p>
                                </div>
                                <!-- Testimonial 4 -->
                                <div class="p-6 bg-surface-container-lowest border border-outline-variant rounded-2xl hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-bold text-on-surface">Sofía Mendoza</h4>
                                        <div class="flex text-secondary-container">
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                        </div>
                                    </div>
                                    <p class="text-on-surface-variant text-body-sm leading-relaxed italic">"Puntual y honesto. Me explicó todo sobre la garantía del equipo. Volveré a comprarle sin duda."</p>
                                </div>
                                <!-- Testimonial 5 -->

                                <!-- Testimonial 6 -->

                            </div>
                        </div>
                    </div>
                    <!-- Right Column (Proposals Inbox) -->
                    <div class="space-y-6">
                        <h2 class="font-headline-lg text-headline-lg text-on-surface">Bandeja de Propuestas</h2>
                        <div class="space-y-4">
                            <div class="p-4 bg-surface-container-lowest border border-outline-variant rounded-2xl flex gap-4 items-start hover:bg-surface-container transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-surface-variant shrink-0 flex items-center justify-center"><span class="material-symbols-outlined text-outline">image</span></div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface mb-1">Carlos Ruiz solicita este producto</p>
                                    <div class="flex items-center gap-2 mb-3"><span class="text-xs px-2 py-0.5 bg-tertiary-fixed text-on-tertiary-fixed rounded-full">Nueva oferta</span><span class="text-xs text-on-surface-variant">Hace 2 min</span></div><button class="w-full border border-primary text-primary py-2 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-primary hover:text-on-primary transition-all"><span class="material-symbols-outlined text-sm">forum</span> Responder propuesta</button>
                                </div>
                            </div>
                            <div class="p-4 bg-surface-container-lowest border border-outline-variant rounded-2xl flex gap-4 items-start hover:bg-surface-container transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-surface-variant shrink-0 flex items-center justify-center"><span class="material-symbols-outlined text-outline">image</span></div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface mb-1">Lucía Torres solicita este producto</p>
                                    <div class="flex items-center gap-2 mb-3"><span class="text-xs px-2 py-0.5 bg-tertiary-fixed text-on-tertiary-fixed rounded-full">Nueva oferta</span><span class="text-xs text-on-surface-variant">Hace 5 min</span></div><button class="w-full border border-primary text-primary py-2 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-primary hover:text-on-primary transition-all"><span class="material-symbols-outlined text-sm">forum</span> Responder propuesta</button>
                                </div>
                            </div>
                            <div class="p-4 bg-surface-container-lowest border border-outline-variant rounded-2xl flex gap-4 items-start hover:bg-surface-container transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-surface-variant shrink-0 flex items-center justify-center"><span class="material-symbols-outlined text-outline">image</span></div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface mb-1">Marco Peña solicita este producto</p>
                                    <div class="flex items-center gap-2 mb-3"><span class="text-xs px-2 py-0.5 bg-tertiary-fixed text-on-tertiary-fixed rounded-full">Nueva oferta</span><span class="text-xs text-on-surface-variant">Hace 15 min</span></div><button class="w-full border border-primary text-primary py-2 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-primary hover:text-on-primary transition-all"><span class="material-symbols-outlined text-sm">forum</span> Responder propuesta</button>
                                </div>
                            </div>
                            <div class="p-4 bg-surface-container-lowest border border-outline-variant rounded-2xl flex gap-4 items-start hover:bg-surface-container transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-surface-variant shrink-0 flex items-center justify-center"><span class="material-symbols-outlined text-outline">image</span></div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface mb-1">Sofía Mendoza solicita este producto</p>
                                    <div class="flex items-center gap-2 mb-3"><span class="text-xs px-2 py-0.5 bg-tertiary-fixed text-on-tertiary-fixed rounded-full">Nueva oferta</span><span class="text-xs text-on-surface-variant">Hace 30 min</span></div><button class="w-full border border-primary text-primary py-2 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-primary hover:text-on-primary transition-all"><span class="material-symbols-outlined text-sm">forum</span> Responder propuesta</button>
                                </div>
                            </div>
                            <div class="p-4 bg-surface-container-lowest border border-outline-variant rounded-2xl flex gap-4 items-start hover:bg-surface-container transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-surface-variant shrink-0 flex items-center justify-center"><span class="material-symbols-outlined text-outline">image</span></div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface mb-1">Alejandro G. solicita este producto</p>
                                    <div class="flex items-center gap-2 mb-3"><span class="text-xs px-2 py-0.5 bg-tertiary-fixed text-on-tertiary-fixed rounded-full">Nueva oferta</span><span class="text-xs text-on-surface-variant">Hace 45 min</span></div><button class="w-full border border-primary text-primary py-2 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-primary hover:text-on-primary transition-all"><span class="material-symbols-outlined text-sm">forum</span> Responder propuesta</button>
                                </div>
                            </div>
                            <div class="p-4 bg-surface-container-lowest border border-outline-variant rounded-2xl flex gap-4 items-start hover:bg-surface-container transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-surface-variant shrink-0 flex items-center justify-center"><span class="material-symbols-outlined text-outline">image</span></div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-on-surface mb-1">Valentina R. solicita este producto</p>
                                    <div class="flex items-center gap-2 mb-3"><span class="text-xs px-2 py-0.5 bg-tertiary-fixed text-on-tertiary-fixed rounded-full">Nueva oferta</span><span class="text-xs text-on-surface-variant">Hace 1 hora</span></div><button class="w-full border border-primary text-primary py-2 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-primary hover:text-on-primary transition-all"><span class="material-symbols-outlined text-sm">forum</span> Responder propuesta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Corrected Dark Footer -->
        </div>
    </div>
    <footer class="w-full bg-[#191c1d] text-white">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-gutter py-12 max-w-container-max mx-auto">
            <div class="space-y-4">
                <span class="text-headline-md font-bold block">MarketPlace Plus</span>
                <p class="text-body-sm text-surface-variant opacity-80 leading-relaxed">
                    La plataforma líder para conectar compradores y vendedores de forma directa y segura.
                </p>
            </div>
            <div>
                <h4 class="text-label-caps font-bold mb-6 uppercase tracking-wider">Enlaces Rápidos</h4>
                <ul class="flex flex-col gap-3">
                    <li class=""><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="#">Comprar producto</a></li>
                    <li class=""><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="#">Mis tratos</a></li>
                    <li class=""><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="#">Rastrear pedido</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-label-caps font-bold mb-6 uppercase tracking-wider">Soporte</h4>
                <ul class="flex flex-col gap-3">
                    <li class=""><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="#">Ayuda al cliente</a></li>
                    <li class=""><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="#">Sobre nosotros</a></li>
                    <li class=""><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="#">Términos y condiciones</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-label-caps font-bold mb-6 uppercase tracking-wider">RECOMENDACIONES PARA TUS TRATOS</h4>
                <div class="flex flex-col gap-4">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-xl">check_circle</span>
                        <p class="text-body-sm">Verifica la reputación del vendedor</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-xl">location_on</span>
                        <p class="text-body-sm">Realiza tus tratos en lugares públicos</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-xl">chat</span>
                        <p class="text-body-sm">Usa WhatsApp para mayor seguridad</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-xl">security</span>
                        <p class="text-body-sm">No compartas datos bancarios sensibles</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 py-6 px-gutter max-w-container-max mx-auto text-center">
            <p class="text-body-sm opacity-50">Market Place Plus - eCommerce Template © 2026. Design by Templatecookie</p>
        </div>
    </footer>
    ```



</body>

</html>