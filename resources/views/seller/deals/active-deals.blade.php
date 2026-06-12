<!DOCTYPE html>
<html class="light" lang="es" style="">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#c3c6d4",
                        "secondary-container": "#fc820c",
                        "on-surface-variant": "#434652",
                        "surface": "#f8f9fa",
                        "tertiary": "#003f0b",
                        "primary-container": "#254990",
                        "secondary": "#964900",
                        "primary-fixed": "#d9e2ff",
                        "on-tertiary-fixed": "#002203",
                        "outline": "#737783",
                        "surface-variant": "#e1e3e4",
                        "tertiary-fixed-dim": "#98d691",
                        "inverse-primary": "#b0c6ff",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed": "#b3f2ab",
                        "surface-tint": "#3a5ca4",
                        "on-primary": "#ffffff",
                        "surface-bright": "#f8f9fa",
                        "on-tertiary": "#ffffff",
                        "on-background": "#191c1d",
                        "on-secondary-fixed": "#311300",
                        "on-primary-fixed": "#001945",
                        "on-primary-fixed-variant": "#1e448b",
                        "secondary-fixed": "#ffdcc7",
                        "secondary-fixed-dim": "#ffb787",
                        "on-tertiary-container": "#8ecc87",
                        "surface-container-low": "#f3f4f5",
                        "error-container": "#ffdad6",
                        "on-error": "#ffffff",
                        "surface-container-highest": "#e1e3e4",
                        "inverse-surface": "#2e3132",
                        "surface-dim": "#d9dadb",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed-variant": "#18511c",
                        "inverse-on-surface": "#f0f1f2",
                        "tertiary-container": "#1e5721",
                        "error": "#ba1a1a",
                        "on-primary-container": "#a1bbff",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed-variant": "#723600",
                        "surface-container": "#edeeef",
                        "on-surface": "#191c1d",
                        "surface-container-high": "#e7e8e9",
                        "on-secondary-container": "#703500",
                        "primary": "#003178",
                        "background": "#f8f9fa",
                        "primary-fixed-dim": "#b0c6ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "container-max": "1280px",
                        "margin-mobile": "16px",
                        "sidebar-width": "280px",
                        "base": "8px"
                    },
                    "fontFamily": {
                        "label-caps": ["Inter"],
                        "price-display": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-sm": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    "fontSize": {
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "700"
                        }],
                        "price-display": ["24px", {
                            "lineHeight": "24px",
                            "fontWeight": "700"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-sm": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "headline-md": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .active-tab-indicator {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .deal-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="bg-surface text-on-surface">
    <!-- TopNavBar -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-surface dark:bg-on-surface border-b border-outline-variant dark:border-outline flex justify-between items-center px-gutter h-16 w-full">
        <div class="flex items-center gap-4">
            <span class="font-headline-md text-headline-md font-black text-primary dark:text-primary-fixed">Market Place Plus</span>
        </div>
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary dark:text-primary-fixed cursor-pointer active:scale-95 transition-colors hover:bg-surface-container-high dark:hover:bg-surface-variant p-2 rounded-full">notifications</span>
                <span class="material-symbols-outlined text-primary dark:text-primary-fixed cursor-pointer active:scale-95 transition-colors hover:bg-surface-container-high dark:hover:bg-surface-variant p-2 rounded-full">settings</span>
            </div>
            <div class="flex items-center gap-3 pl-4 border-l border-outline-variant">
                <div class="text-right hidden md:block">
                    <p class="font-label-caps text-label-caps text-on-surface">Vendedor Premium</p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Carlos Méndez</p>
                </div>
                <img alt="Vendedor Avatar" class="w-10 h-10 rounded-full border border-outline-variant" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAknvaci1-Hh2dnJmjRo0DT_TlOJnCZv95LI3w3lmGcJseFcO_HTtpw3niocmMDh_5U5UrvwgMnsfkLPGHzhb2cGY3wSFT0-BKHGDEvC8gJO2KWYcwjzPRs0ACAI3BdceVzwx3KAhDoDbQl-k1S_VfRu97STEKSDzdfaSXKAhZnACg3ubPZiUSOSBbNabQ0N-1lePCSuWFWAtxFT3ajSonuV68zpk31Kgj3EusvrSvmgueB9lSL2Zdc5m_1lGA80tUCHNuJkoiM6wI">
            </div>
        </div>
    </header>
    <!-- Sidebar & Main Content Wrapper -->
    <div class="flex pt-16 min-h-screen">
        <!-- SideNavBar -->
        <aside class="fixed left-0 top-0 h-full w-sidebar-width bg-surface-container-lowest dark:bg-on-surface border-r border-outline-variant dark:border-outline py-4 flex flex-col hidden md:flex z-40 pt-20">
            <div class="px-6 mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <img alt="Avatar del Vendedor" class="w-12 h-12 rounded-xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDr10p-VcTaNsz6Gte-0mcspz6XaOKlTouskEdl1E1WqjwNVYZwo_deQV43F_nQb5YkwC8htBXufNO0SwNvzCD2JngIME98nuhHnpsHmzBaU7-zi3fqxWexrCHMVHwhmgq2RPeh3TLLFBmSK7LIw_jjqXMdAbXfpDMVYvTI8vlFnH_y8LryWz4WQvAD9I_7w6jLx2xdBJnne7rnhM2C68Qeep4LCL3UgWkvdw-3a6-nacLHNiT8g4dZBm_4DMriYkI-VCKIOEVAAY4">
                    <div>
                        <h3 class="font-headline-md text-body-lg font-bold text-primary">Vendedor</h3>
                        <p class="text-xs text-tertiary-container flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-tertiary"></span> Estado: Online
                        </p>
                    </div>
                </div>
                <button class="w-full mt-4 py-2 px-4 rounded-xl border border-secondary text-secondary font-label-caps text-label-caps hover:bg-secondary-fixed transition-colors active:scale-98">
                    Cambiar a Cliente
                </button>
            </div>
            <nav class="flex-grow">
                <a class="text-on-surface-variant dark:text-surface-variant mx-2 my-1 px-4 py-3 flex items-center gap-3 hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all active:scale-98" href="#">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-body-lg text-body-lg">Panel</span>
                </a>
                <a class="text-on-surface-variant dark:text-surface-variant mx-2 my-1 px-4 py-3 flex items-center gap-3 hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all active:scale-98" href="#">
                    <span class="material-symbols-outlined">add_box</span>
                    <span class="font-body-lg text-body-lg">Crear Publicación</span>
                </a>
                <!-- Active Tab: Mis Tratos -->
                <a class="bg-primary text-on-primary rounded-xl mx-2 my-1 px-4 py-3 flex items-center gap-3 active:scale-98 duration-200" href="#">
                    <span class="material-symbols-outlined">handshake</span>
                    <span class="font-body-lg text-body-lg">Mis Tratos</span>
                </a>

                <a class="text-on-surface-variant dark:text-surface-variant mx-2 my-1 px-4 py-3 flex items-center gap-3 hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all active:scale-98" href="#">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="font-body-lg text-body-lg">Delivery</span>
                </a>
                <a class="text-on-surface-variant dark:text-surface-variant mx-2 my-1 px-4 py-3 flex items-center gap-3 hover:bg-surface-container-high dark:hover:bg-surface-variant rounded-xl transition-all active:scale-98" href="#">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span class="font-body-lg text-body-lg">Mis Comprobantes</span>
                </a>
            </nav>
        </aside>
        <!-- Main Content Area -->
        <main class="flex-grow md:ml-sidebar-width p-gutter bg-surface">
            <div class="max-w-5xl mx-auto">
                <header class="mb-8">
                    <h1 class="font-headline-lg text-headline-lg text-on-surface">Mis Tratos Directos</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Gestiona tus negociaciones activas y cierra acuerdos exitosos.</p>
                </header>
                <!-- Filter Chips (Atmospheric Interaction) -->
                <div class="flex gap-3 mb-8 overflow-x-auto pb-2">
                    <button class="px-5 py-2 rounded-full bg-primary text-on-primary font-label-caps text-label-caps">Todos (12)</button>
                    <button class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-label-caps text-label-caps hover:bg-outline-variant transition-colors">En discusión (5)</button>
                    <button class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-label-caps text-label-caps hover:bg-outline-variant transition-colors">Aceptados (4)</button>
                    <button class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-label-caps text-label-caps hover:bg-outline-variant transition-colors">Pendiente Pago (3)</button>
                </div>
                <!-- Deal List (Bento-ish Flex) -->
                <div class="grid grid-cols-1 gap-4">
                    <!-- Deal Item 1 -->
                    <div class="deal-card flex flex-col md:flex-row items-center gap-6 p-5 bg-surface-container-lowest border border-outline-variant rounded-xl transition-all duration-300 group">
                        <div class="w-full md:w-24 h-24 rounded-lg overflow-hidden bg-surface-container">
                            <img alt="Product image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="A pair of vibrant red professional running shoes placed on a sleek, white reflective surface under cool, bright studio lighting. The aesthetic is clean, commercial, and high-quality, focusing on the texture and modern design of the athletic footwear with sharp focus and subtle shadows." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDi6WQX02aV_04GuA0543gDE4i-sCWzqidGT_kLRRgqfa2YH7sUCyn5ez8tvL4bJ4Wpfu_-9rDrxKg7mW2UHiPs5X6md5xqiiwIm47eFDKTFo823YEN1oiBiIiaIF2pVZDaJ9OtOTq_y69j8KvNGy3rbYqieipdmcfifB0pV3FpH809Rnh9hQOZ2SUc0uUIS0NI9_c-0cNr58hDq5_diVicsYX6zfWo0tz4ZS1nJlVXZRLFecp8CNLq1L84N3UzJimu4irTrHqjdqU">
                        </div>
                        <div class="flex-grow space-y-1 w-full text-center md:text-left">
                            <h3 class="font-headline-md text-body-lg font-bold text-on-surface">Zapatillas Runner Pro X</h3>
                            <div class="flex items-center justify-center md:justify-start gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-sm">person</span>
                                <span class="font-body-sm text-body-sm">Comprador: Marco Aurelio</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center md:items-end w-full md:w-48">
                            <span class="font-price-display text-price-display text-secondary">S/. 349.00</span>
                            <span class="px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-caps text-[10px] mt-1 uppercase tracking-wider">En discusión</span>
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <button class="flex-grow md:flex-none px-6 py-2.5 bg-secondary-container text-on-primary font-bold rounded-lg hover:brightness-110 active:scale-95 transition-all shadow-sm">
                                Ver Detalles
                            </button>
                            <button class="p-2.5 border border-outline text-on-surface-variant rounded-lg hover:bg-surface-container-high transition-colors active:scale-95">
                                <span class="material-symbols-outlined">chat</span>
                            </button>
                        </div>
                    </div>
                    <!-- Deal Item 2 -->
                    <div class="deal-card flex flex-col md:flex-row items-center gap-6 p-5 bg-surface-container-lowest border border-outline-variant rounded-xl transition-all duration-300 group">
                        <div class="w-full md:w-24 h-24 rounded-lg overflow-hidden bg-surface-container">
                            <img alt="Product image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="A premium minimalist white ceramic analog watch with a clean face and silver hands, photographed in a high-key, airy studio setting. The lighting is soft and diffuse, emphasizing a professional, trustworthy, and sophisticated lifestyle product aesthetic with neutral tones and elegant clarity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAX8rYMF4JsDB_8FFQefWKSQReB5tI7QdzUA1r3vczC6HPGkVNLnafHxO0JtY9IVyvIcwre07uoCiY2jUJmC-PXB7V09uEZzaoratBmSqnfCG1FI83gHjfsn4b43RqH8QwZi6neCWNcAp4_y2g7Ph48fMMdxEJGz-5Nih66y6T2Vr82DwL0siFi230R6ECup2z6miesVY74iwNIxSW4eMtvWGG6fr6ZZTnCPvAEhuTfKUy4QF8HaeLVOOLMGKurThgrI_C5MMm_5t0">
                        </div>
                        <div class="flex-grow space-y-1 w-full text-center md:text-left">
                            <h3 class="font-headline-md text-body-lg font-bold text-on-surface">Reloj Minimalist Blanco</h3>
                            <div class="flex items-center justify-center md:justify-start gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-sm">person</span>
                                <span class="font-body-sm text-body-sm">Comprador: Elena Valeri</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center md:items-end w-full md:w-48">
                            <span class="font-price-display text-price-display text-secondary">S/. 185.00</span>
                            <span class="px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-caps text-[10px] mt-1 uppercase tracking-wider">Aceptado</span>
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <button class="flex-grow md:flex-none px-6 py-2.5 bg-secondary-container text-on-primary font-bold rounded-lg hover:brightness-110 active:scale-95 transition-all shadow-sm">
                                Ver Detalles
                            </button>
                            <button class="p-2.5 border border-outline text-on-surface-variant rounded-lg hover:bg-surface-container-high transition-colors active:scale-95">
                                <span class="material-symbols-outlined">chat</span>
                            </button>
                        </div>
                    </div>
                    <!-- Deal Item 3 -->
                    <div class="deal-card flex flex-col md:flex-row items-center gap-6 p-5 bg-surface-container-lowest border border-outline-variant rounded-xl transition-all duration-300 group">
                        <div class="w-full md:w-24 h-24 rounded-lg overflow-hidden bg-surface-container">
                            <img alt="Product image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Modern professional over-ear headphones in matte black and gold accents, resting on a polished dark wood surface. The scene is illuminated by warm, cinematic ambient light, creating a high-trust, premium e-commerce mood that highlights metallic textures and high-fidelity sound quality." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeYSkABor9iFfmfFEf0aYzftEnZxjbfdCuyGsTSd31OgT7pkPcFlb6VJmoIVcaeKkmff40mEIJZ0xN5gIgifxz5MIutW1Yi-DgoTgNFEO1wspEpuatEETkjse_N1NVCyYx3WzvqRKJRVXtarjclIlMuzew1HkvYd7WtXVNxzsNaySOZvUvLAuRXpXVnjgsH-xJc30z_akIIRdXIiuPDz2bvziA3daDtbnhavooUk_YIeKmEZNas1LS6SOCRYNc2yscc50SSp08QQw">
                        </div>
                        <div class="flex-grow space-y-1 w-full text-center md:text-left">
                            <h3 class="font-headline-md text-body-lg font-bold text-on-surface">Audífonos Studio Pro</h3>
                            <div class="flex items-center justify-center md:justify-start gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-sm">person</span>
                                <span class="font-body-sm text-body-sm">Comprador: Roberto Díaz</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center md:items-end w-full md:w-48">
                            <span class="font-price-display text-price-display text-secondary">S/. 420.00</span>
                            <span class="px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-caps text-[10px] mt-1 uppercase tracking-wider">Pendiente de Pago</span>
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <button class="flex-grow md:flex-none px-6 py-2.5 bg-secondary-container text-on-primary font-bold rounded-lg hover:brightness-110 active:scale-95 transition-all shadow-sm">
                                Ver Detalles
                            </button>
                            <button class="p-2.5 border border-outline text-on-surface-variant rounded-lg hover:bg-surface-container-high transition-colors active:scale-95">
                                <span class="material-symbols-outlined">chat</span>
                            </button>
                        </div>
                    </div>
                    <!-- Deal Item 4 -->
                    <div class="deal-card flex flex-col md:flex-row items-center gap-6 p-5 bg-surface-container-lowest border border-outline-variant rounded-xl transition-all duration-300 group">
                        <div class="w-full md:w-24 h-24 rounded-lg overflow-hidden bg-surface-container">
                            <img alt="Product image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="A pair of stylish, high-end designer sunglasses with dark lenses and a sleek tortoiseshell frame, displayed in a bright, modern retail environment. The lighting is crisp and natural, reflecting the professional and trendy spirit of a high-trust boutique marketplace, with clear attention to detail." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0PV49yVNX0QFLd2FWEE-oC4qK7l7rbfTGN8G-7vZ_IN1Gnb149KQdkv5nFxbsV15XaUxqw50N8FzRrGCZYLyhSfJnY7-qyn3GunqpJw3BZgexRGXIKP38Kg9geLy4oGkSK6qNGE7dr_hulXq8Sil9GtCfKMdXe9hOxuteJxibHgpKimGgvk71i82_ODSYq52sUSg16xyGdnYsf2nhv0jayp0ctTko7NfEd-x_uCioq1jVMY2q_Eqrmrwrv77BLFcD7JiyJ_KNx_U">
                        </div>
                        <div class="flex-grow space-y-1 w-full text-center md:text-left">
                            <h3 class="font-headline-md text-body-lg font-bold text-on-surface">Lentes de Sol Urban Style</h3>
                            <div class="flex items-center justify-center md:justify-start gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-sm">person</span>
                                <span class="font-body-sm text-body-sm">Comprador: Lucía Torres</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-center md:items-end w-full md:w-48">
                            <span class="font-price-display text-price-display text-secondary">S/. 125.50</span>
                            <span class="px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-label-caps text-[10px] mt-1 uppercase tracking-wider">En discusión</span>
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <button class="flex-grow md:flex-none px-6 py-2.5 bg-secondary-container text-on-primary font-bold rounded-lg hover:brightness-110 active:scale-95 transition-all shadow-sm">
                                Ver Detalles
                            </button>
                            <button class="p-2.5 border border-outline text-on-surface-variant rounded-lg hover:bg-surface-container-high transition-colors active:scale-95">
                                <span class="material-symbols-outlined">chat</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Footer -->
    <footer class="w-full py-12 px-gutter grid grid-cols-1 md:grid-cols-3 gap-8 bg-inverse-surface dark:bg-surface-container-lowest text-secondary-fixed dark:text-secondary">
        <div class="space-y-4">
            <span class="font-label-caps text-label-caps text-primary-fixed">MARKET PLACE PLUS</span>
            <p class="font-body-sm text-body-sm text-surface-variant opacity-80">© 2024 Market Place Plus - Plataforma de Tratos Directos. Empoderando a vendedores locales con tecnología de punta y transacciones seguras.</p>
        </div>
        <div class="flex flex-col gap-2">
            <h4 class="font-bold text-secondary-fixed mb-2">Enlaces Rápidos</h4>
            <a class="text-surface-variant opacity-80 hover:text-secondary-fixed-dim underline transition-all font-body-sm text-body-sm" href="#">Términos de Servicio</a>
            <a class="text-surface-variant opacity-80 hover:text-secondary-fixed-dim underline transition-all font-body-sm text-body-sm" href="#">Privacidad</a>
            <a class="text-surface-variant opacity-80 hover:text-secondary-fixed-dim underline transition-all font-body-sm text-body-sm" href="#">Dashboard Admin</a>
        </div>
        <div class="flex flex-col gap-2">
            <h4 class="font-bold text-secondary-fixed mb-2">Soporte y Ayuda</h4>
            <a class="text-surface-variant opacity-80 hover:text-secondary-fixed-dim underline transition-all font-body-sm text-body-sm" href="#">Centro de Ayuda</a>
            <a class="text-surface-variant opacity-80 hover:text-secondary-fixed-dim underline transition-all font-body-sm text-body-sm" href="#">Guía del Vendedor</a>
            <a class="text-surface-variant opacity-80 hover:text-secondary-fixed-dim underline transition-all font-body-sm text-body-sm" href="#">Recomendaciones de Seguridad</a>
        </div>
    </footer>
    <script>
        // Micro-interaction for hover effects on deal cards
        document.querySelectorAll('.deal-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                // Potential logic for dynamic price updates or visual cues
            });
        });

        // Floating handshake animation simulation on the active nav icon
        const handshakeIcon = document.querySelector('[data-icon="handshake"]');
        if (handshakeIcon) {
            setInterval(() => {
                handshakeIcon.classList.add('scale-110');
                setTimeout(() => handshakeIcon.classList.remove('scale-110'), 200);
            }, 5000);
        }
    </script>


</body>

</html>