<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->text('suspension_reason')->nullable(); // Guardará el motivo de la suspensión
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('suspension_reason');
    });
}
};
