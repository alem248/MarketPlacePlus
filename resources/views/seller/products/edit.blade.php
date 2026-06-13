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
                    <a class="font-body-lg text-body-lg text-on-surface-variant dark:text-on-surface-variant hover:text-primary-container transition-colors" href="{{ route('home') }}">Explorar</a>
                    <a class="font-body-lg text-body-lg text-on-surface-variant dark:text-on-surface-variant hover:text-primary-container transition-colors" href="{{ route('seller.tratos.index') }}">Mis Tratos</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex bg-surface-container-low rounded-full px-4 py-2 border border-outline-variant items-center gap-2">
                    <span class="material-symbols-outlined text-on-surface-variant">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-body-sm font-body-sm w-48" placeholder="Buscar productos..." type="text" />
                </div>
                <button class="material-symbols-outlined text-primary p-2 active:scale-95 transition-transform">notifications</button>
                <div class="w-24 h-24 rounded-full bg-surface-variant overflow-hidden border-2 border-primary shadow-sm">
                    @if(auth()->user()->foto && Storage::disk('public')->exists(auth()->user()->foto))
                    <img alt="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}"
                        class="w-full h-full object-cover"
                        src="{{ asset('storage/' . auth()->user()->foto) }}" />
                    @else
                    <img alt="Perfil por defecto"
                        class="w-full h-full object-cover"
                        src="{{ asset('img/icon_default.jpg') }}" />
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <!-- SideNavBar -->
    <aside class="fixed left-0 top-16 h-[calc(100vh-64px)] w-sidebar-width bg-surface-container-low dark:bg-surface-container-lowest border-r border-outline-variant dark:border-outline hidden md:flex flex-col p-4 space-y-2 overflow-y-auto">
        <div class="p-4 border-b border-outline-variant mb-2">
            <div class="flex items-center gap-3 mb-4">
                @if(auth()->user()->foto && Storage::disk('public')->exists(auth()->user()->foto))
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-primary">
                @else
                    <div class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <p class="font-bold text-on-surface text-body-sm">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                    <p class="text-on-surface-variant text-[12px]">Vendedor</p>
                </div>
            </div>
            <a href="{{ route('home') }}" class="w-full block text-center py-2 px-4 bg-[#003178] text-white rounded-xl font-bold text-body-sm transition-all hover:brightness-110">
                Cambiar a Cliente
            </a>
        </div>
        <nav class="flex-1 space-y-1">
            <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant flex items-center px-4 py-3 rounded-xl transition-all" href="{{ route('seller.panel') }}">
                <span class="material-symbols-outlined mr-3">dashboard</span>
                <span class="font-body-lg text-body-lg">Panel</span>
            </a>
            <a class="bg-secondary-container text-on-secondary-container rounded-xl font-bold flex items-center px-4 py-3" href="{{ route('seller.products.create') }}">
                <span class="material-symbols-outlined mr-3">add</span>
                <span class="font-body-lg text-body-lg">Crear Publicación</span>
            </a>
            <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant flex items-center px-4 py-3 rounded-xl transition-all" href="{{ route('seller.tratos.index') }}">
                <span class="material-symbols-outlined mr-3">handshake</span>
                <span class="font-body-lg text-body-lg">Mis Tratos</span>
            </a>
            <a class="text-on-surface-variant hover:text-on-surface hover:bg-surface-variant flex items-center px-4 py-3 rounded-xl transition-all" href="{{ route('comprobantes.index') }}">
                <span class="material-symbols-outlined mr-3">receipt_long</span>
                <span class="font-body-lg text-body-lg">Mis Comprobantes</span>
            </a>
        </nav>
        <div class="pt-4 border-t border-outline-variant">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-error hover:bg-error-container rounded-lg flex items-center px-4 py-3 gap-3 transition-all">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-body-lg">Cerrar Sesión</span>
                </button>
            </form>
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
                                    <input id="form-title" name="title" class="w-full bg-surface-container-low border-outline-variant rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-transparent" type="text" value="{{ old('title', $product->title) }}" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">CATEGORÍA</label>
                                        <select id="form-category" name="category" class="w-full bg-surface-container-low border-outline-variant rounded-lg p-3 focus:ring-2 focus:ring-primary">
                                            <option value="Tecnología" {{ old('category', $product->category) == 'Tecnología' ? 'selected' : '' }}>Tecnología</option>
                                            <option value="Hogar" {{ old('category', $product->category) == 'Hogar' ? 'selected' : '' }}>Hogar</option>
                                            <option value="Moda" {{ old('category', $product->category) == 'Moda' ? 'selected' : '' }}>Moda</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">UBICACIÓN</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3 top-3 text-on-surface-variant">location_on</span>
                                            <select id="form-location" name="location" class="w-full bg-surface-container-low border-outline-variant rounded-lg p-3 pl-10 focus:ring-2 focus:ring-primary">
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
                                @foreach((array)$product->image_path as $image)
                                <div class="aspect-square rounded-xl overflow-hidden border border-outline-variant relative group existing-image">
                                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $image) }}">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button type="button" onclick="removeImage(this, '{{ $image }}')" class="bg-error text-on-error p-2 rounded-full shadow-lg">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </div>
                                </div>
                                @endforeach

                                <label id="upload-box" for="image-input" class="border-2 border-dashed border-outline-variant rounded-xl aspect-square flex flex-col items-center justify-center text-center hover:bg-surface-container-low transition-colors cursor-pointer group p-4">
                                    <input type="file" id="image-input" name="image_path[]" accept="image/*" class="hidden" multiple>
                                    <span class="material-symbols-outlined text-3xl text-outline-variant group-hover:text-primary transition-colors">cloud_upload</span>
                                    <p class="mt-2 text-xs font-bold text-on-surface">Subir imágenes</p>
                                    <p class="text-on-surface-variant text-[10px] mt-0.5">JPG, PNG (Max. 5MB)</p>
                                </label>
                            </div>
                        </section>
                        <!-- Price & State Section -->
                        <section class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">PRECIO (S/.)</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-3 font-bold text-primary">S/.</span>
                                        <input id="form-price" name="price" class="w-full bg-surface-container-low border-outline-variant rounded-lg p-3 pl-12 font-price-display text-price-display text-secondary focus:ring-2 focus:ring-primary" type="number" step="0.01" value="{{ old('price', $product->price) }}" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">ESTADO</label>
                                    <div class="flex gap-2">
                                        <button class="flex-1 py-3 px-4 rounded-lg border-2 border-primary bg-primary-fixed text-primary font-bold">Usado</button>
                                        <button class="flex-1 py-3 px-4 rounded-lg border-2 border-outline-variant text-on-surface-variant font-bold hover:bg-surface-container-high transition-colors">Nuevo</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="mt-6 p-4 bg-surface-container-low rounded-xl flex items-center justify-between border border-outline-variant">
                            <div>
                                <label class="block font-bold text-on-surface">Estado del Producto</label>
                                <p class="text-xs text-on-surface-variant">¿El producto sigue disponible para la venta?</p>
                            </div>

                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-outline rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-primary after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                    </div>
                    <!-- Preview Sidebar -->
                    <div class="lg:col-span-4 sticky top-24">
                        <h3 class="font-label-caps text-label-caps text-on-surface-variant mb-4 uppercase">Vista Previa del Anuncio</h3>

                        <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-lg border border-outline-variant group">
                            <div class="relative h-64">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    id="preview-img"
                                    src="{{ asset('storage/' . ($product->image_path[0] ?? 'default.jpg')) }}" />
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                                    <span class="material-symbols-outlined text-secondary text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="text-label-caps font-bold">4.9</span>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="preview-category text-primary font-label-caps text-label-caps bg-primary-fixed px-2 py-0.5 rounded uppercase">
                                        {{ $product->category ?? 'Categoría' }}
                                    </span>
                                    <div id="preview-location" class="flex items-center text-on-surface-variant text-body-sm">
                                        <span class="material-symbols-outlined text-[16px] mr-1">location_on</span>
                                        {{ $product->location ?? 'Lima' }}
                                    </div>
                                </div>

                                <h4 class="font-headline-md text-headline-md text-on-surface mb-2 leading-tight" id="preview-title">
                                    {{ $product->title ?? 'Smartphone Samsung Galaxy S23 Ultra' }}
                                </h4>

                                <div class="flex items-baseline gap-2 mb-4">
                                    <span class="preview-price font-price-display text-price-display text-secondary">
                                        S/ {{ number_format($product->price ?? 0, 2) }}
                                    </span>
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
                                    <p class="font-body-sm text-body-sm text-on-tertiary-fixed-variant mt-1">Los anuncios con descripciones detalladas y precios competitivos en Lima cierran un 30% más rápido.</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </main>
    <!-- Footer -->
    <footer class="w-full mt-auto bg-inverse-surface dark:bg-surface-container-lowest">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-gutter py-12 max-w-container-max mx-auto">
            <div class="md:col-span-1">
                <span class="text-headline-md font-headline-md font-bold text-on-primary dark:text-primary">MarketPlace Plus</span>
                <p class="text-body-sm text-surface-variant dark:text-on-surface-variant mt-4">La plataforma líder para conectar compradores y vendedores de forma directa y segura.</p>
            </div>
            <div>
                <h4 class="text-label-caps font-label-caps text-on-primary dark:text-primary mb-6">Enlaces Rápidos</h4>
                <ul class="flex flex-col gap-3">
                    <li><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="{{ route('home') }}">Comprar producto</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="{{ route('seller.tratos.index') }}">Mis tratos</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="{{ route('proximamente') }}">Rastrear pedido</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-label-caps font-label-caps text-on-primary dark:text-primary mb-6">Soporte</h4>
                <ul class="flex flex-col gap-3">
                    <li><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="{{ route('proximamente') }}">Ayuda al cliente</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="{{ route('proximamente') }}">Sobre nosotros</a></li>
                    <li><a class="text-body-sm text-surface-variant hover:text-white transition-colors" href="{{ route('proximamente') }}">Términos y condiciones</a></li>
                </ul>
            </div>
            <div class="md:col-span-1">
                <h4 class="text-label-caps font-label-caps mb-6 uppercase tracking-wider text-white">RECOMENDACIONES PARA TUS TRATOS</h4>
                <div class="flex flex-col gap-4">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-white" style="font-size: 20px;">check_circle</span>
                        <p class="text-body-sm leading-tight text-white">Verifica la reputación del vendedor</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-white" style="font-size: 20px;">location_on</span>
                        <p class="text-body-sm leading-tight text-white">Realiza tus tratos en lugares públicos</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        // --- 1. LÓGICA DE IMÁGENES ---
        function removeImage(btn, imageName = null) {
            if (!confirm('¿Seguro que deseas eliminar esta imagen?')) return;

            if (imageName) {
                const form = document.querySelector('form');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'removed_images[]';
                input.value = imageName;
                form.appendChild(input);
            }
            btn.closest('.image-wrapper').remove();
        }

        document.getElementById('image-input').addEventListener('change', function(e) {
            const gallery = document.getElementById('gallery-container');
            const uploadBox = document.getElementById('upload-box');

            Array.from(e.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    // Actualizamos también la vista previa de la tarjeta
                    document.getElementById('preview-img').src = event.target.result;

                    const div = document.createElement('div');
                    div.className = "aspect-square rounded-xl overflow-hidden border border-outline-variant relative group image-wrapper";
                    div.innerHTML = `
                    <img src="${event.target.result}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <button type="button" onclick="removeImage(this)" class="bg-error text-on-error p-2 rounded-full shadow-lg">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                `;
                    gallery.insertBefore(div, uploadBox);
                }
                reader.readAsDataURL(file);
            });
        });

        // --- 2. LÓGICA DE VISTA PREVIA (Texto y Precios) ---
        const updatePreview = () => {
            const title = document.getElementById('form-title').value;
            const category = document.getElementById('form-category').value;
            const location = document.getElementById('form-location').value;
            const price = document.getElementById('form-price').value;

            document.getElementById('preview-title').textContent = title || "Nombre del Producto";
            document.querySelector('.preview-category').textContent = category || "Categoría";
            document.getElementById('preview-location').innerHTML =
                `<span class="material-symbols-outlined text-[16px] mr-1">location_on</span> ${location || "Ubicación"}`;

            document.querySelector('.preview-price').textContent =
                `S/ ${parseFloat(price || 0).toLocaleString('es-PE', {minimumFractionDigits: 2})}`;
        };

        // Escuchar cambios en los inputs del formulario
        ['form-title', 'form-category', 'form-location', 'form-price'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.addEventListener('input', updatePreview);
        });
    </script>
    @if(session('success'))
    <div id="success-modal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-xl max-w-sm w-full text-center border border-outline-variant animate-in fade-in zoom-in duration-300">
            <div class="flex justify-center mb-4">
                <span class="material-symbols-outlined text-primary text-6xl">check_circle</span>
            </div>

            <h3 class="text-headline-md font-bold text-on-surface">¡Todo listo!</h3>
            <p class="text-body-md text-on-surface-variant mt-2">{{ session('success') }}</p>

            <button onclick="document.getElementById('success-modal').style.display='none'"
                class="mt-6 w-full bg-primary text-on-primary py-3 rounded-lg font-bold hover:brightness-110 transition-all">
                Aceptar
            </button>
        </div>
    </div>
    @endif
</body>

</html>