<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Dividimos el nombre en first_name y last_name
            // Primero renombramos 'name' si ya existe, o añadimos columnas nuevas
            if (Schema::hasColumn('users', 'name')) {
                $table->renameColumn('name', 'first_name');
            } else {
                $table->string('first_name', 80)->after('id');
            }

            $table->string('last_name', 80)->after('first_name');
            $table->date('dob')->nullable()->after('last_name');
            $table->string('gender', 30)->nullable()->after('dob');
            $table->string('phone', 20)->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'dob', 'gender', 'phone']);
            if (Schema::hasColumn('users', 'first_name')) {
                $table->renameColumn('first_name', 'name');
            }
        });
    }
};
