<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Renombrar 'name' a 'first_name' si aún existe
            if (Schema::hasColumn('users', 'name') && !Schema::hasColumn('users', 'first_name')) {
                $table->renameColumn('name', 'first_name');
            } elseif (!Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name', 80)->after('id');
            }

            if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name', 80)->after('first_name');
            }
            if (!Schema::hasColumn('users', 'dob')) {
                $table->date('dob')->nullable()->after('last_name');
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 30)->nullable()->after('dob');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'role')) {
                // 'admin' | 'user'
                $table->string('role', 20)->default('user')->after('phone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = ['last_name', 'dob', 'gender', 'phone', 'role'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $table->dropColumn($col);
                }
            }
            if (Schema::hasColumn('users', 'first_name')) {
                $table->renameColumn('first_name', 'name');
            }
        });
    }
};
