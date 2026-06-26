<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mis Comprobantes - MarketPlace Plus</title>

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
                        "background": "#f8f9fa", "surface-container": "#edeeef", "tertiary": "#003f0b",
                        "surface-variant": "#e1e3e4", "tertiary-fixed": "#a3f69c", "surface-dim": "#d9dadb",
                        "surface": "#f8f9fa", "on-error-container": "#93000a", "error-container": "#ffdad6",
                        "secondary-fixed-dim": "#ffb786", "on-secondary-fixed": "#311300",
                        "on-primary-container": "#a1bbff", "surface-bright": "#f8f9fa",
                        "on-surface-variant": "#434652", "surface-container-low": "#f3f4f5",
                        "on-primary": "#ffffff", "primary-container": "#0d47a1", "on-error": "#ffffff",
                        "surface-container-highest": "#e1e3e4", "on-tertiary-fixed-variant": "#005312",
                        "on-primary-fixed-variant": "#00429c", "inverse-primary": "#b0c6ff",
                        "tertiary-container": "#005914", "secondary-fixed": "#ffdcc6", "primary": "#003178",
                        "surface-tint": "#2b5bb5", "on-primary-fixed": "#001945", "outline": "#737783",
                        "secondary-container": "#fc820c", "on-tertiary-container": "#7ecf79",
                        "on-tertiary-fixed": "#002204", "primary-fixed-dim": "#b0c6ff",
                        "on-secondary-container": "#5e2c00", "primary-fixed": "#d9e2ff",
                        "surface-container-high": "#e7e8e9", "secondary": "#964900", "on-surface": "#191c1d",
                        "on-tertiary": "#ffffff", "surface-container-lowest": "#ffffff",
                        "outline-variant": "#c3c6d4", "inverse-on-surface": "#f0f1f2", "error": "#ba1a1a",
                        "on-background": "#191c1d", "on-secondary-fixed-variant": "#723600",
                        "inverse-surface": "#2e3132", "on-secondary": "#ffffff"
                    },
                    "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                    "spacing": { "gutter": "24px", "base": "8px", "margin-mobile": "16px", "sidebar-width": "280px", "container-max": "1280px" },
                    "fontFamily": { "label-caps": ["Inter"], "body-sm": ["Inter"], "body-lg": ["Inter"], "price-display": ["Inter"], "headline-md": ["Inter"], "headline-lg-mobile": ["Inter"], "headline-lg": ["Inter"] },
                    "fontSize": {
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "price-display": ["24px", {"lineHeight": "24px", "fontWeight": "700"}],
                        "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
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

        @include('partials.seller-sidebar', ['activeSellerTab' => 'comprobantes'])

        <!-- Main Content -->
        <main class="flex-1 p-gutter bg-surface min-h-screen">
            <div class="max-w-5xl mx-auto">

                <div class="mb-8">
                    <h1 class="text-headline-lg font-headline-lg text-on-surface">Mis Comprobantes</h1>
                    <p class="text-on-surface-variant mt-2">Resumen de las ventas que has completado como vendedor.</p>
                </div>

                <div class="flex flex-col gap-6">

                    @forelse($comprobantes as $comp)
                    @php
                        $imgs   = $comp->product->image_path ?? [];
                        $imgSrc = isset($imgs[0])
                            ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0]))
                            : null;

                        $payIcon = match(strtolower($comp->payment_method)) {
                            'tarjeta'                => 'credit_card',
                            'yape', 'plin'           => 'account_balance_wallet',
                            'efectivo'               => 'payments',
                            'transferencia bancaria' => 'account_balance',
                            default                  => 'receipt',
                        };
                    @endphp

                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-col md:flex-row">

                            {{-- Imagen del producto --}}
                            <div class="w-full md:w-56 h-56 md:h-auto shrink-0 bg-surface-container">
                                @if($imgSrc)
                                    <img class="w-full h-full object-cover" src="{{ $imgSrc }}"
                                         alt="{{ $comp->product->title }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-outline" style="font-size:64px">image</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Datos del comprobante --}}
                            <div class="flex-1 p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-headline-md font-headline-md text-on-surface pr-4">
                                        {{ $comp->product->title }}
                                    </h3>
                                    <p class="text-price-display font-price-display text-secondary shrink-0">
                                        S/. {{ number_format($comp->price, 2) }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-4 gap-x-8 border-t border-outline-variant pt-4">

                                    <div>
                                        <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">ID Transacción</p>
                                        <p class="text-body-sm text-on-surface font-semibold">#{{ $comp->transaction_code }}</p>
                                    </div>

                                    <div>
                                        <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Fecha</p>
                                        <p class="text-body-sm text-on-surface font-semibold">
                                            {{ $comp->created_at->format('d M, Y') }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Comprador</p>
                                        <p class="text-body-sm text-on-surface font-semibold">
                                            {{ $comp->buyer->first_name }} {{ $comp->buyer->last_name }}
                                        </p>
                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Método de Pago</p>
                                        <p class="text-body-sm text-on-surface font-semibold flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">{{ $payIcon }}</span>
                                            {{ $comp->payment_method }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Estado</p>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-tertiary-fixed/40 text-tertiary text-[11px] font-bold">
                                            <span class="material-symbols-outlined text-xs">check_circle</span>
                                            Venta completada
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-16 text-center">
                        <span class="material-symbols-outlined text-outline" style="font-size:64px">receipt_long</span>
                        <h3 class="text-headline-md font-bold text-on-surface mt-4">Aún no tienes comprobantes de venta</h3>
                        <p class="text-body-sm text-on-surface-variant mt-2">
                            Cuando un comprador genere el comprobante de un trato contigo, aparecerá aquí.
                        </p>
                        <a href="{{ route('seller.tratos.index') }}"
                           class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:opacity-90 transition-opacity">
                            <span class="material-symbols-outlined">handshake</span>
                            Ver mis tratos
                        </a>
                    </div>
                    @endforelse

                </div>
            </div>
        </main>
    </div>

    @include('partials.footer')

</body>
</html>
