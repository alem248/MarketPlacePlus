@extends('layouts.admin')
@section('title', 'Delivery #' . $delivery->id)
@section('page_title', 'Detalle de Delivery')

@section('content')
{{-- Breadcrumb --}}
<div class="flex items-center gap-2 mb-6 text-body-sm text-on-surface-variant">
    <a href="{{ route('admin.delivery.index') }}" class="hover:text-primary transition-colors">Deliveries</a>
    <span class="material-symbols-outlined" style="font-size:16px">chevron_right</span>
    <span class="text-on-surface font-bold">Solicitud #{{ $delivery->id }}</span>
</div>

@php
    $trato = $delivery->trato;
    $imgs  = $trato->product->image_path ?? [];
    $imgSrc = isset($imgs[0]) ? (Str::startsWith($imgs[0], 'http') ? $imgs[0] : Storage::url($imgs[0])) : null;
    $statusMap = [
        'pendiente'  => ['label' => 'En espera',  'class' => 'bg-yellow-100 text-yellow-800'],
        'aprobado'   => ['label' => 'Aprobado',   'class' => 'bg-green-100 text-green-800'],
        'rechazado'  => ['label' => 'Rechazado',  'class' => 'bg-red-100 text-red-800'],
        'en_camino'  => ['label' => 'En camino',  'class' => 'bg-blue-100 text-blue-800'],
        'entregado'  => ['label' => 'Entregado',  'class' => 'bg-gray-100 text-gray-600'],
    ];
    $s = $statusMap[$delivery->status] ?? $statusMap['pendiente'];
@endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">

    {{-- LEFT: Información de la solicitud --}}
    <div class="lg:col-span-2 space-y-gutter">

        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6">
            <h2 class="font-headline-md text-headline-md text-on-surface mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">inventory_2</span>
                Producto
            </h2>
            <div class="flex gap-4">
                <div class="w-24 h-24 rounded-xl bg-surface-container-high overflow-hidden flex items-center justify-center shrink-0">
                    @if($imgSrc)
                        <img src="{{ $imgSrc }}" alt="{{ $trato->product->title }}" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-outline" style="font-size:36px">image</span>
                    @endif
                </div>
                <div>
                    <p class="font-bold text-on-surface">{{ $trato->product->title }}</p>
                    <p class="text-body-sm text-on-surface-variant">Trato: MPP-{{ $trato->id }}</p>
                    <p class="text-price-display font-price-display text-secondary mt-1">S/. {{ number_format($trato->price, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6">
            <h2 class="font-headline-md text-headline-md text-on-surface mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">group</span>
                Partes involucradas
            </h2>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-label-caps font-label-caps text-on-surface-variant mb-1">VENDEDOR</p>
                    <p class="font-bold text-on-surface">{{ $trato->seller->first_name }} {{ $trato->seller->last_name }}</p>
                    <p class="text-body-sm text-on-surface-variant">{{ $trato->seller->email }}</p>
                </div>
                <div>
                    <p class="text-label-caps font-label-caps text-on-surface-variant mb-1">COMPRADOR</p>
                    <p class="font-bold text-on-surface">{{ $trato->buyer->first_name }} {{ $trato->buyer->last_name }}</p>
                    <p class="text-body-sm text-on-surface-variant">{{ $trato->buyer->email }}</p>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6">
            <h2 class="font-headline-md text-headline-md text-on-surface mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">map</span>
                Datos del envío
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-body-sm">
                <div>
                    <p class="text-label-caps font-label-caps text-on-surface-variant mb-1">DIRECCIÓN DE RECOJO</p>
                    <p class="text-on-surface">{{ $delivery->pickup_address }}</p>
                </div>
                <div>
                    <p class="text-label-caps font-label-caps text-on-surface-variant mb-1">DIRECCIÓN DE DESTINO</p>
                    <p class="text-on-surface">{{ $delivery->delivery_address }}</p>
                </div>
                <div>
                    <p class="text-label-caps font-label-caps text-on-surface-variant mb-1">CONTACTO DESTINATARIO</p>
                    <p class="text-on-surface">{{ $delivery->contact_name }}</p>
                </div>
                <div>
                    <p class="text-label-caps font-label-caps text-on-surface-variant mb-1">TELÉFONO</p>
                    <p class="text-on-surface">{{ $delivery->contact_phone }}</p>
                </div>
                <div>
                    <p class="text-label-caps font-label-caps text-on-surface-variant mb-1">TIPO DE ENVÍO</p>
                    <p class="text-on-surface">{{ $delivery->shipping_type === 'express' ? 'Express (Mismo día)' : 'Regular (24-48h)' }}</p>
                </div>
                @if($delivery->notes)
                <div class="sm:col-span-2">
                    <p class="text-label-caps font-label-caps text-on-surface-variant mb-1">OBSERVACIONES</p>
                    <p class="text-on-surface italic">{{ $delivery->notes }}</p>
                </div>
                @endif
            </div>
        </div>

        @if($delivery->status !== 'pendiente' && $delivery->courier_name)
        <div class="bg-green-50 border border-green-200 rounded-xl p-6">
            <h2 class="font-headline-md text-headline-md text-green-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-green-600">person_pin</span>
                Repartidor asignado
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-body-sm">
                <div>
                    <p class="text-label-caps font-label-caps text-green-700 mb-1">NOMBRE</p>
                    <p class="text-green-900 font-bold">{{ $delivery->courier_name }}</p>
                </div>
                <div>
                    <p class="text-label-caps font-label-caps text-green-700 mb-1">PLACA</p>
                    <p class="text-green-900 font-bold font-mono">{{ $delivery->courier_plate }}</p>
                </div>
                @if($delivery->courier_phone)
                <div>
                    <p class="text-label-caps font-label-caps text-green-700 mb-1">TELÉFONO</p>
                    <p class="text-green-900">{{ $delivery->courier_phone }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>

    {{-- RIGHT: Acciones del admin --}}
    <div class="lg:col-span-1 space-y-gutter">

        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6">
            <p class="text-label-caps font-label-caps text-on-surface-variant mb-3">ESTADO ACTUAL</p>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-bold {{ $s['class'] }}">
                {{ $s['label'] }}
            </span>
            <p class="text-body-sm text-on-surface-variant mt-3">
                Solicitado el {{ $delivery->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

        @if($delivery->status === 'pendiente')
        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6">
            <h3 class="font-headline-md text-headline-md text-on-surface mb-4">Aprobar solicitud</h3>
            <form action="{{ route('admin.delivery.approve', $delivery) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-body-sm font-bold text-on-surface mb-1">Nombre del repartidor <span class="text-error">*</span></label>
                    <input type="text" name="courier_name"
                           class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none text-body-sm"
                           placeholder="Nombre completo"
                           value="{{ old('courier_name') }}" required>
                </div>
                <div>
                    <label class="block text-body-sm font-bold text-on-surface mb-1">Placa del vehículo <span class="text-error">*</span></label>
                    <input type="text" name="courier_plate"
                           class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none text-body-sm font-mono"
                           placeholder="ABC-123"
                           value="{{ old('courier_plate') }}" required>
                </div>
                <div>
                    <label class="block text-body-sm font-bold text-on-surface mb-1">Teléfono del repartidor</label>
                    <input type="tel" name="courier_phone"
                           class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none text-body-sm"
                           placeholder="9xxxxxxxx"
                           value="{{ old('courier_phone') }}">
                </div>
                <div>
                    <label class="block text-body-sm font-bold text-on-surface mb-1">Nota al vendedor</label>
                    <textarea name="admin_notes" rows="2"
                              class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none text-body-sm resize-none"
                              placeholder="Ej: El repartidor llegará entre 2-4pm">{{ old('admin_notes') }}</textarea>
                </div>
                @if($errors->any())
                <div class="p-3 bg-error-container rounded-lg text-body-sm text-on-error-container">
                    @foreach($errors->all() as $e)<p>• {{ $e }}</p>@endforeach
                </div>
                @endif
                <button type="submit"
                        class="w-full py-3 bg-primary text-on-primary font-bold rounded-xl hover:brightness-110 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    Aprobar y Asignar Repartidor
                </button>
            </form>
        </div>

        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6">
            <h3 class="font-headline-md text-headline-md text-on-surface mb-4">Rechazar solicitud</h3>
            <form action="{{ route('admin.delivery.reject', $delivery) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-body-sm font-bold text-on-surface mb-1">Motivo del rechazo</label>
                    <textarea name="admin_notes" rows="2"
                              class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-error/30 focus:border-error outline-none text-body-sm resize-none"
                              placeholder="Opcional. Se mostrará al vendedor.">{{ old('admin_notes') }}</textarea>
                </div>
                <button type="submit"
                        onclick="return confirm('¿Seguro que quieres rechazar esta solicitud?')"
                        class="w-full py-3 border-2 border-error text-error font-bold rounded-xl hover:bg-error-container transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">cancel</span>
                    Rechazar
                </button>
            </form>
        </div>

        @elseif(in_array($delivery->status, ['aprobado', 'en_camino', 'entregado']))
        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6 text-center">
            <span class="material-symbols-outlined text-outline mb-2 block" style="font-size:36px">
                {{ $delivery->status === 'entregado' ? 'verified' : 'local_shipping' }}
            </span>
            <p class="text-body-sm text-on-surface-variant">
                @if($delivery->status === 'aprobado')
                    Aprobado. Esperando que el vendedor entregue al repartidor.
                @elseif($delivery->status === 'en_camino')
                    Pedido en camino al comprador.
                @else
                    Pedido entregado con éxito.
                @endif
            </p>
        </div>
        @endif

    </div>
</div>
@endsection
