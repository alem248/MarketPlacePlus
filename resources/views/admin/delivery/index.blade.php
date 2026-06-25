@extends('layouts.admin')
@section('title', 'Gestión de Deliveries')
@section('page_title', 'Gestión de Deliveries')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-primary">Gestión de Deliveries</h1>
        <p class="font-body-lg text-on-surface-variant">Revisa, aprueba y rechaza las solicitudes de envío de los vendedores.</p>
    </div>
    @php $pendientes = $deliveries->where('status', 'pendiente')->count(); @endphp
    @if($pendientes > 0)
    <span class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-bold text-body-sm">
        <span class="material-symbols-outlined" style="font-size:18px">hourglass_top</span>
        {{ $pendientes }} pendiente{{ $pendientes > 1 ? 's' : '' }}
    </span>
    @endif
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-surface-container-low border-b border-outline-variant">
                <tr>
                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">PRODUCTO</th>
                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">VENDEDOR</th>
                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">COMPRADOR</th>
                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">TIPO</th>
                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">ESTADO</th>
                    <th class="px-4 py-3 text-label-caps font-label-caps text-on-surface-variant">FECHA</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @forelse($deliveries as $delivery)
                @php
                    $statusMap = [
                        'pendiente'  => ['label' => 'En espera',  'class' => 'bg-yellow-100 text-yellow-800'],
                        'aprobado'   => ['label' => 'Aprobado',   'class' => 'bg-green-100 text-green-800'],
                        'rechazado'  => ['label' => 'Rechazado',  'class' => 'bg-red-100 text-red-800'],
                        'en_camino'  => ['label' => 'En camino',  'class' => 'bg-blue-100 text-blue-800'],
                        'entregado'  => ['label' => 'Entregado',  'class' => 'bg-gray-100 text-gray-600'],
                    ];
                    $s = $statusMap[$delivery->status] ?? $statusMap['pendiente'];
                @endphp
                <tr class="hover:bg-surface-container-low transition-colors {{ $delivery->status === 'pendiente' ? 'bg-yellow-50/40' : '' }}">
                    <td class="px-4 py-3">
                        <p class="font-bold text-on-surface text-body-sm truncate max-w-[180px]">{{ $delivery->trato->product->title }}</p>
                        <p class="text-[11px] text-on-surface-variant">MPP-{{ $delivery->trato_id }}</p>
                    </td>
                    <td class="px-4 py-3 text-body-sm text-on-surface">
                        {{ $delivery->trato->seller->first_name }} {{ $delivery->trato->seller->last_name }}
                    </td>
                    <td class="px-4 py-3 text-body-sm text-on-surface">
                        {{ $delivery->trato->buyer->first_name }} {{ $delivery->trato->buyer->last_name }}
                    </td>
                    <td class="px-4 py-3 text-body-sm text-on-surface-variant">
                        {{ $delivery->shipping_type === 'express' ? 'Express' : 'Regular' }}
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-[11px] font-bold {{ $s['class'] }}">
                            {{ $s['label'] }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-body-sm text-on-surface-variant">
                        {{ $delivery->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.delivery.show', $delivery) }}"
                           class="inline-flex items-center gap-1 px-4 py-1.5 text-body-sm font-bold
                                  {{ $delivery->status === 'pendiente' ? 'bg-primary text-on-primary' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container' }}
                                  rounded-lg transition-all">
                            {{ $delivery->status === 'pendiente' ? 'Gestionar' : 'Ver' }}
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-16 text-center">
                        <span class="material-symbols-outlined text-outline block mb-3" style="font-size:48px">local_shipping</span>
                        <p class="font-body-lg text-on-surface-variant">No hay solicitudes de delivery aún.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($deliveries->hasPages())
    <div class="px-4 py-3 border-t border-outline-variant">
        {{ $deliveries->links() }}
    </div>
    @endif
</div>
@endsection
