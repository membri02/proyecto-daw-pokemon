<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carta;
use Illuminate\Support\Facades\Http;

class CartasSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Traemos la lista de los 151
        $response = Http::withoutVerifying()->get('https://pokeapi.co/api/v2/pokemon?limit=151');
        $pokemons = $response->json()['results'];

        // Diccionario traductor de tipos (Inglés -> Español)
        $traductorTipos = [
            'fire' => 'fuego', 'water' => 'agua', 'grass' => 'planta',
            'electric' => 'electrico', 'normal' => 'normal', 'psychic' => 'psiquico',
            'fighting' => 'lucha', 'poison' => 'veneno', 'ground' => 'tierra',
            'rock' => 'roca', 'bug' => 'bicho', 'ghost' => 'fantasma',
            'dragon' => 'dragon', 'ice' => 'hielo', 'fairy' => 'hada', 'steel' => 'acero'
        ];

        $cartas = [];

        // Esto puede tardar unos 10-15 segundos en la terminal porque hace 151 peticiones pequeñas
        foreach ($pokemons as $index => $pokemon) {
            $id = $index + 1;
            $nombre = ucfirst($pokemon['name']);
            $imagen_url = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$id}.png";

            // ¡Magia aquí! Entramos a la URL de cada Pokémon para ver su tipo real
            $detalles = Http::withoutVerifying()->get($pokemon['url'])->json();
            $tipoIngles = $detalles['types'][0]['type']['name']; // Cogemos su tipo principal
            
            // Lo traducimos a nuestro sistema, o le ponemos 'normal' si falla
            $tipo = $traductorTipos[$tipoIngles] ?? 'normal';

            // Lógica de Rarezas (Mantenemos la que teníamos)
            $legendarios_ids = [144, 145, 146, 150, 151];
            $raros_ids = [3, 6, 9, 25, 65, 94, 130, 143, 149];

            if (in_array($id, $legendarios_ids)) {
                $rareza = 'Legendaria ✨';
            } elseif (in_array($id, $raros_ids)) {
                $rareza = 'Rara Holo';
            } else {
                $rareza = rand(1, 100) <= 70 ? 'Común' : 'Infrecuente';
            }

            $cartas[] = [
                'nombre' => $nombre,
                'tipo' => $tipo,
                'rareza' => $rareza,
                'imagen_url' => $imagen_url,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Carta::insert($cartas);
    }
}