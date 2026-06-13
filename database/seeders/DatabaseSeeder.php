<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ProductSeeder::class,   // productos de muestra para el catálogo
            TratosSeeder::class,    // tratos de ejemplo para Juan Pérez
            CommentsSeeder::class,  // comentarios de muestra en el perfil del vendedor
            BannerSeeder::class,    // banners del hero y sidebar de la pantalla principal
        ]);

    }
}
