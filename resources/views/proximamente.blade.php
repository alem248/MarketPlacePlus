<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Próximamente - Market Place</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">
    <div class="max-w-md w-full bg-white rounded-2xl p-8 text-center border border-slate-100 shadow-sm space-y-6">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-50 text-amber-500">
            <span class="material-symbols-outlined text-4xl">construction</span>
        </div>
        
        <div class="space-y-2">
            <h1 class="text-2xl font-bold text-slate-900">Sección en Desarrollo</h1>
            <p class="text-slate-500 text-sm leading-relaxed">Estamos trabajando en esta funcionalidad para mejorar tu plataforma. ¡Estará disponible muy pronto!</p>
        </div>

        <div>
            <a href="{{ url()->previous() }}" class="inline-block w-full bg-slate-900 text-white text-sm font-semibold py-3 px-4 rounded-xl hover:bg-slate-800 transition-colors">
                Regresar al panel
            </a>
        </div>
    </div>
</body>
</html>