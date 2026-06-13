<?php

namespace Database\Seeders;

use App\Models\Trato;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TratosSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiamos tratos anteriores para evitar duplicados al re-sembrar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Trato::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Usuarios base del proyecto
        $juan  = User::where('email', 'usuario@marketplace.com')->first(); // Juan Pérez
        $kevin = User::where('email', 'kevin@marketplace.com')->first();   // Kevin Gilbert

        if (!$juan || !$kevin) {
            $this->command->warn('Faltan usuarios base. Ejecuta primero AdminSeeder y ProductSeeder.');
            return;
        }

        // Segundo comprador de prueba
        $maria = User::firstOrCreate(
            ['email' => 'maria@marketplace.com'],
            [
                'first_name' => 'María',
                'last_name'  => 'López',
                'password'   => Hash::make('maria1234'),
                'phone'      => '51912345678',
                'dob'        => '1998-07-22',
                'gender'     => 'female',
                'role'       => 'user',
            ]
        );

        // ── Productos de Kevin (ya existen desde ProductSeeder) ───────────────
        $kevinProducts = Product::where('user_id', $kevin->id)->get();

        if ($kevinProducts->isEmpty()) {
            $this->command->warn('Kevin no tiene productos. Ejecuta primero ProductSeeder.');
            return;
        }

        // ── Productos de Juan (creamos 3 para que pueda ser vendedor) ─────────
        // Usamos firstOrCreate para no duplicar si el seeder se vuelve a correr.
        $juanProd1 = Product::firstOrCreate(
            ['user_id' => $juan->id, 'title' => 'iPad Air 5ta Generación - 64GB WiFi'],
            [
                'category'    => 'Tablets',
                'location'    => 'Lima - Jesús María',
                'condition'   => 'Usado - Buen estado',
                'price'       => 380.00,
                'tags'        => ['Tablets', 'Apple', 'iPad'],
                'description' => "iPad Air 5ta generación en excelente estado.\n- Chip M1\n- Pantalla Liquid Retina 10.9\"\n- 64 GB de almacenamiento\n- Compatible con Apple Pencil 2da gen.",
                'image_path'  => [
                    'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=800',
                    'https://images.unsplash.com/photo-1561154464-82e9adf32764?w=800',
                ],
                'is_active'   => true,
            ]
        );

        $juanProd2 = Product::firstOrCreate(
            ['user_id' => $juan->id, 'title' => 'Cámara Sony Alpha A6400 + Lente 16-50mm'],
            [
                'category'    => 'Fotografía',
                'location'    => 'Lima - Barranco',
                'condition'   => 'Usado - Como nuevo',
                'price'       => 650.00,
                'tags'        => ['Fotografía', 'Sony', 'Cámara'],
                'description' => "Cámara mirrorless Sony A6400 con lente kit incluido.\n- Sensor APS-C 24.2 MP\n- Enfoque automático en tiempo real\n- Grabación 4K\n- Pantalla táctil abatible",
                'image_path'  => [
                    'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=800',
                    'https://images.unsplash.com/photo-1465101162946-4377e57745c3?w=800',
                ],
                'is_active'   => true,
            ]
        );

        $juanProd3 = Product::firstOrCreate(
            ['user_id' => $juan->id, 'title' => 'DJI Mini 3 Pro - Drone con Control'],
            [
                'category'    => 'Drones',
                'location'    => 'Lima - San Borja',
                'condition'   => 'Nuevo',
                'price'       => 720.00,
                'tags'        => ['Drones', 'DJI', 'Fotografía aérea'],
                'description' => "Drone DJI Mini 3 Pro con control DJI RC incluido.\n- Cámara 4K/60fps HDR\n- Obstáculos en 4 direcciones\n- Hasta 34 min de vuelo\n- Peso < 249g (sin registro FAA)",
                'image_path'  => [
                    'https://images.unsplash.com/photo-1473968512647-3e447244af8f?w=800',
                    'https://images.unsplash.com/photo-1508444845599-5c89863b1c44?w=800',
                ],
                'is_active'   => true,
            ]
        );

        /*
         * ══════════════════════════════════════════════════════════════════
         *  TRATOS DONDE JUAN ES COMPRADOR (para su vista /tratos)
         *  Vendedor: Kevin | Comprador: Juan
         * ══════════════════════════════════════════════════════════════════
         */
        $buyerDemos = [
            [
                'product' => $kevinProducts->get(0), // MacBook Pro
                'price'   => 950.00,
                'sku'     => 'LAP-MBP-001',
                'status'  => 'aprobado',
            ],
            [
                'product' => $kevinProducts->get(1), // Sony WH-1000XM5
                'price'   => 520.00,
                'sku'     => 'AUD-SWH-002',
                'status'  => 'en_discusion',
            ],
            [
                'product' => $kevinProducts->get(2), // Samsung Galaxy S24
                'price'   => 850.00,
                'sku'     => 'CEL-SGX-003',
                'status'  => 'recibido',
            ],
        ];

        foreach ($buyerDemos as $demo) {
            Trato::create([
                'buyer_id'   => $juan->id,
                'seller_id'  => $kevin->id,
                'product_id' => $demo['product']->id,
                'price'      => $demo['price'],
                'sku'        => $demo['sku'],
                'status'     => $demo['status'],
            ]);
        }

        /*
         * ══════════════════════════════════════════════════════════════════
         *  TRATOS DONDE JUAN ES VENDEDOR (para su vista /vendedor/tratos)
         *  Vendedor: Juan | Compradores: Kevin y María
         * ══════════════════════════════════════════════════════════════════
         */
        $sellerDemos = [
            [
                'buyer'   => $kevin,  // Kevin compra el iPad de Juan
                'product' => $juanProd1,
                'price'   => 375.00,
                'sku'     => 'TAB-IPA-004',
                'status'  => 'en_discusion',
            ],
            [
                'buyer'   => $maria,  // María compra la cámara de Juan
                'product' => $juanProd2,
                'price'   => 640.00,
                'sku'     => 'CAM-SA6-005',
                'status'  => 'aprobado',
            ],
            [
                'buyer'   => $kevin,  // Kevin compra el drone de Juan
                'product' => $juanProd3,
                'price'   => 715.00,
                'sku'     => 'DRN-DJI-006',
                'status'  => 'pedido_realizado',
            ],
        ];

        foreach ($sellerDemos as $demo) {
            Trato::create([
                'buyer_id'   => $demo['buyer']->id,
                'seller_id'  => $juan->id,
                'product_id' => $demo['product']->id,
                'price'      => $demo['price'],
                'sku'        => $demo['sku'],
                'status'     => $demo['status'],
            ]);
        }

        $this->command->info('TratosSeeder OK: 3 tratos Juan-comprador + 3 tratos Juan-vendedor creados.');
    }
}
