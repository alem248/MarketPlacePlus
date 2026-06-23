<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Solicitar Delivery - Market Place Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "background": "#f8f9fa", "surface-container": "#edeeef", "surface-variant": "#e1e3e4",
                        "surface-dim": "#d9dadb", "surface": "#f8f9fa", "on-error-container": "#93000a",
                        "error-container": "#ffdad6", "secondary-fixed-dim": "#ffb786", "on-secondary-fixed": "#311300",
                        "on-primary-container": "#a1bbff", "surface-bright": "#f8f9fa", "on-surface-variant": "#434652",
                        "surface-container-low": "#f3f4f5", "on-primary": "#ffffff", "primary-container": "#0d47a1",
                        "on-error": "#ffffff", "surface-container-highest": "#e1e3e4", "tertiary-container": "#005914",
                        "tertiary-fixed": "#a3f69c", "secondary-fixed": "#ffdcc6", "primary": "#003178",
                        "surface-tint": "#2b5bb5", "on-primary-fixed": "#001945", "outline": "#737783",
                        "secondary-container": "#fc820c", "on-tertiary-container": "#7ecf79", "primary-fixed-dim": "#b0c6ff",
                        "on-secondary-container": "#5e2c00", "primary-fixed": "#d9e2ff", "surface-container-high": "#e7e8e9",
                        "secondary": "#964900", "on-surface": "#191c1d", "tertiary": "#003f0b",
                        "surface-container-lowest": "#ffffff", "outline-variant": "#c3c6d4", "inverse-on-surface": "#f0f1f2",
                        "error": "#ba1a1a", "on-background": "#191c1d", "inverse-surface": "#2e3132", "on-secondary": "#ffffff",
                        "on-secondary-fixed-variant": "#723600", "on-tertiary-fixed": "#002204",
                        "on-primary-fixed-variant": "#00429c", "on-tertiary": "#ffffff", "on-tertiary-fixed-variant": "#005312"
                    },
                    "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                    "spacing": { "gutter": "24px", "base": "8px", "margin-mobile": "16px", "sidebar-width": "280px", "container-max": "1280px" },
                    "fontFamily": { "label-caps": ["Inter"], "body-sm": ["Inter"], "body-lg": ["Inter"], "price-display": ["Inter"], "headline-md": ["Inter"], "headline-lg": ["Inter"] },
                    "fontSize": {
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "price-display": ["24px", {"lineHeight": "24px", "fontWeight": "700"}],
                        "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
    </style>
</head>
<body class="bg-background text-on-surface">

    @include('partials.seller-navbar')

    <div class="flex pt-16 min-h-screen">
        @include('partials.seller-sidebar', ['activeSellerTab' => 'delivery'])

        <main class="flex-1 p-gutter bg-background">
            <div class="max-w-container-max mx-auto">

                <div class="flex items-center gap-2 mb-6 text-body-sm text-on-surface-variant">
                    <a href="{{ route('seller.delivery.index') }}" class="hover:text-primary transition-colors">Delivery</a>
                    <span class="material-symbols-outlined" style="font-size:16px">chevron_right</span>
                    <span class="text-on-surface font-bold">Solicitar Envío</span>
                </div>

                <header class="mb-8">
                    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-2">Solicitar Delivery</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Completa los datos y el administrador coordinará el envío con un repartidor.</p>
                </header>

                <div class="flex flex-col lg:flex-row gap-gutter">

                    <div class="flex-1 space-y-gutter">
                        @php
                            $imgs   = $trato->product->image_path ?? [];
                            $imgSrc = isset($imgs[0])
                                ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0]))
                                : null;
                            $tratoCode = 'MPP-' . $trato->id . '-' . $trato->created_at->year;
                        @endphp

                        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-4 flex items-center gap-4">
                            <div class="w-20 h-20 bg-surface-container-high rounded-lg overflow-hidden flex-shrink-0 flex items-center justify-center">
                                @if($imgSrc)
                                    <img src="{{ $imgSrc }}" alt="{{ $trato->product->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-outline" style="font-size:40px">inventory_2</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <span class="text-[10px] font-bold text-secondary uppercase tracking-widest">Artículo a enviar</span>
                                <h2 class="font-body-lg font-bold text-on-surface">{{ $trato->product->title }}</h2>
                                <p class="text-body-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined" style="font-size:14px">tag</span> {{ $tratoCode }}
                                </p>
                            </div>
                            <div class="text-right hidden sm:block shrink-0">
                                <span class="font-price-display text-price-display text-secondary">S/. {{ number_format($trato->price, 2) }}</span>
                                <p class="text-body-sm text-on-surface-variant mt-1">
                                    Comprador: {{ $trato->buyer->first_name }} {{ $trato->buyer->last_name }}
                                </p>
                            </div>
                        </div>

                        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 md:p-8">
                            <form action="{{ route('seller.delivery.store', $trato) }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <div class="space-y-2">
                                        <label class="block font-body-sm font-bold text-on-surface">Dirección de Recojo <span class="text-error">*</span></label>
                                        <input class="w-full p-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary-container focus:border-secondary outline-none transition-all"
                                               placeholder="Calle, Av. o referencia de recojo" type="text" name="pickup_address"
                                               value="{{ old('pickup_address') }}" required>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block font-body-sm font-bold text-on-surface">Dirección de Destino <span class="text-error">*</span></label>
                                        <input class="w-full p-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary-container focus:border-secondary outline-none transition-all"
                                               placeholder="Dirección exacta del comprador" type="text" name="delivery_address"
                                               value="{{ old('delivery_address') }}" required>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block font-body-sm font-bold text-on-surface">Nombre del Contacto <span class="text-error">*</span></label>
                                        <input class="w-full p-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary-container focus:border-secondary outline-none transition-all"
                                               placeholder="Nombre completo de quien recibe" type="text" name="contact_name"
                                               value="{{ old('contact_name', $trato->buyer->first_name . ' ' . $trato->buyer->last_name) }}" required>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block font-body-sm font-bold text-on-surface">Teléfono de Contacto <span class="text-error">*</span></label>
                                        <input class="w-full p-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary-container focus:border-secondary outline-none transition-all"
                                               placeholder="Número de celular" type="tel" name="contact_phone"
                                               value="{{ old('contact_phone') }}" required>
                                    </div>

                                    <div class="space-y-2 md:col-span-2">
                                        <label class="block font-body-sm font-bold text-on-surface">Tipo de Envío</label>
                                        <div class="relative">
                                            <select class="w-full p-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary-container focus:border-secondary outline-none transition-all appearance-none pr-10" name="shipping_type">
                                                <option value="regular" {{ old('shipping_type') === 'regular' ? 'selected' : '' }}>Regular (24h - 48h)</option>
                                                <option value="express" {{ old('shipping_type') === 'express' ? 'selected' : '' }}>Express (Mismo día)</option>
                                            </select>
                                            <span class="material-symbols-outlined absolute right-3 top-3 text-on-surface-variant pointer-events-none">expand_more</span>
                                        </div>
                                    </div>

                                    <div class="space-y-2 md:col-span-2">
                                        <label class="block font-body-sm font-bold text-on-surface">Observaciones Adicionales</label>
                                        <textarea class="w-full p-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary-container focus:border-secondary outline-none transition-all resize-none"
                                                  placeholder="Ej: Llamar antes de llegar, dejar en portería, etc." rows="3" name="notes">{{ old('notes') }}</textarea>
                                    </div>
                                </div>

                                @if($errors->any())
                                    <div class="p-4 bg-error-container rounded-xl">
                                        <ul class="text-body-sm text-on-error-container space-y-1">
                                            @foreach($errors->all() as $e)
                                                <li class="flex items-center gap-2"><span class="material-symbols-outlined" style="font-size:16px">error</span> {{ $e }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="pt-4">
                                    <button class="w-full py-4 bg-secondary-container text-on-secondary-container font-bold rounded-xl hover:shadow-lg transition-all active:scale-95 flex items-center justify-center gap-2" type="submit">
                                        <span class="material-symbols-outlined">send</span>
                                        Enviar Solicitud de Delivery
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <aside class="w-full lg:w-80 flex-shrink-0">
                        <div class="bg-surface-container-high p-6 rounded-xl border border-outline-variant space-y-4">
                            <div class="flex items-center gap-2 text-primary">
                                <span class="material-symbols-outlined">info</span>
                                <h3 class="font-body-lg font-bold">¿Cómo funciona?</h3>
                            </div>
                            <div class="space-y-4">
                                <div class="flex gap-3">
                                    <div class="w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center text-[12px] font-bold shrink-0">1</div>
                                    <p class="text-body-sm text-on-surface-variant">Envías el formulario con los datos del envío.</p>
                                </div>
                                <div class="flex gap-3">
                                    <div class="w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center text-[12px] font-bold shrink-0">2</div>
                                    <p class="text-body-sm text-on-surface-variant">El administrador revisa y asigna un repartidor.</p>
                                </div>
                                <div class="flex gap-3">
                                    <div class="w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center text-[12px] font-bold shrink-0">3</div>
                                    <p class="text-body-sm text-on-surface-variant">Recibes los datos del repartidor y marcas el envío.</p>
                                </div>
                                <div class="flex gap-3">
                                    <div class="w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center text-[12px] font-bold shrink-0">4</div>
                                    <p class="text-body-sm text-on-surface-variant">El comprador confirma la recepción.</p>
                                </div>
                            </div>
                        </div>
                    </aside>

                </div>
            </div>
        </main>
    </div>

    @include('partials.footer')
</body>
</html>
