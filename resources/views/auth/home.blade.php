<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>MarketPlace Plus | Catálogo Principal</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/icon.png') }}">

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

        /* Estilos para el modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .modal-content {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 28rem;
            width: 100%;
            margin: 0 1rem;
            padding: 1.5rem;
            animation: modalFadeIn 0.4s ease-out;
        }

        .modal-content.dark {
            background-color: #1f2937;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes modalFadeOut {
            from {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            to {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }
        }

        .modal-fade-out {
            animation: modalFadeOut 0.3s ease-out forwards;
        }

        /* Estilos para el modal de edición */
        .state-transition {
            animation: stateFade 0.3s ease;
        }

        @keyframes stateFade {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="text-on-background">
    @include('partials.client-navbar')
    <div class="max-w-container-max mx-auto flex">
        @php
            $sideImgSrc = null;
            if ($sideBanner?->image_path) {
                $sideImgSrc = Str::startsWith($sideBanner->image_path, 'http')
                    ? $sideBanner->image_path
                    : Storage::url($sideBanner->image_path);
            }
        @endphp
        @include('partials.client-sidebar', ['activeClientTab' => 'panel', 'sideBanner' => $sideBanner ?? null, 'sideImgSrc' => $sideImgSrc])
        <!-- Main Content -->
        <main class="flex-1 min-w-0 p-4 md:p-gutter">
            @php
                $heroImgSrc = null;
                if ($heroBanner?->image_path) {
                    $heroImgSrc = Str::startsWith($heroBanner->image_path, 'http')
                        ? $heroBanner->image_path
                        : Storage::url($heroBanner->image_path);
                }
            @endphp
            @if($heroBanner)
            <section class="mb-10 rounded-2xl overflow-hidden relative h-[300px] md:h-[400px] flex items-center bg-inverse-surface">
                {{-- Imagen del banner a plena visibilidad con overlay oscuro para legibilidad --}}
                @if($heroImgSrc)
                    <img alt="{{ $heroBanner->title }}"
                         class="absolute inset-0 w-full h-full object-cover"
                         src="{{ $heroImgSrc }}">
                    <div class="absolute inset-0 bg-black/50"></div>
                @endif
                <div class="relative z-10 px-8 md:px-16 max-w-2xl">
                    <h1 class="text-headline-lg-mobile md:text-headline-lg text-white mb-4 leading-tight">
                        {{ $heroBanner->title }}
                    </h1>
                    @if($heroBanner->description)
                        <p class="text-body-lg text-white/80 mb-8">{{ $heroBanner->description }}</p>
                    @endif
                    @if($heroBanner->link_url)
                    <a href="{{ $heroBanner->link_url }}" target="_blank" rel="noopener"
                       class="px-8 py-3 bg-secondary-container text-on-secondary font-bold rounded-xl inline-flex items-center gap-2 hover:shadow-lg transition-shadow">
                        Ver más
                        <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
                    </a>
                    @endif
                </div>
            </section>
            @endif
            <!-- Product Grid -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-headline-md font-headline-md text-primary">Catálogo Destacado</h2>
                <div class="flex items-center gap-2">
                    <span class="text-body-sm text-outline">Ordenar por:</span>
                    <select onchange="const u=new URL(window.location);u.searchParams.set('sort',this.value);u.searchParams.delete('page');window.location=u"
                            class="bg-surface-container-low border-none text-body-sm rounded-lg focus:ring-primary py-1 px-3">
                        <option value="latest"     {{ request('sort','latest')==='latest'     ? 'selected' : '' }}>Más recientes</option>
                        <option value="price_asc"  {{ request('sort')==='price_asc'           ? 'selected' : '' }}>Menor precio</option>
                        <option value="price_desc" {{ request('sort')==='price_desc'          ? 'selected' : '' }}>Mayor precio</option>
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
    @include('partials.footer')

    <!-- MODAL CON EDICIÓN INTEGRADA -->
    @auth
        @php
            $disabledComment = auth()->user()->comments()
                ->where('is_active', false)
                ->whereNotNull('admin_message')
                ->latest('updated_at')
                ->first();
        @endphp

        @if($disabledComment)
            <!-- ========================================== -->
            <!-- MODAL PRINCIPAL                            -->
            <!-- ========================================== -->
            <div id="moderationModal" class="modal-overlay" style="display: none;">
                <div class="modal-content" id="modalContent">
                    
                    <!-- ========================================== -->
                    <!-- ESTADO 1: ALERTA (visible por defecto)    -->
                    <!-- ========================================== -->
                    <div id="alert-state">
                        <!-- Icono -->
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-red-600 text-4xl">notification_important</span>
                            </div>
                        </div>

                        <!-- Título -->
                        <h3 class="text-xl font-bold text-center text-gray-900 mb-2">
                            ⚠️ Comentario Deshabilitado
                        </h3>

                        <!-- Mensaje -->
                        <p class="text-center text-gray-600 text-sm mb-4">
                            Tu comentario ha sido deshabilitado por el administrador por incumplir las normas de la plataforma.
                        </p>

                        <!-- Comentario del usuario -->
                        <div class="bg-gray-50 rounded-lg p-3 mb-4">
                            <p class="text-xs text-gray-500 mb-1">Tu comentario:</p>
                            <p class="text-sm text-gray-700 italic">
                                "{{ Str::limit($disabledComment->content, 100) }}"
                            </p>
                        </div>

                        <!-- Motivo del administrador -->
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-5">
                            <p class="text-xs text-red-600 font-semibold mb-1">Motivo de la desactivación:</p>
                            <p class="text-sm text-red-700">
                                {{ $disabledComment->admin_message }}
                            </p>
                        </div>

                        <!-- ⚠️ ADVERTENCIA ⚠️ -->
                        <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-3 mb-5">
                            <div class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-yellow-600 text-xl">warning</span>
                                <div>
                                    <p class="text-sm font-semibold text-yellow-800">
                                        📢 Para poder solucionar esto:
                                    </p>
                                    <p class="text-sm text-yellow-700 mt-1">
                                        Edita tu comentario siguiendo las normas de la plataforma. 
                                        <strong>Caso contrario, podrías ser baneado o suspendido</strong>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex flex-col gap-3">
                            <!-- Botón para abrir edición -->
                            <button onclick="openEditMode()" 
                                    class="w-full bg-primary hover:brightness-110 text-on-primary font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">edit</span>
                                Editar Comentario
                            </button>

                            <!-- Botón para cerrar -->
                            <button onclick="closeModerationModal()" 
                                    class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2.5 px-4 rounded-lg transition-all duration-200">
                                Entendido, lo revisaré después
                            </button>
                        </div>

                        <!-- Fecha de moderación -->
                        <p class="text-center text-xs text-gray-400 mt-3">
                            Moderado el: {{ $disabledComment->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <!-- ========================================== -->
                    <!-- ESTADO 2: EDICIÓN (oculto por defecto)    -->
                    <!-- ========================================== -->
                    <div id="edit-state" style="display: none;">
                        <!-- Icono -->
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary text-4xl">edit</span>
                            </div>
                        </div>

                        <!-- Título -->
                        <h3 class="text-xl font-bold text-center text-gray-900 mb-2">
                            ✏️ Editar Comentario
                        </h3>

                        <!-- Mensaje -->
                        <p class="text-center text-gray-600 text-sm mb-4">
                            Corrige tu comentario para que cumpla con las normas de la plataforma.
                        </p>

                        <!-- Formulario de edición -->
                        <form id="editCommentForm" action="{{ route('user.comments.update', $disabledComment) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Motivo del administrador (resumen) -->
                            <div class="bg-red-50 border border-red-200 rounded-lg p-2 mb-4">
                                <p class="text-xs text-red-600 font-semibold">Motivo:</p>
                                <p class="text-xs text-red-700">{{ $disabledComment->admin_message }}</p>
                            </div>

                            <!-- Textarea para editar -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nuevo comentario <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    id="editContent"
                                    name="content" 
                                    rows="4" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent"
                                    placeholder="Escribe tu nuevo comentario..."
                                    required
                                >{{ $disabledComment->content }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Mínimo 5 caracteres. Máximo 500 caracteres.</p>
                            </div>

                            <!-- Calificación (si existe) -->
                            @if($disabledComment->rating)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Calificación
                                </label>
                                <div class="flex gap-1">
                                    @for($i=1; $i<=5; $i++)
                                        <label class="cursor-pointer text-3xl transition-colors hover:text-yellow-400">
                                            <input type="radio" name="rating" value="{{ $i }}" 
                                                   {{ $i == $disabledComment->rating ? 'checked' : '' }}
                                                   class="hidden peer">
                                            <span class="peer-checked:text-yellow-400 {{ $i <= $disabledComment->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            @endif

                            <!-- Botones -->
                            <div class="flex gap-3">
                                <button type="button" onclick="closeEditMode()" 
                                        class="flex-1 py-3 text-center border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    Cancelar
                                </button>
                                <button type="submit" 
                                        class="flex-1 py-3 bg-primary text-on-primary rounded-lg hover:brightness-110 transition flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">send</span>
                                    Enviar a Moderación
                                </button>
                            </div>

                            <p class="text-xs text-gray-500 text-center mt-3">
                                Al enviar, tu comentario será revisado nuevamente por el administrador.
                            </p>
                        </form>
                    </div>

                </div>
            </div>

            <script>
                // Mostrar el modal siempre (sin localStorage)
                document.addEventListener('DOMContentLoaded', function() {
                    const modal = document.getElementById('moderationModal');
                    if (modal) {
                        modal.style.display = 'flex';
                    }
                });

                // Cambiar al estado de edición
                function openEditMode() {
                    const alertState = document.getElementById('alert-state');
                    const editState = document.getElementById('edit-state');
                    
                    alertState.style.opacity = '0';
                    setTimeout(() => {
                        alertState.style.display = 'none';
                        editState.style.display = 'block';
                        editState.classList.add('state-transition');
                        setTimeout(() => {
                            editState.classList.remove('state-transition');
                        }, 300);
                    }, 300);
                }

                // Volver al estado de alerta
                function closeEditMode() {
                    const alertState = document.getElementById('alert-state');
                    const editState = document.getElementById('edit-state');
                    
                    editState.style.opacity = '0';
                    setTimeout(() => {
                        editState.style.display = 'none';
                        alertState.style.display = 'block';
                        alertState.classList.add('state-transition');
                        setTimeout(() => {
                            alertState.classList.remove('state-transition');
                        }, 300);
                    }, 300);
                }

                // Cerrar el modal completamente
                function closeModerationModal() {
                    const modal = document.getElementById('moderationModal');
                    modal.style.opacity = '0';
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 300);
                }

                // Cerrar con tecla ESC
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        const modal = document.getElementById('moderationModal');
                        if (modal && modal.style.display !== 'none') {
                            // Si está en modo edición, volver a alerta
                            const editState = document.getElementById('edit-state');
                            if (editState.style.display !== 'none') {
                                closeEditMode();
                            } else {
                                closeModerationModal();
                            }
                        }
                    }
                });

                // Cerrar al hacer clic fuera del modal
                document.addEventListener('DOMContentLoaded', function() {
                    const modal = document.getElementById('moderationModal');
                    if (modal) {
                        modal.addEventListener('click', function(event) {
                            if (event.target === this) {
                                const editState = document.getElementById('edit-state');
                                if (editState.style.display !== 'none') {
                                    closeEditMode();
                                } else {
                                    closeModerationModal();
                                }
                            }
                        });
                    }

                    // Validación del formulario
                    const form = document.getElementById('editCommentForm');
                    if (form) {
                        form.addEventListener('submit', function(event) {
                            const content = document.getElementById('editContent');
                            if (content.value.trim().length < 5) {
                                event.preventDefault();
                                content.classList.add('border-red-500');
                                alert('El comentario debe tener al menos 5 caracteres.');
                            }
                        });
                    }
                });
            </script>
        @endif
    @endauth

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