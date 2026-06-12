<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos al vendedor Kevin Gilbert si aún no existe
        $seller = User::firstOrCreate(
            ['email' => 'kevin@marketplace.com'],
            [
                'first_name' => 'Kevin',
                'last_name'  => 'Gilbert',
                'password'   => Hash::make('kevin1234'),
                'phone'      => '51987654321', // para el botón de WhatsApp
                'dob'        => '1995-03-15',
                'gender'     => 'male',
                'role'       => 'user',
            ]
        );

        // Imágenes libres de Unsplash para cada producto (4 ángulos por producto)
        $products = [
            [
                'title'       => 'MacBook Pro M3 - Gris Espacial 2024',
                'category'    => 'Laptops',
                'location'    => 'Lima - San Isidro',
                'condition'   => 'Usado - Como nuevo',
                'price'       => 950.00,
                'tags'        => ['Tecnología', 'Laptops', 'Apple', 'Premium'],
                'description' => "El MacBook Pro de 13 pulgadas llevado a un nivel completamente nuevo con el chip M3.\n\n"
                               . "- Chip Apple M3 de 8 núcleos\n"
                               . "- 8 GB de memoria unificada\n"
                               . "- Almacenamiento SSD de 256 GB\n"
                               . "- Pantalla Retina de 13.3 pulgadas con True Tone\n"
                               . "- Magic Keyboard retroiluminado",
                // 4 imágenes del mismo producto (ángulos distintos)
                'image_path'  => [
                    'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800',
                    'https://images.unsplash.com/photo-1611186871525-2eecebd17d91?w=800',
                    'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=800',
                    'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800',
                ],
            ],
            [
                'title'       => 'Sony WH-1000XM5 - Auriculares Inalámbricos',
                'category'    => 'Audio',
                'location'    => 'Lima - Miraflores',
                'condition'   => 'Nuevo',
                'price'       => 520.00,
                'tags'        => ['Audio', 'Auriculares', 'Sony', 'Inalámbrico'],
                'description' => "Los mejores auriculares con cancelación de ruido del mercado.\n\n"
                               . "- Cancelación de ruido adaptativa de clase mundial\n"
                               . "- Hasta 30 horas de batería\n"
                               . "- Carga rápida (3 min = 3 horas de uso)\n"
                               . "- Plegables y ligeros (250 g)\n"
                               . "- Compatible con Alexa, Google Assistant y Siri",
                'image_path'  => [
                    'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800',
                    'https://images.unsplash.com/photo-1524678606370-a47ad25cb82a?w=800',
                    'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800',
                    'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=800',
                ],
            ],
            [
                'title'       => 'Samsung Galaxy S24 Ultra - 256 GB Titanio',
                'category'    => 'Celulares',
                'location'    => 'Lima - Surco',
                'condition'   => 'Usado - Como nuevo',
                'price'       => 850.00,
                'tags'        => ['Celulares', 'Samsung', 'Android', 'Premium'],
                'description' => "El Samsung Galaxy S24 Ultra con inteligencia artificial integrada.\n\n"
                               . "- Pantalla Dynamic AMOLED 2X de 6.8 pulgadas\n"
                               . "- Procesador Snapdragon 8 Gen 3\n"
                               . "- Cámara principal de 200 MP\n"
                               . "- S Pen incluido\n"
                               . "- Batería de 5000 mAh con carga de 45W",
                'image_path'  => [
                    'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=800',
                    'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?w=800',
                    'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800',
                    'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=800',
                ],
            ],
            [
                'title'       => 'Apple Watch Series 9 - 41mm Aluminio Blanco',
                'category'    => 'Wearables',
                'location'    => 'Lima - La Molina',
                'condition'   => 'Nuevo',
                'price'       => 420.00,
                'tags'        => ['Wearables', 'Apple', 'Smartwatch', 'Salud'],
                'description' => "El Apple Watch Series 9 con el chip S9 más rápido.\n\n"
                               . "- Chip S9 de doble núcleo\n"
                               . "- Pantalla Always-On Retina\n"
                               . "- Seguimiento de actividad y salud 24/7\n"
                               . "- Detección de choques y caídas\n"
                               . "- Resistente al agua hasta 50 metros",
                'image_path'  => [
                    'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800',
                    'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=800',
                    'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=800',
                    'https://images.unsplash.com/photo-1434493789847-2f02dc6ca35d?w=800',
                ],
            ],
        ];

        foreach ($products as $data) {
            Product::create([
                'user_id'     => $seller->id,
                'title'       => $data['title'],
                'category'    => $data['category'],
                'location'    => $data['location'],
                'condition'   => $data['condition'],
                'price'       => $data['price'],
                'tags'        => $data['tags'],
                'description' => $data['description'],
                'image_path'  => $data['image_path'],
                'is_active'   => true,
            ]);
        }
    }
}
