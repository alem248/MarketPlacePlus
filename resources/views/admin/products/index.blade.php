@extends('layouts.admin')
@section('title', 'Gestionar Publicaciones')
@section('page_title', 'Gestionar Publicaciones')

@section('content')
<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-surface">Publicaciones del Marketplace</h1>
        <p class="text-on-surface-variant text-body-lg">Administre todas las publicaciones de productos</p>
    </div>
    <a href="{{ route('admin.products.create') }}"
        class="bg-primary text-on-primary px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:brightness-110 transition-all shadow-sm">
        <span class="material-symbols-outlined">add</span> Nueva Publicación
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-surface-container border-b border-outline-variant">
                <tr>
                    <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">PRODUCTO</th>
                    <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">VENDEDOR</th>
                    <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">PRECIO</th>
                    <th class="px-6 py-4 text-left font-label-caps text-label-caps text-on-surface-variant">ESTADO</th>
                    <th class="px-6 py-4 text-center font-label-caps text-label-caps text-on-surface-variant">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @forelse($products as $product)
                <tr class="hover:bg-surface-container-low/50 transition-colors">
                    <td class="px-6 py-4 max-w-xs">
                        <p class="font-semibold text-body-sm text-on-surface truncate">{{ $product->title }}</p>
                        <p class="text-[11px] text-on-surface-variant">{{ $product->category }} · {{ $product->location }}</p>
                    </td>
                    <td class="px-6 py-4 text-body-sm text-on-surface-variant">
                        {{ $product->user->full_name ?? 'Sin asignar' }}
                    </td>
                    <td class="px-6 py-4 font-bold text-primary">S/. {{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4">
                        @if($product->is_active)
                            <span class="bg-tertiary-container/30 text-tertiary px-3 py-1 rounded-full text-label-caps font-bold">ACTIVO</span>
                        @else
                            <span class="bg-surface-container-high text-on-surface-variant px-3 py-1 rounded-full text-label-caps font-bold">INACTIVO</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="p-2 bg-surface-container-high text-on-surface rounded-lg hover:bg-outline-variant transition-colors" title="Editar">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar esta publicación?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Eliminar">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl">inventory_2</span>
                        <p class="mt-3 font-body-lg">No hay publicaciones registradas.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-outline-variant">
        {{ $products->links() }}
    </div>
</div>
@endsection
