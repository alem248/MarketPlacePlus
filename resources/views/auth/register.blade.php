@extends('layouts.app')

@section('title', 'Registro | MarketPlace Plus')

@section('content')
<div class="flex flex-col min-h-screen">

    {{-- Header simplificado para registro --}}
    <header class="w-full bg-surface-container-lowest border-b border-outline-variant py-4 px-6 md:px-gutter">
        <div class="max-w-container-max mx-auto flex items-center justify-center md:justify-start">
            <a href="{{ route('home') }}">
                <span class="font-headline-md text-headline-md font-bold text-primary">MarketPlace Plus</span>
            </a>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-margin-mobile py-12">
        <div class="w-full max-w-[450px] bg-surface-container-lowest rounded-xl border border-outline-variant p-8 md:p-10 shadow-sm">

            {{-- Título --}}
            <div class="mb-8 text-center md:text-left">
                <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-2">
                    Empieza a usar MarketPlace Plus
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant">
                    Crea una cuenta para conectar con vendedores y realizar tratos directos.
                </p>
            </div>

            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-xl text-body-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[16px]">error</span>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            {{-- Formulario --}}
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Nombre y Apellidos --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-label-caps text-label-caps text-outline uppercase" for="first_name">Nombre</label>
                        <input
                            class="w-full h-12 px-4 rounded-xl border @error('first_name') border-error @else border-outline-variant @enderror bg-surface-container-low text-body-lg font-body-lg focus:outline-none focus:ring-2 focus:ring-primary/30 transition-all placeholder:text-outline-variant"
                            id="first_name" name="first_name" placeholder="Nombre" type="text"
                            value="{{ old('first_name') }}" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-label-caps text-label-caps text-outline uppercase" for="last_name">Apellidos</label>
                        <input
                            class="w-full h-12 px-4 rounded-xl border @error('last_name') border-error @else border-outline-variant @enderror bg-surface-container-low text-body-lg font-body-lg focus:outline-none focus:ring-2 focus:ring-primary/30 transition-all placeholder:text-outline-variant"
                            id="last_name" name="last_name" placeholder="Apellidos" type="text"
                            value="{{ old('last_name') }}" required>
                    </div>
                </div>

                {{-- Fecha de nacimiento --}}
                <div class="space-y-1.5">
                    <label class="font-label-caps text-label-caps text-outline uppercase flex items-center gap-1" for="dob">
                        Fecha de nacimiento
                        <span class="material-symbols-outlined text-[16px]" title="Formato: DD/MM/YYYY">help</span>
                    </label>
                    <input
                        class="w-full h-12 px-4 rounded-xl border @error('dob') border-error @else border-outline-variant @enderror bg-surface-container-low text-body-lg font-body-lg focus:outline-none focus:ring-2 focus:ring-primary/30 transition-all placeholder:text-outline-variant"
                        id="dob" name="dob" placeholder="DD/MM/YYYY" type="text"
                        value="{{ old('dob') }}" required>
                </div>

                {{-- Género --}}
                <div class="space-y-1.5">
                    <label class="font-label-caps text-label-caps text-outline uppercase" for="gender">Género</label>
                    <select
                        class="w-full h-12 px-4 rounded-xl border border-outline-variant bg-surface-container-low text-body-lg font-body-lg focus:outline-none focus:ring-2 focus:ring-primary/30 appearance-none cursor-pointer"
                        id="gender" name="gender">
                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Selecciona tu género</option>
                        <option value="male"             {{ old('gender') == 'male'             ? 'selected' : '' }}>Hombre</option>
                        <option value="female"           {{ old('gender') == 'female'           ? 'selected' : '' }}>Mujer</option>
                        <option value="other"            {{ old('gender') == 'other'            ? 'selected' : '' }}>Otro</option>
                        <option value="prefer_not_to_say"{{ old('gender') == 'prefer_not_to_say'? 'selected' : '' }}>Prefiero no decirlo</option>
                    </select>
                </div>

                {{-- Email y WhatsApp --}}
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="font-label-caps text-label-caps text-outline uppercase" for="email">Correo electrónico</label>
                        <input
                            class="w-full h-12 px-4 rounded-xl border @error('email') border-error @else border-outline-variant @enderror bg-surface-container-low text-body-lg font-body-lg focus:outline-none focus:ring-2 focus:ring-primary/30 transition-all placeholder:text-outline-variant"
                            id="email" name="email" placeholder="ejemplo@correo.com" type="email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-caps text-label-caps text-outline uppercase" for="phone">Número de WhatsApp</label>
                        <div class="flex items-center">
                            <span class="h-12 flex items-center px-4 bg-surface-container-high border border-r-0 border-outline-variant rounded-l-xl text-on-surface font-body-lg">+</span>
                            <input
                                class="w-full h-12 px-4 rounded-r-xl border @error('phone') border-error @else border-outline-variant @enderror bg-surface-container-low text-body-lg font-body-lg focus:outline-none focus:ring-2 focus:ring-primary/30 transition-all placeholder:text-outline-variant"
                                id="phone" name="phone" placeholder="Número de WhatsApp" type="tel"
                                value="{{ old('phone') }}" required>
                        </div>
                        <p class="text-[11px] text-primary font-semibold italic flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">info</span>
                            Ingresa un número con WhatsApp para realizar tus tratos
                        </p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Incluye el código de tu país. Ejemplo: 519XXXXXXXX</p>
                    </div>
                </div>

                {{-- Contraseña --}}
                <div class="space-y-1.5">
                    <label class="font-label-caps text-label-caps text-outline uppercase" for="password">Contraseña</label>
                    <input
                        class="w-full h-12 px-4 rounded-xl border @error('password') border-error @else border-outline-variant @enderror bg-surface-container-low text-body-lg font-body-lg focus:outline-none focus:ring-2 focus:ring-primary/30 transition-all placeholder:text-outline-variant"
                        id="password" name="password" placeholder="Nueva contraseña (mín. 8 caracteres)" type="password" required>
                </div>

                {{-- Botones --}}
                <div class="pt-4 space-y-4">
                    <button type="submit"
                        class="w-full h-14 bg-primary text-on-primary font-headline-md text-headline-md rounded-xl hover:bg-primary-container transition-all active:scale-[0.98] shadow-lg shadow-primary/10">
                        Registrar
                    </button>
                    <a href="{{ route('login') }}"
                        class="block w-full text-center py-3 text-primary font-body-lg hover:underline decoration-2 underline-offset-4 transition-all">
                        Ya tengo una cuenta
                    </a>
                </div>
            </form>

        </div>
    </main>

    {{-- Footer --}}
    <footer class="w-full bg-inverse-surface py-8 px-6 md:px-gutter mt-auto">
        <div class="max-w-container-max mx-auto text-center md:text-left">
            <div class="flex flex-wrap justify-center md:justify-start gap-4 mb-6">
                <span class="text-surface-variant font-body-sm">Español</span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-x-4 gap-y-2 mb-8">
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="{{ route('register') }}">Registrarte</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors" href="{{ route('login') }}">Iniciar sesión</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors btn-soon" href="#">Mis Tratos</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors btn-soon" href="#">Centro de Ayuda</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors btn-soon" href="#">Sobre Nosotros</a>
                <a class="text-surface-variant font-body-sm hover:text-on-primary transition-colors btn-soon" href="#">Condiciones</a>
            </div>
            <p class="text-surface-variant font-body-sm opacity-60">Market Place Plus © 2026</p>
        </div>
    </footer>

</div>
@endsection
