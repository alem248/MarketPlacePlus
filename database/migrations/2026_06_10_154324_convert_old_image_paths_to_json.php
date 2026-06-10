<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

return new class extends Migration
{
    public function up(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $rawPath = $product->getRawOriginal('image_path');

            if ($rawPath && !str_starts_with($rawPath, '[')) {
                $product->image_path = [$rawPath];
                $product->save();
            }
        }
    }

    public function down(): void
    {
        //
    }
};