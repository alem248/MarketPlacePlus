{{--
    Sidebar unificado para vistas de cliente (modelo: home.blade.php).
    Variables opcionales:
      $activeClientTab  → 'panel' | 'tratos' | 'delivery' | 'comprobantes'
      $sideBanner       → objeto Banner (solo home)
      $sideImgSrc       → URL de la imagen del banner (solo home)
--}}
<aside class="hidden lg:flex flex-col h-[calc(100vh-64px)] w-sidebar-width p-base gap-gutter bg-surface-container-lowest border-r border-outline-variant sticky top-16 overflow-y-auto sidebar-scroll">

    @auth
        {{-- Mensajes flash de foto --}}
        @if(session('photo_success'))
            <div class="p-3 bg-tertiary-fixed/40 text-tertiary rounded-xl text-body-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">check_circle</span>
                {{ session('photo_success') }}
            </div>
        @endif
        @if(session('photo_error'))
            <div class="p-3 bg-error-container text-error rounded-xl text-body-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">error</span>
                {{ session('photo_error') }}
            </div>
        @endif

        {{-- Perfil del usuario con opción de editar foto --}}
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

                {{-- Indicador en línea --}}
                <div class="absolute bottom-1 right-1 w-5 h-5 bg-tertiary-fixed rounded-full border-2 border-surface-container-lowest"></div>

                {{-- Overlay cámara (aparece al pasar el cursor) --}}
                <label for="foto-upload-client"
                       class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                       title="Cambiar foto de perfil">
                    <span class="material-symbols-outlined text-white text-2xl">photo_camera</span>
                </label>
                <form action="{{ route('profile.photo.update') }}" method="POST"
                      enctype="multipart/form-data" id="foto-form-client">
                    @csrf
                    <input type="file" id="foto-upload-client" name="foto" class="hidden"
                           accept="image/png,image/jpeg,image/jpg"
                           onchange="document.getElementById('foto-form-client').submit()">
                </form>
            </div>

            <div class="text-center">
                <h2 class="text-headline-md font-headline-md font-bold text-primary">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                </h2>
                <p class="text-body-sm text-outline">Cliente</p>
                <p class="text-[11px] text-on-surface-variant/60 mt-1">PNG, JPG o JPEG · máx. 3 MB</p>
            </div>
        </div>

    @else
        {{-- Estado invitado --}}
        <div class="bg-surface-container-lowest p-4 rounded-xl border border-outline-variant text-center mb-4">
            <span class="material-symbols-outlined text-[40px] text-secondary mb-2 inline-block">rocket_launch</span>
            <h3 class="font-headline-md text-on-surface mb-1 text-sm font-bold">¡Únete a la comunidad!</h3>
            <p class="text-body-sm text-on-surface-variant mb-4">
                Regístrate para publicar productos, gestionar tus compras y conectar de forma segura.
            </p>
            <div class="space-y-2">
                <a href="{{ route('register') }}"
                   class="block w-full py-2 bg-primary text-on-primary font-semibold rounded-lg text-body-sm hover:brightness-110 transition-all">
                    Crear cuenta nueva
                </a>
                <a href="{{ route('login') }}"
                   class="block w-full py-2 bg-surface-container border border-outline-variant text-on-surface font-semibold rounded-lg text-body-sm hover:bg-surface-container-high transition-all">
                    Ingresar
                </a>
            </div>
        </div>
    @endauth

    @auth
    {{-- Solo usuarios logueados pueden cambiar a modo vendedor --}}
    <a href="{{ route('seller.panel') }}"
       class="w-full block text-center py-3 px-4 bg-[#003178] text-white rounded-2xl font-bold transition-all hover:brightness-110">
        Cambiar a Vendedor
    </a>
    @endauth

    {{-- Navegación --}}
    <nav class="flex flex-col gap-1">
        @php $tab = $activeClientTab ?? ''; @endphp

        <a href="{{ route('home') }}"
           class="flex items-center gap-3 p-3 {{ $tab === 'panel' ? 'bg-primary-container text-on-primary-container font-bold translate-x-1' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-body-lg font-body-lg">Panel</span>
        </a>

        <a href="{{ route('tratos.index') }}"
           class="flex items-center gap-3 p-3 {{ $tab === 'tratos' ? 'bg-primary-container text-on-primary-container font-bold translate-x-1' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">handshake</span>
            <span class="text-body-lg font-body-lg">Mis Tratos</span>
        </a>

        <a href="{{ route('favorites.index') }}"
           class="flex items-center gap-3 p-3 {{ $tab === 'favoritos' ? 'bg-primary-container text-on-primary-container font-bold translate-x-1' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined" style="{{ $tab === 'favoritos' ? 'font-variation-settings:\'FILL\' 1' : '' }}">favorite</span>
            <span class="text-body-lg font-body-lg">Mis Favoritos</span>
        </a>

        <a href="{{ route('delivery.index') }}"
           class="flex items-center gap-3 p-3 {{ $tab === 'delivery' ? 'bg-primary-container text-on-primary-container font-bold translate-x-1' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">local_shipping</span>
            <span class="text-body-lg font-body-lg">Delivery</span>
        </a>

        <a href="{{ route('comprobantes.index') }}"
           class="flex items-center gap-3 p-3 {{ $tab === 'comprobantes' ? 'bg-primary-container text-on-primary-container font-bold translate-x-1' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">receipt_long</span>
            <span class="text-body-lg font-body-lg">Mis Comprobantes</span>
        </a>

        <div class="my-4 border-t border-outline-variant"></div>

        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit"
                    class="flex items-center gap-2 w-full px-4 py-2 text-body-sm text-error hover:bg-error/10 rounded-lg text-left">
                <span class="material-symbols-outlined text-base">logout</span>
                Cerrar sesión
            </button>
        </form>
    </nav>

    {{-- Banner publicitario (solo se muestra si se pasa $sideBanner desde el controlador) --}}
    @isset($sideBanner)
        <div class="mt-auto rounded-xl overflow-hidden relative group min-h-[180px] bg-inverse-surface text-on-primary">
            @if(!empty($sideImgSrc))
                <img alt="{{ $sideBanner->title }}"
                     class="absolute inset-0 w-full h-full object-cover object-center opacity-50 group-hover:scale-110 transition-transform duration-700"
                     src="{{ $sideImgSrc }}">
            @endif
            <div class="relative z-10 p-4 flex flex-col h-full min-h-[180px]">
                <span class="text-[10px] font-bold uppercase tracking-widest opacity-70">Publicidad</span>
                <h3 class="text-headline-md font-bold mt-1">{{ $sideBanner->title ?? 'Oferta Especial' }}</h3>
                @if(!empty($sideBanner->description))
                    <p class="text-body-sm mt-2 opacity-80">{{ $sideBanner->description }}</p>
                @endif
                @if($sideBanner->link_url)
                <a href="{{ $sideBanner->link_url }}" target="_blank" rel="noopener"
                   class="mt-4 self-start px-4 py-1.5 border border-white rounded-full text-label-caps hover:bg-white hover:text-primary transition-colors">
                    Ver más
                </a>
                @endif
            </div>
        </div>
    @endisset

</aside>
