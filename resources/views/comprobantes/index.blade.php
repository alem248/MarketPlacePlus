@extends('layouts.app')

@section('title', 'Mis Comprobantes - MarketPlace Plus')

@section('content')
<div class="bg-background text-on-surface font-body-lg">

    {{-- ===================== TOP NAV ===================== --}}
    @include('partials.client-navbar')

    <div class="flex max-w-container-max mx-auto min-h-[calc(100vh-64px)]">

        {{-- ===================== SIDEBAR ===================== --}}
        @include('partials.client-sidebar', ['activeClientTab' => 'comprobantes'])

        {{-- ===================== CONTENIDO PRINCIPAL ===================== --}}
        <main class="flex-1 p-gutter bg-surface">

            <div class="mb-8">
                <h1 class="text-headline-lg font-headline-lg text-on-surface">Mis Comprobantes</h1>
                <p class="text-on-surface-variant mt-2">Aquí tienes un resumen detallado de tus transacciones realizadas.</p>
            </div>

            {{-- Mensaje flash de éxito o info --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-xl flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-100 text-blue-800 rounded-xl flex items-center gap-2">
                    <span class="material-symbols-outlined">info</span>
                    {{ session('info') }}
                </div>
            @endif

            {{-- Lista de comprobantes --}}
            <div class="flex flex-col gap-6">

                @forelse($comprobantes as $comp)
                @php
                    // Imagen del producto (URL externa o storage local)
                    $imgs    = $comp->product->image_path ?? [];
                    $imgSrc  = isset($imgs[0])
                        ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0]))
                        : null;

                    // Icono del método de pago
                    $payIcon = match(strtolower($comp->payment_method)) {
                        'tarjeta'                => 'credit_card',
                        'yape', 'plin'           => 'account_balance_wallet',
                        'efectivo'               => 'payments',
                        'transferencia bancaria' => 'account_balance',
                        default                  => 'receipt',
                    };
                @endphp
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row">

                        {{-- Imagen del producto --}}
                        <div class="w-full md:w-56 h-56 md:h-auto shrink-0 bg-surface-container">
                            @if($imgSrc)
                                <img class="w-full h-full object-cover" src="{{ $imgSrc }}"
                                     alt="{{ $comp->product->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-outline" style="font-size:64px">image</span>
                                </div>
                            @endif
                        </div>

                        {{-- Datos del comprobante --}}
                        <div class="flex-1 p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-headline-md font-headline-md text-on-surface pr-4">
                                    {{ $comp->product->title }}
                                </h3>
                                <p class="text-price-display font-price-display text-primary shrink-0">
                                    S/. {{ number_format($comp->price, 2) }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-4 gap-x-8 border-t border-outline-variant pt-4">

                                <div>
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">ID Transacción</p>
                                    <p class="text-body-sm text-on-surface font-semibold">#{{ $comp->transaction_code }}</p>
                                </div>

                                <div>
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Fecha</p>
                                    <p class="text-body-sm text-on-surface font-semibold">
                                        {{ $comp->created_at->format('d M, Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Comprador</p>
                                    <p class="text-body-sm text-on-surface font-semibold">
                                        {{ $comp->buyer->first_name }} {{ $comp->buyer->last_name }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Vendedor</p>
                                    <p class="text-body-sm text-on-surface font-semibold">
                                        {{ $comp->seller->first_name }} {{ $comp->seller->last_name }}
                                    </p>
                                </div>

                                <div class="col-span-2 sm:col-span-1">
                                    <p class="text-label-caps text-on-surface-variant opacity-60 uppercase">Método de Pago</p>
                                    <p class="text-body-sm text-on-surface font-semibold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">{{ $payIcon }}</span>
                                        {{ $comp->payment_method }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @empty
                {{-- Estado vacío: aún no hay comprobantes generados --}}
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-16 text-center">
                    <span class="material-symbols-outlined text-outline" style="font-size:64px">receipt_long</span>
                    <h3 class="text-headline-md font-bold text-on-surface mt-4">Aún no tienes comprobantes</h3>
                    <p class="text-body-sm text-on-surface-variant mt-2">
                        Cuando completes un trato y lo marques como recibido, podrás generar tu comprobante desde el detalle del trato.
                    </p>
                    <a href="{{ route('tratos.index') }}"
                       class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined">handshake</span>
                        Ver mis tratos
                    </a>
                </div>
                @endforelse

            </div>
        </main>
    </div>

    @include('partials.footer')

</div>
@endsection
