<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trato_id')->unique()->constrained()->cascadeOnDelete();

            // Datos del formulario del vendedor
            $table->string('pickup_address');
            $table->string('delivery_address');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->enum('shipping_type', ['regular', 'express'])->default('regular');
            $table->text('notes')->nullable();

            // Estado del proceso
            $table->enum('status', ['pendiente', 'aprobado', 'rechazado', 'en_camino', 'entregado'])
                  ->default('pendiente');

            // Datos del repartidor (rellenados por el admin al aprobar)
            $table->string('courier_name')->nullable();
            $table->string('courier_plate')->nullable();
            $table->string('courier_phone')->nullable();
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
