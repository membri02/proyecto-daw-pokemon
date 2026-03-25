<div class="tcg-card {{ $carta->es_legendario ? 'legendaria' : ($carta->es_holo ? 'rara-holo' : '') }} type-bg-{{ strtolower(explode('/', $carta->tipo)[0]) }}">
    <div class="tcg-border">
        <div class="tcg-header">
            <div class="tcg-name-section">
                <span class="tcg-stage">BÁSICO</span>
                <span class="tcg-name">{{ $carta->nombre }}</span>
            </div>
            <div class="tcg-hp-section">
                <span class="tcg-ps-label">PS</span>
                <span class="tcg-hp">{{ $carta->hp ?? 60 }}</span>
                @foreach(explode('/', $carta->tipo) as $t)
                    <div class="tcg-type-icon bg-{{ strtolower(trim($t)) }}" title="{{ trim($t) }}"></div>
                @endforeach
            </div>
        </div>

        <div class="tcg-image-frame">
            <img src="{{ $carta->imagen_url }}" alt="{{ $carta->nombre }}" class="tcg-pokemon-art">
        </div>

        <div class="tcg-dex-strip">
            N.º {{ $carta->pokedex_no ?? '???' }} Pokémon {{ explode('/', $carta->tipo)[0] }}. Altura: {{ $carta->altura ?? '?m' }} Peso: {{ $carta->peso ?? '?kg' }}
        </div>

        <div class="tcg-attacks">
            @if($carta->ataque1_name)
                <div class="tcg-attack-row">
                    <div class="tcg-cost-bubbles">
                        <span class="tcg-bubble bg-{{ strtolower(explode('/', $carta->tipo)[0]) }}"></span>
                    </div>
                    <span class="tcg-attack-name">{{ $carta->ataque1_name }}</span>
                    <span class="tcg-attack-damage">{{ $carta->ataque1_damage }}</span>
                </div>
            @endif

            @if($carta->ataque2_name)
                <div class="tcg-attack-row">
                    <div class="tcg-cost-bubbles">
                        <span class="tcg-bubble bg-{{ strtolower(explode('/', $carta->tipo)[0]) }}"></span>
                        <span class="tcg-bubble bg-normal"></span>
                    </div>
                    <span class="tcg-attack-name">{{ $carta->ataque2_name }}</span>
                    <span class="tcg-attack-damage">{{ $carta->ataque2_damage }}</span>
                </div>
            @else
                <div style="flex-grow: 1;"></div>
            @endif
        </div>

        <div class="tcg-stats-footer">
            <div class="tcg-stat-col">
                <small>debilidad</small>
                <div class="tcg-stat-val">
                    @php
                        $deb = 'normal';
                        $t = strtolower(explode('/', $carta->tipo)[0]);
                        if($t == 'fuego') $deb = 'agua';
                        if($t == 'agua') $deb = 'planta';
                        if($t == 'planta') $deb = 'fuego';
                        if($t == 'electrico') $deb = 'tierra';
                        if($t == 'psiquico') $deb = 'siniestro';
                    @endphp
                    <span class="tcg-bubble bg-{{ $deb }}"></span> x2
                </div>
            </div>
            <div class="tcg-stat-col">
                <small>resistencia</small>
                <div class="tcg-stat-val"></div>
            </div>
            <div class="tcg-stat-col">
                <small>retirada</small>
                <div class="tcg-stat-val">
                    <span class="tcg-bubble bg-normal"></span>
                </div>
            </div>
        </div>

        <div class="tcg-bottom-info">
            <span class="tcg-illustrator">Ilus. Ken Sugimori</span>
            <span class="tcg-rarity-symbol">{{ strtolower($carta->rareza) == 'legendaria' ? '★' : (strtolower($carta->rareza) == 'rara' ? '♦' : '●') }} {{ $carta->rareza }}</span>
        </div>
    </div>
    
    <div class="tcg-holo-overlay"></div>
    <div class="tcg-legendary-sparkle"></div>
</div>

<style>
    /* Tipografía Profesional */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,600;0,800;0,900;1,600&display=swap');

    /* VARIABLES DE COLORES */
    .bg-fuego { background-color: #E72324; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-agua { background-color: #268AEB; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-planta { background-color: #4A9C2B; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-electrico { background-color: #F8D030; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-psiquico { background-color: #8E4383; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-normal { background-color: #A0A29F; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-lucha { background-color: #9D4929; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-veneno { background-color: #934692; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-tierra { background-color: #9A5229; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-roca { background-color: #877E62; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-bicho { background-color: #849B28; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-fantasma { background-color: #4C5292; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-dragon { background-color: #8A725D; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-hielo { background-color: #6CD2FC; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-siniestro { background-color: #3C4250; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-acero { background-color: #8E8D9E; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }
    .bg-hada { background-color: #DF89E5; box-shadow: inset 0 0 4px rgba(0,0,0,0.6); }

    /* ESTRUCTURA PRINCIPAL */
    .tcg-card {
        width: 100%;
        max-width: 250px;
        aspect-ratio: 63 / 88;
        border-radius: 12px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background: radial-gradient(circle at 30% 30%, #ffeb3b 0%, #f5b041 100%);
        box-shadow: inset 0 0 8px rgba(0,0,0,0.3), 0 5px 15px rgba(0,0,0,0.3);
        font-family: 'Montserrat', sans-serif;
        overflow: hidden;
        user-select: none;
    }

    /* GRADIENTES DE FONDO DE CADA TIPO */
    .tcg-card.type-bg-fuego .tcg-border { background-image: linear-gradient(135deg, rgba(254,202,202,0.95), rgba(254,215,170,0.95)); }
    .tcg-card.type-bg-agua .tcg-border { background-image: linear-gradient(135deg, rgba(186,230,253,0.95), rgba(147,197,253,0.95)); }
    .tcg-card.type-bg-planta .tcg-border { background-image: linear-gradient(135deg, rgba(187,247,208,0.95), rgba(134,239,172,0.95)); }
    .tcg-card.type-bg-electrico .tcg-border { background-image: linear-gradient(135deg, rgba(254,240,138,0.95), rgba(253,224,71,0.95)); }
    .tcg-card.type-bg-psiquico .tcg-border { background-image: linear-gradient(135deg, rgba(233,213,255,0.95), rgba(216,180,254,0.95)); }
    .tcg-card.type-bg-normal .tcg-border { background-image: linear-gradient(135deg, rgba(226,232,240,0.95), rgba(203,213,225,0.95)); }
    .tcg-card.type-bg-lucha .tcg-border { background-image: linear-gradient(135deg, rgba(254,215,170,0.95), rgba(253,186,116,0.95)); }
    .tcg-card.type-bg-veneno .tcg-border { background-image: linear-gradient(135deg, rgba(251,207,232,0.95), rgba(244,114,182,0.95)); }
    .tcg-card.type-bg-tierra .tcg-border { background-image: linear-gradient(135deg, rgba(231,206,181,0.95), rgba(214,211,209,0.95)); }
    .tcg-card.type-bg-roca .tcg-border { background-image: linear-gradient(135deg, rgba(214,211,209,0.95), rgba(168,162,158,0.95)); }
    .tcg-card.type-bg-bicho .tcg-border { background-image: linear-gradient(135deg, rgba(217,249,157,0.95), rgba(190,242,100,0.95)); }
    .tcg-card.type-bg-fantasma .tcg-border { background-image: linear-gradient(135deg, rgba(199,210,254,0.95), rgba(165,180,252,0.95)); }
    .tcg-card.type-bg-dragon .tcg-border { background-image: linear-gradient(135deg, rgba(253,230,138,0.95), rgba(252,211,77,0.95)); }
    .tcg-card.type-bg-hielo .tcg-border { background-image: linear-gradient(135deg, rgba(165,243,252,0.95), rgba(103,232,249,0.95)); }
    .tcg-card.type-bg-siniestro .tcg-border { background-image: linear-gradient(135deg, rgba(148,163,184,0.95), rgba(100,116,139,0.95)); }
    .tcg-card.type-bg-acero .tcg-border { background-image: linear-gradient(135deg, rgba(203,213,225,0.95), rgba(148,163,184,0.95)); }
    .tcg-card.type-bg-hada .tcg-border { background-image: linear-gradient(135deg, rgba(251,207,232,0.95), rgba(249,168,212,0.95)); }
    
    .tcg-border {
        width: 100%;
        height: 100%;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        padding: 5px 8px;
        position: relative;
        z-index: 2;
        border: 2px solid rgba(0,0,0,0.15);
        background-color: #e2e8f0;
        box-shadow: inset 0 0 10px rgba(255,255,255,0.4);
    }
    
    /* Z-INDEX CRÍTICO: Aseguramos que el contenido esté por encima del fondo texturizado */
    .tcg-border > div {
        position: relative;
        z-index: 5;
    }

    /* HEADER */
    .tcg-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2px;
        padding: 0 2px;
    }
    .tcg-name-section {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        flex: 1; 
    }
    .tcg-stage {
        font-size: 0.45rem;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: 0.5px;
    }
    .tcg-name {
        font-size: 1.15rem;
        font-weight: 900;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin-top: -3px;
    }
    .tcg-hp-section {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 2px;
    }
    .tcg-ps-label {
        font-size: 0.45rem;
        font-weight: 900;
        color: #e11d48;
        margin-right: -1px;
        margin-top: 5px;
    }
    .tcg-hp {
        font-size: 1.4rem;
        font-weight: 900;
        color: #be123c; 
        letter-spacing: -1px;
    }
    .tcg-type-icon {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 1px solid #f8fafc;
        box-shadow: 0 1px 2px rgba(0,0,0,0.5);
        margin-left: 2px;
    }

    /* ARTWORK AND INFO DEX */
    .tcg-image-frame {
        width: 100%;
        height: 120px;
        background: radial-gradient(circle, #ffffff 0%, #e2e8f0 100%);
        border: 2px solid #64748b;
        border-radius: 2px;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.2), 0 2px 4px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        margin-top: 2px;
    }
    .tcg-pokemon-art {
        width: 140%;
        height: 140%;
        object-fit: contain;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.4));
        position: relative;
        z-index: 5;
    }

    .tcg-dex-strip {
        background: linear-gradient(90deg, #d1d5db 0%, #f1f5f9 50%, #d1d5db 100%);
        border: 1px solid #64748b;
        border-top: none;
        font-size: 0.45rem;
        text-align: center;
        padding: 2px 4px;
        color: #334155;
        font-weight: 600;
        font-style: italic;
        margin-bottom: 6px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    /* ATAQUES */
    .tcg-attacks {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 4px 0;
        gap: 6px; 
    }
    .tcg-attack-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(0,0,0,0.08); 
        padding-bottom: 4px;
    }
    .tcg-attack-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .tcg-cost-bubbles {
        display: flex;
        gap: 2px;
        width: 35px;
        justify-content: flex-start;
    }
    .tcg-bubble {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        display: inline-block;
        border: 1px solid rgba(255,255,255,0.7);
        box-shadow: 0 1px 2px rgba(0,0,0,0.4);
    }
    .tcg-attack-name {
        flex: 1;
        font-size: 0.95rem;
        font-weight: 800;
        color: #0f172a;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tcg-attack-damage {
        width: 35px;
        font-size: 1.25rem;
        font-weight: 900;
        color: #0f172a;
        text-align: right;
    }

    /* FOOTER TÉCNICO */
    .tcg-stats-footer {
        display: flex;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 6px;
        border-top: 1.5px solid #0f172a;
    }
    .tcg-stat-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        flex: 1;
    }
    .tcg-stat-col small {
        font-size: 0.4rem;
        text-transform: uppercase;
        font-weight: 900;
        color: #475569;
    }
    .tcg-stat-val {
        font-size: 0.75rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0f172a;
        gap: 2px;
        min-height: 14px;
    }

    .tcg-bottom-info {
        display: flex;
        justify-content: space-between;
        margin-top: 6px;
        font-size: 0.45rem;
        font-weight: 800;
        color: #475569;
    }

    /* --- CAPAS SUPERPUESTAS DE TEXTURAS VISIBLES --- */

    /* Textura Pokéball para Rara Holo */
    .rara-holo .tcg-border::after {
        content: "";
        position: absolute;
        inset: 0;
        /* Usamos un SVG directo en formato URL con trazo negro translúcido para que se vea */
        background-image: url('data:image/svg+xml;utf8,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="14" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2"/><path d="M6 20h28" stroke="rgba(0,0,0,0.15)" stroke-width="2"/><circle cx="20" cy="20" r="4" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="2"/></svg>');
        background-size: 30px 30px;
        opacity: 1;
        z-index: 1;
        pointer-events: none;
        mix-blend-mode: color-burn; /* Esto hará que se integre oscuro con el fondo rojo/naranja */
    }

    /* Textura Cósmica para Legendaria */
    .legendaria .tcg-border::after {
        content: "";
        position: absolute;
        inset: 0;
        /* Entramado de estrellas más definidas */
        background-image: 
            radial-gradient(circle, rgba(255,255,255,0.9) 1px, transparent 1px),
            radial-gradient(circle, rgba(0,0,0,0.2) 2px, transparent 2px),
            radial-gradient(circle, rgba(255,215,0,0.8) 1.5px, transparent 1.5px);
        background-size: 20px 20px, 35px 35px, 50px 50px;
        background-position: 0 0, 15px 15px, 25px 25px;
        opacity: 0.8;
        z-index: 1;
        pointer-events: none;
        mix-blend-mode: overlay;
    }

    /* Animaciones de barrido y brillo externo */
    .tcg-holo-overlay, .tcg-legendary-sparkle {
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: 0;
        z-index: 10;
        border-radius: 12px;
    }

    .rara-holo .tcg-image-frame {
        box-shadow: inset 0 0 15px rgba(255,255,255,0.8), 0 2px 4px rgba(0,0,0,0.2);
    }
    .rara-holo .tcg-holo-overlay {
        opacity: 0.65;
        background: linear-gradient(105deg, 
            transparent 20%, 
            rgba(255, 255, 255, 0.4) 35%, 
            rgba(255, 255, 255, 0.8) 45%, 
            rgba(180, 230, 255, 0.5) 50%, 
            transparent 65%);
        background-size: 250% 250%;
        animation: holo-pass 4s ease-in-out infinite;
        mix-blend-mode: overlay;
        filter: brightness(1.2);
    }
    @keyframes holo-pass {
        0% { background-position: 100% 100%; }
        100% { background-position: 0% 0%; }
    }

    .legendaria {
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.6), inset 0 0 15px rgba(255, 215, 0, 0.3);
    }
    .legendaria .tcg-image-frame {
        background: radial-gradient(circle, #fffdf0 0%, #ffebb3 100%);
        border-color: #ffd700;
        box-shadow: inset 0 0 20px rgba(255, 215, 0, 0.4);
        overflow: visible;
    }
    .legendaria .tcg-pokemon-art {
        width: 155%;
        height: 155%;
        filter: drop-shadow(0 15px 15px rgba(0,0,0,0.4)) drop-shadow(0 0 8px rgba(255,215,0,0.3));
        z-index: 20;
    }
    .legendaria .tcg-legendary-sparkle {
        opacity: 0.85;
        background: radial-gradient(circle at 50% 50%, rgba(255, 235, 100, 0.3), transparent 60%),
                    linear-gradient(45deg, transparent 40%, rgba(255, 255, 255, 0.5) 50%, transparent 60%);
        background-size: 150% 150%;
        animation: legend-pulse 3s ease-in-out infinite alternate, legend-sweep 5s linear infinite;
        mix-blend-mode: screen;
    }
    @keyframes legend-pulse {
        from { opacity: 0.6; filter: brightness(1); }
        to { opacity: 0.9; filter: brightness(1.1); }
    }
    @keyframes legend-sweep {
        0% { background-position: 0% 0%; }
        100% { background-position: 200% 200%; }
    }
</style>