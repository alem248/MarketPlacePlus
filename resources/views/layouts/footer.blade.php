<footer class="w-full mt-gutter bg-inverse-surface">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-mobile md:px-gutter py-12 max-w-container-max mx-auto">
        <div class="md:col-span-1">
            <span class="text-headline-md font-headline-md font-bold text-on-primary">MarketPlace Plus</span>
            <p class="text-body-sm text-surface-variant mt-4">La plataforma líder para conectar compradores y vendedores de forma directa y segura.</p>
        </div>
        <div>
            <h4 class="text-label-caps font-label-caps text-on-primary mb-6">ENLACES RÁPIDOS</h4>
            <ul class="flex flex-col gap-3">
                <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors btn-soon" href="#">Comprar producto</a></li>
                <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors" href="{{ route('tratos.index') }}">Mis tratos</a></li>
                <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors btn-soon" href="#">Rastrear pedido</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-label-caps font-label-caps text-on-primary mb-6">SOPORTE</h4>
            <ul class="flex flex-col gap-3">
                <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors btn-soon" href="#">Ayuda al cliente</a></li>
                <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors btn-soon" href="#">Sobre nosotros</a></li>
                <li><a class="text-body-sm text-surface-variant hover:text-on-primary transition-colors btn-soon" href="#">Términos y condiciones</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-label-caps font-label-caps mb-6 uppercase tracking-wider text-white">RECOMENDACIONES PARA TUS TRATOS</h4>
            <div class="flex flex-col gap-4">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-white" style="font-size:20px">check_circle</span>
                    <p class="text-body-sm text-white">Verifica la reputación del vendedor</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-white" style="font-size:20px">location_on</span>
                    <p class="text-body-sm text-white">Realiza tus tratos en lugares públicos</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-white" style="font-size:20px">chat</span>
                    <p class="text-body-sm text-white">Usa WhatsApp para mayor seguridad</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-white" style="font-size:20px">security</span>
                    <p class="text-body-sm text-white">No compartas datos bancarios sensibles</p>
                </div>
            </div>
        </div>
    </div>
    <div class="border-t border-outline/30 py-6 px-gutter max-w-container-max mx-auto text-center">
        <p class="text-body-sm text-surface-variant/60">Market Place Plus © 2026</p>
    </div>
</footer>
