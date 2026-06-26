<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Registro | MarketPlace Plus</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/icon.png') }}">

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
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
                        "headline-lg-mobile": ["Inter"],
                        "body-sm": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-caps": ["Inter"],
                        "headline-md": ["Inter"],
                        "price-display": ["Inter"]
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
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* Custom ring for the primary blue */
        .focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 2px white, 0 0 0 4px #003178;
        }
    </style>
</head>
<body class="bg-surface text-on-surface flex flex-col min-h-screen">
    <!-- Simple Top Bar for Registration (Suppressed Nav) -->
    <header class="w-full bg-surface-container-lowest border-b border-outline-variant py-4 px-6 md:px-gutter">
        <div class="max-w-container-max mx-auto flex items-center justify-center md:justify-start">
            <img alt="MarketPlace Plus Logo" class="h-10 md:h-12 w-auto" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOFgdKXuZhxChAse2ErDkmn3PI0ycPW_dHM8dcAzLxH4XR5nS-qmgLbynCWF0eXIwCjzzNJSCMFz3ftQLLM2Z1daFELWRdkSbvo9-0om3P0Y6Ne3RW7-ylaNKUa_GXXNnTswBBQLE2sK4XpBFKZJ9m47CjGHbq87KrKwKw9HZ05HIWBv0jngQrZYx8mC4077z9u4ujKsBMRD0vuJ41mqaUrw-RPBlEqYQjaNHb4ciyZkhh162XX0Lcz_uxLDj1pzclPoxM53nyvCI">
        </div>
    </header>
    <main class="flex-grow flex items-center justify-center px-margin-mobile py-12">
        <div class="w-full max-w-[450px] bg-surface-container-lowest rounded-xl border border-outline-variant p-8 md:p-10 shadow-sm transition-all duration-300 hover:shadow-md">
            <!-- Header -->
            <div class="mb-8 text-center md:text-left">
                <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">Empieza a usar MarketPlace Plus</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant">Crea una cuenta para conectar con vendedores y realizar tratos directos.</p>
            </div>
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <!-- Name Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-label-caps text-label-caps text-outline uppercase" for="first_name">Nombre</label>
                        <input class="w-full h-12 px-4 rounded-xl border border-outline-variant bg-surface-container-low text-body-lg font-body-lg focus-ring transition-all placeholder:text-outline-variant" id="first_name" name="first_name" placeholder="Nombre" required="" type="text">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-label-caps text-label-caps text-outline uppercase" for="last_name">Apellidos</label>
                        <input class="w-full h-12 px-4 rounded-xl border border-outline-variant bg-surface-container-low text-body-lg font-body-lg focus-ring transition-all placeholder:text-outline-variant" id="last_name" name="last_name" placeholder="Apellidos" required="" type="text">
                    </div>
                </div>
                <!-- DOB -->
                <div class="space-y-1.5">
                    <label class="font-label-caps text-label-caps text-outline uppercase flex items-center gap-1" for="dob">
                        Fecha de nacimiento
                        <span class="material-symbols-outlined text-[16px] cursor-help" title="Ayuda">help</span>
                    </label>
                    <input class="w-full h-12 px-4 rounded-xl border border-outline-variant bg-surface-container-low text-body-lg font-body-lg focus-ring transition-all placeholder:text-outline-variant" id="dob" name="dob" required="" type="text">
                </div>
                <!-- Gender -->
                <div class="space-y-1.5">
                    <label class="font-label-caps text-label-caps text-outline uppercase flex items-center gap-1" for="gender">
                        Género
                        <span class="material-symbols-outlined text-[16px] cursor-help" title="Ayuda">help</span>
                    </label>
                    <select class="w-full h-12 px-4 rounded-xl border border-outline-variant bg-surface-container-low text-body-lg font-body-lg focus-ring transition-all appearance-none cursor-pointer" id="gender" name="gender">
                        <option disabled="" selected="" value="">Selecciona tu género</option>
                        <option value="male">Hombre</option>
                        <option value="female">Mujer</option>
                        <option value="other">Otro</option>
                        <option value="prefer_not_to_say">Prefiero no decirlo</option>
                    </select>
                </div>
                <!-- Contact / WhatsApp -->
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="font-label-caps text-label-caps text-outline uppercase" for="email">Correo electrónico</label>
                        <input class="w-full h-12 px-4 rounded-xl border border-outline-variant bg-surface-container-low text-body-lg font-body-lg focus-ring transition-all placeholder:text-outline-variant" id="email" name="email" placeholder="ejemplo@correo.com" required="" type="email">
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-caps text-label-caps text-outline uppercase" for="phone">Número de WhatsApp</label>
                        <div class="flex items-center">
                            <span class="h-12 flex items-center px-4 bg-surface-container-high border border-r-0 border-outline-variant rounded-l-xl text-on-surface font-body-lg">+</span>
                            <input class="w-full h-12 px-4 rounded-r-xl border border-outline-variant bg-surface-container-low text-body-lg font-body-lg focus-ring transition-all placeholder:text-outline-variant" id="phone" name="phone" placeholder="Número de WhatsApp" required="" type="tel">
                        </div>
                        <p class="text-[11px] text-primary font-semibold italic flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">info</span>
                            Ingresa un número con WhatsApp para realizar tus tratos
                        </p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Incluye el código de tu país. Ejemplo: 519XXXXXXXX</p>
                    </div>
                </div>
                <!-- Password -->
                <div class="space-y-1.5">
                    <label class="font-label-caps text-label-caps text-outline uppercase" for="password">Contraseña</label>
                    <input class="w-full h-12 px-4 rounded-xl border border-outline-variant bg-surface-container-low text-body-lg font-body-lg focus-ring transition-all placeholder:text-outline-variant" id="password" name="password" placeholder="Nueva contraseña" required="" type="password">
                </div>
                <!-- Submit -->
                <div class="pt-4 space-y-4">
                    <button class="w-full h-14 bg-primary text-on-primary font-headline-md text-headline-md rounded-xl hover:bg-primary-container transition-all active:scale-[0.98] shadow-lg shadow-primary/10" type="submit">
                        Registrar
                    </button>
                    <a class="block w-full text-center py-3 text-primary font-body-lg hover:underline decoration-2 underline-offset-4 transition-all" href="{{ route('login') }}">
                        Ya tengo una cuenta
                    </a>
                </div>
            </form>
        </div>
    </main>
    <!-- Footer Cluster (Simplified for registration flow) -->
    <footer class="w-full bg-inverse-surface py-8 px-6 md:px-gutter mt-auto">
        <div class="max-w-container-max mx-auto text-center md:text-left">
            <div class="flex flex-wrap justify-center md:justify-start gap-4 mb-6">
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">Español</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">English (US)</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">Italiano</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">Português</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">Français</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-x-4 gap-y-2 mb-8">
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">Registrarte</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="{{ route('login') }}">Iniciar sesión</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">Mis Tratos</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">Centro de Ayuda</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">Sobre Nosotros</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="#">Condiciones</a>
            </div>
            <p class="text-surface-variant font-body-sm opacity-60">
                Market Place Plus - eCommerce Template © 2026. Design by Templatecookie
            </p>
        </div>
    </footer>
    <script>
        // Micro-interactions for form focus states
        const inputs = document.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('border-primary');
            });
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('border-primary');
            });
        });
    </script>
    <!-- Formato del calendario y arreglar el error de la fecha -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#dob", {
                locale: "es", // Calendario en español
                altInput: true, // Crea un campo visual alternativo
                altFormat: "d/m/Y", // El usuario verá: 24/08/2006
                dateFormat: "Y-m-d", // Laravel recibirá: 2006-08-24 (¡Adiós error!)
                maxDate: "today", // Evita que seleccionen fechas del futuro
                disableMobile: true // Mejora la experiencia en celulares
            });
        });
    </script>


</body>

</html>