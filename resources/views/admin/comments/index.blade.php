@extends('layouts.admin')
@section('title', 'Moderación de Comentarios')
@section('page_title', 'Gestión de Comentarios')

@section('content')
<header class="mb-10">
    <h1 class="font-headline-lg text-headline-lg text-primary mb-2">Moderación de Comentarios</h1>
    <p class="text-on-surface-variant font-body-lg">Supervisa y administra las reseñas publicadas por los usuarios en la plataforma.</p>
</header>

<div class="space-y-6">
    @forelse($comments as $comment)
    <article class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow {{ $comment->is_active ? '' : 'opacity-60' }}">
        <div class="flex items-start justify-between gap-4">

            <div class="flex gap-4 flex-1 min-w-0">
                <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold text-lg flex-shrink-0">
                    {{ strtoupper(substr($comment->user->first_name, 0, 1)) }}
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                        <h4 class="font-headline-md text-headline-md">
                            {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                        </h4>
                        @unless($comment->is_active)
                            <span class="bg-error-container text-error text-[10px] font-bold px-2 py-0.5 rounded-full">DESHABILITADO</span>
                        @endunless
                        <span class="text-outline text-body-sm">•</span>
                        <p class="text-on-surface-variant font-body-sm">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="flex items-center gap-0.5 mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= ($comment->rating ?? 0))
                                <span class="material-symbols-outlined text-secondary-container" style="font-variation-settings: 'FILL' 1; font-size: 18px;">star</span>
                            @else
                                <span class="material-symbols-outlined text-outline-variant" style="font-size: 18px;">star</span>
                            @endif
                        @endfor
                    </div>

                    <p class="font-label-caps text-label-caps text-secondary mb-2 uppercase">
                        PRODUCTO: {{ Str::upper($comment->product->title) }}
                    </p>

                    <p class="font-body-lg text-body-lg text-on-surface max-w-2xl leading-relaxed">
                        {{ $comment->content }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-2 min-w-[130px]">
                <form action="{{ route('admin.comments.toggle', $comment) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    @if($comment->is_active)
                        <button type="submit"
                            class="w-full border border-error text-error font-bold py-2 px-4 rounded-lg hover:bg-error-container transition-all text-body-sm">
                            Deshabilitar
                        </button>
                    @else
                        <button type="submit"
                            class="w-full bg-primary text-on-primary font-bold py-2 px-4 rounded-lg hover:brightness-110 transition-all text-body-sm">
                            Habilitar
                        </button>
                    @endif
                </form>
            </div>

        </div>
    </article>

    @empty
    <div class="text-center py-20 text-on-surface-variant">
        <span class="material-symbols-outlined text-6xl mb-4 block">forum</span>
        <p class="font-headline-md text-headline-md">No hay comentarios registrados.</p>
        <p class="font-body-sm mt-2">Cuando los usuarios dejen reseñas aparecerán aquí.</p>
    </div>
    @endforelse
</div>

@if($comments->hasPages())
<div class="mt-8">
    {{ $comments->links() }}
</div>
@endif
@endsection
