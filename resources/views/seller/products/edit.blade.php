<!DOCTYPE html>

<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Editar Producto | MarketPlace Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-container": "#a1bbff",
                        "secondary-container": "#fe9b53",
                        "on-primary-fixed": "#001945",
                        "primary-container": "#254990",
                        "outline-variant": "#c3c6d4",
                        "on-tertiary-container": "#8ecc87",
                        "on-secondary-fixed-variant": "#723600",
                        "tertiary": "#003f0b",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#964900",
                        "tertiary-fixed-dim": "#98d691",
                        "on-secondary": "#ffffff",
                        "surface": "#f8f9fa",
                        "on-error": "#ffffff",
                        "tertiary-fixed": "#b3f2ab",
                        "primary-fixed": "#d9e2ff",
                        "primary-fixed-dim": "#b0c6ff",
                        "on-primary-fixed-variant": "#1e448b",
                        "on-secondary-container": "#703500",
                        "on-surface-variant": "#434652",
                        "on-tertiary-fixed-variant": "#18511c",
                        "error": "#ba1a1a",
                        "surface-dim": "#d9dadb",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#1e5721",
                        "inverse-on-surface": "#f0f1f2",
                        "on-primary": "#ffffff",
                        "inverse-surface": "#2e3132",
                        "inverse-primary": "#b0c6ff",
                        "surface-tint": "#3a5ca4",
                        "on-secondary-fixed": "#311300",
                        "surface-bright": "#f8f9fa",
                        "primary": "#003178",
                        "secondary-fixed-dim": "#ffb787",
                        "on-tertiary-fixed": "#002203",
                        "surface-container-highest": "#e1e3e4",
                        "background": "#f8f9fa",
                        "surface-container-low": "#f3f4f5",
                        "surface-container": "#edeeef",
                        "secondary-fixed": "#ffdcc7",
                        "on-surface": "#191c1d",
                        "error-container": "#ffdad6",
                        "surface-variant": "#e1e3e4",
                        "on-error-container": "#93000a",
                        "on-background": "#191c1d",
                        "outline": "#737783",
                        "surface-container-high": "#e7e8e9"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "sidebar-width": "280px",
                        "base": "8px",
                        "container-max": "1280px",
                        "margin-mobile": "16px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "body-sm": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "label-caps": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-lg": ["Inter"],
                        "price-display": ["Inter"]
                    },
                    "fontSize": {
                        "body-sm": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "headline-md": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "price-display": ["24px", {
                            "lineHeight": "24px",
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
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #c3c6d4;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-surface text-on-surface">
    <!-- TopNavBar -->
    <nav class="fixed top-0 w-full z-50 bg-surface-container-lowest dark:bg-surface-container-low shadow-sm border-b border-outline-variant dark:border-outline h-16">
        <div class="flex justify-between items-center px-gutter h-full w-full max-w-container-max mx-auto">
            <div class="flex items-center gap-8">
                <span class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed-dim">MarketPlace Plus</span>
                <div class="hidden md:flex gap-6">
                    <a class="font-body-lg text-body-lg text-on-surface-variant dark:text-on-surface-variant hover:text-primary-container transition-colors" href="#">Explore</a>
                    <a class="font-body-lg text-body-lg text-on-surface-variant dark:text-on-surface-variant hover:text-primary-container transition-colors" href="#">Direct Deals</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex bg-surface-container-low rounded-full px-4 py-2 border border-outline-variant items-center gap-2">
                    <span class="material-symbols-outlined text-on-surface-variant">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-body-sm font-body-sm w-48" placeholder="Buscar productos..." type="text" />
                </div>
                <button class="material-symbols-outlined text-primary p-2 active:scale-95 transition-transform">notifications</button>
                <button class="material-symbols-outlined text-primary p-2 active:scale-95 transition-transform">shopping_cart</button>
                <div class="w-10 h-10 rounded-full bg-primary-container overflow-hidden border border-outline-variant">
                    <img alt="Seller Profile Avatar" class="w-full h-full object-cover" data-alt="A professional headshot of a mature merchant with a kind expression, wearing business casual attire. The portrait is set against a clean, modern studio background with soft cinematic lighting that highlights the reliability and trustworthiness of a verified seller. The overall tone is corporate yet approachable." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAri4eyZZKyZ9140meFZi7gq6hfl102u1iljbpsvYpvAd8xzNYlbXMlA-zHdttMOEi0cd43BbsooTmPYz3ZtSI09Z-KPJmUshMWSc7MUGI32iNrzAOVxjrhDMMrgjDz6ibw4FT8njCcru-OLGWxF9gJDEAztEMMMmwWFDdKuqeekzeWsoJJ_AT8k6-hK94BwZQYBhOysMJ2pTWvagDzh6Ryf3K_LmflnCA8Q35TxDlHMNIewLzB7joL_LO545H-uTHby2L7--T6dGc" />
                </div>
            </div>
        </div>
    </nav>
    <!-- SideNavBar -->
    <aside class="fixed left-0 top-16 h-full w-sidebar-width bg-surface-container-low dark:bg-surface-container-lowest border-r border-outline-variant dark:border-outline hidden md:flex flex-col p-4 space-y-2 overflow-y-auto">
        <div class="mb-6 px-3">
            <p class="font-label-caps text-label-caps text-on-surface-variant uppercase mb-1">Seller Hub</p>
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                <p class="font-body-sm text-body-sm font-bold">Verified Merchant</p>
            </div>
        </div>
        <nav class="flex-1 space-y-1">
            <a class="flex items-center gap-base bg-primary-container text-on-primary-container rounded-lg translate-x-1 font-bold p-3 transition-all duration-200 ease-in-out" href="#">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-body-sm text-body-sm">Panel</span>
            </a>
            <a class="flex items-center gap-base text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-container-highest hover:translate-x-1 transition-transform p-3 rounded-lg" href="#">
                <span class="material-symbols-outlined">add_box</span>
                <span class="font-body-sm text-body-sm">Create Publication</span>
            </a>
            <a class="flex items-center gap-base text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-container-highest hover:translate-x-1 transition-transform p-3 rounded-lg" href="#">
                <span class="material-symbols-outlined">handshake</span>
                <span class="font-body-sm text-body-sm">My Deals</span>
            </a>
            <a class="flex items-center gap-base text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-container-highest hover:translate-x-1 transition-transform p-3 rounded-lg" href="#">
                <span class="material-symbols-outlined">chat</span>
                <span class="font-body-sm text-body-sm">My Comments</span>
            </a>
            <a class="flex items-center gap-base text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-container-highest hover:translate-x-1 transition-transform p-3 rounded-lg" href="#">
                <span class="material-symbols-outlined">local_shipping</span>
                <span class="font-body-sm text-body-sm">Delivery</span>
            </a>
            <a class="flex items-center gap-base text-on-surface-variant hover:bg-surface-container-high dark:hover:bg-surface-container-highest hover:translate-x-1 transition-transform p-3 rounded-lg" href="#">
                <span class="material-symbols-outlined">receipt_long</span>
                <span class="font-body-sm text-body-sm">My Receipts</span>
            </a>
        </nav>
        <div class="mt-auto space-y-4 pt-4 border-t border-outline-variant">
            <button class="w-full bg-secondary text-on-secondary font-bold py-3 rounded-lg shadow-sm hover:brightness-110 active:scale-95 transition-all">
                Go Premium
            </button>
            <button class="w-full border-2 border-primary text-primary font-bold py-2 rounded-lg hover:bg-primary-fixed transition-colors">
                Cambiar a Cliente
            </button>
            <div class="space-y-1">
                <a class="flex items-center gap-base text-on-surface-variant hover:bg-surface-container-high p-3 rounded-lg transition-colors" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-body-sm text-body-sm">Settings</span>
                </a>
                <a class="flex items-center gap-base text-on-surface-variant hover:bg-surface-container-high p-3 rounded-lg transition-colors" href="#">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-body-sm text-body-sm">Logout</span>
                </a>
            </div>
        </div>
    </aside>
    <!-- Main Content Canvas -->
    <main class="md:ml-sidebar-width pt-24 pb-12 px-gutter min-h-screen">
        <div class="max-w-container-max mx-auto">
            <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <header class="flex justify-between items-end mb-8">
                    <div>
                        <nav class="flex gap-2 text-on-surface-variant mb-2">
                            <span class="font-label-caps text-label-caps uppercase">Panel</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                            <span class="font-label-caps text-label-caps uppercase">Mis Productos</span>
                        </nav>
                        <h1 class="font-headline-lg text-headline-lg text-primary">Editar Producto</h1>
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ route('seller.panel') }}" class="px-6 py-2 rounded-lg border border-outline text-on-surface-variant font-bold hover:bg-surface-container-high transition-colors inline-flex items-center">
                            Cancelar
                        </a>
                        <button type="submit" class="px-8 py-2 rounded-lg bg-secondary text-on-secondary font-bold shadow-md hover:brightness-110 active:scale-95 transition-all">
                            Guardar Cambios
                        </button>
                    </div>
                </header>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
                    <!-- Edit Form -->
                    <div class="lg:col-span-8 space-y-gutter">
                        <!-- Basic Information Section -->
                        <section class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant">
                            <h2 class="font-headline-md text-headline-md mb-6 border-b border-outline-variant pb-4">Información Básica</h2>
                            <div class="space-y-6">
                                <div>
                                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">TÍTULO DEL PRODUCTO</label>
                                    <input name="name" class="w-full bg-surface-container-low border-outline-variant rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-transparent" type="text" value="{{ old('name', $product->name) }}" />
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">CATEGORÍA</label>
                                        <select name="category" class="w-full bg-surface-container-low border-outline-variant rounded-lg p-3 focus:ring-2 focus:ring-primary">
                                            <option value="Tecnología" {{ old('category', $product->category) == 'Tecnología' ? 'selected' : '' }}>Tecnología</option>
                                            <option value="Hogar" {{ old('category', $product->category) == 'Hogar' ? 'selected' : '' }}>Hogar</option>
                                            <option value="Moda" {{ old('category', $product->category) == 'Moda' ? 'selected' : '' }}>Moda</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">UBICACIÓN</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3 top-3 text-on-surface-variant">location_on</span>
                                            <select name="location" class="w-full bg-surface-container-low border-outline-variant rounded-lg p-3 pl-10 focus:ring-2 focus:ring-primary">
                                                <option value="Lima" {{ old('location', $product->location) == 'Lima' ? 'selected' : '' }}>Lima</option>
                                                <option value="Arequipa" {{ old('location', $product->location) == 'Arequipa' ? 'selected' : '' }}>Arequipa</option>
                                                <option value="Cusco" {{ old('location', $product->location) == 'Cusco' ? 'selected' : '' }}>Cusco</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">DESCRIPCIÓN</label>
                                    <textarea name="description" class="w-full bg-surface-container-low border-outline-variant rounded-lg p-3 focus:ring-2 focus:ring-primary" rows="6">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </section>
                        <!-- Multimedia Section -->
                        <section class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm">
                            <div class="flex items-center gap-2 mb-6 text-primary">
                                <span class="material-symbols-outlined">photo_library</span>
                                <h2 class="font-headline-md text-headline-md">Multimedia</h2>
                            </div>

                            <div id="gallery-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @if(!empty($product->image_path) && (is_array($product->image_path) || $product->image_path instanceof \Countable))
                                @foreach($product->image_path as $index => $path)
                                <div class="aspect-square rounded-xl overflow-hidden {{ $index === 0 ? 'border-2 border-primary' : 'border border-outline-variant' }} relative group existing-image-card" data-path="{{ $path }}">
                                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $path) }}" />
                                    <div class="absolute inset-0 bg-primary/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button type="button" class="bg-error text-on-error p-2 rounded-full shadow-lg btn-delete-existing">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </div>
                                    @if($index === 0)
                                    <span class="absolute top-2 left-2 bg-primary text-on-primary text-[10px] px-2 py-0.5 rounded font-bold uppercase">Principal</span>
                                    @endif
                                </div>
                                @endforeach
                                @endif

                                <label id="upload-box" for="image-input" class="border-2 border-dashed border-outline-variant rounded-xl aspect-square flex flex-col items-center justify-center text-center hover:bg-surface-container-low transition-colors cursor-pointer group p-4">
                                    <input type="file" id="image-input" name="image_path[]" accept="image/*" class="hidden" multiple>
                                    <span id="upload-icon" class="material-symbols-outlined text-3xl text-outline-variant group-hover:text-primary transition-colors">cloud_upload</span>
                                    <p id="upload-text" class="mt-2 text-xs font-bold text-on-surface">Subir imágenes</p>
                                    <p id="upload-subtext" class="text-on-surface-variant text-[10px] mt-0.5">JPG, PNG (Max. 5MB)</p>
                                </label>
                            </div>
                            <div id="deleted-images-container"></div>
                        </section>
                        <!-- Price & State Section -->
                        <section class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">PRECIO (S/.)</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-3 font-bold text-primary">S/.</span>
                                        <input name="price" class="w-full bg-surface-container-low border-outline-variant rounded-lg p-3 pl-12 font-price-display text-price-display text-secondary focus:ring-2 focus:ring-primary" type="number" step="0.01" value="{{ old('price', $product->price) }}" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">ESTADO</label>
                                    <input type="hidden" name="condition" id="condition_input" value="{{ old('condition', $product->condition ?? 'Usado') }}">
                                    <div class="flex gap-2">
                                        <button type="button" id="btn_usado" class="flex-1 py-3 px-4 rounded-lg border-2 {{ old('condition', $product->condition ?? 'Usado') == 'Usado' ? 'border-primary bg-primary-fixed text-primary font-bold' : 'border-outline-variant text-on-surface-variant font-bold' }}">Usado</button>
                                        <button type="button" id="btn_nuevo" class="flex-1 py-3 px-4 rounded-lg border-2 {{ old('condition', $product->condition) == 'Nuevo' ? 'border-primary bg-primary-fixed text-primary font-bold' : 'border-outline-variant text-on-surface-variant font-bold' }}">Nuevo</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- Preview Sidebar -->
                    <div class="lg:col-span-4 sticky top-24">
                        <h3 class="font-label-caps text-label-caps text-on-surface-variant mb-4 uppercase">Vista Previa del Anuncio</h3>
                        <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-lg border border-outline-variant group">
                            <div class="relative h-64">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" id="preview-img" src="{{ asset('storage/' . (is_array($product->image_path) ? ($product->image_path[0] ?? 'default.png') : $product->image_path)) }}" />
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                                    <span class="material-symbols-outlined text-secondary text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="text-label-caps font-bold">4.9</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-primary font-label-caps text-label-caps bg-primary-fixed px-2 py-0.5 rounded uppercase" id="preview-category">{{ $product->category }}</span>
                                    <div class="flex items-center text-on-surface-variant text-body-sm" id="preview-location">
                                        <span class="material-symbols-outlined text-[16px] mr-1">location_on</span>
                                        {{ $product->location }}
                                    </div>
                                </div>
                                <h4 class="font-headline-md text-headline-md text-on-surface mb-2 leading-tight" id="preview-title">{{ $product->name }}</h4>
                                <div class="flex items-baseline gap-2 mb-4">
                                    <span class="font-price-display text-price-display text-secondary" id="preview-price">S/ {{ number_format($product->price, 2) }}</span>
                                    <span class="text-on-surface-variant text-body-sm line-through" id="preview-old-price">S/ {{ number_format($product->price * 1.1, 2) }}</span>
                                </div>
                                <button class="w-full bg-secondary text-on-secondary font-bold py-3 rounded-lg flex items-center justify-center gap-2 hover:brightness-110 transition-all">
                                    <span class="material-symbols-outlined">handshake</span>
                                    Trato Directo
                                </button>
                            </div>
                        </div>
                        <div class="mt-6 bg-tertiary-fixed/30 p-4 rounded-xl border border-tertiary/20">
                            <div class="flex gap-3">
                                <span class="material-symbols-outlined text-tertiary">info</span>
                                <div>
                                    <p class="font-body-sm text-body-sm font-bold text-tertiary">Consejo del Hub</p>
                                    <p class="font-body-sm text-body-sm text-on-tertiary-fixed-variant mt-1">Los anuncios con descripciones detalladas y precios competitivos en <span id="preview-tip-location">{{ $product->location }}</span> cierran un 30% más rápido.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <!-- Footer -->
    <footer class="w-full mt-auto bg-surface-container-highest dark:bg-surface-container-lowest border-t border-outline-variant">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-gutter py-12 max-w-container-max mx-auto">
            <div class="space-y-4">
                <span class="font-headline-md text-headline-md text-primary font-bold">MarketPlace Plus</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant">© 2024 MarketPlace Plus. Direct. Trusted. Secure.</p>
                <div class="flex gap-4">
                    <a class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors" href="#">public</a>
                    <a class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors" href="#">hub</a>
                    <a class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors" href="#">verified</a>
                </div>
            </div>
            <div class="space-y-4">
                <p class="font-label-caps text-label-caps font-bold text-on-surface">Quick Links</p>
                <ul class="space-y-2">
                    <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Mi Perfil</a></li>
                    <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Mis Publicaciones</a></li>
                    <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Soporte</a></li>
                </ul>
            </div>
            <div class="space-y-4">
                <p class="font-label-caps text-label-caps font-bold text-on-surface">Safety Recommendations</p>
                <ul class="space-y-2">
                    <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Recomendaciones para tus tratos</a></li>
                    <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Verificación de Compradores</a></li>
                    <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Pagos Seguros</a></li>
                </ul>
            </div>
            <div class="space-y-4">
                <p class="font-label-caps text-label-caps font-bold text-on-surface">Legal</p>
                <ul class="space-y-2">
                    <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Terms of Service</a></li>
                    <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:underline transition-all" href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script>
        // Simple micro-interaction for the "Handshake" icon logic or input preview sync
        const imageInput = document.getElementById('image-input');
        const galleryContainer = document.getElementById('gallery-container');
        const uploadBox = document.getElementById('upload-box');
        const deletedImagesContainer = document.getElementById('deleted-images-container');
        const previewImgElement = document.getElementById('preview-img');

        function updateMainPreview() {
            const firstImg = galleryContainer.querySelector('img');
            if (firstImg) {
                previewImgElement.src = firstImg.src;
            } else {
                previewImgElement.src = '/storage/default.png';
            }
        }

        document.querySelectorAll('.btn-delete-existing').forEach(button => {
            button.addEventListener('click', (e) => {
                const card = e.target.closest('.existing-image-card');
                const path = card.getAttribute('data-path');

                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'deleted_images[]';
                hiddenInput.value = path;
                deletedImagesContainer.appendChild(hiddenInput);

                card.remove();
                updateMainPreview();
            });
        });

        imageInput.addEventListener('change', (e) => {
            const files = Array.from(e.target.files);

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const div = document.createElement('div');
                    div.className = 'aspect-square rounded-xl overflow-hidden border border-outline-variant relative group new-image-card';

                    div.innerHTML = `
                <img class="w-full h-full object-cover" src="${event.target.result}" />
                <div class="absolute inset-0 bg-primary/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <button type="button" class="bg-error text-on-error p-2 rounded-full shadow-lg btn-delete-new">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            `;

                    div.querySelector('.btn-delete-new').addEventListener('click', () => {
                        div.remove();
                        updateMainPreview();
                    });

                    galleryContainer.insertBefore(div, uploadBox);
                    updateMainPreview();
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
</body>

</html>