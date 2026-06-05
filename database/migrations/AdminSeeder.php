<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario ADMINISTRADOR
        User::updateOrCreate(
            ['email' => 'admin@marketplace.com'],
            [
                'first_name' => 'Admin',
                'last_name'  => 'Sistema',
                'email'      => 'admin@marketplace.com',
                'password'   => Hash::make('admin1234'),
                'role'       => 'admin',
                'phone'      => '51900000000',
            ]
        );

        // Usuario REGULAR de prueba
        User::updateOrCreate(
            ['email' => 'usuario@marketplace.com'],
            [
                'first_name' => 'Juan',
                'last_name'  => 'Pérez',
                'email'      => 'usuario@marketplace.com',
                'password'   => Hash::make('user1234'),
                'role'       => 'user',
                'phone'      => '51911111111',
            ]
        );
    }
}
