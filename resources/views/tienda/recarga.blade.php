@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="recarga-wrapper">
    <header class="recarga-header">
        <h1 class="titulo-pokemon">Banco Pokémon</h1>
        <p class="subtitulo">Adquiere Pokémonedas adicionales de forma segura con Google Pay</p>
        
        <div class="saldo-actual-badge">
            Saldo actual: <span id="saldoUsuario">{{ Auth::user()->monedas }}</span> 
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Moneda">
        </div>
    </header>

    <div class="packs-grid">
        <!-- Pack Básico -->
        <div class="pack-card">
            <div class="pack-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/coin-case.png" alt="Pack Básico">
            </div>
            <h2>Pack Básico</h2>
            <div class="pack-amount">500 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Moneda"></div>
            <div class="pack-price">0.00 €</div>
            <div class="gpay-container" data-amount="500"></div>
        </div>

        <!-- Pack Avanzado -->
        <div class="pack-card destacado">
            <div class="badge-popular">MÁS POPULAR</div>
            <div class="pack-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/nugget.png" alt="Pack Avanzado">
            </div>
            <h2>Pack Avanzado</h2>
            <div class="pack-amount">1200 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Moneda"></div>
            <div class="pack-price">0.00 €</div>
            <div class="gpay-container" data-amount="1200"></div>
        </div>

        <!-- Pack Maestro -->
        <div class="pack-card">
            <div class="pack-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/big-nugget.png" alt="Pack Maestro">
            </div>
            <h2>Pack Maestro</h2>
            <div class="pack-amount">2500 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Moneda"></div>
            <div class="pack-price">0.00 €</div>
            <div class="gpay-container" data-amount="2500"></div>
        </div>

        <!-- Pack Monedas Gratis (Ads) -->
        <div class="pack-card" style="border-color: #4ade80;">
            <div class="badge-popular" style="background: #4ade80; color: #000;">NUEVO</div>
            <div class="pack-icon">
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/exp-share.png" alt="Monedas Gratis">
            </div>
            <h2>Monedas Gratis</h2>
            <div class="pack-amount">50 <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Moneda"></div>
            <div class="pack-price">Ver Video</div>
            <button id="btnWatchAd" class="btn-secondary-tcg" style="background: white; color: black; border: 2px solid #ea4335; margin-top: 10px; width: 100%; border-radius: 4px; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <i class="fab fa-google" style="color: #ea4335; font-size: 1.2rem;"></i>
                <span id="btnWatchAdText">Google Ads</span>
            </button>
        </div>
    </div>

    <div class="tienda-action-bar" style="text-align: center; margin-top: 3rem;">
        <a class="btn-secondary-tcg" href="{{ route('tienda.index') }}">← Volver a la Tienda</a>
    </div>
</div>

<!-- Spinner Transición (Procesando Pago) -->
<div class="spinner-overlay" id="spinnerOverlay">
    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/master-ball.png" alt="Procesando" class="pokeball-spinner">
    <div class="spinner-text">PROCESANDO PAGO...</div>
</div>

<!-- Toast Notificación -->
<div id="toast-success" class="toast">
    <div class="toast-content">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/amulet-coin.png" alt="Éxito">
        <span id="toast-message">¡Pago exitoso!</span>
    </div>
</div>

<!-- Modal Ad -->
<div id="adModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.9); z-index:9999; flex-direction:column; justify-content:center; align-items:center;">
    <div style="width:80%; max-width:800px; text-align:right; margin-bottom:10px;">
        <span id="adTimer" style="color:white; font-size:1.2rem; font-weight:bold; margin-right:20px;">15s</span>
        <button id="btnCloseAd" disabled style="padding:10px 20px; background:#444; color:#888; border:none; cursor:not-allowed; border-radius:5px; font-weight:bold;">Cerrar y Reclamar</button>
    </div>
    <div style="width:80%; max-width:800px; aspect-ratio:16/9; background:#000;">
        <iframe id="adVideo" width="100%" height="100%" src="https://www.youtube.com/embed/1roy4o4tqQM?autoplay=0&controls=0&mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</div>

@vite(['resources/css/recarga.css'])
<!-- Google Pay SDK -->
<script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>
<script>
    // Configuración base de Google Pay
    const baseRequest = {
        apiVersion: 2,
        apiVersionMinor: 0
    };

    const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];
    const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

    const baseCardPaymentMethod = {
        type: 'CARD',
        parameters: {
            allowedAuthMethods: allowedCardAuthMethods,
            allowedCardNetworks: allowedCardNetworks
        }
    };

    const cardPaymentMethod = Object.assign(
        {},
        baseCardPaymentMethod,
        {
            tokenizationSpecification: {
                type: 'PAYMENT_GATEWAY',
                parameters: {
                    'gateway': 'example', // Dummy gateway para TEST
                    'gatewayMerchantId': 'exampleGatewayMerchantId'
                }
            }
        }
    );

    let paymentsClient = null;

    function getGoogleIsReadyToPayRequest() {
        return Object.assign(
            {},
            baseRequest,
            { allowedPaymentMethods: [baseCardPaymentMethod] }
        );
    }

    function getGooglePaymentDataRequest(amountStr) {
        const paymentDataRequest = Object.assign({}, baseRequest);
        paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
        paymentDataRequest.transactionInfo = {
            totalPriceStatus: 'FINAL',
            totalPrice: amountStr,
            currencyCode: 'EUR',
            countryCode: 'ES'
        };
        // En TEST merchantId no es validado estrictamente, pero se recomienda proveer uno dummy
        paymentDataRequest.merchantInfo = {
            merchantName: 'Banco Pokémon TCG',
            merchantId: '12345678901234567890'
        };
        return paymentDataRequest;
    }

    function getGooglePaymentsClient() {
        if (paymentsClient === null) {
            paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
        }
        return paymentsClient;
    }

    function onGooglePayLoaded() {
        const paymentsClient = getGooglePaymentsClient();
        paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
            .then(function(response) {
                if (response.result) {
                    addGooglePayButtons();
                }
            })
            .catch(function(err) {
                console.error("Error isReadyToPay:", err);
            });
    }

    function addGooglePayButtons() {
        const containers = document.querySelectorAll('.gpay-container');
        containers.forEach(container => {
            const amountCoins = container.dataset.amount;
            const button = getGooglePaymentsClient().createButton({
                buttonColor: 'black',
                buttonType: 'buy',
                onClick: () => onGooglePaymentButtonClicked(amountCoins)
            });
            container.appendChild(button);
        });
    }

    function onGooglePaymentButtonClicked(amountCoins) {
        // En este entorno de prueba simulamos que el precio es 0.00
        const paymentDataRequest = getGooglePaymentDataRequest('0.00');
        const paymentsClient = getGooglePaymentsClient();
        
        paymentsClient.loadPaymentData(paymentDataRequest)
            .then(function(paymentData) {
                processPayment(paymentData, amountCoins);
            })
            .catch(function(err) {
                console.error("Pago cancelado o fallido:", err);
            });
    }

    function processPayment(paymentData, amountCoins) {
        // 1. Mostrar Spinner de "Procesando"
        const spinner = document.getElementById('spinnerOverlay');
        spinner.classList.add('active');

        // 2. Enviar datos al backend con Fetch y CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('{{ route("tienda.procesar_pago") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                monedas: parseInt(amountCoins)
            })
        })
        .then(response => response.json())
        .then(data => {
            spinner.classList.remove('active');

            if (data.success) {
                // Actualizar saldo en la UI
                document.getElementById('saldoUsuario').innerText = data.monedas_actuales;
                
                // Mostrar Toast
                const toast = document.getElementById('toast-success');
                document.getElementById('toast-message').innerText = data.message;
                toast.classList.add('show');
                
                // Ocultar toast despues de 4 segundos
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 4000);
            } else {
                alert("Error al procesar pago: " + data.message);
            }
        })
        .catch(error => {
            spinner.classList.remove('active');
            console.error('Error en fetch:', error);
            alert('Ha ocurrido un error al conectar con el servidor.');
        });
    }

    // Lógica del Anuncio Premiado
    const MAX_ADS_PER_DAY = 4;
    const AD_COOLDOWN_MS = 24 * 60 * 60 * 1000; // 24 hours
    
    function checkAdLimits() {
        let adsData = JSON.parse(localStorage.getItem('pokemon_ads_data') || '{"count": 0, "last_date": 0}');
        const now = Date.now();
        
        // Reset si pasaron 24h
        if (now - adsData.last_date > AD_COOLDOWN_MS) {
            adsData.count = 0;
            adsData.last_date = now;
            localStorage.setItem('pokemon_ads_data', JSON.stringify(adsData));
        }

        const btn = document.getElementById('btnWatchAd');
        const btnText = document.getElementById('btnWatchAdText');

        if (adsData.count >= MAX_ADS_PER_DAY) {
            btn.disabled = true;
            btn.style.opacity = '0.5';
            btn.style.cursor = 'not-allowed';
            btnText.innerText = 'Vuelve en 24h';
            return false;
        } else {
            btnText.innerText = `Google Ads (${adsData.count}/${MAX_ADS_PER_DAY})`;
        }
        return true;
    }

    // Inicializar comprobación
    checkAdLimits();

    document.getElementById('btnWatchAd').addEventListener('click', function() {
        if (!checkAdLimits()) return;

        const modal = document.getElementById('adModal');
        const timerEl = document.getElementById('adTimer');
        const btnClose = document.getElementById('btnCloseAd');
        const iframe = document.getElementById('adVideo');
        
        // Seleccionar un vídeo de Pokémon al azar
        const adVideos = [
            "1roy4o4tqQM", // Detective Pikachu
            "bILE5BEyhdo", // Scarlet & Violet
            "D0zYJ1RQ-fs", // Sword & Shield
            "uBYORdx_AQE", // Legends Arceus
            "2-zJ1_P1Gxk"  // Pokemon GO
        ];
        const randomVideoId = adVideos[Math.floor(Math.random() * adVideos.length)];
        
        modal.style.display = 'flex';
        iframe.src = `https://www.youtube.com/embed/${randomVideoId}?autoplay=1&controls=0&mute=0`;
        
        let timeLeft = 15;
        timerEl.textContent = timeLeft + "s";
        btnClose.disabled = true;
        btnClose.style.background = "#444";
        btnClose.style.color = "#888";
        btnClose.style.cursor = "not-allowed";

        const interval = setInterval(() => {
            timeLeft--;
            if(timeLeft > 0) {
                timerEl.textContent = timeLeft + "s";
            } else {
                clearInterval(interval);
                timerEl.textContent = "¡Completado!";
                btnClose.disabled = false;
                btnClose.style.background = "#4ade80";
                btnClose.style.color = "#000";
                btnClose.style.cursor = "pointer";
            }
        }, 1000);

        btnClose.onclick = function() {
            if(!btnClose.disabled) {
                modal.style.display = 'none';
                iframe.src = ""; // Stop video
                
                // Fetch Reward
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('{{ route("minijuego.reward") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ amount: 50, game: 'anuncio' })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success && data.monedas !== undefined) {
                        // Actualizar contadores locales
                        let adsData = JSON.parse(localStorage.getItem('pokemon_ads_data'));
                        adsData.count++;
                        adsData.last_date = Date.now();
                        localStorage.setItem('pokemon_ads_data', JSON.stringify(adsData));
                        checkAdLimits(); // Actualizar botón

                        document.getElementById('saldoUsuario').innerText = data.monedas;
                        const walletEl = document.getElementById("wallet");
                        if(walletEl) walletEl.textContent = data.monedas;
                        
                        const toast = document.getElementById('toast-success');
                        document.getElementById('toast-message').innerText = "¡Has recibido 50 monedas gratis!";
                        toast.classList.add('show');
                        setTimeout(() => toast.classList.remove('show'), 4000);
                    }
                })
                .catch(err => console.error(err));
            }
        };
    });
</script>
@endsection
