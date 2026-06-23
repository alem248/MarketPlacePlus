<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tratos', function (Blueprint $table) {
            $table->boolean('seller_confirmed')->default(false)->after('payment_method');
            $table->boolean('buyer_confirmed')->default(false)->after('seller_confirmed');
        });
    }

    public function down(): void
    {
        Schema::table('tratos', function (Blueprint $table) {
            $table->dropColumn(['seller_confirmed', 'buyer_confirmed']);
        });
    }
};
