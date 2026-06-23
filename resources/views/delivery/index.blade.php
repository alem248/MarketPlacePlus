@extends('layouts.app')

@section('title', 'Mis Pedidos - MarketPlace Plus')

@section('content')
<div class="bg-background text-on-surface font-body-lg min-h-screen">

    @include('partials.client-navbar')

    <div class="max-w-container-max mx-auto flex">
        @include('partials.client-sidebar', ['activeClientTab' => 'delivery'])

        <main class="flex-1 min-w-0 p-4 md:p-gutter">

            <header class="mb-gutter">
                <h2 class="text-headline-lg font-headline-lg text-on-surface">Seguimiento de Pedidos</h2>
                <p class="text-on-surface-variant font-body-lg text-body-lg">Estado en tiempo real de tus compras en delivery.</p>
            </header>

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                <p class="text-green-800 font-bold">{{ session('success') }}</p>
            </div>
            @endif

            <div class="grid grid-cols-1 gap-gutter">

                @forelse($deliveries as $delivery)
                @php
                    $trato = $delivery->trato;
                    $imgs  = $trato->product->image_path ?? [];
                    $imgSrc = isset($imgs[0]) ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0])) : null;
                    $tratoCode = 'MPP-' . $trato->id . '-' . $trato->created_at->year;

                    $step1Done = in_array($delivery->status, ['aprobado', 'en_camino', 'entregado']);
                    $step2Done = in_array($delivery->status, ['en_camino', 'entregado']);
                    $step3Done = $delivery->status === 'entregado';
                    $progressClass = $step3Done ? 'w-[80%]' : ($step2Done ? 'w-[40%]' : 'w-0');
                @endphp

                <section class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex flex-col lg:flex-row">

                        {{-- Imagen --}}
                        <div class="w-full lg:w-56 shrink-0 bg-surface-container-low flex items-center justify-center p-4 min-h-[150px]">
                            @if($imgSrc)
                                <img src="{{ $imgSrc }}" alt="{{ $trato->product->title }}" class="w-full h-36 object-contain">
                            @else
                                <span class="material-symbols-outlined text-outline" style="font-size:56px">image</span>
                            @endif
                        </div>

                        <div class="flex-1 p-gutter flex flex-col justify-between">

                            {{-- Info del producto --}}
                            <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">
                                <div>
                                    <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest">
                                        {{ strtoupper($trato->product->category ?? 'PRODUCTO') }}
                                    </span>
                                    <h3 class="font-headline-md text-headline-md mt-1">{{ $trato->product->title }}</h3>
                                    <div class="flex flex-col gap-1 mt-2 text-on-surface-variant font-body-sm text-body-sm">
                                        <p>Trato: <span class="font-bold text-on-surface">{{ $tratoCode }}</span></p>
                                        <p>Vendedor: <span class="font-bold text-on-surface">{{ $trato->seller->first_name }} {{ $trato->seller->last_name }}</span></p>
                                        @if($delivery->status === 'pendiente')
                                            <p class="flex items-center gap-1 text-yellow-700">
                                                <span class="material-symbols-outlined" style="font-size:14px">hourglass_top</span>
                                                Solicitud enviada, esperando aprobación del administrador
                                            </p>
                                        @elseif($delivery->status === 'aprobado')
                                            <p class="flex items-center gap-1 text-green-700">
                                                <span class="material-symbols-outlined" style="font-size:14px">check_circle</span>
                                                Delivery aprobado — repartidor asignado
                                            </p>
                                        @elseif($delivery->status === 'en_camino')
                                            <p class="flex items-center gap-1 text-blue-700 font-bold">
                                                <span class="material-symbols-outlined" style="font-size:14px">local_shipping</span>
                                                Tu pedido está en camino
                                            </p>
                                        @elseif($delivery->status === 'entregado')
                                            <p class="flex items-center gap-1 text-green-700 font-bold">
                                                <span class="material-symbols-outlined" style="font-size:14px">verified</span>
                                                ¡Pedido entregado!
                                            </p>
                                        @elseif($delivery->status === 'rechazado')
                                            <p class="flex items-center gap-1 text-error font-bold">
                                                <span class="material-symbols-outlined" style="font-size:14px">cancel</span>
                                                Solicitud rechazada por el administrador
                                                @if($delivery->admin_notes)
                                                    — {{ $delivery->admin_notes }}
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="font-price-display text-price-display text-primary">S/. {{ number_format($trato->price, 2) }}</p>
                                </div>
                            </div>

                            {{-- Stepper --}}
                            <div class="mb-6 px-2">
                                <div class="relative flex items-center justify-between w-full max-w-sm">
                                    <div class="absolute top-5 left-[10%] right-[10%] h-1 bg-surface-container-high z-0"></div>
                                    <div class="absolute top-5 left-[10%] h-1 bg-primary-container z-0 transition-all duration-700 {{ $progressClass }}"></div>

                                    <div class="relative z-10 flex flex-col items-center gap-2">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $step1Done ? 'bg-primary-container' : 'bg-surface-container-high' }}">
                                            <span class="material-symbols-outlined text-sm {{ $step1Done ? 'text-on-primary' : 'text-outline' }}">check_circle</span>
                                        </div>
                                        <span class="font-label-caps text-label-caps {{ $step1Done ? 'text-primary' : 'text-on-surface-variant' }}">Aprobado</span>
                                    </div>

                                    <div class="relative z-10 flex flex-col items-center gap-2">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $step2Done ? 'bg-primary-container' : ($step1Done ? 'ring-4 ring-primary/20 bg-surface-container-high' : 'bg-surface-container-high') }}">
                                            <span class="material-symbols-outlined text-sm {{ $step2Done ? 'text-on-primary' : ($step1Done ? 'text-primary' : 'text-outline') }}">local_shipping</span>
                                        </div>
                                        <span class="font-label-caps text-label-caps {{ $step2Done ? 'text-primary' : 'text-on-surface-variant' }}">En camino</span>
                                    </div>

                                    <div class="relative z-10 flex flex-col items-center gap-2">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $step3Done ? 'bg-primary-container' : 'bg-surface-container-high' }}">
                                            <span class="material-symbols-outlined text-sm {{ $step3Done ? 'text-on-primary' : 'text-outline' }}">inventory_2</span>
                                        </div>
                                        <span class="font-label-caps text-label-caps {{ $step3Done ? 'text-primary' : 'text-on-surface-variant' }}">Recibido</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Datos del repartidor (si aprobado o en_camino) --}}
                            @if(in_array($delivery->status, ['aprobado', 'en_camino']) && $delivery->courier_name)
                            <div class="mb-4 p-3 bg-surface-container-low rounded-xl border border-outline-variant flex flex-wrap gap-4 text-body-sm">
                                <span><span class="font-bold">Repartidor:</span> {{ $delivery->courier_name }}</span>
                                <span><span class="font-bold">Placa:</span> <span class="font-mono">{{ $delivery->courier_plate }}</span></span>
                                @if($delivery->courier_phone)
                                    <span><span class="font-bold">Tel:</span> {{ $delivery->courier_phone }}</span>
                                @endif
                            </div>
                            @endif

                            {{-- Acciones --}}
                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                @if($delivery->status === 'en_camino')
                                    <form action="{{ route('delivery.confirm', $trato) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="flex items-center gap-2 px-8 py-3 bg-secondary-container text-on-secondary-container font-bold rounded-xl hover:shadow-md transition-all active:scale-95">
                                            <span class="material-symbols-outlined">inventory_2</span>
                                            Confirmar Recepción
                                        </button>
                                    </form>
                                @elseif($delivery->status === 'entregado')
                                    <span class="inline-flex items-center gap-2 px-6 py-3 bg-green-100 text-green-800 font-bold rounded-xl">
                                        <span class="material-symbols-outlined">verified</span>
                                        Pedido recibido
                                    </span>
                                @endif
                                <a href="{{ route('tratos.show', $trato) }}"
                                   class="text-center border border-primary text-primary font-bold px-8 py-3 rounded-xl hover:bg-primary/5 transition-colors">
                                    Ver Trato
                                </a>
                            </div>

                        </div>
                    </div>
                </section>
                @empty

                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-16 text-center shadow-sm">
                    <span class="material-symbols-outlined text-outline block mb-4" style="font-size:64px">local_shipping</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-2">Sin pedidos en delivery</h3>
                    <p class="text-body-sm text-on-surface-variant mb-6">Cuando el vendedor solicite un delivery para tu trato, aparecerá aquí.</p>
                    <a href="{{ route('tratos.index') }}"
                       class="inline-block px-6 py-3 bg-primary text-on-primary rounded-xl font-bold hover:opacity-90 transition-all">
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
