<nav class="bg-surface border-b border-outline-variant fixed w-full top-0 z-50">
    <div class="flex justify-between items-center px-gutter py-base w-full max-w-container-max mx-auto h-16">
        <div class="flex items-center gap-4">
            <span class="font-headline-md text-headline-md font-bold text-primary">MarketPlace Plus</span>
        </div>
        <div class="hidden md:flex items-center">
            <h1 class="font-headline-md text-headline-md text-on-surface">¿Qué vamos a vender hoy?</h1>
        </div>
        <div class="hidden md:flex items-center gap-6">
            <a href="{{ route('seller.products.create') }}"
               class="bg-secondary-container text-on-secondary-container px-6 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:opacity-90 transition-all">
                <span class="material-symbols-outlined">add_circle</span>
                Crear Publicación
            </a>
        </div>
    </div>
</nav>
