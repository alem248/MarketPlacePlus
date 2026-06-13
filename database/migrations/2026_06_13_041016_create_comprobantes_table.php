<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trato_id')->unique()->constrained('tratos')->cascadeOnDelete();
            $table->foreignId('buyer_id')->constrained('users');
            $table->foreignId('seller_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->decimal('price', 10, 2);
            // Método de pago normalizado: solo el nombre (Tarjeta, Yape, Efectivo, etc.)
            $table->string('payment_method', 100)->default('No especificado');
            // Código único de transacción: TRT-00001-2026
            $table->string('transaction_code', 30)->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};
