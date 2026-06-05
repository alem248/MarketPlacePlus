@extends('layouts.app')

@section('title', 'Crear Publicación | MarketPlace Plus')

@section('content')
<div class="bg-background text-on-surface min-h-screen flex flex-col">

    {{-- TopNavBar --}}
    <header class="bg-surface border-b border-outline-variant fixed top-0 w-full z-50">
        <div class="flex justify-between items-center px-gutter py-base w-full max-w-container-max mx-auto h-16">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="font-headline-md text-headline-md font-bold text-primary">Market Place Plus</a>
                <span class="hidden md:block text-on-surface-variant font-body-sm italic ml-4">¿Qué vamos a vender hoy?</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('seller.products.create') }}"
                    class="hidden md:flex items-center gap-2 bg-secondary-container text-on-secondary-container px-4 py-2 rounded-xl font-bold hover:opacity-90 transition-colors">
                    <span class="material-symbols-outlined">add</span>
                    <span>Crear Publicación</span>
                </a>
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1 pt-16">

        {{-- SideNavBar --}}
        <aside class="fixed left-0 w-sidebar-width bg-surface-container border-r border-outline-variant hidden md:flex flex-col p-base space-y-4 bottom-0 top-16 overflow-y-auto" style="z-index:40;">
            <div class="p-4 mb-4">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold text-lg">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-headline-md text-headline-md text-primary">Modo Vendedor</p>
                        <p class="text-on-surface-variant text-sm">{{ auth()->user()->full_name }}</p>
                    </div>
                </div>
                <button class="btn-soon w-full mt-4 bg-outline-variant text-on-surface-variant font-bold py-2 rounded-xl hover:bg-surface-variant transition-all">
                    Cambiar a Cliente
                </button>
            </div>
            <nav class="space-y-1">
                <a class="bg-secondary-container text-on-secondary-container rounded-xl font-bold flex items-center px-4 py-3"
                   href="{{ route('seller.products.create') }}">
                    <span class="material-symbols-outlined mr-3">add</span>
                    <span class="font-body-lg text-body-lg">Crear Publicación</span>
                </a>
                <a class="text-on-surface-variant hover:bg-surface-variant flex items-center px-4 py-3 rounded-xl transition-all"
                   href="{{ route('home') }}">
                    <span class="material-symbols-outlined mr-3">dashboard</span>
                    <span class="font-body-lg text-body-lg">Panel</span>
                </a>
                <a class="text-on-surface-variant hover:bg-surface-variant flex items-center px-4 py-3 rounded-xl transition-all"
                   href="{{ route('tratos.index') }}">
                    <span class="material-symbols-outlined mr-3">handshake</span>
                    <span class="font-body-lg text-body-lg">Mis Tratos</span>
                </a>
                <button class="btn-soon w-full text-on-surface-variant flex items-center px-4 py-3 rounded-xl transition-all">
                    <span class="material-symbols-outlined mr-3">local_shipping</span>
                    <span class="font-body-lg text-body-lg">Delivery</span>
                </button>
                <button class="btn-soon w-full text-on-surface-variant flex items-center px-4 py-3 rounded-xl transition-all">
                    <span class="material-symbols-outlined mr-3">receipt_long</span>
                    <span class="font-body-lg text-body-lg">Mis Comprobantes</span>
                </button>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 md:ml-sidebar-width p-gutter bg-background min-h-screen">
            <div class="max-w-4xl mx-auto space-y-gutter">

                <header class="mb-8">
                    <h1 class="font-headline-lg text-headline-lg text-primary">Publicar Nuevo Producto</h1>
                    <p class="text-on-surface-variant font-body-lg mt-2">Completa los detalles para listar tu producto en el marketplace.</p>
                </header>

                {{-- Mensajes de éxito --}}
                @if (session('success'))
                    <div class="p-4 bg-tertiary-fixed text-on-tertiary-fixed rounded-xl flex items-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Errores --}}
                @if ($errors->any())
                    <div class="p-4 bg-error-container text-on-error-container rounded-xl space-y-1">
                        @foreach ($errors->all() as $error)
                            <p class="text-body-sm flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px]">error</span>{{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">

                    {{-- Formulario --}}
                    <div class="lg:col-span-2 space-y-gutter">
                        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Información básica --}}
                            <section class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm mb-gutter">
                                <div class="flex items-center gap-2 mb-6 text-primary">
                                    <span class="material-symbols-outlined">info</span>
                                    <h2 class="font-headline-md text-headline-md">Información Básica</h2>
                                </div>
                                <div class="space-y-6">
                                    <div>
                                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">TÍTULO DEL PRODUCTO</label>
                                        <input id="product-title" name="title"
                                            class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary focus:border-transparent bg-white text-on-surface font-body-lg"
                                            placeholder="Ej: Smartphone Samsung Galaxy S23 Ultra" type="text"
                                            value="{{ old('title') }}" required>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">CATEGORÍA</label>
                                            <select name="category" class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg" required>
                                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Seleccionar categoría</option>
                                                <option value="tecnologia"  {{ old('category')=='tecnologia'  ? 'selected':'' }}>Tecnología</option>
                                                <option value="hogar"       {{ old('category')=='hogar'       ? 'selected':'' }}>Hogar</option>
                                                <option value="moda"        {{ old('category')=='moda'        ? 'selected':'' }}>Moda</option>
                                                <option value="vehiculos"   {{ old('category')=='vehiculos'   ? 'selected':'' }}>Vehículos</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">UBICACIÓN</label>
                                            <select name="location" class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg" required>
                                                <option value="" disabled {{ old('location') ? '' : 'selected' }}>Seleccionar ubicación</option>
                                                <option value="Lima"        {{ old('location')=='Lima'        ? 'selected':'' }}>Lima</option>
                                                <option value="Santa Anita" {{ old('location')=='Santa Anita' ? 'selected':'' }}>Santa Anita</option>
                                                <option value="Arequipa"    {{ old('location')=='Arequipa'    ? 'selected':'' }}>Arequipa</option>
                                                <option value="Cusco"       {{ old('location')=='Cusco'       ? 'selected':'' }}>Cusco</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">DESCRIPCIÓN</label>
                                        <textarea name="description" rows="4"
                                            class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                                            placeholder="Describe las características principales, garantía, etc." required>{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </section>

                            {{-- Precio --}}
                            <section class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm mb-gutter">
                                <div class="flex items-center gap-2 mb-6 text-primary">
                                    <span class="material-symbols-outlined">payments</span>
                                    <h2 class="font-headline-md text-headline-md">Precio</h2>
                                </div>
                                <div>
                                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">PRECIO (S/.)</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">S/.</span>
                                        <input id="product-price" name="price"
                                            class="w-full pl-12 p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                                            placeholder="0.00" type="number" min="0" step="0.01"
                                            value="{{ old('price') }}" required>
                                    </div>
                                </div>
                            </section>

                            {{-- Multimedia --}}
                            <section class="bg-surface-container-lowest p-gutter rounded-xl border border-outline-variant shadow-sm mb-gutter">
                                <div class="flex items-center gap-2 mb-6 text-primary">
                                    <span class="material-symbols-outlined">photo_library</span>
                                    <h2 class="font-headline-md text-headline-md">Multimedia</h2>
                                </div>
                                <label class="border-2 border-dashed border-outline-variant rounded-xl p-12 text-center hover:bg-surface-container-low transition-colors cursor-pointer group block">
                                    <span class="material-symbols-outlined text-4xl text-outline-variant group-hover:text-primary transition-colors">cloud_upload</span>
                                    <p class="mt-4 font-body-lg font-bold text-on-surface">Haz clic para subir o arrastra y suelta imágenes</p>
                                    <p class="text-on-surface-variant text-sm mt-1">Soporta JPG, PNG (Máx. 5MB por imagen)</p>
                                    <input type="file" name="images[]" multiple accept="image/*" class="hidden">
                                </label>
                            </section>

                            {{-- Acciones --}}
                            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                <button type="button"
                                    class="btn-soon flex-1 bg-white border border-outline text-on-surface font-bold py-4 rounded-xl hover:bg-surface-container-high transition-all">
                                    Guardar Borrador
                                </button>
                                <button type="submit"
                                    class="flex-1 bg-secondary-container text-white font-bold py-4 rounded-xl flex items-center justify-center gap-2 hover:opacity-90 transition-all shadow-lg active:scale-95">
                                    Publicar Producto
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Sidebar: Vista previa + Consejos --}}
                    <div class="space-y-gutter">
                        {{-- Preview Card --}}
                        <div class="bg-white rounded-xl border border-outline-variant overflow-hidden shadow-sm sticky top-24">
                            <div class="p-4 bg-surface-container text-center border-b border-outline-variant">
                                <h3 class="font-label-caps text-label-caps text-on-surface-variant">VISTA PREVIA</h3>
                            </div>
                            <div class="aspect-square bg-surface-container-high flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-outline-variant">inventory_2</span>
                            </div>
                            <div class="p-4 space-y-3">
                                <div class="flex text-secondary text-sm">
                                    @for ($i = 0; $i < 5; $i++)
                                        <span class="material-symbols-outlined text-sm">star</span>
                                    @endfor
                                </div>
                                <h4 id="preview-title" class="font-headline-md text-headline-md leading-tight h-14 overflow-hidden">
                                    Título del producto aparecerá aquí
                                </h4>
                                <p id="preview-price" class="font-price-display text-price-display text-primary">S/. 0.00</p>
                                <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary text-xs font-bold">
                                            {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                                        </div>
                                        <span class="text-sm font-bold">{{ auth()->user()->first_name }}</span>
                                    </div>
                                    <button class="btn-soon bg-secondary p-2 rounded-lg text-white">
                                        <span class="material-symbols-outlined">handshake</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- Consejos --}}
                        <div class="bg-primary-fixed p-gutter rounded-xl border border-primary-fixed-dim">
                            <div class="flex items-center gap-2 mb-4 text-on-primary-fixed">
                                <span class="material-symbols-outlined">lightbulb</span>
                                <h3 class="font-bold">Consejos de Vendedor</h3>
                            </div>
                            <ul class="space-y-3 text-sm text-on-primary-fixed-variant">
                                <li class="flex gap-2"><span class="text-primary">•</span><span>Usa títulos claros y específicos.</span></li>
                                <li class="flex gap-2"><span class="text-primary">•</span><span>Sube al menos 3 fotos de alta calidad.</span></li>
                                <li class="flex gap-2"><span class="text-primary">•</span><span>Describe honestamente el estado del producto.</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('layouts.footer')

    {{-- Mobile Nav --}}
    <div class="md:hidden fixed bottom-0 w-full bg-surface border-t border-outline-variant flex justify-around py-2 z-50">
        <a href="{{ route('home') }}" class="flex flex-col items-center p-2 text-on-surface-variant">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-[10px] mt-1">Panel</span>
        </a>
        <a href="{{ route('seller.products.create') }}" class="flex flex-col items-center p-2 text-primary font-bold">
            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">add_circle</span>
            <span class="text-[10px] mt-1">Vender</span>
        </a>
        <a href="{{ route('tratos.index') }}" class="flex flex-col items-center p-2 text-on-surface-variant">
            <span class="material-symbols-outlined">handshake</span>
            <span class="text-[10px] mt-1">Tratos</span>
        </a>
        <button class="btn-soon flex flex-col items-center p-2 text-on-surface-variant">
            <span class="material-symbols-outlined">person</span>
            <span class="text-[10px] mt-1">Perfil</span>
        </button>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Vista previa en tiempo real
    const titleInput = document.getElementById('product-title');
    const priceInput = document.getElementById('product-price');
    const previewTitle = document.getElementById('preview-title');
    const previewPrice = document.getElementById('preview-price');

    if (titleInput) {
        titleInput.addEventListener('input', e => {
            previewTitle.textContent = e.target.value || 'Título del producto aparecerá aquí';
        });
    }
    if (priceInput) {
        priceInput.addEventListener('input', e => {
            const val = parseFloat(e.target.value);
            previewPrice.textContent = !isNaN(val) ? `S/. ${val.toFixed(2)}` : 'S/. 0.00';
        });
    }
</script>
@endpush
