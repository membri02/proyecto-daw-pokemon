<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carta;
use Illuminate\Support\Facades\Http;

class CartasSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Obteniendo listado de los 151 Pokémon originales desde PokéAPI...');
        $response = Http::withoutVerifying()->get('https://pokeapi.co/api/v2/pokemon?limit=151');
        $pokemons = $response->json()['results'];

        $traductorTipos = [
            'fire' => 'fuego', 'water' => 'agua', 'grass' => 'planta',
            'electric' => 'electrico', 'normal' => 'normal', 'psychic' => 'psiquico',
            'fighting' => 'lucha', 'poison' => 'veneno', 'ground' => 'tierra',
            'rock' => 'roca', 'bug' => 'bicho', 'ghost' => 'fantasma',
            'dragon' => 'dragon', 'ice' => 'hielo', 'fairy' => 'hada', 'steel' => 'acero'
        ];

        $legendarios_ids = [144, 145, 146, 150, 151];

        $this->command->info('Extrayendo atributos TCG (HP, Dimensiones, Ataques). Esto tomará aprox 30 segundos...');

        foreach ($pokemons as $index => $pokemon) {
            $id = $index + 1;
            $nombre = ucfirst($pokemon['name']);
            $imagen_url = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$id}.png";

            // ¡Magia aquí! Entramos a la URL de cada Pokémon para diseccionarlo y llenar la carta
            $detalles = Http::withoutVerifying()->get($pokemon['url'])->json();
            
            // Extracción nativa Multi-Tipo para Cartas Duales
            $tiposExtraidos = [];
            foreach ($detalles['types'] as $t) {
                $nombreIngles = $t['type']['name'];
                $tiposExtraidos[] = $traductorTipos[$nombreIngles] ?? 'normal';
            }
            $tipo = implode('/', $tiposExtraidos);

            // Mapeo exhaustivo TCG
            $hp = collect($detalles['stats'])->firstWhere('stat.name', 'hp')['base_stat'] ?? 60;
            $altura = ($detalles['height'] ?? 10) / 10; // PokeAPI devuelve decímetros, lo pasamos a metros
            $peso = ($detalles['weight'] ?? 100) / 10;  // PokeAPI devuelve hectogramos, pasamos a kg
            $base_exp = $detalles['base_experience'] ?? 0;

            // Extraemos 2 ataques limpios si existen, sustituyendo guiones por espacios
            $ataque1_name = isset($detalles['moves'][0]) ? ucfirst(str_replace('-', ' ', $detalles['moves'][0]['move']['name'])) : 'Placaje';
            $ataque1_damage = rand(20, 80);

            $ataque2_name = isset($detalles['moves'][1]) ? ucfirst(str_replace('-', ' ', $detalles['moves'][1]['move']['name'])) : null;
            $ataque2_damage = $ataque2_name ? rand(20, 80) : null;

            // Algoritmo de Rareza Dinámica 
            $es_legendario = in_array($id, $legendarios_ids);
            $es_holo = false;

            if ($es_legendario) {
                $rareza = 'Legendaria';
            } elseif ($base_exp > 200) {
                $rareza = 'Rara Holo';
                $es_holo = true;
            } else {
                $rareza = rand(1, 100) <= 70 ? 'Común' : 'Infrecuente';
            }

            // Inserción segura para evitar duplicados en ejecuciones sin Refresh
            Carta::updateOrCreate(
                ['nombre' => $nombre],
                [
                    'tipo' => $tipo,
                    'rareza' => $rareza,
                    'imagen_url' => $imagen_url,
                    'hp' => $hp,
                    'peso' => $peso,
                    'altura' => $altura,
                    'pokedex_no' => $id,
                    'ataque1_name' => $ataque1_name,
                    'ataque1_damage' => $ataque1_damage,
                    'ataque2_name' => $ataque2_name,
                    'ataque2_damage' => $ataque2_damage,
                    'es_holo' => $es_holo,
                    'es_legendario' => $es_legendario
                ]
            );

            // Retardo ético para evitar baneos de IP de PokéAPI
            usleep(200000); // 200ms
        }

        $this->command->info('¡Sincronización TCG completada y cartas inyectadas!');
    }
}