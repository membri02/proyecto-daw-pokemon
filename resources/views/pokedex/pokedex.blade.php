@extends('layouts.app')

@section('content')
    <section id="pokedex" class="section active">
            <style>
                /* Pokédex — Modo Claro */
                .pk-card {
                    background-color: #ffffff;
                    border: 1px solid #e2e8f0;
                    color: #1e293b;
                    border-radius: 12px;
                }
                .pk-card small {
                    color: #64748b;
                }
                /* Barra de búsqueda */
                .search-box {
                    margin-bottom: 2.5rem;
                    display: flex;
                    gap: 15px;
                    justify-content: center;
                    align-items: center;
                    background-color: #f1f5f9;
                    padding: 15px 25px;
                    border-radius: 12px;
                    border: 1px solid #cbd5e1;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                    max-width: 600px;
                    margin-left: auto; margin-right: auto;
                }
                .search-box input, .search-box select {
                    background-color: #ffffff;
                    color: #1e293b;
                    border: 1px solid #475569;
                    padding: 12px 20px;
                    border-radius: 8px;
                    font-size: 1rem;
                    outline: none;
                    transition: border-color 0.2s, box-shadow 0.2s;
                    flex: 1;
                }
                .search-box input::placeholder {
                    color: #475569;
                }
                .search-box input:focus, .search-box select:focus {
                    border-color: #2563eb;
                    box-shadow: none;
                    outline: 2px solid #2563eb;
                    outline-offset: -1px;
                }
            </style>
            <div class="search-box">
                <input type="text" id="pk-input" placeholder="Ej: Pikachu o 25..." onkeyup="filterPk()">
                <select id="pk-type" onchange="filterPk()">
                    <option value="all">Todos los tipos</option>
                    <option value="fire">Fuego</option>
                    <option value="water">Agua</option>
                    <option value="grass">Planta</option>
                    <option value="electric">Eléctrico</option>
                </select>
            </div>
            <div id="pk-list" class="pokedex-grid">
            </div>
            
            <x-pokemon-modal />
    </section>

    <script>
        let pokedexData = [];
        const TOTAL_PK = 151;

        initPokedex();

        async function initPokedex() {
            const list = document.getElementById('pk-list');
            list.innerHTML = "<p>Conectando con PokéAPI...</p>";

            try {
                const res = await fetch(`https://pokeapi.co/api/v2/pokemon?limit=${TOTAL_PK}`);
                const data = await res.json();

                const detailPromises = data.results.map(p => fetch(p.url).then(r => r.json()));
                pokedexData = await Promise.all(detailPromises);

                renderPk(pokedexData);
            } catch (e) {
                list.innerHTML = "<p>Error de conexión. Revisa los protocolos.</p>";
            }
        }
        function renderPk(arr) {
            const list = document.getElementById('pk-list');
            list.innerHTML = "";

            const typeNames = {
                fire: 'Fuego',
                water: 'Agua',
                grass: 'Planta',
                electric: 'Eléctrico',
                ice: 'Hielo',
                fighting: 'Lucha',
                poison: 'Veneno',
                ground: 'Tierra',
                flying: 'Volador',
                psychic: 'Psíquico',
                bug: 'Bicho',
                rock: 'Roca',
                ghost: 'Fantasma',
                dark: 'Siniestro',
                dragon: 'Dragón',
                steel: 'Acero',
                fairy: 'Hada',
                normal: 'Normal',
            };

            arr.forEach(pk => {
                const types = pk.types
                    .map(t => `<span class="type-pill ${t.type.name}">${typeNames[t.type.name] || t.type.name}</span>`)
                    .join('');
                list.innerHTML += `
                    <div class="pk-card" style="cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="abrirPokemonModal(${pk.id}, { owned: false })">
                        <small>#${pk.id}</small>
                        <img src="${pk.sprites.other['official-artwork'].front_default}" alt="${pk.name}">
                        <h3 style="text-transform: capitalize;">${pk.name}</h3>
                        <div style="margin-top:10px;">${types}</div>
                    </div>
                `;
            });
        }

        function filterPk() {
            const q = document.getElementById('pk-input').value.toLowerCase();
            const type = document.getElementById('pk-type').value;

            const filtered = pokedexData.filter(pk => {
                const mName = pk.name.includes(q) || pk.id.toString() === q;
                const mType = type === 'all' || pk.types.some(t => t.type.name === type);
                return mName && mType;
            });
            renderPk(filtered);
        }
    </script>
@endsection