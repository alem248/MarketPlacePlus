<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Delivery - Market Place Plus</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/icon.png') }}">

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
</head><body class="bg-background text-on-surface">

    @include('partials.seller-navbar')

    <div class="flex pt-16 min-h-screen">
        @include('partials.seller-sidebar', ['activeSellerTab' => 'delivery'])

        <main class="flex-1 p-gutter bg-background">
            <div class="max-w-container-max mx-auto">

                <header class="mb-8">
                    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-2">Mis Deliveries</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Solicita y gestiona los envíos de tus tratos aprobados.</p>
                </header>

                @php
                    $sinSolicitud = $tratos->filter(fn($t) => !$t->delivery);
                    $conSolicitud = $tratos->filter(fn($t) => $t->delivery);
                @endphp

                {{-- Tratos listos para solicitar --}}
                @if($sinSolicitud->isNotEmpty())
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-4">Tratos listos para enviar</h2>
                    <div class="grid grid-cols-1 gap-4 mb-10">
                        @foreach($sinSolicitud as $trato)
                        @php
                            $imgs   = $trato->product->image_path ?? [];
                            $imgSrc = isset($imgs[0]) ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0])) : null;
                            $tratoCode = 'MPP-' . $trato->id . '-' . $trato->created_at->year;
                        @endphp
                        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-5 flex flex-col md:flex-row items-center gap-5 hover:shadow-md transition-shadow">
                            <div class="w-20 h-20 rounded-lg overflow-hidden bg-surface-container-high shrink-0 flex items-center justify-center">
                                @if($imgSrc)
                                    <img src="{{ $imgSrc }}" alt="{{ $trato->product->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-outline" style="font-size:40px">image</span>
                                @endif
                            </div>
                            <div class="flex-1 w-full text-center md:text-left">
                                <span class="text-[10px] font-bold text-secondary uppercase tracking-widest">{{ strtoupper($trato->product->category ?? 'PRODUCTO') }}</span>
                                <h3 class="font-body-lg font-bold text-on-surface mt-1">{{ $trato->product->title }}</h3>
                                <p class="text-body-sm text-on-surface-variant mt-1">
                                    <span class="material-symbols-outlined" style="font-size:14px">tag</span> {{ $tratoCode }} ·
                                    <span class="material-symbols-outlined" style="font-size:14px">person</span>
                                    {{ $trato->buyer->first_name }} {{ $trato->buyer->last_name }}
                                </p>
                            </div>
                            <div class="text-center md:text-right shrink-0">
                                <p class="font-price-display text-price-display text-secondary">S/. {{ number_format($trato->price, 2) }}</p>
                            </div>
                            <div class="shrink-0 w-full md:w-auto">
                                <a href="{{ route('seller.delivery.create', $trato) }}"
                                   class="w-full md:w-auto flex items-center justify-center gap-2 px-6 py-3 bg-secondary-container text-on-secondary-container font-bold rounded-xl hover:shadow-md transition-all active:scale-95">
                                    <span class="material-symbols-outlined">send</span>
                                    Solicitar Delivery
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                {{-- Solicitudes ya enviadas --}}
                @if($conSolicitud->isNotEmpty())
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-4">Mis solicitudes</h2>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($conSolicitud as $trato)
                        @php
                            $imgs      = $trato->product->image_path ?? [];
                            $imgSrc    = isset($imgs[0]) ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0])) : null;
                            $delivery  = $trato->delivery;
                            $statusMap = [
                                'pendiente'  => ['label' => 'En espera',  'color' => 'bg-yellow-100 text-yellow-800', 'icon' => 'hourglass_top'],
                                'aprobado'   => ['label' => 'Aprobado',   'color' => 'bg-green-100 text-green-800',  'icon' => 'check_circle'],
                                'rechazado'  => ['label' => 'Rechazado',  'color' => 'bg-red-100 text-red-800',     'icon' => 'cancel'],
                                'en_camino'  => ['label' => 'En camino',  'color' => 'bg-blue-100 text-blue-800',   'icon' => 'local_shipping'],
                                'entregado'  => ['label' => 'Entregado',  'color' => 'bg-gray-100 text-gray-600',   'icon' => 'inventory_2'],
                            ];
                            $s = $statusMap[$delivery->status] ?? $statusMap['pendiente'];
                        @endphp
                        <a href="{{ route('seller.delivery.show', $trato) }}"
                           class="bg-surface-container-lowest border border-outline-variant rounded-xl p-5 flex flex-col md:flex-row items-center gap-5 hover:shadow-md transition-shadow block">
                            <div class="w-20 h-20 rounded-lg overflow-hidden bg-surface-container-high shrink-0 flex items-center justify-center">
                                @if($imgSrc)
                                    <img src="{{ $imgSrc }}" alt="{{ $trato->product->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-outline" style="font-size:40px">image</span>
                                @endif
                            </div>
                            <div class="flex-1 w-full text-center md:text-left">
                                <span class="text-[10px] font-bold text-secondary uppercase tracking-widest">{{ strtoupper($trato->product->category ?? 'PRODUCTO') }}</span>
                                <h3 class="font-body-lg font-bold text-on-surface mt-1">{{ $trato->product->title }}</h3>
                                <p class="text-body-sm text-on-surface-variant mt-1">
                                    {{ $trato->buyer->first_name }} {{ $trato->buyer->last_name }} ·
                                    {{ $delivery->shipping_type === 'express' ? 'Express' : 'Regular' }}
                                </p>
                            </div>
                            <div class="shrink-0 text-center md:text-right">
                                <p class="font-price-display text-price-display text-secondary mb-2">S/. {{ number_format($trato->price, 2) }}</p>
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[12px] font-bold {{ $s['color'] }}">
                                    <span class="material-symbols-outlined" style="font-size:14px">{{ $s['icon'] }}</span>
                                    {{ $s['label'] }}
                                </span>
                            </div>
                            <div class="shrink-0">
                                <span class="material-symbols-outlined text-outline">chevron_right</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @endif

                @if($tratos->isEmpty())
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-16 text-center">
                        <span class="material-symbols-outlined text-outline block mb-4" style="font-size:64px">local_shipping</span>
                        <h3 class="font-headline-md text-headline-md text-on-surface mb-2">Sin tratos aprobados</h3>
                        <p class="text-body-sm text-on-surface-variant mb-6">Cuando un trato sea aprobado, aparecerá aquí listo para solicitar delivery.</p>
                        <a href="{{ route('seller.tratos.index') }}" class="inline-block px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:opacity-90 transition-all">
                            Ver mis tratos
                        </a>
                    </div>
                @endif

            </div>
        </main>
    </div>

    @include('partials.footer')
</body>
</html>
