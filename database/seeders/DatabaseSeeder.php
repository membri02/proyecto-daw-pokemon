<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Creamos la cuenta Maestra con 999.999 monedas
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pokemon.com',
            'password' => Hash::make('12345678'), // Contraseña fácil para pruebas
            'monedas' => 999999,
        ]);

        // 2. Llamamos al Seeder de las cartas
        $this->call([
            CartasSeeder::class,
        ]);
    }
}