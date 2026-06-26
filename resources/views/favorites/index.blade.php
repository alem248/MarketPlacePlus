<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mis Favoritos | MarketPlace Plus</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/icon.png') }}">

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

        {{-- ═══════════════ MAIN CONTENT ═══════════════ --}}
        <main class="flex-1 min-w-0 p-4 md:p-gutter">

            {{-- Header --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h1 class="text-headline-lg font-headline-lg text-on-surface">Mis Favoritos</h1>
                <button id="open-create-collection-btn"
                        class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-bold flex items-center gap-2 hover:brightness-110 active:scale-95 transition-all shadow-sm self-start sm:self-auto">
                    <span class="material-symbols-outlined text-[20px]">add_circle</span>
                    Crear nueva colección
                </button>
            </div>

            {{-- Tabs --}}
            <div class="flex border-b border-outline-variant mb-8 gap-2">
                <button id="tab-btn-collections"
                        onclick="showTab('collections')"
                        class="px-6 py-3 font-bold text-on-surface border-b-2 border-secondary transition-colors">
                    Mis Colecciones
                </button>
                <button id="tab-btn-all"
                        onclick="showTab('all')"
                        class="px-6 py-3 font-bold text-on-surface-variant hover:text-on-surface border-b-2 border-transparent transition-colors">
                    Todos
                </button>
            </div>

            {{-- ── TAB: Mis Colecciones ── --}}
            <div id="panel-collections">
                @if($collections->isEmpty())
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <span class="material-symbols-outlined text-outline mb-4" style="font-size:64px">collections_bookmark</span>
                        <h2 class="text-headline-md text-on-surface mb-2">Sin colecciones aún</h2>
                        <p class="text-body-sm text-outline mb-6">Crea tu primera colección para organizar tus productos favoritos.</p>
                        <button onclick="document.getElementById('open-create-collection-btn').click()"
                                class="px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:brightness-110 transition-all">
                            Crear colección
                        </button>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                        @foreach($collections as $col)
                        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden group hover:shadow-md transition-all relative"
                             data-collection-id="{{ $col->id }}">

                            {{-- Botón eliminar (encima del enlace, usa stopPropagation) --}}
                            <button onclick="event.preventDefault(); event.stopPropagation(); deleteCollection({{ $col->id }}, this)"
                                    title="Eliminar colección"
                                    class="absolute top-2 right-2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-surface-container-lowest/80 backdrop-blur text-outline hover:text-error hover:bg-error-container/20 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>

                            {{-- Toda la tarjeta es un enlace a la vista de detalle --}}
                            <a href="{{ route('favorites.collections.show', $col) }}" class="block">
                                {{-- Thumbnail grid --}}
                                <div class="grid grid-cols-2 grid-rows-2 h-48 bg-surface-container-low gap-px">
                                    @foreach($col->sample->take(3) as $imgSrc)
                                        <div class="bg-cover bg-center overflow-hidden"
                                             style="background-image: url('{{ $imgSrc }}')">
                                        </div>
                                    @endforeach
                                    @if($col->sample->count() < 3)
                                        @for($i = $col->sample->count(); $i < 3; $i++)
                                            <div class="bg-surface-container-high flex items-center justify-center">
                                                <span class="material-symbols-outlined text-outline" style="font-size:32px">image</span>
                                            </div>
                                        @endfor
                                    @endif
                                    <div class="flex items-center justify-center bg-surface-container-high text-on-surface-variant font-bold text-headline-md">
                                        @if($col->favorites_count > 3)
                                            +{{ $col->favorites_count - 3 }}
                                        @elseif($col->favorites_count === 0)
                                            <span class="material-symbols-outlined text-outline" style="font-size:32px">add_photo_alternate</span>
                                        @else
                                            &nbsp;
                                        @endif
                                    </div>
                                </div>

                                {{-- Card footer --}}
                                <div class="p-4 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-headline-md font-headline-md text-on-surface">{{ $col->name }}</h3>
                                        <p class="text-body-sm text-on-surface-variant">
                                            {{ $col->favorites_count }} {{ $col->favorites_count === 1 ? 'producto guardado' : 'productos guardados' }}
                                        </p>
                                    </div>
                                    <span class="material-symbols-outlined text-on-surface-variant group-hover:translate-x-1 transition-transform">chevron_right</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ── TAB: Todos los favoritos ── --}}
            <div id="panel-all" class="hidden">
                @if($favoriteProducts->isEmpty())
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <span class="material-symbols-outlined text-outline mb-4" style="font-size:64px">favorite_border</span>
                        <h2 class="text-headline-md text-on-surface mb-2">Sin productos favoritos</h2>
                        <p class="text-body-sm text-outline mb-6">Explora el catálogo y guarda los productos que te interesen.</p>
                        <a href="{{ route('home') }}"
                           class="px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:brightness-110 transition-all">
                            Ver catálogo
                        </a>
                    </div>
                @else
                    <div id="favorites-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter">
                        @foreach($favoriteProducts as $product)
                        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden hover:shadow-md transition-all flex flex-col"
                             data-product-id="{{ $product->id }}">
                            <div class="aspect-square bg-surface-container-low relative overflow-hidden">
                                @if($product->imgSrc)
                                    <img alt="{{ $product->title }}"
                                         class="w-full h-full object-cover"
                                         src="{{ $product->imgSrc }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-surface-container-high">
                                        <span class="material-symbols-outlined text-outline" style="font-size:40px">image</span>
                                    </div>
                                @endif
                                {{-- Remove from favorites button --}}
                                <button onclick="removeFavorite({{ $product->id }}, this)"
                                        title="Quitar de favoritos"
                                        class="absolute top-2 right-2 w-9 h-9 bg-surface-container-lowest/85 backdrop-blur rounded-full flex items-center justify-center text-error hover:scale-110 transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-[20px]" style="font-variation-settings:'FILL' 1">favorite</span>
                                </button>
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <p class="text-label-caps text-secondary mb-1 truncate">{{ $product->category }}</p>
                                <h4 class="text-body-lg font-semibold text-on-surface line-clamp-2 flex-1">{{ $product->title }}</h4>
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
            </div>

        </main>
    </div>

    @include('partials.footer')

    {{-- Modal para crear colección (desde el botón superior) --}}
    <div id="create-col-modal-backdrop"
         class="hidden fixed inset-0 bg-on-background/50 backdrop-blur-sm z-[60] flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-outline-variant w-full max-w-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-headline-md font-headline-md text-on-surface">Nueva colección</h2>
                <button onclick="document.getElementById('create-col-modal-backdrop').classList.add('hidden')"
                        class="text-outline hover:text-on-surface transition-colors p-1 rounded-full hover:bg-surface-container">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            <input id="create-col-name" type="text" placeholder="Nombre de la colección..." maxlength="100"
                   class="w-full border border-outline-variant rounded-xl px-4 py-3 text-body-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all mb-4">
            <p id="create-col-status" class="text-body-sm text-outline mb-4 hidden"></p>
            <div class="flex gap-3">
                <button onclick="document.getElementById('create-col-modal-backdrop').classList.add('hidden')"
                        class="flex-1 py-3 border border-outline-variant rounded-xl font-bold text-on-surface-variant hover:bg-surface-container transition-all">
                    Cancelar
                </button>
                <button onclick="createCollectionFromModal()"
                        class="flex-1 py-3 bg-primary text-on-primary rounded-xl font-bold hover:brightness-110 active:scale-95 transition-all">
                    Crear
                </button>
            </div>
        </div>
    </div>

    <script>
    const CSRF_TOKEN  = '{{ csrf_token() }}';
    const REMOVE_URL  = '{{ route("favorites.destroy") }}';
    const NEWCOL_URL2 = '{{ route("favorites.collections.store") }}';
    const DEL_COL_URL = (id) => `/favoritos/colecciones/${id}`;

    // ── Tabs ──────────────────────────────────────────────────────────────────

    function showTab(tab) {
        const panels = { collections: document.getElementById('panel-collections'), all: document.getElementById('panel-all') };
        const btns   = { collections: document.getElementById('tab-btn-collections'), all: document.getElementById('tab-btn-all') };

        Object.entries(panels).forEach(([key, el]) => {
            el.classList.toggle('hidden', key !== tab);
        });
        Object.entries(btns).forEach(([key, btn]) => {
            btn.classList.toggle('text-on-surface', key === tab);
            btn.classList.toggle('border-secondary', key === tab);
            btn.classList.toggle('text-on-surface-variant', key !== tab);
            btn.classList.toggle('border-transparent', key !== tab);
        });
    }

    // ── Remove from favorites ─────────────────────────────────────────────────

    function removeFavorite(productId, btn) {
        const card = btn.closest('[data-product-id]');
        btn.disabled = true;

        fetch(REMOVE_URL, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ product_id: productId }),
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'removed') {
                card.style.transition = 'opacity 0.3s, transform 0.3s';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                setTimeout(() => card.remove(), 320);
            }
        })
        .catch(() => { btn.disabled = false; });
    }

    // ── Delete collection ─────────────────────────────────────────────────────

    function deleteCollection(collectionId, btn) {
        if (!confirm('¿Eliminar esta colección? Se quitarán todos sus favoritos.')) return;

        const card = btn.closest('[data-collection-id]');
        btn.disabled = true;

        fetch(DEL_COL_URL(collectionId), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'deleted') {
                card.style.transition = 'opacity 0.3s, transform 0.3s';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                setTimeout(() => card.remove(), 320);
            }
        })
        .catch(() => { btn.disabled = false; });
    }

    // ── Create collection from top button ─────────────────────────────────────

    document.getElementById('open-create-collection-btn').addEventListener('click', function () {
        document.getElementById('create-col-name').value = '';
        document.getElementById('create-col-status').classList.add('hidden');
        document.getElementById('create-col-modal-backdrop').classList.remove('hidden');
        setTimeout(() => document.getElementById('create-col-name').focus(), 50);
    });

    document.getElementById('create-col-name').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') createCollectionFromModal();
    });

    document.getElementById('create-col-modal-backdrop').addEventListener('click', function (e) {
        if (e.target === this) this.classList.add('hidden');
    });

    function createCollectionFromModal() {
        const name   = document.getElementById('create-col-name').value.trim();
        const status = document.getElementById('create-col-status');
        if (!name) { document.getElementById('create-col-name').focus(); return; }

        status.classList.remove('hidden');
        status.textContent = 'Creando...';

        fetch(NEWCOL_URL2, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
            body: JSON.stringify({ name }),
        })
        .then(r => r.json())
        .then(col => {
            document.getElementById('create-col-modal-backdrop').classList.add('hidden');
            // Reload page to show new collection
            window.location.reload();
        })
        .catch(() => { status.textContent = 'Error al crear. Intenta de nuevo.'; });
    }
    </script>

</body>
</html>
