<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Iniciar Sesión | MarketPlace Plus</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "inverse-surface": "#2e3132",
                        "on-error": "#ffffff",
                        "primary-fixed-dim": "#b0c6ff",
                        "background": "#f8f9fa",
                        "secondary-fixed": "#ffdcc6",
                        "surface-container-highest": "#e1e3e4",
                        "on-secondary-fixed": "#311300",
                        "primary-container": "#0d47a1",
                        "tertiary": "#003f0b",
                        "inverse-primary": "#b0c6ff",
                        "on-primary-fixed-variant": "#00429c",
                        "surface-dim": "#d9dadb",
                        "surface-tint": "#2b5bb5",
                        "error": "#ba1a1a",
                        "tertiary-container": "#005914",
                        "on-primary-container": "#a1bbff",
                        "surface-variant": "#e1e3e4",
                        "on-surface": "#191c1d",
                        "surface-bright": "#f8f9fa",
                        "secondary-fixed-dim": "#ffb786",
                        "outline": "#737783",
                        "on-secondary-container": "#5e2c00",
                        "tertiary-fixed-dim": "#88d982",
                        "secondary-container": "#fc820c",
                        "primary": "#003178",
                        "surface-container-lowest": "#ffffff",
                        "inverse-on-surface": "#f0f1f2",
                        "error-container": "#ffdad6",
                        "on-background": "#191c1d",
                        "surface-container": "#edeeef",
                        "tertiary-fixed": "#a3f69c",
                        "surface-container-low": "#f3f4f5",
                        "on-primary-fixed": "#001945",
                        "on-tertiary-fixed": "#002204",
                        "on-tertiary-fixed-variant": "#005312",
                        "surface": "#f8f9fa",
                        "on-secondary-fixed-variant": "#723600",
                        "on-tertiary-container": "#7ecf79",
                        "secondary": "#964900",
                        "outline-variant": "#c3c6d4",
                        "surface-container-high": "#e7e8e9",
                        "on-error-container": "#93000a",
                        "primary-fixed": "#d9e2ff",
                        "on-surface-variant": "#434652",
                        "on-tertiary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "base": "8px",
                        "sidebar-width": "280px",
                        "margin-mobile": "16px",
                        "container-max": "1280px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Inter", "sans-serif"],
                        "headline-md": ["Inter", "sans-serif"],
                        "body-lg": ["Inter", "sans-serif"],
                        "body-sm": ["Inter", "sans-serif"],
                        "label-caps": ["Inter", "sans-serif"],
                        "price-display": ["Inter", "sans-serif"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }],
                        "body-sm": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "700"
                        }],
                        "headline-md": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "price-display": ["24px", {
                            "lineHeight": "24px",
                            "fontWeight": "700"
                        }]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .hero-pattern {
            background-color: #f8f9fa;
            background-image: radial-gradient(#e1e3e4 0.5px, transparent 0.5px);
            background-size: 24px 24px;
        }

        .custom-shadow {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
        }

        .form-input:focus {
            outline: none;
            border-color: #003178;
            box-shadow: 0 0 0 1px #003178;
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body-lg overflow-x-hidden">
    <main class="min-h-screen flex flex-col md:flex-row items-center justify-center px-margin-mobile md:px-gutter hero-pattern">
        <!-- Left Side: Branding & Tagline -->
        <div class="w-full md:w-1/2 flex flex-col items-center md:items-start text-center md:text-left mb-gutter md:mb-0 max-w-lg">
            <div class="mb-gutter">
                <img alt="MarketPlace Plus Logo" class="h-24 md:h-32 object-contain animate-fade-in" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOFgdKXuZhxChAse2ErDkmn3PI0ycPW_dHM8dcAzLxH4XR5nS-qmgLbynCWF0eXIwCjzzNJSCMFz3ftQLLM2Z1daFELWRdkSbvo9-0om3P0Y6Ne3RW7-ylaNKUa_GXXNnTswBBQLE2sK4XpBFKZJ9m47CjGHbq87KrKwKw9HZ05HIWBv0jngQrZYx8mC4077z9u4ujKsBMRD0vuJ41mqaUrw-RPBlEqYQjaNHb4ciyZkhh162XX0Lcz_uxLDj1pzclPoxM53nyvCI">
            </div>
            <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-4 leading-tight">
                Explora lo que <span class="text-secondary">más te gusta</span>.
            </h1>
            <p class="text-on-surface-variant font-body-lg opacity-80">
                La plataforma de confianza para tus tratos directos. Compra y vende de forma segura conectando directamente a través de WhatsApp.
            </p>
            <!-- Atmospheric Graphic Element inspired by Facebook visual -->
            <div class="mt-12 hidden md:block relative w-full h-64">
                <div class="absolute top-0 left-0 w-32 h-32 bg-secondary-container rounded-xl rotate-3 opacity-10 animate-pulse"></div>
                <div class="absolute bottom-0 right-10 w-48 h-48 bg-primary opacity-5 rounded-full blur-3xl"></div>
                <div class="absolute top-10 left-20">
                    <span class="material-symbols-outlined text-secondary text-[48px]" style="font-variation-settings: 'FILL' 1;">handshake</span>
                </div>
                <div class="absolute bottom-10 right-40">
                    <span class="material-symbols-outlined text-primary text-[64px]" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
                </div>
            </div>
        </div>
        <!-- Right Side: Login Card -->
        <div class="w-full md:w-[400px] flex flex-col items-center">
            <div class="bg-surface-container-lowest p-gutter rounded-xl custom-shadow border border-outline-variant w-full">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-gutter text-center md:text-left">Iniciar sesión en MarketPlace Plus</h2>
                @if ($errors->any())
                <div class="bg-error-container text-on-error-container p-3 rounded-lg text-body-sm font-semibold mb-4 border border-error text-center">
                    {{ $errors->first() }}
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="font-label-caps text-label-caps text-on-surface-variant" for="email">Correo electrónico o número celular</label>
                            <input class="w-full p-3 border @error('email') border-error @else border-outline-variant @enderror rounded-lg form-input text-body-lg" id="email" placeholder="Ingresa tu correo o teléfono" type="text" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="space-y-1">
                            <label class="font-label-caps text-label-caps text-on-surface-variant" for="password">Contraseña</label>
                            <input class="w-full p-3 border @error('password') border-error @else border-outline-variant @enderror rounded-lg form-input text-body-lg mb-4" id="password" placeholder="Tu contraseña" type="password" name="password">
                            <button type="submit" class="w-full bg-primary text-on-primary font-headline-md py-3 rounded-lg hover:brightness-110 active:scale-[0.98] transition-all">
                                Iniciar sesión
                            </button>
                        </div>
                    </div>
                </form>
                <div class="mt-4 text-center">
                    <a class="text-primary font-body-sm hover:underline" href="#">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="my-6 border-t border-outline-variant relative">
                    <span class="absolute left-1/2 -top-3 -translate-x-1/2 bg-surface-container-lowest px-2 text-label-caps text-on-surface-variant">o</span>
                </div>
                <div class="flex justify-center">
                    <a href="{{ route('register') }}" id="btn-create-account" class="bg-tertiary-container text-on-tertiary font-headline-md py-2 px-12 rounded-lg hover:brightness-110 active:scale-95 transition-all text-center inline-block">
                        Crear Cuenta Nueva
                    </a>
                </div>
            </div>
            <p class="mt-gutter text-body-sm text-on-surface-variant text-center">
                <span class="font-bold text-primary">Crea una Página</span> para un negocio, una marca o un servicio.
            </p>
        </div>
    </main>
    <!-- Simple Footer (Suppressed active navigation as per Transactional rule, but keeping basic links) -->
    <footer class="w-full py-12 px-margin-mobile md:px-gutter max-w-container-max mx-auto border-t border-outline-variant mt-gutter">
        <div class="flex flex-wrap gap-4 text-on-surface-variant text-body-sm justify-center md:justify-start mb-6">
            <span>Español</span>
            <span>English (US)</span>
            <span>Italiano</span>
            <span>Português (Brasil)</span>
            <span>Français (France)</span>
            <span>Deutsch</span>
            <button class="p-1 border border-outline-variant rounded"><span class="material-symbols-outlined text-[16px]">add</span></button>
        </div>
        <div class="flex flex-wrap gap-x-6 gap-y-2 text-on-surface-variant text-body-sm justify-center md:justify-start opacity-70">
            <a class="hover:underline" href="#">Registrarte</a>
            <a class="hover:underline" href="#">Iniciar sesión</a>
            <a class="hover:underline" href="#">Mis tratos</a>
            <a class="hover:underline" href="#">Rastrear pedido</a>
            <a class="hover:underline" href="#">Ayuda al cliente</a>
            <a class="hover:underline" href="#">Sobre nosotros</a>
            <a class="hover:underline" href="#">Privacidad</a>
            <a class="hover:underline" href="#">Condiciones</a>
        </div>
        <p class="mt-8 text-on-surface-variant text-body-sm font-label-caps text-center md:text-left">
            Market Place Plus - eCommerce Template © 2026. Design by Templatecookie
        </p>
    </footer>
    <!-- Registration Modal (Triggered by 'Crear cuenta nueva') -->
    <div class="fixed inset-0 bg-inverse-surface/60 flex items-center justify-center p-margin-mobile z-50 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-surface-container-lowest rounded-xl custom-shadow w-full max-w-md overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="p-gutter border-b border-outline-variant flex justify-between items-start">
                <div>
                    <h2 class="font-headline-lg text-headline-lg-mobile text-on-surface">Registrarte</h2>
                    <p class="text-on-surface-variant text-body-sm">Es rápido y fácil.</p>
                </div>
                <button class="text-on-surface-variant hover:text-on-surface" id="close-modal">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-gutter space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <input class="w-full p-3 border border-outline-variant rounded-lg form-input text-body-lg" placeholder="Nombre" type="text">
                    <input class="w-full p-3 border border-outline-variant rounded-lg form-input text-body-lg" placeholder="Apellido" type="text">
                </div>
                <input class="w-full p-3 border border-outline-variant rounded-lg form-input text-body-lg" placeholder="Número de celular o correo electrónico" type="text">
                <input class="w-full p-3 border border-outline-variant rounded-lg form-input text-body-lg" placeholder="Contraseña nueva" type="password">
                <div class="space-y-2">
                    <label class="font-label-caps text-on-surface-variant text-[10px]">Fecha de nacimiento</label>
                    <div class="grid grid-cols-3 gap-2">
                        <select class="p-2 border border-outline-variant rounded-lg bg-surface-container-low text-body-sm">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                        <select class="p-2 border border-outline-variant rounded-lg bg-surface-container-low text-body-sm">
                            <option>Ene</option>
                            <option>Feb</option>
                            <option>Mar</option>
                        </select>
                        <select class="p-2 border border-outline-variant rounded-lg bg-surface-container-low text-body-sm">
                            <option>2026</option>
                            <option>2025</option>
                            <option>2024</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-label-caps text-on-surface-variant text-[10px]">Género</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center justify-between p-2 border border-outline-variant rounded-lg cursor-pointer">
                            <span class="text-body-sm">Mujer</span>
                            <input class="text-primary" name="gender" type="radio">
                        </label>
                        <label class="flex items-center justify-between p-2 border border-outline-variant rounded-lg cursor-pointer">
                            <span class="text-body-sm">Hombre</span>
                            <input class="text-primary" name="gender" type="radio">
                        </label>
                        <label class="flex items-center justify-between p-2 border border-outline-variant rounded-lg cursor-pointer">
                            <span class="text-body-sm">Personalizado</span>
                            <input class="text-primary" name="gender" type="radio">
                        </label>
                    </div>
                </div>
                <p class="text-[11px] text-on-surface-variant leading-tight">
                    Al hacer clic en "Registrarte", aceptas nuestras Condiciones, la Política de privacidad y la Política de cookies. Es posible que te enviemos notificaciones por SMS, que puedes desactivar cuando quieras.
                </p>
                <div class="flex justify-center pt-2">
                    <button class="bg-tertiary-container text-on-tertiary font-headline-md py-2 px-12 rounded-lg hover:brightness-110 active:scale-95 transition-all">
                        Registrarte
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const openBtn = document.getElementById('btn-create-account');
        const closeBtn = document.getElementById('close-modal');

        openBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modal.querySelector('div').classList.remove('scale-95');
                modal.querySelector('div').classList.add('scale-100');
            }, 10);
        });

        closeBtn.addEventListener('click', () => {
            modal.classList.remove('opacity-100');
            modal.querySelector('div').classList.remove('scale-100');
            modal.querySelector('div').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        });

        // Close on clicking backdrop
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeBtn.click();
            }
        });
    </script>
</body>

</html>