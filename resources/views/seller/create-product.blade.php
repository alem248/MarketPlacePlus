<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Crear Publicación - Market Place Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e1e3e4;
            border-radius: 10px;
        }
    </style>
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
</head>

<body class="bg-background text-on-surface min-h-screen flex flex-col">
    @include('partials.seller-navbar')
    <div class="flex flex-1 pt-16">
        @include('partials.seller-sidebar', ['activeSellerTab' => 'create'])
        <!-- Main Content -->
        <main class="flex-1 p-gutter bg-background min-h-screen">
            <div class="max-w-6xl mx-auto space-y-gutter">
                @if(session('success'))
                <div class="mb-4 p-4 bg-tertiary-fixed text-tertiary rounded-2xl font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="mb-4 p-4 bg-error-container text-on-error-container rounded-2xl font-bold">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <header class="mb-8">
                    <h1 class="font-headline-lg text-headline-lg text-primary">Publicar Nuevo Producto</h1>
                    <p class="text-on-surface-variant font-body-lg text-body-lg mt-2">Completa los detalles para listar tu producto en el marketplace.</p>
                </header>

                <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
                    @csrf

                    <div class="lg:col-span-2 space-y-gutter">

                        <section class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm">
                            <div class="flex items-center gap-2 mb-6 text-primary">
                                <span class="material-symbols-outlined">info</span>
                                <h2 class="font-headline-md text-headline-md">Información Básica</h2>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">TÍTULO DEL PRODUCTO</label>
                                    <input name="title" class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary focus:border-transparent bg-white text-on-surface font-body-lg" placeholder="Ej: Smartphone Samsung Galaxy S23 Ultra" type="text" required>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">CATEGORÍA</label>
                                        <select name="category" class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg" required>
                                            <option value="">Seleccionar categoría</option>
                                            <option value="Tecnología">Tecnología</option>
                                            <option value="Hogar">Hogar</option>
                                            <option value="Moda">Moda</option>
                                            <option value="Vehículos">Vehículos</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">UBICACIÓN</label>
                                        <select name="location" class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg" required>
                                            <option value="">Seleccionar ubicación</option>
                                            <option value="Lima">Lima</option>
                                            <option value="Santa Anita">Santa Anita</option>
                                            <option value="Arequipa">Arequipa</option>
                                            <option value="Cusco">Cusco</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">DESCRIPCIÓN</label>
                                    <textarea name="description" class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg" placeholder="Describe las características principales, garantía, etc." rows="4" required></textarea>
                                </div>
                            </div>
                        </section>

                        <section class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm">
                            <div class="flex items-center gap-2 mb-6 text-primary">
                                <span class="material-symbols-outlined">payments</span>
                                <h2 class="font-headline-md text-headline-md">Precio</h2>
                            </div>
                            <div>
                                <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">PRECIO (S/.)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">S/.</span>
                                    <input name="price" class="w-full pl-12 p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg" placeholder="0.00" type="number" step="0.01" required>
                                </div>
                            </div>
                        </section>

                        <section class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm">
                            <div class="flex items-center gap-2 mb-4 text-primary">
                                <span class="material-symbols-outlined">photo_library</span>
                                <h2 class="font-headline-md text-headline-md">Multimedia</h2>
                            </div>

                            <p id="file-error-msg" class="hidden text-red-600 text-sm font-bold mb-4 bg-red-50 p-3 rounded-lg border border-red-200">
                                Archivo no compatible, solo utilice los formatos disponibles (JPG, PNG).
                            </p>

                            <div id="gallery-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                <label id="upload-box" for="image-input" class="border-2 border-dashed border-outline-variant rounded-xl aspect-square flex flex-col items-center justify-center text-center hover:bg-surface-container-low transition-colors cursor-pointer group p-4">
                                    <input type="file" id="image-input" name="image_path[]" accept="image/jpeg, image/png" class="hidden" multiple>
                                    <span id="upload-icon" class="material-symbols-outlined text-3xl text-outline-variant group-hover:text-primary transition-colors">cloud_upload</span>
                                    <p id="upload-text" class="mt-2 text-xs font-bold text-on-surface">Subir imágenes</p>
                                    <p id="upload-subtext" class="text-on-surface-variant text-[10px] mt-0.5">JPG, PNG (Max. 5MB)</p>
                                </label>
                            </div>
                        </section>

                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="button" class="flex-1 bg-white border border-outline text-on-surface font-bold py-4 rounded-xl hover:bg-surface-container-high transition-all">
                                Guardar Borrador
                            </button>
                            <button type="submit" class="flex-1 bg-secondary-container text-white font-bold py-4 rounded-xl flex items-center justify-center gap-2 hover:opacity-90 transition-all shadow-lg active:scale-95">
                                Publicar Producto
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-gutter">

                        <div class="bg-white rounded-xl border border-outline-variant overflow-hidden shadow-sm">
                            <div class="p-4 bg-surface-container text-center border-b border-outline-variant">
                                <h3 class="font-label-caps text-label-caps text-on-surface-variant">VISTA PREVIA</h3>
                            </div>
                            <div class="aspect-square bg-surface-container-high flex items-center justify-center relative">
                                <span id="preview-placeholder" class="material-symbols-outlined text-6xl text-outline-variant">inventory_2</span>
                                <img id="preview-img" class="w-full h-full object-cover hidden absolute inset-0" alt="Vista previa">
                            </div>
                            <div class="p-4 space-y-3">
                                <div class="flex text-secondary text-sm">
                                    <span class="material-symbols-outlined text-sm">star</span>
                                    <span class="material-symbols-outlined text-sm">star</span>
                                    <span class="material-symbols-outlined text-sm">star</span>
                                    <span class="material-symbols-outlined text-sm">star</span>
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 0">star</span>
                                </div>
                                <h4 class="font-headline-md text-headline-md leading-tight h-14 overflow-hidden">Título del producto aparecerá aquí</h4>
                                <p class="font-price-display text-price-display text-primary">S/. 0.00</p>
                                <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-surface-container-high"></div>
                                        <span class="text-sm font-bold">Vendedor</span>
                                    </div>
                                    <button type="button" class="bg-secondary p-2 rounded-lg text-white">
                                        <span class="material-symbols-outlined">handshake</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-primary-fixed p-gutter rounded-xl border border-primary-fixed-dim shadow-sm">
                            <div class="flex items-center gap-2 mb-4 text-on-primary-fixed">
                                <span class="material-symbols-outlined">lightbulb</span>
                                <h3 class="font-bold">Consejos de Vendedor</h3>
                            </div>
                            <ul class="space-y-3 text-sm text-on-primary-fixed-variant">
                                <li class="flex gap-2">
                                    <span class="text-primary">•</span>
                                    <span>Usa títulos claros y específicos.</span>
                                </li>
                                <li class="flex gap-2">
                                    <span class="text-primary">•</span>
                                    <span>Sube al menos 3 fotos de alta calidad.</span>
                                </li>
                                <li class="flex gap-2">
                                    <span class="text-primary">•</span>
                                    <span>Describe honestamente el estado del producto.</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </form>
            </div>
        </main>
        @if(session('success'))
        <div id="success-alert" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 transform transition-all duration-300 translate-y-[-20px] opacity-0">
            <div class="bg-emerald-600 text-white px-6 py-3 rounded-xl shadow-xl flex items-center gap-3 border border-emerald-500">
                <span class="material-symbols-outlined animate-bounce">check_circle</span>
                <span class="font-body-lg font-bold text-sm sm:text-base">{{ session('success') }}</span>
                <button type="button" onclick="closeAlert()" class="ml-4 hover:opacity-70 transition-opacity flex items-center">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
        </div>
        @endif
    </div>
    @include('partials.footer')
    <!-- Mobile Nav Bar (Hidden on Desktop) -->
    <div class="md:hidden fixed bottom-0 w-full bg-surface border-t border-outline-variant flex justify-around py-2 z-50">
        <button class="flex flex-col items-center p-2 text-on-surface-variant">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-[10px] mt-1">Panel</span>
        </button>
        <button class="flex flex-col items-center p-2 text-primary font-bold">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1">add_circle</span>
            <span class="text-[10px] mt-1">Vender</span>
        </button>
        <button class="flex flex-col items-center p-2 text-on-surface-variant">
            <span class="material-symbols-outlined">handshake</span>
            <span class="text-[10px] mt-1">Tratos</span>
        </button>
        <button class="flex flex-col items-center p-2 text-on-surface-variant">
            <span class="material-symbols-outlined">person</span>
            <span class="text-[10px] mt-1">Perfil</span>
        </button>
    </div>
    <script>
        const imageInput = document.getElementById('image-input');
        const galleryContainer = document.getElementById('gallery-container');
        const uploadBox = document.getElementById('upload-box');
        const uploadIcon = document.getElementById('upload-icon');
        const uploadText = document.getElementById('upload-text');
        const uploadSubtext = document.getElementById('upload-subtext');

        const previewImg = document.getElementById('preview-img');
        const previewPlaceholder = document.getElementById('preview-placeholder');

        // Array interno para almacenar los archivos seleccionados de forma acumulativa
        let selectedFiles = [];

        imageInput.addEventListener('change', (e) => {
            const files = Array.from(e.target.files);

            files.forEach(file => {
                // Evitar duplicados exactos por nombre y tamaño
                if (!selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
                    selectedFiles.push(file);
                    renderThumbnail(file);
                }
            });

            updateInterface();
        });

        function renderThumbnail(file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Crear el contenedor de la miniatura
                const thumbDiv = document.createElement('div');
                thumbDiv.className = "relative aspect-square rounded-xl overflow-hidden border border-outline-variant group bg-surface-container-high animate-fade-in";

                // Imagen miniatura
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = "w-full h-full object-cover";

                // Botón para eliminar miniatura
                const removeBtn = document.createElement('button');
                removeBtn.type = "button";
                removeBtn.className = "absolute top-1 right-1 bg-error text-white rounded-full p-1 shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center hover:scale-110";
                removeBtn.innerHTML = '<span class="material-symbols-outlined text-sm">delete</span>';

                // Evento para remover la imagen del flujo
                removeBtn.addEventListener('click', () => {
                    selectedFiles = selectedFiles.filter(f => f !== file);
                    thumbDiv.remove();
                    updateInterface();
                });

                thumbDiv.appendChild(img);
                thumbDiv.appendChild(removeBtn);

                // Insertar la miniatura antes de la caja de subida
                galleryContainer.insertBefore(thumbDiv, uploadBox);
            }
            reader.readAsDataURL(file);
        }

        function updateInterface() {
            if (selectedFiles.length > 0) {
                // Rediseñar la caja de subida para que actúe como un botón "Agregar más" compacto
                uploadBox.className = "border-2 border-dashed border-primary/40 rounded-xl aspect-square flex flex-col items-center justify-center text-center hover:bg-primary-container/10 transition-colors cursor-pointer group p-2 bg-surface-container-lowest";
                uploadIcon.className = "material-symbols-outlined text-2xl text-primary";
                uploadText.textContent = "Añadir más";
                uploadText.className = "mt-1 text-xs font-bold text-primary";
                uploadSubtext.classList.add('hidden');

                // Actualizar la Vista Previa principal con la primera imagen del arreglo
                const firstReader = new FileReader();
                firstReader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    if (previewPlaceholder) previewPlaceholder.classList.add('hidden');
                }
                firstReader.readAsDataURL(selectedFiles[0]);

            } else {
                // Reestablecer la caja de subida a su estado original de diseño completo
                uploadBox.className = "border-2 border-dashed border-outline-variant rounded-xl aspect-square flex flex-col items-center justify-center text-center hover:bg-surface-container-low transition-colors cursor-pointer group p-4 w-full";
                uploadIcon.className = "material-symbols-outlined text-4xl text-outline-variant group-hover:text-primary transition-colors";
                uploadText.textContent = "Haz clic para subir una imagen";
                uploadText.className = "mt-4 font-body-lg text-body-lg font-bold text-on-surface";
                uploadSubtext.classList.remove('hidden');

                // Limpiar Vista Previa principal
                previewImg.src = "";
                previewImg.classList.add('hidden');
                if (previewPlaceholder) previewPlaceholder.classList.remove('hidden');
            }

            // Sincronizar los archivos del array con el objeto FileList real del input
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            imageInput.files = dataTransfer.files;
        }

        // Código existente para actualizar textos de título y precio...
        const titleInput = document.querySelector('input[name="title"]');
        const priceInput = document.querySelector('input[name="price"]');
        const previewTitle = document.querySelector('h4');
        const previewPrice = document.querySelector('.font-price-display');

        if (titleInput && previewTitle) {
            titleInput.addEventListener('input', (e) => {
                previewTitle.textContent = e.target.value || "Título del producto aparecerá aquí";
            });
        }

        if (priceInput && previewPrice) {
            priceInput.addEventListener('input', (e) => {
                previewPrice.textContent = e.target.value ? `S/. ${parseFloat(e.target.value).toFixed(2)}` : "S/. 0.00";
            });
        }

        // Manejo de la Alerta de Éxito
        document.addEventListener('DOMContentLoaded', () => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                // Pequeño delay para activar la animación de entrada
                setTimeout(() => {
                    alert.classList.remove('translate-y-[-20px]', 'opacity-0');
                    alert.classList.add('translate-y-0', 'opacity-100');
                }, 100);

                // Auto-cierre después de 4 segundos
                setTimeout(() => {
                    closeAlert();
                }, 4000);
            }
        });

        function closeAlert() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.classList.remove('translate-y-0', 'opacity-100');
                alert.classList.add('translate-y-[-20px]', 'opacity-0');
                setTimeout(() => alert.remove(), 300);
            }
        }

        document.getElementById('image-input').addEventListener('change', function(event) {
            const errorMsg = document.getElementById('file-error-msg');
            const allowedTypes = ['image/jpeg', 'image/png'];
            let hasError = false;

            for (let i = 0; i < this.files.length; i++) {
                if (!allowedTypes.includes(this.files[i].type)) {
                    hasError = true;
                    break;
                }
            }

            if (hasError) {
                errorMsg.classList.remove('hidden');
                this.value = '';
            } else {
                errorMsg.classList.add('hidden');
            }
        });
    </script>
</body>

</html>