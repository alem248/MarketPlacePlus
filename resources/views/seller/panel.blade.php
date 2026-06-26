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
    @include('partials.seller-navbar')
    <div class="flex pt-16 min-h-screen"> <!-- Container for Sidebar and Main Content -->
        @include('partials.seller-sidebar', ['activeSellerTab' => 'panel'])
        <!-- Main Content Canvas -->
        <div class="flex-1 flex flex-col min-w-0">
            <main class="flex-1 p-gutter bg-background">
                <!-- Hero Dashboard Banner -->
                <div class="relative overflow-hidden rounded-3xl bg-primary-container text-on-primary-container p-8 mb-8 flex flex-col md:flex-row justify-between items-center">
                    <div class="relative z-10 max-w-xl">
                        <h1 class="font-headline-lg text-headline-lg mb-2">¿Qué vamos a vender hoy?</h1>
                        <p class="font-body-lg text-body-lg opacity-90 mb-6">La clave de una buena venta es la confianza. Descripciones claras y fotos impecables garantizan éxito.</p>
                        <a href="{{ route('seller.products.create') }}" class="bg-secondary-container text-on-secondary-container px-8 py-4 rounded-xl font-bold font-headline-md text-headline-md flex items-center gap-2 hover:scale-105 transition-transform">
                            PUBLICAR PRODUCTO
                            <span class="material-symbols-outlined">add_box</span>
                        </a>
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
                                @forelse($products as $product)
                                <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl overflow-hidden group hover:shadow-lg transition-all">
                                    <div class="h-48 overflow-hidden relative">
                                        @php
                                            // Resolvemos la URL de la imagen: externa (http) o almacenamiento local
                                            $imgs     = is_array($product->image_path) ? $product->image_path : [$product->image_path];
                                            $firstImg = $imgs[0] ?? null;
                                            $imgSrc   = $firstImg
                                                ? (Str::startsWith($firstImg, 'http') ? $firstImg : Storage::url($firstImg))
                                                : null;
                                        @endphp
                                        @if($imgSrc)
                                        <img class="w-full h-full object-cover transition-transform group-hover:scale-110"
                                             src="{{ $imgSrc }}" alt="{{ $product->title }}">
                                        @else
                                        <div class="w-full h-full flex items-center justify-center bg-surface-container">
                                            <span class="material-symbols-outlined text-outline text-4xl">image</span>
                                        </div>
                                        @endif

                                        <div class="absolute top-2 right-2 flex gap-1">
                                            {{-- 1. Si el producto tiene razón de suspensión, bloqueamos la edición SIEMPRE --}}
                                            @if($product->suspension_reason)
                                            <div class="p-2 bg-error text-white rounded-full cursor-not-allowed opacity-80"
                                                title="Suspendido: {{ $product->suspension_reason }}">
                                                <span class="material-symbols-outlined text-sm">block</span>
                                            </div>
                                            @else
                                            {{-- 2. Si NO hay razón de suspensión, permitimos editar --}}
                                            <a href="{{ route('seller.products.edit', $product->id) }}"
                                                class="p-2 bg-white/90 rounded-full hover:bg-white text-primary transition-colors">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <span class="font-label-caps text-label-caps text-on-surface-variant">{{ strtoupper($product->category) }}</span>
                                        <h3 class="font-headline-md text-headline-md mb-2 line-clamp-1">{{ $product->title }}</h3>
                                        <p class="font-price-display text-price-display text-primary">S/. {{ number_format($product->price, 2) }}</p>

                                        <div class="mt-4 pt-4 border-t border-outline-variant flex justify-between items-center">
                                            <span class="inline-flex items-center gap-1 bg-secondary text-on-secondary px-3 py-1.5 rounded-lg font-bold text-xs">
                                                <span class="material-symbols-outlined text-xs">location_on</span>
                                                {{ $product->location }}
                                            </span>

                                            <span class="text-xs font-bold {{ $product->is_active ? 'text-emerald-600' : 'text-error' }}">
                                                {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-span-full text-center py-12 bg-surface-container-lowest border border-dashed border-outline-variant rounded-2xl p-6 flex flex-col items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-outline-variant mb-2">inventory_2</span>
                                    <p class="font-bold text-on-surface mb-1">No tienes publicaciones activas</p>
                                    <p class="text-xs text-on-surface-variant mb-4">Los productos que registres en el sistema aparecerán en esta zona.</p>
                                    <a href="{{ route('seller.products.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-xl text-xs font-bold hover:bg-primary/90 transition-colors shadow-sm">
                                        Crear publicación
                                    </a>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <!-- Mis Comentarios — datos reales de la base de datos -->
                    <div class="space-y-6">
                        <div class="flex justify-between items-center">
                            <h2 class="font-headline-lg text-headline-lg text-on-surface">Mis Comentarios</h2>
                            @if($sellerComments->isNotEmpty())
                                <span class="text-body-sm text-on-surface-variant">{{ $sellerComments->count() }} más recientes</span>
                            @endif
                        </div>
                        <div class="space-y-4">
                            @forelse($sellerComments as $comment)
                            <div class="p-6 bg-surface-container-lowest border border-outline-variant rounded-2xl hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="font-bold text-on-surface">
                                            {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                        </h4>
                                        <p class="text-[11px] text-on-surface-variant mt-0.5">
                                            {{ $comment->product->title }} · {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="flex text-secondary-container">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-sm"
                                                style="font-variation-settings: '{{ $i <= $comment->rating ? 'FILL' : '' }}' 1;">star</span>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-on-surface-variant text-body-sm leading-relaxed italic">"{{ $comment->content }}"</p>
                            </div>
                            @empty
                            <div class="p-8 text-center text-on-surface-variant border border-dashed border-outline-variant rounded-2xl">
                                <span class="material-symbols-outlined text-4xl mb-2 block">rate_review</span>
                                <p class="font-body-sm">Aún no tienes reseñas. Aparecerán aquí cuando los compradores califiquen tus productos.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- Right Column (Proposals Inbox) -->
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-headline-lg text-headline-lg text-on-surface">Bandeja de Propuestas</h2>
                        @if($pendingTratos->isNotEmpty())
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-secondary-container/20 text-secondary rounded-full text-xs font-bold">
                                {{ $pendingTratos->count() }} pendiente{{ $pendingTratos->count() > 1 ? 's' : '' }}
                            </span>
                        @endif
                    </div>

                    <div class="space-y-4">
                        @forelse($pendingTratos as $trato)
                        @php
                            $imgs     = is_array($trato->product->image_path) ? $trato->product->image_path : [$trato->product->image_path];
                            $firstImg = $imgs[0] ?? null;
                            $imgSrc   = $firstImg
                                ? (Str::startsWith($firstImg, 'http') ? $firstImg : Storage::url($firstImg))
                                : null;
                            $lastMsg  = $trato->messages->last();
                            $isNew    = $trato->status === 'pedido_realizado';
                        @endphp
                        <div class="p-4 bg-surface-container-lowest border border-outline-variant rounded-2xl flex gap-4 items-start hover:bg-surface-container transition-colors {{ $isNew ? 'border-l-4 border-l-secondary-container' : '' }}">

                            {{-- Imagen del producto --}}
                            <div class="w-14 h-14 rounded-xl shrink-0 overflow-hidden bg-surface-container-high flex items-center justify-center">
                                @if($imgSrc)
                                    <img src="{{ $imgSrc }}" alt="{{ $trato->product->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-outline">image</span>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                {{-- Comprador + producto --}}
                                <p class="text-sm font-bold text-on-surface truncate">
                                    {{ $trato->buyer->first_name }} {{ $trato->buyer->last_name }}
                                </p>
                                <p class="text-xs text-on-surface-variant truncate mb-1">
                                    {{ $trato->product->title }}
                                    <span class="font-bold text-primary ml-1">S/. {{ number_format($trato->price, 2) }}</span>
                                </p>

                                {{-- Último mensaje del comprador --}}
                                @if($lastMsg)
                                    <p class="text-xs text-on-surface-variant italic truncate mb-2">
                                        "{{ $lastMsg->body }}"
                                    </p>
                                @endif

                                {{-- Badges --}}
                                <div class="flex items-center gap-2 mb-3">
                                    @if($isNew)
                                        <span class="text-xs px-2 py-0.5 bg-secondary-container/20 text-secondary rounded-full font-bold">Nueva propuesta</span>
                                    @else
                                        <span class="text-xs px-2 py-0.5 bg-primary/10 text-primary rounded-full font-bold">En discusión</span>
                                    @endif
                                    <span class="text-xs text-on-surface-variant">{{ $trato->created_at->format('d M, Y') }}</span>
                                </div>

                                {{-- Acciones --}}
                                <div class="flex gap-2">
                                    <a href="{{ route('seller.tratos.show', $trato) }}"
                                       class="flex-1 border border-primary text-primary py-2 rounded-xl font-bold text-xs flex items-center justify-center gap-1.5 hover:bg-primary hover:text-on-primary transition-all">
                                        <span class="material-symbols-outlined text-[14px]">forum</span>
                                        Responder
                                    </a>
                                    <form action="{{ route('seller.tratos.reject', $trato) }}" method="POST"
                                          onsubmit="return confirm('¿Rechazar esta propuesta?')">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-2 rounded-xl border border-error/40 text-error text-xs font-bold hover:bg-error/10 transition-colors">
                                            <span class="material-symbols-outlined text-[14px]">close</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="flex flex-col items-center justify-center py-12 bg-surface-container-lowest border border-dashed border-outline-variant rounded-2xl text-center px-6">
                            <span class="material-symbols-outlined text-outline text-4xl mb-3">inbox</span>
                            <p class="font-bold text-on-surface mb-1">Sin propuestas pendientes</p>
                            <p class="text-xs text-on-surface-variant">Cuando un comprador inicie un trato en uno de tus productos, aparecerá aquí.</p>
                        </div>
                        @endforelse

                        @if($pendingTratos->isNotEmpty())
                        <a href="{{ route('seller.tratos.index') }}"
                           class="block w-full text-center text-primary font-bold text-sm hover:underline py-2">
                            Ver todos los tratos →
                        </a>
                        @endif
                    </div>
                </div>
        </div>
        </main>
        <!-- Corrected Dark Footer -->
    </div>
    </div>
    @include('partials.footer')
    @if(isset($suspendedProduct) && !empty($suspendedProduct->suspension_reason) && is_null($suspendedProduct->viewed_suspension_at))
    <div id="suspensionModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full shadow-2xl border border-gray-200">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-4xl">report_problem</span>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">Publicación Suspendida</h2>
                <p class="text-sm text-gray-600 mb-6">
                    Tu producto <strong>{{ $suspendedProduct->title }}</strong> ha sido suspendido por un administrador.
                </p>

                <div class="w-full bg-gray-50 p-4 rounded-xl text-left mb-6 border border-gray-200">
                    <p class="text-xs font-bold text-gray-500 uppercase mb-1">Motivo:</p>
                    <p class="text-sm text-gray-800">{{ $suspendedProduct->suspension_reason }}</p>
                </div>

                <form action="{{ route('seller.products.acknowledge', $suspendedProduct->id) }}" method="POST" class="w-full m-0 p-0">
                    @csrf
                    <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition-all block">
                        Entendido
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
{{-- MODAL DE REACTIVACIÓN EXITOSA --}}
@if(isset($reactivatedProduct))
    <div id="reactivationModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full shadow-2xl border border-gray-200">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-4xl">check_circle</span>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">¡Publicación Reactivada!</h2>
                <p class="text-sm text-gray-600 mb-6">
                    Buenas noticias. Tu producto <strong>{{ $reactivatedProduct->title }}</strong> ha sido revisado y aprobado por el administrador. Ya se encuentra visible para todos los compradores.
                </p>

                <form action="{{ route('seller.products.acknowledgeReactivation', $reactivatedProduct->id) }}" method="POST" class="w-full m-0 p-0">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-bold transition-all block">
                        Excelente, gracias
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif


</body>

</html>