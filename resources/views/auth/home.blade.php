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