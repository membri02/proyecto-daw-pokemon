<div class="tcg-card {{ $carta->es_legendario ? 'legendaria' : ($carta->es_holo ? 'rara-holo' : '') }} type-bg-{{ strtolower(explode('/', $carta->tipo)[0]) }}">
    <!-- Borde amarillo externo clásico -->
    <div class="tcg-border">
        <!-- Header (Name, PS, Type Icon) -->
        <div class="tcg-header">
            <div class="tcg-name-section">
                <span class="tcg-stage">BÁSICO</span>
                <span class="tcg-name">{{ $carta->nombre }}</span>
            </div>
            <div class="tcg-hp-section">
                <span class="tcg-ps-label">PS</span><span class="tcg-hp">{{ $carta->hp ?? 60 }}</span>
                @foreach(explode('/', $carta->tipo) as $t)
                    <div class="tcg-type-icon bg-{{ strtolower(trim($t)) }}" title="{{ trim($t) }}"></div>
                @endforeach
            </div>
        </div>

        <!-- Artwork Frame -->
        <div class="tcg-image-frame">
            <img src="{{ $carta->imagen_url }}" alt="{{ $carta->nombre }}" class="tcg-pokemon-art">
        </div>

        <!-- Info Dex Strip -->
        <div class="tcg-dex-strip">
            N.º {{ $carta->pokedex_no ?? '???' }} Pokémon {{ explode('/', $carta->tipo)[0] }}. Altura: {{ $carta->altura ?? '?m' }} Peso: {{ $carta->peso ?? '?kg' }}
        </div>

        <!-- Attacks Region -->
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
                <!-- Si solo tiene un ataque, damos un poco de espacio extra -->
                <div style="flex-grow: 1;"></div>
            @endif
        </div>

        <!-- Footer Stats (Debilidad, Resistencia, Retirada) -->
        <div class="tcg-stats-footer">
            <div class="tcg-stat-col">
                <small>debilidad</small>
                <div class="tcg-stat-val">
                    <!-- Simulamos una debilidad genérica (Normal -> Lucha, Fuego -> Agua, etc) -->
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
    
    <!-- Capas de Efectos Especiales (Holo / Legendaria) -->
    <div class="tcg-holo-overlay"></div>
    <div class="tcg-legendary-sparkle"></div>
</div>

<style>
    /* VARIABLES DE COLORES DE TIPO TCG (Mejoradas para contraste AAA sobre las cartas) */
    .bg-fuego { background-color: #E72324; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }      /* Rojo puro */
    .bg-agua { background-color: #268AEB; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }       /* Azul cielo intenso */
    .bg-planta { background-color: #4A9C2B; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }     /* Verde clorofila */
    .bg-electrico { background-color: #F8D030; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }  /* Amarillo Pikachu */
    .bg-psiquico { background-color: #8E4383; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }   /* Púrpura oscuro */
    .bg-normal { background-color: #A0A29F; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }     /* Gris metalizado */
    .bg-lucha { background-color: #9D4929; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }      /* Marrón rojizo */
    .bg-veneno { background-color: #934692; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }     /* Morado tóxico */
    .bg-tierra { background-color: #9A5229; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }     /* Tierra */
    .bg-roca { background-color: #877E62; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }       /* Piedra oscuro */
    .bg-bicho { background-color: #849B28; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }      /* Verde oliva */
    .bg-fantasma { background-color: #4C5292; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }   /* Añil oscuro */
    .bg-dragon { background-color: #8A725D; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }     /* Bronce/Dorado oscuro */
    .bg-hielo { background-color: #6CD2FC; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }      /* Celeste clarito (hielo) */
    .bg-siniestro { background-color: #3C4250; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }  /* Carbón */
    .bg-acero { background-color: #8E8D9E; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }      /* Gris plata */
    .bg-hada { background-color: #DF89E5; box-shadow: inset 0 0 4px rgba(0,0,0,0.4); }       /* Rosa chicle */

    /* FONDOS CLAROS PARA LA CARTA (Piel de la carta según el tipo) */
    .type-bg-fuego { background-color: #F8B3B3; } /* Rojo súper claro */
    .type-bg-agua { background-color: #BDE4FE; }  /* Azul súper claro */
    .type-bg-planta { background-color: #C6EBA7; }/* Verde súper claro */
    .type-bg-electrico { background-color: #FEF3B2; }
    .type-bg-psiquico { background-color: #E2BEE5; }
    .type-bg-normal { background-color: #E4E4E4; }
    .type-bg-lucha { background-color: #E8BAA0; }
    .type-bg-veneno { background-color: #E1B2DF; }
    .type-bg-tierra { background-color: #DAB69D; }
    .type-bg-roca { background-color: #D2CCBA; }
    .type-bg-bicho { background-color: #CFDF8B; }
    .type-bg-fantasma { background-color: #BAC2F6; }
    .type-bg-dragon { background-color: #E7DBC4; }
    .type-bg-hielo { background-color: #CFF1FF; }
    .type-bg-siniestro {background-color: #A0A5B1; }
    .type-bg-acero { background-color: #D2D4DE; }
    .type-bg-hada { background-color: #F7D4FA; }


    /* --- ESTRUCTURA PRINCIPAL DE LA CARTA --- */
    .tcg-card {
        width: 100%;
        max-width: 250px; /* Tamaño carta TCG estándar */
        aspect-ratio: 63 / 88; /* Proporción TCG exacta */
        border-radius: 12px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px; /* Margin del borde amarillo */
        background-color: #fbdc15; /* Base para el borde exterior si la "piel" va dentro */
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        font-family: 'Gill Sans', 'Helvetica Neue', Arial, sans-serif;
        overflow: hidden; /* Cierra los overlays mágicos */
        user-select: none;
    }

    /* Modificador: el amarillo se lo queda el wrapper, y la carta se inyecta su propio bg */
    .tcg-card.type-bg-fuego .tcg-border { background-color: #F8B3B3; }
    .tcg-card.type-bg-agua .tcg-border { background-color: #9FD6FC; }
    .tcg-card.type-bg-planta .tcg-border { background-color: #BBE09C; }
    .tcg-card.type-bg-electrico .tcg-border { background-color: #FDF19E; }
    .tcg-card.type-bg-psiquico .tcg-border { background-color: #DEBCE0; }
    .tcg-card.type-bg-normal .tcg-border { background-color: #E4E4E4; }
    .tcg-card.type-bg-lucha .tcg-border { background-color: #E0AE91; }
    .tcg-card.type-bg-hielo .tcg-border { background-color: #C8EDFF; }
    
    .tcg-border {
        width: 100%;
        height: 100%;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        padding: 5px 8px;
        background-color: #e2e8f0; /* Fallback */
        position: relative;
        z-index: 2; /* Por debajo de super destellos, por encima del base */
        border: 2px solid rgba(0,0,0,0.15); /* Remate interior */
    }

    /* HEADER */
    .tcg-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 2px;
        padding: 0 2px;
    }
    .tcg-name-section {
        display: flex;
        flex-direction: column;
    }
    .tcg-stage {
        font-size: 0.55rem;
        font-weight: 900;
        color: #1e293b;
        letter-spacing: 0.5px;
    }
    .tcg-name {
        font-size: 1.25rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin-top: -2px;
    }
    .tcg-hp-section {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .tcg-ps-label {
        font-size: 0.5rem;
        font-weight: 900;
        color: #d32f2f;
        margin-bottom: 2px;
        margin-right: -2px;
    }
    .tcg-hp {
        font-size: 1.3rem;
        font-weight: 900;
        color: #d32f2f; /* Rojo intenso como en Greninja */
        letter-spacing: -1px;
    }
    .tcg-type-icon {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 1px solid #f8fafc;
    }

    /* ARTWORK AND INFO DEX */
    .tcg-image-frame {
        width: 100%;
        height: 125px; /* Altura fija para el cuadro */
        background: radial-gradient(circle, #ffffff 0%, #cbd5e1 100%);
        border: 2px solid #94a3b8;
        border-radius: 2px;
        box-shadow: inset 0 0 8px rgba(0,0,0,0.3), 0 2px 4px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
    .tcg-pokemon-art {
        width: 140%; /* Un poco más grande para llenar y desbordar sutilmente */
        height: 140%;
        object-fit: contain;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.4));
        position: relative;
        z-index: 5;
    }

    .tcg-dex-strip {
        background: linear-gradient(90deg, #d1d5db 0%, #f1f5f9 50%, #d1d5db 100%);
        border: 1px solid #94a3b8;
        border-top: none;
        font-size: 0.5rem;
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
        justify-content: space-around; /* Distribuye espacio */
        padding: 4px 0;
    }
    .tcg-attack-row {
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        padding: 4px 0;
    }
    .tcg-attack-row:last-child {
        border-bottom: none;
    }
    .tcg-cost-bubbles {
        display: flex;
        gap: 2px;
        width: 40px; /* Ancho fijo para alinear texto */
    }
    .tcg-bubble {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        border: 1px solid rgba(255,255,255,0.5);
    }
    .tcg-attack-name {
        flex: 1;
        font-size: 0.95rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tcg-attack-damage {
        font-size: 1.1rem;
        font-weight: 900;
        color: #0f172a;
        text-align: right;
    }

    /* FOOTER TÉCNICO */
    .tcg-stats-footer {
        display: flex;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 4px;
        border-top: 1.5px solid #0f172a;
    }
    .tcg-stat-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        width: 30px;
    }
    .tcg-stat-col small {
        font-size: 0.45rem;
        text-transform: uppercase;
        font-weight: 900;
        letter-spacing: 0.2px;
        color: #334155;
    }
    .tcg-stat-val {
        font-size: 0.75rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        color: #0f172a;
        gap: 2px;
        min-height: 14px;
    }

    .tcg-bottom-info {
        display: flex;
        justify-content: space-between;
        margin-top: 4px;
        font-size: 0.45rem;
        font-weight: bold;
        color: #475569;
    }


    /* --- EFECTOS ESPECIALES DE REVELADO Y RAREZAS --- */
    
    /* Overlay mágico apagado por defecto */
    .tcg-holo-overlay, .tcg-legendary-sparkle {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        pointer-events: none;
        opacity: 0;
        z-index: 10;
        border-radius: 12px;
    }

    /* Efecto HOLO (Clase .rara-holo administrada por la carta) */
    .rara-holo .tcg-image-frame {
        box-shadow: inset 0 0 15px rgba(255,255,255,0.8), 0 2px 4px rgba(0,0,0,0.2);
    }
    .rara-holo .tcg-holo-overlay {
        opacity: 1; /* Activamos el overlay HOLO */
        background: linear-gradient(115deg, transparent 20%, rgba(255, 255, 255, 0.7) 35%, rgba(135, 206, 235, 0.4) 45%, transparent 60%);
        background-size: 200% 200%;
        animation: holo-pass 3s linear infinite;
        mix-blend-mode: color-dodge;
    }
    @keyframes holo-pass {
        0% { background-position: -50% -50%; }
        100% { background-position: 150% 150%; }
    }

    /* Efecto LEGENDARIA (Más agresivo y dorado) */
    .legendaria {
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.8), inset 0 0 20px rgba(255, 215, 0, 0.5);
    }
    .legendaria .tcg-image-frame {
        background: radial-gradient(circle, #fffdf0 0%, #ffebb3 100%);
        border-color: #ffd700;
        box-shadow: inset 0 0 20px rgba(255, 215, 0, 0.5);
        overflow: visible; /* Rompiendo marcos! */
    }
    .legendaria .tcg-pokemon-art {
        width: 155%;
        height: 155%;
        filter: drop-shadow(0 15px 15px rgba(0,0,0,0.5)) drop-shadow(0 0 10px rgba(255,215,0,0.5));
        z-index: 20;
    }
    .legendaria .tcg-legendary-sparkle {
        opacity: 1;
        background: radial-gradient(circle at 50% 50%, rgba(255, 235, 100, 0.6), transparent 70%),
                    linear-gradient(45deg, transparent 40%, rgba(255, 255, 255, 0.8) 50%, transparent 60%);
        background-size: 150% 150%;
        animation: legend-pulse 2s ease-in-out infinite alternate, legend-sweep 4s linear infinite;
        mix-blend-mode: overlay;
    }
    @keyframes legend-pulse {
        from { opacity: 0.5; filter: brightness(1); }
        to { opacity: 1; filter: brightness(1.3); }
    }
    @keyframes legend-sweep {
        0% { background-position: 0% 0%; }
        100% { background-position: 200% 200%; }
    }
</style>
