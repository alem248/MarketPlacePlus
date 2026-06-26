@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Panel de Administración')

@section('content')
<div class="space-y-8">
    <section>
        <h1 class="font-headline-lg text-headline-lg text-primary">Panel de Administración</h1>
        <p class="font-body-lg text-on-surface-variant">Acceso directo a los módulos de gestión crítica del sistema.</p>
    </section>
    <div class="grid grid-cols-1 gap-8">
        <!-- Publicaciones Recientes -->
        <div class="bg-surface-container-lowest rounded-lg border border-outline-variant overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-white">
                <h2 class="font-headline-md text-on-surface">Publicaciones Recientes</h2>
                <a href="{{ route('admin.products.index') }}" class="text-primary font-bold font-body-sm hover:underline">Ver todas</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-surface-container-low">
                        <tr>
                            <th class="px-6 py-3 font-label-caps text-on-surface-variant">Producto</th>
                            <th class="px-6 py-3 font-label-caps text-on-surface-variant">Vendedor</th>
                            <th class="px-6 py-3 font-label-caps text-on-surface-variant text-right">Precio</th>
                            <th class="px-6 py-3 font-label-caps text-on-surface-variant text-center">Estado</th>
                            <th class="px-6 py-3 font-label-caps text-on-surface-variant text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($products as $product)
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded bg-surface-container-high overflow-hidden flex-shrink-0">
                                        @php
                                            $firstImage = is_array($product->image_path) && count($product->image_path) > 0
                                                ? $product->image_path[0]
                                                : null;
                                            $imgSrc = $firstImage
                                                ? (Str::startsWith($firstImage, ['http://', 'https://'])
                                                    ? $firstImage
                                                    : asset('storage/' . $firstImage))
                                                : null;
                                        @endphp
                                        @if($imgSrc)
                                        <img alt="{{ $product->title }}" class="w-full h-full object-cover" src="{{ $imgSrc }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                        <div class="w-full h-full bg-surface-variant items-center justify-center hidden"><span class="material-symbols-outlined text-outline" style="font-size:18px">image</span></div>
                                        @else
                                        <div class="w-full h-full bg-surface-variant flex items-center justify-center"><span class="material-symbols-outlined text-outline" style="font-size:18px">image</span></div>
                                        @endif
                                    </div>
                                    <span class="font-semibold text-body-lg">{{ $product->title }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-body-sm">{{ $product->user->first_name.' '.$product->user->last_name ?? 'Sin asignar' }}</td>
                            <td class="px-6 py-4 text-right font-body-lg font-bold">S/. {{ number_format((float)$product->price, 2) }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full {{ $product->is_active ? 'bg-tertiary-fixed' : 'bg-error-container' }} text-[10px] font-bold">
                                    {{ $product->is_active ? 'ACTIVO' : 'INACTIVO' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($product->is_active)
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Desactivar esta publicación?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-error hover:bg-error-container p-1 rounded-full ml-2" title="Desactivar"><span class="material-symbols-outlined">block</span></button>
                                    </form>
                                @else
                                    <button disabled class="text-on-surface-variant p-1 rounded-full ml-2 opacity-50 cursor-not-allowed" title="Publicación desactivada"><span class="material-symbols-outlined">block</span></button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-outline">No hay publicaciones registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Moderación de Comentarios -->
            <div class="bg-surface-container-lowest rounded-lg border border-outline-variant shadow-sm flex flex-col">
                <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-white">
                    <h2 class="font-headline-md text-on-surface">Moderación de Comentarios</h2>
                    <span class="material-symbols-outlined text-outline">forum</span>
                </div>
                <div class="p-6 space-y-4 flex-1">
                    @forelse($recentComments as $comment)
                    <div class="p-4 bg-surface-container-low rounded-lg border border-outline-variant {{ $comment->is_active ? '' : 'opacity-60' }}">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-primary">{{ $comment->user->first_name }} {{ substr($comment->user->last_name, 0, 1) }}.</p>
                                <div class="flex text-secondary-container">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= ($comment->rating ?? 0))
                                            <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                        @else
                                            <span class="material-symbols-outlined text-xs text-outline-variant">star</span>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <span class="text-[10px] text-on-surface-variant font-medium uppercase">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-body-sm text-on-surface italic mb-3 line-clamp-2">"{{ $comment->content }}"</p>
                        <div class="flex gap-2 justify-end">
                            <form action="{{ route('admin.comments.toggle', $comment) }}" method="POST">
                                @csrf @method('PATCH')
                                @if($comment->is_active)
                                    <button type="submit" class="px-3 py-1 text-[11px] font-bold border border-error text-error rounded-md hover:bg-error-container transition-colors">Deshabilitar</button>
                                @else
                                    <button type="submit" class="px-3 py-1 text-[11px] font-bold bg-primary text-on-primary rounded-md hover:brightness-110 transition-all">Habilitar</button>
                                @endif
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-body-sm text-on-surface-variant text-center py-4">No hay comentarios registrados.</p>
                    @endforelse
                </div>
                <a href="{{ route('admin.comments.index') }}" class="m-6 mt-0 py-2 border border-outline text-on-surface font-bold rounded-lg hover:bg-surface-container-high transition-all text-sm text-center block">Ver todos los comentarios</a>
            </div>

            <!-- Gestión de Publicidad -->
            <div class="bg-surface-container-lowest rounded-lg border border-outline-variant shadow-sm flex flex-col">
                <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-white">
                    <h2 class="font-headline-md text-on-surface">Gestión de Publicidad</h2>
                    <span class="material-symbols-outlined text-secondary">campaign</span>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($banners->take(2) as $banner)
                        <div class="relative overflow-hidden rounded-lg border border-outline-variant aspect-video bg-surface-container {{ !$banner->is_active ? 'grayscale opacity-60' : '' }}">
                            @php
                                $imgSrc = Str::startsWith($banner->image_path ?? '', ['http://', 'https://'])
                                    ? $banner->image_path
                                    : asset('storage/' . $banner->image_path);
                            @endphp
                            @if($banner->image_path)
                                <img alt="{{ $banner->title }}" class="w-full h-full object-cover" src="{{ $imgSrc }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center"><span class="material-symbols-outlined text-3xl text-outline">image</span></div>
                            @endif
                            <div class="absolute bottom-2 left-2 {{ $banner->is_active ? 'bg-secondary text-on-secondary' : 'bg-surface-container-highest text-on-surface-variant' }} text-[9px] px-1.5 py-0.5 rounded font-bold uppercase">
                                {{ $banner->is_active ? 'Activo' : 'Inactivo' }}
                            </div>
                        </div>
                        @endforeach
                        @for($i = $banners->count(); $i < 2; $i++)
                        <div class="overflow-hidden rounded-lg border-2 border-dashed border-outline-variant aspect-video bg-surface-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-3xl text-outline">add_photo_alternate</span>
                        </div>
                        @endfor
                    </div>
                    <div class="bg-primary-container/10 p-4 rounded-lg border border-primary/20 mt-2">
                        <p class="font-body-sm font-semibold text-primary mb-1">Banners activos: {{ $banners->where('is_active', true)->count() }}</p>
                        <p class="text-[12px] text-on-surface-variant">Total registrados: {{ $banners->count() }}</p>
                    </div>
                </div>
                <div class="p-6 pt-0 mt-auto">
                    <a href="{{ route('admin.banners.index') }}"
                       class="w-full bg-primary text-on-primary font-bold py-3 rounded-lg flex items-center justify-center gap-2 hover:brightness-110 active:scale-[0.98] transition-all">
                        <span class="material-symbols-outlined">add_photo_alternate</span>
                        Gestionar Banners
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.addEventListener('load', () => {
        const sections = document.querySelectorAll('main > div > div > div');
        sections.forEach((section, index) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(15px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            setTimeout(() => {
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    });
</script>
@endsection
