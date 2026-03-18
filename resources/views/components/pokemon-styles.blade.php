<style>
    /* =========================================
        1. VARIABLES Y ESTILOS GLOBALES
        ========================================= */
    :root {
        --primary-red: #ef5350;
        --secondary-blue: #3b4cca;
        --pokemon-yellow: #ffcb05;
        --bg-light: #f8f9fa;
        --text-dark: #2d3436;
        --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        --transition-epic: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);

        /* Colores de Sobres */
        --pack-fire: linear-gradient(135deg, #ff416c, #ff4b2b);
        --pack-water: linear-gradient(135deg, #1e3c72, #2a5298);
        --pack-grass: linear-gradient(135deg, #11998e, #38ef7d);
    }

    [data-theme="dark"] {
        --bg-light: #121212;
        --text-dark: #ecf0f1;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--bg-light);
        color: var(--text-dark);
        font-family: 'Segoe UI', Roboto, sans-serif;
        transition: background 0.4s;
        min-height: 100vh;
    }

    /* =========================================
        2. NAVEGACIÓN Y HEADER
        ========================================= */
    header {
        background: var(--primary-red);
        padding: 2rem;
        text-align: center;
        color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        border-bottom: 5px solid var(--pokemon-yellow);
    }

    nav {
        display: flex;
        justify-content: center;
        background: #2d3436;
        position: sticky;
        top: 0;
        z-index: 1000;
        padding: 10px;
    }

    nav a {
        color: white;
        padding: 10px 25px;
        text-decoration: none;
        font-weight: bold;
        text-transform: uppercase;
        cursor: pointer;
        transition: var(--transition-epic);
        border-radius: 4px;
    }

    nav a:hover {
        color: var(--pokemon-yellow);
        transform: scale(1.1);
    }

    .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px;
    }

    .section {
        display: none;
        animation: slideUp 0.6s ease-out;
    }

    .section.active {
        display: block;
    }

    /* Animación de sacudida profesional (para el sobre) */
    @keyframes shakePack {
        0% {
            transform: rotate(0deg);
        }

        25% {
            transform: rotate(2deg) scale(1.05);
        }

        50% {
            transform: rotate(-2deg) scale(1.1);
        }

        75% {
            transform: rotate(1deg) scale(1.05);
        }

        100% {
            transform: rotate(0deg);
        }
    }

    /* clase específica para el pack que vibra al abrirse */
    .shake-pack {
        animation: shakePack 0.15s infinite;
        filter: brightness(1.5) drop-shadow(0 0 20px gold);
    }

    /* Flash de luz blanca al abrir */
    .flash-white {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        z-index: 3000;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.5s ease-out;
    }

    /* Carta Especial/Legendaria */
    .legendary-glow {
        box-shadow: 0 0 30px #f1c40f, 0 0 60px #e67e22 !important;
        border-color: #f1c40f !important;
        animation: pulseLegendary 2s infinite;
    }

    @keyframes pulseLegendary {
        0% {
            transform: scale(1) rotateY(180deg);
        }

        50% {
            transform: scale(1.05) rotateY(180deg);
        }

        100% {
            transform: scale(1) rotateY(180deg);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =========================================
        3. MÓDULO POKÉDEX (ADRIÁN)
        ========================================= */
    .search-box {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: var(--card-shadow);
    }

    [data-theme="dark"] .search-box {
        background: #2d2d2d;
    }

    input,
    select {
        padding: 12px;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        flex: 1;
    }

    .pokedex-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 25px;
    }

    .pk-card {
        background: white;
        padding: 20px;
        border-radius: 20px;
        text-align: center;
        box-shadow: var(--card-shadow);
        transition: var(--transition-epic);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    [data-theme="dark"] .pk-card {
        background: #2d2d2d;
        border-color: #444;
    }

    .pk-card:hover {
        transform: translateY(-10px) scale(1.03);
    }

    .pk-card img {
        width: 140px;
        filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.2));
    }

    .type-pill {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        color: white;
        text-transform: uppercase;
        font-weight: bold;
        margin: 2px;
        display: inline-block;
    }

    /* Colores de tipos (PokeAPI usa nombres en inglés) */
    .type-pill.fire { background: #F08030; }
    .type-pill.water { background: #6890F0; }
    .type-pill.grass { background: #78C850; }
    .type-pill.electric { background: #F8D030; color: #2d3436; }
    .type-pill.ice { background: #98D8D8; color: #2d3436; }
    .type-pill.fighting { background: #C03028; }
    .type-pill.poison { background: #A040A0; }
    .type-pill.ground { background: #E0C068; color: #2d3436; }
    .type-pill.flying { background: #A890F0; }
    .type-pill.psychic { background: #F85888; }
    .type-pill.bug { background: #A8B820; }
    .type-pill.rock { background: #B8A038; color: #2d3436; }
    .type-pill.ghost { background: #705898; }
    .type-pill.dark { background: #705848; }
    .type-pill.dragon { background: #7038F8; }
    .type-pill.steel { background: #B8B8D0; color: #2d3436; }
    .type-pill.fairy { background: #EE99AC; color: #2d3436; }
    .type-pill.normal { background: #A8A878; color: #2d3436; }

    /* =========================================
        4. MÓDULO TIENDA ÉPICA (ANDRÉS)
        ========================================= */
    .shop-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .pack-selector {
        display: flex;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
        padding: 20px;
    }

    .booster-item {
        width: 220px;
        height: 320px;
        border-radius: 15px;
        cursor: pointer;
        position: relative;
        transition: var(--transition-epic);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        border: 6px solid #ffd700;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        overflow: hidden;
    }

    .booster-item:hover {
        transform: scale(1.1) rotate(2deg);
    }

    .booster-item.fire {
        background: var(--pack-fire);
    }

    .booster-item.water {
        background: var(--pack-water);
    }

    .booster-item.grass {
        background: var(--pack-grass);
    }

    .booster-item::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(45deg);
    }

    .booster-item h3 {
        font-size: 1.8rem;
        z-index: 1;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .booster-item p {
        z-index: 1;
        font-weight: bold;
        letter-spacing: 2px;
    }

    /* Animación moneda */
    @keyframes flipCoin {
        0% { transform: rotateY(0); }
        25% { transform: rotateY(90deg); }
        50% { transform: rotateY(180deg); }
        75% { transform: rotateY(270deg); }
        100% { transform: rotateY(360deg); }
    }
    .flip {
        display: inline-block;
        animation: flipCoin 0.8s ease-in-out;
    }

    /* Pantalla de Apertura */
    #opening-scene {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 2000;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .opening-pack {
        width: 200px;
        height: 300px;
        border-radius: 15px;
        animation: float 2s infinite ease-in-out;
        border: 4px solid gold;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) rotate(0);
        }

        50% {
            transform: translateY(-20px) rotate(5deg);
        }
    }

    /* versión más épica de vibración, usada en otros contextos */
    .shaking-epic {
        animation: shakeEpic 0.1s infinite !important;
    }

    @keyframes shakeEpic {
        0% {
            transform: translate(2px, 2px) scale(1.1);
        }

        50% {
            transform: translate(-2px, -2px) scale(1.15);
        }

        100% {
            transform: translate(2px, -2px) scale(1.2);
        }
    }

    .explosion {
        position: absolute;
        width: 10px;
        height: 10px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 0 100px 50px white;
        animation: burst 0.8s forwards;
    }

    @keyframes burst {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        100% {
            transform: scale(100);
            opacity: 0;
        }
    }

    /* Cartas Reveladas */
    .reveal-container {
        display: flex;
        gap: 30px;
        perspective: 1500px;
        margin-top: 50px;
    }

    .card-slot {
        width: 220px;
        height: 310px;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .card-slot.revealed {
        transform: rotateY(180deg);
    }

    .card-face {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 12px;
        border: 8px solid #333;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px;
    }

    .card-back {
        background: radial-gradient(#3b4cca, #1a1a1a);
        justify-content: center;
    }

    .card-back img {
        width: 80%;
        opacity: 0.8;
    }

    .card-front {
        background: white;
        transform: rotateY(180deg);
        background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
    }

    .card-front img {
        width: 100%;
        margin-top: 10px;
    }

    .card-rarity {
        position: absolute;
        top: 10px;
        right: 10px;
        font-weight: bold;
        color: gold;
        text-shadow: 1px 1px 2px black;
    }

    /* =========================================
        5. ADMIN PANEL (MIGUEL)
        ========================================= */
    .admin-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: var(--card-shadow);
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-box {
        padding: 20px;
        background: var(--bg-light);
        border-left: 5px solid var(--secondary-blue);
        border-radius: 8px;
    }

    /* Colores de Tipos de Adrián */
    .fire {
        background: #ff416c;
    }

    .water {
        background: #2a5298;
    }

    .grass {
        background: #38ef7d;
    }

    .electric {
        background: #ffd700;
        color: #333 !important;
    }

    .psychic {
        background: #a29bfe;
    }

    .poison {
        background: #6c5ce7;
    }

    .bug {
        background: #badc58;
    }

    .normal {
        background: #95afc0;
    }

    /* Footer y Utilidades */
    footer {
        background: #2d3436;
        color: #ccc;
        padding: 40px;
        text-align: center;
        margin-top: 100px;
    }

    .btn-main {
        padding: 15px 40px;
        border: none;
        background: var(--pokemon-yellow);
        color: #2d3436;
        font-weight: bold;
        border-radius: 30px;
        cursor: pointer;
        font-size: 1.1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: 0.3s;
    }

    .btn-main:hover {
        transform: scale(1.05);
        background: #f1c40f;
    }

    .hidden {
        display: none;
    }
</style>