@extends('layouts.app')

@section('title', $product->title . ' - MarketPlace Plus')

@section('content')
@php
    $isFavorited     = auth()->check()
        ? App\Models\Favorite::where('user_id', auth()->id())->where('product_id', $product->id)->exists()
        : false;
    $favBtnClass     = $isFavorited
        ? 'bg-error/10 border-error text-error'
        : 'border-outline-variant text-on-surface-variant hover:border-error hover:text-error';
    $favIconStyle    = $isFavorited ? "font-variation-settings:'FILL' 1" : '';
    $favBtnLabel     = $isFavorited ? 'En favoritos' : 'Guardar en favoritos';
@endphp

<div class="bg-background text-on-surface font-body-lg min-h-screen">

    @include('partials.client-navbar')

    <div class="max-w-container-max mx-auto flex">

        @include('partials.client-sidebar', ['activeClientTab' => ''])

        {{-- ===================== CONTENIDO PRINCIPAL ===================== --}}
        <main class="flex-1 min-w-0 p-4 md:p-gutter">

            {{-- Botón volver al catálogo --}}
            <div class="mb-gutter flex items-center gap-base">
                <button onclick="history.back()"
                        class="flex items-center gap-2 text-primary hover:underline transition-all">
                    <span class="material-symbols-outlined">arrow_back</span>
                    <span class="font-bold">Volver al catálogo</span>
                </button>
            </div>

            {{-- ===== GRID: galería/descripción (izq) + acciones/chat (der) ===== --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">

                {{-- ============ COLUMNA IZQUIERDA: Galería + Descripción ============ --}}
                <div class="lg:col-span-7 flex flex-col gap-gutter">

                    {{-- Galería de imágenes --}}
                    <div class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm overflow-hidden">

                        {{-- Imagen principal --}}
                        <div class="aspect-video w-full mb-gutter rounded-lg overflow-hidden bg-surface-container">
                            @php
                                $images = $product->image_path ?? [];
                                $mainImage = $images[0] ?? null;
                            @endphp
                            @if($mainImage)
                                <img id="main-product-image"
                                     class="w-full h-full object-cover"
                                     src="{{ Str::startsWith($mainImage, 'http') ? $mainImage : Storage::url($mainImage) }}"
                                     alt="{{ $product->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-surface-container-high">
                                    <span class="material-symbols-outlined text-outline" style="font-size:64px">image</span>
                                </div>
                            @endif
                        </div>

                        {{-- Miniaturas --}}
                        <div class="grid grid-cols-4 gap-base">
                            @foreach($images as $index => $img)
                                @php $src = Str::startsWith($img, 'http') ? $img : Storage::url($img); @endphp
                                <button class="aspect-square {{ $index === 0 ? 'border-2 border-primary' : 'border border-outline-variant hover:border-primary' }} rounded-lg overflow-hidden transition-all"
                                        onclick="document.getElementById('main-product-image').src='{{ $src }}'">
                                    <img class="w-full h-full object-cover" src="{{ $src }}" alt="Imagen {{ $index + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Descripción del producto --}}
                    <div class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant">
                        <h2 class="text-headline-md font-headline-md text-primary mb-4">Descripción</h2>
                        <div class="space-y-4 text-on-surface-variant">
                            {!! nl2br(e($product->description)) !!}
                        </div>

                        <div class="mt-8 pt-6 border-t border-outline-variant space-y-6">

                            @if(!empty($product->tags))
                            <div>
                                <h3 class="text-body-sm font-bold text-outline mb-3 uppercase tracking-wider">Etiquetas</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($product->tags as $tag)
                                        <span class="px-4 py-1.5 bg-surface-container-high text-on-surface-variant rounded-full text-body-sm font-semibold hover:bg-primary-container hover:text-on-primary-container transition-colors cursor-pointer">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($product->location)
                            <div>
                                <h3 class="text-body-sm font-bold text-outline mb-3 uppercase tracking-wider">Ubicación</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(' - ', $product->location) as $place)
                                        <span class="px-4 py-1.5 bg-surface-container-high text-on-surface-variant rounded-full text-body-sm font-semibold hover:bg-primary-container hover:text-on-primary-container transition-colors cursor-pointer">
                                            {{ trim($place) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- ============ COLUMNA DERECHA: Info + Botones + Chat ============ --}}
                <div class="lg:col-span-5 flex flex-col gap-gutter">

                    {{-- Tarjeta principal de compra --}}
                    <div class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm">

                        {{-- Condición + estrellas --}}
                        <div class="flex justify-between items-start mb-base">
                            @if($product->condition)
                                <span class="px-3 py-1 bg-primary-container text-on-primary-container rounded-full text-label-caps font-label-caps uppercase">
                                    {{ $product->condition }}
                                </span>
                            @else
                                <span></span>
                            @endif
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-secondary" style="font-size:20px; font-variation-settings:'FILL' 1">star</span>
                                <span class="material-symbols-outlined text-secondary" style="font-size:20px; font-variation-settings:'FILL' 1">star</span>
                                <span class="material-symbols-outlined text-secondary" style="font-size:20px; font-variation-settings:'FILL' 1">star</span>
                                <span class="material-symbols-outlined text-secondary" style="font-size:20px; font-variation-settings:'FILL' 1">star</span>
                                <span class="material-symbols-outlined text-outline" style="font-size:20px;">star</span>
                            </div>
                        </div>

                        {{-- Título y precio --}}
                        <h1 class="text-headline-lg font-headline-lg text-on-surface mb-2">{{ $product->title }}</h1>
                        <p class="text-price-display font-price-display text-secondary mb-gutter">
                            S/ {{ number_format($product->price, 2) }}
                        </p>

                        {{-- Info del vendedor --}}
                        <div class="flex items-center gap-gutter p-4 bg-surface-container-low rounded-xl mb-gutter">
                            <div class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center flex-shrink-0">
                                @if(!empty($product->user->foto))
                                    <img src="{{ asset('storage/' . $product->user->foto) }}"
                                         alt="{{ $product->user->first_name }}"
                                         class="w-full h-full rounded-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-primary">person</span>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-on-surface">
                                    {{ $product->user->first_name }} {{ $product->user->last_name }}
                                </p>
                                <p class="text-body-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span>
                                    Vendedor Verificado
                                </p>
                            </div>
                        </div>

                        {{-- Botón Guardar en Favoritos --}}
                        @auth
                        <button id="fav-card-btn"
                                onclick="handleFavClick({{ $product->id }}, '{{ addslashes($product->title) }}')"
                                class="w-full py-3 rounded-xl font-bold flex items-center justify-center gap-2 border transition-all mb-3 {{ $favBtnClass }}">
                            <span class="material-symbols-outlined text-[20px]" id="fav-card-icon" style="{{ $favIconStyle }}">favorite</span>
                            <span id="fav-card-label">{{ $favBtnLabel }}</span>
                        </button>
                        @endauth

                        {{-- Formulario de Trato Directo --}}
                        @auth
                            @if(auth()->id() !== $product->user_id)
                                <form id="trato-init-form"
                                      action="{{ route('tratos.store', $product) }}"
                                      method="POST">
                                    @csrf
                                    <input type="hidden" name="message" id="trato-init-message">
                                    <button type="submit"
                                            class="w-full py-4 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-4 hover:scale-[1.02] active:scale-95 transition-all h-14">
                                        <span class="material-symbols-outlined">handshake</span>
                                        TRATO DIRECTO
                                    </button>
                                </form>
                            @else
                                <div class="w-full py-4 bg-surface-container text-on-surface-variant rounded-xl font-bold flex items-center justify-center gap-4 h-14 opacity-50 cursor-not-allowed">
                                    <span class="material-symbols-outlined">storefront</span>
                                    TU PUBLICACIÓN
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login.show') }}"
                               class="w-full py-4 bg-secondary-container text-on-secondary rounded-xl font-bold flex items-center justify-center gap-4 hover:scale-[1.02] active:scale-95 transition-all h-14">
                                <span class="material-symbols-outlined">handshake</span>
                                INICIAR SESIÓN PARA TRATAR
                            </a>
                        @endauth
                    </div>

                    {{-- ======== CHAT ======== --}}
                    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-lg flex flex-col h-[500px] overflow-hidden">

                        <div class="p-4 bg-surface-container-high border-b border-outline-variant flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">chat_bubble</span>
                                <span class="font-bold text-primary">
                                    Chat con {{ $product->user->first_name }}
                                </span>
                            </div>
                            <span class="text-body-sm text-green-600 font-bold">En línea</span>
                        </div>

                        <div id="chat-messages" class="flex-1 p-4 overflow-y-auto bg-surface-container-lowest flex items-center justify-center">
                            <p class="text-body-sm text-outline text-center">
                                Usa las preguntas de abajo para iniciar la conversación
                            </p>
                        </div>

                        @php
                            $waSellerNum    = preg_replace('/[^0-9]/', '', $product->user->phone ?? '');
                            $waMsgDisponible = $waSellerNum
                                ? 'https://wa.me/' . $waSellerNum . '?text=' . rawurlencode('Hola! ¿Sigue disponible: ' . $product->title . '?')
                                : '#';
                            $waMsgInteresa = $waSellerNum
                                ? 'https://wa.me/' . $waSellerNum . '?text=' . rawurlencode('Hola! Me interesa adquirir: ' . $product->title . '. ¿Podemos coordinar?')
                                : '#';
                        @endphp

                        <div class="p-4 bg-surface-container-low border-t border-outline-variant">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-outline mb-3">Mensajes frecuentes</p>
                            <div class="space-y-2">

                                <div class="flex items-center gap-2">
                                    <button onclick="submitTratoWithMessage('¿Sigue disponible?')" class="flex-1 text-left group">
                                        <div class="bg-surface-container text-on-surface px-4 py-2.5 rounded-2xl rounded-tl-none shadow-sm border border-outline-variant/50 group-hover:border-primary/50 group-active:scale-[0.98] transition-all">
                                            <p class="text-body-sm">¿Sigue disponible?</p>
                                        </div>
                                    </button>
                                    <a href="{{ $waMsgDisponible }}" target="_blank" title="Enviar por WhatsApp"
                                       class="w-9 h-9 rounded-xl bg-[#25D366] flex items-center justify-center text-white shrink-0 hover:brightness-110 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex items-center gap-2">
                                    <button onclick="submitTratoWithMessage('Me interesa adquirir el producto')" class="flex-1 text-left group">
                                        <div class="bg-surface-container text-on-surface px-4 py-2.5 rounded-2xl rounded-tl-none shadow-sm border border-outline-variant/50 group-hover:border-primary/50 group-active:scale-[0.98] transition-all">
                                            <p class="text-body-sm">Me interesa adquirir el producto</p>
                                        </div>
                                    </button>
                                    <a href="{{ $waMsgInteresa }}" target="_blank" title="Enviar por WhatsApp"
                                       class="w-9 h-9 rounded-xl bg-[#25D366] flex items-center justify-center text-white shrink-0 hover:brightness-110 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.122.555 4.112 1.528 5.836L.057 23.997l6.304-1.654A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.887 9.887 0 01-5.031-1.378l-.36-.214-3.742.981.999-3.648-.235-.374A9.862 9.862 0 012.105 12C2.105 6.533 6.533 2.105 12 2.105S21.895 6.533 21.895 12 17.467 21.894 12 21.894z"/>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="p-4 bg-surface-container-highest">
                            {{-- Solo genera el link si el vendedor tiene teléfono registrado --}}
                            <a href="{{ $waSellerNum ? 'https://wa.me/' . $waSellerNum : '#' }}"
                               target="{{ $waSellerNum ? '_blank' : '_self' }}"
                               class="w-full py-4 bg-[#25D366] text-white rounded-xl font-bold flex items-center justify-center gap-4 hover:opacity-90 transition-all shadow-md {{ !$waSellerNum ? 'opacity-60 cursor-not-allowed' : '' }}">
                                <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.417-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.305 1.652zm6.599-3.835c1.405.836 3.125 1.333 4.909 1.334 5.431 0 9.851-4.42 9.854-9.853.002-5.439-4.417-9.856-9.854-9.856-5.432 0-9.853 4.42-9.855 9.855-.001 1.925.548 3.797 1.586 5.404l-.991 3.616 3.702-.971zm10.109-6.954c-.302-.151-1.785-.882-2.062-.982-.277-.1-.478-.151-.68.151-.202.302-.782.982-.958 1.183-.176.201-.352.226-.654.076-.302-.151-1.274-.469-2.426-1.496-.897-.8-1.501-1.788-1.677-2.09-.176-.302-.019-.465.132-.614.136-.134.302-.352.453-.528.151-.176.201-.302.302-.503.101-.201.05-.377-.025-.528-.075-.151-.68-1.636-.932-2.246-.247-.591-.497-.512-.68-.522l-.579-.011c-.201 0-.528.075-.805.377-.277.301-1.057 1.031-1.057 2.515 0 1.485 1.082 2.919 1.233 3.121.151.201 2.13 3.253 5.159 4.561.72.311 1.282.497 1.719.637.724.23 1.383.197 1.903.12.58-.086 1.785-.73 2.037-1.435.252-.704.252-1.308.176-1.434-.075-.126-.276-.201-.578-.352z"/>
                                </svg>
                                CONCRETAR POR WHATSAPP
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    @include('partials.footer')

</div>
@endsection

@push('scripts')
<script>
    // Resalta miniatura activa al hacer click
    document.querySelectorAll('[onclick*="main-product-image"]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('[onclick*="main-product-image"]').forEach(b => {
                b.classList.remove('border-2', 'border-primary');
                b.classList.add('border', 'border-outline-variant');
            });
            btn.classList.add('border-2', 'border-primary');
            btn.classList.remove('border', 'border-outline-variant');
        });
    });

    // Crea el trato con mensaje inicial
    function submitTratoWithMessage(text) {
        const form = document.getElementById('trato-init-form');
        if (!form) {
            window.location.href = '{{ route("login.show") }}';
            return;
        }
        document.getElementById('trato-init-message').value = text;
        form.submit();
    }

    // Favorite button handler
    const REMOVE_URL_SHOW = '{{ route("favorites.destroy") }}';
    const CSRF_SHOW       = '{{ csrf_token() }}';

    function handleFavClick(productId, title) {
        const cardIcon  = document.getElementById('fav-card-icon');
        const cardLabel = document.getElementById('fav-card-label');
        const cardBtn   = document.getElementById('fav-card-btn');

        const alreadyFav = cardIcon && cardIcon.style.fontVariationSettings.includes('FILL');

        if (alreadyFav) {
            fetch(REMOVE_URL_SHOW, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_SHOW,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ product_id: productId }),
            })
            .then(r => r.json())
            .then(() => {
                if (cardIcon)  cardIcon.style.fontVariationSettings = '';
                if (cardLabel) cardLabel.textContent = 'Guardar en favoritos';
                if (cardBtn) {
                    cardBtn.classList.remove('bg-error/10', 'border-error', 'text-error');
                    cardBtn.classList.add('border-outline-variant', 'text-on-surface-variant');
                }
            });
        } else {
            window.openFavoriteModal && window.openFavoriteModal(productId, title, function () {
                if (cardIcon)  cardIcon.style.fontVariationSettings = "'FILL' 1";
                if (cardLabel) cardLabel.textContent = 'En favoritos';
                if (cardBtn) {
                    cardBtn.classList.add('bg-error/10', 'border-error', 'text-error');
                    cardBtn.classList.remove('border-outline-variant', 'text-on-surface-variant');
                }
            });
        }
    }
</script>
@endpush
