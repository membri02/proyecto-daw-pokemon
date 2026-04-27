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

<style>
    /* VARIABLES Y ESTILOS BASE */
    .recarga-wrapper {
        padding: 3rem 1.5rem;
        max-width: 1200px; 
        margin: 0 auto;
        font-family: 'Montserrat', sans-serif;
        background: #f8fafc;
        min-height: calc(100vh - 70px);
        color: #1e293b;
    }

    .recarga-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .titulo-pokemon {
        font-size: 3rem;
        color: #1e293b;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
        font-weight: 900;
        text-shadow: 2px 2px 0px rgba(0,0,0,0.1);
    }

    .subtitulo {
        font-size: 1.2rem;
        color: #475569;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .saldo-actual-badge {
        display: inline-flex;
        align-items: center;
        background: #FFCB05;
        color: #000;
        padding: 10px 25px;
        border-radius: 50px;
        border: 2px solid #111827;
        font-weight: 800;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(255,203,5,0.4);
        gap: 8px;
    }

    .saldo-actual-badge img {
        width: 24px;
    }

    /* GRID DE PACKS */
    .packs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 1rem;
    }

    .pack-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        position: relative;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 2px solid #e2e8f0;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .pack-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border-color: #3b82f6;
    }

    .pack-card.destacado {
        border-color: #FFCB05;
        border-width: 3px;
        transform: scale(1.05);
        box-shadow: 0 15px 35px rgba(255, 203, 5, 0.2);
    }

    .pack-card.destacado:hover {
        transform: scale(1.05) translateY(-10px);
    }

    .badge-popular {
        position: absolute;
        top: -15px;
        background: #FFCB05;
        color: #000;
        padding: 5px 20px;
        border-radius: 20px;
        font-weight: 900;
        font-size: 0.8rem;
        border: 2px solid #111827;
        letter-spacing: 1px;
    }

    .pack-icon {
        width: 100px;
        height: 100px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .pack-icon img {
        width: 60px;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
    }

    .pack-card h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .pack-amount {
        font-size: 2.5rem;
        font-weight: 900;
        color: #3b82f6;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        margin-bottom: 0.5rem;
    }

    .pack-amount img {
        width: 35px;
    }

    .pack-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 2rem;
    }

    .gpay-container {
        width: 100%;
        min-height: 40px;
        display: flex;
        justify-content: center;
    }

    .btn-secondary-tcg {
        display: inline-block;
        padding: 12px 25px;
        background: #e2e8f0;
        color: #1e293b;
        text-decoration: none;
        font-weight: bold;
        border-radius: 8px;
        transition: background 0.3s;
    }

    .btn-secondary-tcg:hover {
        background: #cbd5e1;
    }

    /* SPINNER */
    .spinner-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.9);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    .spinner-overlay.active {
        opacity: 1;
        pointer-events: all;
    }

    .pokeball-spinner {
        width: 80px;
        animation: spin 1s linear infinite;
        margin-bottom: 1rem;
    }

    .spinner-text {
        color: white;
        font-size: 1.5rem;
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    @keyframes spin {
        100% { transform: rotate(360deg); }
    }

    /* TOAST */
    .toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #22c55e;
        color: white;
        padding: 15px 25px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(34, 197, 94, 0.4);
        transform: translateY(150px);
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        z-index: 10000;
    }

    .toast.show {
        transform: translateY(0);
        opacity: 1;
    }

    .toast-content {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .toast-content img {
        width: 30px;
    }
</style>

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
</script>
@endsection
