@extends('layouts.admin')
@section('title', 'Gestionar Publicaciones')
@section('page_title', 'Gestionar Publicaciones')

@section('styles')
.table-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
.table-scroll::-webkit-scrollbar-track { background: transparent; }
.table-scroll::-webkit-scrollbar-thumb { background: #c3c6d4; border-radius: 10px; }
@endsection

@section('content')
<div x-data>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <h2 class="font-headline-lg text-headline-lg text-on-background">Administrar Publicaciones</h2>
        <div class="relative w-full md:w-96">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input class="w-full pl-12 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-full focus:ring-2 focus:ring-primary focus:outline-none transition-all" placeholder="Buscar por producto o vendedor..." type="text">
        </div>
    </div>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
        <div class="table-scroll overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container border-b border-outline-variant">
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Vendedor</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($products as $product)
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-lg overflow-hidden bg-surface-variant shrink-0 border border-outline-variant">
                                    @php
                                    $firstImage = is_array($product->image_path) ? ($product->image_path[0] ?? '') : $product->image_path;
                                    $imgSrc = Str::startsWith($firstImage, 'http') ? $firstImage : Storage::url($firstImage);
                                    @endphp
                                    <img alt="{{ $product->title }}" class="w-full h-full object-cover" src="{{ $imgSrc }}">
                                </div>
                                <span class="font-body-lg text-body-lg font-semibold text-on-surface">{{ $product->title }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-on-surface-variant font-body-sm text-body-sm">{{ $product->category }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-xs">
                                    {{ $product->user ? substr($product->user->first_name, 0, 1) . substr($product->user->last_name, 0, 1) : 'NA' }}
                                </div>
                                <span class="font-body-lg text-body-lg text-on-surface">
                                    {{ $product->user ? $product->user->first_name . ' ' . $product->user->last_name : 'Sin usuario' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-body-lg text-body-lg font-bold text-on-surface">S/. {{ number_format($product->price, 2) }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full {{ $product->is_active ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : 'bg-surface-container-high text-on-surface-variant' }} font-label-caps text-label-caps">
                                {{ $product->is_active ? 'ACTIVO' : 'PENDIENTE' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @if(!$product->is_active)
                                <form action="{{ route('admin.products.updateStatus', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="is_active" value="1">
                                    <button type="submit" class="p-2 text-tertiary hover:bg-tertiary-fixed rounded-lg transition-all" title="Aprobar publicación">
                                        <span class="material-symbols-outlined">check_circle</span>
                                    </button>
                                </form>
                                @endif
                                <button
                                    type="button"
                                    class="p-2 text-error hover:bg-error-container rounded-lg transition-all"
                                    title="Suspender publicación"
                                    @click="$dispatch('abrir-modal-suspender', {
                                        id: {{ $product->id }},
                                        titulo: @js($product->title)
                                    })">
                                    <span class="material-symbols-outlined">block</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex items-center justify-between font-body-sm text-body-sm text-on-surface-variant mt-4">
        <span>Mostrando {{ $products->count() }} publicaciones</span>
    </div>

    <!-- Modal de suspensión -->
    <div
        x-data="{ abierto: false, productoId: null, productoTitulo: '' }"
        @abrir-modal-suspender.window="
            abierto = true;
            productoId = $event.detail.id;
            productoTitulo = $event.detail.titulo;
        "
        x-show="abierto"
        x-cloak
        class="fixed inset-0 z-[200] flex items-center justify-center bg-black/50"
        @keydown.escape.window="abierto = false">

        <div
            @click.stop
            x-show="abierto"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-xl w-full max-w-md mx-4 shadow-2xl overflow-hidden">

            <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100">
                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-red-600">block</span>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-900">Suspender publicación</h2>
                    <p class="text-sm text-gray-500 mt-0.5" x-text="productoTitulo"></p>
                </div>
            </div>

            <form :action="`/admin/products/${productoId}/suspend`" method="POST" class="px-6 py-5 space-y-4">
                @csrf
                <p class="text-sm text-gray-600">
                    Esta acción <strong>desactivará la publicación</strong>. El vendedor será notificado con el motivo que indiques.
                </p>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Motivo de la suspensión <span class="text-red-500">*</span></label>
                    <textarea
                        name="reason"
                        rows="3"
                        required
                        placeholder="Ej: Contenido que viola las políticas de la plataforma..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent resize-none transition"></textarea>
                </div>
                <div class="flex justify-end gap-2 mt-4 pt-4 border-t border-gray-100">
                    <button
                        type="button"
                        @click="abierto = false"
                        class="px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-error text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition-all">
                        Confirmar Suspensión
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
