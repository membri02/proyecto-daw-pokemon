<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carta; 

class CartasSeeder extends Seeder
{
    public function run(): void
    {
        $cartas = [
            // CARTAS DE FUEGO
            ['nombre' => 'Charmander', 'tipo' => 'fuego', 'rareza' => 'Común', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png'],
            ['nombre' => 'Charmeleon', 'tipo' => 'fuego', 'rareza' => 'Infrecuente', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/5.png'],
            ['nombre' => 'Charizard', 'tipo' => 'fuego', 'rareza' => 'Rara Holo', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png'],
            ['nombre' => 'Vulpix', 'tipo' => 'fuego', 'rareza' => 'Común', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/37.png'],
            ['nombre' => 'Arcanine', 'tipo' => 'fuego', 'rareza' => 'Legendaria ✨', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/59.png'],

            // CARTAS DE AGUA
            ['nombre' => 'Squirtle', 'tipo' => 'agua', 'rareza' => 'Común', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png'],
            ['nombre' => 'Wartortle', 'tipo' => 'agua', 'rareza' => 'Infrecuente', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/8.png'],
            ['nombre' => 'Blastoise', 'tipo' => 'agua', 'rareza' => 'Rara Holo', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png'],
            ['nombre' => 'Psyduck', 'tipo' => 'agua', 'rareza' => 'Común', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/54.png'],
            ['nombre' => 'Gyarados', 'tipo' => 'agua', 'rareza' => 'Legendaria ✨', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/130.png'],
            
            // CARTAS DE PLANTA
            ['nombre' => 'Bulbasaur', 'tipo' => 'planta', 'rareza' => 'Común', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png'],
            ['nombre' => 'Ivysaur', 'tipo' => 'planta', 'rareza' => 'Infrecuente', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/2.png'],
            ['nombre' => 'Venusaur', 'tipo' => 'planta', 'rareza' => 'Rara Holo', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png'],
            ['nombre' => 'Oddish', 'tipo' => 'planta', 'rareza' => 'Común', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/43.png'],
            ['nombre' => 'Scyther', 'tipo' => 'planta', 'rareza' => 'Legendaria ✨', 'imagen_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/123.png'],
        ];

        Carta::insert($cartas);
    }
}