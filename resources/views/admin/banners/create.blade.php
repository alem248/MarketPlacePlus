@extends('layouts.admin')
@section('title', 'Nuevo Banner')
@section('page_title', 'Subir Nuevo Banner')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-2 text-primary hover:underline font-bold text-body-sm">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Volver a Banners
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-8 max-w-4xl mx-auto">
    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-8">Nuevo Banner</h1>

    @if($errors->any())
    <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-xl space-y-1">
        @foreach($errors->all() as $e)
        <p class="text-body-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-[16px]">error</span>{{ $e }}
        </p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Columna Izquierda --}}
            <div class="space-y-6">
                {{-- Selector de zona --}}
                <div>
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">ZONA DE PUBLICIDAD <span class="text-error">*</span></label>
                    <div class="grid grid-cols-2 gap-3">
                        @php $currentZone = old('zone', 'hero'); @endphp
                        <label class="flex items-center gap-3 p-4 border-2 rounded-xl cursor-pointer transition-all
                            {{ $currentZone === 'hero' ? 'border-primary bg-primary/5' : 'border-outline-variant hover:border-primary/40' }}">
                            <input type="radio" name="zone" value="hero" class="accent-primary"
                                {{ $currentZone === 'hero' ? 'checked' : '' }} required>
                            <div>
                                <p class="font-bold text-on-surface text-body-sm">Banner Principal</p>
                                <p class="text-[11px] text-on-surface-variant mt-0.5">Zona hero, sobre el catálogo</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 border-2 rounded-xl cursor-pointer transition-all
                            {{ $currentZone === 'sidebar' ? 'border-primary bg-primary/5' : 'border-outline-variant hover:border-primary/40' }}">
                            <input type="radio" name="zone" value="sidebar" class="accent-primary"
                                {{ $currentZone === 'sidebar' ? 'checked' : '' }}>
                            <div>
                                <p class="font-bold text-on-surface text-body-sm">Banner Lateral</p>
                                <p class="text-[11px] text-on-surface-variant mt-0.5">Zona sidebar, panel izquierdo</p>
                            </div>
                        </label>
                    </div>
                    <p class="text-body-sm text-on-surface-variant mt-2">
                        Si ya hay un banner activo en esa zona, se desactivará automáticamente.
                    </p>
                </div>

                <div>
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">TÍTULO DEL BANNER <span class="text-error">*</span></label>
                    <input name="title" type="text" value="{{ old('title') }}" required
                        class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                        placeholder="Ej: Campaña de Verano 2026">
                </div>

                <div>
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">DESCRIPCIÓN CORTA</label>
                    <input name="description" type="text" value="{{ old('description') }}"
                        class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                        placeholder="Ej: Nuevos modelos disponibles con garantía incluida">
                    <p class="text-body-sm text-on-surface-variant mt-1">Texto que aparece bajo el título en la tienda (máx. 255 caracteres)</p>
                </div>

                <div>
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">URL DE ENLACE</label>
                    <input name="link_url" type="text" value="{{ old('link_url') }}"
                        class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg"
                        placeholder="/promociones/verano-tecnologia">
                    <p class="text-body-sm text-on-surface-variant mt-1">Ruta interna del marketplace (ej: /categorias/tecnologia)</p>
                </div>

                <div>
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">FECHA DE FIN</label>
                    <input name="end_date" type="date" value="{{ old('end_date') }}"
                        class="w-full p-4 rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary bg-white font-body-lg">
                </div>

                {{-- Estado activo/inactivo --}}
                <div class="flex items-center gap-3 p-4 bg-surface-container rounded-xl">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" id="is_active" name="is_active" value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-5 h-5 accent-primary cursor-pointer">
                    <label for="is_active" class="font-body-lg cursor-pointer">Banner activo (visible en la tienda)</label>
                </div>
            </div>

            {{-- Columna Derecha - Multimedia --}}
            <div>
                <section class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm h-full">
                    <div class="flex items-center gap-2 mb-4 text-primary">
                        <span class="material-symbols-outlined">photo_library</span>
                        <h2 class="font-headline-md text-headline-md">Imagen del Banner</h2>
                    </div>

                    <p id="create-banner-error-msg" class="hidden text-red-600 text-sm font-bold mb-4 bg-red-50 p-3 rounded-lg border border-red-200">
                        Archivo no compatible, solo utilice los formatos disponibles (JPG, PNG).
                    </p>

                    <div>
                        <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">
                            IMAGEN DEL BANNER <span class="text-error">*</span>
                        </label>
                        <div class="grid grid-cols-1 gap-4">
                            <label for="create-banner-image-input" class="border-2 border-dashed border-outline-variant rounded-xl p-8 flex flex-col items-center justify-center text-center hover:bg-surface-container-low transition-colors cursor-pointer group relative overflow-hidden min-h-[200px]">
                                <input type="file" id="create-banner-image-input" name="image" accept="image/jpeg, image/png" class="hidden" required>
                                
                                <div id="create-upload-preview" class="hidden absolute inset-0 w-full h-full">
                                    <img id="create-preview-img" class="w-full h-full object-cover" src="">
                                </div>

                                <div id="create-upload-instructions" class="flex flex-col items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-outline-variant group-hover:text-primary transition-colors">cloud_upload</span>
                                    <p class="mt-2 font-body-lg font-bold text-on-surface">Haz clic para subir la imagen</p>
                                    <p class="text-on-surface-variant text-sm mt-1">JPG, PNG (Max. 5MB)<br>Ideal: 1200×450px</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Vista previa del banner --}}
                    <div class="mt-4 p-4 bg-surface-container rounded-xl border border-outline-variant">
                        <p class="text-label-caps text-label-caps text-on-surface-variant mb-2">VISTA PREVIA</p>
                        <div class="aspect-[16/5] bg-surface-container-high rounded-lg overflow-hidden flex items-center justify-center border border-outline-variant">
                            <div id="preview-placeholder" class="flex flex-col items-center justify-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-4xl">image</span>
                                <p class="text-sm mt-1">Selecciona una imagen</p>
                            </div>
                            <img id="preview-banner" class="hidden w-full h-full object-cover" src="">
                        </div>
                    </div>
                </section>
            </div>
        </div>

        {{-- Botones --}}
        <div class="flex gap-4 pt-4 border-t border-outline-variant mt-6">
            <a href="{{ route('admin.banners.index') }}"
                class="flex-1 py-4 border border-outline text-on-surface font-bold rounded-xl text-center hover:bg-surface-container-high transition-all">
                Cancelar
            </a>
            <button type="submit"
                class="flex-1 py-4 bg-primary text-on-primary font-bold rounded-xl hover:brightness-110 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">save</span> Guardar Banner
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('create-banner-image-input').addEventListener('change', function(event) {
        const errorMsg = document.getElementById('create-banner-error-msg');
        const allowedTypes = ['image/jpeg', 'image/png'];
        const preview = document.getElementById('create-upload-preview');
        const previewImg = document.getElementById('create-preview-img');
        const instructions = document.getElementById('create-upload-instructions');
        const bannerPreview = document.getElementById('preview-banner');
        const placeholder = document.getElementById('preview-placeholder');
        
        if (this.files.length > 0) {
            const file = this.files[0];
            
            if (!allowedTypes.includes(file.type)) {
                errorMsg.classList.remove('hidden');
                this.value = '';
                preview.classList.add('hidden');
                instructions.classList.remove('hidden');
                bannerPreview.classList.add('hidden');
                placeholder.classList.remove('hidden');
                return;
            }
            
            errorMsg.classList.add('hidden');
            
            const reader = new FileReader();
            reader.onload = function(e) {
                // Mostrar en el área de subida
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                instructions.classList.add('hidden');
                
                // Mostrar en la vista previa
                bannerPreview.src = e.target.result;
                bannerPreview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection