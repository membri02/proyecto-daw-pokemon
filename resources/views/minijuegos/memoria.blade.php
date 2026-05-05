@extends('layouts.app')

@section('content')
    @vite(['resources/css/minijuegos.css'])

    <div class="hub-background"></div>

    <div class="container mx-auto px-4">
        <div class="game-area">
            <a href="{{ route('minijuego.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Volver al Hub</a>
            
            <div class="game-header">
                <h2>Memoria de Mew</h2>
                <p>Encuentra las 6 parejas. Intentos restantes: <span id="attempts">10</span></p>
            </div>

            <div class="my-4">
                <button id="btn-start" class="btn-play" style="width: auto; padding: 0.8rem 2rem;">Repartir Cartas (Coste: 15 <i class="fas fa-coins"></i>)</button>
            </div>

            <div id="memory-board" class="memory-grid" style="display: none;">
                <!-- Cards injected by JS -->
            </div>

            <h3 id="response" class="text-2xl font-bold my-4" style="height: 32px;"></h3>
            <p id="feedback" class="font-bold"></p>
        </div>
    </div>

    <script>
        const btnStart = document.getElementById("btn-start");
        const board = document.getElementById("memory-board");
        const attemptsEl = document.getElementById("attempts");
        const responseEl = document.getElementById("response");
        const feedbackEl = document.getElementById("feedback");

        let cards = [];
        let flippedCards = [];
        let matchedPairs = 0;
        let attempts = 10;
        let isPlaying = false;
        let lockBoard = false;

        // Pokemon IDs to use for the pairs
        const pokemonIds = [1, 4, 7, 25, 133, 150]; // Bulbasaur, Charmander, Squirtle, Pikachu, Eevee, Mewtwo

        btnStart.addEventListener("click", startGame);

        function startGame() {
            if (isPlaying) return;
            isPlaying = true;
            btnStart.style.display = 'none';
            board.style.display = 'grid';
            
            attempts = 10;
            matchedPairs = 0;
            attemptsEl.textContent = attempts;
            responseEl.textContent = "";
            feedbackEl.textContent = "";

            createBoard();
        }

        function createBoard() {
            board.innerHTML = "";
            cards = [];
            
            // Duplicate to make pairs
            let gamePairs = [...pokemonIds, ...pokemonIds];
            
            // Shuffle
            gamePairs.sort(() => 0.5 - Math.random());

            gamePairs.forEach((id, index) => {
                const card = document.createElement("div");
                card.className = "memory-card";
                card.dataset.id = id;
                card.dataset.index = index;

                const front = document.createElement("div");
                front.className = "front";
                const img = document.createElement("img");
                img.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${id}.png`;
                front.appendChild(img);

                const back = document.createElement("div");
                back.className = "back";

                card.appendChild(front);
                card.appendChild(back);

                card.addEventListener("click", flipCard);

                board.appendChild(card);
                cards.push(card);
            });
        }

        function flipCard() {
            if (lockBoard) return;
            if (this.classList.contains("flipped")) return;

            this.classList.add("flipped");
            flippedCards.push(this);

            if (flippedCards.length === 2) {
                checkMatch();
            }
        }

        function checkMatch() {
            lockBoard = true;
            const [card1, card2] = flippedCards;

            if (card1.dataset.id === card2.dataset.id) {
                // It's a match
                matchedPairs++;
                flippedCards = [];
                lockBoard = false;
                
                if (matchedPairs === 6) {
                    endGame(true, "¡Has encontrado todas las parejas!");
                }
            } else {
                // Not a match
                attempts--;
                attemptsEl.textContent = attempts;

                if (attempts === 0) {
                    endGame(false, "¡Te has quedado sin intentos!");
                } else {
                    setTimeout(() => {
                        card1.classList.remove("flipped");
                        card2.classList.remove("flipped");
                        flippedCards = [];
                        lockBoard = false;
                    }, 1000);
                }
            }
        }

        async function endGame(won, message) {
            isPlaying = false;
            
            let amount = won ? 80 : -15;

            try {
                const res = await fetch('{{ route('minijuego.reward') }}',{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ amount: amount, game: 'memoria' }) 
                });
                
                const data = await res.json();
                
                if (won) {
                    responseEl.textContent = message;
                    responseEl.style.color = "#4ade80";
                    if(data.success){
                        feedbackEl.textContent = data.message;
                        feedbackEl.style.color = "#4ade80";
                        if(data.monedas !== undefined){
                            const walletEl = document.getElementById("wallet");
                            if(walletEl) walletEl.textContent = data.monedas;
                            createCoinAnimation();
                        }
                    }
                } else {
                    responseEl.textContent = message;
                    responseEl.style.color = "#f87171";
                    if (data.success) {
                        feedbackEl.textContent = data.message; // "¡Perdiste 15 monedas en Memoria!"
                        feedbackEl.style.color = "#f87171";
                        if(data.monedas !== undefined){
                            const walletEl = document.getElementById("wallet");
                            if(walletEl) walletEl.textContent = data.monedas;
                        }
                    } else {
                        feedbackEl.textContent = "Has perdido 15 monedas.";
                        feedbackEl.style.color = "#f87171";
                    }
                }
            } catch(e) { 
                console.error(e);
            }

            setTimeout(() => {
                btnStart.style.display = 'inline-block';
                btnStart.textContent = "Jugar de nuevo (Coste: 15)";
                board.style.display = 'none';
            }, 3000);
        }

        function createCoinAnimation() {
            const coin = document.createElement('div');
            coin.classList.add('coin-animation');
            coin.style.top = '50%';
            coin.style.left = '50%';
            document.body.appendChild(coin);
            setTimeout(() => coin.remove(), 1500);
        }
    </script>
@endsection
