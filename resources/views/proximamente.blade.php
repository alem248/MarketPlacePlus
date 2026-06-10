<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>En Mantenimiento - MarketPlace Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-container": "#fe9b53",
                    "on-surface-variant": "#434652",
                    "surface-container-high": "#e7e8e9",
                    "surface-container-lowest": "#ffffff",
                    "on-secondary-container": "#703500",
                    "on-background": "#191c1d",
                    "secondary": "#964900",
                    "outline-variant": "#c3c6d4",
                    "primary-container": "#254990",
                    "on-surface": "#191c1d",
                    "on-primary-fixed-variant": "#1e448b",
                    "surface-dim": "#d9dadb",
                    "surface": "#f8f9fa",
                    "secondary-fixed": "#ffdcc7",
                    "on-tertiary-fixed": "#002203",
                    "tertiary": "#003f0b",
                    "surface-container-highest": "#e1e3e4",
                    "primary-fixed": "#d9e2ff",
                    "on-primary-container": "#a1bbff",
                    "error-container": "#ffdad6",
                    "inverse-primary": "#b0c6ff",
                    "on-tertiary-container": "#8ecc87",
                    "surface-variant": "#e1e3e4",
                    "surface-container-low": "#f3f4f5",
                    "inverse-surface": "#2e3132",
                    "on-error": "#ffffff",
                    "inverse-on-surface": "#f0f1f2",
                    "primary": "#003178",
                    "surface-tint": "#3a5ca4",
                    "on-tertiary-fixed-variant": "#18511c",
                    "primary-fixed-dim": "#b0c6ff",
                    "on-secondary-fixed-variant": "#723600",
                    "on-error-container": "#93000a",
                    "on-primary-fixed": "#001945",
                    "tertiary-container": "#1e5721",
                    "error": "#ba1a1a",
                    "surface-container": "#edeeef",
                    "outline": "#737783",
                    "on-tertiary": "#ffffff",
                    "on-secondary": "#ffffff",
                    "tertiary-fixed-dim": "#98d691",
                    "on-secondary-fixed": "#311300",
                    "tertiary-fixed": "#b3f2ab",
                    "background": "#f8f9fa",
                    "surface-bright": "#f8f9fa",
                    "on-primary": "#ffffff",
                    "secondary-fixed-dim": "#ffb787"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "sidebar-width": "280px",
                    "margin-mobile": "16px",
                    "gutter": "24px",
                    "container-max": "1280px",
                    "base": "8px"
            },
            "fontFamily": {
                    "headline-lg": ["Inter"],
                    "headline-md": ["Inter"],
                    "headline-lg-mobile": ["Inter"],
                    "body-lg": ["Inter"],
                    "label-caps": ["Inter"],
                    "price-display": ["Inter"],
                    "body-sm": ["Inter"]
            },
            "fontSize": {
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                    "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700"}],
                    "price-display": ["24px", {"lineHeight": "24px", "fontWeight": "700"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .handshake-anim:hover .material-symbols-outlined {
            animation: handshake 0.5s ease-in-out infinite alternate;
        }
        @keyframes handshake {
            0% { transform: rotate(-10deg); }
            100% { transform: rotate(10deg); }
        }
        .bg-pattern {
            background-image: radial-gradient(#c3c6d4 0.5px, transparent 0.5px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-lg flex flex-col min-h-screen">

    <header class="py-4 px-margin-mobile md:px-gutter bg-surface-container-lowest border-b border-outline-variant flex items-center justify-center gap-4">
        <h1 class="font-headline-lg text-primary text-headline-lg-mobile md:text-headline-lg text-center w-full">Market Place Plus</h1>
    </header>

    <main class="flex-grow flex items-center justify-center p-gutter bg-pattern flex-col">
        <div class="max-w-2xl w-full text-center space-y-8 bg-surface-container-lowest p-12 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-outline-variant">
            
            <div class="relative inline-block">
                <div class="w-48 h-48 mx-auto flex items-center justify-center bg-primary/5 rounded-full relative">
                    <span class="material-symbols-outlined text-[120px] text-primary">construction</span>
                    <div class="absolute -bottom-2 -right-2 bg-secondary-container p-4 rounded-xl shadow-lg transform rotate-12">
                        <span class="material-symbols-outlined text-on-secondary-container text-4xl" style="font-variation-settings: 'FILL' 1;">handshake</span>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-4 h-4 bg-secondary rounded-full animate-ping"></div>
                <div class="absolute bottom-8 left-0 w-3 h-3 bg-primary rounded-full animate-pulse"></div>
            </div>

            <div class="space-y-4">
                <h1 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-primary">
                    ¡Estamos trabajando en algo nuevo!
                </h1>
                <p class="text-body-lg text-on-surface-variant max-w-lg mx-auto">
                    Esta función se encuentra actualmente en desarrollo para brindarte la mejor experiencia en tus tratos directos.
                </p>
            </div>

            <div class="pt-4">
                <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 px-10 py-4 bg-secondary text-on-secondary rounded-lg font-bold text-lg hover:brightness-110 active:translate-x-1 active:scale-95 transition-all shadow-md">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Volver
                </a>
            </div>

            <div class="pt-8 border-t border-outline-variant flex flex-col md:flex-row items-center justify-center gap-6">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-tertiary"></span>
                    <span class="text-label-caps font-label-caps text-on-surface-variant uppercase">Servidores Online</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-secondary-container"></span>
                    <span class="text-label-caps font-label-caps text-on-surface-variant uppercase">Módulo: Checkout Plus</span>
                </div>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener('mousemove', (e) => {
            const icon = document.querySelector('.w-48.h-48');
            if (icon) {
                const xAxis = (window.innerWidth / 2 - e.pageX) / 45;
                const yAxis = (window.innerHeight / 2 - e.pageY) / 45;
                icon.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
            }
        });
    </script>

    <footer class="py-8 px-margin-mobile md:px-gutter text-center">
        <p class="text-body-sm text-on-surface-variant opacity-60">Market Place Plus © 2026. Todos los derechos reservados.</p>
    </footer>

</body>
</html>