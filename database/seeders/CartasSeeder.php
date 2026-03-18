<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carta;
use Illuminate\Support\Facades\Http;

class CartasSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Hacemos una petición a la PokéAPI para traer los 151 originales
        $response = Http::withoutVerifying()->get('https://pokeapi.co/api/v2/pokemon?limit=151');
        $pokemons = $response->json()['results'];

        $tiposDisponibles = ['fuego', 'agua', 'planta', 'electrico', 'normal', 'psiquico', 'lucha', 'veneno', 'tierra', 'roca', 'bicho', 'fantasma', 'dragon', 'hielo'];
        $cartas = [];

        foreach ($pokemons as $index => $pokemon) {
            $id = $index + 1; // El ID coincide con el número de la Pokédex (1 a 151)
            $nombre = ucfirst($pokemon['name']);
            // Usamos la URL del artwork oficial en alta calidad
            $imagen_url = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$id}.png";

            // 2. Lógica de Rarezas
            $legendarios_ids = [144, 145, 146, 150, 151]; // Aves legendarias, Mewtwo y Mew
            $raros_ids = [3, 6, 9, 25, 65, 94, 130, 143, 149]; // Evoluciones finales icónicas

            if (in_array($id, $legendarios_ids)) {
                $rareza = 'Legendaria ✨';
            } elseif (in_array($id, $raros_ids)) {
                $rareza = 'Rara Holo';
            } else {
                // 70% Común, 30% Infrecuente para el resto
                $rareza = rand(1, 100) <= 70 ? 'Común' : 'Infrecuente';
            }

            // 3. Asignación de tipos
            $tipo = $tiposDisponibles[array_rand($tiposDisponibles)]; // Tipo aleatorio por defecto

            // Forzamos los tipos de algunos clásicos para que nuestros sobres Básicos sigan funcionando perfecto
            if (in_array($id, [4,5,6,37,58,59,77,78,126,136])) $tipo = 'fuego';
            if (in_array($id, [7,8,9,54,55,60,61,130,131,134])) $tipo = 'agua';
            if (in_array($id, [1,2,3,43,44,45,69,70,71,123])) $tipo = 'planta';
            if (in_array($id, [25,26,81,82,100,101,125,135,145])) $tipo = 'electrico';
            if (in_array($id, [16,17,18,19,20,52,53,133,143])) $tipo = 'normal';
            if (in_array($id, [63,64,65,96,97,122,150,151])) $tipo = 'psiquico';

            $cartas[] = [
                'nombre' => $nombre,
                'tipo' => $tipo,
                'rareza' => $rareza,
                'imagen_url' => $imagen_url,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insertamos los 151 de golpe en la base de datos
        Carta::insert($cartas);
    }
}
