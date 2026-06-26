<!DOCTYPE html>

<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Editar Producto | MarketPlace Plus</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/icon.png') }}">

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
    @include('partials.seller-navbar')

    <div class="flex pt-16 min-h-screen">

        @include('partials.seller-sidebar', ['activeSellerTab' => 'create'])

        <!-- Main Content Canvas -->
        <main class="flex-1 pb-12 px-gutter min-h-screen">
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
    </div>

    @include('partials.footer')
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