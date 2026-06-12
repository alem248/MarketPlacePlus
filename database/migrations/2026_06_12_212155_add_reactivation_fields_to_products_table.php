<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->timestamp('reactivated_at')->nullable()->after('suspension_reason');
            $table->timestamp('viewed_reactivation_at')->nullable()->after('reactivated_at');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['reactivated_at', 'viewed_reactivation_at']);
        });
    }
};
