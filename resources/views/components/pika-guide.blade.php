<style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

    /* ========== HIGHLIGHT ANIMATION ========== */
    .pika-highlight {
        box-shadow: 0 0 0 4px #FFCB05, 0 0 20px 6px rgba(255, 203, 5, 0.7) !important;
        border-radius: 6px;
        z-index: 99998 !important;
        position: relative;
        transition: box-shadow 0.3s ease !important;
    }

    /* ========== BOUNCE ANIMATION ========== */
    @keyframes pikaBounce {
        0%, 100% { transform: translateY(0); }
        25%       { transform: translateY(-12px); }
        50%       { transform: translateY(-6px); }
        75%       { transform: translateY(-14px); }
    }
    .pika-bounce { animation: pikaBounce 0.6s ease infinite; }

    /* ========== MAIN CONTAINER ========== */
    .pika-guide-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        font-family: 'Press Start 2P', monospace;
        /* Pixel-perfect font rendering — no antialiasing */
        -webkit-font-smoothing: none;
        -moz-osx-font-smoothing: grayscale;
        font-smooth: never;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .pika-guide-container.minimized {
        transform: translateY(calc(100% - 90px));
    }

    /* ========== SPEECH BUBBLE ========== */
    .pika-speech-bubble {
        /* Light mode: solid white + solid black border */
        background: #ffffff;
        color: #111111;
        border: 4px solid #000000;
        border-radius: 12px;
        padding: 18px 18px 14px;
        max-width: 320px;          /* wider — no "prensado" */
        margin-bottom: 18px;
        box-shadow: 4px 4px 0px #000000;
        position: relative;
        font-size: 9px;
        line-height: 1.9;          /* breathing room for pixel font */
        min-height: 80px;
        display: none;
    }

    /* ── Tail: inner triangle matches bubble background exactly ── */
    .pika-speech-bubble::after {
        content: '';
        position: absolute;
        bottom: -17px;             /* flush with border bottom */
        right: 30px;
        border-width: 17px 17px 0 0;
        border-style: solid;
        border-color: #ffffff transparent transparent transparent;
    }

    /* ── Tail: outer triangle is the border color ── */
    .pika-speech-bubble::before {
        content: '';
        position: absolute;
        bottom: -25px;             /* 4px further = border thickness */
        right: 28px;
        border-width: 23px 21px 0 0;
        border-style: solid;
        border-color: #000000 transparent transparent transparent;
        z-index: -1;
    }

    .pika-guide-container.minimized .pika-speech-bubble {
        display: none !important;
    }

    /* ========== BUBBLE TEXT with fade transition ========== */
    #pikaText {
        min-height: 40px;
        margin-bottom: 12px;
        transition: opacity 0.3s ease;
    }
    #pikaText.pika-fade {
        opacity: 0;
    }

    /* ========== ACTION BUTTONS ========== */
    .pika-bubble-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .pika-btn {
        font-family: 'Press Start 2P', monospace;
        font-size: 8px;            /* round value ≥ 8px */
        background: #FFCB05;
        color: #000000;
        border: 2px solid #000000;
        border-radius: 4px;
        cursor: pointer;
        padding: 8px 10px;
        transition: background 0.15s, transform 0.1s;
        white-space: nowrap;
        -webkit-font-smoothing: none;
    }
    .pika-btn:hover {
        background: #e6b704;
        transform: scale(1.05);
    }
    .pika-btn.danger {
        background: #e74c3c;
        color: #ffffff;
        border-color: #c0392b;
    }
    .pika-btn.danger:hover { background: #c0392b; }

    /* ========== INPUT AREA ========== */
    .pika-input-wrapper {
        margin-top: 12px;
        display: flex;
        gap: 8px;                  /* gap between input and OK btn */
        align-items: center;
    }

    .pika-input {
        font-family: 'Press Start 2P', monospace;
        font-size: 8px;            /* round value, was 7px */
        padding: 10px 8px;         /* top/bottom 10px — text won't clip */
        border: 2px solid #000000 !important;
        border-radius: 4px;
        outline: none !important;
        width: 165px;
        background: #ffffff !important;
        color: #000000 !important;
        box-shadow: none !important;
        -webkit-font-smoothing: none;
        box-sizing: border-box;
    }

    /* ========== CLOSE BUTTON ========== */
    .pika-close {
        position: absolute;
        top: -14px;
        right: -14px;
        background: #e74c3c;
        color: #ffffff;
        border: 2px solid #000000;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        font-size: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: transform 0.2s;
        font-family: monospace;
        line-height: 1;
    }
    .pika-close:hover { transform: scale(1.15); }

    /* ========== PIKACHU SPRITE (pixel-crisp) ========== */
    .pika-sprite-wrapper {
        position: relative;
        cursor: pointer;
    }
    .pika-sprite {
        width: 90px;               /* integer multiple keeps pixels aligned */
        height: auto;              /* preserve GIF aspect ratio */
        image-rendering: pixelated;
        image-rendering: crisp-edges;
        filter: drop-shadow(2px 4px 0px rgba(0,0,0,0.4));
        display: block;
    }

    /* ========== HELP BUTTON IN NAVBAR ========== */
    #pikaHelpBtn {
        background: transparent;
        border: 2px solid #FFCB05;
        border-radius: 20px;
        padding: 4px 12px;
        color: #334155;
        font-weight: 800;
        cursor: pointer;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: inherit;
        transition: all 0.3s;
        margin-right: 6px;
    }
    #pikaHelpBtn:hover {
        background: rgba(255,203,5,0.2);
        transform: scale(1.05);
    }
</style>

<!-- Pikachu floating guide widget -->
<div id="pikaGuideContainer" class="pika-guide-container">
    <div id="pikaSpeechBubble" class="pika-speech-bubble">
        <div id="pikaCloseBtn" class="pika-close" title="Cerrar">✕</div>
        <div id="pikaText"></div>
        <div id="pikaBubbleActions" class="pika-bubble-actions" style="display:none;"></div>
        <div class="pika-input-wrapper" id="pikaInputArea">
            <input type="text" id="pikaInput" class="pika-input" placeholder="Tienda? Álbum?..." autocomplete="off">
            <button id="pikaSendBtn" class="pika-btn">OK</button>
        </div>
    </div>
    <div class="pika-sprite-wrapper" id="pikaSpriteWrapper">
        <img id="pikaSprite"
             src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/25.gif"
             alt="Pikachu Guía"
             class="pika-sprite">
    </div>
</div>

<script>
// ── Synchronous stub — exposed immediately so any page script can call pikaGuide
// before DOMContentLoaded fires. Queued calls are replayed once ready.
(function() {
    const queue = [];
    window.pikaGuide = {
        guestCheck:       function() { queue.push(['guestCheck']); },
        showGuestMessage: function(m) { queue.push(['showGuestMessage', m]); },
        startTutorial:    function() { queue.push(['startTutorial']); },
        _flush: function(real) {
            queue.forEach(([fn, ...args]) => real[fn] && real[fn](...args));
        }
    };
})();

document.addEventListener('DOMContentLoaded', function() {
    // ── DOM refs ─────────────────────────────────────────────────────────────────
    var container  = document.getElementById('pikaGuideContainer');
    var bubble     = document.getElementById('pikaSpeechBubble');
    var textEl     = document.getElementById('pikaText');
    var actions    = document.getElementById('pikaBubbleActions');
    var inputArea  = document.getElementById('pikaInputArea');
    var input      = document.getElementById('pikaInput');
    var sendBtn    = document.getElementById('pikaSendBtn');
    var closeBtn   = document.getElementById('pikaCloseBtn');
    var sprite     = document.getElementById('pikaSprite');

    var typingTimer;
    var highlightedEl = null;
    var tutorialIndex = 0;

    var tutorialSteps = [
        { selector: '.nav-logo a[href="/"]',        text: 'Paso 1 — INICIO: Aquí verás las últimas novedades del proyecto.' },
        { selector: '.nav-logo a[href="/pokedex"]', text: 'Paso 2 — POKÉDEX: Consulta los datos de los 151 Pokémon originales.' },
        { selector: '.nav-logo a[href="/sobres"]',  text: 'Paso 3 — TIENDA: ¡Mi parte favorita! Aquí gastas tus Pokémonedas.' },
        { selector: '.nav-logo a[href="/minijuego"]',text: 'Paso 4 — MINIJUEGO: ¡Juega aquí y consigue Pokémonedas gratis!' },
        { selector: '.nav-logo a[href="/album"]',   text: 'Paso 5 — MI ÁLBUM: Mira tu colección y gestiona tus repetidas.', final: true },
    ];

    // ── Bounce ───────────────────────────────────────────────────────────────────
    function startBounce() { sprite.classList.add('pika-bounce'); }
    function stopBounce()  { sprite.classList.remove('pika-bounce'); }

    // ── Highlight ────────────────────────────────────────────────────────────────
    function highlight(el) {
        if (highlightedEl) highlightedEl.classList.remove('pika-highlight');
        if (el) {
            el.classList.add('pika-highlight');
            el.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
        highlightedEl = el;
    }

    function clearHighlight() {
        if (highlightedEl) {
            highlightedEl.classList.remove('pika-highlight');
            highlightedEl = null;
        }
    }

    // ── Typing effect (with opacity fade transition) ──────────────────────────────
    function typeText(text, onDone) {
        clearTimeout(typingTimer);
        bubble.style.display = 'block';
        container.classList.remove('minimized');

        // Fade out, then start typing once invisible
        textEl.classList.add('pika-fade');
        setTimeout(function() {
            textEl.innerHTML = '';
            textEl.classList.remove('pika-fade'); // fade back in
            startBounce();
            var i = 0;
            function tick() {
                if (i < text.length) {
                    textEl.innerHTML += text.charAt(i++);
                    typingTimer = setTimeout(tick, 28);
                } else {
                    stopBounce();
                    if (onDone) onDone();
                }
            }
            tick();
        }, 300); // matches the CSS transition: opacity 0.3s ease
    }

    // ── Action buttons ────────────────────────────────────────────────────────────
    function setActions(btns) {
        actions.innerHTML = '';
        if (!btns || btns.length === 0) {
            actions.style.display = 'none';
            inputArea.style.display = 'flex';
            return;
        }
        inputArea.style.display = 'none';
        btns.forEach(function(item) {
            var b = document.createElement('button');
            b.className = 'pika-btn ' + (item.cls || '');
            b.textContent = item.label;
            b.addEventListener('click', item.cb);
            actions.appendChild(b);
        });
        actions.style.display = 'flex';
    }

    function clearActions() { setActions(null); }

    // ── Tutorial ──────────────────────────────────────────────────────────────────
    function runTutorialStep(idx) {
        if (idx >= tutorialSteps.length) {
            clearHighlight();
            clearActions();
            typeText('¡Tutorial completado, Entrenador! ⚡ Ahora eres un experto. ¡Pika!', function() {
                setActions([{ label: 'Cerrar', cb: minimize }]);
                sessionStorage.setItem('pikaGuideTutorialDone', 'true');
            });
            return;
        }
        var step = tutorialSteps[idx];
        var el = document.querySelector(step.selector);
        highlight(el);
        var nextLabel = step.final ? 'Finalizar' : 'Siguiente ▶';
        typeText(step.text, function() {
            setActions([{
                label: nextLabel,
                cb: function() {
                    clearHighlight();
                    clearActions();
                    runTutorialStep(idx + 1);
                }
            }]);
        });
    }

    function startTutorial() {
        tutorialIndex = 0;
        clearActions();
        sessionStorage.removeItem('pikaGuideTutorialDone');
        runTutorialStep(0);
    }

    // ── Keyword chat ──────────────────────────────────────────────────────────────
    function handleKeyword(q) {
        var v = q.toLowerCase().trim();
        clearHighlight();
        clearActions();
        if (v.includes('hola') || v.includes('saludos')) {
            typeText('¡Pika-pika, hola Entrenador! ¿En qué puedo ayudarte?');
        } else if (v.includes('tienda') || v.includes('sobre')) {
            typeText('En la Tienda TCG puedes comprar sobres de cartas. ¡Los premium garantizan rarezas!');
        } else if (v.includes('álbum') || v.includes('album') || v.includes('carta')) {
            typeText('¡En Mi Álbum verás todas tus cartas! Las repetidas se pueden intercambiar. Pika.');
        } else if (v.includes('tutorial') || v.includes('ayuda')) {
            startTutorial();
        } else if (v.includes('moneda') || v.includes('dinero') || v.includes('saldo')) {
            typeText('Al registrarte recibes 1,000 Pokémonedas gratis. Un sobre básico cuesta 100.');
        } else {
            typeText('¿Pika? No entiendo ese ataque... ¡prueba "Tutorial", "Tienda" o "Álbum"!');
        }
    }

    // ── Minimize / Open ───────────────────────────────────────────────────────────
    function minimize() {
        clearHighlight();
        container.classList.add('minimized');
        sessionStorage.setItem('pikaGuideClosed', 'true');
        stopBounce();
    }

    function open() {
        container.classList.remove('minimized');
        sessionStorage.setItem('pikaGuideClosed', 'false');
        bubble.style.display = 'block';
        clearActions();
        typeText('¡Pika-pika! ¿Necesitas ayuda? Dime "Tutorial" para empezar.');
    }

    function guestCheck() {
        container.classList.remove('minimized');
        sessionStorage.setItem('pikaGuideClosed', 'false');
        clearHighlight();
        sprite.classList.add('pika-bounce');
        sprite.style.transform = 'scale(1.2)';
        setTimeout(function() { sprite.style.transform = ''; }, 400);
        typeText('¡Pika-pika! ⚡ No puedes comprar sobres sin una cuenta. ¡Regístrate ahora y llévate 1,000 monedas de regalo!', function() {
            setActions([
                { label: '🎓 ¡Registrarme ahora!', cb: function() { window.location.href = '{{ route("register") }}'; } },
                { label: 'Iniciar Sesión',          cb: function() { window.location.href = '{{ route("login") }}'; } }
            ]);
        });
    }

    // ── Event listeners ───────────────────────────────────────────────────────────
    closeBtn.addEventListener('click', minimize);

    document.getElementById('pikaSpriteWrapper').addEventListener('click', function() {
        if (container.classList.contains('minimized')) open();
    });

    sendBtn.addEventListener('click', function() {
        if (input.value.trim()) { handleKeyword(input.value); input.value = ''; }
    });
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && input.value.trim()) { handleKeyword(input.value); input.value = ''; }
    });

    // ── Inject Help button into navbar (after all functions are defined) ───────────
    var navAuth = document.querySelector('.nav-auth');
    if (navAuth && typeof startTutorial === 'function') {
        var helpBtn = document.createElement('button');
        helpBtn.id = 'pikaHelpBtn';
        helpBtn.title = 'Ayuda Pikachu';
        helpBtn.innerHTML = '<img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/oaks-letter.png" alt="Ayuda" style="width:20px;"> Tutorial';
        helpBtn.addEventListener('click', startTutorial);
        navAuth.prepend(helpBtn);
    }

    // ── Init ──────────────────────────────────────────────────────────────────────
    if (sessionStorage.getItem('pikaGuideClosed') === 'true') {
        container.classList.add('minimized');
        bubble.style.display = 'block';
        textEl.innerHTML = '¡Pika! (clic para abrir)';
    } else if (!sessionStorage.getItem('pikaGuideGreeted')) {
        setTimeout(function() {
            typeText('¡Pika! Bienvenido al Pokémon DAW Project. Di "Tutorial" para un recorrido, o pregúntame lo que quieras.');
            sessionStorage.setItem('pikaGuideGreeted', 'true');
        }, 1000);
    } else {
        bubble.style.display = 'block';
        textEl.innerHTML = '¡Pika-pika! ¿Necesitas ayuda?';
        clearActions();
    }

    // ── Public API (replace stub, flush queued calls) ─────────────────────────────
    var prevStub = window.pikaGuide;
    window.pikaGuide = {
        guestCheck:       guestCheck,
        showGuestMessage: guestCheck,
        startTutorial:    startTutorial,
    };
    if (prevStub && typeof prevStub._flush === 'function') prevStub._flush(window.pikaGuide);
});
</script>
