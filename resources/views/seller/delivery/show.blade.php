<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seguimiento de Pedido - Market Place Plus</title>
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
                    <span class="text-on-surface font-bold">Seguimiento</span>
                </div>

                {{-- BANNER: recién creado --}}
                @if(session('delivery_created'))
                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl flex items-start gap-3">
                    <span class="material-symbols-outlined text-yellow-600 mt-0.5">hourglass_top</span>
                    <div>
                        <p class="font-bold text-yellow-800">Tu solicitud está en espera</p>
                        <p class="text-body-sm text-yellow-700 mt-0.5">El administrador revisará los datos y asignará un repartidor. Te notificaremos cuando sea aprobada.</p>
                    </div>
                </div>
                @endif

                {{-- BANNER: aprobado --}}
                @if($delivery->status === 'aprobado' && session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    <p class="text-green-800 font-bold">{{ session('success') }}</p>
                </div>
                @endif

                {{-- BANNER: rechazado --}}
                @if($delivery->status === 'rechazado')
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
                    <span class="material-symbols-outlined text-error">cancel</span>
                    <div>
                        <p class="font-bold text-error">Solicitud rechazada</p>
                        @if($delivery->admin_notes)
                            <p class="text-body-sm text-on-surface-variant mt-0.5">Motivo: {{ $delivery->admin_notes }}</p>
                        @endif
                    </div>
                </div>
                @endif

                @php
                    $imgs   = $trato->product->image_path ?? [];
                    $imgSrc = isset($imgs[0]) ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0])) : null;
                    $tratoCode = 'MPP-' . $trato->id . '-' . $trato->created_at->year;

                    $step1Done     = in_array($delivery->status, ['aprobado', 'en_camino', 'entregado']);
                    $step2Done     = in_array($delivery->status, ['en_camino', 'entregado']);
                    $step3Done     = $delivery->status === 'entregado';
                    $pendiente     = $delivery->status === 'pendiente';
                    $progressClass = $step3Done ? 'w-[80%]' : ($step2Done ? 'w-[40%]' : 'w-0');
                @endphp

                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 md:p-8 mb-gutter">

                    {{-- Producto + info --}}
                    <div class="flex flex-col md:flex-row gap-6 mb-8">
                        <div class="w-full md:w-48 h-48 rounded-xl overflow-hidden bg-surface-container-high shrink-0">
                            @if($imgSrc)
                                <img src="{{ $imgSrc }}" alt="{{ $trato->product->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-outline" style="font-size:48px">image</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <span class="text-[10px] font-bold text-secondary uppercase tracking-widest">{{ strtoupper($trato->product->category ?? 'Producto') }}</span>
                            <h2 class="font-headline-md text-headline-md text-on-surface mt-1 mb-2">{{ $trato->product->title }}</h2>
                            <div class="space-y-1 text-body-sm text-on-surface-variant">
                                <p><span class="font-bold text-on-surface">Trato:</span> {{ $tratoCode }}</p>
                                <p><span class="font-bold text-on-surface">Comprador:</span> {{ $trato->buyer->first_name }} {{ $trato->buyer->last_name }}</p>
                                <p><span class="font-bold text-on-surface">Recojo en:</span> {{ $delivery->pickup_address }}</p>
                                <p><span class="font-bold text-on-surface">Destino:</span> {{ $delivery->delivery_address }}</p>
                                <p><span class="font-bold text-on-surface">Tipo de envío:</span> {{ $delivery->shipping_type === 'express' ? 'Express (Mismo día)' : 'Regular (24-48h)' }}</p>
                            </div>
                            <p class="font-price-display text-price-display text-secondary mt-4">S/. {{ number_format($trato->price, 2) }}</p>
                        </div>
                    </div>

                    {{-- Stepper --}}
                    <div class="relative flex justify-between items-start w-full max-w-lg mb-8">
                        <div class="absolute top-5 left-[10%] right-[10%] h-[2px] bg-surface-container-high z-0"></div>
                        @php
                            $progressWidth = $step3Done ? '80%' : ($step2Done ? '40%' : ($step1Done ? '0%' : '0%'));
                        @endphp
                        <div class="absolute top-5 left-[10%] h-[2px] bg-secondary-container z-0 transition-all duration-700 {{ $progressClass }}"></div>

                        {{-- Paso 1: Admin aprueba --}}
                        <div class="flex flex-col items-center gap-2 z-10 relative">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all
                                {{ $step1Done ? 'bg-secondary-container border-secondary-container' : ($pendiente ? 'bg-yellow-100 border-yellow-400' : 'border-outline-variant') }}">
                                @if($step1Done)
                                    <span class="material-symbols-outlined text-on-secondary" style="font-size:20px">check</span>
                                @elseif($pendiente)
                                    <span class="material-symbols-outlined text-yellow-600" style="font-size:20px">hourglass_top</span>
                                @else
                                    <span class="material-symbols-outlined text-outline" style="font-size:20px">admin_panel_settings</span>
                                @endif
                            </div>
                            <span class="font-label-caps text-label-caps text-center {{ $step1Done ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                                {{ $pendiente ? 'En espera' : 'Aprobado' }}
                            </span>
                        </div>

                        {{-- Paso 2: Vendedor envía --}}
                        <div class="flex flex-col items-center gap-2 z-10 relative">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all
                                {{ $step2Done ? 'bg-secondary-container border-secondary-container' : ($step1Done && !$step2Done ? 'border-secondary ring-4 ring-secondary/20' : 'border-outline-variant') }}">
                                <span class="material-symbols-outlined {{ $step2Done ? 'text-on-secondary' : ($step1Done ? 'text-secondary' : 'text-outline') }}" style="font-size:20px">local_shipping</span>
                            </div>
                            <span class="font-label-caps text-label-caps text-center {{ $step2Done ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">En camino</span>
                        </div>

                        {{-- Paso 3: Comprador recibe --}}
                        <div class="flex flex-col items-center gap-2 z-10 relative">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all
                                {{ $step3Done ? 'bg-secondary-container border-secondary-container' : 'border-outline-variant' }}">
                                <span class="material-symbols-outlined {{ $step3Done ? 'text-on-secondary' : 'text-outline' }}" style="font-size:20px">verified</span>
                            </div>
                            <span class="font-label-caps text-label-caps text-center {{ $step3Done ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">Entregado</span>
                        </div>
                    </div>

                    {{-- Datos del repartidor (si aprobado) --}}
                    @if($delivery->status === 'aprobado')
                    <div class="p-4 bg-green-50 border border-green-200 rounded-xl mb-6 flex flex-col sm:flex-row gap-4 items-start">
                        <div>
                            <p class="font-bold text-green-800 mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-green-600">check_circle</span>
                                ¡Delivery aprobado! Datos del repartidor:
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-body-sm">
                                <div>
                                    <span class="font-bold text-on-surface block">Repartidor</span>
                                    <span class="text-on-surface-variant">{{ $delivery->courier_name }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-on-surface block">Placa</span>
                                    <span class="text-on-surface-variant font-mono">{{ $delivery->courier_plate }}</span>
                                </div>
                                @if($delivery->courier_phone)
                                <div>
                                    <span class="font-bold text-on-surface block">Teléfono</span>
                                    <span class="text-on-surface-variant">{{ $delivery->courier_phone }}</span>
                                </div>
                                @endif
                            </div>
                            @if($delivery->admin_notes)
                                <p class="text-body-sm text-on-surface-variant mt-2 italic">Nota: {{ $delivery->admin_notes }}</p>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- Acción principal --}}
                    <div class="border-t border-outline-variant pt-6">
                        @if($delivery->status === 'aprobado')
                            <form action="{{ route('seller.delivery.en-camino', $trato) }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                                @csrf
                                <button type="submit"
                                        class="flex items-center justify-center gap-2 px-10 py-4 bg-secondary-container text-on-secondary-container font-bold rounded-xl hover:shadow-lg transition-all active:scale-95">
                                    <span class="material-symbols-outlined">local_shipping</span>
                                    Marcar como En Camino
                                </button>
                                <p class="text-body-sm text-on-surface-variant self-center">Haz clic cuando le hayas entregado el paquete al repartidor.</p>
                            </form>
                        @elseif($delivery->status === 'pendiente')
                            <p class="text-body-sm text-on-surface-variant flex items-center gap-2">
                                <span class="material-symbols-outlined text-yellow-500">hourglass_top</span>
                                El administrador está revisando tu solicitud. Recibirás los datos del repartidor cuando sea aprobada.
                            </p>
                        @elseif($delivery->status === 'en_camino')
                            <p class="text-body-sm text-on-surface-variant flex items-center gap-2">
                                <span class="material-symbols-outlined text-secondary">local_shipping</span>
                                El paquete está en camino. Esperando confirmación del comprador.
                            </p>
                        @elseif($delivery->status === 'entregado')
                            <p class="text-body-sm text-green-700 flex items-center gap-2 font-bold">
                                <span class="material-symbols-outlined">verified</span>
                                ¡Entregado! El comprador confirmó la recepción del paquete.
                            </p>
                        @endif
                    </div>

                </div>

            </div>
        </main>
    </div>

    @include('partials.footer')
</body>
</html>
