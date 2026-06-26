@extends('layouts.admin')
@section('title', 'Moderación de Comentarios')
@section('page_title', 'Gestión de Comentarios')

@section('content')
<header class="mb-10">
    <h1 class="font-headline-lg text-headline-lg text-primary mb-2">Moderación de Comentarios</h1>
    <p class="text-on-surface-variant font-body-lg">Supervisa y administra las reseñas publicadas por los usuarios en la plataforma.</p>
</header>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
@endif

<div class="space-y-6">
    @forelse($comments as $comment)
    <article class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow {{ $comment->is_active ? '' : 'opacity-60' }}">
        <div class="flex items-start justify-between gap-4">

            <div class="flex gap-4 flex-1 min-w-0">
                <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold text-lg flex-shrink-0">
                    {{ strtoupper(substr($comment->user->first_name ?? 'U', 0, 1)) }}
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                        <h4 class="font-headline-md text-headline-md">
                            {{ $comment->user->first_name ?? 'Usuario' }} {{ $comment->user->last_name ?? '' }}
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
                        PRODUCTO: {{ Str::upper($comment->product->title ?? 'Sin producto') }}
                    </p>

                    <p class="font-body-lg text-body-lg text-on-surface max-w-2xl leading-relaxed">
                        {{ $comment->content }}
                    </p>

                    <!-- Mostrar motivo de desactivación si existe -->
                    @if(!$comment->is_active && $comment->admin_message)
                        <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-red-600 text-sm font-medium">⚠️ Motivo de desactivación:</p>
                            <p class="text-gray-700 text-sm">{{ $comment->admin_message }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex flex-col gap-2 min-w-[130px]">
                @if($comment->is_active)
                    <!-- Botón que abre el modal -->
                    <button type="button"
                        onclick="openModal({{ $comment->id }})"
                        class="w-full border border-error text-error font-bold py-2 px-4 rounded-lg hover:bg-error-container transition-all text-body-sm">
                        Deshabilitar
                    </button>
                @else
                    <!-- Botón para habilitar -->
                    <form action="{{ route('admin.comments.enable', $comment) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="w-full bg-primary text-on-primary font-bold py-2 px-4 rounded-lg hover:brightness-110 transition-all text-body-sm">
                            Habilitar
                        </button>
                    </form>
                @endif
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

<!-- ============================================ -->
<!-- MODAL PARA DESHABILITAR COMENTARIO -->
<!-- ============================================ -->

<!-- Fondo oscuro (overlay) -->
<div id="modalOverlay" class="fixed inset-0 bg-black/50 z-40 hidden"></div>

<!-- Modal -->
<div id="disableModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-md w-full p-6">
            <!-- Cabecera -->
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xl font-bold text-red-600 dark:text-red-400">
                    ⚠️ Deshabilitar Comentario
                </h3>
                <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-2xl">
                    ✕
                </button>
            </div>

            <!-- Formulario -->
            <form id="disableForm" method="POST" action="">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="admin_message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Motivo de desactivación <span class="text-red-600">*</span>
                    </label>
                    <textarea
                        id="admin_message"
                        name="admin_message"
                        rows="4"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="Ej: El comentario contiene lenguaje inapropiado, spam o información falsa..."
                        required
                    ></textarea>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Mínimo 5 caracteres. Máximo 500 caracteres.</p>
                </div>

                <!-- Botones -->
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition">
                        Deshabilitar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- JAVASCRIPT PURO -->
<!-- ============================================ -->

<script>
    // Función para abrir el modal
    function openModal(commentId) {
        const modal = document.getElementById('disableModal');
        const overlay = document.getElementById('modalOverlay');
        const form = document.getElementById('disableForm');
        const textarea = document.getElementById('admin_message');

        // Configurar la acción del formulario (usando la ruta con nombre)
        form.action = `/admin/comments/${commentId}/disable-with-reason`;

        // Limpiar el textarea
        textarea.value = '';
        textarea.classList.remove('border-red-500', 'ring-2', 'ring-red-200');

        // Mostrar modal y overlay
        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');

        // Prevenir scroll en el body
        document.body.style.overflow = 'hidden';

        // Enfocar el textarea después de un pequeño delay
        setTimeout(() => {
            textarea.focus();
        }, 150);
    }

    // Función para cerrar el modal
    function closeModal() {
        const modal = document.getElementById('disableModal');
        const overlay = document.getElementById('modalOverlay');

        // Ocultar modal y overlay
        modal.classList.add('hidden');
        overlay.classList.add('hidden');

        // Restaurar scroll
        document.body.style.overflow = '';
    }

    // Cerrar con tecla ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });

    // Cerrar al hacer clic en el overlay (fondo oscuro)
    document.getElementById('modalOverlay').addEventListener('click', function() {
        closeModal();
    });

    // Validación antes de enviar
    document.getElementById('disableForm').addEventListener('submit', function(event) {
        const textarea = document.getElementById('admin_message');
        const value = textarea.value.trim();

        if (value.length < 5) {
            event.preventDefault();
            textarea.classList.add('border-red-500', 'ring-2', 'ring-red-200');
            textarea.focus();
            alert('El motivo debe tener al menos 5 caracteres.');
        }
    });

    // Quitar el borde rojo cuando el usuario escribe
    document.getElementById('admin_message').addEventListener('input', function() {
        this.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
    });

    // Prevenir que el clic dentro del modal lo cierre
    document.querySelector('#disableModal .relative').addEventListener('click', function(event) {
        event.stopPropagation();
    });
</script>

<!-- Estilos adicionales -->
<style>
    /* Animación de entrada del modal */
    #disableModal .relative {
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Transición del overlay */
    #modalOverlay {
        transition: opacity 0.3s ease;
    }

    #modalOverlay:not(.hidden) {
        opacity: 1;
    }

    #modalOverlay.hidden {
        opacity: 0;
    }

    /* Estilos para errores */
    .border-red-500 {
        border-color: #ef4444 !important;
    }

    .ring-2 {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
    }

    .ring-red-200 {
        --tw-ring-color: #fca5a5;
    }
</style>

@endsection