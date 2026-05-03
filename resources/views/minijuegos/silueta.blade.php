@extends('layouts.app')

@section('content')
    @vite(['resources/css/minijuegos.css'])

    <div class="hub-background"></div>

    <div class="container mx-auto px-4">
        <div class="game-area">
            <a href="{{ route('minijuego.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Volver al Hub</a>
            
            <div class="game-header">
                <h2>¿Quién es ese Pokémon?</h2>
                <p>Adivina la silueta y gana monedas.</p>
            </div>

            <div id="sprite" class="pokemon-sprite-container">
                <img id="pokemon" class="pokemon-sprite-img" src="" alt="pokemon-sprite">
            </div>

            <div>
                <input type="text" id="answer" class="input-guess" placeholder="Escribe el nombre aquí...">
            </div>
            
            <div class="my-4">
                <button id="guess" class="btn-play" style="width: auto; padding: 0.8rem 2rem;">Adivinar</button>
                <button id="play-again" class="btn-play" style="display: none; width: auto; padding: 0.8rem 2rem; background: var(--poke-blue); color: white;">Jugar otra vez</button>
            </div>

            <h3 id="response" class="text-2xl font-bold my-2" style="height: 32px;"></h3>
            <p id="feedback" class="text-green-400 font-bold"></p>

            <div id="tips" class="mt-6 flex justify-center gap-4">
                <button id="tip-type1" class="bg-gray-700 px-4 py-2 rounded">Pista: Tipo Principal</button>
                <p id="tip1" hidden class="types-hint"><span id="type1"></span></p>
                
                <button id="tip-type2" class="bg-gray-700 px-4 py-2 rounded">Pista: Tipo Secundario</button>
                <p id="tip2" hidden class="types-hint"><span id="type2"></span></p>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load", showPokemon);

        let pokemon;
        const tip1 = document.getElementById("tip-type1");
        const tip2 = document.getElementById("tip-type2");
        const guess = document.getElementById("guess");
        const playAgain = document.getElementById("play-again");

        guess.addEventListener("click", async () => {
            const answer = document.getElementById("answer").value.toLowerCase().trim();
            const response = document.getElementById("response");
            const feedback = document.getElementById("feedback");

            if (!answer) return;

            if (answer === pokemon.name) {
                response.textContent = "¡Has acertado!";
                response.style.color = "#4ade80"; // green
                guess.disabled = true;

                // revelar el pokemon
                document.getElementById("pokemon").classList.remove("silhouette");

                try {
                    const res = await fetch('{{ route('minijuego.reward') }}',{
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ amount: 50, game: 'silueta' })
                    });

                    const data = await res.json();

                    if(data.success){
                        feedback.textContent = data.message;
                        if(data.monedas !== undefined){
                            const walletEl = document.getElementById("wallet");
                            if(walletEl) walletEl.textContent = data.monedas;
                            createCoinAnimation();
                        }
                    } else {
                        feedback.textContent = data.message || "Error al procesar recompensa.";
                        feedback.style.color = "#f87171";
                    }

                } catch(error){
                    console.error("Error:", error);
                }

                playAgain.style.display = "inline-block";

            } else {
                response.textContent = "Has fallado";
                response.style.color = "#f87171"; // red
                
                // Shake effect on input
                const input = document.getElementById("answer");
                input.style.transform = "translateX(-10px)";
                setTimeout(() => input.style.transform = "translateX(10px)", 50);
                setTimeout(() => input.style.transform = "translateX(0)", 100);
            }
        });

        playAgain.addEventListener("click", () => {
            document.getElementById("answer").value = "";
            document.getElementById("response").textContent = "";
            document.getElementById("feedback").textContent = "";
            document.getElementById("tip1").setAttribute("hidden", true);
            document.getElementById("tip2").setAttribute("hidden", true);
            playAgain.style.display = "none";
            guess.disabled = false;
            showPokemon();
        });

        tip1.addEventListener("click", () => document.getElementById("tip1").removeAttribute("hidden"));
        tip2.addEventListener("click", () => document.getElementById("tip2").removeAttribute("hidden"));

        function getRandomPokemonId(){
            return Math.floor(Math.random() * 151) + 1; // Gen 1
        }

        function applyTypeStyles(type, elementId){
            const el = document.getElementById(elementId);
            el.className = "";
            el.classList.add(`type-${type}`);
            el.style.color = "white";
        }

        async function fetchPokemon(){
            const pokemonID =  getRandomPokemonId();
            const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonID}`);
            const data = await res.json();

            const typesSorted = data.types.sort((a, b) => a.slot - b.slot);
            const type1 = typesSorted[0]?.type.name || "none";
            const type2 = typesSorted[1]?.type.name || "none";

            return {
                name: data.name,
                sprite: data.sprites.other['official-artwork'].front_default || data.sprites.front_default,
                type1,
                type2
            };
        }

        async function showPokemon(){
            // Loading state
            document.getElementById("pokemon").src = "";
            
            pokemon = await fetchPokemon();

            const img = document.getElementById("pokemon");
            img.src = pokemon.sprite;
            img.classList.add("silhouette");

            document.getElementById("type1").textContent = pokemon.type1;
            if(pokemon.type2 !== "none"){
                document.getElementById("type2").textContent = pokemon.type2;
                document.getElementById("tip-type2").style.display = "inline-block";
                applyTypeStyles(pokemon.type2, "type2");
            } else {
                document.getElementById("tip-type2").style.display = "none";
            }

            applyTypeStyles(pokemon.type1, "type1");
        }

        function createCoinAnimation() {
            const coin = document.createElement('div');
            coin.classList.add('coin-animation');
            
            // Start roughly at the center of the screen
            coin.style.top = '50%';
            coin.style.left = '50%';
            
            document.body.appendChild(coin);
            
            setTimeout(() => {
                coin.remove();
            }, 1500);
        }
    </script>
@endsection
