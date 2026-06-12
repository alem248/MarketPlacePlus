<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tratos', function (Blueprint $table) {
            $table->id();

            // Comprador: el usuario que inicia el trato
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');

            // Vendedor: el dueño del producto
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');

            // Producto sobre el que se negocia
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Precio acordado en el trato (puede diferir del precio del producto)
            $table->decimal('price', 10, 2);

            // Código de referencia corto para el trato
            $table->string('sku', 30)->nullable();

            // Estado del trato: pedido_realizado → en_discusion → aprobado → recibido
            $table->string('status')->default('pedido_realizado');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tratos');
    }
};
