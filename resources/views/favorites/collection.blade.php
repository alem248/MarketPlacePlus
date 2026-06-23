<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $collection->name }} | Mis Favoritos | MarketPlace Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-primary": "#ffffff", "on-secondary": "#ffffff", "inverse-surface": "#2e3132",
                        "on-error": "#ffffff", "primary-fixed-dim": "#b0c6ff", "background": "#f8f9fa",
                        "secondary-fixed": "#ffdcc6", "surface-container-highest": "#e1e3e4",
                        "on-secondary-fixed": "#311300", "primary-container": "#0d47a1",
                        "tertiary": "#003f0b", "inverse-primary": "#b0c6ff",
                        "on-primary-fixed-variant": "#00429c", "surface-dim": "#d9dadb",
                        "surface-tint": "#2b5bb5", "error": "#ba1a1a",
                        "tertiary-container": "#005914", "on-primary-container": "#a1bbff",
                        "surface-variant": "#e1e3e4", "on-surface": "#191c1d",
                        "surface-bright": "#f8f9fa", "secondary-fixed-dim": "#ffb786",
                        "outline": "#737783", "on-secondary-container": "#5e2c00",
                        "tertiary-fixed-dim": "#88d982", "secondary-container": "#fc820c",
                        "primary": "#003178", "surface-container-lowest": "#ffffff",
                        "inverse-on-surface": "#f0f1f2", "error-container": "#ffdad6",
                        "on-background": "#191c1d", "surface-container": "#edeeef",
                        "tertiary-fixed": "#a3f69c", "surface-container-low": "#f3f4f5",
                        "on-primary-fixed": "#001945", "on-tertiary-fixed": "#002204",
                        "on-tertiary-fixed-variant": "#005312", "surface": "#f8f9fa",
                        "on-secondary-fixed-variant": "#723600", "on-tertiary-container": "#7ecf79",
                        "secondary": "#964900", "outline-variant": "#c3c6d4",
                        "surface-container-high": "#e7e8e9", "on-error-container": "#93000a",
                        "primary-fixed": "#d9e2ff", "on-surface-variant": "#434652",
                        "on-tertiary": "#ffffff"
                    },
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                    spacing: { "base": "8px", "sidebar-width": "280px", "margin-mobile": "16px", "container-max": "1280px", "gutter": "24px" },
                    fontFamily: { "headline-lg-mobile": ["Inter"], "body-sm": ["Inter"], "headline-lg": ["Inter"], "body-lg": ["Inter"], "label-caps": ["Inter"], "headline-md": ["Inter"], "price-display": ["Inter"] },
                    fontSize: {
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700"}],
                        "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "price-display": ["24px", {"lineHeight": "24px", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #e0e0e0; border-radius: 10px; }
        .btn-soon { position: relative; overflow: hidden; cursor: not-allowed; opacity: 0.75; }
        .btn-soon::after { content: '✨ Próximamente'; position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, rgba(0,49,120,0.92), rgba(150,73,0,0.92)); color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 0.06em; opacity: 0; transition: opacity 0.2s ease; }
        .btn-soon:hover::after { opacity: 1; }
    </style>
</head>
<body class="text-on-background">

    @include('partials.client-navbar')

    <div class="max-w-container-max mx-auto flex">
        @include('partials.client-sidebar', ['activeClientTab' => 'favoritos'])

        <main class="flex-1 min-w-0 p-4 md:p-gutter">

            {{-- Breadcrumb / Back button --}}
            <div class="flex items-center gap-2 mb-6">
                <a href="{{ route('favorites.index') }}"
                   class="flex items-center gap-1 text-on-surface-variant hover:text-primary transition-colors text-body-sm">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Mis Favoritos
                </a>
                <span class="material-symbols-outlined text-outline text-[16px]">chevron_right</span>
                <span class="text-body-sm text-on-surface font-semibold truncate">{{ $collection->name }}</span>
            </div>

            {{-- Header --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-headline-lg font-headline-lg text-on-surface">{{ $collection->name }}</h1>
                    <p class="text-body-sm text-outline mt-1">
                        {{ $products->count() }} {{ $products->count() === 1 ? 'producto guardado' : 'productos guardados' }}
                    </p>
                </div>
                {{-- Add more products --}}
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2 px-5 py-2.5 border border-outline-variant rounded-xl text-body-sm font-bold text-on-surface hover:bg-surface-container transition-all self-start sm:self-auto">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Agregar más productos
                </a>
            </div>

            {{-- Products grid --}}
            @if($products->isEmpty())
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <span class="material-symbols-outlined text-outline mb-4" style="font-size:64px">image_not_supported</span>
                    <h2 class="text-headline-md text-on-surface mb-2">Colección vacía</h2>
                    <p class="text-body-sm text-outline mb-6">
                        Esta colección no tiene productos aún.<br>
                        Explora el catálogo y guarda los que te interesen.
                    </p>
                    <a href="{{ route('home') }}"
                       class="px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:brightness-110 transition-all">
                        Ver catálogo
                    </a>
                </div>
            @else
                <div id="collection-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter">
                    @foreach($products as $product)
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden hover:shadow-md transition-all flex flex-col"
                         data-product-id="{{ $product->id }}">

                        {{-- Image --}}
                        <div class="aspect-square bg-surface-container-low relative overflow-hidden">
                            @if($product->imgSrc)
                                <img alt="{{ $product->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     src="{{ $product->imgSrc }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-surface-container-high">
                                    <span class="material-symbols-outlined text-outline" style="font-size:40px">image</span>
                                </div>
                            @endif

                            {{-- Remove from this collection --}}
                            <button onclick="removeFromCollection({{ $collection->id }}, {{ $product->id }}, this)"
                                    title="Quitar de esta colección"
                                    class="absolute top-2 right-2 w-9 h-9 bg-surface-container-lowest/85 backdrop-blur rounded-full flex items-center justify-center text-error hover:scale-110 transition-all shadow-sm">
                                <span class="material-symbols-outlined text-[20px]" style="font-variation-settings:'FILL' 1">favorite</span>
                            </button>
                        </div>

                        {{-- Info --}}
                        <div class="p-4 flex flex-col flex-grow">
                            <p class="text-label-caps text-secondary mb-1 truncate">{{ $product->category }}</p>
                            <h4 class="text-body-lg font-semibold text-on-surface line-clamp-2 flex-1">{{ $product->title }}</h4>
                            @if($product->location)
                                <p class="text-[11px] text-outline mt-1 truncate">
                                    <span class="material-symbols-outlined text-[12px] align-middle">location_on</span>
                                    {{ $product->location }}
                                </p>
                            @endif
                            <div class="mt-auto pt-3">
                                <p class="text-price-display font-price-display text-primary mb-3">
                                    S/ {{ number_format($product->price, 2) }}
                                </p>
                                <a href="{{ route('products.show', $product) }}"
                                   class="w-full py-2 rounded-lg font-bold flex items-center justify-center gap-2 bg-secondary-container text-on-secondary hover:brightness-110 transition-all">
                                    <span class="material-symbols-outlined text-[20px]">handshake</span>
                                    Trato Directo
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

        </main>
    </div>

    @include('partials.footer')

    <script>
    const CSRF_TOKEN  = '{{ csrf_token() }}';

    function removeFromCollection(collectionId, productId, btn) {
        const card = btn.closest('[data-product-id]');
        btn.disabled = true;

        const url = `/favoritos/colecciones/${collectionId}/productos/${productId}`;

        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'removed') {
                card.style.transition = 'opacity 0.3s, transform 0.3s';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    card.remove();
                    // Update counter
                    const remaining = document.querySelectorAll('[data-product-id]').length;
                    const counter = document.querySelector('p.text-body-sm.text-outline.mt-1');
                    if (counter) counter.textContent = remaining + (remaining === 1 ? ' producto guardado' : ' productos guardados');

                    // Show empty state if no products left
                    if (remaining === 0) location.reload();
                }, 320);
            }
        })
        .catch(() => { btn.disabled = false; });
    }
    </script>

</body>
</html>
