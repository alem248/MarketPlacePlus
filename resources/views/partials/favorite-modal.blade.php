{{-- Modal global para agregar producto a una colección de favoritos --}}
{{-- Incluir en client-navbar.blade.php y en layouts/app.blade.php --}}
{{-- JS expone: window.openFavoriteModal(productId, productTitle, onSuccess?) --}}

@auth
<div id="fav-modal-backdrop"
     class="hidden fixed inset-0 bg-on-background/50 backdrop-blur-sm z-[60] flex items-center justify-center p-4">

    <div id="fav-modal-dialog"
         class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-outline-variant w-full max-w-sm flex flex-col overflow-hidden"
         style="max-height:85vh;">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-outline-variant bg-surface-container-low shrink-0">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-error" style="font-variation-settings:'FILL' 1">favorite</span>
                <span class="text-headline-md font-headline-md text-on-surface">Guardar en favoritos</span>
            </div>
            <button onclick="window.closeFavoriteModal()"
                    class="text-outline hover:text-on-surface transition-colors p-1 rounded-full hover:bg-surface-container">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        {{-- Product name --}}
        <p id="fav-modal-product-name" class="px-6 pt-4 pb-2 text-body-sm text-outline truncate shrink-0"></p>

        {{-- Collections list --}}
        <div class="flex-1 overflow-y-auto px-6 pb-3">
            <p class="text-label-caps font-label-caps text-outline mb-3">ELEGIR COLECCIÓN</p>

            {{-- Loading --}}
            <div id="fav-modal-loading" class="flex items-center justify-center py-8">
                <div class="animate-spin rounded-full h-6 w-6 border-2 border-primary border-t-transparent"></div>
            </div>

            {{-- Empty: no collections --}}
            <div id="fav-modal-empty" class="hidden text-center py-6">
                <span class="material-symbols-outlined text-outline mb-2" style="font-size:36px">collections_bookmark</span>
                <p class="text-body-sm text-outline">Aún no tienes colecciones.<br>Crea una abajo para empezar.</p>
            </div>

            {{-- Collections list --}}
            <div id="fav-modal-collections" class="hidden flex flex-col gap-2"></div>
        </div>

        {{-- Create new collection --}}
        <div class="px-6 py-4 border-t border-outline-variant bg-surface-container-low shrink-0">
            <p class="text-label-caps font-label-caps text-outline mb-3">NUEVA COLECCIÓN</p>
            <div class="flex gap-2">
                <input id="fav-new-col-input"
                       type="text"
                       placeholder="Nombre de la colección..."
                       maxlength="100"
                       class="flex-1 bg-surface-container-lowest border border-outline-variant rounded-xl px-4 py-2 text-body-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                <button id="fav-new-col-btn"
                        onclick="window.createAndSaveFavorite()"
                        class="px-4 py-2 bg-primary text-on-primary rounded-xl font-bold text-body-sm hover:scale-[1.02] active:scale-95 transition-all shrink-0">
                    Crear
                </button>
            </div>
            <p id="fav-modal-status" class="text-body-sm mt-2 hidden"></p>
        </div>

    </div>
</div>

<script>
if (typeof window.__favModalReady === 'undefined') {
    window.__favModalReady  = true;
    window.__favProductId   = null;
    window.__favOnSuccess   = null;

    const COLS_URL   = '{{ route("favorites.collections") }}';
    const STORE_URL  = '{{ route("favorites.store") }}';
    const NEWCOL_URL = '{{ route("favorites.collections.store") }}';
    const CSRF       = '{{ csrf_token() }}';

    const backdrop    = document.getElementById('fav-modal-backdrop');
    const productName = document.getElementById('fav-modal-product-name');
    const loadingEl   = document.getElementById('fav-modal-loading');
    const emptyEl     = document.getElementById('fav-modal-empty');
    const colsEl      = document.getElementById('fav-modal-collections');
    const newInput    = document.getElementById('fav-new-col-input');
    const statusEl    = document.getElementById('fav-modal-status');

    window.openFavoriteModal = function (productId, productTitle, onSuccess) {
        window.__favProductId = productId;
        window.__favOnSuccess = onSuccess || null;
        productName.textContent = productTitle || '';
        newInput.value = '';
        setStatus('');
        backdrop.classList.remove('hidden');
        loadCollections();
    };

    window.closeFavoriteModal = function () {
        backdrop.classList.add('hidden');
        window.__favProductId = null;
    };

    function loadCollections() {
        loadingEl.classList.remove('hidden');
        emptyEl.classList.add('hidden');
        colsEl.classList.add('hidden');

        fetch(COLS_URL, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(r => r.json())
            .then(cols => {
                loadingEl.classList.add('hidden');
                if (cols.length === 0) {
                    emptyEl.classList.remove('hidden');
                } else {
                    colsEl.classList.remove('hidden');
                    colsEl.style.display = 'flex';
                    colsEl.innerHTML = cols.map(c => `
                        <button onclick="window.saveToCollection(${c.id})"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border border-outline-variant hover:border-primary hover:bg-primary-fixed/20 transition-all text-left group">
                            <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">collections_bookmark</span>
                            <span class="text-body-sm text-on-surface font-semibold flex-1">${escFav(c.name)}</span>
                            <span class="material-symbols-outlined text-outline group-hover:text-primary text-[18px] transition-colors">add</span>
                        </button>`).join('');
                }
            })
            .catch(() => {
                loadingEl.classList.add('hidden');
                setStatus('Error al cargar colecciones.', 'error');
            });
    }

    window.saveToCollection = function (collectionId) {
        if (!window.__favProductId) return;
        setStatus('Guardando...', 'info');

        fetch(STORE_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ product_id: window.__favProductId, collection_id: collectionId }),
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'added') {
                setStatus('¡Guardado correctamente!', 'success');
                if (window.__favOnSuccess) window.__favOnSuccess();
                setTimeout(window.closeFavoriteModal, 900);
            }
        })
        .catch(() => setStatus('No se pudo guardar. Intenta de nuevo.', 'error'));
    };

    window.createAndSaveFavorite = function () {
        const name = newInput.value.trim();
        if (!name) { newInput.focus(); return; }
        if (!window.__favProductId) return;

        const btn = document.getElementById('fav-new-col-btn');
        btn.disabled = true;
        setStatus('Creando colección...', 'info');

        fetch(NEWCOL_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ name }),
        })
        .then(r => r.json())
        .then(col => {
            return fetch(STORE_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ product_id: window.__favProductId, collection_id: col.id }),
            });
        })
        .then(r => r.json())
        .then(() => {
            setStatus('¡Guardado en nueva colección!', 'success');
            if (window.__favOnSuccess) window.__favOnSuccess();
            setTimeout(window.closeFavoriteModal, 900);
        })
        .catch(() => setStatus('Error al crear colección.', 'error'))
        .finally(() => { btn.disabled = false; });
    };

    function setStatus(msg, type) {
        if (!msg) { statusEl.classList.add('hidden'); return; }
        statusEl.classList.remove('hidden', 'text-primary', 'text-error', 'text-outline');
        statusEl.classList.add(type === 'success' ? 'text-primary' : type === 'error' ? 'text-error' : 'text-outline');
        statusEl.textContent = msg;
    }

    function escFav(str) {
        const d = document.createElement('div');
        d.appendChild(document.createTextNode(str || ''));
        return d.innerHTML;
    }

    // Close on backdrop click
    backdrop.addEventListener('click', function (e) {
        if (e.target === backdrop) window.closeFavoriteModal();
    });

    // Close on Esc
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !backdrop.classList.contains('hidden')) {
            window.closeFavoriteModal();
        }
    });

    // Submit new collection on Enter
    newInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') window.createAndSaveFavorite();
    });
}
</script>
@endauth
