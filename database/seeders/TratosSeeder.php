<?php

namespace Database\Seeders;

use App\Models\Trato;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class TratosSeeder extends Seeder
{
    public function run(): void
    {
        // Usamos los usuarios ya existentes en la BD
        $buyer  = User::where('email', 'usuario@marketplace.com')->first(); // Juan Pérez
        $seller = User::where('email', 'kevin@marketplace.com')->first();   // Kevin Gilbert

        if (!$buyer || !$seller) {
            return; // Si no existen los usuarios, no sembramos
        }

        // Traemos los 3 primeros productos del catálogo para los tratos de ejemplo
        $products = Product::where('user_id', $seller->id)->take(3)->get();

        if ($products->isEmpty()) {
            return;
        }

        // 3 tratos de muestra en diferentes estados del flujo de compra
        $demos = [
            [
                'product' => $products->get(0), // MacBook Pro
                'price'   => 950.00,
                'sku'     => 'LAP-MBP-001',
                'status'  => 'aprobado',
            ],
            [
                'product' => $products->get(1), // Sony WH
                'price'   => 520.00,
                'sku'     => 'AUD-SWH-002',
                'status'  => 'en_discusion',
            ],
            [
                'product' => $products->get(2), // Samsung Galaxy
                'price'   => 850.00,
                'sku'     => 'CEL-SGX-003',
                'status'  => 'recibido',
            ],
        ];

        foreach ($demos as $demo) {
            Trato::create([
                'buyer_id'   => $buyer->id,
                'seller_id'  => $seller->id,
                'product_id' => $demo['product']->id,
                'price'      => $demo['price'],
                'sku'        => $demo['sku'],
                'status'     => $demo['status'],
            ]);
        }
    }
}
