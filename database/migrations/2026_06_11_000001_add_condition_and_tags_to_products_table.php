<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Estado del producto: "Nuevo", "Usado - Como nuevo", "Usado", etc.
            $table->string('condition')->nullable()->after('is_active');

            // Etiquetas del producto almacenadas como JSON: ["Apple", "Laptops", "Premium"]
            $table->json('tags')->nullable()->after('condition');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['condition', 'tags']);
        });
    }
};
