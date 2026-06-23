{{-- $activeSellerTab: 'panel' | 'create' | 'tratos' | 'delivery' | 'comprobantes' --}}
<aside class="w-sidebar-width bg-surface-container border-r border-outline-variant flex flex-col p-base space-y-4 hidden md:flex sticky top-16 h-[calc(100vh-64px)] overflow-y-auto shrink-0">

    <div class="p-4 bg-surface-container-lowest rounded-2xl border border-outline-variant">

        {{-- Flash mensajes foto --}}
        @if(session('photo_success'))
            <div class="mb-3 p-2 bg-tertiary-fixed/40 text-tertiary rounded-xl text-[11px] flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">check_circle</span>
                {{ session('photo_success') }}
            </div>
        @endif
        @if(session('photo_error'))
            <div class="mb-3 p-2 bg-error-container text-error rounded-xl text-[11px] flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">error</span>
                {{ session('photo_error') }}
            </div>
        @endif

        <div class="flex flex-col items-center gap-3 mb-4">
            <div class="relative group">
                @if(!empty(auth()->user()->foto))
                    <img alt="Foto de perfil"
                         class="w-24 h-24 rounded-full object-cover border-2 border-primary"
                         src="{{ asset('storage/' . auth()->user()->foto) }}">
                @else
                    <div class="w-24 h-24 rounded-full bg-primary border-2 border-primary flex items-center justify-center text-on-primary text-3xl font-bold">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                @endif
                <div class="absolute bottom-1 right-1 w-5 h-5 bg-tertiary-fixed rounded-full border-2 border-surface-container-lowest"></div>

                <label for="foto-upload-seller-sb"
                       class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                       title="Cambiar foto de perfil">
                    <span class="material-symbols-outlined text-white text-2xl">photo_camera</span>
                </label>
                <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data" id="foto-form-seller-sb">
                    @csrf
                    <input type="file" id="foto-upload-seller-sb" name="foto" class="hidden"
                           accept="image/png,image/jpeg,image/jpg"
                           onchange="document.getElementById('foto-form-seller-sb').submit()">
                </form>
            </div>

            <div class="text-center mt-1">
                <h2 class="text-headline-md font-headline-md font-bold text-primary">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                </h2>
                <p class="text-body-sm text-outline">Vendedor</p>
                <p class="text-[11px] text-on-surface-variant/60 mt-1">PNG, JPG o JPEG · máx. 3 MB</p>
            </div>
        </div>

        <a href="{{ route('home') }}"
           class="w-full block text-center py-3 px-4 bg-[#003178] text-white rounded-2xl font-bold font-headline-md text-headline-md transition-all hover:brightness-110">
            Cambiar a Cliente
        </a>
    </div>

    <nav class="space-y-1">
        @php $stab = $activeSellerTab ?? ''; @endphp

        <a href="{{ route('seller.panel') }}"
           class="{{ $stab === 'panel' ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl flex items-center px-4 py-3 transition-all">
            <span class="material-symbols-outlined mr-3">dashboard</span>
            <span class="font-body-lg text-body-lg">Panel</span>
        </a>

        <a href="{{ route('seller.products.create') }}"
           class="{{ $stab === 'create' ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl flex items-center px-4 py-3 transition-all">
            <span class="material-symbols-outlined mr-3">add_circle</span>
            <span class="font-body-lg text-body-lg">Crear Publicación</span>
        </a>

        <a href="{{ route('seller.tratos.index') }}"
           class="{{ $stab === 'tratos' ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl flex items-center px-4 py-3 transition-all">
            <span class="material-symbols-outlined mr-3">handshake</span>
            <span class="font-body-lg text-body-lg">Mis Tratos</span>
        </a>

        <a href="{{ route('seller.delivery.index') }}"
           class="{{ $stab === 'delivery' ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl flex items-center px-4 py-3 transition-all">
            <span class="material-symbols-outlined mr-3">local_shipping</span>
            <span class="font-body-lg text-body-lg">Delivery</span>
        </a>

        <a href="{{ route('seller.comprobantes.index') }}"
           class="{{ $stab === 'comprobantes' ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-variant' }} rounded-xl flex items-center px-4 py-3 transition-all">
            <span class="material-symbols-outlined mr-3">receipt_long</span>
            <span class="font-body-lg text-body-lg">Mis Comprobantes</span>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-body-sm text-error hover:bg-error/10 rounded-lg text-left">
                <span class="material-symbols-outlined text-base">logout</span>
                Cerrar sesión
            </button>
        </form>
    </nav>
</aside>
