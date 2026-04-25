@extends('layouts.app')

@section('content')
    <style>
        .silhouette {
            filter: brightness(0);
        }
    </style>
    <section id="inicio" class="section active">
        <div id="sprite" class="pokemon-sprite">
            <img id="pokemon" src="" alt="pokemon-sprite">
            <input type="text" id="answer" placeholder="¿Cuál es este pokemon?">
            <span id="response"></span>
            <button id="guess">Adivina</button>
            <button id="play-again" style="display: none;">Jugar otra vez</button>
            <div id="feedback"></div>
        </div>
        <div id="tips" class="tips">
            <button id="tip-type1">Tipo principal</button>
            <p id="tip1" hidden><span id="type1"></span></p>
            <button id="tip-type2">Tipo secundario</button>
            <p id="tip2" hidden><span id="type2"></span></p>
        </div>
    </section>

    <script>
        window.addEventListener("load", showPokemon);

        let pokemon;
        const tip1 = document.getElementById("tip-type1");
        const tip2 = document.getElementById("tip-type2");
        const guess = document.getElementById("guess");
        const playAgain = document.getElementById("play-again");

        guess.addEventListener("click", async () => {
            
            const answer = document.getElementById("answer").value.toLowerCase();
            const response = document.getElementById("response");
            const feedback = document.getElementById("feedback");

            // limpiar clases anteriores
            response.classList.remove("correct", "wrong");

            if (answer === pokemon.name) {
                response.textContent = "¡Has acertado!";
                response.classList.add("correct");
                guess.disabled = true;

                // opcional: revelar el pokemon
                document.getElementById("pokemon").classList.remove("silhouette");

                try{
                    const res = await fetch('/minijuego/win',{
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const data = await res.json();

                    feedback.textContent = data.message;
                    feedback.classList.add("correct");

                    if(data.monedas !== undefined){
                        document.getElementById("wallet").textContent = data.monedas;
                    }

                    playAgain.style.display = "inline-block";

                } catch(error){
                    console.error("Error:", error);
                }

            } else {
                response.textContent = "Has fallado";
                response.classList.add("wrong");
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
        })

        tip1.addEventListener("click", () => {
            document.getElementById("tip1").removeAttribute("hidden");
        });
        tip2.addEventListener("click", () => {
            document.getElementById("tip2").removeAttribute("hidden");
        });

        function getRandomPokemonId(){
            return Math.floor(Math.random() * 151) + 1;
        }

        function applyTypeStyles(type, elementId){
            const el = document.getElementById(elementId);

            el.className = "";
            el.classList.add(`type-${type}`);
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
                sprite: data.sprites.front_default,
                type1,
                type2
            };
        }

        async function showPokemon(){
            pokemon = await fetchPokemon();

            const img = document.getElementById("pokemon");
            img.src = pokemon.sprite;
            img.classList.add("silhouette");

            document.getElementById("type1").textContent = pokemon.type1;
            document.getElementById("type2").textContent = pokemon.type2;

            applyTypeStyles(pokemon.type1, "type1");
            applyTypeStyles(pokemon.type2, "type2");
        }
    </script>
@endsection