<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tratos', function (Blueprint $table) {
            // Método de pago que el comprador escribe en la vista de seguimiento
            // Ej: "Transferencia Bancaria", "Yape", "Efectivo"
            $table->string('payment_method')->nullable()->after('sku');
        });
    }

    public function down(): void
    {
        Schema::table('tratos', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });
    }
};
