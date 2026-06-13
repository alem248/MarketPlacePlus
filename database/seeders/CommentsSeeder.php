<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CommentsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiamos comentarios anteriores para evitar duplicados al re-sembrar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Comment::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Tomamos los productos de Kevin (el vendedor principal de muestra)
        $kevin = User::where('email', 'kevin@marketplace.com')->first();

        if (!$kevin) {
            $this->command->warn('Kevin no encontrado. Ejecuta primero ProductSeeder.');
            return;
        }

        $products = Product::where('user_id', $kevin->id)->get();

        if ($products->isEmpty()) {
            $this->command->warn('Kevin no tiene productos. Ejecuta primero ProductSeeder.');
            return;
        }

        // Compradores de muestra que dejan comentarios
        // Usamos firstOrCreate para no duplicar si el seeder se vuelve a correr
        $carlos = User::firstOrCreate(
            ['email' => 'carlos.ruiz@marketplace.com'],
            [
                'first_name' => 'Carlos',
                'last_name'  => 'Ruiz',
                'password'   => Hash::make('carlos1234'),
                'phone'      => '51921111111',
                'dob'        => '1997-04-10',
                'gender'     => 'male',
                'role'       => 'user',
            ]
        );

        $lucia = User::firstOrCreate(
            ['email' => 'lucia.torres@marketplace.com'],
            [
                'first_name' => 'Lucía',
                'last_name'  => 'Torres',
                'password'   => Hash::make('lucia1234'),
                'phone'      => '51932222222',
                'dob'        => '2000-09-18',
                'gender'     => 'female',
                'role'       => 'user',
            ]
        );

        $marco = User::firstOrCreate(
            ['email' => 'marco.pena@marketplace.com'],
            [
                'first_name' => 'Marco',
                'last_name'  => 'Peña',
                'password'   => Hash::make('marco1234'),
                'phone'      => '51943333333',
                'dob'        => '1995-12-05',
                'gender'     => 'male',
                'role'       => 'user',
            ]
        );

        $sofia = User::firstOrCreate(
            ['email' => 'sofia.mendoza@marketplace.com'],
            [
                'first_name' => 'Sofía',
                'last_name'  => 'Mendoza',
                'password'   => Hash::make('sofia1234'),
                'phone'      => '51954444444',
                'dob'        => '2001-03-22',
                'gender'     => 'female',
                'role'       => 'user',
            ]
        );

        // Comentarios del perfil de ejemplo (4 reseñas sobre Kevin como vendedor)
        $comentarios = [
            [
                'user'    => $carlos,
                'product' => $products->get(0), // MacBook Pro M3
                'content' => 'Excelente vendedor, el producto llegó en perfectas condiciones y el trato fue muy profesional. Totalmente recomendado.',
            ],
            [
                'user'    => $lucia,
                'product' => $products->get(2), // Samsung Galaxy S24 Ultra
                'content' => 'Muy buena comunicación. Hubo un pequeño retraso en el envío pero siempre estuvo pendiente. El iPhone está impecable.',
            ],
            [
                'user'    => $marco,
                'product' => $products->get(0), // MacBook Pro M3
                'content' => 'La MacBook Air funciona de maravilla. El empaque era muy seguro. Gran experiencia de compra.',
            ],
            [
                'user'    => $sofia,
                'product' => $products->get(3), // Apple Watch Series 9
                'content' => 'Puntual y honesto. Me explicó todo sobre la garantía del equipo. Volveré a comprarle sin duda.',
            ],
        ];

        foreach ($comentarios as $data) {
            Comment::create([
                'user_id'    => $data['user']->id,
                'product_id' => $data['product']->id,
                'content'    => $data['content'],
                'is_active'  => true,
            ]);
        }

        $this->command->info('CommentsSeeder OK: 4 comentarios de muestra creados.');
    }
}
