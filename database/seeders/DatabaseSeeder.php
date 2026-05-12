<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@pokemon.com',
            'password' => Hash::make('12345678'),
            'monedas' => 999999,
        ]);

        $this->call(CartasSeeder::class);
    }
}