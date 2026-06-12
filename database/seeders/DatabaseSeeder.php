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
            ProductSeeder::class,  // productos de muestra para el catálogo
            TratosSeeder::class,   // tratos de ejemplo para Juan Pérez
        ]);

    }
}
