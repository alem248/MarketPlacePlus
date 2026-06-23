{{-- Navbar unificado para vistas de cliente --}}
<style>
    .srch-scroll::-webkit-scrollbar { width: 6px; }
    .srch-scroll::-webkit-scrollbar-track { background: transparent; }
    .srch-scroll::-webkit-scrollbar-thumb { background: #c3c6d4; border-radius: 10px; }
    .srch-scroll::-webkit-scrollbar-thumb:hover { background: #737783; }

    #search-overlay { display: none; }
    #search-overlay.open { display: flex; }

    #search-empty { display: none; }
    #search-empty.visible { display: flex; }
</style>

<header class="bg-surface-container-lowest border-b border-outline-variant sticky top-0 z-50">
    <div class="flex justify-between items-center w-full px-margin-mobile md:px-gutter py-2 max-w-container-max mx-auto h-16">
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="text-headline-md font-headline-md font-bold text-primary cursor-pointer shrink-0">MarketPlace Plus</a>
            <div id="search-bar-wrap" class="hidden md:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant w-96 transition-all focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20">
                <span class="material-symbols-outlined text-outline mr-2 text-[20px]">search</span>
                <input
                    id="global-search-input"
                    class="bg-transparent border-none focus:ring-0 text-body-sm w-full"
                    placeholder="¿Qué vas a comprar hoy?"
                    type="text"
                    autocomplete="off">
                <button id="search-clear-btn" class="hidden ml-1 text-outline hover:text-on-surface transition-colors" title="Limpiar búsqueda">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        </div>
        <nav class="flex items-center gap-6">
            <div class="hidden md:flex gap-4">
                <a href="{{ route('home') }}" class="text-on-surface-variant hover:text-secondary transition-colors flex items-center gap-1 active:scale-95 duration-150 p-2 rounded-full hover:bg-surface-container-low">
                    <span class="material-symbols-outlined text-[20px]">home</span>
                </a>
                <a href="{{ route('favorites.index') }}"
                   class="transition-colors flex items-center gap-1 active:scale-95 duration-150 p-2 rounded-full hover:bg-surface-container-low {{ request()->routeIs('favorites.*') ? 'text-error' : 'text-on-surface-variant hover:text-secondary' }}">
                    <span class="material-symbols-outlined text-[20px]"
                          style="{{ request()->routeIs('favorites.*') ? 'font-variation-settings:\'FILL\' 1' : '' }}">favorite</span>
                </a>
                <a href="{{ route('tratos.index') }}" class="text-on-surface-variant hover:text-secondary transition-colors flex items-center gap-1 active:scale-95 duration-150 p-2 rounded-full hover:bg-surface-container-low">
                    <span class="material-symbols-outlined text-[20px]">handshake</span>
                </a>
            </div>
            <div class="flex items-center gap-3 border-l pl-6 border-outline-variant">
                @auth
                    @if(!empty(auth()->user()->foto))
                        <img alt="Foto de perfil" class="w-8 h-8 rounded-full object-cover border border-primary"
                             src="{{ asset('storage/' . auth()->user()->foto) }}">
                    @else
                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary text-sm font-bold border border-primary">
                            {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                        </div>
                    @endif
                    <span class="hidden md:block text-label-caps font-label-caps text-primary">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </span>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 font-semibold text-primary hover:underline text-body-sm">
                        <span class="material-symbols-outlined text-base">account_circle</span>
                        Invitado (Para ver esta zona, inicia sesión)
                    </a>
                @endauth
            </div>
        </nav>
    </div>
</header>

{{-- ═══════════════════════ SEARCH OVERLAY ═══════════════════════ --}}
<div id="search-overlay" class="fixed inset-0 bg-on-background/30 backdrop-blur-sm z-40 justify-center" style="top:64px;">
    <div class="w-full max-w-container-max mx-auto px-4 md:px-gutter mt-2 flex gap-gutter" style="height:calc(100vh - 80px);">

        {{-- ── Filter Sidebar ── --}}
        <aside id="search-sidebar" class="hidden md:flex flex-col bg-surface-container-lowest rounded-xl border border-outline-variant shadow-lg p-6 srch-scroll overflow-y-auto shrink-0" style="width:280px; max-height:100%;">

            <div class="flex items-center justify-between mb-5">
                <h2 class="text-headline-md font-headline-md text-on-surface">Filtros</h2>
                <button id="reset-filters" class="text-body-sm text-outline hover:text-primary transition-colors">Limpiar</button>
            </div>

            {{-- Categories --}}
            <div class="mb-6">
                <p class="text-label-caps font-label-caps text-outline mb-3">CATEGORÍAS</p>
                <div class="mb-3 relative">
                    <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-outline" style="font-size:16px">search</span>
                    <input id="filter-cat-search" type="text" placeholder="Buscar categoría..."
                           class="w-full pl-8 pr-3 py-1.5 bg-surface-container-low border border-outline-variant rounded-lg text-body-sm focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                </div>
                <div id="filter-categories" class="flex flex-wrap gap-2 min-h-[28px]">
                    <span class="text-body-sm text-outline italic">Cargando...</span>
                </div>
            </div>

            {{-- Locations --}}
            <div class="mb-6">
                <p class="text-label-caps font-label-caps text-outline mb-3">UBICACIÓN</p>
                <div class="mb-3 relative">
                    <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-outline" style="font-size:16px">location_on</span>
                    <input id="filter-loc-search" type="text" placeholder="Buscar ubicación..."
                           class="w-full pl-8 pr-3 py-1.5 bg-surface-container-low border border-outline-variant rounded-lg text-body-sm focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                </div>
                <div id="filter-locations" class="flex flex-wrap gap-2 min-h-[28px]">
                    <span class="text-body-sm text-outline italic">Cargando...</span>
                </div>
            </div>

            {{-- Condition --}}
            <div class="mb-6">
                <p class="text-label-caps font-label-caps text-outline mb-3">CONDICIÓN</p>
                <div class="flex flex-col gap-2.5">
                    @foreach(['Nuevo','Como nuevo','Usado - Como nuevo','Usado'] as $cond)
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" value="{{ $cond }}" class="condition-check rounded border-outline-variant text-primary focus:ring-primary h-4 w-4">
                        <span class="text-body-sm text-on-surface">{{ $cond }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Price Range --}}
            <div>
                <p class="text-label-caps font-label-caps text-outline mb-3">RANGO DE PRECIO (Soles)</p>
                <div class="flex items-center gap-2 mb-3">
                    <input id="filter-price-min" type="number" placeholder="Min" min="0"
                           class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-3 py-2 text-body-sm focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                    <span class="text-outline shrink-0">—</span>
                    <input id="filter-price-max" type="number" placeholder="Max" min="0"
                           class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-3 py-2 text-body-sm focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                </div>
                <input id="filter-price-slider" type="range" min="0" max="10000" value="10000" class="w-full accent-primary">
                <div class="flex justify-between text-[11px] text-outline mt-1">
                    <span>S/ 0</span><span>S/ 10,000</span>
                </div>
            </div>
        </aside>

        {{-- ── Results Panel ── --}}
        <div class="flex-1 min-w-0 bg-surface-container-lowest rounded-xl border border-outline-variant shadow-2xl flex flex-col overflow-hidden mb-6">

            {{-- Panel Header --}}
            <div class="px-6 py-4 border-b border-outline-variant bg-surface-container-low flex justify-between items-center shrink-0">
                <p class="text-body-sm text-outline">
                    Resultados para <span id="search-query-label" class="font-bold text-on-surface">""</span>
                    <span id="search-result-count" class="ml-2 text-outline font-normal"></span>
                </p>
                <button id="overlay-close-btn" class="text-outline hover:text-on-surface transition-colors p-1 rounded-full hover:bg-surface-container">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            {{-- Scrollable content --}}
            <div class="flex-1 overflow-y-auto srch-scroll p-6">

                {{-- Loading --}}
                <div id="search-loading" class="hidden items-center justify-center py-16">
                    <div class="animate-spin rounded-full h-8 w-8 border-2 border-primary border-t-transparent"></div>
                </div>

                {{-- Empty state --}}
                <div id="search-empty" class="flex-col items-center justify-center py-16 text-center">
                    <span class="material-symbols-outlined text-outline mb-4" style="font-size:52px; font-variation-settings:'FILL' 0">search_off</span>
                    <p class="text-headline-md text-on-surface mb-2">Sin resultados</p>
                    <p class="text-body-sm text-outline">No encontramos productos con esas características.<br>Intenta con otras palabras o filtros distintos.</p>
                </div>

                {{-- Products grid --}}
                <div id="search-products-grid" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"></div>
            </div>

            {{-- Panel Footer --}}
            <div class="px-6 py-4 bg-surface-container-high border-t border-outline-variant flex justify-between items-center shrink-0">
                <a id="search-see-all-btn" href="{{ route('home') }}"
                   class="flex items-center gap-2 px-6 py-2.5 bg-primary text-on-primary rounded-xl font-bold hover:scale-[1.02] active:scale-95 transition-all shadow-md text-body-sm">
                    Ver todos los resultados
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
                <p class="text-body-sm text-outline italic hidden md:block">Presiona 'Esc' para cerrar</p>
            </div>
        </div>

    </div>
</div>
{{-- ═══════════════════════════════════════════════════════════════ --}}

@include('partials.favorite-modal')

<script>
(function () {
    'use strict';

    const SEARCH_URL = '{{ route("products.search") }}';
    const HOME_URL   = '{{ route("home") }}';

    // DOM refs
    const overlay      = document.getElementById('search-overlay');
    const searchInput  = document.getElementById('global-search-input');
    const clearBtn     = document.getElementById('search-clear-btn');
    const queryLabel   = document.getElementById('search-query-label');
    const resultCount  = document.getElementById('search-result-count');
    const grid         = document.getElementById('search-products-grid');
    const loadingEl    = document.getElementById('search-loading');
    const emptyEl      = document.getElementById('search-empty');
    const seeAllBtn    = document.getElementById('search-see-all-btn');
    const resetBtn     = document.getElementById('reset-filters');
    const closeBtn     = document.getElementById('overlay-close-btn');
    const catContainer = document.getElementById('filter-categories');
    const locContainer = document.getElementById('filter-locations');
    const catSearch    = document.getElementById('filter-cat-search');
    const locSearch    = document.getElementById('filter-loc-search');
    const priceMinEl   = document.getElementById('filter-price-min');
    const priceMaxEl   = document.getElementById('filter-price-max');
    const priceSlider  = document.getElementById('filter-price-slider');

    // State
    const state = { q: '', category: null, location: null, conditions: [], priceMin: '', priceMax: '' };
    let allCategories = [];
    let allLocations  = [];
    let debounceTimer = null;
    let isOpen        = false;
    let filtersReady  = false;

    // ── Open / Close ─────────────────────────────────────────────────────────

    function open() {
        if (isOpen) return;
        isOpen = true;
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
        if (!filtersReady) fetchResults();
    }

    function close() {
        if (!isOpen) return;
        isOpen = false;
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    // ── Fetch ─────────────────────────────────────────────────────────────────

    function buildParams() {
        const p = new URLSearchParams();
        if (state.q)          p.append('q', state.q);
        if (state.category)   p.append('category', state.category);
        if (state.location)   p.append('location', state.location);
        state.conditions.forEach(c => p.append('conditions[]', c));
        if (state.priceMin)   p.append('price_min', state.priceMin);
        if (state.priceMax)   p.append('price_max', state.priceMax);
        return p;
    }

    function fetchResults() {
        const params = buildParams();

        // Update "Ver todos" link
        const homeParams = new URLSearchParams();
        if (state.q)        homeParams.append('q', state.q);
        if (state.category) homeParams.append('category', state.category);
        if (state.location) homeParams.append('location', state.location);
        seeAllBtn.href = HOME_URL + (homeParams.toString() ? '?' + homeParams : '');

        // Update label
        queryLabel.textContent = '"' + (state.q || '...') + '"';

        // Show loading, hide others
        loadingEl.style.display    = 'flex';
        emptyEl.classList.remove('visible');
        grid.classList.add('hidden');

        fetch(SEARCH_URL + '?' + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            loadingEl.style.display = 'none';

            // Populate filter chips only once (or if empty)
            if (!filtersReady && data.filters.categories.length > 0) {
                allCategories = data.filters.categories;
                allLocations  = data.filters.locations;
                filtersReady  = true;
                renderCategories();
                renderLocations();
            }

            resultCount.textContent = '(' + data.total + (data.total === 1 ? ' producto' : ' productos') + ')';

            if (data.products.length === 0) {
                emptyEl.classList.add('visible');
            } else {
                grid.classList.remove('hidden');
                renderProducts(data.products);
            }
        })
        .catch(() => {
            loadingEl.style.display = 'none';
        });
    }

    function scheduleSearch() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fetchResults, 320);
    }

    // ── Render ────────────────────────────────────────────────────────────────

    function renderCategories() {
        const q = catSearch.value.toLowerCase();
        const list = q ? allCategories.filter(c => c.toLowerCase().includes(q)) : allCategories;

        if (list.length === 0) {
            catContainer.innerHTML = '<span class="text-body-sm text-outline italic">Sin categorías</span>';
            return;
        }

        catContainer.innerHTML = list.map(cat => {
            const active = state.category === cat;
            return `<button data-cat="${esc(cat)}"
                class="px-3 py-1 rounded-full text-body-sm font-semibold border transition-all ${active
                    ? 'bg-primary-container text-on-primary-container border-primary-container'
                    : 'bg-surface-container text-on-surface-variant border-transparent hover:border-outline-variant'}">${esc(cat)}</button>`;
        }).join('');
    }

    function renderLocations() {
        const q = locSearch.value.toLowerCase();
        const list = q ? allLocations.filter(l => l.toLowerCase().includes(q)) : allLocations;

        if (list.length === 0) {
            locContainer.innerHTML = '<span class="text-body-sm text-outline italic">Sin ubicaciones</span>';
            return;
        }

        locContainer.innerHTML = list.map(loc => {
            const active = state.location === loc;
            return `<button data-loc="${esc(loc)}"
                class="px-2 py-1 rounded-lg text-body-sm border transition-all ${active
                    ? 'bg-primary text-on-primary border-primary'
                    : 'bg-surface-container text-on-surface border-transparent hover:bg-surface-container-high'}">${esc(loc)}</button>`;
        }).join('');
    }

    function renderProducts(products) {
        grid.innerHTML = products.map(p => {
            const img = p.image
                ? `<img alt="${esc(p.title)}" src="${esc(p.image)}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">`
                : `<div class="w-full h-full flex items-center justify-center"><span class="material-symbols-outlined text-outline" style="font-size:40px">image</span></div>`;
            return `
                <a href="${esc(p.url)}" class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden group hover:shadow-lg transition-all flex flex-col">
                    <div class="aspect-square bg-surface-container-high overflow-hidden">${img}</div>
                    <div class="p-3 flex-1 flex flex-col">
                        <p class="text-label-caps text-secondary mb-1 truncate">${esc(p.category || '')}</p>
                        <h3 class="text-body-sm font-bold text-on-surface line-clamp-2 flex-1">${esc(p.title)}</h3>
                        ${p.location ? `<p class="text-[11px] text-outline mt-1 truncate"><span class="material-symbols-outlined text-[12px] align-middle">location_on</span> ${esc(p.location)}</p>` : ''}
                        <p class="text-headline-md text-primary mt-2 font-bold">S/ ${esc(p.price)}</p>
                    </div>
                </a>`;
        }).join('');
    }

    function esc(str) {
        if (str == null) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    // ── Delegated clicks on filter chips ─────────────────────────────────────

    catContainer.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-cat]');
        if (!btn) return;
        state.category = (state.category === btn.dataset.cat) ? null : btn.dataset.cat;
        renderCategories();
        scheduleSearch();
    });

    locContainer.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-loc]');
        if (!btn) return;
        state.location = (state.location === btn.dataset.loc) ? null : btn.dataset.loc;
        renderLocations();
        scheduleSearch();
    });

    // ── Condition checkboxes ──────────────────────────────────────────────────

    document.querySelectorAll('.condition-check').forEach(cb => {
        cb.addEventListener('change', function () {
            if (this.checked) {
                if (!state.conditions.includes(this.value)) state.conditions.push(this.value);
            } else {
                state.conditions = state.conditions.filter(c => c !== this.value);
            }
            scheduleSearch();
        });
    });

    // ── Price range ───────────────────────────────────────────────────────────

    priceMinEl.addEventListener('input', function () {
        state.priceMin = this.value;
        scheduleSearch();
    });

    priceMaxEl.addEventListener('input', function () {
        state.priceMax = this.value;
        if (this.value) priceSlider.value = this.value;
        scheduleSearch();
    });

    priceSlider.addEventListener('input', function () {
        state.priceMax   = this.value;
        priceMaxEl.value = this.value;
        scheduleSearch();
    });

    // ── Category / Location text search (client-side filter of chips) ─────────

    catSearch.addEventListener('input', renderCategories);
    locSearch.addEventListener('input', renderLocations);

    // ── Reset filters ─────────────────────────────────────────────────────────

    resetBtn.addEventListener('click', function () {
        state.category = null;
        state.location = null;
        state.conditions = [];
        state.priceMin   = '';
        state.priceMax   = '';
        priceMinEl.value = '';
        priceMaxEl.value = '';
        priceSlider.value = 10000;
        catSearch.value  = '';
        locSearch.value  = '';
        document.querySelectorAll('.condition-check').forEach(cb => cb.checked = false);
        renderCategories();
        renderLocations();
        fetchResults();
    });

    // ── Search input events ───────────────────────────────────────────────────

    searchInput.addEventListener('focus', open);

    searchInput.addEventListener('input', function () {
        state.q = this.value;
        clearBtn.classList.toggle('hidden', !this.value);
        if (!isOpen) open();
        else scheduleSearch();
    });

    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        state.q = '';
        clearBtn.classList.add('hidden');
        searchInput.focus();
        scheduleSearch();
    });

    // ── Close triggers ────────────────────────────────────────────────────────

    closeBtn.addEventListener('click', close);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') close();
    });

    // Close on click outside overlay and search bar
    document.addEventListener('mousedown', function (e) {
        if (!isOpen) return;
        const wrap = document.getElementById('search-bar-wrap');
        if (!overlay.contains(e.target) && !wrap.contains(e.target)) {
            close();
        }
    });

}());
</script>
