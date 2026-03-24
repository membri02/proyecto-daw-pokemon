<div id="pkmnDetailModal" class="pkmn-modal-backdrop" style="display:none;">
    <div class="pkmn-modal-content">
        <button class="pkmn-btn-close" onclick="cerrarPokemonModal()">&times;</button>
        
        <!-- Spinner -->
        <div id="pkmnModalSpinner" class="pkmn-modal-spinner">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/master-ball.png" class="rotating-ball" alt="Cargando">
            <p>Descifrando base de datos de Silph Co...</p>
        </div>

        <!-- Body -->
        <div id="pkmnModalBody" class="pkmn-modal-body" style="display: none;">
            <!-- Izquierda: Arte -->
            <div class="pkmn-modal-left">
                <div id="pkmnModalAura" class="pkmn-aura"></div>
                <img id="pkmnModalImg" src="" alt="Pokemon">
                <div id="pkmnModalOwnership" class="pkmn-ownership-badge" style="display: none;">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" width="16"> EN TU COLECCIÓN
                </div>
            </div>

            <!-- Derecha: Datos -->
            <div class="pkmn-modal-right">
                <div class="pkmn-modal-header">
                    <span id="pkmnModalId" class="pkmn-modal-id"></span>
                    <h2 id="pkmnModalName" class="pkmn-modal-name"></h2>
                </div>
                
                <div id="pkmnModalTypes" class="pkmn-modal-types"></div>
                
                <div class="pkmn-modal-measurements">
                    <span><strong>Peso:</strong> <span id="pkmnModalWeight"></span> kg</span>
                    <span><strong>Altura:</strong> <span id="pkmnModalHeight"></span> m</span>
                </div>

                <div class="pkmn-modal-flavor">
                    <p id="pkmnModalFlavorText"></p>
                </div>

                <div class="pkmn-modal-stats">
                    <div class="pkmn-stat-row">
                        <span class="stat-label">HP</span>
                        <div class="stat-bar-bg"><div id="stat-hp" class="stat-bar-fill bg-hp"></div></div>
                        <span id="val-hp" class="stat-val"></span>
                    </div>
                    <div class="pkmn-stat-row">
                        <span class="stat-label">Ataque</span>
                        <div class="stat-bar-bg"><div id="stat-atk" class="stat-bar-fill bg-atk"></div></div>
                        <span id="val-atk" class="stat-val"></span>
                    </div>
                    <div class="pkmn-stat-row">
                        <span class="stat-label">Defensa</span>
                        <div class="stat-bar-bg"><div id="stat-def" class="stat-bar-fill bg-def"></div></div>
                        <span id="val-def" class="stat-val"></span>
                    </div>
                    <div class="pkmn-stat-row">
                        <span class="stat-label">Veloc.</span>
                        <div class="stat-bar-bg"><div id="stat-spe" class="stat-bar-fill bg-spe"></div></div>
                        <span id="val-spe" class="stat-val"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* CSS for Pokemon Modal */
.pkmn-modal-backdrop {
    position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(8px);
    z-index: 9999;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s;
}
.pkmn-modal-backdrop.show {
    opacity: 1;
}
.pkmn-modal-content {
    background: var(--bg-card); /* Slate oscuro AAA */
    border: 1px solid var(--border-color);
    border-radius: 12px;
    width: 90%; max-width: 800px;
    position: relative;
    padding: 2.5rem;
    box-shadow: 0 25px 50px var(--shadow-color);
    color: var(--text-main); 
    transform: scale(0.95); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.pkmn-modal-backdrop.show .pkmn-modal-content {
    transform: scale(1);
}
.pkmn-btn-close {
    position: absolute; top: 15px; right: 20px;
    background: transparent; border: none; color: var(--text-muted);
    font-size: 2rem; cursor: pointer; transition: color 0.2s;
    line-height: 1;
}
.pkmn-btn-close:hover { color: var(--text-main); }

/* SPINNER */
.pkmn-modal-spinner {
    text-align: center; padding: 4rem 0; color: var(--text-muted);
}
.rotating-ball { width: 50px; animation: spin 1s linear infinite; filter: drop-shadow(0 0 10px rgba(255,255,255,0.2)); margin-bottom: 1rem; }
@keyframes spin { 100% { transform: rotate(360deg); } }

/* BODY */
.pkmn-modal-body {
    display: flex; gap: 3rem;
}
@media (max-width: 768px) {
    .pkmn-modal-body { flex-direction: column; gap: 1.5rem; }
    .pkmn-modal-content { padding: 1.5rem; }
}

/* Izquierda */
.pkmn-modal-left {
    flex: 1; position: relative;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    background: rgba(125,125,125,0.05); border-radius: 12px;
    padding: 2rem;
    border: 1px solid var(--border-color);
}
.pkmn-aura {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    width: 200px; height: 200px; border-radius: 50%;
    filter: blur(45px); opacity: 0.35; z-index: 0; transition: background 0.5s;
}
#pkmnModalImg {
    width: 220px; height: 220px; object-fit: contain;
    position: relative; z-index: 1; filter: drop-shadow(0 15px 25px rgba(0,0,0,0.4));
}
.pkmn-ownership-badge {
    margin-top: 1.5rem; background: var(--bg-color); color: #10b981;
    border: 1px solid #10b981;
    padding: 6px 16px; border-radius: 20px; font-weight: 800; font-size: 0.85rem;
    display: flex; align-items: center; gap: 8px; z-index: 2;
}

/* Derecha */
.pkmn-modal-right {
    flex: 1.4; display: flex; flex-direction: column;
}
.pkmn-modal-id { font-size: 1.5rem; color: var(--text-muted); font-weight: 900; }
.pkmn-modal-name { font-size: 2.2rem; margin: 0; text-transform: uppercase; font-weight: 900; letter-spacing: 1px; color: var(--text-main); text-shadow: 2px 2px 0px var(--shadow-color); }

.pkmn-modal-types { display: flex; gap: 8px; margin: 10px 0 20px 0; }
.modal-type-badge { padding: 5px 14px; border-radius: 6px; font-size: 0.8rem; font-weight: 900; text-transform: uppercase; color: #ffffff; border: 1px solid rgba(0,0,0,0.3); }

.pkmn-modal-measurements {
    display: flex; gap: 20px; color: var(--text-muted); font-size: 0.95rem; margin-bottom: 20px;
    background: var(--bg-color); padding: 12px; border-radius: 6px; border: 1px solid var(--border-color);
}

.pkmn-modal-flavor {
    font-size: 1.05rem; color: var(--text-main); font-style: italic; line-height: 1.6; margin-bottom: 25px;
    border-left: 3px solid var(--accent-color); padding-left: 15px;
}

/* STATS */
.pkmn-modal-stats { display: flex; flex-direction: column; gap: 12px; }
.pkmn-stat-row { display: flex; align-items: center; gap: 15px; }
.stat-label { width: 70px; font-weight: 800; font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; }
.stat-bar-bg { flex: 1; height: 12px; background: var(--bg-color); border-radius: 6px; overflow: hidden; border: 1px solid var(--border-color); }
.stat-bar-fill { height: 100%; border-radius: 6px; width: 0; transition: width 1s cubic-bezier(0.34, 1.56, 0.64, 1); }
.stat-val { width: 35px; text-align: right; font-weight: 900; font-size: 1rem; color: var(--text-main); }

.bg-hp { background: #10b981; } /* Verde Esmeralda */
.bg-atk { background: #ef4444; } /* Rojo Fuego */
.bg-def { background: #3b82f6; } /* Azul Brillante */
.bg-spe { background: #f59e0b; } /* Amarillo/Naranja Velocidad */

/* Colores para Tipos (Textos oscuros para fondos claros si se requiere, pero usamos texto blanco general y oscuremos fodos) */
.t-fuego { background-color: #dc2626; }
.t-agua { background-color: #2563eb; }
.t-planta { background-color: #16a34a; }
.t-electrico { background-color: #ca8a04; }
.t-psiquico { background-color: #9333ea; }
.t-normal { background-color: #64748b; }
.t-lucha { background-color: #b91c1c; }
.t-veneno { background-color: #7e22ce; }
.t-tierra { background-color: #b45309; }
.t-roca { background-color: #475569; }
.t-bicho { background-color: #15803d; }
.t-fantasma { background-color: #312e81; }
.t-dragon { background-color: #c2410c; }
.t-hielo { background-color: #0284c7; }
.t-hada { background-color: #db2777; }
.t-acero { background-color: #334155; }
.t-volador { background-color: #0284c7; }
</style>

<script>
    const typeColorsMap = {
        fire: '#dc2626', water: '#2563eb', grass: '#16a34a',
        electric: '#ca8a04', psychic: '#9333ea', normal: '#64748b',
        fighting: '#b91c1c', poison: '#7e22ce', ground: '#b45309',
        rock: '#475569', bug: '#15803d', ghost: '#312e81',
        dragon: '#c2410c', ice: '#0284c7', fairy: '#db2777',
        steel: '#334155', flying: '#0284c7'
    };

    const typeNamesEs = {
        fire: 'Fuego', water: 'Agua', grass: 'Planta',
        electric: 'Eléctrico', psychic: 'Psíquico', normal: 'Normal',
        fighting: 'Lucha', poison: 'Veneno', ground: 'Tierra',
        rock: 'Roca', bug: 'Bicho', ghost: 'Fantasma',
        dragon: 'Dragón', ice: 'Hielo', fairy: 'Hada',
        steel: 'Acero', flying: 'Volador'
    };

    async function abrirPokemonModal(id, options = {}) {
        const modal = document.getElementById('pkmnDetailModal');
        const spinner = document.getElementById('pkmnModalSpinner');
        const body = document.getElementById('pkmnModalBody');
        
        modal.style.display = 'flex';
        // forced reflow
        void modal.offsetWidth;
        modal.classList.add('show');
        
        spinner.style.display = 'block';
        body.style.display = 'none';

        // Reset progress bars
        document.getElementById('stat-hp').style.width = '0%';
        document.getElementById('stat-atk').style.width = '0%';
        document.getElementById('stat-def').style.width = '0%';
        document.getElementById('stat-spe').style.width = '0%';

        try {
            const [pkmnRes, speciesRes] = await Promise.all([
                fetch(`https://pokeapi.co/api/v2/pokemon/${id}`).then(r => r.json()),
                fetch(`https://pokeapi.co/api/v2/pokemon-species/${id}`).then(r => r.json())
            ]);

            // Set Image and Aura
            const primaryType = pkmnRes.types[0].type.name;
            document.getElementById('pkmnModalAura').style.background = typeColorsMap[primaryType] || '#fff';
            document.getElementById('pkmnModalImg').src = pkmnRes.sprites.other['official-artwork'].front_default;

            // Set Text
            document.getElementById('pkmnModalId').innerText = `#${String(pkmnRes.id).padStart(3, '0')}`;
            document.getElementById('pkmnModalName').innerText = pkmnRes.name;
            document.getElementById('pkmnModalWeight').innerText = (pkmnRes.weight / 10).toFixed(1);
            document.getElementById('pkmnModalHeight').innerText = (pkmnRes.height / 10).toFixed(1);

            // Set Types
            const typesBox = document.getElementById('pkmnModalTypes');
            typesBox.innerHTML = '';
            pkmnRes.types.forEach(t => {
                const badge = document.createElement('span');
                const tName = typeNamesEs[t.type.name] || t.type.name;
                badge.className = `modal-type-badge t-${tName.toLowerCase()}`;
                badge.innerText = tName;
                typesBox.appendChild(badge);
            });

            // Set Flavor Text
            const esFlavor = speciesRes.flavor_text_entries.find(f => f.language.name === 'es');
            document.getElementById('pkmnModalFlavorText').innerText = esFlavor ? esFlavor.flavor_text.replace(/\f|\n/g, ' ') : "Información clasificada. Faltan datos Silph Co.";

            // Set Stats
            const updateStat = (statName, elemId, valId) => {
                const statObj = pkmnRes.stats.find(s => s.stat.name === statName);
                if (statObj) {
                    const val = statObj.base_stat;
                    document.getElementById(valId).innerText = val;
                    // Max base stat normalization ~ 160
                    const pct = Math.min((val / 160) * 100, 100);
                    setTimeout(() => {
                        document.getElementById(elemId).style.width = pct + '%';
                    }, 50);
                }
            };
            
            updateStat('hp', 'stat-hp', 'val-hp');
            updateStat('attack', 'stat-atk', 'val-atk');
            updateStat('defense', 'stat-def', 'val-def');
            updateStat('speed', 'stat-spe', 'val-spe');

            // Ownership Badge
            const ownBadge = document.getElementById('pkmnModalOwnership');
            if (options.owned === true) {
                ownBadge.style.display = 'flex';
            } else {
                ownBadge.style.display = 'none';
            }

            // Reveal Body
            spinner.style.display = 'none';
            body.style.display = 'flex';

        } catch (e) {
            spinner.innerHTML = "<p>Error de conexión al cargar la Pokedex local.</p>";
            console.error(e);
        }
    }

    function cerrarPokemonModal() {
        const modal = document.getElementById('pkmnDetailModal');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('pkmnDetailModal').addEventListener('click', function(e) {
            if (e.target === this) cerrarPokemonModal();
        });
    });
</script>
